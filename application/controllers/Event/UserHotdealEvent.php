<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserHotdealEvent{
	
	function onInit(&$ci){
		$ci->load->model('Event/EventInfoModel', 'eventModel');
		$ci->load->model('Event/EventCodeRelationModel', 'relationModel');
		$ci->load->model('Members/Hospital', 'hospitalModel');		
		$ci->load->model('Code/CodeModel', 'codeModel');		
		$ci->load->model('Agency/AgencyModel', 'agencyModel');
		$ci->load->model('Event/UserCheckEventModel', 'checkModel');

		$ci->load->helper('my_file');

		$this->_ci = &$ci;
	}	

	/*
	* 핫딜 병원 목록
	*/
	function index(&$data, &$ci){		

		$ci->load->library('paging');
		$paging = &$ci->paging;

		$ctime = time();
		$sql = "select distinct(ei_hiseq) from  event_info where ei_event_type='hot' and ei_status='doing' and ( ei_end > {$ctime} or ei_auto_flag='Y')";
		//폐쇄몰 선언
		if($data['is_closed']){
			$sql = $sql." and ei_closed_display_flag='Y'";
		}
		$list = $ci->hospitalModel->listAllBySql($sql);		

		$seqs = array();
		if(isArray_($list)){
			foreach($list as $k => $v){
				$seqs[] = $v['ei_hiseq'];
			}			
		}

		$paging->setPageSize(20);
		$paging->addWhere('hi_active', '=', 'Y');
		$paging->addWhere('hi_seq', 'in', $seqs);		

		$sub_query = "( select aim_path from agency_image where ai_seq = aim_aiseq limit 1 ) as path";
		$paging_params = array(
				'table' => 'hospital_info left join agency_info on hi_org_number = ai_number',
				'cols' => "*, {$sub_query}",
			);
		$list = $ci->hospitalModel->listPage($paging, $paging_params);	
		$data['list'] = &$list;

		$ci->load->helper('my_file');

		$data['paging'] = &$paging;	

		$data['fbqs'][] = 'view_hot_list';

		return 'event/user_hotdeal';
	}

	/*
	* 핫딜 병원 목록 [더보기] ajax
	*/
	function getListAjax(&$data, &$ci){
		$this->index($data, $ci);

		if(is_array($data['list']) && count($data['list']) > 0){

			$json['list'] = array();
			foreach($data['list'] as $k => $v){
				$result = array();
				$result['thum'] = path2url_($v['path']);
				$result['hi_seq'] = $v['hi_seq'];
				$result['ai_addr'] = $v['ai_addr'];
				$result['hi_open_name'] = $v['hi_open_name'];

				$json['list'][] = $result;								
			}

		}else{
			$json['list'] = array();
		}
		echo json_encode($json);
		exit;	
	}

	/*
	* 핫딜 이벤트 목록
	* 이벤트 중 핫딜 노출이 선택된 이벤트 목록
	*/
	function eventList(&$data, &$ci){
		$seq = $data['hi_seq'] = $ci->request->param('hi_seq', METHOD_BOTH, false);
		if(!is_numeric($seq)) show_error('병원 정보를 찾을 수 없습니다.');
		$data['hospital_info'] = $ci->hospitalModel->getRowBySeq($seq);
		if(!isset($data['hospital_info']['hi_seq']) ) show_error('병원 정보를 찾을 수 없습니다.');
		$_EventController = $ci->getController('Event_SearchEvent');
		$_EventController->onInit($ci);

		//소팅		
		$_EventController->_initList($data, $ci);		
		return 'user_hotdeal_event/event_list';
	}

	/*
	* json 처리
	*/
	function jsonPage(&$data, &$ci, $EventController=false){
		$seq = $ci->request->param('hi_seq', METHOD_BOTH, false);
		if(!is_numeric($seq)) show_error('NOT FOUND!');
		if(!$EventController){
			$_EventController = $ci->getController('Event_SearchEvent');
			$_EventController->onInit($ci);
		}else{
			$_EventController = &$EventController;
		}
		

		$ci->load->library('paging');
		$paging = &$ci->paging;

		$ctime = time();		

		$paging->setPageSize(6);

		//소팅
		$sort = $data['sort'] = $ci->request->param('sort', METHOD_BOTH, 'new');
		if($sort == 'new') $paging->setOrder('ei_seq', 'desc');
//		if($sort == 'like') 
		if($sort == 'up') $paging->setOrder('ei_account', 'desc');
		if($sort == 'down') $paging->setOrder('ei_account', 'asc');

		$where_string = "( ei_hiseq = {$seq} and hi_active='Y' and ei_status='doing' and ( ei_end > {$ctime} or ei_auto_flag='Y') )";
		//폐쇄몰 선언
		if($data['is_closed']){
			$where_string = $where_string." and ei_closed_display_flag='Y'";
		}
		
		$paging->addWhere('hi_active', '=', 'Y');
		$paging_params = array(
				'table' => 'event_info left join hospital_info on ei_hiseq = hi_seq left join agency_info on ai_number = hi_org_number',
				'cols' => '*',
				'where' => $where_string
			);

		$list = $ci->eventModel->listPage($paging, $paging_params);
		

		$ei_seqs = array();
		if(is_array($list) && count($list)>0){
			foreach($list as $k => $v){
				$ei_seqs[] = $v['ei_seq'];
			}
		}
		$ci->eventCountModel->insertViewByEiseqs($ei_seqs);

		$like_list = $ci->checkModel->getListByMeseq($ci->auth->seq());

		$_EventController->_makeImageUrl($list);
		$_EventController->_printEvnetJson($list, $like_list, $data['is_closed'], $paging->totalPages);
	}


	/*
	* 각 이미지를 url 형식으로 저장
	*/
	private function _makeImageUrl(&$list){
		if(is_array($list) && count($list) > 0){
			foreach($list as $k => $v){
				$list[$k]['banner'] = $this->_path2url($v['ei_img_banner']);
				$list[$k]['slider'] = $this->_path2url($v['ei_img_slider']);
				$list[$k]['top'] = $this->_path2url($v['ei_img_top']);
				$list[$k]['middle'] = $this->_path2url($v['ei_img_middle']);
				$list[$k]['bottom'] = $this->_path2url($v['ei_img_bottom']);
			}
		}
	}
	
}
?>

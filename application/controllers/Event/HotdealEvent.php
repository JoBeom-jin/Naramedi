<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HotdealEvent{
	
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


	function eventList(&$data, &$ci){
		$seq = $data['hi_seq'] = $ci->request->param('hi_seq', METHOD_BOTH, false);
		if(!is_numeric($seq)) show_error('병원 정보를 찾을 수 없습니다.');
		$ci->load->library('paging');
		$paging = &$ci->paging;
		$ctime = time();
		$where_string = "( ei_hiseq = {$seq} and hi_active='Y' and ei_status='doing' and ( ei_end > {$ctime} or ei_auto_flag='Y') )";
		//폐쇄몰 선언
		if($data['is_closed']){
			$where_string = $where_string." and ei_closed_display_flag='Y'";
		}
		$paging->setWhereString($where_string);
		$paging->setPageSize(6);		
		

		//소팅
		$sort = $data['sort'] = $ci->request->param('sort', METHOD_BOTH, 'new');
		if($sort == 'new') $paging->setOrder('ei_seq', 'desc');
//		if($sort == 'like') 
		if($sort == 'up') $paging->setOrder('ei_account', 'desc');
		if($sort == 'down') $paging->setOrder('ei_account', 'asc');
		
		$paging_params = array(
				'table' => 'event_info left join hospital_info on ei_hiseq = hi_seq left join agency_info on ai_number = hi_org_number',
				'cols' => '*',
			);
		$data['hospital_info'] = $ci->hospitalModel->getRowBySeq($seq);
		$list = $ci->eventModel->listPage($paging, $paging_params);	
		$ei_seqs = array();
		if(is_array($list) && count($list)>0){
			foreach($list as $k => $v){
				$ei_seqs[] = $v['ei_seq'];
			}
		}
		$ci->eventCountModel->insertViewByEiseqs($ei_seqs);



		$data['list'] = &$list;
		
		$data['paging'] = &$paging;
		$data['like_list'] = $ci->checkModel->getListByMeseq($ci->auth->seq());

		$data['fbqs'][] = 'view_hot_event_list';

		$this->makeImageUrl($data['list']);		
		return 'event/user_hotdeal_event_list';
	}

	function jsonEventList(&$data, &$ci){
		$this->eventList($data, $ci);

		if(is_array($data['list']) && count($data['list']) > 0){

			$json['list'] = array();
			foreach($data['list'] as $k => $v){
				$result = array();
				$result['banner_src'] = $v['banner'];
				$result['ei_seq'] = $v['ei_seq'];
				$result['ei_name'] = $v['ei_name'];
				if(in_array($v['ei_seq'], $data['like_list'])){
					$result['is_like'] = true;					
				}else{
					$result['is_like'] = false;
				}

				if($data['is_closed'] && $v['ei_closed_discount'] > 0){
					$result['is_close_mall'] = true;
					$result['ei_discounted_account'] = number_format($v['ei_account']-($v['ei_account'] * ( $v['ei_closed_discount'] / 100 )) );

				}else{
					$result['is_close_mall'] = false;
					$result['ei_discounted_account'] = 0;
				}
							
				
				$result['ei_account'] = number_format($v['ei_account']);
				$result['end_time'] = date('Y년 m월 d일', $v['ei_end']);
				$result['hi_open_name'] = $v['hi_open_name'];
				$result['address'] = $v['ai_addr'];

				$json['list'][] = $result;								
			}

		}else{
			$json['list'] = array();
		}
		echo json_encode($json);
		exit;	
		

	}



	function viewEvent(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$data['view'] = $ci->eventModel->getFullInfoByCiseq($seq);
		$data['view']['top'] = path2url_($data['view']['ei_img_top']);
		$data['view']['middle'] = path2url_($data['view']['ei_img_middle']);
		$data['view']['bottom'] = path2url_($data['view']['ei_img_bottom']);

		$_cookie = & $ci->getController('Event_EventUserCookie');
		$_cookie->onInit($ci);
		$_cookie->setViewEvent($seq);


		$data['like_list'] = $ci->checkModel->getListByMeseq($ci->auth->seq());

		$ci->setFrame('medical2');
		$ci->addJs('/resource/js/popup_require_jq.js');
		$ci->addJs('/resource/js/eventcheck.jquery.js');
		return 'event/user_view';		
	}


	function makeImageUrl(&$list){

		if(is_array($list) && count($list) > 0){
			foreach($list as $k => $v){
				$list[$k]['banner'] = path2url_($v['ei_img_banner']);
				$list[$k]['slider'] = path2url_($v['ei_img_slider']);
				$list[$k]['top'] = path2url_($v['ei_img_top']);
				$list[$k]['middle'] = path2url_($v['ei_img_middle']);
				$list[$k]['bottom'] = path2url_($v['ei_img_bottom']);
			}
		}
	}


	
}
?>

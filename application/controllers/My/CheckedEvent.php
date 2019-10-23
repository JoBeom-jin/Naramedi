<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckedEvent{
			
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
		if(!$ci->auth->isLogin()){
			$data['msg'] = '로그인 사용자만 접근 가능합니다.';
			$data['sact'] = 'BACK';
			return 'script';
		}


		$ci->load->library('paging');
		$paging = &$ci->paging;		
		$paging->setPageSize(6);

		$ei_seqs = $ci->checkModel->getListByMeseq($ci->auth->seq());

		$data['checked_list'] = array();
		if(count($ei_seqs) > 0){
			$paging->setWhere('ei_status', '=', 'doing');
			$paging->addWhere('ei_seq', 'in', $ei_seqs);									
			$paging->addWhere('ei_end', '>', time());
			$paging->addWhere('hi_active', '=', 'Y');
		
		
			$params = array(
					'table' => 'event_info left join hospital_info on ei_hiseq = hi_seq left join agency_info on hi_org_number = ai_number',
					'cols' => '*',
				);



			$list = $ci->eventModel->listPage($paging, $params);
			$this->makeImageUrl($list);
			$data['checked_list'] = &$list;

			$data['paging'] = &$paging;
		}

		$data['like_list'] = $ci->checkModel->getListByMeseq($ci->auth->seq());

		$ci->addJs('/resource/assets/js/lightslider.js');
		$ci->addJs('/resource/js/eventcheck.jquery.js');

		return 'my/like_event';
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
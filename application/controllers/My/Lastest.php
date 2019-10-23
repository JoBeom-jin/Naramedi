<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lastest{
			
	function onInit(&$ci){
		$ci->load->model('Event/EventInfoModel', 'eventModel');
		$ci->load->model('Event/UserCheckEventModel', 'checkModel');
		$ci->load->helper('my_file');
	}


	function index(&$data, &$ci){
		$_Cookie = &$ci->getController('Event_EventUserCookie');
		$_Cookie->onInit($ci);
		$seqs = $_Cookie->getList();
		$list = $ci->eventModel->getFullInfoListBySeqs($seqs);

		$this->makeImageUrl($list);
		$data['list'] = &$list;
		$data['like_list'] = $ci->checkModel->getListByMeseq($ci->auth->seq());

		$ci->addJs('/resource/js/eventcheck.jquery.js');
		
		return 'my/lastest';
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
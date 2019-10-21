<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TotalManager{	

	function onInit(&$ci){
		$ci->load->model('Event/EventReserveModel', 'reserveModel');
		$ci->load->model('Members/Hospital', 'hospitaModel');
		$ci->load->model('Event/EventInfoModel', 'eventModel');
		$ci->load->model('User/Question', 'questionModel');
		$ci->load->model('Members/MemberQuestionModel', 'hospitalQuestionModel');
	}
	
	/*
	* 대쉬보드 default
	*/
	function index(&$data, &$ci){	
		$data['today_normal_reserve'] = $ci->reserveModel->getTodayNormalReserveNumber();
		$data['today_event_reserve'] = $ci->reserveModel->getTodayEventReserveNumber();
		$data['wait_members'] = $ci->hospitaModel->countWaitMember();
		$data['wait_event'] = $ci->eventModel->countWaitEvent();
		$data['wait_qna_count'] = $ci->questionModel->countWaitQna();
		$data['today_join_question_count'] = $ci->hospitalQuestionModel->countTodayCount();

		$data['list'] = $ci->reserveModel->getListTodayReserve();
		$data['rsv_codes'] = $ci->reserveModel->_status_code;
		return 'dashboard/manager';
	}

}
?>

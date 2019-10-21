<?
defined('BASEPATH') OR exit('No direct script access allowed');
require_once $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.'Event'.DIRECTORY_SEPARATOR.'UserHotdealEvent.php';
require_once $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.'Event'.DIRECTORY_SEPARATOR.'SearchEvent.php';

class UserPage{
	private $_Controller = false;
	private $_EventController = false;
	function onInit(&$ci){		
		$this->_Controller = new UserHotdealEvent();
		$this->_Controller->onInit($ci);	

		$this->_EventController = new SearchEvent();
		$this->_EventController->onInit($ci);	

		$this->_ci = &$ci;
	}

	function index(&$data, &$ci){
		$this->_Controller->index($data, $ci);
		return 'hotdeal/hospital_list';
	}

	function getListAjax(&$data, &$ci){
		$this->_Controller->getListAjax($data, $ci);
		exit;
	}

	function eventList(&$data, &$ci){
		$seq = $data['hi_seq'] = $ci->request->param('hi_seq', METHOD_BOTH, false);
		if(!is_numeric($seq)) show_error('병원 정보를 찾을 수 없습니다.');
		$data['hospital_info'] = $ci->hospitalModel->getRowBySeq($seq);
		if(!isset($data['hospital_info']['hi_seq']) ) show_error('병원 정보를 찾을 수 없습니다.');		
		$_EventController = new SearchEvent();
		$_EventController->onInit($ci);
		$_EventController->_app_conf['common_path'] = 'mobile/user_event/common';

		//소팅		
		$_EventController->_initList($data, $ci);				
		
		return 'hotdeal/event_list';
	}


	/*
	* json 처리
	*/
	function jsonPage(&$data, &$ci){	
		$_EventController = new SearchEvent();
		$_EventController->onInit($ci);
		$_EventController->_app_conf['common_path'] = 'mobile/user_event/common';

		$this->_Controller->jsonPage($data, $ci, $_EventController);
		exit;
	}
	
}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuideManager{

	private $_types = array();
	
	function onInit(&$ci){	
		$ci->load->model('Members/MemberQuestionModel', 'questionModel');
		$this->_types = $ci->questionModel->types;
	}

	function index(&$data, &$ci){	
		$ci->load->library('paging');
		$paging = &$ci->paging;
		$paging->addOrder('mq_seq', 'desc');
		$data['list'] = $ci->questionModel->listPage($paging);			
		$data['paging'] = &$paging;

		$data['_types'] = &$this->_types;
		$data['_status_codes'] = $ci->questionModel->getStatusCodes();
		return 'Member/guide_list';
	}	

	function complete(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$ci->questionModel->setCompleteBySeq($seq);
		$data['msg'] = '처리되었습니다.';
		$data['sact'] = array('PR');
		return 'script';
	}
}
?>

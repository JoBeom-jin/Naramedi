<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guide{

	private $_types = array();
	
	function onInit(&$ci){	
		$ci->load->model('Members/MemberQuestionModel', 'questionModel');
		$this->_types = $ci->questionModel->types;
	}

	function index(&$data, &$ci){	

		$data['_types'] = &$this->_types;
		return 'member/guide';
	}	

	function insertOk(&$data, &$ci){
		$args = $ci->request->getAll();
		
		if($ci->questionModel->insertArgs($args)){
			$data['msg'] = '문의내용이 정상적으로 등록되었습니다.';
			$data['sact'] = 'PR';
			return 'script';

		}else{
			$data['msg']= $ci->questionModel->error_message;
		}

		return 'script';
	}
}
?>

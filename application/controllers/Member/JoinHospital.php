<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JoinHospital{

	private $_user_code = 'HOSPITAL';
	private $_controller = false;
	
	function onInit(&$ci){
		$ci->load->model('Members/MemberGroup', 'member_groupModel');
		$ci->load->model('Members/Members', 'memberModel');	
		$ci->load->model('Members/Hospital', 'hospitalModel');
		$ci->load->model('Members/HospitalFileModel', 'fileModel');
		$this->_controller = & $ci->getController('Member_HospitalMember');
	}

	function index(&$data, &$ci){	
		$this->_controller->insertMember($data, $ci);

		$ci->setFrame('medical');			
		return 'member/join_form';
	}	

	function insertOk(&$data, &$ci){
		return $this->_controller->insertMemberOk($data, $ci);
	}
}
?>

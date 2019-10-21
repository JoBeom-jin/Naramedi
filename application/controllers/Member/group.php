<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class group{

	private $_GroupModel = false;

	function onInit(&$ci){
		$ci->load->model('Members/AuthGroup', 'authgroup');	
	}

	function index(&$data, &$ci){
		$data['group_list'] = $ci->authgroup->listAll('*');		

		return 'Member/group_list';
	}

	function insertGroup(&$data, &$ci){		
		$args['gr_id'] = $ci->input->post('gr_id', false);
		$args['gr_name'] =$ci->input->post('gr_name', false);

		$msg = $ci->authgroup->insertArgs($args);				
		if($msg) $data['msg'] = $msg;			
		else{
			$data['msg'] = '정상적으로 입력되었습니다.';
			$data['sact'] = 'PR';
		}

		return 'script';
	}

	function deleteGroup(&$data, &$ci){
		$args = $ci->getParams();
		$ci->authgroup->deleteById($args['id']);		
		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = 'PR';
		return 'script';
	}
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class member{

	function onInit(&$ci){
		$ci->load->model('Members/members', 'memberService');	
		$ci->load->model('Members/AuthGroup', 'authGroup');
		$ci->load->model('Members/MemberGroup', 'memberGroup');
	}

	function index(&$data, &$ci){			
		
		$data['member_list'] = $ci->memberService->listAll('*');
		

		return 'Member/list';
	}

	function insertMember(&$data, &$ci){
		$data['member'] = $ci->memberService->getEmptyRow();
		$data['group_list'] = $ci->authGroup->listAll('*');
		$data['ingroup_list'] = array();

		$ci->addJs($data['_site_config']['url']['resource'].'/js/jquery/lib/movingselect.js');
		$ci->setFrame('window');
		return 'Member/form';
	}


	function insertMemberOk(&$data, &$ci){
		$args = $ci->input->post();

		$msg = $ci->memberService->insertMember($args);	

		if(!$msg){
			$member = $ci->memberService->getMemberById($args['me_id']);	
			if($ci->chk->isArray($args['groups'])) $msg = $ci->memberGroup->insertGroup($member['me_seq'], $args['groups']);
		}

		if(!$msg){			
			$msg = '정상적으로 등록되었습니다.';
			$data['sact'] = array('POR', 'PR');
		}

		$data['msg'] = $msg;						
		return 'script';
	}

	function updateMember(&$data, &$ci){
		$args = $ci->getParams();
		$data['member'] = $ci->memberService->getMemberBySeq($args['me_seq']);
		
		$data['group_list'] = $ci->authGroup->listAll();
		$data['ingroup_list'] = $ci->memberGroup->getIngroupByMeseq($args['me_seq']);		

		$ci->addJs($data['_site_config']['url']['resource'].'/js/jquery/jquery-1.12.3.min.js');
		$ci->addJs($data['_site_config']['url']['resource'].'/js/jquery/lib/movingselect.js');
		$ci->setFrame('window');
		return 'Member/form';
	}


	function updateMemberOk(&$data, &$ci){
		$args = $ci->input->post();

		$msg = $ci->memberService->updateMember($args, $args['me_seq']);
		if(!$msg){
			
			$msg = $ci->memberGroup->updateGroup($args['me_seq'], $args['groups']);
		}
		
		if(!$msg){
			$msg = '정상적으로 수정되었습니다.';
			$data['sact'] = array('POR', 'PR');
		}

		$data['msg'] = $msg;						
		return 'script';
	}

	function deleteMember(&$data, &$ci){
		$args = $ci->getParams();
		$ci->memberGroup->deleteByMember($args['me_seq']);
		$ci->memberService->deleteByMeSeq($args['me_seq']);
		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = 'PR';
		return 'script';	
	}
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user{
	
	private $_user_code = 'LOGIN';
			
	function onInit(&$ci){
		$ci->load->model('Members/MemberGroup', 'member_group');
		$ci->load->model('Members/Members', 'members');		
		$ci->load->model('Members/MemberDetail', 'detailService');
	}

	function index(&$data, &$ci){
		$ci->load->library('Paging');
		$paging = &$ci->paging;

		$paging->setWhere('mg_grid', '=', $this->_user_code);
		$params['table'] = 'members left join member_groups on me_seq=mg_meseq left join member_detail on me_seq=md_meseq';
		$params['cols'] = '*';		
		$paging->setOrder('me_seq', 'desc');		

		$sch_op = $ci->request->param('sch_op', METHOD_GET, false);
		$sch_text = $ci->request->param('sch_text', METHOD_GET, false);
		if($sch_text && $sch_op){
			$paging->addUrl("sch_op={$sch_op}");
			$paging->addUrl("sch_text={$sch_text}");
			$paging->addWhere($sch_op, 'like', $sch_text);
		}
		$data['sch_op'] = $sch_op;
		$data['sch_text'] = $sch_text;
		
		$data['member_list'] = $ci->member_group->listPage($paging, $params);		
		$data['member_total'] = $paging->totalRows;
		$data['paging'] = &$paging;
		$data['sch_options'] = $ci->member_group->_search_option;


		$data['gender'] = $ci->detailService->getGender();
		
		return 'Member/user_list';
	}

	function insertMember(&$data, &$ci){
		$data['member'] = $ci->members->getEmptyRow();
		$data['member_detail'] = $ci->detailService->getEmptyRow();
		$data['gender'] = $ci->detailService->getGender();
		

		$ci->setFrame('window');
		return 'Member/user_detail_form';
	}

	function insertMemberOk(&$data, &$ci){

		$args = $ci->request->getAll();

		$msg = $ci->members->checkInsertParam($args);
		if(!$msg) $msg = $ci->detailService->checkInsertParam($args);

		if(!$msg){
			$ci->members->insertMember($args);
			$member = $ci->members->getMemberById($args['me_id']);
			$ci->member_group->updateGroup($member['me_seq'], array($this->_user_code) );

			$args['md_meseq'] = $member['me_seq'];
			$ci->detailService->updateDetail($args, $member['me_seq']);			
		}

		if(!$msg){			
			$msg = '정상적으로 등록되었습니다.';
			$data['sact'] = array('POR', 'PR');
		}

		$data['msg'] = $msg;						
		return 'script';
	}

	function updateMember(&$data, &$ci){
		$me_seq = $ci->request->param('me_seq', METHOD_BOTH, false);
		$data['member'] = $ci->member_group->getMemberBySeqId($me_seq, $this->_user_code);
		$data['member_detail'] = $ci->detailService->getDetailByMeseq($me_seq);

		if($data['member']['me_seq'] != $me_seq){
			$data['sact'] = 'SCLZ';
			$data['msg'] = '정보가 존재하지 않습니다.';
			$ci->setFrame('window');
			return 'script';
		}

		
		$data['gender'] = $ci->detailService->getGender();
		

		$ci->setFrame('window');
		return 'Member/user_detail_form';
	}

	function updateMemberOk(&$data, &$ci){
		$msg = false;
		$args = $ci->request->getAll();

		$msg = $ci->members->checkUpdateParam($args);
		
		if(!$msg){			
			$args['md_meseq'] = $args['me_seq'];
			$args['md_phone'] = preg_replace("/[^0-9]*/s", "", $args['md_phone']);
			$msg = $ci->detailService->checkUpdateParam($args);
		}

		if(!$msg){
			$ci->members->updateMember($args, $args['me_seq']);
			$ci->detailService->updateDetail($args, $args['me_seq']);
			$msg = '정상적으로 수정되었습니다.';
			$data['sact'] = array('POR', 'PR');
		}		


		$data['msg'] = $msg;						
		return 'script';	
	}

	function deleteMember(&$data, &$ci){
		$me_seq = $ci->request->param('me_seq', METHOD_BOTH, false );
		$ci->member_group->deleteByMember($me_seq);
		$ci->members->deleteByMeSeq($me_seq);
		$ci->detailService->deleteByMeseq($me_seq);
		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = array('POR', 'PCLZ');
		return 'script';
	}
}
?>
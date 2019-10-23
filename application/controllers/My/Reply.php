<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reply{
			
	function onInit(&$ci){
		if(!$ci->auth->isLogin()){
			header('Location: /');
			exit;
		}
	}

	function index(&$data, &$ci){
		$ci->load->model('Event/EventReserveModel', 'reserveModel');

		$data['reply_list'] = array();
		if($ci->auth->isLogin()){
			$ci->load->model('Event/UserReplyModel', 'replyModel');
			$data['reply_list'] = $ci->replyModel->getListByMeseq($ci->auth->seq());
		}

		return 'my/my_reply_list';
	}

	function modify(&$data, &$ci){
		if(!$ci->auth->isLogin()){
			$data['msg'] = '로그인 사용자만 사용할 수 있는 메뉴입니다.';
			$data['sact'] = 'BACK';
			return 'script';
		}

		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$ci->load->model('Event/UserReplyModel', 'replyModel');
		$data['reply'] = $ci->replyModel->getRowWithAgencyBySeq($seq, $ci->auth->seq());

		if(!$data['reply']){
			$data['msg'] = '정보를 찾을 수 없습니다. 다시 시도해주세요.';
			$data['sact'] = 'BACK';
			return 'script';
		}		

		$data['can_star'] = $ci->replyModel->canStar($data['reply']['ac_aiseq']);

		return 'my/my_reply_form';
	}

	function modifyOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$seq = $ci->request->param('seq', METHOD_POST);
		$ci->load->model('Event/UserReplyModel', 'replyModel');
		$reply = $ci->replyModel->getRowWithAgencyBySeq($seq, $ci->auth->seq());

		if(!$reply){
			$data['msg'] = '정보를 찾을 수 없습니다. 다시 시도해주세요.';
			return 'script';
		}

		if(!$ci->replyModel->canStar($reply['ac_aiseq'])){
			if(isset($args['ac_jin'])) unset($args['ac_jin']);
			if(isset($args['ac_kind'])) unset($args['ac_kind']);
			if(isset($args['ac_obj'])) unset($args['ac_obj']);
		}		

		$ci->replyModel->modifyBySeq($args, $seq);

		$data['msg'] = '수정되었습니다.';
		$data['sact'] = 'PR';
		return 'script';
	}

	/*
	* 작성 후기 삭제
	*/
	function deleteOk(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH);
		$ci->load->model('Event/UserReplyModel', 'replyModel');
		$reply = $ci->replyModel->getRowWithAgencyBySeq($seq, $ci->auth->seq());

		if(!$reply){
			$data['msg'] = '정보를 찾을 수 없습니다. 다시 시도해주세요.';
			return 'script';
		}

		$ci->replyModel->deleteBySeq($seq);

		$data['msg'] = '삭제되었습니다.';
		$data['back_url'] = '/m/index.php/mobile/contents/my_reply';
		$data['sact'] = 'PGOTO';
		return 'script';
	}



}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myinfo{
			
	function onInit(&$ci){
		$ci->load->model('Members/Members', 'memberModel');
		$ci->load->model('Members/MemberDetail', 'detailModel');

		if(!$ci->auth->isLogin()){
			header('Location: /');
			exit;
		}
	}


	function index(&$data, &$ci){
		$_Lastest = &$ci->getController('My_Lastest');
		$_Lastest->onInit($ci);
		$_Lastest->index($data, $ci);

		$_CheckEvent = &$ci->getController('My_CheckedEvent');
		$_CheckEvent->onInit($ci);
		$_CheckEvent->index($data, $ci);

		$data['member'] = $ci->memberModel->getMemberById($ci->auth->id());		
		$data['detail'] = $ci->detailModel->getDetailByMeseq($ci->auth->seq());


		if(is_array($data['detail']) && !array_key_exists('md_phone', $data['detail'])) $data['detail'] = $ci->detailModel->getEmptyRow();

		$ci->load->model('Event/EventReserveModel', 'reserveModel');
		$data['reserve_list'] = array();
		if($ci->auth->isLogin()){
			$ci->load->library('paging');
			$paging = &$ci->paging;
			$paging->setWhere('er_meid', '=', $ci->auth->id());
			$paging->addOrder('er_ctime', 'desc');
			
			$paging_params = array(
					'table' => ' event_reserve left join agency_info on ai_number = er_ainum',
					'cols' => '*',
				);
			$data['reserve_list'] = $ci->reserveModel->listPage($paging, $paging_params);
			

			$data['_malls'] = $ci->reserveModel->_mall_code;
			$data['_status'] = $ci->reserveModel->_status_code;		
			$data['_method'] = $ci->reserveModel->_method_code;
			$data['_times'] = $ci->reserveModel->_time_code;
		}

		//작성후기
		$data['reply_list'] = array();
		if($ci->auth->isLogin()){
			$ci->load->model('Event/UserReplyModel', 'replyModel');
			$data['reply_list'] = $ci->replyModel->getListByMeseq($ci->auth->seq());
		}
		
		return 'my/my_info';
	}

	/*
	* 작성 후기 수정
	*/
	function modifyReply(&$data, &$ci){
		if(!$ci->auth->isLogin()){
			$data['msg'] = '로그인 사용자만 사용할 수 있는 메뉴입니다.';
			$data['sact'] = 'SCLZ';
			return 'script';
		}

		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$ci->load->model('Event/UserReplyModel', 'replyModel');
		$data['reply'] = $ci->replyModel->getRowWithAgencyBySeq($seq, $ci->auth->seq());

		if(!$data['reply']){
			$data['msg'] = '정보를 찾을 수 없습니다. 다시 시도해주세요.';
			$data['sact'] = 'SCLZ';
			return 'script';
		}		

		$data['can_star'] = $ci->replyModel->canStar($data['reply']['ac_aiseq']);

		$ci->setFrame('window');
		return 'my/reply_modify_form';
	}


	/*
	* 작성 후기 수정 완료
	*/
	function modifyReplyOk(&$data, &$ci){
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
		$data['sact'] = array('PR', 'POR');
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
		$data['sact'] = array('POR', 'PCLZ');
		return 'script';
	}

	
	function changeOk(&$data, &$ci){
		$args = $ci->request->getAll();
		if(!$ci->memberModel->updateUser($args, $args['me_seq'])){
			$data['msg'] = $ci->memberModel->error_message;
		}else{
			$ci->detailModel->updateDetail($args, $args['me_seq']);
			$data['msg'] = '개인정보가 수정되었습니다.\n메인페이지로 이동합니다.';
			$data['sact'] = 'PGOTO';
			$data['back_url'] = '/';
		}

		return 'script';
		
	}

	function replyOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$args['ac_jin'] = $args['score_score1'];
		$args['ac_kind'] = $args['score_score2'];
		$args['ac_obj'] = $args['score_score3'];

		if(!$ci->auth->isLogin()){
			$data['msg'] = '후기는 로그인 후에 남길 수 있습니다.';
			return 'script';
		}

		$ci->load->model('Event/UserReplyModel', 'replyModel');

		if(!is_numeric($args['ai_number']) || !$ci->replyModel->canStar($args['ai_number'])){
			unset($args['ac_jin']);
			unset($args['ac_kind']);
			unset($args['ac_obj']);
		}else{
			if(!is_numeric($args['ac_jin']) || $args['ac_jin'] < 1){
				$data['msg'] = '진료 만족도를 선택해주세요.';
				return 'script';
			}

			if(!is_numeric($args['ac_kind']) || $args['ac_kind'] < 1){
				$data['msg'] = '기관 친절도를 선택해주세요';
				return 'script';
			}

			if(!is_numeric($args['ac_obj']) || $args['ac_obj'] < 1){
				$data['msg'] = '시설 만족도를 선택해주세요';
				return 'script';
			}
		}

		$ci->replyModel->insertArgs($args, $ci->auth->seq());

		$data['ai_seq'] = $args['ac_aiseq'];
		$data['msg'] = '후기가 등록되었습니다. 감사합니다.';
		return 'my/modal_script';

	}
}
?>
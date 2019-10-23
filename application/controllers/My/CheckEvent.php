<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckEvent{
			
	function onInit(&$ci){
		$ci->load->model('Event/UserCheckEventModel', 'checkModel');	
		$ci->load->model('Event/EventInfoModel', 'eventModel');	
	}


	function index(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$event = $ci->eventModel->getRowBySeq($seq);
		if(!$ci->auth->isLogin()){
			$data['msg'] = '찜하기는 로그인 후에 사용가능합니다.';
			return 'script';
		}

		if($ci->checkModel->alreadyExists($seq, $ci->auth->seq())){
			if(!$ci->checkModel->updateCheck($seq, $ci->auth->seq())){
				$data['msg'] = $ci->checkModel->error_message;			
				return 'script';
			}

			$data['sact'] = 'updateOk';
			$data['ei_seq'] = $seq;
			$data['ei_name'] = $event['ei_name'];

		}else{
			if(!$ci->checkModel->insertCheck($seq, $ci->auth->seq())){
				$data['msg'] = $ci->checkModel->error_message;			
				return 'script';
			}

			$data['sact'] = 'insertOk';
			$data['ei_seq'] = $seq;
			$data['ei_name'] = $event['ei_name'];
		}		
		
		$ci->setFrame('noframe');
		return 'event/script'; 	
	}	

	function checkIn(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!$ci->auth->isLogin()){
			$data['msg'] = '찜하기는 로그인 후에 사용가능합니다.';
			return 'script';
		}

		$meseq = $ci->auth->seq();
		$where = array('uce_meseq'=>$meseq, 'uce_eiseq'=>$seq);
		$row = $ci->checkModel->row('*', $where);
		if($row){
			$ci->checkModel->delete($where);
			$data['msg'] = '찜하기가 취소되었습니다.';
			$data['sact'] = 'PR';
			return 'script';
		}


		if(!$ci->checkModel->insertCheck($seq, $ci->auth->seq())){
			$data['msg'] = $ci->checkModel->error_message;			
			return 'script';
		}

		$data['sact'] = 'PR';

		return 'script';

	}


	function cancel(&$data, &$ci){
		$meseq = $ci->auth->seq();
		$seq = $ci->request->param('seq', METHOD_BOTH, false);

		if(is_numeric($meseq) && is_numeric($seq)){
			$where = array('uce_meseq'=>$meseq, 'uce_eiseq'=>$seq);
			$ci->checkModel->delete($where);
		}

		$data['msg'] = '찜하기가 취소되었습니다.';
		$data['sact'] = 'PR';
		return 'script';
	}

	
}
?>
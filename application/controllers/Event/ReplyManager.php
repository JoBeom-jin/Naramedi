<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReplyManager{

	function onInit(&$ci){
		$ci->load->model('Event/UserReplyModel', 'replyModel');
	}

	function index(&$data, &$ci){
		$ci->load->library('paging');
		$paging = & $ci->paging;

		$paging_param = array(
				'table' => 'agency_comment left join agency_info on ac_aiseq = ai_seq left join members on me_seq = ac_meseq',
				'cols' => '*'
			);
		$data['list'] = $ci->replyModel->listPage($paging, $paging_param);
		$data['paging'] = &$paging;
				
		
		return 'event/manager/reply';
	}	

	function modify(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!is_numeric($seq)){
			$data['msg'] = '잘못된 접근입니다.';
			return 'script';
		}

		$data['reply'] = $ci->replyModel->rowWithAgencyBySeq($seq);
		$ci->setFrame('window');
		return 'event/manager/reply_form';
	}	

	function modifyOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$seq = $ci->request->param('seq', METHOD_POST, false);

		$ci->replyModel->modifyBySeq($args, $seq);

		$data['msg'] = '수정되었습니다.';
		$data['sact'] = array('PR', 'POR');
		return 'script';	
	}

	function deleteOk(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH);
		$ci->replyModel->deleteBySeq($seq);

		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = array('PR');
		return 'script';	

	}
	
}
?>

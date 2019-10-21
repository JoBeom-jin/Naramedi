<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HospitalCashManager{
	
	function onInit(&$ci){	
		$ci->load->model('Event/CashModel', 'cashModel');
	}

	function index(&$data, &$ci){	
		$hi_seq = $data['_info']['hi_seq'];
		$row = $ci->cashModel->getCashHistoryBySeqs($hi_seq);
		$data['total'] = $row[$hi_seq]['total'];

		$ci->load->library('paging');
		$paging = &$ci->paging;

		$inner_query = "select ( sum(ch_in)-sum(ch_out) ) as total from cash_history where  ch_hiseq={$hi_seq} and ch_seq <= rs.ch_seq group by ch_hiseq ";
		$row = "*, ({$inner_query}) as accum";

		$paging_params = array(
				'cols'=> "{$row}",
				'table' => 'cash_history rs',
			);

		$paging->setWhere('ch_hiseq', '=', $hi_seq);
		$paging->setOrder('ch_seq', 'desc');		

		$list = $ci->cashModel->listPage($paging, $paging_params);

		$ei_seqs = array();
		if(isArray_($list)){
			foreach($list as $k => $v){
				if(is_numeric($v['ch_eiseq'])) $ei_seqs[] = $v['ch_eiseq'];
			}
		}
		
		$ci->load->model('Event/EventInfoModel','eventModel');
		$data['event_list'] = $ci->eventModel->getListByEiseqs($ei_seqs);

		$data['list'] = &$list;
		$data['paging'] = &$paging;
		
		return 'cash/manager';
	}	

	function viewInfo(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		
		if(!is_numeric($seq)){
			$data['msg'] = '잘못된 접근입니다.';
			$data['sact'] = 'SCLZ';
			return 'script';
		}

		$ci->setFrame('window');

		$data['view'] = $ci->cashModel->getRowBySeq($seq);
		return 'cash/view';
	}

	
}
?>

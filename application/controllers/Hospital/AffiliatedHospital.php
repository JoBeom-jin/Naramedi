<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AffiliatedHospital{
	
	function onInit(&$ci){
		$ci->load->model('Members/MemberGroup', 'member_groupModel');
		$ci->load->model('Members/Members', 'memberModel');	
		$ci->load->model('Members/Hospital', 'hospitalModel');
		$ci->load->model('Members/HospitalFileModel', 'fileModel');
		$ci->load->model('Agency/AgencyModel', 'AgencyModel');
		$ci->load->model('Agency/AgencyParkModel', 'ParkModel');
		$ci->load->model('Agency/AgencyTrafficModel', 'TrafficModel');
		$ci->load->model('Agency/AgencyImageModel', 'imageModel');
		$ci->load->model('Event/CashModel', 'cashModel');
	}

	function index(&$data, &$ci){
		$data['bact'] = $action = $ci->request->param('act', METHOD_BOTH, 'list');
		$action = 'do'.ucfirst($action);

		$data['types'] = array(
				'name' => array('name' => '검진기관명', 'row' => 'hi_open_name'),
				'number' => array('name' => '기관번호', 'row' => 'hi_org_number'),
			);

		$ci->load->library('paging');

		$type = $data['sch_type'] = $ci->request->param('sch_type', METHOD_BOTH, false);
		$text = $data['sch_txt'] = $ci->request->param('sch_txt', METHOD_BOTH, false);

		$data['pager_add_url'] = "act={$data['bact']}&amp;sch_type={$type}&amp;sch_txt={$text}";

		if($ci->chk->hasText($type) && $ci->chk->hasText($text)){
			$ci->paging->addWhere($data['types'][$type]['row'], 'like', $text);
		}		
		
		return $this->$action($data, $ci);
	}	

	function doList(&$data, &$ci){	
		
		$paging = &$ci->paging;
		$paging->addWhere( 'hi_active', '=', 'Y');
		$paging->addWhere( 'ai_seq', 'is', 'not null');

		$paging_params['table'] = 'hospital_info left join agency_info on ai_number = hi_org_number';
		$paging_params['cols'] = '*';

		$list= $ci->hospitalModel->listPage($paging, $paging_params);
		$seqs = array();
		if($ci->chk->isArray($list)){
			foreach($list as $k => $v){
				$seqs[] = $v['hi_seq'];				
			}
		}

		$data['cash_info'] = $ci->cashModel->getCashHistoryBySeqs($seqs);
		
		$data['list'] = &$list;
		$data['paging'] = &$paging;

		return 'affiliated_hospital/list';
	}

	function doCash(&$data, &$ci){		
		$paging = &$ci->paging;
		$paging->setWhere('ch_in', '>', 0);

		$paging_params['table'] = 'cash_history left join hospital_info on ch_hiseq = hi_seq';
		$paging_params['cols'] = '*';

		$paging->setOrder('ch_seq', 'desc');
		$data['list'] = $ci->cashModel->listPage($paging, $paging_params);
		$data['paging'] = &$paging;

		return 'affiliated_hospital/list_history';
	}

	function insertCash(&$data, &$ci){
		$hi_seq = $ci->request->param('seq', METHOD_BOTH, false);
		$data['view']= $ci->hospitalModel->getRowBySeq($hi_seq);
		$ci->setFrame('window');
		return 'affiliated_hospital/cash_form';
	}

	function insertCashOk(&$data, &$ci){
		$args = $ci->request->getAll();
		
		if(!$ci->auth->id() || !$ci->auth->name() ) {
			$data['msg'] = '권한이 없는 접근입니다.';
			
		}else if(!$ci->cashModel->insertCash( $args, $ci->auth->id(), $ci->auth->name() )){
			$data['msg'] = $ci->cashModel->error_message;			
		}else{
			$data['msg'] = '충전되었습니다.';
			$data['sact'] = array('POR', 'PCLZ');
		}

		return 'script';
	}

	
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PhoneReserveHospitalManager{

	private $_info = array();
	private $_ci = false;
	
	function onInit(&$ci){
		$ci->load->model('Bizcall/BizcallModel', 'bizcallModel');
		$ci->load->model('Event/EventReserveModel', 'reserveModel');
		$ci->load->model('Agency/AgencyModel', 'agencyModel');

		$this->_ci = &$ci;
	}
	
	function index(&$data, &$ci){	
		$_info = $data['_info'];
		if(!is_numeric($_info['hi_seq'])) show_error('정상적인 접근이 아닙니다.');

		$data['list'] = array();		
		$ci->load->library('paging');
		$paging = &$ci->paging;

		$paging->setWhere('bz_memo', '=', $_info['hi_seq']);
		$paging->addWhere('bz_checked', '<>', 'Y');
		$paging->setOrder('bz_idx', 'desc');

		$data['list'] = $ci->bizcallModel->listPage($paging);

		$ci->load->helper('my_string');
		$data['paging'] = &$paging;	
		

		return 'phone_reserve/list';
	}

	function reserve(&$data, &$ci){		
		$_info = $data['_info'];
		$data['seq'] = $ci->request->param('seq', METHOD_BOTH, false);


		$ci->setFrame('window');
		return 'phone_reserve/form';
		
	}

	function reserveOk(&$data, &$ci){
		$status = $ci->request->param('status', METHOD_BOTH, false);

		if($status){
			$_info = $data['_info'];
			$agency_info = $ci->agencyModel->getRowByNumber($_info['hi_org_number']);

			$bz_idx = $ci->request->param('bz_idx', METHOD_BOTH, false);			
			$bz_info = $ci->bizcallModel->getRowByIdx($bz_idx);
		}


		if($status == 'reserveOk'){		
			$args['er_name'] = '';
			$args['er_phone'] = $bz_info['bz_fromn'];
			$args['er_ainum'] = $agency_info['ai_number'];

			$ci->bizcallModel->setCheck($bz_info['bz_idx']);
			$ci->reserveModel->insertFromPhone($args);			
			$data['msg'] = '예약되었습니다.';
			$data['sact'] = array('POR', 'PCLZ');

		}else if($status == 'cancel'){
			$args['er_name'] = '';
			$args['er_phone'] = $bz_info['bz_fromn'];
			$args['er_ainum'] = $agency_info['ai_number'];

			$ci->reserveModel->cancelFromPhone($args);				
			$ci->bizcallModel->setCheck($bz_info['bz_idx']);
			$data['msg'] = '예약이 고객의 요청으로 취소/보류 되었습니다.';
			$data['sact'] = array('POR', 'PCLZ');
		}else{
			$data['msg'] ='예약 상태를 변경해주세요.';			
		}

		return 'script';
	}
	
}
?>

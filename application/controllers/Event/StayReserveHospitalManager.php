<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StayReserveHospitalManager{

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
		$agency_info = $ci->agencyModel->getRowByNumber($_info['hi_org_number']);
		$wait_codes = $ci->reserveModel->getWaitCodes();
		$reserved_codes = $ci->reserveModel->getReservedCode();

		$data['wait_list'] = $ci->reserveModel->getListByReserveType($agency_info['ai_number'], $wait_codes);
		$data['reserve_list'] = $ci->reserveModel->getListByReserveType($agency_info['ai_number'], $reserved_codes);

		$data['_ctime'] = time();
		$this->setData($data, $ci);
		return 'reserve/stay_list';
	}	


	function setData(&$data, &$ci){
		$data['_malls'] = $ci->reserveModel->_mall_code;
		$data['_status'] = $ci->reserveModel->_status_code;
		$data['_method'] = $ci->reserveModel->_method_code;
		$data['_times'] = $ci->reserveModel->_time_code;
	}


	function modify(&$data, &$ci){
		$data['er_seq'] = $ci->request->param('seq', METHOD_BOTH, false);
		
		$ci->addJS('/resource/js/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.js');
		$ci->addCss('/resource/js/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.css');
		$ci->setFrame('window');
		return 'reserve/stay_form';
	}

	function modifyOk(&$data, &$ci){
		$er_seq = $ci->request->param('er_seq', METHOD_POST, false);
		$method = $ci->request->param('method', METHOD_POST, false);
		$ai_number = $data['_info']['hi_org_number'];


		if(!is_numeric($er_seq) || !$method) show_error('잘못된 접근 방법입니다.');
		$where = array('er_seq' => $er_seq, 'er_ainum' => $ai_number);
		if($ci->reserveModel->count($where) < 1){
			$data['msg'] ='예약정보를 찾을 수 없습니다.';
			return 'script';
		}

		$reserve = $ci->reserveModel->getRowBySeqWithHospital($er_seq);				

		if($method == 'RESERVED'){
			$date = $ci->request->param('date', METHOD_POST, false);
			if(!$date){
				$data['msg'] = '예약일자를 선택해주세요.';
				return 'script';
			}

			$ci->reserveModel->setReserved($er_seq, $date);
			

			/* 알림톡 발송 */			
			$send_phone = $reserve['er_phone'];
			$user_name = $reserve['er_name'];
			if(!$user_name) $user_name = '';
			$reserve_date = date('m월 d일', strtotime($date));
			$hi_name = $reserve['hi_open_name'];

			$ci->load->model('Sms/MessageModel', 'smsModel');						
			$ci->smsModel->sendAlimTalk2ReserveUser($send_phone, $user_name, $reserve_date, $hi_name);

			$data['sact'] = array('POR', 'PCLZ');

		}else if($method == 'NOTACCEPT'){
			$ci->reserveModel->setNotAccept($er_seq);
			$data['sact'] = array('POR', 'PCLZ');
			
		}else if($method == 'WRONGNUMBER'){
			$ci->reserveModel->setWrongNumber($er_seq);
			$data['sact'] = array('POR', 'PCLZ');
		}else if($method == 'CANCEL'){
			$ci->reserveModel->setCancel($er_seq);
			$data['sact'] = array('POR', 'PCLZ');
		}
		return 'script';
	}

	function modifyReserve(&$data, &$ci){
		$data['er_seq'] = $ci->request->param('seq', METHOD_BOTH, false);
		
		$ci->addJS('/resource/js/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.js');
		$ci->addCss('/resource/js/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.css');
		$ci->setFrame('window');
		return 'reserve/reserved_form';		
	}

	function modifyReserveOk(&$data, &$ci){
		$er_seq = $ci->request->param('er_seq', METHOD_POST, false);
		$method = $ci->request->param('method', METHOD_POST, false);
		$ai_number = $data['_info']['hi_org_number'];


		if(!is_numeric($er_seq) || !$method) show_error('잘못된 접근 방법입니다.');
		$where = array('er_seq' => $er_seq, 'er_ainum' => $ai_number);
		if($ci->reserveModel->count($where) < 1){
			$data['msg'] ='예약정보를 찾을 수 없습니다.';
			return 'script';
		}

		if($method == 'CHANGE'){
			$date = $ci->request->param('date', METHOD_POST, false);
			if(!$date){
				$data['msg'] = '예약일자를 선택해주세요.';
				return 'script';
			}
			$ci->reserveModel->changeReserved($er_seq, $date);
			$data['sact'] = array('POR', 'PCLZ');						
		}else if($method == 'COMPLETE'){
			$ci->reserveModel->setComplete($er_seq);
			$data['sact'] = array('POR', 'PCLZ');			
		}else if($method == 'CANCEL'){
			$ci->reserveModel->setCancel($er_seq);
			$data['sact'] = array('POR', 'PCLZ');
		}

		return 'script';
	}
}
?>

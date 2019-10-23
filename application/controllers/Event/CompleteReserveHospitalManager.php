<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompleteReserveHospitalManager{

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
		$end_codes = $ci->reserveModel->getCompleteCodes();

		$ci->load->library('paging');
		$paging = &$ci->paging;
		$paging->setWhere('er_ainum', '=', $agency_info['ai_number']);
		$paging->addWhere('er_status', 'in', $end_codes);

		$paging->setOrder('er_seq', 'desc');

		$paging_params = array(
			'cols' => '*',
			'table' => 'event_reserve left join event_info on ei_seq = er_eiseq'
		);

		$data['list'] = $ci->reserveModel->listPage($paging, $paging_params);

		$data['paging'] = &$paging;
		$this->setData($data, $ci);
		return 'reserve/complete_list';
	}	


	function setData(&$data, &$ci){
		$data['_malls'] = $ci->reserveModel->_mall_code;
		$data['_status'] = $ci->reserveModel->_status_code;
		$data['_method'] = $ci->reserveModel->_method_code;

	}
}
?>

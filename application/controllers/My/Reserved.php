<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reserved{
			
	function onInit(&$ci){
		if(!$ci->auth->isLogin()){
			header('Location: /');
			exit;
		}
	}

	function index(&$data, &$ci){
		$ci->load->model('Event/EventReserveModel', 'reserveModel');

		$data['reserve_list'] = array();
		$ci->load->library('paging');
		$paging = &$ci->paging;		
		if($ci->auth->isLogin()){
			
			$paging->setWhere('er_meid', '=', $ci->auth->id());
			$paging->addOrder('er_ctime', 'desc');
			
			$paging_params = array(
					'table' => ' event_reserve left join agency_info on ai_number = er_ainum',
					'cols' => '*',
				);
			$data['reserve_list'] = $ci->reserveModel->listPage($paging, $paging_params);			
		}
		$data['_malls'] = $ci->reserveModel->_mall_code;
		$data['_status'] = $ci->reserveModel->_status_code;		
		$data['_method'] = $ci->reserveModel->_method_code;
		$data['_times'] = $ci->reserveModel->_time_code;
		$data['paging'] = &$paging;

		return 'my/my_reserved_list';
	}
}
?>
<?
class DeviceAnalytics{

	function onInit(&$ci){
		$ci->load->model('Event/EventInfoModel', 'eventModel');
		$ci->load->model('Event/EventReserveModel', 'reserveModel');
	}


	/*
	* 기기별 이벤트 예약 목록. PC or Mobile
	* 상용화 이후 추가된 필드 값이어서 null 값은 PC로 처리
	*/
	function index(&$data, &$ci){
		$type = $data['type'] = $ci->request->param('type', METHOD_BOTH, 'PC');

		$ci->load->library('paging');
		$paging = &$ci->paging;

		if($type == 'PC'){
			$where = "( er_device='{$type}' or er_device is null )";
			$paging->setWhereString($where);		
		}else{
			$paging->setWhere('er_device', '=', $type);		
		}		

		$paging_params = array(
				'cols' => '*',
				'table' => 'event_reserve left join event_info on er_eiseq = ei_seq left join hospital_info on er_ainum = hi_org_number'
			);

		$paging->addOrder('er_seq', 'desc');

		$data['list'] = $ci->eventModel->listPage($paging, $paging_params);	
		$data['paging'] = &$paging;			

		return 'analytics/device_list';
	}
}
?>
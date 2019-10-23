<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics{	

	function onInit(&$ci){
		$ci->load->model('Event/EventInfoModel', 'eventModel');
		$ci->load->model('Event/EventCountModel', 'countModel');
	}
	
	function index(&$data, &$ci){
		$ci->load->library('paging');
		$paging = &$ci->paging;

		$paging->setOrder('ei_seq', 'desc');

		$sub_select = array();
		$sub_select[] = "( select sum(ec_view) from event_count where ec_eiseq=ei_seq group by ec_eiseq ) as view_cnt";
		$sub_select[] = "( select sum(ec_click) from event_count where ec_eiseq=ei_seq group by ec_eiseq ) as click_cnt";
		$sub_select[] = "( select count(*) from user_check_event where uce_eiseq=ei_seq) as check_cnt";
		$sub_select[] = "( select count(*) from event_reserve where er_eiseq=ei_seq ) as reserve_cnt";
		$cols = "hi_open_name, ei_seq, ei_name, ei_end, ei_status, ".implode(', ', $sub_select);
		$paging_params = array(
				'cols' => $cols,
				'table' => 'event_info left join hospital_info on hi_seq = ei_hiseq'
			);

		$data['list'] = $ci->eventModel->listPage($paging, $paging_params);		
		$data['paging'] = &$paging;		

		return 'analytics/list';
	}

	function clickCount(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!is_numeric($seq)) show_error('잘못된 접근 방식 입니다.');

		$where = array('ec_eiseq'=>$seq);
		$order = 'ec_ctime desc';
		$data['list'] = $ci->countModel->listAll('*', $where, $order);

		$sql = "select sum(ec_click) as sum from event_count where ec_eiseq={$seq} group by ec_eiseq";
		$result = $ci->countModel->rowBySql($sql);
		$data['total'] = $result['sum'];

		$ci->setFrame('window');
		return 'analytics/click_count';
	}

	function checkCount(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!is_numeric($seq)) show_error('잘못된 접근 방식 입니다.');

		$ci->load->model('Event/UserCheckEventModel', 'checkModel');
		$where = array('uce_eiseq'=>$seq);
		$order = 'uce_ctime desc';

		$sql = "select *, count(*) as cnt from user_check_event where uce_eiseq={$seq} group by uce_ctime";
		$data['list'] = $ci->checkModel->listAllBySql($sql);

		$sql = "select count(*) as cnt from user_check_event where uce_eiseq={$seq}";
		$result = $ci->checkModel->rowBySql($sql);
		$data['total'] = $result['cnt'];


		$ci->setFrame('window');
		return 'analytics/check_count';
	}

	function reserveCount(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!is_numeric($seq)) show_error('잘못된 접근 방식 입니다.');

		$where = array('er_eiseq' => $seq);
		$order = 'er_seq desc';

		$ci->load->model('Event/EventReserveModel', 'reserveModel');
		$data['list'] = $ci->reserveModel->listAll('*', $where, $order);

		$ci->setFrame('window');
		return 'analytics/reserve_count';
	}

	function viewCount(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!is_numeric($seq)) show_error('잘못된 접근 방식 입니다.');

		$where = array('ec_eiseq'=>$seq);
		$order = 'ec_ctime desc';
		$data['list'] = $ci->countModel->listAll('*', $where, $order);

		$sql = "select sum(ec_view) as sum from event_count where ec_eiseq={$seq} group by ec_eiseq";
		$result = $ci->countModel->rowBySql($sql);
		$data['total'] = $result['sum'];

		$ci->setFrame('window');
		return 'analytics/view_count';
	}
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CountManager{

	private $_info = array();
	
	function onInit(&$ci){	
		$ci->load->model('Event/EventInfoModel', 'eventModel');
		$ci->load->model('Event/EventCountModel', 'countModel');

		$this->_info = $ci->hospitalModel->getFullInfoByMeseq($ci->auth->seq(), 'HOSPITAL', 'Y');
		if(!$ci->auth->isLogin() || $this->_info['hi_meseq'] != $ci->auth->seq() ) show_error('컨트롤러에 접근할 수 있는 권한이 없습니다. EventManager');

	}
	
	function index(&$data, &$ci){	
		$ci->load->library('paging');
		$paging = &$ci->paging;
		$paging->setOrder('ei_seq', 'desc');
		$paging->setWhere('ei_hiseq', '=', $this->_info['hi_seq']);
		

		$sub_select = array();
		$sub_select[] = "( select sum(ec_view) from event_count where ec_eiseq=ei_seq group by ec_eiseq ) as view_cnt";
		$sub_select[] = "( select sum(ec_click) from event_count where ec_eiseq=ei_seq group by ec_eiseq ) as click_cnt";
		$sub_select[] = "( select count(*) from user_check_event where uce_eiseq=ei_seq) as check_cnt";
		$sub_select[] = "( select count(*) from event_reserve where er_eiseq=ei_seq ) as reserve_cnt";
		$cols = "ei_seq, ei_name, ei_end, ei_status, ".implode(', ', $sub_select);
		$paging_params = array(
				'cols' => $cols
			);

		$data['list'] = $ci->eventModel->listPage($paging, $paging_params);		
		$data['paging'] = &$paging;

		return 'event/count_list';
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
		return 'event/view_count';
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
		return 'event/click_count';
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
		return 'event/check_count';
	}

	function reserveCount(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!is_numeric($seq)) show_error('잘못된 접근 방식 입니다.');

		$where = array('er_eiseq' => $seq);
		$order = 'er_seq desc';

		$ci->load->model('Event/EventReserveModel', 'reserveModel');
		$data['list'] = $ci->reserveModel->listAll('*', $where, $order);

		$ci->setFrame('window');
		return 'event/reserve_count';
	}
}
?>

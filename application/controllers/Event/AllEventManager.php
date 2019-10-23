<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AllEventManager{

	private $_type = false;
	function onInit(&$ci){
		$ci->load->model('Event/EventInfoModel', 'eventModel');
		$ci->load->model('Event/EventCodeRelationModel', 'relationModel');
		$ci->load->model('Members/Hospital', 'hospitalModel');
		$ci->load->model('Event/EventCategoryModel', 'categoryModel');
		$ci->load->model('Event/EventCategorySubModel', 'categorySubModel');

		$this->_type = $ci->getMenuParams('type');
	}

	function index(&$data, &$ci){
		$data['action_type'] = $action = $this->_type;

		$action = 'do'.ucfirst($action);
		$tpl = $this->$action($data, $ci);
		return $tpl;
	}

	function doWait(&$data, &$ci){
		$ci->load->library('paging');
		$paging = &$ci->paging;

		$ctime = time();

		$paging->setOrder('ei_seq', 'desc');
		$paging->addWhere('ei_status', '=', 'wait');
		$paging->addWhere('ei_end', '>', $ctime );

		$params = array(
				'table' => 'event_info left join hospital_info on ei_hiseq= hi_seq',
				'cols' => '*'
			);

		$data['list'] = $ci->eventModel->listPage($paging, $params);
		$data['paging'] = &$paging;

		$data['sub_title'] = '승인 대기 중인 이벤트';
		$data['dir_root'] = $ci->_site_config['dir']['root'];

		return 'event/list';
	}

	function doIng(&$data, &$ci){
		$ci->load->library('paging');
		$paging = &$ci->paging;

		$paging->setOrder('ei_seq', 'desc');

		$ctime = time();

		$paging->setWhere('ei_status', '=', 'doing');
		$paging->addWhere('ei_end', '>', $ctime );

		$params = array(
				'table' => 'event_info left join hospital_info on ei_hiseq= hi_seq',
				'cols' => '*, ( select count(*) from event_reserve where ei_seq = er_eiseq ) as rsv_cnt, ( select sum(ch_out) from cash_history where ch_eiseq = ei_seq ) as cash '
			);

		$data['list'] = $ci->eventModel->listPage($paging, $params);
		$data['paging'] = &$paging;

		$data['sub_title'] = '승인 완료된 이벤트';
		$data['dir_root'] = $ci->_site_config['dir']['root'];

		$data['event']['category_list'] = $ci->categoryModel->getNameArr();

		return 'event/list_with_cash';
	}

	function doEnded(&$data, &$ci){
		$ci->load->library('paging');
		$paging = &$ci->paging;

		$paging->setOrder('ei_seq', 'desc');

		$ctime = time();
		$paging->setWhere('ei_end', '<', $ctime );

		$params = array(
				'table' => 'event_info left join hospital_info on ei_hiseq= hi_seq',
				'cols' => '*'
			);

		$data['list'] = $ci->eventModel->listPage($paging, $params);
		$data['paging'] = &$paging;

		$data['sub_title'] = '종료된 이벤트';
		$data['dir_root'] = $ci->_site_config['dir']['root'];

		return 'event/list_with_cash';
	}

	function search(&$data, &$ci){
		$data['hi_name'] = $search_txt = $ci->request->param('hi_name', METHOD_BOTH, false);		

		$data['list'] = array();
		if($search_txt){
			$data['list'] = $ci->hospitalModel->searchByName($search_txt);
		}

		$ci->setFrame('window');
		return 'event/search_list';
	}

	function insertEvent(&$data, &$ci){
		$event_controller = & $ci->getController('Event_EventManager');
		$event_controller->insertEvent($data, $ci);

		$data['event']['category_list'] = $ci->categoryModel->getList();
		$data['event']['category_list_sub'] = $ci->categorySubModel->getList();

		return 'event/form';
	}

	function insertEventOk(&$data, &$ci){
		$event_controller = & $ci->getController('Event_EventManager');

		$args = $ci->request->getAll();

		if(!( $seq = $ci->eventModel->insertArgsByHiseq($args, $args['hi_seq']) ) ){
			$data['msg'] = $ci->eventModel->error_message;
		}else{
			if(array_key_exists('codes', $args) && count($args['codes']) > 0){
				foreach($args['codes'] as $k => $code){
					$ci->relationModel->insertCodeBySeq($code, $seq);
				}
			}

			$data['msg'] = '등록되었습니다.';
			$data['sact'] = 'PR';
		}

		return 'script';


	}

	function modifyEvent(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$_sub_controller = & $ci->getController('Event_EventManager');

		$_sub_controller->setInitData($data, $ci);
		$event = $ci->eventModel->getRowBySeq($seq);		
		$ci->eventModel->DB2Form($event);

		$event['category_list'] = $ci->categoryModel->getList();
		$event['category_list_sub'] = $ci->categorySubModel->getList();
		$event['codes'] = $ci->relationModel->getListBySeq($event['ei_seq']);
		if(is_array($event['codes'])) $event['codes'] = array_keys($event['codes']);
		$data['event'] = &$event;

		$ci->addJS('/resource/js/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.js');
		$ci->addCss('/resource/js/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.css');
		return 'event/form';
	}

	function modifyEventOk(&$data, &$ci){
		$args = $ci->request->getAll();		

		if(!is_numeric($args['ei_cash_openmall']) || $args['ei_cash_openmall'] < 1 ){
			$data['msg'] = '오픈몰 차감 캐쉬를 설정해주세요.';
			return 'script';
		}

		if($args['ei_closed_display_flag'] == 'Y' && (!is_numeric($args['ei_cash_closemall']) || $args['ei_cash_closemall'] < 1 )){
			$data['msg'] = '폐쇄몰 차감 캐쉬를 설정해주세요.';
			return 'script';
		}

		if(!$ci->chk->hasText($args['ei_event_type'])){
			$data['msg'] = '이벤트 속성을 선택해주세요.';
			return 'script';
		}		

		if(!$ci->eventModel->updateArgs($args) ){
			$data['msg'] = $ci->eventModel->error_message;
		}else{
			$ci->eventModel->acceptBySeq($args['ei_seq']);
			$ci->relationModel->deleteCodesBySeq($args['ei_seq']);

			if(array_key_exists('codes', $args) && count($args['codes']) > 0){
				foreach($args['codes'] as $k => $code){
					$ci->relationModel->insertCodeBySeq($code, $args['ei_seq']);
				}
			}

			$data['msg'] = '수정되었습니다.';
			$data['sact'] = 'PR';
		}

		return 'script';
	}

	function deleteFile(&$data, &$ci){
		$type = $ci->request->param('type', METHOD_BOTH, false);
		$ei_seq = $ci->request->param('seq', METHOD_BOTH, false);

		$ci->eventModel->deleteFile($ei_seq, $type);
		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = 'PR';


		return 'script';
	}

	function viewImage(&$data, &$ci){
		$_event_controller = & $ci->getController('Event_EventManager');
		return $_event_controller->viewImage($data, $ci);
	}
}
?>

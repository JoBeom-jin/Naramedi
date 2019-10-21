<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PhoneReserve{

	function onInit(&$ci){
		$ci->load->model('Event/EventReserveModel', 'reserveModel');
		$ci->load->model('Members/Hospital', 'hospitalModel');
		$ci->load->model('Event/EventInfoModel', 'eventModel');
		$ci->load->model('CloseShop/CloseShopModel', 'shopModel');
	}


	function index(&$data, &$ci){
		$session_data = array('back_url' => $_SERVER['REQUEST_URI']);
		$ci->session->set_userdata($session_data);

		$ci->load->library('paging');
		$paging = &$ci->paging;

		$paging->addOrder('er_seq', 'desc');
		$paging->addWhere('er_method', '=', 'MED002');

		$list = $ci->reserveModel->listPage($paging);

		if(isArray_($list)){
			$ai_numbers = array();
			foreach($list as $v){
				if(!in_array($v['er_ainum'], $ai_numbers)) $ai_numbers[] = $v['er_ainum'];
			}

			$data['hospital_list'] = $ci->hospitalModel->getListByNumbers($ai_numbers);
		}

		$ci->reserveModel->addStatusFromList($list);
		$data['list'] = &$list;

		$data['paging'] = &$paging;


		return 'reserve/phone_list';
	}

	function insert(&$data, &$ci){
		$data['back_url'] = $ci->session->userdata('back_url');
		$data['_times'] = $ci->reserveModel->_time_code;
		$data['_malls'] = $ci->reserveModel->_mall_code;

		$data['view'] = $ci->reserveModel->getEmptyRow();
		$data['event'] = $ci->eventModel->getEmptyRow();
		$data['closed_mall_list'] = $ci->shopModel->getListOrderByName();		

		return 'reserve/phone_form';
	}

	function insertOk(&$data, &$ci){
		$args = $ci->request->getAll();
		if($ci->reserveModel->insertArgsFromPhone($args)){
			$data['msg'] = '등록되었습니다.';
			$data['sact'] = 'PR';
		}else{
			$data['msg'] = $ci->reserveModel->error_message;
		}
		return 'script';
	}

	function modify(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!is_numeric($seq)) show_error('wrong way to access');

		$data['view'] = $ci->reserveModel->getRowBySeq($seq);


		$data['event'] = $ci->eventModel->getRowBySeq($data['view']['er_eiseq']);
		$data['back_url'] = $ci->session->userdata('back_url');
		$data['_times'] = $ci->reserveModel->_time_code;
		$data['_malls'] = $ci->reserveModel->_mall_code;

		$data['closed_mall_list'] = $ci->shopModel->getListOrderByName();			
		
		return 'reserve/phone_form';
	}

	function modifyOk(&$data, &$ci){
		$args = $ci->request->getAll();
		if(!is_numeric($args['er_seq'])){
			$data['msg'] = '잘못된 접근 방식 입니다';
			return 'script';
		}

		if($ci->reserveModel->updateArgsFromPhoneBySeq($args, $args['er_seq'])){
			$data['msg'] = '수정되었습니다..';
			$data['sact'] = 'PR';
		}else{
			$data['msg'] = $ci->reserveModel->error_message;
		}
		return 'script';

	}


	function search(&$data, &$ci){
		$data['_malls'] = $ci->reserveModel->_mall_code;

		$sch_op = $data['sch_op'] = $ci->request->param('sch_op', METHOD_BOTH, false);
		$sch_text = $data['sch_text'] = $ci->request->param('sch_text', METHOD_BOTH, false);
		$mall = $data['mall'] = $ci->request->param('mall', METHOD_BOTH, false);

		$list = array();		
		if($mall){
			$flag = $data['_malls'][$mall]['flag'];			//폐쇄몰 'Y', 오픈몰 'N'
		}
		
		if($sch_op == 'event_name') $list = $this->_searchByEvent($sch_text, $flag, $ci);
		if($sch_op == 'hospital_name') $list = $this->_searchByHospital($sch_text, $flag, $ci);

		//폐쇄몰일 경우 가격 계산을 따로 한다.
		//폐쇄몰 가격이 수기로 작성되어있을 경우 그대로 사용하고 그렇지 않으면 연산으로 처리한다.
		if(is_array($list) && count($list) > 0){

			
			foreach($list as $k => $v){				
				if($flag == 'Y'){
					if($v['ei_closed_account']  &&  $v['ei_closed_account']  > 0){
						$list[$k]['account'] = $v['ei_closed_account'];
					}else if($v['ei_account'] > 0 && $v['ei_closed_discount'] > 0 ){					
						$list[$k]['account'] = $v['ei_account']- ($v['ei_account'] * ( $v['ei_closed_discount'] / 100 ) );
					}else{
						$list[$k]['account'] = 0;
					}
				}else{
					$list[$k]['account'] = $v['ei_account'];
				}
			}
			
		}

		$data['list'] = &$list;		

		$ci->setFrame('window');
		return 'reserve/search_form';
	}

	private function _searchByEvent($sch_text, $mall = false, &$ci){
		if(!hasText_($sch_text)) return array();

		return $ci->eventModel->getListWithFullInfoByEiname($sch_text, true, $mall);
	}

	private function _searchByHospital($sch_text, $mall = false, &$ci){
		if(!hasText_($sch_text)) return array();
		return $ci->hospitalModel->getListWithFullInfoByHiname($sch_text, true, $mall);
	}

}
?>

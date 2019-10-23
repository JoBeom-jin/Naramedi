<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NormalReserve{

	function onInit(&$ci){
		$ci->load->model('Event/EventReserveModel', 'reserveModel');
		$ci->load->model('Members/Hospital', 'hospitalModel');
	}


	function index(&$data, &$ci){
		$action = $data['bact'] = $ci->request->param('act', METHOD_BOTH, 'reserveList');
		$action = 'do'.ucfirst($action);

		$this->_addData($data, $ci);
		if(!method_exists($this, $action)) show_error('This controller has not method.'.$action);

		return $this->$action($data, $ci);
	}

	/*
	* 미처리 현황
	*/
	function doReserveList(&$data, &$ci){
		$ci->load->library('paging');
		$paging = &$ci->paging;
		$paging->addOrder('er_seq', 'desc');
		$wait_codes = $ci->reserveModel->getWaitCodes();
		$reserve_codes = $ci->reserveModel->getReservedCode();
		$codes_list = array_merge($wait_codes, $reserve_codes);
		$paging->addWhere('er_status', 'in', $codes_list);


		$this->_setSearchOption($data, $ci, $paging);

		$paging_param = array(
				'cols' => '*',
				'table' => 'event_reserve left join event_info on ei_seq=er_eiseq left join agency_info on er_ainum = ai_number',
			);
		$list = $ci->reserveModel->listPage($paging, $paging_param);

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
		$session = array('back_url' => '/index.php/Manager/contents/reserv_normal/index');
		$ci->session->set_userdata($session);

		return 'reserve/reserve_list';
	}


	/*
	* 전체 미처리 목록 다운로드
	*/
	function downExcel(&$data, &$ci){

		set_time_limit(0);
		ini_set('memory_limit','-1');
		$ci->load->library('excelxml');

		$ci->excelxml->docAuthor('okMedi');

		$sheet = $ci->excelxml->addSheet('sheet1');

		$format = $ci->excelxml->addStyle('StyleHeader');
		$format->fontSize(12);
		$format->fontBold();
		$format->bgColor('#333333');
		$format->fontColor('#FFFFFF');
		$format->alignHorizontal('Center');
		$format->alignVertical('Center');
		$format->border();


		$wait_codes = $ci->reserveModel->getWaitCodes();
		$reserve_codes = $ci->reserveModel->getReservedCode();
		$codes_list = array_merge($wait_codes, $reserve_codes);

		$codes = array();
		foreach($codes_list as $k => $v){
			$codes[] = "'".$v."'";
		}

		$wheres = 'er_status in ('.implode(', ', $codes).')';

		$sql = "select * from event_reserve left join event_info on ei_seq=er_eiseq left join agency_info on ai_number=er_ainum where {$wheres} order by er_seq desc";
		$list =  $ci->reserveModel->listAllBySql($sql);

		if(isArray_($list)){
			$ai_numbers = array();
			foreach($list as $v){
				if(!in_array($v['er_ainum'], $ai_numbers)) $ai_numbers[] = $v['er_ainum'];
			}

			$hospital_list = $ci->hospitalModel->getListByNumbers($ai_numbers);
			$ci->reserveModel->addStatusFromList($list);
		}

		$sheet->writeString(1,1,'NO','StyleHeader');
		$sheet->writeString(1,2,'몰','StyleHeader');
		$sheet->writeString(1,3,'상태','StyleHeader');
		$sheet->writeString(1,4,'예약방법','StyleHeader');
		$sheet->writeString(1,5,'신청자명','StyleHeader');
		$sheet->writeString(1,6,'전화번호','StyleHeader');
		$sheet->writeString(1,7,'아이디','StyleHeader');
		$sheet->writeString(1,8,'검진기관명','StyleHeader');
		$sheet->writeString(1,9,'이벤트명','StyleHeader');
		$sheet->writeString(1,10,'예약날짜','StyleHeader');
		$sheet->writeString(1,11,'구분','StyleHeader');

		$row_num = 1;
		if(isArray_($list)){
			$_malls = $ci->reserveModel->_mall_code;
			$_status = $ci->reserveModel->_status_code;
			$_method = $ci->reserveModel->_method_code;
			$_times = $ci->reserveModel->_time_code;

			foreach($list as $k => $v){
				$ei_name = '없음';
				if(array_key_exists('ei_name', $v) && $v['ei_name']){
					$ei_name = $v['ei_name'];
				}
				$hos_name = $v['ai_name'].'(삭제됨)';
				if(isset($hospital_list[$v['er_ainum']]['hi_open_name'])) $hos_name = $hospital_list[$v['er_ainum']]['hi_open_name'];

				$row_num++;
				$sheet->writeString($row_num,1,count($list)-$row_num+2);
				$sheet->writeString($row_num,2,$_malls[$v['er_mall']]['name']);
				$sheet->writeString($row_num,3,$_status[$v['er_status']]['status']);
				$sheet->writeString($row_num,4,$_method[$v['er_method']]['name']);
				$sheet->writeString($row_num,5,$v['er_name']);
				$sheet->writeString($row_num,6,$v['er_phone']);
				$sheet->writeString($row_num,7,$v['er_meid']);
				$sheet->writeString($row_num,8,$hos_name);
				$sheet->writeString($row_num,9,$ei_name);
				$sheet->writeString($row_num,10,date('Y.m.d', $v['er_ctime']));
				$sheet->writeString($row_num,11,$v['status']);
			}
		}

		$filename = date('Y_m_d').'_reserve_list.xls';

		$ci->excelxml->sendHeaders($filename);
		$ci->excelxml->writeData();
		exit;
	}


	/*
	* 누적현황
	*/
	function doResultList(&$data, &$ci){
		$ci->load->library('paging');
		$paging = &$ci->paging;

		$paging->addOrder('er_seq', 'desc');
		$codes_list = $list = $ci->reserveModel->getCompleteCodes();
		$paging->addWhere('er_status', 'in', $codes_list);

		$this->_setSearchOption($data, $ci, $paging);
		$paging_param = array(
				'cols' => '*',
				'table' => 'event_reserve left join event_info on ei_seq=er_eiseq left join agency_info on er_ainum = ai_number',
			);
		$list = $ci->reserveModel->listPage($paging, $paging_param);

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

		$session = array('back_url' => '/index.php/Manager/contents/reserv_normal/index?act=resultList');
		$ci->session->set_userdata($session);

		return 'reserve/result_list';
	}


	/*
	* 누적현황 엑셀 다운로드
	*/
	function downExcelForResult(&$data, &$ci){
		$codes_list = $list = $ci->reserveModel->getCompleteCodes();
		$codes = array();
		foreach($codes_list as $k => $v){
			$codes[] = "'".$v."'";
		}

		$wheres = "er_status in (". implode(',', $codes).")";
		$sql = "select * from event_reserve left join event_info on ei_seq=er_eiseq left join agency_info on er_ainum = ai_number where {$wheres} order by er_seq desc";
		$list = $ci->reserveModel->listAllBySql($sql);

		if(isArray_($list)){
			$ai_numbers = array();
			foreach($list as $v){
				if(!in_array($v['er_ainum'], $ai_numbers)) $ai_numbers[] = $v['er_ainum'];
			}

			$hospital_list = $ci->hospitalModel->getListByNumbers($ai_numbers);
			$ci->reserveModel->addStatusFromList($list);
		}

		set_time_limit(0);
		ini_set('memory_limit','-1');
		$ci->load->library('excelxml');

		$ci->excelxml->docAuthor('okMedi');

		$sheet = $ci->excelxml->addSheet('sheet1');

		$format = $ci->excelxml->addStyle('StyleHeader');
		$format->fontSize(12);
		$format->fontBold();
		$format->bgColor('#333333');
		$format->fontColor('#FFFFFF');
		$format->alignHorizontal('Center');
		$format->alignVertical('Center');
		$format->border();


		$sheet->writeString(1,1,'NO','StyleHeader');
		$sheet->writeString(1,2,'몰','StyleHeader');
		$sheet->writeString(1,3,'상태','StyleHeader');
		$sheet->writeString(1,4,'예약방법','StyleHeader');
		$sheet->writeString(1,5,'신청자명','StyleHeader');
		$sheet->writeString(1,6,'전화번호','StyleHeader');
		$sheet->writeString(1,7,'아이디','StyleHeader');
		$sheet->writeString(1,8,'검진기관명','StyleHeader');
		$sheet->writeString(1,9,'이벤트명','StyleHeader');
		$sheet->writeString(1,10,'예약날짜','StyleHeader');
		$sheet->writeString(1,11,'구분','StyleHeader');

		$row_num = 1;
		if(isArray_($list)){
			$_malls = $ci->reserveModel->_mall_code;
			$_status = $ci->reserveModel->_status_code;
			$_method = $ci->reserveModel->_method_code;
			$_times = $ci->reserveModel->_time_code;

			foreach($list as $k => $v){
				$ei_name = '없음';
				if(array_key_exists('ei_name', $v) && $v['ei_name']){
					$ei_name = $v['ei_name'];
				}

				$hos_name = $v['ai_name'].'(삭제됨)';
				if(isset($hospital_list[$v['er_ainum']]['hi_open_name'])) $hos_name = $hospital_list[$v['er_ainum']]['hi_open_name'];

				$row_num++;
				$sheet->writeString($row_num,1,count($list)-$row_num+2);
				$sheet->writeString($row_num,2,$_malls[$v['er_mall']]['name']);
				$sheet->writeString($row_num,3,$_status[$v['er_status']]['status']);
				$sheet->writeString($row_num,4,$_method[$v['er_method']]['name']);
				$sheet->writeString($row_num,5,$v['er_name']);
				$sheet->writeString($row_num,6,$v['er_phone']);
				$sheet->writeString($row_num,7,$v['er_meid']);
				$sheet->writeString($row_num,8,$hos_name);
				$sheet->writeString($row_num,9,$ei_name);
				$sheet->writeString($row_num,10,date('Y.m.d', $v['er_ctime']));
				$sheet->writeString($row_num,11,$v['status']);
			}
		}

		$filename = date('Y_m_d').'_reserve_list_result.xls';

		$ci->excelxml->sendHeaders($filename);
		$ci->excelxml->writeData();
		exit;
	}

	/*
	* 예약정보 상세보기
	*/
	function viewReserve(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!is_numeric($seq)){
			$data['msg'] = '잘못된 접근입니다.';
			return 'script';
		}

		$data['reserve'] = $ci->reserveModel->getRowBySeqWithEvent($seq);
		$data['reserve']['status'] = $ci->reserveModel->getStatustFromRow($data['reserve']);
		$data['hospital'] = $ci->hospitalModel->getRowByNumber($data['reserve']['er_ainum']);
		$this->_addData($data, $ci);

		$ci->addJS('/resource/js/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.js');
		$ci->addCss('/resource/js/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.css');

		$data['back_url'] = $ci->session->userdata('back_url');

		return 'reserve/view_reserve';
	}

	function modifyOk(&$data, &$ci){
		$args = $ci->request->getAll();
		if($args['base_status'] == 'wait'){
			$args['er_status'] = $args['wait_select'];
		}else if($args['base_status'] == 'reserve'){
			$args['er_status'] = $args['reserve_select'];
		}

		if($ci->reserveModel->modifyBySeq($args, $args['er_seq'])){
			$data['msg'] = "수정완료";
			return 'script';
		}else{
			$data['msg'] = $ci->reserveModel->error_message;
		}

	}

	function sendSMS(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$ci->load->model('Sms/MessageModel', 'smsModel');
		if(is_numeric($seq)){
			$reserve = $ci->reserveModel->getRowBySeqWithHospital($seq);
			$send_phone = $reserve['hi_revmng_phone'];
			$user_name = $reserve['er_name'];
			$question_date = date('m월 d일', $reserve['er_ctime']);

			$ci->smsModel->sendAlimTalk2HospitalManager($send_phone, $user_name, $question_date);
		}
		$data['msg'] = '발송되었습니다.';
		return 'script';
	}

	function deleteOk(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$ci->reserveModel->deleteBySeq($seq);

		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = 'PR';
		return 'script';
	}


	private function _addData(&$data, &$ci){
		$data['_malls'] = $ci->reserveModel->_mall_code;
		$data['_status'] = $ci->reserveModel->_status_code;
		$data['_method'] = $ci->reserveModel->_method_code;
		$data['_times'] = $ci->reserveModel->_time_code;
	}

	private function _setSearchOption(&$data, &$ci, &$paging){
		$sch_mall = $data['sch_mall'] = $ci->request->param('sch_mall', METHOD_BOTH, false);
		$sch_method = $data['sch_method'] = $ci->request->param('sch_method', METHOD_BOTH, false);
		$sch_type = $data['sch_type'] = $ci->request->param('sch_type', METHOD_BOTH, false);
		$sch_status = $data['sch_status'] = $ci->request->param('sch_status', METHOD_BOTH, false);
		$sch_op = $data['sch_op'] = $ci->request->param('sch_op', METHOD_BOTH, false);
		$sch_text = $data['sch_text'] = $ci->request->param('sch_text', METHOD_BOTH, false);

		$data['add_url'] = "sch_mall={$sch_mall}&amp;sch_method={$sch_method}&amp;sch_type={$sch_type}&amp;sch_status={$sch_status}&amp;sch_op={$sch_op}&amp;sch_text={$sch_text}";

		if(hasText_($sch_mall)) $paging->addWhere('er_mall','=', $sch_mall);
		if(hasText_($sch_method)) $paging->addWhere('er_method','=', $sch_method);

		if(hasText_($sch_type)){
			$_status_codes = array();
			$code_list = $ci->reserveModel->_status_code;

			if($sch_type == 'wait'){
				foreach($code_list as $k => $v){
					if($v['status'] == '대기') $_status_codes[] = $k;
				}
			}else if($sch_type == 'reserve'){
				foreach($code_list as $k => $v){
					if($v['status'] == '예약') $_status_codes[] = $k;
				}
			}

			$paging->addWhere('er_status','in', $_status_codes );
		}

		if(hasText_($sch_status)) $paging->addWhere('er_status','=', $sch_status);

		if(hasText_($sch_op) && hasText_($sch_text)){
			if($sch_op == 'er_name'){
				$paging->addWhere('er_name', 'like', $sch_text);
			}else if($sch_op == 'er_meid'){
				$paging->addWhere('er_meid', 'like', $sch_text);
			}else if($sch_op == 'ai_name'){
				$ci->load->model('Event/EventInfoModel', 'eventModel');
				$seqs = $ci->eventModel->getListBySearchName($sch_text);
				$paging->addWhere('er_eiseq', 'in', $seqs);
			}else if($sch_op == 'ai_number'){
				$ci->load->model('Event/EventInfoModel', 'eventModel');
				$seqs = $ci->eventModel->getListBySearchNumber($sch_text);
				$paging->addWhere('er_eiseq', 'in', $seqs);
			}
		}

	}
}
?>

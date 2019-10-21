<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgencyManager{	

	private $_Api = false;		//공공정보 포털 API
	
	function onInit(&$ci){
		$ci->load->model('Agency/AgencyModel', 'AgencyModel');
		$ci->load->model('Agency/AgencyParkModel', 'ParkModel');
		$ci->load->model('Agency/AgencyTrafficModel', 'TrafficModel');
		$ci->load->model('Agency/AgencyImageModel', 'imageModel');
		$ci->load->model('Members/Hospital', 'hospitalMember');		
		$ci->load->library('Data/HospitalApi', false, '_Api');
		$this->_Api = &$ci->_Api;
	}	

	function index(&$data, &$ci){
		
		$data['delete_flag'] = false;
		$data['ai_name'] = '';
		$data['ai_addr_text1'] = '';
		$data['ai_addr_text2'] = '';

		$ci->load->library('Paging');
		$paging = &$ci->paging;

		$order_field = $ci->request->param('order', METHOD_GET, false);
		$order_op = $ci->request->param('op', METHOD_GET, false);

		if(!$ci->chk->hasText($order_field)) $paging->setOrder('ai_seq', 'desc');		
		else{						
			$paging->setOrder($order_field, $order_op);			
			$paging->addUrl("order={$order_field}&amp;op={$order_op}");
			$data['order'] = $order_field;
			$data['op'] = $order_op;
		}	

		$sch_addr1 = $ci->request->param('ai_addr_text1', METHOD_GET, false);
		$sch_addr2 = $ci->request->param('ai_addr_text2', METHOD_GET, false);
		$ai_name = $ci->request->param('ai_name', METHOD_GET, false);

		$data['sido'] = $ci->AgencyModel->getSido();

		if($ci->chk->hasText($sch_addr1)){
			$paging->addWhere('ai_addr_text1', '=', urldecode($sch_addr1));
			$paging->addUrl("ai_addr_text1={$sch_addr1}");
			$data['ai_addr_text1'] = urldecode($sch_addr1);
			$data['sigungu'] = $ci->AgencyModel->getSigungu($data['ai_addr_text1']);
		}

		if($ci->chk->hasText($sch_addr2)){
			$paging->addWhere('ai_addr_text2', '=', urldecode($sch_addr2));
			$paging->addUrl("ai_addr_text2={$sch_addr2}");
			$data['ai_addr_text2'] = urldecode($sch_addr2);
		}	

		if($ci->chk->hasText($ai_name)){
			$paging->addWhere('ai_name', 'like', $ai_name);
			$paging->addUrl("ai_name={$ai_name}");
			$data['ai_name'] = $ai_name;
		}		

		$page = $ci->request->param('q_page', METHOD_BOTH, 1);
		$data['back_url'] = urlencode($data['menu_url'].'/'.$data['act'].'?'.$paging->getUrl($page));

		$paging_param = array(
				'cols' => '*',
				'table' => 'agency_info left join agency_park on ap_aiseq = ai_seq left join agency_traffic on at_aiseq = ai_seq'
			);
		$data['list'] = $ci->AgencyModel->listPage($paging, $paging_param);
		$data['accept_list'] = $this->_getAffiliatedList($data['list'], $ci);
		
		$data['photoes'] = $this->_getHasPhoto($data['list'], $ci);

		$data['paging'] = &$paging;	
		
		$this->_addTabs($data, $ci);
		return 'agency/manager/list';
	}

	function duplicate(&$data, &$ci){
		$sql = "select ai_seq, ai_number, count(*) as num from agency_info  group by ai_number having count(*) > 1";
		$list = $ci->AgencyModel->listAllBySql($sql, 'ai_number');
		$numbers = array_keys($list);	

		$data['delete_flag'] = 'Y';

		$data['ai_name'] = '';
		$data['ai_addr_text1'] = '';
		$data['ai_addr_text2'] = '';

		$ci->load->library('Paging');
		$paging = &$ci->paging;

		$paging->setOrder('ai_number', 'desc');

//		$order_field = $ci->request->param('order', METHOD_GET, false);
//		$order_op = $ci->request->param('op', METHOD_GET, false);

//		if(!$ci->chk->hasText($order_field)) $paging->setOrder('ai_seq', 'desc');		
//		else{						
//			$paging->setOrder($order_field, $order_op);			
//			$paging->addUrl("order={$order_field}&amp;op={$order_op}");
//			$data['order'] = $order_field;
//			$data['op'] = $order_op;
//		}	

		$sch_addr1 = $ci->request->param('ai_addr_text1', METHOD_GET, false);
		$sch_addr2 = $ci->request->param('ai_addr_text2', METHOD_GET, false);
		$ai_name = $ci->request->param('ai_name', METHOD_GET, false);

		$data['sido'] = $ci->AgencyModel->getSido();

		$paging->addWhere('ai_number', 'in', $numbers);

		if($ci->chk->hasText($sch_addr1)){
			$paging->addWhere('ai_addr_text1', '=', urldecode($sch_addr1));
			$paging->addUrl("ai_addr_text1={$sch_addr1}");
			$data['ai_addr_text1'] = urldecode($sch_addr1);
			$data['sigungu'] = $ci->AgencyModel->getSigungu($data['ai_addr_text1']);
		}

		if($ci->chk->hasText($sch_addr2)){
			$paging->addWhere('ai_addr_text2', '=', urldecode($sch_addr2));
			$paging->addUrl("ai_addr_text2={$sch_addr2}");
			$data['ai_addr_text2'] = urldecode($sch_addr2);
		}	

		if($ci->chk->hasText($ai_name)){
			$paging->addWhere('ai_name', 'like', $ai_name);
			$paging->addUrl("ai_name={$ai_name}");
			$data['ai_name'] = $ai_name;
		}

		$page = $ci->request->param('q_page', METHOD_BOTH, 1);
		$data['back_url'] = urlencode($data['menu_url'].'/'.$data['act'].'?'.$paging->getUrl($page));

		$data['list'] = $ci->AgencyModel->listPage($paging);
		$data['accept_list'] = $this->_getAffiliatedList($data['list'], $ci);
		
		$data['photoes'] = $this->_getHasPhoto($data['list'], $ci);

		$data['paging'] = &$paging;		
		$this->_addTabs($data, $ci);
		return 'agency/manager/list';
	}

	/*
	* park와 traffic 데이터 중 중복된 데이터를 삭제한다.
	*/
	function resortData(&$data, &$ci){
		$sql = "select at_aiseq, count(*) as cnt from agency_traffic group by at_aiseq ";
		$traffic_list = $ci->TrafficModel->listAllBySql($sql);
		if(is_array($traffic_list) && count($traffic_list) > 0){
			foreach($traffic_list as $k => $v){
				if($v['cnt'] > 1){					
					$ci->TrafficModel->removeDuplicate($v['at_aiseq']);
				}
			}
		}	
		
		$sql = "select ap_aiseq, count(*) as cnt from agency_park group by ap_aiseq ";
		$park_list = $ci->ParkModel->listAllBySql($sql);
		if(is_array($park_list) && count($park_list) > 0){
			foreach($park_list as $k => $v){
				if($v['cnt'] > 1){					
					$ci->ParkModel->removeDuplicate($v['ap_aiseq']);
				}
			}
		}	
	}

	/* 각각의 병원 추가 정보를 API에서 불러오고, DB 정보를 갱신함 */
	function addInfo(&$data, &$ci){

		$this->_addTabs($data, $ci);
		return 'agency/manager/add_info';
	}

	/* add tab menu html*/
	private function _addTabs(&$data, &$ci){
		$data['html_taps'] = $ci->load->view('/manager_views/agency/manager/common/tabs', $data, true);		
	}

	/*
	* 전체 수정 - 기존 정보 삭제
	*/
	function addInfoModifyAll(&$data, &$ci){		
		$ignore_flag = $ci->request->param('flag', METHOD_BOTH, true);		
		$agency_list = & $this->_listAllAgencyInfo($ci);			
		if(is_array($agency_list) && count($agency_list) > 0 ){
			foreach($agency_list as $k => $v){						

				$ai_seq = $v['ai_seq'];
				$ai_number = $v['ai_number'];
				$ai_name = $v['ai_name'];								
				
				$traffic = $this->_getTraffic($ai_number);						
				$work =  $this->_getWork($ai_number);
				
				if($traffic) $this->_trafficInsertOrUpdate($ci, $ai_seq, $traffic, $ignore_flag);				
				if($work) $this->_workInsertOrUpdate($ci, $ai_seq, $work, $ignore_flag);
				
				$args['ai_adddata_utime'] = time();
				$where = array('ai_seq' => $ai_seq);
				$ci->AgencyModel->update($args, $where);
			}
		}
		
		$data['msg'] = '정상 등록되었습니다.';
		return 'script';
	}

	/*
	* 개별 수정 목록 출력
	*/	
	function individual(&$data, &$ci){
		$time_field = array('ap_sat_jin_start', 'ap_sat_jin_end', 'ap_sat_rsv_start', 'ap_sat_rsv_end', 'ap_lun_start', 'ap_lun_end', 'ap_jin_start', 'ap_jin_end', 'ap_rsv_start', 'ap_rsv_end');
		$this->index($data, $ci);
		if(is_array($data['list']) && count($data['list']) > 0){
			foreach($data['list'] as $k => $v){
				foreach($time_field as $time_name){
					if(isset($v[$time_name])){
						$data['list'][$k][$time_name] = $this->_hhii($v[$time_name]);						
					}
				}	
				$ci->AgencyModel->setStringByArgs($data['list'][$k]);
			}
		}		
		
		return 'agency/manager/add_info';
	}

	function individualAdd(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!$seq){
			$data['msg'] = '잘못된 접근입니다.';
			return 'script';
		}

		$where = array('ai_seq' => $seq);
		$agency = $ci->AgencyModel->row('*', $where);

		$ai_seq = $agency['ai_seq'];
		$ai_number = $agency['ai_number'];
		$ai_name = $agency['ai_name'];								
		
		$traffic = $this->_getTraffic($ai_number);						
		$work =  $this->_getWork($ai_number);

		if($traffic) $this->_trafficInsertOrUpdate($ci, $ai_seq, $traffic, true);				
		if($work) $this->_workInsertOrUpdate($ci, $ai_seq, $work, true);
		
		$args['ai_adddata_utime'] = time();
		$where = array('ai_seq' => $ai_seq);
		$ci->AgencyModel->update($args, $where);		

		$data['msg'] = '정상 등록되었습니다.';
		return 'script';
	}

	/*
	* 주소지를 엑셀에 입력된 정보를 바탕으로 입력한다.
	*/
	function addAddr(&$data, &$ci){
		exit;
		$list = $this->_listHasNotSigungu($ci);
		foreach($list as $k => $v){
			if($v['ai_sido_cd'] && $v['ai_sigungu_cd']){
				$result = $this->_Api->getListSigungu($v['ai_sido_cd'], $v['ai_sigungu_cd']);
				exit;
			}
		}
	}

	/*
	* agency list 중 시군구 데이터가 없는 값을 호출
	*/
	function _listHasNotSigungu(&$ci){
		$where = "ai_addr_text1 is null or ai_addr_text1 = '' or ai_addr_text2 is null or ai_addr_text2 = ''";
		return $ci->AgencyModel->listAll('ai_seq, ai_name, ai_sido_cd, ai_sigungu_cd', $where);
	}

	/*
	* 시간 형식을 hhii 형식으로 맞춤
	*/
	private function _hhii($time){
		if(!$time) return false;
		$time = str_pad($time, 4, '0', STR_PAD_RIGHT);
//		$time = substr($time, 0, 2).':'.substr($time, 2,2);
		return $time;
	}


	/*
	* 업무시간 정보를 입력 혹은 업데이트 한다. ( 해당 아이디로 정보가 존재하면 업데이트, 그렇지 않으면 인서트)
	* ignore_flag = true : 기존 정보를 무시하고 덮어쓴다.
	* ignore_flag = false : 기존 정보가 있다면 기존 정보를 유지하고 빈 곳만 채워넣는다.
	*/
	private function _workInsertOrUpdate(&$ci, $seq, &$data, $ignore_flag = false){
		if(!$data || count($data) < 1 || !$seq) return false;
		$where = array('ap_seq' => $seq);
		$row = $ci->ParkModel->row('*', $where);		
		
		if(!$row || count($row) < 1){			
			$ci->ParkModel->insertFromApiResult($data, $seq);			
		}else{			
			$ci->ParkModel->updateFromApiResult($data, $row, $seq, $ignore_flag);			
		}
	}

	/*
	* 교통정보 입력 혹은 업데이트 ( 해당 아이디로 존재하면 업데이트, 그렇지 않으면 인서트)
	* ignore_flag = true : 기존 정보를 무시하고 덮어쓴다.
	* ignore_flag = false : 기존 정보가 있다면 기존 정보를 유지하고 빈 곳만 채워넣는다.
	*/
	private function _trafficInsertOrUpdate(&$ci, $seq, &$data, $ignore_flag = false){
		if(!$data || count($data) < 1 || !$seq) return false;
		$where = array('at_aiseq' => $seq);
		$row = $ci->TrafficModel->row('*', $where);
		

		if(!$row || count($row) < 1){			
			$ci->TrafficModel->insertFromApiResult($data, $seq);			
		}else{			
			$ci->TrafficModel->updateFromApiResult($data, $row, $seq, $ignore_flag);			
		}				
	}

	/*
	* api를 통해 교통 정보를 얻어온다.	
	& nodata : return 값 없음				
	*/
	private function _getTraffic($code){
		if(!$code) return false;		
		$result = $this->_Api->getTrafficDataByCode($code);
		if($result == 'nodata') return false;		
		return $result;
	}

	/*
	* api를 통해 주차 정보를 얻어온다.
	*/
	private function _getWork($code){
		if(!$code) return false;		
		return $this->_Api->getWorkByCode($code);
	}


	/*
	* 등록된 모든 기관 정보 목록을 얻습니다.
	*/
	private function & _listAllAgencyInfo(&$ci){
		$list = $ci->AgencyModel->listAll('ai_seq, ai_number, ai_name');
		return $list;				
	}


	function deleteOk(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_GET, false);
		if(!is_numeric($seq)) return false;

		$where=  array('ai_seq' => $seq);
		$ci->AgencyModel->delete($where);
		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = 'PR';
		return 'script';
	}


	function view(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_GET, false);

		$view = $ci->AgencyModel->getFullInfoBySeq($seq);
		
		$type_string = array();
		$ci->AgencyModel->setStringByArgs($view);
		$data['view'] = $view;
		
		$data['file_list'] = $ci->imageModel->getListByAiseq($view['ai_seq']);

		$data['back_url'] = urlencode($ci->request->param('back_url', METHOD_GET, false));
		return 'agency/manager/view';
	}

	function modify(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_GET, false);
		$data['modify'] = $ci->AgencyModel->getFullInfoBySeq($seq);
		$data['back_url'] = urlencode($ci->request->param('back_url', METHOD_BOTH, false));

		$data['times'] = range(1, 24);
		$data['minuets'] = range(0, 59);
		
		return 'agency/manager/form';
	}

	function modifyOk(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_POST, false);
		$args = $ci->request->getAll();
		$msg = $ci->AgencyModel->updateBySeq($args, $seq);		
		if(!$msg){
			$ci->ParkModel->updateArgsByAiSeq($args, $seq);
			$ci->TrafficModel->updateArgsByAiSeq($args, $seq);
		}

		if($msg) $data['msg'] = $msg;
		else{
			$data['msg'] = '정상적으로 수정되었습니다.';
			$data['sact'] = 'PR';			
		}

		return 'script';
	}

	function insert(&$data, &$ci){
		$back_url = $ci->request->param('back_url', METHOD_GET, false);
		if($back_url) $data['back_url'] = urlencode($back_url);

		$basic_info = $ci->AgencyModel->getEmptyRow();
		$park = $ci->ParkModel->getEmptyRow();
		$traffic = $ci->TrafficModel->getEmptyRow();

		
		$data['times'] = range(1, 24);
		$data['minuets'] = range(0, 59);
		
		$data['modify'] = array_merge($basic_info, $park);
		$data['modify'] = array_merge($data['modify'], $traffic);


		return 'agency/manager/form';
	}

	function insertOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$return = array();
		$msg = $ci->AgencyModel->getSeqAfterInsertArgsDirectly($args, $return_seq);
		if(is_numeric($return_seq)){
			$ci->ParkModel->insertArgsByAiseq($args, $return_seq);
			$ci->TrafficModel->updateArgsByAiSeq($args, $return_seq);
			$data['msg'] = '정상적으로 등록되었습니다.';
			$data['sact'] = 'PR';
			return 'script';
		}
		
		$data['msg'] = $msg;
		return 'script';		
	}


	function modifyFileOK(&$data, &$ci){
		$msg = false;

		
		$file_config = $ci->imageModel->getFileConfig();
		$ci->load->library('FileUpload', $file_config);
		$ci->fileupload->do_multi_upload('upload');		
		
		if($ci->fileupload->hasError()){
			$ci->fileupload->rollback();
			$errors = $ci->fileupload->getErrors();
			$data['msg'] = '파일 업로드 중 다음과 같은 문제가 발생하였습니다.\n'.implode('\n', $errors);						
		}else{
			$ai_seq = $ci->request->param('seq', METHOD_POST, false);
			$file_data_list = $ci->fileupload->data();
			$ci->imageModel->insertFileListByAiseq($file_data_list, $ai_seq);
			$data['msg'] = '정상적으로 등록되었습니다.';
			$data['sact']= 'PR';
		}

		return 'script';
	}

	function deleteImage(&$data, &$ci){
		$seq = $ci->request->param('fseq', METHOD_GET, false);
		

		$ci->imageModel->deleteAllBySeq($seq);

		$data['msg'] = '정상적으로 삭제되었습니다.';
		$data['sact'] = 'PR';

		return 'script';
	}


	function deleteAgency(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_GET, false);
		

		$ci->AgencyModel->deleteAllBySeq($seq);

		$data['msg'] = '정상적으로 삭제되었습니다.';
		$data['sact'] = 'PR';

		return 'script';
	}


	private function _getAffiliatedList(&$list, &$ci){
		if(!$ci->chk->isArray($list)) return array();
		$keys = array();
		foreach($list as $k => $v){
			$keys[] = $v['ai_number'];			
		}	
		
		return $ci->hospitalMember->getHospitalByNumbers($keys);
	}


	private function _getHasPhoto(&$list, &$ci){
		$seqs_has_photo = array();
		if( $seqs = $this->_getAiseqFromData($list) ) $seqs_has_photo = $ci->imageModel->hasPhotoByAiseqs($seqs);			
		return $seqs_has_photo;		
	}

	private function _getAiseqFromData(&$list){
		$result = false;
		if(is_array($list) && count($list) > 0){
			foreach($list as $k => $v) $result[] = $v['ai_seq'];
		}
		return $result;
	}
}
?>

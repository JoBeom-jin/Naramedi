<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgencyDefault{

	private $_path = false;
	
	function onInit(&$ci){
		$this->_path = $_SERVER['DOCUMENT_ROOT'].'/upload/';
		$ci->load->model('Agency/AgencyDefaultModel', 'defaultModel');
	}

	function index(&$data, &$ci){
		$ci->load->library('Paging');
		$paging = &$ci->paging;
		$paging->setOrder('binary(hd_name)', 'asc');		
		$paging->setWhere('hd_code', '=', 'not found');			

		$sch_text = $data['sch_text'] = $ci->request->param('sch_text', METHOD_BOTH, false);
		if(hasText_($sch_text)) $paging->addWhere('hd_name', 'like', $sch_text);	
		
		$data['total_time'] = $ci->defaultModel->getTotalLestRowByAddTime();


		$data['list'] = $ci->defaultModel->listPage($paging);
		$data['total'] = $paging->totalRows;
		$data['paging'] = &$paging;
		
		return 'agency/default/list';
	}

	/*
	* 추가 정보 자동 입력 ( 검진시간, 예약 시간, 점심시간 등 )
	*/
	function insertAddData(&$data, &$ci){
		$list = $ci->defaultModel->getListForAddData();		

		if(isArray_($list)){
			$ci->load->model('Agency/AgencyParkModel', 'AgencyParkModel');

			foreach($list as $k => $v){
				
				if(is_numeric($v['ai_seq']) && $v['ai_number']  ){

					$ci->load->library('Data/HospitalApi',false, 'hosapi');
					$work = $ci->hosapi->getWorkByCode($v['ai_number']);

					if($work == 'nodata'){
						$ci->defaultModel->insertTimeCodeBySeq('complete', $v['hd_seq']);
					}else if($work){
						$args = array();
						$ci->hosapi->setArgsByAddData($args, $work);
						
						if(array_key_exists('ap_satYn', $args)){
							if($args['ap_satYn'] == 1){
								$args['ap_satYn'] = 'N';
							}else{
								$args['ap_satYn'] = 'Y';
							}			
						}else{
							$args['ap_satYn'] = 'N';
						}

						$ci->AgencyParkModel->updateArgsByAiseq($args, $v['ai_seq']);
						$ci->defaultModel->insertTimeCodeBySeq('complete', $v['hd_seq']);	
					}else{
						$data['msg'] = '오늘은 더이상 진행할 수 없습니다';
						break;
					}
				}								
			}
		}

		if(!$data['msg']) $data['msg'] = '완료되었습니다.';

		$data['sact'] = 'PR';
		return 'script';
	}

	function find(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_GET, false);

		$data['default_info'] = $ci->defaultModel->rowBySeq($seq);
		$name = $data['default_info']['hd_name'];
		$addr = $data['default_info']['hd_addr'];

		$ci->load->library('Data/HospitalApi',false, 'hosapi');
		$data['list'] = $ci->hosapi->getDataByName($name);
				
		$ci->setFrame('window');
		return 'agency/default/find_list';
	}

	function insertFromFilnd(&$data, &$ci){
		$number = $ci->request->param('number', METHOD_BOTH, false);
		$hmcNm = $ci->request->param('hmcNm', METHOD_BOTH, false);
		$locAddr = $ci->request->param('locAddr', METHOD_BOTH, false);
		$hd_seq = $ci->request->param('hd_seq', METHOD_BOTH, false);

		if(!$number || !$hmcNm || !$locAddr || !$hd_seq){
			$data['msg'] = '기관 번호가 정의되지 않아 DB에 입력할 수 없습니다.';
			return 'script';
		}

		$ci->load->library('Data/HospitalApi',false, 'hosapi');
		$xml_data = $ci->hosapi->getCodeByNameAddr($hmcNm, $locAddr);
		
		if($xml_data === false){
			$data['msg'] = '오늘은 더이상 진행할 수 없습니다.';				
			$data['sact'] = 'PR';
			return 'script';
		}else{
			if(count($xml_data) > 0){
				$ci->defaultModel->insertCodeBySeq($xml_data['hmcNo'], $hd_seq);

				$ci->load->library('Data/HospitalApi',false, 'hosapi');
				$traffic = $ci->hosapi->getTrafficDataByCode($xml_data['hmcNo']);
				$work = $ci->hosapi->getWorkByCode($xml_data['hmcNo']);	

				$args = array();					
				$ci->hosapi->setArgsByData($args, $xml_data, $traffic, $work);
				
				$ci->load->model('Agency/AgencyModel', 'AgencyModel');					
				$ai_seq = $ci->AgencyModel->getSeqAfterInsertArgs($args);	
				
				if(is_numeric($ai_seq)){					
					$ci->load->model('Agency/AgencyParkModel', 'AgencyParkModel');
					$ci->AgencyParkModel->insertArgsByAiseq($args, $ai_seq);

					$ci->load->model('Agency/AgencyTrafficModel', 'AgencyTrafficModel');
					$ci->AgencyTrafficModel->insertArgsByAiseq($args, $ai_seq);
				}
			}else{
				$ci->defaultModel->insertCodeBySeq('not found', $hd_seq);
			}
		}
		
		$data['msg'] = '등록되었습니다.';
		$data['sact'] = array('POR', 'PCLZ');
		return 'script';
	}

	function autoInsertCode(&$data, &$ci){
		$where = "hd_code is null";
		$order = ' hd_seq desc';
		$list = $ci->defaultModel->listAll('*', $where, $order);
		$ci->load->library('Data/HospitalApi',false, 'hosapi');
		
		foreach($list as $k => $v){
			$xml_data = array();
			$xml_data = $ci->hosapi->getCodeByNameAddr($v['hd_name'], $v['hd_addr']);

			if($xml_data === false){
				$data['msg'] = '오늘은 더이상 진행할 수 없습니다.';				
				$data['sact'] = 'PR';
				return 'script';

			}else{
				if(count($xml_data) > 0){
					$ci->defaultModel->insertCodeBySeq($xml_data['hmcNo'], $v['hd_seq']);

					$ci->load->library('Data/HospitalApi',false, 'hosapi');
					$traffic = $ci->hosapi->getTrafficDataByCode($xml_data['hmcNo']);
					$work = $ci->hosapi->getWorkByCode($xml_data['hmcNo']);	

					$args = array();					
					$ci->hosapi->setArgsByData($args, $xml_data, $traffic, $work);
					
					$ci->load->model('Agency/AgencyModel', 'AgencyModel');					
					$ai_seq = $ci->AgencyModel->getSeqAfterInsertArgs($args);	
					
					if(is_numeric($ai_seq)){					
						$ci->load->model('Agency/AgencyParkModel', 'AgencyParkModel');
						$ci->AgencyParkModel->insertArgsByAiseq($args, $ai_seq);

						$ci->load->model('Agency/AgencyTrafficModel', 'AgencyTrafficModel');
						$ci->AgencyTrafficModel->insertArgsByAiseq($args, $ai_seq);
					}
				}else{
					$ci->defaultModel->insertCodeBySeq('not found', $v['hd_seq']);
				}
			}
		}

		$data['msg'] = '완료되었습니다.';
		$data['sact'] = 'PR';
		return 'script';
	}

	function autoInsertCodeLest(&$data, &$ci){

		$where = "hd_code = 'not found'";
		$order = ' hd_seq desc';
		$list = $ci->defaultModel->listAll('*', $where, $order);
		$ci->load->library('Data/HospitalApi',false, 'hosapi');		

		
		foreach($list as $k => $v){
			$xml_data = array();
			$xml_data = $ci->hosapi->getCodeByNameAddr($v['hd_name'], $v['hd_addr']);

			if($xml_data === false){
				$data['msg'] = '오늘은 더이상 진행할 수 없습니다.';				
				$data['sact'] = 'PR';
				return 'script';

			}else{
				if(count($xml_data) > 0){
					$ci->defaultModel->insertCodeBySeq($xml_data['hmcNo'], $v['hd_seq']);

					$ci->load->library('Data/HospitalApi',false, 'hosapi');
					$traffic = $ci->hosapi->getTrafficDataByCode($xml_data['hmcNo']);
					$work = $ci->hosapi->getWorkByCode($xml_data['hmcNo']);	

					$args = array();					
					$ci->hosapi->setArgsByData($args, $xml_data, $traffic, $work);
					
					$ci->load->model('Agency/AgencyModel', 'AgencyModel');					
					$ai_seq = $ci->AgencyModel->getSeqAfterInsertArgs($args);	
					
					if(is_numeric($ai_seq)){					
						$ci->load->model('Agency/AgencyParkModel', 'AgencyParkModel');
						$ci->AgencyParkModel->insertArgsByAiseq($args, $ai_seq);
						$ci->defaultModel->insertTimeCodeBySeq('complete', $v['hd_seq']);

						$ci->load->model('Agency/AgencyTrafficModel', 'AgencyTrafficModel');
						$ci->AgencyTrafficModel->insertArgsByAiseq($args, $ai_seq);
					}
				}else{
					$ci->defaultModel->insertCodeBySeq('not found', $v['hd_seq']);
				}
			}
		}

		$data['msg'] = '완료되었습니다.';
		$data['sact'] = 'PR';
		return 'script';

	}

	function insertAddr(&$data, &$ci){
		$ci->load->model('Agency/AgencyModel', 'agencymodel');
		$list = $ci->agencymodel->listAll('*');
		foreach($list as $k => $v){
			$where = array('hd_name' => $v['ai_name']);
			$row = $ci->defaultModel->row('*', $where);
			
			$where = array('ai_seq' => $v['ai_seq']);
			$args = array(
					'ai_addr_text1' => $row['hd_addr1'],
					'ai_addr_text2' => $row['hd_addr2'],
				);
			$ci->agencymodel->update($args, $where);			
		}

		$data['msg'] = '등록 되었습니다.';		
		return 'script';
		
	}

	function excel(&$data, &$ci){
		$data['filelist'] = glob($this->_path. "/*.xls");
		return 'agency/default/excel';
	}

	function addExcel(&$data, &$ci){
		$data['filelist'] = glob($this->_path. "add_agency/*.xls");
		return 'agency/default/add_excel';		
	}

	function addExcelOk(&$data, &$ci){
		$option = $ci->request->param('option', METHOD_GET, false);
		if(!$option) return false;

		$ci->load->library('Util/Excel', 'excel');

		$filelist = glob($this->_path. "add_agency/*.xls");


		$file_num = 0;
		foreach($filelist as $k => $v){			
			if($option == 'last'){	
				if($file_num <= 10){
					$file_num ++;
					continue;
				}
			}else if($option == 'first'){
				if($file_num > 10){
					break;
				}else{
					$file_num ++;
				}
			}else{
				exit;
			}

			$objPHPExcel = PHPExcel_IOFactory::load($v);
			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			
			
			if($ci->chk->isArray($sheetData)){
				

				
				foreach($sheetData as $k => $v){
					$where = array('hd_name'=>$v['B'], 'hd_addr'=>$v['F']);
					if($ci->defaultModel->count($where) > 0) {
						//이미 존재하는 기관
						continue;
					}

					if(( $v['H'] == '미실시' && $v['J'] == '미실시' && $v['K'] == '미실시' && $v['L'] == '미실시' && $v['M'] == '미실시' && $v['N'] == '미실시' && $v['O'] = '미실시' ) ||  ( ( $v['H'] == '미실시' && $v['I'] == '미실시' && $v['K'] == '미실시' && $v['L'] == '미실시' && $v['M'] == '미실시' && $v['N'] == '미실시' && $v['O'] = '미실시' ) ) ){
						//제외해야할 기관
						continue;
					}else{
						$ci->defaultModel->insertAddRow($v);
					}

				}							
			}

			
		}	
		

		$data['sact'] = 'PR';
		$data['msg'] = 'DB로 등록되었습니다.';
		return 'script';
	}

	function excelOK(&$data, &$ci){
		$file_name = $ci->request->param('file', METHOD_GET, false);
		$ci->load->library('Util/Excel', 'excel');
		$objPHPExcel = PHPExcel_IOFactory::load($this->_path.$file_name);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

		if($ci->chk->isArray($sheetData)){
			foreach($sheetData as $k => $v){
				$ci->defaultModel->insertRow($v);
			}
		}

		$data['sact'] = 'PR';
		$data['msg'] = 'DB로 등록되었습니다.';
		return 'script';
				
	}

	function complete(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$ci->defaultModel->insertCodeBySeq('not found', $v['hd_seq']);
		$where = array('hd_seq' => $seq);
		$args['hd_code'] = 'direct';
		$ci->defaultModel->update($args, $where);

		$data['sact'] = 'PR';
		$data['msg'] = '처리되었습니다.';
		return 'script';	
	}

	/*
	* 검진기관 개별 입력 메뉴
	* 검진기관 이름으로 검진기관을 검색하고, 원하는 검진기관을 DB로 입력한다.
	*/
	function searchData(&$data, &$ci){
		$data['sch_name'] = $sch_name = $ci->request->param('sch_name', METHOD_BOTH, false);

		if($sch_name && mb_strlen($sch_name) < 2){
			$data['error_message'] = '검색어는 2글자 이상이어야 합니다.';
		}else if($sch_name){

			$ci->load->library('Data/HospitalApi',false, 'hosapi');
			$data['list'] = $ci->hosapi->getDataByName($sch_name);
		}
		
		$ci->setFrame('window');
		return 'agency/default/search_data';
	}

	/*
	* 선택된 검진기관 정보를 DB로 입력
	*/
	function searchDataInsertDb(&$data, &$ci){		
		$number = $ci->request->param('number', METHOD_BOTH, false);
		$hmcNm = $ci->request->param('hmcNm', METHOD_BOTH, false);
		$locAddr = $ci->request->param('locAddr', METHOD_BOTH, false);

		if(!$number || !$hmcNm || !$locAddr){
			$data['msg'] = '기관 번호가 정의되지 않아 DB에 입력할 수 없습니다.';
			return 'script';
		}

		$ci->load->library('Data/HospitalApi',false, 'hosapi');
		$xml_data = $ci->hosapi->getCodeByNameAddr($hmcNm, $locAddr);
		if($number != $xml_data['hmcNo'] || $hmcNm != $xml_data['hmcNm'] || $locAddr != $xml_data['locAddr']){
			$data['msg'] = '기관정보가 정확하지 않아 DB 입력에 실패하였습니다. 관리자에게 문의하세요.';
			return 'script';
		}

		$traffic = $ci->hosapi->getTrafficDataByCode($xml_data['hmcNo']);
		$work = $ci->hosapi->getWorkByCode($xml_data['hmcNo']);	

		$args = array();					
		$ci->hosapi->setArgsByData($args, $xml_data, $traffic, $work);
		
		$ci->load->model('Agency/AgencyModel', 'AgencyModel');					
		$ai_seq = $ci->AgencyModel->getSeqAfterInsertArgs($args);	
		
		if(is_numeric($ai_seq)){					
			$ci->load->model('Agency/AgencyParkModel', 'AgencyParkModel');
			$ci->AgencyParkModel->insertArgsByAiseq($args, $ai_seq);

			$ci->load->model('Agency/AgencyTrafficModel', 'AgencyTrafficModel');
			$ci->AgencyTrafficModel->insertArgsByAiseq($args, $ai_seq);
		}
		
		$data['msg'] = '등록되었습니다.';
		$data['sact'] = 'PCLZ';
		return 'script';		
	}
}
?>

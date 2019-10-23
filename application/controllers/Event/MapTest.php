<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MapTest{
	
	function onInit(&$ci){	
		$ci->load->model('Members/Hospital', 'hospitalModel');
		$ci->load->model('Agency/AgencyModel', 'agencyModel');
		$ci->load->model('Agency/AgencyImageModel', 'imageModel');
	}
	
	function index(&$data, &$ci){	
		$data['ai_name'] = $ai_name = $ci->request->param('ai_name', METHOD_BOTH, false);

		$data['list'] = array();
		$data['total'] = 0;
		$data['paging'] = false;

		if(hasText_($ai_name)){
			$ci->load->library('paging');
			$paging = &$ci->paging;
			$paging->setPageSize(10);
			$paging->addWhere('ai_name', 'like', $ai_name);			
			$list = $ci->agencyModel->listPage($paging);
			$data['total'] = $paging->totalRows;

			$data['list'] = &$list;
			$data['paging'] = &$paging;

			$seqs = array();
			$numbers = array();

			if($data['total'] > 0){
				foreach($list as $k => $v){
					$seqs[] = $v['ai_seq'];
					$numbers[] = $v['ai_number'];
				}

				$data['thums'] = $ci->imageModel->getThumByAiseqs($seqs);
				$hospital_list = $ci->hospitalModel->getHospitalByNumbersWithEvent($numbers);

				foreach($list as $k => $v){
					if(array_key_exists($v['ai_number'], $hospital_list)){
						$list[$k]['is_alied'] = true;				//제휴 체크
					}else{
						$list[$k]['is_alied'] = false;				//제휴 체크
					}

					if(array_key_exists($v['ai_number'], $hospital_list) && $hospital_list[$v['ai_number']]['event_cnt'] > 0){
						$list[$k]['has_event'] = true;				//이벤트 여부?
					}else{
						$list[$k]['has_event'] = false;
					}					
				}

			}
			
		}
		
		return 'event/search_map2';
	}	

	function searchLat(&$data, &$ci){
		$ne = $ci->request->param('ne', METHOD_BOTH, false);
		$sw = $ci->request->param('sw', METHOD_BOTH, false);
		$name = $ci->request->param('name', METHOD_BOTH, false);

		$ci->load->model('Agency/AgencyModel', 'agencyModel');

		if($ne && $sw){
			$ne_string = str_replace(' ', '', str_replace(')', '', str_replace('(', '', $ne)));
			$sw_string = str_replace(' ', '', str_replace(')', '', str_replace('(', '', $sw)));

			list($ne_x, $ne_y) = explode(',', $ne_string);
			list($sw_x, $sw_y) = explode(',', $sw_string);
			
			$list = $ci->agencyModel->getListByMap($ne_x, $ne_y, $sw_x, $sw_y);
		}else if($name){
			$list = $ci->agencyModel->searchByName($name);
		}else show_error('do not that.');
		

		$seqs = array();
		$numbers = array();
		if(isArray_($list)){
			foreach($list as $k => $v){
				$seqs[] = $v['ai_seq'];
				$numbers[] = $v['ai_number'];
			}
		}
		
		$ci->load->helper('my_file');
		$ci->load->model('Agency/AgencyImageModel', 'imageModel');
		$ci->load->model('Members/Hospital', 'hospitalModel');
		$hospital_list = $ci->hospitalModel->getHospitalByNumbersWithEvent($numbers);
		$image_list = $ci->imageModel->getListByAiseqs($seqs);
		$image_list = $this->reSortImages($image_list);

		$json = $this->makeJsonFormArray($list, $image_list, $hospital_list);
	
		$ci->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($json);
		exit;	
	}

	function makeJsonFormArray(&$list, &$image_list, &$hospital_list){
		$result['data'] = array();
		if(!isArray_($list)) return $result;

		foreach($list as $k => $v){
			$data = array();
			$data['id'] = $k+1;
			$data['ai_seq'] = $v['ai_seq'];
			if(array_key_exists($v['ai_number'], $hospital_list)){
				$data['title'] = $hospital_list[$v['ai_number']]['hi_open_name'];
			}else{
				$data['title'] = $v['ai_name'];
			}

			$data['location'] = $v['ai_addr'];
			$data['latitude'] = $v['ai_x'];
			$data['longitude'] = $v['ai_y'];
			
			if(array_key_exists($v['ai_number'], $hospital_list)){
				$data['type'] = '<img src="/resource/images/medical/icons/icon_alied.png" alt="제휴업체">';				//제휴 체크
				$data['type_icon'] = '/resource/assets/icons/ok.png';	//제휴여부
			}else{
				$data['type'] = '';				//제휴 체크
				$data['type_icon'] = '/resource/assets/icons/notok.png';	//제휴여부
			}

			$data['rating'] = 4;				//인기도? 의미 불명

			$data['gallery'] = array();			//병원 이미지
			if(array_key_exists($v['ai_seq'], $image_list)){
				$data['gallery'] = $image_list[$v['ai_seq']];			//병원 이미지
			}else{
				$data['gallery'][] = '/resource/images/medical/map_images/none_image.png';
			}

			$data['date_created'] = date('Y-m-d');		//생성일

			if(array_key_exists($v['ai_number'], $hospital_list) && $hospital_list[$v['ai_number']]['event_cnt'] > 0){
				$data['price'] = '<img src="/resource/images/medical/icons/icon_event.png" alt="이벤트 중" >';				//제휴 체크
			}else{
				$data['price'] = '';
			}

			$result['data'][] = $data;
		}

		
		return $result;		
	}

	function reSortImages(&$images){
		if(!isArray_($images)) return array();		

		$result = array();
		foreach($images as $k => $v){
			$result[$v['aim_aiseq']][] = path2url_($v['aim_path']);
		}

		return $result;
	}
}
?>

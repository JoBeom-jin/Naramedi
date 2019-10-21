<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MapSearch2{

	private $ci = false;
	function onInit(&$ci){
		$ci->load->model('Members/Hospital', 'hospitalModel');
		$ci->load->model('Agency/AgencyModel', 'agencyModel');
		$ci->load->model('Agency/AgencyImageModel', 'imageModel');
		$this->ci = &$ci;
	}

	function index(&$data, &$ci){
		$data['ai_name'] = $ai_name = $ci->request->param('ai_name', METHOD_BOTH, false);

		$data['list'] = array();
		$data['total'] = 0;
		$data['paging'] = false;

		$data['default_x'] = $ci->request->param('x', METHOD_BOTH, false);
		$data['default_y'] = $ci->request->param('y', METHOD_BOTH, false);
		$data['default_zoom'] = $ci->request->param('zoom', METHOD_BOTH, false);

		if(!$data['default_x'] && !$data['default_y']){
			if(isset($_COOKIE['mapX'])) $data['default_x'] = $_COOKIE['mapX'];
			if(isset($_COOKIE['mapY'])) $data['default_y'] = $_COOKIE['mapY'];
			if(isset($_COOKIE['mapZoom'])) $data['default_zoom'] = $_COOKIE['mapZoom'];
		}


		if(hasText_($ai_name)){
			$ci->load->library('paging');
			$paging = &$ci->paging;
			$paging->setPageSize(10);
			$paging->addWhere('ai_name', 'like', $ai_name);
			$list = $ci->agencyModel->listPage($paging);
			$data['total'] = $paging->totalRows;

			$data['list'] = &$list;
			$data['paging'] = &$paging;
			$data['page_total'] = $paging->totalPages;

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

	function doList(&$data, &$ci){
		$data['paging'] = false;
		$data['total'] = 0;
		$data['page_total'] = 0;

		$data['ne'] = $ci->request->param('x', METHOD_BOTH, false);
		$data['sw'] = $ci->request->param('y', METHOD_BOTH, false);
		$ai_name = $data['ai_name'] = $ci->request->param('ai_name', METHOD_BOTH, false);
		$data['list'] = array();

		if($ai_name){
			$this->index($data, $ci);
		}

		return 'event/search_map_list';
	}

	function doListToJson(&$data, &$ci){
		$this->doList($data, $ci);
		$list = $data['list'];

		$ci->load->helper('my_file');
		$ci->load->model('Agency/AgencyImageModel', 'imageModel');
		$ci->load->model('Members/Hospital', 'hospitalModel');

		$seqs = array();
		$numbers = array();
		if(isArray_($list)){
			foreach($list as $k => $v){
				$seqs[] = $v['ai_seq'];
				$numbers[] = $v['ai_number'];
			}
		}

		$hospital_list = $ci->hospitalModel->getHospitalByNumbersWithEvent($numbers);
		$image_list = $ci->imageModel->getListByAiseqs($seqs);
		$image_list = $this->reSortImages($image_list);

		$json = $this->makeJsonFormArray($list, $image_list, $hospital_list);

		$ci->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($json);
		exit;

	}

	function doView(&$data, &$ci){
		$ai_seq = $ci->request->param('seq', METHOD_BOTH, false);
		$ci->load->model('Agency/AgencyModel', 'agencyModel');
		$ci->load->model('Agency/AgencyImageModel', 'imagesModel');
		$ci->load->model('Members/Hospital', 'hospitalModel');

		$data['agency'] = $ci->agencyModel->getFullInfoBySeq($ai_seq);
		$data['images'] = $ci->imagesModel->getListByAiseq($ai_seq);
		if(!isArray_($data['images'])){
			$default_image['url'] = '/resource/images/medical/map_images/modal_noimage.jpg';
			$data['images'][] = $default_image;
		}

		$map_url = "https://www.google.co.kr/maps/dir//";
		$string = array();

//		if($data['agency']['ai_addr']){
////			$query[] = $data['agency']['ai_addr'];
//			$temps = explode(' ', $data['agency']['ai_addr']);
//			$addr = $temps[0].' '.$temps[1].' '.$temps[3];
//			$query[] = $data['agency']['ai_name'].' '.$addr;
//		}
//
//		$ai_x = '';
//		$ai_y = '';
//		if($data['agency']['ai_x'] != 'nodata' &&  $data['agency']['ai_x']) $ai_x = $data['agency']['ai_x'];
//		if($data['agency']['ai_y'] != 'nodata' &&  $data['agency']['ai_y']) $ai_y = $data['agency']['ai_y'];
//
//		$query[] = $ai_x.','.$ai_y.','.'16z';

		$query[] = $data['agency']['ai_name'];

		if(isArray_($query)){
			$map_url = $map_url.implode('/@', $query);
		}else{
			$map_url = false;
		}

		$data['map_url'] = $map_url;

		$data['is_member'] = $ci->hospitalModel->isMemberByAiseq($ai_seq);
		if($data['is_member']){
			$data['has_event'] = $ci->hospitalModel->hasEventByAiseq($ai_seq);
		}else $data['has_event'] = false;

		//전화번호
		$data['phone_number'] = false;
		if(array_key_exists('hi_system_phone', $data['agency']) && $data['agency']['hi_system_phone'] ){
			$phone_number = $data['agency']['hi_system_phone'];
			$data['phone_number'] = substr($phone_number, 0, 4).'-'.substr($phone_number, 4, 4).'-'.substr($phone_number, 8);
		}
//		else if(array_key_exists('hi_revmng_phone', $data['agency'])) $data['phone_number'] = $data['agency']['hi_revmng_phone'];

		if(!$data['phone_number'] && array_key_exists('ai_phone', $data['agency'])) $data['phone_number'] = $data['agency']['ai_phone'];
		if(!$data['phone_number']) $data['phone_number'] = false;

		if($ci->auth->isLogin()) $data['can_reply'] = true;
		else $data['can_reply'] = false;

		$ci->load->model('Event/UserReplyModel', 'replyModel');
		$data['can_star'] = $ci->replyModel->canStar($data['agency']['ai_number']);
		$data['avg'] = $ci->replyModel->getTotalByAiseq($ai_seq);
		$data['comments'] = $ci->replyModel->getListByAiseq($ai_seq);

		return 'event/search_map_view';
	}

	function paging(&$data, &$ci){
		$this->index($data, $ci);
		$list = $data['list'];
		if(isArray_($list)){
			foreach($list as $k => $v){
				if(array_key_exists($v['ai_seq'], $data['thums'])){
					$list[$k]['thum'] = $data['thums'][$v['ai_seq']]['url'];
				}else{
					$list[$k]['thum'] = '/resource/images/medical/map_images/none_image.png';
				}

				if($v['has_event']) $list[$k]['has_event'] = '<img src="/resource/images/medical/icons/icon_event.png" alt="이벤트 중" />';
				else $list[$k]['has_event'] = '';

				if($v['is_alied']) $list[$k]['is_alied'] = '<img src="/resource/images/medical/icons/icon_alied.png" alt="제휴 중" />';
				else $list[$k]['is_alied'] = '';
			}
		}
		$json_data = json_encode($list);
		echo $json_data;
		exit;
	}

	function _makeHtml($data){

	}

	function searchLat(&$data, &$ci){
		$ne = $ci->request->param('ne', METHOD_BOTH, false);
		$sw = $ci->request->param('sw', METHOD_BOTH, false);
		$name = $ci->request->param('name', METHOD_BOTH, false);
		$page = $ci->request->param('page', METHOD_BOTH, false);
		$page_per_num = 15;
		$page_start = ($page-1)*15;
		$page_end = $page_start + $page_per_num;

		$session_data = array(
				'map_not_data' => ''
			);
		$ci->session->set_userdata($session_data);

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

	function searchLatAdd(&$data, &$ci){
		$ne = $ci->request->param('ne', METHOD_BOTH, false);
		$sw = $ci->request->param('sw', METHOD_BOTH, false);
		$name = $ci->request->param('name', METHOD_BOTH, false);

		$ci->load->model('Agency/AgencyModel', 'agencyModel');

		$ignore_data = $this->ci->session->userdata('map_not_data');
		if(hasText_($ignore_data)) $ignore_data = explode(',',$ignore_data);
		else $ignore_data = array();

		if($ne && $sw){
			$ne_string = str_replace(' ', '', str_replace(')', '', str_replace('(', '', $ne)));
			$sw_string = str_replace(' ', '', str_replace(')', '', str_replace('(', '', $sw)));

			list($ne_x, $ne_y) = explode(',', $ne_string);
			list($sw_x, $sw_y) = explode(',', $sw_string);

			$list = $ci->agencyModel->getListByMap($ne_x, $ne_y, $sw_x, $sw_y, $ignore_data);
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

		$seqs = array();

		$hot_list = array();
		$event_list = array();
		$normal_list = array();

		foreach($list as $k => $v){
			$data = array();
			$data['id'] = $k+1;
			$data['ai_seq'] = $v['ai_seq'];
			$data['color'] = '';					//더미 데이터

			$seqs[] = $v['ai_seq'];

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

			$data['rating'] = 0;
			if(array_key_exists('obj_avg', $v)) $data['rating'] = intval($v['obj_avg']);				//인기도? 의미 불명

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

			if(array_key_exists($v['ai_number'], $hospital_list) && $hospital_list[$v['ai_number']]['hot_cnt'] > 0){
				$data['hot_cnt'] = $hospital_list[$v['ai_number']]['hot_cnt'];
				$hot_list[] = $data;
			}else if(array_key_exists($v['ai_number'], $hospital_list) && $hospital_list[$v['ai_number']]['event_cnt'] > 0){
				$data['event_cnt'] = $hospital_list[$v['ai_number']]['event_cnt'];
				$event_list[] = $data;
			}else{
				$default_list[] = $data;
			}
		}

		if(!isset($event_list) || !is_array($event_list)) $event_list = array();
		if(!isset($default_list) || !is_array($default_list)) $default_list = array();
		if(!isset($hot_list) || !is_array($hot_list)) $hot_list = array();

		$data = array_merge($hot_list, $event_list);
		$data = array_merge($data, $default_list);

		$result['data'] = &$data;

		$session_old_data = $this->ci->session->userdata('map_not_data');
		if(hasText_($session_old_data)) $session_old_data = explode(',', $session_old_data);
		else $session_old_data = array();

		$session_new_data = array_merge($session_old_data, $seqs);
		$session_new_data = implode(',', $session_new_data);

		$session_data = array(
				'map_not_data' => $session_new_data
			);
		$this->ci->session->set_userdata($session_data);

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

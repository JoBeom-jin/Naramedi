<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventUser{

	private $_info = array();
	private $_ci = false;
	
	function onInit(&$ci){
		$ci->load->model('Event/EventInfoModel', 'eventModel');
		$ci->load->model('Event/EventCodeRelationModel', 'relationModel');
		$ci->load->model('Members/Hospital', 'hospitalModel');		
		$ci->load->model('Code/CodeModel', 'codeModel');		
		$ci->load->model('Agency/AgencyModel', 'agencyModel');
		$ci->load->model('Event/UserCheckEventModel', 'checkModel');
		$ci->load->model('Event/EventReserveModel', 'reserveModel');

		$this->_ci = &$ci;
	}
	
	function index(&$data, &$ci){			

		$list = $ci->eventModel->getRandomRowWithHosinfo('*', 10, $data['is_closed']);
		$images = array();
		if(is_array($list) && count($list) > 0){
			foreach($list as $k => $v){
				$temp['url'] =str_replace(DIRECTORY_SEPARATOR, '/', str_replace($ci->_site_config['dir']['root'], '', $v['ei_img_banner']));			
				$temp['name'] = $v['ei_name'];
				$temp['ei_seq'] = $v['ei_seq'];
				$images[] = $temp;
			}
		}		
		
		$data['cities'] = $ci->agencyModel->getCities();
		$city =  $data['select_city'] = $ci->request->param('city', METHOD_BOTH, false);
		$local = $data['select_local'] =$ci->request->param('local', METHOD_BOTH, false);
		$type = $data['select_type'] = $ci->request->param('type', METHOD_BOTH, false);
		$hi_seq = $data['hi_seq'] = $ci->request->param('hi_seq', METHOD_BOTH, false);

		if($city) $data['local'] = $ci->agencyModel->getLocal($city);

		$sort = $data['sort'] = $ci->request->param('sort', METHOD_BOTH, 'new');

		$ci->load->library('paging');
		$paging = &$ci->paging;

		$paging->setPageSize(24);
		$paging->setWhere('ei_status', '=', 'doing');
		$paging->addWhere('ei_end', '>', time());
		$paging->addWhere('hi_active', '=', 'Y');
		//폐쇄몰 선언
		if($data['is_closed']){
			$paging->addWhere('ei_closed_display_flag','=','Y');
		}



		if($city){
			if($city == '서울경기인천')	$city_array = array('서울특별시', '경기도', '인천광역시');
			else if($city == '충청도') $city_array = array('충청남도', '충청북도', '대전광역시', '세종특별자치시');
			else if($city == '전라도') $city_array = array('전라남도', '전라북도', '광주광역시');
			else if($city == '경상도') $city_array = array('경상남도', '경상북도', '대구광역시', '부산광역시', '울산광역시');
			else if($city == '강원도') $city_array = array('강원도');
			else if($city == '제주도') $city_array = array('제주특별자치도');

			$paging->addWhere('ai_addr_text1', 'in', $city_array);
		}
		if($type) $paging->addWhere('ei_types', 'like', $type);
		if($hi_seq) $paging->addWhere('hi_seq', '=', $hi_seq);

//		$paging->addOrder('ei_event_type', 'asc');
		if($sort == 'new') $paging->addOrder('ei_seq', 'desc');
//		if($sort == 'like') 
		if($sort == 'up') $paging->addOrder('ei_account', 'desc');
		if($sort == 'down') $paging->addOrder('ei_account', 'asc');

		$params = array(
				'table' => 'event_info left join hospital_info on ei_hiseq = hi_seq left join agency_info on hi_org_number = ai_number',
				'cols' => '*',
			);

		$list = $ci->eventModel->listPage($paging, $params);
		$this->makeImageUrl($list);

		$ei_seqs = array();
		if(isArray_($list)){
			foreach($list as $k => $v) $ei_seqs[] = $v['ei_seq'];
		}
		$ci->eventCountModel->insertViewByEiseqs($ei_seqs);


		$data['list'] = &$list;

		$data['paging'] = &$paging;

		$data['like_list'] = $ci->checkModel->getListByMeseq($ci->auth->seq());

		$data['hos_types'] = $ci->codeModel->getListByCgCode('TYP');
		$data['slider_images'] = &$images;
		$ci->addJs('/resource/assets/js/lightslider.js');
		$ci->addJs('/resource/js/eventcheck.jquery.js');

		$data['fbqs'][] = 'view_event_list';

		return 'event/user_search';
	}

	function jsonEventList(&$data, &$ci){
		$this->index($data, $ci);

		if(is_array($data['list']) && count($data['list']) > 0){

			$json['list'] = array();
			foreach($data['list'] as $k => $v){
				$result = array();
				$result['banner_src'] = $v['banner'];
				$result['ei_seq'] = $v['ei_seq'];
				$result['ei_name'] = $v['ei_name'];
				if(in_array($v['ei_seq'], $data['like_list'])){
					$result['is_like'] = true;					
				}else{
					$result['is_like'] = false;
				}

				if($data['is_closed'] && $v['ei_closed_discount'] > 0){
					$result['is_close_mall'] = true;
					$result['ei_discounted_account'] = number_format($v['ei_account']-($v['ei_account'] * ( $v['ei_closed_discount'] / 100 )) );

				}else{
					$result['is_close_mall'] = false;
					$result['ei_discounted_account'] = 0;
				}
							
				
				$result['ei_account'] = number_format($v['ei_account']);
				$result['end_time'] = date('Y년 m월 d일', $v['ei_end']);
				$result['hi_open_name'] = $v['hi_open_name'];
				$result['address'] = $v['ai_addr'];

				$json['list'][] = $result;								
			}

		}else{
			$json['list'] = array();
		}
		echo json_encode($json);
		exit;	
	}

	function makeImageUrl(&$list){

		if(is_array($list) && count($list) > 0){
			foreach($list as $k => $v){
				$list[$k]['banner'] = $this->path2url($v['ei_img_banner']);
				$list[$k]['slider'] = $this->path2url($v['ei_img_slider']);
				$list[$k]['top'] = $this->path2url($v['ei_img_top']);
				$list[$k]['middle'] = $this->path2url($v['ei_img_middle']);
				$list[$k]['bottom'] = $this->path2url($v['ei_img_bottom']);
			}
		}
	}


	function viewEvent(&$data, &$ci){

		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$data['view'] = $ci->eventModel->getFullInfoByCiseq($seq);
		//폐쇄몰 선언
		if($data['is_closed'] && $data['view']['ei_closed_display_flag'] != 'Y'){
			show_error('정상적인 접근이 아닙니다.');
			header('Location: /');			
			exit;
		}
		$data['view']['ei_img_banner'] = $this->path2url($data['view']['ei_img_banner']);
		$data['view']['top'] = $this->path2url($data['view']['ei_img_top']);
		$data['view']['middle'] = $this->path2url($data['view']['ei_img_middle']);
		$data['view']['bottom'] = $this->path2url($data['view']['ei_img_bottom']);
		


		$ci->eventCountModel->insertClickByEiseq($seq);
		
		$data['reserve_times'] = $ci->reserveModel->_time_code;		

		if($ci->auth->isLogin()){
			$ci->load->model('Members/MemberDetail', 'detailModel');
			$detail = $ci->detailModel->getDetailByMeseq($ci->auth->seq());
			if(array_key_value('md_phone', $detail)) $data['user']['phone'] = $detail['md_phone'];
			else $data['user']['phone'] = '';
			$data['user']['name'] = $ci->auth->name();
		}else{
			$data['user']['phone'] = '';
			$data['user']['name'] = '';
		}


		$_cookie = & $ci->getController('Event_EventUserCookie');
		$_cookie->onInit($ci);
		$_cookie->setViewEvent($seq);

		$data['like_list'] = $ci->checkModel->getListByMeseq($ci->auth->seq());
		
		//sns 공유하기
		$domain = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'];
		$full_url = $data['full_url'] =  $domain.$_SERVER['REQUEST_URI'];
		$comment = $data['twitter_text'] = $data['view']['ei_name']."( {$data['view']['hi_open_name']} )".' 기간:'.date('Y.m.d', $data['view']['ei_start']).'부터 '.date('Y.m.d', $data['view']['ei_end']).'까지';
		$data['meta_datas'] = array();
		$data['meta_datas'][] = '<meta name="description" content="'.$comment.'" />';
		$data['meta_datas'][] = '<meta property="og:type" content="website" />';
		$data['meta_datas'][] = '<meta property="og:title" content="'.$data['view']['ei_name'].'" />';
		$data['meta_datas'][] = '<meta property="og:url" content="'.$full_url.'" />';
		$data['meta_datas'][] = '<meta property="og:description" content="'.$comment.'" />';
		$data['meta_datas'][] = '<meta property="og:image" content="'.$domain.$data['view']['ei_img_banner'].'" />';
		$data['twitter_text'] = urlencode($data['twitter_text']);

		$ci->setFrame('medical2');
		$ci->addJs('/resource/js/popup_require_jq.js');
		$ci->addJs('/resource/js/eventcheck.jquery.js');
		return 'event/user_view';
	}

	function path2url($path){
		if(!$this->_ci->chk->hasText($path)) return '';
		else if(!is_file($path)) return '';
		$path = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_ci->_site_config['dir']['root'], '', $path));

		return $path;
	}

	function reserve(&$data, &$ci){
		$args = $ci->request->getAll();

		if(array_key_value('accept_one', $args) != 'Y'){
			$msg = array();
			if(array_key_value('accept_one', $args) != 'Y') $msg[] = '개인정보취급방침에 동의하셔야 합니다.';
//			if(array_key_value('accept_two', $args) != 'Y') $msg[] = '개인정보 3자 제공에 동의하셔야 합니다.';
			$data['msg'] = implode('\n', $msg);
			return 'script';
		}else if(!array_key_value('ei_seq', $args)){
			$data['msg'] = '이벤트가 존재하지 않습니다.';
			return 'script';
		}

		$list = $ci->eventModel->getFullInfoListBySeqs(array($args['ei_seq']));
		if(!isArray_($list)){
			$data['msg'] = '이벤트가 존재하지 않습니다.';
			return 'script';
		}

		$args['ai_number'] = $list[0]['ai_number'];		
		$rsv_manager_phone = $list[0]['hi_revmng_phone'];
		
		//가격설정 : 오픈몰과 폐쇄몰에 따라 구분되어져 계산
		if($data['is_closed'] && $list[0]['ei_closed_discount'] > 0){
			$args['er_account'] = $list[0]['ei_account']-($list[0]['ei_account'] * ( $list[0]['ei_closed_discount'] / 100 ) );
			$args['shop_name'] = $data['shop_name'];
		}else{
			$args['er_account'] = $list[0]['ei_account'];
		}



		//오픈몰과 폐쇄몰 구분
		if($data['is_closed']){
			$type = 'MLL002';
			$cost = $list[0]['ei_cash_closemall'];
		}else{
			$type = 'MLL001';
			$cost = $list[0]['ei_cash_openmall'];
		}

		$args['er_device'] = 'PC';

		if($ci->reserveModel->insertArgs($args, $type)){			
			$cash_args['ch_out']  = $cost;
			$cash_args['ch_eiseq'] = $list[0]['ei_seq'];
			$cash_args['ch_hiseq'] = $list[0]['hi_seq'];
			$cash_args['ch_ctime'] = time();
			$cash_args['ch_name'] = $args['er_name'];
			if($ci->auth->isLogin()) $args['ch_meid'] = $ci->auth->id();
			$ci->load->model('Event/CashModel', 'cashModel');
			$ci->cashModel->insert($cash_args);


			//알림톡 전송
			$ci->load->model('Sms/MessageModel', 'smsModel');
			/*to User */			
			$send_phone = $args['er_phone'];
			$user_name = $args['er_name'];
			$ci->smsModel->sendAlimTalk2QuestionUser($send_phone, $user_name);
			
			/*hospital Manager*/
			if($rsv_manager_phone){
				$send_phone = $rsv_manager_phone;
				$user_name = $args['er_name'];
				$user_phone = $args['er_phone'];
				$ci->smsModel->sendAlimTalk2QuestionManager($send_phone, $user_name, $user_phone);
			}

			$data['msg'] = '정상적으로 예약 되었습니다.';
			$data['sact'] = array('COMPLETE');

		}else{
			$data['msg'] = $ci->reserveModel->error_message;
		}
		
		return 'script';		
	}	

	/*
	*	event 상세검색
	*/
	function searchDetail(&$data, &$ci){
		$this->_commonSearchList($data, $ci);

		$ci->load->model('Code/CodeModel', 'codeModel');
		$data['body_code'] = $ci->codeModel->getBodyPartList();
		$data['cities'] = $ci->agencyModel->getCities();
		$data['age_codes'] = $ci->codeModel->getListByCgCode('AGE');
		
		//도시 검색
		$select_city = $data['select_city'] = $ci->request->param('city', METHOD_BOTH, false);	
		
		//시군구 검색
		if($select_city) $data['local_list'] = $ci->agencyModel->getLocal($select_city);
		else $data['local_list'] = array();
		$select_local = $data['select_local'] =  $ci->request->param('gungu', METHOD_BOTH, false);		

		//연령 code 검색
		$select_age = $data['select_age'] = $ci->request->param('age', METHOD_BOTH, false);

		//가격 검색
		$min_account = $ci->request->param('min_account', METHOD_BOTH, false);
		if(!is_numeric($min_account)) $min_account = 0;
		$data['min_account'] = $min_account;

		$max_account = $ci->request->param('max_account', METHOD_BOTH, false);
		if(!is_numeric($max_account)) $max_account = 0;
		$data['max_account'] = $max_account;

		//부위별 검색
		$search_ei_seqs = $this->_getEiseqByPartSearch($ci);		

		$paging = $this->_initCommonPaging($data, $ci);

		/*검색 조건 처리*/
		if(is_array($search_ei_seqs)){			
			$paging->addWhere('ei_seq', 'in', $search_ei_seqs);
		}
		if($select_city) $paging->addWhere('ai_addr_text1', '=', $select_city);
		if($select_local) $paging->addWhere('ai_addr_text2', '=', $select_local);
		if($select_age){						
			$paging->addWhere('ei_ages', 'like', $select_age);		
		}
		if($min_account > 0) $paging->addWhere('ei_account', '>=', $min_account);		
		if($max_account > 0) $paging->addWhere('ei_account', '<=', $max_account);		

		
		/*리스트 시작*/		
		if($data['sort'] == 'new') $paging->addOrder('ei_seq', 'desc');
//		if($data['sort'] == 'like') 
		if($data['sort'] == 'up') $paging->addOrder('ei_account', 'desc');
		if($data['sort'] == 'down') $paging->addOrder('ei_account', 'asc');

		$list = $this->_getListPage($paging, $ci);				
		$this->makeImageUrl($list);

		$ei_seqs = array();
		if(isArray_($list)){
			foreach($list as $k => $v) $ei_seqs[] = $v['ei_seq'];
		}
		$ci->eventCountModel->insertViewByEiseqs($ei_seqs);		

		$data['list'] = &$list;
		$data['paging'] = &$paging;			
				
		return 'event/user_search_detail';
	}

	/*
	* 상세 검색을 ajax로 전달
	*/
	function ajaxDetailSearch(&$data, &$ci){
		$this->searchDetail($data, $ci);
		$this->_printEvnetJson($data['list'], $data['like_list'], $data['is_closed'], $data['paging']->totalPages);
	}

	/*
	* 해당 도시의 시군구 정보를 ajax로 전달
	*/
	function getGunguAjax(&$data, &$ci){
		$city = $ci->request->param('city', METHOD_BOTH, false);
		$city = urldecode($city);

		$local = $ci->agencyModel->getLocal($city);
		if(!$local || !is_array($local) ) return $local = array();

		$json = array();
		foreach($local as $k => $v){
			$json[] = $v['ai_addr_text2'];
		}

		echo json_encode($json);
		exit;					
	}

	/*
	* event 검색 시 공통 부분 처리
	*/
	private function _commonSearchList(&$data, &$ci){
		$this->_initRandomBanner($data, $ci);
		$this->_setDataForSearchList($data, $ci);
		$data['like_list'] = $ci->checkModel->getListByMeseq($ci->auth->seq());
		$data['hos_types'] = $ci->codeModel->getListByCgCode('TYP');

		$data['event_search_footer'] = $ci->load->view('/medical_view/event/user_search_common', $data, true);
		$data['event_search_tab_menu'] = $ci->load->view('/medical_view/event/user_search_tab', $data, true);

		//검색 url
		$data['add_url'] = '';

		//소팅
		$data['sort'] = $ci->request->param('sort', METHOD_BOTH, 'new');
		$data['event_search_sort_tab'] = $ci->load->view('/medical_view/event/user_search_sort_tab', $data, true);		
	}


	/*
	* event 검색 페이지 상단에 표시될 banner 정보를 초기화한다.
	*/
	private function _initRandomBanner(&$data, &$ci){
		$list = $ci->eventModel->getRandomRowWithHosinfo('*', 10, $data['is_closed']);
		$images = array();
		if(is_array($list) && count($list) > 0){
			foreach($list as $k => $v){
				$temp['url'] =str_replace(DIRECTORY_SEPARATOR, '/', str_replace($ci->_site_config['dir']['root'], '', $v['ei_img_banner']));			
				$temp['name'] = $v['ei_name'];
				$temp['ei_seq'] = $v['ei_seq'];
				$images[] = $temp;
			}
		}

		$data['banner_list'] = $list;
		$data['banner_images'] = $images;
		$data['max_default_account'] = '10000000';
		$data['min_default_account'] = '100000';
	}

	/*
	* search의 각 탭을 위한 설정 파일 로드
	*/
	private function _setDataForSearchList(&$data, &$ci){	

		$ci->addJs('/resource/assets/js/lightslider.js');
		$ci->addJs('/resource/js/eventcheck.jquery.js');		
		$ci->addJs('/resource/plugin/freshslider/freshslider.min.js');		
		$ci->addCss('/resource/plugin/freshslider/freshslider.min.css');		

		$data['fbqs'][] = 'view_event_list';
	}

	/*
	* searh 공통 : 페이징 인스턴스를 선언하고 공통 부분을 선언한다.
	*/
	private function & _initCommonPaging(&$data, &$ci){		
		$ci->load->library('paging');
		$paging = &$ci->paging;

		$paging->setPageSize(24);				
		$paging->setWhere('ei_status', '=', 'doing');		
		$paging->addWhere('hi_active', '=', 'Y');
		
		return $paging;
	}

	/*
	* search 공통 : paging 인스턴스의 마무리 작업
	*/
	private function & _getListPage(&$paging, &$ci){
		$ctime = time();
		$params = array(
				'table' => 'event_info left join hospital_info on ei_hiseq = hi_seq left join agency_info on hi_org_number = ai_number',
				'cols' => '*',
				'where' => "ei_end > '{$ctime}' or ei_auto_flag='Y'"
			);
		$list = $ci->eventModel->listPage($paging, $params);
		return $list;
	}

	/*
	* event 리스트를 json 형태에 맞도록 변경하여 출력
	*/
	private function _printEvnetJson(&$list, $like_list, $is_closed, $total = false){
		if(!$total) $total = 0;
		$json['total'] = $total;
		if(is_array($list) && count($list) > 0){

			$json['list'] = array();
			foreach($list as $k => $v){
				$result = array();
				$result['banner_src'] = $v['banner'];
				$result['ei_seq'] = $v['ei_seq'];
				$result['ei_name'] = $v['ei_name'];
				if(in_array($v['ei_seq'], $like_list)){
					$result['is_like'] = true;					
				}else{
					$result['is_like'] = false;
				}

				if($is_closed && $v['ei_closed_discount'] > 0){
					$result['is_close_mall'] = true;
					$result['ei_discounted_account'] = number_format($v['ei_account']-($v['ei_account'] * ( $v['ei_closed_discount'] / 100 )) );

				}else{
					$result['is_close_mall'] = false;
					$result['ei_discounted_account'] = 0;
				}
							
				
				$result['ei_account'] = number_format($v['ei_account']);
				$result['end_time'] = date('Y년 m월 d일', $v['ei_end']);
				$result['hi_open_name'] = $v['hi_open_name'];
				$result['address'] = $v['ai_addr'];

				$json['list'][] = $result;								
			}

		}else{
			$json['list'] = array();
		}
		echo json_encode($json);
		exit;	
	}

	/*
	* 부위별 검색 일 경우 : 선택된 code를 갖는 ei_seq 리스트를 반환한다.
	*/
	private function _getEiseqByPartSearch(&$ci){
		$codes = $ci->request->param('codes', METHOD_BOTH, false);

		if(!$codes) return false;
		$list = $ci->relationModel->getListByCodes($codes);
		$result = array();
		if(is_array($list) && count($list) > 0){
			foreach($list as $k => $v){
				$result[] = $v['ec_eiseq'];
			}			
		}

		return $result;
	}
	
}
?>

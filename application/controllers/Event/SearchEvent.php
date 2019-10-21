<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchEvent{

	private $_info = array();
	private $_ci = false;

	public $_app_conf = array();	
	public $_footer = array();

	function onInit(&$ci){
		$ci->load->model('Event/EventInfoModel', 'eventModel');
		$ci->load->model('Event/EventCodeRelationModel', 'relationModel');
		$ci->load->model('Members/Hospital', 'hospitalModel');		
		$ci->load->model('Code/CodeModel', 'codeModel');		
		$ci->load->model('Agency/AgencyModel', 'agencyModel');
		$ci->load->model('Event/UserCheckEventModel', 'checkModel');
		$ci->load->model('Event/EventReserveModel', 'reserveModel');

		$this->_ci = &$ci;
		$this->_app_conf['common_path'] = 'medical_view/user_event/common';		
	}
	
	/*
	* action default : 일반 검색
	*/
	function index(&$data, &$ci){
		$this->_initList($data, $ci);
		$data['hi_seq'] = $ci->request->param('hi_seq', METHOD_BOTH, false);		
		$data['fbqs'][] = 'view_event_list';

		$data['local_value'] = false;
		$data['type_value'] = false;
		$data['sort_value'] = false;
		$data['page_value'] = false;		


		if($this->_isPrevPageView()){						
			$this->_getSessionDefault($data['local_value'], $data['type_value'], $data['sort_value'], $data['page_value']);
		}
		
		return 'user_event/search_default';
	}

	/*
	* action detail : 상세검색
	*/
	function detail(&$data, &$ci){
		$this->_initList($data, $ci);

		$ci->load->model('Code/CodeModel', 'codeModel');
		$data['body_code'] = $ci->codeModel->getBodyPartList();
		$data['cities'] = $ci->agencyModel->getCities();
		$data['age_codes'] = $ci->codeModel->getListByCgCode('AGE');	


		$data['city_value'] = false;
		$data['local_value'] = false;
		$data['age_value'] = false;
		$data['max_value'] = '10000000';
		$data['min_value'] = '100000';		
		$data['codes_array'] = false;
		$data['page_value'] = false;
		$data['sort_value'] = false;
		if($this->_isPrevPageView()){
			$this->_getSessionDetail($data['sort_value'], $data['city_value'], $data['local_value'],$data['age_value'], $data['min_value'], $data['max_value'], $data['codes_array'], $data['page_value']);						

			if(isset($data['city_value'])){				
				$local = $ci->agencyModel->getLocal($data['city_value']);				
				if(!$local || !is_array($local) ) $local = array();
				$data['local_list'] = $local;				
			}
		}		
		

		$ci->addJs('/resource/js/asRange/jquery-asRange.min.js');
		$ci->addCss('/resource/js/asRange/css/asRange.min.css');
		return 'user_event/search_detail';
	}

	/*
	* action part : 파트검색
	*/
	function part(&$data, &$ci){
		$this->_initList($data, $ci);
		$ci->load->model('Code/CodeModel', 'codeModel');
		$data['body_code'] = $ci->codeModel->getBodyPartList2();

		$data['codes_array'] = false;
		$data['page_value'] = false;
		$data['sort_value'] = false;
		$data['group_value'] = false;
		$data['group_array'] = array();

		if($this->_isPrevPageView()){			
			$this->_getSessionPart($data['sort_value'], $data['codes_array'], $data['group_value'], $data['page_value']);	
			if($data['group_value']){
				$ci->load->model('Code/CodeModel', 'codeModel');				
				$part = urldecode($data['group_value']);
				$body_codes = $ci->codeModel->getBodyPartList2();
				
				foreach($body_codes as $k => $v){
					if($v['name'] == $part){
						$data['group_array'] = $v['data'];						
					}
				}
			}
		}	

		return 'user_event/search_part';
	}

	/*
	* json 처리
	*/
	function jsonPage(&$data, &$ci){
		
		//일반 검색		
		$local = $ci->request->param('local', METHOD_BOTH, false);
		$type = $ci->request->param('type', METHOD_BOTH, false);
		$hi_seq = $ci->request->param('hi_seq', METHOD_BOTH, false);
		$sort = $ci->request->param('sort', METHOD_BOTH, 'new');		

		$ci->load->library('paging');
		$paging = &$ci->paging;
		$paging->setPageSize(24);		

		if($local){
			$local = urldecode($local);
			$city_array = array();
			if($local == '서울경기인천')$city_array = array('서울특별시', '경기도', '인천광역시');
			else if($local == '충청도') $city_array = array('충청남도', '충청북도', '대전광역시', '세종특별자치시');
			else if($local == '전라도') $city_array = array('전라남도', '전라북도', '광주광역시');
			else if($local == '경상도') $city_array = array('경상남도', '경상북도', '대구광역시', '부산광역시', '울산광역시');
			else if($local == '강원도') $city_array = array('강원도');
			else if($local == '제주도') $city_array = array('제주특별자치도');

			$paging->addWhere('ai_addr_text1', 'in', $city_array);
		}
		if($type) $paging->addWhere('ei_types', 'like', $type);
		if($hi_seq) $paging->addWhere('hi_seq', '=', $hi_seq);
		//====== 일반 검색 옵션 끝


		//상세검색
		/*도시 검색*/
		$select_city = $ci->request->param('select_city', METHOD_BOTH, false);	
		
		/*시군구 검색*/
		if($select_city) $local_list = $ci->agencyModel->getLocal($select_city);
		else $local_list = array();
		$select_local =  $ci->request->param('gungu', METHOD_BOTH, false);		

		/*연령 code 검색*/
		$select_age = $ci->request->param('age', METHOD_BOTH, false);

		/*가격 검색*/
		$min_account = $ci->request->param('min_account', METHOD_BOTH, false);
		if(!is_numeric($min_account)) $min_account = 0;
		$data['min_account'] = $min_account;

		$max_account = $ci->request->param('max_account', METHOD_BOTH, false);
		if(!is_numeric($max_account)) $max_account = 0;
		$data['max_account'] = $max_account;

		/*부위별 검색*/
		$search_ei_seqs = $this->_getEiseqByPartSearch($ci);

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
		//====== 상세 검색 옵션 끝



		//공통
		if($sort == 'new') $paging->addOrder('ei_seq', 'desc');
//		if($sort == 'like') 
		if($sort == 'up') $paging->addOrder('ei_account', 'desc');
		if($sort == 'down') $paging->addOrder('ei_account', 'asc');

		//폐쇄몰 선언
		if($data['is_closed']){
			$paging->addWhere('ei_closed_display_flag','=','Y');
		}

		$ctime = time();
		$paging->addWhere('hi_active', '=', 'Y');
		$params = array(
				'table' => 'event_info left join hospital_info on ei_hiseq = hi_seq left join agency_info on hi_org_number = ai_number',
				'cols' => '*',
				'where' => " ( ei_end > '{$ctime}' or ei_auto_flag='Y') and ei_status='doing'"
			);

		$codes = $ci->request->param('codes', METHOD_BOTH, false);
		$group = $ci->request->param('group', METHOD_BOTH, false);
		$this->_setSessionDefault($local, $type, $sort, $select_city, $select_local, $select_age, $min_account, $max_account, $codes, $group, $paging->page);

		$list = $ci->eventModel->listPage($paging, $params);
		$this->_makeImageUrl($list);

		$ei_seqs = array();
		if(isArray_($list)){
			foreach($list as $k => $v) $ei_seqs[] = $v['ei_seq'];
		}
		$ci->eventCountModel->insertViewByEiseqs($ei_seqs);	
		$like_list = $ci->checkModel->getListByMeseq($ci->auth->seq());

		$this->_printEvnetJson($list, $like_list, $data['is_closed'], $paging->totalPages);
	}

	/*
	* 시군구 리스트 얻기 json
	*/
	function jsonGunguList(&$data, &$ci){
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
	* 이벤트 몸 구분 이름으로 상세 부위 리스트 얻기 json
	*/
	function jsonBodyParts(&$data, &$ci){
		$ci->load->model('Code/CodeModel', 'codeModel');
		$part = $ci->request->param('part', METHOD_BOTH, false);
		if($part) $part = urldecode($part);

		$body_codes = $ci->codeModel->getBodyPartList2();
		$json['list'] = array();
		
		foreach($body_codes as $k => $v){
			if($v['name'] == $part){
				$json['list'] = $v['data'];
			}
		}
		
		echo json_encode($json);
		exit;		
	}

	/*
	* 이벤트 상세보기
	*/
	function viewEvent(&$data, &$ci){

		$this->_currentIsView();

		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$data['view'] = $ci->eventModel->getFullInfoByCiseq($seq);
		//폐쇄몰 선언
		if($data['is_closed'] && $data['view']['ei_closed_display_flag'] != 'Y'){
			show_error('정상적인 접근이 아닙니다.');
			header('Location: /');			
			exit;
		}
		$data['view']['ei_img_banner'] = $this->_path2url($data['view']['ei_img_banner']);
		$data['view']['top'] = $this->_path2url($data['view']['ei_img_top']);
		$data['view']['middle'] = $this->_path2url($data['view']['ei_img_middle']);
		$data['view']['bottom'] = $this->_path2url($data['view']['ei_img_bottom']);
		


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


	/*
	*	이벤트 예약하기
	*/
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
	* event 리스트를 json 형태에 맞도록 변경하여 출력
	*/
	public function _printEvnetJson(&$list, $like_list, $is_closed, $total = false){
		if(!$total) $total = 0;
		$json['total'] = $total;		
		if(is_array($list) && count($list) > 0){

			$json['list'] = array();
			foreach($list as $k => $v){
				$result = array();
				$result['banner_src'] = $v['banner'];
				$result['ei_seq'] = $v['ei_seq'];
				$result['ei_name'] = $v['ei_name'];
				$result['ei_original_account'] = number_format($v['ei_original_account']);
				$result['ei_age_text'] = $v['ei_age_text'];
				$result['ei_theme_text'] = $v['ei_theme_text'];


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
	* list에 공통 부분을 처리할 method
	* 상단 배너, 검색 sorting, javascript 등을 처리
	*/
	public function _initList(&$data, &$ci){
		$data['top_slider'] = $this->_initRandomBanner($data, $ci);
		$data['tab_menu'] = $ci->load->view($this->_app_conf['common_path'].'/tab_menu', $data, true);		
		$data['sort_menu'] = $this->_initSortMenu($data, $ci);
		

		$this->_footer[] = $ci->load->view($this->_app_conf['common_path'].'/item_list.js.php', false, true);
		$data['contents_footer'] = implode('',  $this->_footer);

		$ci->addJs('/resource/js/eventcheck.jquery.js');
	}

	/*
	* 검색 관련 session값 저장
	*/
	private function _setSessionDefault($local, $type, $sort, $select_city, $select_local, $select_age, $min_account, $max_account, $search_codes, $group, $page=1){
		$_SESSION['search-default-local'] = $local;
		$_SESSION['search-default-type'] = $type;				
		$_SESSION['search-default-sort'] = $sort;		
		$_SESSION['search-default-city'] = $select_city;
		$_SESSION['search-default-clocal'] = $select_local;
		$_SESSION['search-default-age'] = $select_age;
		$_SESSION['search-default-min'] = $min_account;
		$_SESSION['search-default-max'] = $max_account;
		$_SESSION['search-default-codes'] = $search_codes;
		$_SESSION['search-default-group'] = $group;
		$_SESSION['search-default-page'] = $page;		
	}

	/*
	* 일반 검색 세션값 얻기
	*/
	private function _getSessionDefault(&$local, &$type, &$sort, &$page){
		if(isset($_SESSION['search-default-local'])) $local = $_SESSION['search-default-local'];
		if(isset($_SESSION['search-default-type'])) $type = $_SESSION['search-default-type'];				
		if(isset($_SESSION['search-default-sort'])) $sort = $_SESSION['search-default-sort'];		
		if(isset($_SESSION['search-default-page'])) $page = $_SESSION['search-default-page'];		
	}

	/*
	* 상세 검색 세션값 얻기
	*/
	public function _getSessionDetail(&$sort, &$city, &$local, &$age, &$min, &$max, &$codes, &$page){
		$city = $_SESSION['search-default-city'];
		$local = $_SESSION['search-default-clocal'];
		$age = $_SESSION['search-default-age'];
		$min = $_SESSION['search-default-min'];
		$max = $_SESSION['search-default-max'];
		$codes = $_SESSION['search-default-codes'];
		$page = $_SESSION['search-default-page'];
		$sort = $_SESSION['search-default-sort'];
	}

	/*
	* 부위별 검색 세션값 얻기
	*/
	private function _getSessionPart(&$sort, &$codes, &$group, &$page){
		$codes = $_SESSION['search-default-codes'];
		$page = $_SESSION['search-default-page'];
		$sort = $_SESSION['search-default-sort'];
		$group = $_SESSION['search-default-group'];
	}


	/*
	* 이전 페이지가 view 페이지 였는지 확인한다.
	*/
	public function _isPrevPageView($only_check = false){
		if(isset($_SESSION['is_prev_page_view']) && $_SESSION['is_prev_page_view'] ){
			if(!$only_check) unset($_SESSION['is_prev_page_view']);
			return true;
		}else{
			return false;
		}		
	}

	/*
	* view 화면일때 is_prev_page_view : session 값을 true로 한다.
	*/
	public function _currentIsView(){
		$_SESSION['is_prev_page_view'] = true;
	}


	/*
	* 상단 배너 처리
	* @ return : banner_html
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

		$this->_footer[] = $ci->load->view($this->_app_conf['common_path'].'/light_slider.js.php', false, true);

		return $ci->load->view($this->_app_conf['common_path'].'/top_slider', $data, true);		
	}

	/*
	* sort menu 처리. 공통
	*/
	public function _initSortMenu(&$data, &$ci){
		$data['sort'] = $ci->request->param('sort', METHOD_BOTH, 'new');

		$this->_footer[] = $ci->load->view($this->_app_conf['common_path'].'/sort.js.php', false, true);
		return $ci->load->view($this->_app_conf['common_path'].'/sort_menu', $data, true);
	}

	/*
	* 각 이미지를 url 형식으로 저장
	*/
	public function _makeImageUrl(&$list){
		if(is_array($list) && count($list) > 0){
			foreach($list as $k => $v){
				$list[$k]['banner'] = $this->_path2url($v['ei_img_banner']);
				$list[$k]['slider'] = $this->_path2url($v['ei_img_slider']);
				$list[$k]['top'] = $this->_path2url($v['ei_img_top']);
				$list[$k]['middle'] = $this->_path2url($v['ei_img_middle']);
				$list[$k]['bottom'] = $this->_path2url($v['ei_img_bottom']);
			}
		}
	}

	/*
	* 부위별 검색 일 경우 : 선택된 code를 갖는 ei_seq 리스트를 반환한다.
	*/
	private function _getEiseqByPartSearch(&$ci){
		$codes = $ci->request->param('codes', METHOD_BOTH, false);

		if(!$codes) return false;
		$list = $ci->relationModel->getListByCodesAnd($codes);
		$result = array();
		if(is_array($list) && count($list) > 0){
			foreach($list as $k => $v){
				$result[] = $v['ec_eiseq'];
			}			
		}

		return $result;
	}

	
	/*
	* DIRECTORY를 URL 형식으로 변경
	*/
	function _path2url($path){
		if(!$this->_ci->chk->hasText($path)) return '';
		else if(!is_file($path)) return '';
		$path = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_ci->_site_config['dir']['root'], '', $path));

		return $path;
	}
	
}
?>

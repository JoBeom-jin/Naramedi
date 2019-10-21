<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.'Event'.DIRECTORY_SEPARATOR.'SearchEvent.php';
class EventUserPage{	
	private $_info = array();
	private $_ci = false;
	private $_Controller = false;
	
	function onInit(&$ci){
		$ci->load->model('Event/EventInfoModel', 'eventModel');
		$ci->load->model('Event/EventCodeRelationModel', 'relationModel');
		$ci->load->model('Members/Hospital', 'hospitalModel');		
		$ci->load->model('Code/CodeModel', 'codeModel');		
		$ci->load->model('Agency/AgencyModel', 'agencyModel');
		$ci->load->model('Event/UserCheckEventModel', 'checkModel');
		$ci->load->model('Event/EventReserveModel', 'reserveModel');
		$this->_Controller = new SearchEvent();
		$this->_Controller->onInit($ci);
		$this->_Controller->_app_conf['common_path'] = 'mobile/user_event/common';

		$this->_ci = &$ci;
	}

	/* 일반 검색 페이지 */
	function index(&$data, &$ci){
		$tpl = $this->_Controller->index($data, $ci);		
		return $tpl;
	}

	/*상세 검색 페이지*/
	function detail(&$data, &$ci){		
		$data['not_act_modal'] = $this->_Controller->_isPrevPageView(true);
		$tpl = $this->_Controller->detail($data, $ci);		
		

//		$ci->addJs('/resource/js/asRange/jquery-asRange.min.js');
//		$ci->addCss('/resource/js/asRange/css/asRange.min.css');
		return $tpl;
	}

	/*상세 검색 폼 페이지 (modal)*/
	function detailForm(&$data, &$ci){

		
		$data['body_code'] = $ci->codeModel->getBodyPartList();
		$data['cities'] = $ci->agencyModel->getCities();
		$data['age_codes'] = $ci->codeModel->getListByCgCode('AGE');
		

		$data['city_value'] = $ci->request->param('select_city', METHOD_BOTH, false);		
		$data['local_value'] = $ci->request->param('gungu', METHOD_BOTH, false);		
		$data['age_value'] = $ci->request->param('age', METHOD_BOTH, false);		
		$data['max_value'] = $ci->request->param('max_account', METHOD_BOTH, false);		
		$data['min_value'] = $ci->request->param('min_account', METHOD_BOTH, false);		
		$data['codes_array'] = $ci->request->param('codes', METHOD_BOTH, false);		
		$data['page_value'] = $ci->request->param('goto_page', METHOD_BOTH, false);		
		$data['sort_value'] = $ci->request->param('sort', METHOD_BOTH, false);
		
		if(isset($data['city_value'])){				
			$local = $ci->agencyModel->getLocal(urldecode($data['city_value']));				
			if(!$local || !is_array($local) ) $local = array();
			$data['local_list'] = $local;				
		}
		

		$ci->setFrame('noframe');		
		return 'user_event/search_detail_form';
	}

	/*
	* action part : 파트검색
	*/
	function part(&$data, &$ci){
		$data['not_act_modal'] = $this->_Controller->_isPrevPageView(true);
		$tpl = $this->_Controller->part($data, $ci);		

		return $tpl;
	}

	/*부위별 검색 폼 페이지 (modal)*/
	function partForm(&$data, &$ci){
		$data['group_value'] = $ci->request->param('group', METHOD_BOTH, false);		
		$data['codes_array'] = $ci->request->param('codes', METHOD_BOTH, false);		
		$data['page_value'] = $ci->request->param('goto_page', METHOD_BOTH, false);		
		$data['sort_value'] = $ci->request->param('sort', METHOD_BOTH, false);
		$data['group_array'] = array();

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

		$ci->load->model('Code/CodeModel', 'codeModel');
		$data['body_code'] = $ci->codeModel->getBodyPartList2();
		$ci->setFrame('noframe');
		return 'user_event/search_part_form';
	}

	/*
	* 부위별 구분 이름으로 상세 부위 리스트 얻기
	*/
	function jsonBodyParts(&$data, &$ci){
		$tpl = $this->_Controller->jsonBodyParts($data, $ci);		
	}



	/*json page*/
	function jsonPage(&$data, &$ci){
		$this->_Controller->jsonPage($data, $ci);
	}

	/*
	* 시군구 리스트 얻기
	*/
	function jsonGunguList(&$data, &$ci){
		$this->_Controller->jsonGunguList($data, $ci);		
	}

	function viewEvent(&$data, &$ci){
		$this->_Controller->_currentIsView();		

		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$data['view'] = $ci->eventModel->getFullInfoByCiseq($seq);
		//폐쇄몰 선언
		if($data['is_closed'] && $data['view']['ei_closed_display_flag'] != 'Y'){
			show_error('정상적인 접근이 아닙니다.');
			header('Location: /');			
			exit;
		}
		$data['view']['ei_img_banner'] = $this->_Controller->_path2url($data['view']['ei_img_banner']);
		$data['view']['top'] = $this->_Controller->_path2url($data['view']['ei_img_top']);
		$data['view']['middle'] = $this->_Controller->_path2url($data['view']['ei_img_middle']);
		$data['view']['bottom'] = $this->_Controller->_path2url($data['view']['ei_img_bottom']);
		


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

//		$ci->setFrame('medical2');
		$ci->addJs('/resource/js/popup_require_jq.js');
		$ci->addJs('/resource/js/eventcheck.jquery.js');
		$ci->addJs('/resource/mobile/assets/js/custom.js');
		return 'event/user_view';
	}


	function reserve(&$data, &$ci){
		$args = $ci->request->getAll();

		if(array_key_value('accept_one', $args) != 'Y'){
			$msg = array();
			if(array_key_value('accept_one', $args) != 'Y') $msg[] = '개인정보취급방침에 동의하셔야 합니다.';
//			if(array_key_value('accept_two', $args) != 'Y') $msg[] = '개인정보 3자 제공에 동의하셔야 합니다.';
			$data['msg'] = implode('\n', $msg);
			return 'script';
		}else if(!is_numeric(array_key_value('ei_seq', $args))){
			$data['msg'] = '이벤트가 존재하지 않습니다.';
			return 'script';
		}

		$list = $ci->eventModel->getFullInfoListTest(array($args['ei_seq']));
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

		$args['er_device'] = 'MOBILE';

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
			$data['sact'] = array('COMPLETE', 'PR');
		}else{
			$data['msg'] = $ci->reserveModel->error_message;
		}

		$ci->setFrame('noframe');		
		return 'script';		
	}

}
?>

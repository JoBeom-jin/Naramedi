<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventTest{

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

		$data['local'] = array();
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



		if($city) $paging->addWhere('ai_addr_text1', '=', $city);
		if($local) $paging->addWhere('ai_addr_text2', '=', $local);
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
		$seq = 57;
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

//		$ci->setFrame('medical2');
		$ci->addJs('/resource/js/popup_require_jq.js');
		$ci->addJs('/resource/js/eventcheck.jquery.js');
		$ci->addJs('/resource/mobile/assets/js/custom.js');

		$ci->setFrame('test');
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

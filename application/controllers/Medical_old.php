<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medical extends MY_Controller {

	private $CI = false;
	protected $_site_id = 'medical';						//선언된 사이트 아이디
	protected $_data = array();
	private $_is_closed = false;
	private $_closed_seq = false;
	private $_full_url =  false;

	function __construct() {
        parent::onInit();
		parent::setFrame('medical');
		parent::addCss('/resource/css/medical_common.css');

		$this->CI = & get_instance();	
		
		if($closed_seq = $this->CI->request->param('closed_seq', METHOD_BOTH, false)){			
			$args['closed_seq'] = $closed_seq;			
			$this->CI->session->set_userdata($args);
		}

		if($closed_seq = $this->CI->session->userdata('closed_seq')){
			$this->_is_closed = true;
			$this->_closed_seq = $closed_seq;
		}

		$this->_full_url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		if(!isset($_SERVER["HTTPS"])) {
			$redirect_url = 'https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			header("Location: {$redirect_url}");
			exit;					
		}
	}


	public function index(){
		if($this->MobileCheck() == 'Mobile'){
			header("Location: /m/");
			exit;
		}
		$this->setClosedData($this->_data);
		$controller = & parent::getController('Site_main');
		$tpl = $controller->index($this->_data, $this->CI);	
		$this->setFrame('medical');

		$this->load->model('Agency/AgencyModel', 'agencyModel');
		$this->load->model('Event/EventInfoModel', 'eventModel');

		//header meta tag : open graph 정보
		$_og_description = '온라인 건강검진 전문 커뮤니티. 오케이검진,건강검진예약,종합검진,해외검진,검진이벤트,검진비교,단체검진,검진할인,실속검진.';
		$this->_data['meta_datas'] = array();
		$this->_data['meta_datas'][] = '<meta name="description" content="'.$_og_description.'" />';
		$this->_data['meta_datas'][] = '<meta property="og:type" content="website" />';
		$this->_data['meta_datas'][] = '<meta property="og:title" content="OK검진" />';
		$this->_data['meta_datas'][] = '<meta property="og:url" content="'.$this->_full_url.'" />';
		$this->_data['meta_datas'][] = '<meta property="og:description" content="'.$_og_description.'" />';
		$this->_data['meta_datas'][] = '<meta property="og:image" content="http://okaymedi.com/resource/images/medical/common/logo.gif" />';
		$this->_data['html_title'] = '';


		$this->_data['accessable_menu_list'] = $this->setAccessableMenuList($this->_data['menu_list']);
		$this->_data['total_agency'] = $this->agencyModel->getTotal();
		$this->_data['member_agency'] = $this->agencyModel->getTotalMember();
		$this->_data['total_event'] = $this->eventModel->getTotalActive();	


		$this->addJS('/resource/assets/js/owl.carousel.min.js');
		$this->addJS('/resource/assets/js/lightslider.js');

		parent::viewPage('medical_view/'.$tpl, $this->_data);

	}


	public function contents(){		
		$_controller = $this->getControllerByMenu();						

		$action = $this->_action = $this->uri->segment(4, 'index');
		if(!method_exists($_controller, $action)) show_error('could not find method');

		$this->load->model('Event/EventCountModel', 'eventCountModel');

		$this->_data['act'] = $action;
		$this->_data['sact'] = array();
		$this->_data['msg'] = false;
		$this->_data['meta_datas'] = array();

		//header meta tag : open graph 정보
		$this->_data['meta_datas'] = array();

		$_og_description = '';
		if(array_key_exists('descript', $this->_data['menu1'])){
			$_og_description = $this->_data['menu1']['descript'];
		}
		$_og_title = array();
//		$_og_title[] = $this->_site_config['site']['title'];
		$_og_title[] = $this->_data['menu1']['title'];
		if(array_key_exists('menu2', $this->_data)){
			$_og_title[] = $this->_data['menu2']['title'];

			if(array_key_exists('descript', $this->_data['menu2'])){
				$_og_description = $this->_data['menu2']['descript'];
			}
		}

		$_og_title = implode(' &gt; ', $_og_title);		

		$this->_data['meta_datas'][] = '<meta name="description" content="'.$_og_description.'" />';
		$this->_data['meta_datas'][] = '<meta property="og:type" content="website" />';
		$this->_data['meta_datas'][] = '<meta property="og:title" content="'.$_og_title.'" />';
		$this->_data['meta_datas'][] = '<meta property="og:url" content="'.$this->_full_url.'" />';
		$this->_data['meta_datas'][] = '<meta property="og:description" content="'.$_og_description.'" />';
		$this->_data['meta_datas'][] = '<meta property="og:image" content="http://okaymedi.com/resource/images/medical/common/logo.gif" />';
		$this->_data['html_title'] = $_og_title;


		$this->setClosedData($this->_data);

		$_controller->onInit($this->CI);
		$this->_data['accessable_menu_list'] = $this->setAccessableMenuList($this->_data['menu_list']);
		$tpl = $_controller->$action($this->_data, $this->CI);

		if($tpl != 'script') $tpl = 'medical_view/'.$tpl;
		parent::viewPage($tpl, $this->_data);
	}


	function setClosedData(&$data){

		$data['is_closed'] = false;				
		$data['shop_name'] = false;
		$data['shop_logo'] = false;


		if($this->_is_closed){
			$this->CI->load->model('CloseShop/CloseShopModel', 'shopModel');
			$row = $this->shopModel->getRowBySeq($this->_closed_seq);

			if($row && array_key_exists('cs_name', $row) && array_key_exists('cs_file_path', $row)){
				$data['is_closed'] = true;				
				$data['shop_name'] = $row['cs_name'];

				$this->CI->load->helper('my_file');
				$data['shop_logo'] = path2url_($row['cs_file_path']);
			}
		}


		if(!$data['is_closed'] || !$data['shop_name'] || !$data['shop_logo']){
			$data['shop_name'] = $this->_site_config['site']['title'];		
		}

	}


	function setAccessableMenuList($menu_list){
		if(is_array($menu_list) && count($menu_list)){
			foreach($menu_list as $k => $v){

				if(is_array($v)){
					if(array_key_exists('hidden', $v) && $v['hidden']){
						unset($menu_list[$k]);
						continue;
					}

					if(array_key_exists('access_groups', $v) && !$this->auth->inGroups($v['access_groups'])){
						unset($menu_list[$k]);
						continue;
					}

					if(array_key_exists('childs', $v) && count($v['childs'] > 0)){
						$menu_list[$k]['childs'] = $this->setAccessableMenuList($menu_list[$k]['childs']);
					}
				}
			}
		}

		return $menu_list;
	}

	function html(){
		$id = $this->request->param('id', METHOD_BOTH, false);

		$list = array(
				'hosinfo' => 'html/hospital_info'
			);
		
		if(!in_array($id, array_keys($list) )) show_error('there is no html is '.$id);
		
		$action = 'do'.ucfirst($id);
		$this->$action($this->_data);
		$this->setFrame('noframe');
		parent::viewPage($list[$id], $this->_data);
	}

	function doHosinfo(&$data){
		$ai_seq = $this->request->param('seq', METHOD_BOTH, false);	
		$this->load->model('Agency/AgencyModel', 'agencyModel');
		$this->load->model('Agency/AgencyImageModel', 'imagesModel');
		$this->load->model('Members/Hospital', 'hospitalModel');

		$data['agency'] = $this->agencyModel->getFullInfoBySeq($ai_seq);
		$data['images'] = $this->imagesModel->getListByAiseq($ai_seq);
		if(!isArray_($data['images'])){
			$default_image['url'] = '/resource/images/medical/map_images/modal_noimage.jpg';
			$data['images'][] = $default_image;
		}
		
		$map_url = 'https://www.google.co.kr/maps/dir//';
		$string = array();

		if($data['agency']['ai_addr']){
//			$query[] = $data['agency']['ai_addr'];
			$temps = explode(' ', $data['agency']['ai_addr']);
			$addr = $temps[0].' '.$temps[1].' '.$temps[3];
			$query[] = $data['agency']['ai_name'].' '.$addr;
		}

		$ai_x = '';
		$ai_y = '';
		if($data['agency']['ai_x'] != 'nodata' &&  $data['agency']['ai_x']) $ai_x = $data['agency']['ai_x'];
		if($data['agency']['ai_y'] != 'nodata' &&  $data['agency']['ai_y']) $ai_y = $data['agency']['ai_y'];

		$query[] = $ai_x.','.$ai_y.','.'16z';		
		
		if(isArray_($query)){
			$map_url = $map_url.implode('/@', $query);
		}else{
			$map_url = false;
		}

		$data['map_url'] = $map_url;

		$data['is_member'] = $this->hospitalModel->isMemberByAiseq($ai_seq);
		if($data['is_member']){
			$data['has_event'] = $this->hospitalModel->hasEventByAiseq($ai_seq);
		}else $data['has_event'] = false;

//		print_r($data['agency']);
//		exit;

		//전화번호
		$data['phone_number'] = false;
		if(array_key_exists('hi_system_phone', $data['agency']) && $data['agency']['hi_system_phone'] ){
			$phone_number = $data['agency']['hi_system_phone'];
			$data['phone_number'] = substr($phone_number, 0, 4).'-'.substr($phone_number, 4, 4).'-'.substr($phone_number, 8);
		}
//		else if(array_key_exists('hi_revmng_phone', $data['agency'])) $data['phone_number'] = $data['agency']['hi_revmng_phone'];
		if(!$data['phone_number'] && array_key_exists('ai_phone', $data['agency'])) $data['phone_number'] = $data['agency']['ai_phone'];
		if(!$data['phone_number']) $data['phone_number'] = false;

		if($this->auth->isLogin()) $data['can_reply'] = true;
		else $data['can_reply'] = false;

		$this->load->model('Event/UserReplyModel', 'replyModel');
		$data['can_star'] = $this->replyModel->canStar($data['agency']['ai_number']);
		$data['avg'] = $this->replyModel->getTotalByAiseq($ai_seq);
		$data['comments'] = $this->replyModel->getListByAiseq($ai_seq);		
	}

	function bizcall(){
		$this->load->model('Bizcall/BizcallModel', 'bizcallModel');
		$bizcall_data = $this->_getBizcallData();

		if($bizcall_data['error'] == 0){
			$this->bizcallModel->insertArgs($bizcall_data);

			if($bizcall_data['first_flag']){

			}
		}


		$json_data['rt'] = $bizcall_data['error'];
		$json_data['rs'] = $this->bizcallError($bizcall_data['error']);

		header('Content-Type: application/json;charset=utf-8');
		$json = json_encode($json_data);
		echo $json;
		exit;
	}

	private function _getBizcallData(){
		$args['error'] = '0';
		$args['first_flag'] = true;

		$callid = $this->request->param('callid', METHOD_BOTH, false);

		if(is_numeric($callid)){		//콜 시작 파라메터
			$args['bz_seq'] = $callid;
		}else{	//콜 종료 파라메터
			$args['bz_seq'] = $this->request->param('seq');
			$args['first_flag'] = false;
		}

		if(!$args['bz_seq']){
			$args['error'] = '01';
			return $args;
		}	

		$args['bz_sdt'] = $this->request->param('sdt', METHOD_BOTH, false);
		$args['bz_edt'] = $this->request->param('edt', METHOD_BOTH, false);
		$args['bz_swidt'] = $this->request->param('swidt', METHOD_BOTH, false);
		$args['bz_fromn'] = $this->request->param('fromn', METHOD_BOTH, false);
		$args['bz_vn'] = $this->request->param('vn', METHOD_BOTH, false);
		$args['bz_ton'] = $this->request->param('ton', METHOD_BOTH, false);
		$args['bz_crid'] = $this->request->param('crid', METHOD_BOTH, false);
		$args['bz_irid'] = $this->request->param('irid', METHOD_BOTH, false);
		$args['bz_memo'] = $this->request->param('memo', METHOD_BOTH, false);
		$args['bz_memo2'] = $this->request->param('memo2', METHOD_BOTH, false);
		$args['bz_cause'] = $this->request->param('cause', METHOD_BOTH, false);
		$args['bz_closed_from'] = $this->request->param('closed_from', METHOD_BOTH, false);
		$args['bz_indur'] = $this->request->param('indur', METHOD_BOTH, false);
		$args['bz_outdur'] = $this->request->param('outdur', METHOD_BOTH, false);

		return $args;
	}

	private function bizcallError($number){
		$error = array(
			'0' => 'success',
			'01'=>'call id or call seq undefined!',		
		);

		return $error[$number];
	}

	
	function MobileCheck() { 		
		$MobileArray  = array("iphone","lgtelecom","skt","mobile","samsung","nokia","blackberry","android","android","sony","phone");

		$checkCount = 0; 
			for($i=0; $i<sizeof($MobileArray); $i++){ 
				if(preg_match("/$MobileArray[$i]/", strtolower($_SERVER['HTTP_USER_AGENT']))){ $checkCount++; break; } 
			} 
	   return ($checkCount >= 1) ? "Mobile" : "Computer"; 
	}

}

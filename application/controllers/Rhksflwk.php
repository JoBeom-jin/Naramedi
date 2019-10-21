<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rhksflwk extends MY_Controller {

	private $CI = false;
	protected $_site_id = 'hospital';						//선언된 사이트 아이디
	protected $_data = array();
	
	private $_access_groups = array('SUPERVISOR', 'HOSPITAL');

	function __construct() {	


        parent::onInit();
		parent::setFrame('hospital_manager');
		parent::addCss('/resource/css/manager.css');
		parent::addJs('/resource/js/jquery/jquery-1.12.3.min.js');

		$this->CI = & get_instance();
	}


	public function index(){
		$act = $this->request->param('bact', METHOD_BOTH, 'main');
		$access_menu = array('loginOk', 'join', 'joinOk', 'search', 'find','findOk');
		if(!$this->_checkAuth() && !in_array($act, $access_menu) ) $act = 'login';		

		$data['bact'] = $act;

		$action = 'do'.ucfirst($act);
		$tpl = $this->$action($this->_data);
		
		if($tpl != 'script') $tpl = 'hospital_views/'.$tpl;
		parent::viewPage($tpl, $this->_data);		
	}


	public function contents(){		

		if(!$this->_checkAuth()){			
			if($this->auth->isLogin()) $this->auth->logout();
			header('Location: /index.php/rhksflwk/');
			exit;
		}	

		$_controller = $this->getControllerByMenu();						

		$action = $this->_action = $this->uri->segment(4, 'index');
		if(!method_exists($_controller, $action)) show_error('could not find method');

		$this->_data['act'] = $action;
		$this->_data['sact'] = array();
		$this->_data['msg'] = false;

		$this->_data['_info'] = $this->hospitalModel->getInfoByMeseq($this->auth->seq());
		
		$_controller->onInit($this->CI);
		$this->_data['accessable_menu_list'] = $this->setAccessableMenuList($this->_data['menu_list']);
		$tpl = $_controller->$action($this->_data, $this->CI);

		if($tpl != 'script') $tpl = 'hospital_views/'.$tpl;
		parent::viewPage($tpl, $this->_data);
	}


	/*
	* 로그인 메인 페이지
	*/
	function doMain(&$data){

		$controller = & parent::getController('Event_EventReserve');
		$controller->onInit($this->CI);
		$this->_data['accessable_menu_list'] = $this->setAccessableMenuList($this->_data['menu_list']);
		$tpl = $controller->index($data, $this->CI);	
		
		$_info = $this->hospitalModel->getInfoByMeseq($this->auth->seq());
		$this->load->Model('Event/EventReserveModel', 'reserveModel');
		$data['event_rsv_count'] = $this->reserveModel->countTodayReserveByStatus(false, $_info['hi_org_number']);
		$data['phone_not_count'] = $this->reserveModel->countReserveByStatus(array('STS004'), $_info['hi_org_number'], true);
		$data['phone_wait_count'] = $this->reserveModel->countReserveByStatus(array('STS001'), $_info['hi_org_number']);

		$reserved_codes = $this->reserveModel->getReservedCode();
		$data['phone_reserved_count'] = $this->reserveModel->countReserveByStatus($reserved_codes, $_info['hi_org_number']);

		$this->load->model('Board/BoardContentsModel', 'boardModel');
		$data['article_list'] = $this->boardModel->getArticleByBcid('noticehospital');


		return $tpl;
	}

	/*
	* 로그인 페이지
	*/
	function doLogin(&$data){
		$this->auth->logout();
		$controller = & parent::getController('Login_login');
		$controller->onInit($this->CI);
		$tpl = $controller->index($data, $this->CI);

		$this->setFrame('noframe');
		return $tpl;
	}

	/*
	* 로그인 확인
	*/
	function doLoginOk(&$data){
		$controller = & parent::getController('Login_login');
		$tpl = $controller->loginOk($data, $this->CI);
		
		if($this->auth->isLogin() && $this->auth->inGroups($this->_access_groups)){
			$this->load->model('Members/Hospital', 'hospitalModel');
			$args = $this->hospitalModel->row('*', array('hi_meseq' => $this->auth->seq()));
			if(!is_array($args) || !array_key_exists('hi_active', $args) || !$args['hi_active']){
				$data['msg'] = '신청되지 않은 아이디 입니다.\n신규회원 가입해주세요.';				
				return 'script';
			}
			else if(array_key_exists('hi_active', $args) && $args['hi_active'] == 'N'){
				$data['msg'] = '회원 승인 대기중입니다.\n관리자의 승인 이후에 로그인이\n가능합니다.';
				return 'script';
			}

		}else{
			$this->auth->logout();
			$data['msg'] = '아이디 혹은 비밀번호가 잘못되었습니다.';
			return 'script';
		}

		return $tpl;
	}

	/*
	* 신규회원 가입
	*/
	function doJoin(&$data){		
		$_controller = &$this->getController('Member_HospitalMember');
		$_controller->onInit($this);
		$_controller->insertMember($data, $this);

		$this->addCss('/resource/css/login.css');
		$this->setFrame('noframe');
		return 'Login/join_form';
	}

	function doJoinOk(&$data){
		$data['sact'] = false;
		$data['msg'] = false;

		$_controller = $this->getController('Member_HospitalMember');
		$_controller->onInit($this);
		$tpl = $_controller->insertMemberOk($data, $this);
		
		if($data['msg'] == '정상적으로 등록되었습니다.'){
			$data['msg'] = '정상적으로 신청 되었습니다. 관리자의 승인 후 사용하실 수 있습니다.';
			$data['sact'] = 'PR';
		}

		return $tpl;
	}

	/*
	* 회원 가입시 검진기관 찾기
	*/	
	function doSearch(&$data){
		$this->load->model('Agency/AgencyModel', 'agencyModel');	
		$data['ai_name'] = $search_txt = $this->request->param('ai_name', METHOD_BOTH, false);

		$data['list'] = array();
		if($search_txt){
			$data['list'] = $this->agencyModel->searchByName($search_txt, true);
		}
		$this->setFrame('window');
		return 'Login/search';		
	}


	/*
	* 비밀번호 찾기
	*/
	function doFind(&$data){

		$this->addCss('/resource/css/login.css');
		$this->setFrame('noframe');
		return 'Login/find_password';
	}

	function doFindOk(&$data){
		
		$this->load->model('Members/hospital', 'hospitalModel');
		$this->load->model('Members/Members', 'memberModel');

		$me_id = $this->request->param('me_id', METHOD_POST, false);
		if(!$me_id){
			$data['msg'] = '아이디를 입력해주세요.';
			return 'script';
		}

		$email = false;
		$row = $this->memberModel->getMemberById($me_id);
		if($row && array_key_exists('me_seq', $row)){
			$where = array('hi_meseq' => $row['me_seq']);
			$hos_info = $this->hospitalModel->row('*', $where);
			if($hos_info && array_key_exists('hi_mng_email', $hos_info)){
				$email = $hos_info['hi_mng_email'];
			}
		}

		if(!$email){
			$data['msg'] = '이메일 정보를 찾을 수 없습니다.';
			return 'script';
		}

		$this->load->library('email');
		
		$config['useragent'] = "CodeIgniter";
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_user'] = 'okaymedi@gmail.com';
		$config['smtp_pass'] = '1q2w3e4r!';
		$config['smtp_port'] = 465;
		$config['wordwrap'] = TRUE;
//		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		$this->email->clear(true);

		srand(time());
		$new_pass = substr(md5(uniqid(rand(), true)), 0, 8);		

		
		$this->email->from('okaymedi@gmail.com', 'OK MEDICAL');
		$this->email->to($email);
		$this->email->subject('임시 비밀번호가 발급되었습니다.');
		$this->email->message('오케이 메디컬 임시 비밀번호는 ['.$new_pass.'] 입니다.로그인 하신 뒤 반드시 비밀번호를 변경해주세요.');

		if($this->email->send()){
			$this->memberModel->changePass($new_pass, $row['me_seq']);
			$data['msg'] = '임시 비밀번호가 이메일로 발송되었습니다.';
			$data['sact'] = array('PR');
		}else{
//			$msg = $this->email->print_debugger();			
			$data['msg'] = '메일 서버 문제로 인하여 메일을 전송하지 못하였습니다. 관리자에게 문의하세요.';
			return 'script';
			exit;
		}
		
		return 'script';
	}



	private function _can_access_menu(){
		$logout_accesssable_menus = array('login');
		if(in_array($this->_data['cmenu']['menu_code'], $logout_accesssable_menus)) return true;

		$site_accesssable_groups = $this->_site_config['adminGroup'];
		if(!$this->auth->inGroups($site_accesssable_groups)) return false;

		$access_groups = $this->menu->getAccessGroup();
		if(!$this->auth->inGroups($access_groups)) return false;


		return true;
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

	private function _checkAuth(){
		if($this->auth->isLogin() && $this->auth->inGroups($this->_access_groups)){			
			$this->load->model('Members/Hospital', 'hospitalModel');
			if($this->hospitalModel->existActiveByMeseq($this->auth->seq())) return true;
		}
		return false;
	}





}

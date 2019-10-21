<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends MY_Controller {

	private $CI = false;
	protected $_site_id = 'cms';						//선언된 사이트 아이디
	protected $_data = array();

	function __construct() {

        parent::onInit();
		parent::setFrame('manager');
		parent::addCss('/resource/css/manager.css');
		parent::addJs('/resource/js/jquery/jquery-1.12.3.min.js');

		$this->CI = & get_instance();
		$this->_full_url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		if( ENVIRONMENT != 'development')
		{
			// if(!isset($_SERVER["HTTPS"])) {
			// 	$redirect_url = 'https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			// 	header("Location: {$redirect_url}");
			// 	exit;
			// }
		}
	}


	public function index(){
		if(!$this->auth->isLogin()){
			$controller = & parent::getController('Login_login');
			$tpl = $controller->index($this->_data, $this->CI);
			$this->setFrame('default');
		}else{
			$next_url = false;
			$groups = $this->auth->groups();

			if($this->chk->isArray($groups)){
				foreach($this->_site_config['first_menu'] as $k => $v){
					if(in_array($k, $groups)){
						$next_url = $v;
						break;
					}
				}
			}

			if($next_url){
				header("Location: {$next_url}");
				exit;
			}else{
				if($this->auth->isLogin()) $this->auth->logout();
				header("Location: /index.php/manager");
				exit;
			}
		}

		parent::viewPage('manager_views/'.$tpl, $this->_data);
	}


	public function contents(){

		if(!$this->_can_access_menu()){
			if($this->auth->isLogin()) $this->auth->logout();
			header('Location: /index.php/manager/');
			exit;
		}

		$_controller = $this->getControllerByMenu();

		$action = $this->_action = $this->uri->segment(4, 'index');
		if(!method_exists($_controller, $action)) show_error('could not find method');

		$this->_data['act'] = $action;
		$this->_data['sact'] = array();
		$this->_data['msg'] = false;

		$_controller->onInit($this->CI);
		$this->_data['accessable_menu_list'] = $this->setAccessableMenuList($this->_data['menu_list']);
		$tpl = $_controller->$action($this->_data, $this->CI);

		if($tpl != 'script') $tpl = 'manager_views/'.$tpl;
		parent::viewPage($tpl, $this->_data);
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

					if(array_key_exists('childs', $v) && count($v['childs']) > 0){
						$menu_list[$k]['childs'] = $this->setAccessableMenuList($menu_list[$k]['childs']);
					}
				}
			}
		}

		return $menu_list;
	}
}

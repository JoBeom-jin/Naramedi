<?
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $_site_config = false;
	public $_params = array();

	protected $_site_id = false;						//선언된 사이트 아이디
	protected $_data = array();	
	protected $_auth_model = false;
	protected $_menu_segment_number = 3;

	private $_config_folder = false;
	private $_controllers = array();
	private $_header_common = false;
	private $_header = false;	
	private $_footer = false;
	private $_css = array();
	private $_js = array();

	/*
	* 해당 사이트 아이디를 통해 사이트를 초기화 시킨다.
	*/
	function onInit(){	
		parent::__construct();		
		if(!$this->chk->hasText($this->_site_id)) show_404();		
		$this->_setConfig();
		$this->_setMenuList();
		$this->_setData();
		
		if($this->_auth_model){
			$this->load->model($this->_auth_model, 'memberModel');
			$model = & $this->memberModel;
			$this->load->library('Auth', array('model'=>$model) );
		}
	}


	/*
	* site 설정 파일을 로드하여 할당한다.
	*/
	private function _setConfig(){		
		$this->_config_folder = $this->_site_id.'_config';
		$this->load->config($this->_config_folder.'/config');
		$this->_site_config = $this->config->item('site_config');		
		$this->_auth_model = $this->_site_config['auth']['model'];
		if(!$this->_site_config) show_404();
	}


	/*
	* menu type에 따라 
	* 메뉴 인스턴스를 생성하고, 정보를 할당한다.
	*/
	private function _setMenuList(){
		if(!$this->_site_config['menu']) show_error('could not find menu information in config');
		$menu_config = &$this->_site_config['menu'];		

		switch($menu_config['type']){
			case 'file' : $menu_list = & $this->_getMenuListFromFile(); break;
			case 'db' : $menu_list = & $this->_getMenuListFromDatabase(); break;
			default : show_error('Menu type is undefined or wrong');
		}

		$params['menu_list'] = &$menu_list;
		$params['menu_code'] = $this->_getMenuCodeByUri();
		return $this->load->library('Menu', $params);		
	}


	/*
	* 파일에서 사이트의 메뉴 리스트를 얻습니다.
	*/
	private function & _getMenuListFromFile(){		
		$this->load->config($this->_config_folder.'/menu_list');
		$menu_list = $this->config->item('menu_list');		
		if(!$menu_list) show_error('menu list is undefined!');
		return $menu_list;
	}

	/*
	* 컨트롤러 객체의 반환
	*/
	function & getController($controller_class_name){	

		if($this->chk->hasText($controller_class_name)){			
			if(array_key_exists($controller_class_name, $this->_controllers)) return $this->_controllers[$controller_class_name];
			else{
				list($folder, $file) = explode('_', $controller_class_name);
				$path = APPPATH.'controllers'.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$file.'.php';

				if(!is_file($path)) show_error('could not find Page Controller defined!');
				require_once $path;
				if(!class_exists($file)) show_error('could not find Page Controller class defined!');
				$this->_controllers[$controller_class_name] = new $file();
			}
		}

		return $this->_controllers[$controller_class_name];
	}

	/*
	* frame 정보를 합쳐서 화면에 출력한다.
	* @$html_file : 출력할 view 파일
	*/
	function viewPage($html_file, & $data){
		$data['css'] = $this->getCssString();
		$data['js'] = $this->getJsString();

		if($html_file == 'script') $this->setFrame('noframe');		
		if($this->_header_common) $this->load->view($this->_header_common, $data);
		if($this->_header) $this->load->view($this->_header, $data);
		$this->load->view($html_file, $data);
		if($this->_footer) $this->load->view($this->_footer, $data);		
	}


	/*
	* css print html
	*/
	function getCssString(){
		$string= array();
		if($this->chk->isArray($this->_css)){			
			foreach($this->_css as $css){
				$string[] = '<link href="'.$css.'" rel="stylesheet" type="text/css" />';
			}			
		}
		return implode(PHP_EOL, $string);
	}

	/*
	* js print html
	*/
	function getJsString(){
		$string= array();
		if($this->chk->isArray($this->_js)){			
			foreach($this->_js as $js){
				$string[] = '<script type="text/javascript" src="'.$js.'"></script>';
			}			
		}
		return implode(PHP_EOL, $string);
	}


	
	/*
	* css 파일 추가
	*/
	function addCss($css){
		if(!is_array($css) && $this->chk->hasText($css) ) $css = array($css);
		if($this->chk->isArray($css)){
			foreach($css as $file){
				$this->_css[] = $file;
			}
		}		
	}


	/*
	* js 파일 추가
	*/
	function addJs($js){
		if(!is_array($js) &&$this->chk->hasText($js) ) $js = array($js);
		if($this->chk->isArray($js)){
			foreach($js as $file){
				$this->_js[] = $file;
			}
		}		
	}

	/*
	* frame id 값을 이용하여 출력할 frame을 세팅
	*/
	function setFrame($id='default'){
		$this->load->config($this->_config_folder.'/frames');
		$frames = $this->config->item('frames');	
		$this->_header = $frames[$id]['header'];	
		$this->_footer = $frames[$id]['footer'];
		
		$this->_header_common = array_key_value('header_common', $frames[$id]);
	}

	/*
	* 상속된 컨트롤러로 돌려줄 데이터
	*/
	private function _setData(){
		$this->_data['site_id'] = $this->_site_id;		
		$this->_data['menu_list'] = $this->menu->getMenuList();
		$this->_data['cmenu'] = $this->menu->getCmenu();
		$this->_data['menu1'] = $this->menu->getMenu1();
		$this->_data['menu2'] = $this->menu->getMenu2();
		$this->_data['menu3'] = $this->menu->getMenu3();
		$this->_data['menu_code'] = $this->menu->getMenuCode();
		$this->_data['menu_url'] = $this->_site_config['url']['contents'].'/'.$this->_data['menu_code'];
		$this->_data['contents_url'] = $this->_site_config['url']['contents'];

		foreach($this->_site_config as $k => $config){
			$this->_data['_site_config'][$k] = $config;
		}

		$this->_data['_Auth'] = & $this->auth;
	}

	
	function & getControllerByMenu(){
		$controller_id = $this->menu->getController();
		return $this->getController($controller_id);
	}

	function getMenuParams($id){
		
		if( array_key_exists('params', $this->_data['cmenu']) && array_key_exists($id, $this->_data['cmenu']['params']) )	return $this->_data['cmenu']['params'][$id];

		return false;
	}
	
	function getParams(){
		return $this->uri->uri_to_assoc(5);
	}

	private function _getMenuCodeByUri(){
		return $this->uri->segment($this->_menu_segment_number);
	}
}

?>
<?
class Menu{
	private $_menu_list;
	private $_menu_code;
	private $_method;
	private $_cmenu;
	private $_menu1;
	private $_menu2;
	private $_menu3;
	private $_navigations;
	private $_action;

	function __construct($params){
		$this->_menu_list = $params['menu_list'];
		$this->_menu_code = $params['menu_code'];

		$this->onInit();
	}

	function onInit(){
		if(!is_string($this->_menu_code) || $this->_menu_code == '') $this->_method = 'index';
		else $this->_method = 'contents';	

		if($this->_method == 'contents') $this->_resolveMenu();
	}

	/*
	* 변수에 메뉴에 대한 정보를 할당합니다. 메뉴는 3댑스로 제한
	* cmenu : 현재메뉴 
	* menu1 : 1댑스 메뉴
	* menu2 : 2댑스 메뉴
	* menu3 : 3댑스 메뉴
	* navigation : 네비게이션 정보
	*/
	private function _resolveMenu(){
		$_menu_codes = explode('_', $this->_menu_code);
		if(!is_array($_menu_codes) || count($_menu_codes) < 1) show_404();

		$_cmenu = false;
		$_depth = 0;
		$_location_codes = array();
		foreach($_menu_codes as  $code){
			$_depth++;
			if($_depth > 3) break;

			$_location_codes[] = $code;
			if(!is_string($code) || $code == '') show_404();

			if($_depth == 1) $_cmenu = $this->_menu_list[$code];
			else $_cmenu = $_cmenu['childs'][$code];

			if(!is_array($_cmenu)) show_404();
			$_cmenu['menu_code'] = $code;
			$temp_string = '_menu'.$_depth;
			$this->$temp_string = $_cmenu;

			
			$this->_navigations[] = array('name'=>$_cmenu['title'], 'url'=>implode('_', $_location_codes).'/');
		}

		$this->_cmenu = $_cmenu;		
	}

	function getMenuList(){
		return $this->_menu_list;
	}

	function getCmenu(){
		return $this->_cmenu;
	}

	function getMenu1(){
		return $this->_menu1;
	}

	function getMenu2(){
		return $this->_menu2;
	}

	function getMenu3(){
		return $this->_menu3;
	}

	function getMethod(){
		return $this->_method;
	}

	function getController(){
		$controller_id = $this->_cmenu['controller'];
		if(!is_string($controller_id) || $controller_id =='') return false;
		return $controller_id;
	}

	function getAccessGroup(){
		return $this->_cmenu['access_groups'];
	}

	function getMenuCode(){
		return $this->_menu_code;
	}
}
?>
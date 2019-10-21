<?
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth{	

	private $_auth_model = false;

	function __construct(&$params){	
		$this->_auth_model = &$params['model'];		
	}

	function isLogin() {
		return $this->_auth_model->isLogin();
	}

	function loginByIdPass($id, $pass){
		return $this->_auth_model->loginByIdPass($id, $pass);		
	}

	function logout(){
		$this->_auth_model->logOut();
	}


	function id(){
		return $this->_auth_model->getId();
	}

	function seq(){
		return $this->_auth_model->getSeq();
	}

	function name(){
		return $this->_auth_model->getName();
	}

	function groups(){
		return $this->_auth_model->getGroups();
	}

	function isManager(){
		return $this->_auth_model->isManager();
	}

	function inGroups($groups=false){
		return $this->_auth_model->inGroups($groups);
	}

	function loginBySNS($email, $type){
		return $this->_auth_model->loginBySNS($email, $type);			
	}

}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login{

	private $_url_login = '/index.php/manager/contents/login_login/loginOk';


	function onInit(&$ci){
	}


	function index(&$data, &$ci){	
		$ci->addCss('/resource/css/login.css');
		
		$data['login_url'] = $this->_url_login;
		return 'Login/login';
	}


	function loginOk(&$data, &$ci){
		$data['msg'] = false;
		$data['sact'] = false; 

		$id = $ci->input->post('user_id');
		$pass = $ci->input->post('user_password');

		if(!$ci->chk->hasText($id)){
			$data['msg'] = '아이디는 반드시 입력하셔야 합니다.';
		}
		else if(!$ci->chk->hasText($pass)){
			$data['msg'] = '비밀번호는 반드시 입력하셔야 합니다.';
		}
		else{

			$ci->auth->loginByIdPass($id, $pass);			
			

			if(!$ci->auth->isLogin()){
				$data['msg'] = '아이디를 찾을 수 없거나 비밀번호가 다릅니다.';				
			}
			else{
				$data['msg'] = '환영합니다.';				
				$data['sact'] = 'PR';
			}

		}		
		
		
		return 'script';
	}

	function logoutOk(&$data, &$ci){
		$ci->auth->logout();
		$data['msg'] = '안녕히 가십시오.';
		$data['sact'] = 'PR';
		return 'script';
	}


}

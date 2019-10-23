<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Joinout{

	private $_url_login = '/index.php/manager/contents/login_login/loginOk';


	function onInit(&$ci){
	}


	function index(&$data, &$ci){
		$ci->setFrame('window');
		return 'login/join_out';
	}

	function outMember(&$data, &$ci){
		if($ci->auth->isLogin()){
			$me_seq = $ci->auth->seq();
			$ci->load->model('Members/Members', 'memberModel');
			$ci->memberModel->deleteByMeSeq($me_seq);
		}

		$data['msg'] = '회원탈퇴가 정상적으로 처리되었습니다.\n감사합니다. ';
		$data['sact'] = 'SCLZ';
		return 'script';
	}
	

}

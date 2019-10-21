<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class logout{

	function onInit(&$ci){
	}


	function index(&$data, &$ci){	
		if($ci->auth->isLogin()) $ci->auth->logout();

		$data['msg'] = '안녕히 가세요.';
		$data['sact'] = 'PR';
		return 'script';
	}
}

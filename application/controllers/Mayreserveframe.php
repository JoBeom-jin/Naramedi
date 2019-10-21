<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mayreserveframe extends CI_Controller {
	private $_types = array();
	function __construct(){
		parent::__construct();
		$this->load->model('Hansin/HansinUserModelMay', 'userModel');
		$this->_types = $this->userModel->getTypes();
	}

	public function index(){
		// $this->output->cache(600);
		$data = false;
		$data['types'] = $this->_types;
		$this->load->view('MayReserveFrame/hasinmedipia_web', $data);
	}

	function acception(){
		$data = false;
		$this->load->view('MayReserveFrame/hasinmedipia_accept', $data);
	}

	function insertOk(){
		$data['msg'] = false;
		$data['sact'] = false;

		$args = $this->input->post();
		if($msg = $this->_checkArgs($args)){
			$data['msg'] = $msg;
			$this->load->view('MayReserveFrame/script', $data);
		}else{
			$args['hu_name'] = $this->removeXss($args['hu_name']);
			$args['hu_phone'] = implode('', $args['phone']);
			if(is_string($args['hu_comment'])) $args['hu_comment'] = $this->removeXss($args['hu_comment']);
			$args['hu_ctime'] = time();
			$args['hu_cip'] = $_SERVER['REMOTE_ADDR'];

			$sql_string = "insert into hansinmedi_user (hu_name, hu_type_code, hu_phone, hu_comment, hu_email, hu_ctime, hu_cip, hu_accept, hu_code) values ('{$args['hu_name']}','{$args['hu_type_code']}','{$args['hu_phone']}','{$args['hu_comment']}','{$args['hu_email']}',{$args['hu_ctime']},'{$args['hu_cip']}','{$args['hu_accept']}','{$args['hu_code']}'  );";

			$this->db->query($sql_string);

			$data['msg'] = '정상 접수되었습니다.';
			$data['sact'] ='PR';
			$this->load->view('MayReserveFrame/script', $data);
		}
	}

	private function _checkArgs(&$args){

		$error_msg = false;
		if(!array_key_exists('hu_accept', $args) || $args['hu_accept'] != 'y') $error_msg = '개인정보취급방침에 동의하여 주세요.';
		else if(!is_string($args['hu_name']) || strlen($args['hu_name']) < 1) $error_msg = '신청자 이름을 입력해주세요.';
		else if(!is_string($args['hu_type_code']) || strlen($args['hu_type_code']) < 1) $error_msg = '검진항목을 선택해주세요.';
		else if(!$args['phone'][0] || !is_numeric($args['phone'][0]) || strlen($args['phone'][0]) > 4) $error_msg = '연락처가 비었거나 형식에 맞지 않습니다. 다시 확인해주세요.';
		else if(!$args['phone'][1] || !is_numeric($args['phone'][1]) || strlen($args['phone'][1]) > 4) $error_msg = '연락처가 비었거나 형식에 맞지 않습니다. 다시 확인해주세요.';
		else if(!$args['phone'][2] || !is_numeric($args['phone'][2]) || strlen($args['phone'][2]) > 4) $error_msg = '연락처가 비었거나 형식에 맞지 않습니다. 다시 확인해주세요.';
		// else if(!is_string($args['hu_email']) || !filter_var($args['hu_email'], FILTER_VALIDATE_EMAIL)) $error_msg = '이메일이 형식에 맞지 않습니다. 다시 입력해주세요.';

		return $error_msg;
	}

	private function removeXss($str){
		$str = strip_tags($str);
		if(preg_match('/<\/?(script|style)/m', $str)) $str = preg_replace('/<\/?(script|style)/m', '', $str);
		$str = str_replace("'", '', $str);
		$str = str_replace('"', '', $str);
		return $str;
	}
}
?>

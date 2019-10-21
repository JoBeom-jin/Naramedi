<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kosforeserveframe extends CI_Controller {
	private $_types = array();
	function __construct(){
		parent::__construct();
		$this->load->model('Hansin/HansinUserModelKosfo', 'userModel');
		$this->_types = $this->userModel->getTypes();
	}

	public function index(){
		// $this->output->cache(600);
		$data = false;
		$data['types'] = $this->_types;
		$this->load->view('KosfoReserveFrame/hasinmedipia_web', $data);
	}

	function acception(){
		$data = false;
		$this->load->view('KosfoReserveFrame/hasinmedipia_accept', $data);
	}

	function insertOk(){
		$data['msg'] = false;
		$data['sact'] = false;

		$args = $this->input->post();
		if($msg = $this->_checkArgs($args)){
			$data['msg'] = $msg;
			$this->load->view('KosfoReserveFrame/script', $data);
		}else{
			$args['hu_name'] = $this->removeXss($args['hu_name']);
			$args['hu_phone'] = $args['phone'];
			if(is_string($args['hu_comment'])) $args['hu_comment'] = $this->removeXss($args['hu_comment']);
			$args['hu_ctime'] = time();
			$args['hu_cip'] = $_SERVER['REMOTE_ADDR'];
			$hu_type = $args['hu_type_code'].$args['hu_type_code_sub'];

			// $this->db->set('hu_name', $args['hu_name']);
			// $this->db->set('hu_type_code', $args['hu_type_code']);
			// $this->db->set('hu_phone', $args['hu_phone']);
			// $this->db->set('hu_comment', $args['hu_comment']);
			// $this->db->set('hu_email', $args['hu_email']);
			// $this->db->set('hu_ctime', $args['hu_ctime']);
			// $this->db->set('hu_cip', $args['hu_cip']);
			// $this->db->set('hu_accept', $args['hu_accept']);
			// $this->db->set('hu_code', $args['hu_code']);
			// $this->db->insert('hansinmedi_user');
			// echo $hu_type;
			// print_r($args);
			// print_r2($args);

			$sql_string = "insert into hansinmedi_user (hu_name, hu_type_code, hu_phone, hu_comment, hu_email, hu_ctime, hu_cip, hu_accept, hu_code) values ('{$args['hu_name']}','".$hu_type."','{$args['hu_phone']}','{$args['hu_comment']}','{$args['hu_email']}',{$args['hu_ctime']},'{$args['hu_cip']}','{$args['hu_accept']}','{$args['hu_code']}'  );";

			$this->db->query($sql_string);

			$data['msg'] = '정상 접수되었습니다.';
			$data['sact'] ='PR';
			$this->load->view('KosfoReserveFrame/script', $data);
		}
	}

	private function _checkArgs(&$args){

		$error_msg = false;
		if(!is_string($args['hu_name']) || strlen($args['hu_name']) < 1) $error_msg = '신청자 이름을 입력해주세요.';
		else if(!is_string($args['hu_type_code']) || strlen($args['hu_type_code']) < 1) $error_msg = '검진항목을 선택해주세요.';
		else if(!$args['phone'] || !is_numeric($args['phone']) || strlen($args['phone']) > 11) $error_msg = '연락처가 비었거나 형식에 맞지 않습니다. 다시 확인해주세요.';
		else if(!is_string($args['hu_email']) || !filter_var($args['hu_email'], FILTER_VALIDATE_EMAIL)) $error_msg = '이메일이 형식에 맞지 않습니다. 다시 입력해주세요.';
		else if(!array_key_exists('hu_accept', $args) || $args['hu_accept'] != 'y') $error_msg = '개인정보취급방침에 동의하여 주세요.';

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

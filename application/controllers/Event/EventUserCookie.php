<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventUserCookie{

	private $_name = 'view_event';
	private $_default_values = array();
	private $_limit_number = 6;
	
	function onInit(&$ci){
		$ci->load->helper('cookie');
		$this->_default_values = array(
			'name'   => $this->_name,
			'value'  => '',
			'expire' => '86500',
			'path'   => '/',
			'prefix' => '',
		);
	}
	
	function index(&$data, &$ci){
		exit;		
	}

	function setViewEvent($seq){
		if(!is_numeric($seq)) return false;		

		$seqs = $this->getList();

		if(in_array($seq, $seqs)){
			foreach($seqs as $k=>$v){
				if(!$v || $v == $seq) unset($seqs[$k]);
			}
		}
		
		if(count($seqs) == $this->_limit_number){
			unset($seqs[$this->_limit_number-1]);
		}

		$seq = array($seq);
		$value = implode(',', array_merge($seq, $seqs));
		$args = $this->_default_values;
		$args['value'] = $value;

		set_cookie($args);
	}

	function getList(){
		$view_values = get_cookie($this->_name, true);
		$seqs = array();
		if(hasText_($view_values)) $seqs = explode(',', $view_values);

		return $seqs;
	}
}
?>

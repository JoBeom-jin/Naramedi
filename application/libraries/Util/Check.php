<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check{

	/* 
	* 문자열이 존재하는지 여부 확인
	*/
	function hasText($src) {
		if (!$src) return false;
		if (is_null($src)) return false;
		if (empty($src)) return false;
		if ($src === '') return false;		
		return (trim($src) != '');
	}

	function hasArrayValue($key, &$array){

		if(!$this->isArray($array)) return false;
		if(!is_string($key)) return false;

		if(!array_key_exists($key, $array)) return false;
		return $this->hasText($array[$key]);

	}

	/*
	* foreach가 가능한 array인지 확인
	*/
	function isArray($var){
		if(!is_array($var)) return false;
		if(!$var) return false;
		if(count($var) < 1) return false;
		return true;
	}

	/*
	* id 체크 
	* 5에서 14글자 사이
	*/
	function id($val){
		if(!$this->hasText($val)) return false;

		$leng = strlen($val);
		return preg_match("/^[0-9A-Z][0-9A-Z_-]{3,12}[0-9A-Z]$/i", $val, $match);
	}

	/*
	* 핸드폰 확인
	*/
	function phone($phone){		
		$phone = preg_replace("/[^0-9]*/s", "", $phone); 
		if(preg_match("/^[0-9]{10,11}$/", $phone)) return true;		
		return false;
	}

	/*
	* 이메일 형식 확인
	*/
	function email($email){		
		return preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email);
	}

	/*
	* 키가 존재하고 값을 가지고 있는지 확인
	*/
	function hasKey($key, $array){
		if(!$this->hasText($key) || !$this->isArray($array)) show_error('util hasKey error : has wrong params');
		if(array_key_exists($key, $array) && $this->hasText($array[$key]) ) return true;
		else return flase;
	}

	function password($val){		
		$pattern = '/^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&*]).*$/';
		 return preg_match($pattern ,$val);				
	}

	

}
?>
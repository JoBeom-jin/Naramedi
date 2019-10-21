<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Util_Array {
	
	static function make($var) {
		if (is_array($var)) return $var;		
		return array( $var );
	}

	/*
	* foreach 반복문이 가능한 배열인지 확인
	*/
	static function canForeach($var){
		if(!is_array($var)) return false;
		if(!$var) return false;
		if(count($var) < 1) return false;
		return true;
	}

	/*
	* 2차원 배열을 필드명으로 정렬
	* args[0] : 배열 데이터
	* args[1] : 배열을 정렬시킬 필드 명
	*/
	static function orderBy(){
		$args = func_get_args();
		$data = array_shift($args);

		foreach ($args as $n => $field) {
			if (is_string($field)) {
				$tmp = array();
				foreach ($data as $key => $row) 	$tmp[$key] = $row[$field];
				$args[$n] = $tmp;
			}
		}

		$args[] = &$data;
		call_user_func_array('array_multisort', $args);
		return array_pop($args);
	}
}
?>
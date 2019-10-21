<?
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
* 문자열이 존재하는지 여부 확인
*/
function hasText_($src) {
	if(!is_string($src)) return false;
	if (!$src) return false;
	if (is_null($src)) return false;
	if (empty($src)) return false;
	if ($src === '') return false;		
	return (trim($src) != '');
}


function hasArrayValue_($key, &$array){

	if(hasText_($array)) return false;
	if(!is_string($key)) return false;

	if(!array_key_exists($key, $array)) return false;
	return hasText_($array[$key]);
}

function array_key_value($key, &$array){
	if(!isArray_($array)) return false;
	if(!hasText_($key)) return false;

	if(!array_key_exists($key, $array)) return false;
	return $array[$key];
}

/*
* foreach가 가능한 array인지 확인
*/
function isArray_($var){
	if(!is_array($var)) return false;
	if(!$var) return false;
	if(count($var) < 1) return false;
	return true;
}

?>
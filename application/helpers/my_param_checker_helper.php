<?
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($ci) || !($ci instanceof CI_Controller) ){
	$ci = & get_instance();
}

$ci->load->helper('my_array');

/*
* id 체크 
* 5에서 14글자 사이
*/
function chkId_($val){
	if(!hasText_($val)) return false;

	$leng = strlen($val);
	return preg_match("/^[0-9A-Z][0-9A-Z_-]{3,12}[0-9A-Z]$/i", $val, $match);
}

/*
* 핸드폰 확인
*/
function chkPhone_($phone){		
	$phone = preg_replace("/[^0-9]*/s", "", $phone); 
	if(preg_match("/^[0-9]{10,11}$/", $phone)) return true;		
	return false;
}

/*
* 이메일 형식 확인
*/
function chkEmail_($email){		
	return preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email);
}

/*
* 키가 존재하고 값을 가지고 있는지 확인
*/
function hasKey_($key, $array){
	if(!hasText_($key) || !hasText_($array)) show_error('util hasKey error : has wrong params');
	if(array_key_exists($key, $array) && hasText_($array[$key]) ) return true;
	else return flase;
}

function chkPass_($val){		
	$pattern = '/^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&*]).*$/';
	 return preg_match($pattern ,$val);				
}
?>
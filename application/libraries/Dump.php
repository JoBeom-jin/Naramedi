<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 코딩중 디버그 용으로 변수의 덤프를 지원한다.
 *
 * @package framework
 * @author yangkun7@gmail.com
 * @version 1
 *
 */
class Dump {
	/**
	 * 변수를 테스트. 브라우저에 출력.
	 *
	 * @param mixed $var 테스트 할 변수
	 * @param boolean $exit 스크립트 종료 여부 (false)
	 */
	static function write($var, $exit = false, $only_msg = false) {
		echo '<pre>';
		if (is_array($var)) print_r($var);
		else var_dump($var);
		echo '</pre>';
		
		echo '<hr/>';
		if(!$only_msg){	
			$trace = debug_backtrace();
			echo '<b>' . $trace[0]['file'] . ' (' . $trace[0]['line'] . ')</b>';
			echo '<hr/>';
		}
		if ($exit) exit;
	}


	/**
	 * 현재 브라우저로 전달된 POST 데이터 ($_POST) 를 Dump
	 *
	 * @param boolean $exit 변수 덤프 후 스크립트를 종료할지 여부. TRUE 면 중지.
	 */
	static function post($exit = true) {
		self::write($_POST, $exit);
	}
	/**
	 * 현재 브라우저로 전달된 GET 데이터 ($_GET) 를 Dump
	 *
	 * @param boolean $exit 변수 덤프 후 스크립트를 종료할지 여부. TRUE 면 중지.
	 */
	static function get($exit = true) {
		self::write($_GET, $exit);
	}
	/**
	 * 현재 브라우저의 세션 정보 ($_SESSION) 를 Dump
	 *
	 * @param boolean $exit 변수 덤프 후 스크립트를 종료할지 여부. TRUE 면 중지.
	 */
	static function session($exit = true) {
		self::write($_SESSION, $exit);
	}
	/**
	 * $_SERVER 를 Dump
	 *
	 * @param boolean $exit 변수 덤프 후 스크립트를 종료할지 여부. TRUE 면 중지.
	 */
	static function server($exit = true) {
		self::write($_SERVER, $exit);
	}
	/**
	 * $_ENV 를 Dump
	 *
	 * @param boolean $exit 변수 덤프 후 스크립트를 종료할지 여부. TRUE 면 중지.
	 */
	static function env($exit = true) {
		self::write($_ENV, $exit);
	}
}
?>

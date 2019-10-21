<?
defined('BASEPATH') OR exit('No direct script access allowed');
define('METHOD_POST', 0x01, true);
define('METHOD_GET', 0x02, true);
define('METHOD_BOTH', METHOD_GET | METHOD_POST, true);

class Request extends CI_Input{
	private $_ci = false;

	function __construct(){
		$this->_ci = &get_instance();
		parent::__construct();
	}
	/**
	 * GET 혹은 POST 로 전달된 인자를 얻는다.
	 *
	 * @param string $name 얻고자 하는 파라미터 명.
	 * @param int $method (METHOD_POST|METHOD_GET|METHOD_BOTH*)
	 * @param mixed $default 해당 파라미터가 전달되지 않았을때 default 로 넘겨질 값.
	 * @return mixed
	 */
	function param($name, $method = METHOD_BOTH, $default = null) {
		$value = null;
		$get_args = $this->getParams();

		if ( ($method & METHOD_POST) && $this->post($name) )  $value = $this->post($name);
		if ( $value == null && ($method & METHOD_GET) && (array_key_exists($name, $get_args) && $get_args[$name] ) ) $value = $get_args[$name];
		if ($value == null && $default !== null) $value = $default;
		return $value;
	}

	function params($name, $method = METHOD_BOTH) {
		$values = array();
		$post_value =$this->post($name, true);
		$get_args = $this->getParams();

		if ( ($method & METHOD_POST) && $post_value ) {

			if (is_array($post_value)) $values = $post_value;
			else $values = array($post_value);

		} else if (($method & METHOD_GET) && (array_key_exists($name, $get_args) && $get_args[$name] ) ) {
			if (is_array($get_args[$name])) $values = $get_args[$name];
			else $values = array($get_args[$name]);
		}
		return $values;
	}


	function getAll($method = METHOD_POST){
		$values = array();
		if($method & METHOD_POST) $values = $this->_ci->input->post();
		else if($method & METHOD_GET) $values = $this->getParams();
		return $values;
	}

	function req($name, $method = METHOD_BOTH, $setName=null) {
		$value = self::param($name, $method, null);
		if($value === null) show_error('not present parameter! '.$setName);
		return $value;
	}

	function getParams(){
		$result1 = $this->_ci->uri->uri_to_assoc(5);
		$result2 = $this->_ci->input->get();
		if(is_array($result1) && is_array($result2)) return array_merge($result1, $result2);
		else if(is_array($result1)) return $result1;
		else if(is_array($result2)) return $result2;
		else return array();
	}
}
?>

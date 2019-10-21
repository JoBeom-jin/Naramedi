<?
defined('BASEPATH') OR exit('No direct script access allowed');
class Bizcall{		

	private $_url = 'http://210.109.108.132:8087';
	private $_iid = 'dwidnwidbxkfg332qisn';
	private $_color_ring_id = '24265';
	private $_ment_id = '14581';
	private $_methods = array();

	
	function __construct(){	
		$this->_methods = array(
				'set_number' => '/link/auto_mapp.do',
				'remove_number' => '/link/set_vn.do',
				'set_config' => '/link/set_vn.do',
			);	
	}

	function getData(){
		$data['iid'] = $this->_iid;
		$data['url'] = $this->_url;
		$data['colorring_id'] = $this->_color_ring_id;
		$data['_ment_id'] = $this->_ment_id;
		return $data;
	}

	function getAuthData($rn, $method_key){
		$rn = preg_replace("/[^0-9]/", "", $rn);
		if(!$rn) return false;
		$method = $this->getMethod($method_key);
		$data = $this->getData();
		$auth = $this->_iid.$rn;
		$data['auth'] = base64_encode(md5($auth));
		$data['json_url'] = $this->_url.$method;
		$data['rn'] = $rn;
		return $data;
	}

	function getSetConfigData($vn, $rn, $method_key){
		$data = $this->getAuthData($vn, $method_key);
		$data['rn'] = $rn;
		$data['cr_id'] = $this->_color_ring_id;
		$data['if_id'] = $this->_ment_id;
		$data['switch_yn'] = '';
		return $data;
	}

	function cancel($number){
		$vn = preg_replace("/[^0-9]/", "", $number);	
		$method = $this->getMethod('remove_number');

		if(!is_numeric($vn)) return false;

		$curl_data = array();
		$curl_data['iid'] = $this->_iid;
		$curl_data['vn'] = $vn;
		$curl_data['rn'] = ' ';

		$auth = $this->_iid.$vn;
		$curl_data['auth'] = base64_encode(md5($auth));
		$json_url = $this->_url.$method;

		$cu = curl_init();
		curl_setopt ($cu, CURLOPT_URL, $json_url);
		curl_setopt ($cu, CURLOPT_POST, 1);
		curl_setopt ($cu, CURLOPT_POSTFIELDS, http_build_query($curl_data));
		curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, 0);
		$res = curl_exec ($cu);
		curl_close($cu); 

		$result = json_decode($res);		  
		return $result->rs;		
	}

	function mappingNumber($rn, $method_key, $hi_seq){
		if(!is_numeric($hi_seq)) return false;
		$curl_data['iid'] = $this->_iid;
		$curl_data['rn'] = preg_replace("/[^0-9]/", "", $rn);
		$curl_data['memo'] = $hi_seq;
		if(!$rn) return false;
		$method = $this->getMethod($method_key);
		$auth = $this->_iid.$rn;
		$curl_data['auth'] = base64_encode(md5($auth));
		$json_url = $this->_url.$method;

		$cu = curl_init();
		curl_setopt ($cu, CURLOPT_URL, $json_url);
		curl_setopt ($cu, CURLOPT_POST, 1);
		curl_setopt ($cu, CURLOPT_POSTFIELDS, http_build_query($curl_data));
		curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, 0);
		$res = curl_exec ($cu);
		curl_close($cu); 
		  
		return $res; 
	}

	function getMethod($key){
		return $this->_methods[$key];
	}
}
?>
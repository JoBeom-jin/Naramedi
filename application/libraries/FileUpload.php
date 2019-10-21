<?
defined('BASEPATH') OR exit('No direct script access allowed');

get_instance()->load->library('upload');

class FileUpload extends CI_Upload{

	private $_errors = array();
	private $_data = array();
	private $_name_prefix = 'upload_name_';

	function __construct($config=array()){
		parent::__construct($config);
	}

	
	function do_multi_upload($file_name){
		if(!$file_name) return false;
		
		$files = $this->_multi_files_to_array($file_name);
		
		if(is_array($files) && count($files) > 0){
			foreach($files as $name => $f){
				$_FILES[$name] = $f;
				parent::do_upload($name);
				$this->_data[] = parent::data();
				$error = parent::display_errors('','');
				if(is_string($error) && strlen($error) > 0) $this->_errors[] = $error;
			}		
		}
	}


	function data($index=null){
		if(count($this->_data) > 0) return $this->_data;
		else return parent::data($index);
	}

	function getErrors(){
		return $this->_errors;
	}

	function hasError(){
		if(count($this->_data) > 0){
			if(count($this->_errors) > 0) return true;
			else return false;
		}else{
			$error = parent::display_errors('','');
			if($error && is_string($error) && strlen($error) > 0) return true;
			else return false;
		}
	}

	function rollback(){
		if(count($this->_data) > 0){
			foreach($this->_data as $k => $v){
				if(is_file($v['full_path'])) @unlink($v['full_path']);
			}
		}		
	}
	

	private function _multi_files_to_array($file_name){
		$return = array();
		if(!$file_name) return $return;

		$files = &$_FILES[$file_name];
		$file_number = count($files['error']);

		for($i=0 ; $i < $file_number ; $i++){
			$temp = array();
			$temp['name'] = $files['name'][$i];
			$temp['type'] = $files['type'][$i];
			$temp['tmp_name'] = $files['tmp_name'][$i];
			$temp['error'] = $files['error'][$i];
			$temp['size'] = $files['size'][$i];
			$return[$this->_name_prefix.$i] = $temp;
		}

		return $return;
	}


}
?>
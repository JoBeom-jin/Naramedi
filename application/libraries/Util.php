<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Util{
	private $_util_classes = array();
	
	function & load($string){		
		list($folder, $file) = explode('.', $string);		
		$class_name = str_replace('.', '_', $string);

		if(!array_key_exists($class_name, $this->_util_classes) || !$this->_util_classes[$class_name]){
			$path = dirname(__FILE__);
			$class_file = $path.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$file.'.php';
			if(!is_file($class_file)) show_error("could not found Util class file.");
			require_once $class_file;

			if(!class_exists($class_name)) show_error("class is not defined.");
			$this->_util_classes[$class_name] = new $class_name();
		}

		return $this->_util_classes[$class_name];
	}
}
?>
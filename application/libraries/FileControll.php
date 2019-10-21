<?
defined('BASEPATH') OR exit('No direct script access allowed');

class FileControll{

	function downFile($path, $name){
		if(!is_file($path) || !is_string($name) || strlen($name) < 1) return false;

		Header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename={$name}");
		Header("Content-Description: ".$_SERVER['HTTP_HOST']." Generated Data");
		Header("Cache-Control: cache, must-revalidate");
		header("Pragma: no-cache");
		header("Expires: 0");

		$fp = fopen($path, "r");
		fpassthru($fp);
		fclose($fp);
		exit;		
	}
}
?>

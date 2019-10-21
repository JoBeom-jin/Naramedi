<?

defined('BASEPATH') OR exit('No direct script access allowed');

function path2url_($path){
	global $ci;
	if(!is_string($path) || strlen($path) < 1) return '';
	else if(!is_file($path)) return '';
	$path = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($_SERVER['DOCUMENT_ROOT'], '', $path));

	return $path;
}
?>
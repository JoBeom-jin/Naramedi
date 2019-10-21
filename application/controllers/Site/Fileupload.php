<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileUpload{

	private $_path = false;

	function onInit(&$ci){		
	}

	function index(&$data, &$ci){		
		$this->_path = $ci->_site_config['dir']['upload'].DIRECTORY_SEPARATOR.'board_contents';

		$ci->load->helper('file');
		$ci->load->helper('my_file');
		$_file_config = array(
			'upload_path' => $this->_path,
			'allowed_types' => 'gif|jpg|png|jpeg',
			'max_size' => 3000,
			'max_width' => 0,
			'max_height' => 0,
			'max_filename' => 255,
			'encrypt_name' => true,
			'remove_spaces' => true,				
		);

		$ci->load->library('upload', $_file_config);
		$ci->upload->do_upload('upload');
		$error_message = $ci->upload->display_errors('','');
		if(strlen($error_message) > 1){
			$data['msg'] = $error_message;
			return 'script';
		}

		$file_data = $ci->upload->data();
		
		$img_url = path2url_($file_data['full_path']);

		$data['callback_number'] = $ci->request->param('CKEditorFuncNum', METHOD_BOTH, false);
		$data['img_url'] = $img_url;
		$data['msg'] = '이미지가 업로드 되었습니다.';
		return 'board/upload';
	}

//	function doIntro(&$data, &$ci){
//		return 'site/intro';
//	}


}
?>

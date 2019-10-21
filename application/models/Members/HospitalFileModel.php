<?
defined('BASEPATH') OR exit('No direct script access allowed');

class HospitalFileModel extends MY_Model{

	private $_path = '';
	private $_url = '';
	private $_file_config = array();
	
	function __construct(){
		$this->_table = 'hospital_file';
		$this->_cols = array(
			'hf_seq'  => array(TYPE_INT, 20, ATTR_PK | ATTR_ID),
			'hf_hiseq'  => array(TYPE_INT, 11, ATTR_NOTNULL, 'hospital_info 기본키'),
			'hf_name'  => array(TYPE_VARCHAR, 255, ATTR_NOTNULL, '파일 이름'),			
			'hf_real_name'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL, '파일 실제 이름'),
			'hf_path'  => array(TYPE_VARCHAR, 64, ATTR_NOTNULL, '파일 위치'),
			'hf_size'  => array(TYPE_INT, 11, ATTR_NOTNULL, '파일 크기'),
			'hf_ctime'  => array(TYPE_INT, 11, ATTR_NOTNULL, '생성일'),
		);

		parent::__construct();

		$this->_path = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'hospital';
		$this->_url = '/upload/hospital/';
		if(!is_dir($this->_path)){
			show_error('upload folder is not ready');
		}

		$this->_file_config = array(
				'upload_path'=> $this->_path,
				'allowed_types' => 'gif|jpg|png|pdf',
				'max_size' => 5120,
				'overwrite' => false,
				'encrypt_name' => true
			);

		$this->load->library('upload', $this->_file_config);
		
	}

	function insertUpload(&$upload, $hf_hiseq){
		if(!is_numeric($hf_hiseq)) return false;

		$args = array(
				'hf_hiseq'=>$hf_hiseq,
				'hf_name' => $upload['orig_name'],
				'hf_real_name' => $upload['file_name'],
				'hf_path' => $upload['full_path'],
				'hf_size' => $upload['file_size'],
				'hf_ctime' => time(),				
			);

		return parent::insert($args);		
	}

	function checkInsertParam($field_id, &$upload){
		$file = &$_FILES[$field_id];
		$msg = false;
		$upload = false;
//		if($file['error'] !== 0) $msg = '사업자 등록증은 반드시 입력하셔야 합니다.';		
		if(!$msg && $file['error'] == 0){
			$this->upload->do_upload($field_id);
			$msg = $this->upload->display_errors('', '');
			$upload = $this->upload->data();
		}

		return $msg;
	}


	function getImageByHiseq($hi_seq){
		if(!is_numeric($hi_seq)) return false;
		$where = array('hf_hiseq' => $hi_seq);
		$file = parent::row('*', $where);
		

		if($file){
			$file['url'] = '';
			if(is_file($file['hf_path'])) $file['url'] =  $this->_url.'/'.$file['hf_real_name'];
		}

		return $file;
	}

	function deleteByHiseq($hf_hiseq){
		if(!is_numeric($hf_hiseq)) return false;

		$where = array('hf_hiseq'=> $hf_hiseq);
		$row = parent::row('*', $where);
		
		parent::delete($where);
		if($this->chk->hasArrayValue('hf_path', $row) && is_file($row['hf_path'])) @unlink($row['hf_path']);
		return true;
	}

	

}
?>
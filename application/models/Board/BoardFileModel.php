<?
/*
create table board(
bd_seq int unsigned not null primary key auto_increment,
bd_bcid varchar(16) not null,
bd_step int not null,
bd_bdcseq int,
bd_thread varchar(20) not null,
bd_id varchar(16),
bd_pass varchar(128),
bd_name varchar(64),
bd_subject varchar(255) not null,
bd_content text not null,
bd_notice_flag char(1) not null,
bd_lock_flag char(1) not null,
bd_html_flag char(1) not null,
bd_display_flag char(1) not null,
bd_view_cnt int,
bd_create_ip varchar(20),
bd_ctime int not null
);
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class BoardFileModel extends MY_Model{

	public $error_msgs = array();

	function __construct() {
		$this->_table = 'board_file';
		$this->_cols = array(
			'bf_bdseq'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'bf_serial' => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'bf_name' => array(TYPE_VARCHAR, 64),
			'bf_path' => array(TYPE_VARCHAR, 255),
			'bf_info' => array(TYPE_VARCHAR, 25),
			'bf_size' => array(TYPE_INT, 11),
			'bf_width' => array(TYPE_INT, 11),
			'bf_height' => array(TYPE_INT, 11),
			'bf_include' => array(TYPE_VARCHAR, 1, ATTR_NOTNULL),
			'bf_ext' => array(TYPE_VARCHAR, 16),
			'bf_cnt' => array(TYPE_INT, 11),
			'bf_desc' => array(TYPE_TEXT, 2000),
		);

		parent::__construct();

		$this->_file_config = array(
			'upload_path' => '',
			'allowed_types' => 'gif|jpg|png|jpeg|zip|pdf|xls|xlsx|hwp',
			'max_size' => 10000,
			'max_width' => 0,
			'max_height' => 0,
			'max_filename' => 255,
			'encrypt_name' => true,
			'remove_spaces' => true,				
		);

	}

	function insertFile(&$files, $bf_bdseq, $save_dir){
		if(!is_array($files) || count($files) < 1 || !is_numeric($bf_bdseq) || !is_dir($save_dir) ) return true;	
		$this->_file_config['upload_path'] = $save_dir;
		$this->load->library('upload', $this->_file_config);
		
		$where = array('bf_bdseq' => $bf_bdseq);
		$bf_serial = parent::nextValue('bf_serial', $where);
		foreach($files as $name => $file){			

			if($file['error'] === 0){
				$this->upload->do_upload($name);
				$upload_info = $this->upload->data();
				$error = $this->upload->display_errors('','');
				if(strlen($error) > 0) $this->error_msgs[] = $error;
				else{						
					$args = array(
						'bf_bdseq' => $bf_bdseq,
						'bf_serial' => $bf_serial,
						'bf_name' => $upload_info['orig_name'],
						'bf_path' => $upload_info['full_path'],
						'bf_info' => $upload_info['file_type'],
						'bf_size' => $upload_info['file_size']*1000,
						'bf_width'=> $upload_info['image_width'],
						'bf_height'=> $upload_info['image_height'],
						'bf_include'=> '1',
						'bf_ext'=> $upload_info['image_type'],
						'bf_cnt'=> 0,
						'bf_desc'=> '',
					);

					
					parent::insert($args);
					$bf_serial++;
				}
			}
		}

		if(count($this->error_msgs) > 0) return false;
		return true;
	}

	function getFiles($bf_bdseq){
		$where = array('bf_bdseq'=>$bf_bdseq);
		$order = 'bf_serial asc';
		$list = parent::listAll('*', $where, $order);
		if(count($list) > 0){
			foreach($list as $k => $v){
				$list[$k]['url'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $v['bf_path']));
			}
		}
		return $list;
	}

	function deleteAllBySeq($bf_bdseq){
		if(!is_numeric($bf_bdseq)) return false;
		$where = array('bf_bdseq' => $bf_bdseq);
		$list =parent::listAll('bf_path', $where);
		if(is_array($list) && count($list) > 0){
			foreach($list as $k => $v){
				$path = $v['bf_path'];
				if(is_file($path)) @unlink($path);
			}
		}		

		parent::delete($where);
	}

	function deleteBySeq($bf_serial, $bf_bdseq){
		if(!is_numeric($bf_serial) || !is_numeric($bf_bdseq)) return false;

		$where = array(
			'bf_serial' => $bf_serial,
			'bf_bdseq' => $bf_bdseq,
			);
		$path = parent::value('bf_path', $where);

		if(is_file($path)) @unlink($path);
		return parent::delete($where);
	}

	function getThumBySeqs($seqs){
		if(!is_array($seqs) || count($seqs) < 1) return array();

		$seq_string = '('.implode(',', $seqs).')';
		$where = "bf_bdseq in {$seq_string}";
		$sql = "select * from {$this->_table} where {$where} group by bf_bdseq";

		return parent::listAllBySql($sql, 'bf_bdseq');
	}

	function downFileBySeq($bf_serial, $bf_bdseq){
		$this->message = false;
		if(!is_numeric($bf_serial) || !$bf_bdseq){
			$this->message = '파일을 찾을 수 없습니다.';
			return false;
		}

		$where = array(
			'bf_serial' => $bf_serial,
			'bf_bdseq' => $bf_bdseq,
			);
		
		$row = parent::row('bf_path, bf_name', $where);
		$path = $row['bf_path'];
		$file_name = $row['bf_name'];

		if(!$this->chk->hasText($path) || !is_file($path)){
			$this->message = '파일을 찾을 수 없습니다.';
			return false;
		}		
		$this->downFile($path, $file_name);
		exit;		
	}



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
<?
/*
create table agency_image(
aim_seq int unsigned not null primary key auto_increment,
aim_aiseq int unsigned not null,
aim_fname varchar(255) not null,
aim_real_fname varchar(255) not null,
aim_path varchar(255) not null,
aim_fsize int not null,
aim_width int,
aim_height int
);
alter table agency_image add aim_is_thum char(1) default 'N';
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class AgencyImageModel extends MY_Model{

	private $_file_config = false;						//file library config
	private $_file_url = false;

	function __construct(){
		$this->_table = 'agency_image';
		$this->_cols = array(
			'aim_seq'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'aim_aiseq'  => array(TYPE_INT, 11 , ATTR_NOTNULL),
			'aim_fname'  => array(TYPE_VARCHAR, 255, ATTR_NOTNULL),
			'aim_real_fname'  => array(TYPE_VARCHAR, 255, ATTR_NOTNULL),
			'aim_path'  => array(TYPE_VARCHAR, 255, ATTR_NOTNULL),
			'aim_fsize'  => array(TYPE_INT, 11, ATTR_NOTNULL),
			'aim_width'  => array(TYPE_INT, 11, ATTR_NONE),
			'aim_height'  => array(TYPE_INT, 11, ATTR_NONE),		
			'aim_is_thum'  => array(TYPE_VARCHAR, 1, ATTR_NONE),		
		);		
			
		parent::__construct();

		$this->_file_config = array(
				'upload_path' => $this->_site_config['dir']['upload'].DIRECTORY_SEPARATOR.'agency'.DIRECTORY_SEPARATOR.'main',
				'allowed_types' => 'gif|jpg|png|jpeg',
				'max_size' => 10000,
				'max_width' => 0,
				'max_height' => 0,
				'max_filename' => 255,
				'encrypt_name' => true,
				'remove_spaces' => true,				
			);

		$this->_file_url = '/upload/agency/main';
	}

	function getFileConfig(){
		return $this->_file_config;
	}


	function insertFileListByAiseq($file_list, $ai_seq){
		if(!is_array($file_list) || count($file_list) < 1 || !is_numeric($ai_seq) ) return false;

		foreach($file_list as $k => $f){
			$args = $this->_makeArgs($f);
			$args['aim_aiseq'] = $ai_seq;

			$this->insertArgs($args);
		}

		return true;
	}

	function insertArgs($args){
		if(!$this->checkInsertArgs($args)) return false;

		parent::insert($args);
		return true;
	}

	function checkInsertArgs($args){
		if(!is_numeric($args['aim_aiseq'])) return false;
		if(!$this->chk->hasText($args['aim_fname'])) return false;
		if(!$this->chk->hasText($args['aim_real_fname'])) return false;
		if(!$this->chk->hasText($args['aim_path'])) return false;
		if(!is_numeric($args['aim_fsize'])) return false;	

		return true;
	}

	function getListByAiseq($ai_seq){
		if(!is_numeric($ai_seq)) return false;
		
		$where = array('aim_aiseq' => $ai_seq);
		$list = parent::listAll('*', $where);
		if($this->chk->isArray($list)){
			$_root_dir = $this->_site_config['dir']['root'];
			foreach($list as $k => $v){
				$list[$k]['url'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($_root_dir, '', $v['aim_path']));								
			}
		}
		return $list;
	}

	function getListByAiseqs($ai_seqs){
		if(!isArray_($ai_seqs)) return array();
		$where_string = '('.implode(',', $ai_seqs).')';
		$where = "aim_aiseq in {$where_string}";
		return parent::listAll('*', $where);
	}

	function getThumByAiseq($aiseq){
		if(!is_numeric($aiseq)) return parent::getEmptyRow();
		$where= array('aim_aiseq'=>$aiseq);
		$row = parent::row('*', $where);

		if(array_key_value('aim_real_fname' , $row)){
			$row['url'] = $this->_file_url.'/'.$row['aim_real_fname'];
		}

		return $row;		
	}

	function getThumByAiseqs($aiseqs){
		if(!isArray_($aiseqs)) return array();
		$where_string = '('.implode(',', $aiseqs).')';
		$where = "aim_aiseq in {$where_string}";
		$sql = "select * from {$this->_table} where {$where} group by aim_aiseq";
		$list = parent::listAllBySql($sql, 'aim_aiseq');
		if(isArray_($list)){
			foreach($list as $k => $v){
				$list[$k]['url'] = $this->_file_url.'/'.$v['aim_real_fname'];
			}
		}

		return $list;
	}

	function getRowBySeq($seq){
		if(!is_numeric($seq)) return false;
		$where = array('aim_seq'=>$seq);
		return parent::row('*', $where);
	}

	function deleteBySeq($seq){
		if(!is_numeric($seq)) return false;
		$where = array('aim_seq' => $seq);
		return parent::delete($where);
	}

	function deleteAllBySeq($seq){
		$row = $this->getRowBySeq($seq);
		$this->deleteBySeq($seq);
		if(is_file($row['aim_path'])) @unlink($row['aim_path']);
		return $row;
	}

	function hasPhotoByAiseqs($ai_seqs){
		if(!is_array($ai_seqs) || count($ai_seqs) < 1) return false;		
			
		$where = ' aim_aiseq in ('.implode(',', $ai_seqs).')';
		$sql = "select aim_aiseq, count(*) as cnt from {$this->_table} where {$where} group by aim_aiseq";
		return parent::listAllBySql($sql, 'aim_aiseq');
	}

	function getListByHiseq($hi_seq){

	}


	private function _makeArgs($file_info){
		$args['aim_fname'] = $file_info['orig_name'];
		$args['aim_real_fname'] = $file_info['file_name'];
		$args['aim_path'] = $file_info['full_path'];
		$args['aim_fsize'] = $file_info['file_size'];
		$args['aim_width'] = $file_info['image_width'];
		$args['aim_height'] = $file_info['image_height'];	
		return $args;
	}

	/*
	* ai_seq 에 해당하는 모든 사진파일과 데이터를 삭제
	*/
	function removeImageByAiseq($ai_seq){
		if(!is_numeric($ai_seq)) return false;
		$list = $this->getListByAiseq($ai_seq);
		if(!$list || !is_array($list) || count($list) < 1) return false;

		foreach($list as $k => $v){
			$path = $v['aim_path'];
			@unlink($path);
		}

		$where = array('aim_aiseq' => $ai_seq);
		return parent::delete($where);
	}

	/*
	* 해당 폴더의 모든 사진을 해당 ai_seq로 rename 시킨다.
	*/
	function moveImageByAiseqFolder($ai_seq, $source_dir){
		$upload_dir = $this->_file_config['upload_path'];

		$this->load->helper('file');
		$file_list = get_dir_file_info($source_dir);		

		if($file_list && is_array($file_list) && count($file_list) > 0){
			foreach($file_list as $file){	
				if(is_file($file['server_path'])){
					$file_info = pathinfo($file['server_path']);
					$file_name = $file_info['filename'];
					
					$ext = $file_info['extension'];

					srand(time());
					$new_file_name = md5(uniqid(rand(), true));
					$new_file_name = $new_file_name.'.'.$ext;

					if(copy($file['server_path'], $upload_dir.DIRECTORY_SEPARATOR.$new_file_name)){
						$args = array();
						$args['aim_aiseq'] = $ai_seq;
						$args['aim_fname'] = $file['name'];
						$args['aim_real_fname'] = $new_file_name;
						$args['aim_path'] = $upload_dir.DIRECTORY_SEPARATOR.$new_file_name;
						$args['aim_fsize'] = $file['size'];
						if($file_name == 'M') $args['aim_is_thum'] = 'Y';

						$img_info = getimagesize($file['server_path']);
						if(isset($img_info[0]) && array_key_exists('0', $img_info)) $args['width'] = $img_info[0];
						if(isset($img_info[1]) && array_key_exists('1', $img_info)) $args['height'] = $img_info[1];

						parent::insert($args);
						unlink($file['server_path']);
					}
				}
			}
		}
				
	}

	
}
?>
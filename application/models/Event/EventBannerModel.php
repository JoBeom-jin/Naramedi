<?
defined('BASEPATH') OR exit('No direct script access allowed');

/*
create table event_banner(
eb_seq int not null primary key auto_increment,
eb_subject varchar(255) not null,
eb_use_flag char(1) default 'Y',
eb_file_path varchar(255) not null,
eb_ctime int not null,
index(eb_use_flag)
);

alter table event_banner add eb_sort int unsigned;
*/

class EventBannerModel extends MY_Model{

	public $error_message  = false;
	public $upload_dir = false;

	function __construct(){
		$this->_table = 'event_banner';
		$this->_cols = array(
			'eb_seq'  => array(TYPE_INT, 20, ATTR_PK | ATTR_NOTNULL),
			'eb_subject'  => array(TYPE_VARCHAR, 255, ATTR_NOTNULL, '배너제목'),
			'eb_use_flag'  => array(TYPE_VARCHAR, 1, ATTR_NONE, '배너사용 여부'),
			'eb_file_path'  => array(TYPE_VARCHAR, 255, ATTR_NONE, '배너 이미지 위치'),
			'eb_ctime'  => array(TYPE_INT, 1, ATTR_NOTNULL, '생성일자'),
			'eb_link'  => array(TYPE_VARCHAR, 255, ATTR_NOTNULL, '생성일자'),
			'eb_sort'  => array(TYPE_INT, 11, ATTR_NOTNULL, '소팅 순서'),					
		);
		

		$this->upload_dir = $this->_site_config['dir']['upload'].DIRECTORY_SEPARATOR.'banner';
		parent::__construct();
	}	

	function insertArgs($args){
		$args['eb_ctime'] = time();
		
		return parent::insert($args);
	}


	function updateArgsBySeq($args, $seq){
		if(!is_numeric($seq)) return false;
		$where = array('eb_seq' => $seq);
		
		return parent::update($args, $where);
	}

	function deleteBySeq($seq){
		if(!is_numeric($seq)) return false;

		$where = array('eb_seq' => $seq);
		$row = parent::row('*', $where);

		if($row){
			if(is_file($row['eb_file_path'])) @unlink($row['eb_file_path']);
			parent::delete($where);
		}

		return true;
	}

	function getRowBySeq($seq){
		if(!is_numeric($seq)) return array();
		$where = array('eb_seq' => $seq);
		return parent::row('*', $where);
	}

	function deleteImageBySeq($seq){
		if(!is_numeric($seq)) return array();
		$row = $this->getRowBySeq($seq);
		if(is_file($row['eb_file_path'])) @unlink($row['eb_file_path']);
		$args['eb_file_path'] = '';
		$where = array('eb_seq' => $seq);
		return parent::update($args, $where);
	}

	function getList($number=10){
		$where = "eb_use_flag='Y'";
		$order = 'eb_sort desc';
		$sql = "select * from {$this->_table} where {$where} order by {$order} limit {$number}";
		return parent::listAllBySql($sql);
	}


	
}

?>
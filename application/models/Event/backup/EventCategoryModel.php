<?
defined('BASEPATH') OR exit('No direct script access allowed');

/*
CREATE TABLE `event_category` (
  `eca_idx` int(11) NOT NULL AUTO_INCREMENT,
  `eca_name` varchar(100) DEFAULT NULL,
  `eca_open_menu` varchar(2) DEFAULT 'N',
  `eca_rdate` datetime DEFAULT NULL,
  `eca_mdate` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`eca_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8

ALTER TABLE `okmedi`.`event_category`     ADD COLUMN `eca_order` INT(11) NULL AFTER `eca_idx`
*/

class EventCategoryModel extends MY_Model{

	public $error_message;

	private $_status;
	private $_upload_path = false;
	private $idx = 'eca_idx';

	function __construct(){
		$this->_table = 'event_category';
		$this->_cols = array(
			'eca_idx'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'eca_order'  => array(TYPE_INT, 11, ATTR_NONE, '카테고리 순서'),
			'eca_name'  => array(TYPE_VARCHAR, 100, ATTR_NONE, '카테고리 이름'),
			'eca_open_menu'  => array(TYPE_VARCHAR, 2, ATTR_NONE, '메뉴 오픈 여부'),
			'eca_rdate' => array(TYPE_datetime, 19, ATTR_NONE, '생성일'),
			'eca_mdate' => array(TYPE_datetime, 19, ATTR_NONE, '수정일'),
		);

		$this->error_message = false;
		$this->_status = array(
				'Y' => '메뉴 오픈',
				'N' => '메뉴 감춤',
			);

		parent::__construct();
	}



	function getList(){
		$sql = "select * from {$this->_table}";
		return parent::listAllBySql($sql);
	}

	function getNameArr(){
		$sql = "select * from {$this->_table} order by eca_order asc";
		$arr = array();
		foreach(parent::listAllBySql($sql) as $tk=>$tv){
			$arr[$tv['eca_idx']] = $tv['eca_name'];
		}
		return $arr;
	}

	function getModify($seq){
		if(!is_numeric($seq)) return false;
		$sql = "select * from {$this->_table} where {$this->idx}={$seq}";
		return parent::rowBySql($sql);
	}

	function insertCategory($args){
		if(!$args) return false;

		return parent::insert($args);
	}

	function modifyBySeq($args, $seq){
		if(!$args || !is_numeric($seq)) return false;

		$where = array($this->idx => $seq);
		return parent::update($args, $where);
	}

	function deleteBySeq($seq){
		if(!$seq) return false;
		$where = array($this->idx => $seq);
		return parent::delete($where);
	}





}

?>

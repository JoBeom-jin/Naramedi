<?
defined('BASEPATH') OR exit('No direct script access allowed');

/*
CREATE TABLE `event_category_sub` (
  `ecs_idx` int(11) NOT NULL AUTO_INCREMENT,
  `ecs_order` int(11) DEFAULT NULL,
  `ecs_eca_idx` int(11) DEFAULT NULL,
  `ecs_name` varchar(200) DEFAULT NULL,
  `ecs_open_menu` varchar(10) DEFAULT 'Y',
  `ecs_mdate` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ecs_idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
*/

class EventCategorySubModel extends MY_Model{

	public $error_message;

	private $_status;
	private $_upload_path = false;
	private $idx = 'ecs_idx';

	function __construct(){
		$this->_table = 'event_category_sub';
		$this->_cols = array(
			'ecs_idx'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'ecs_eca_idx'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'ecs_order'  => array(TYPE_INT, 11, ATTR_NONE, '카테고리 서브 순서'),
			'ecs_name'  => array(TYPE_VARCHAR, 100, ATTR_NONE, '카테고리 서브 이름'),
			'ecs_open_menu'  => array(TYPE_VARCHAR, 10, ATTR_NONE, '메뉴 오픈 여부'),
			'ecs_mdate' => array(TYPE_datetime, 19, ATTR_NONE, '수정일'),
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

	function getListByEca($eca_idx){
		$sql = "select * from {$this->_table} where ecs_eca_idx = {$eca_idx} order by ecs_order asc, ecs_idx asc";
		return parent::listAllBySql($sql);
	}

	function getNameArr(){
		$sql = "select * from {$this->_table} order by ecs_idx asc";
		$arr = array();
		foreach(parent::listAllBySql($sql) as $tk=>$tv){
			$arr[$tv['ecs_idx']] = $tv['ecs_name'];
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

		if( $order_chk = $this->ecs_order_chk($args) ) return $order_chk;

		return parent::insert($args);
	}

	function modifyBySeq($args, $seq){
		if(!$args || !is_numeric($seq)) return false;

		if( $order_chk = $this->ecs_order_chk($args, $seq) ){
			return $order_chk;
			exit;
		}

		$where = array($this->idx => $seq);
		return parent::update($args, $where);
	}

	function deleteBySeq($seq){
		if(!$seq) return false;
		$where = array($this->idx => $seq);
		return parent::delete($where);
	}

	private function ecs_order_chk($args, $seq=0){
		$sql = "
		select
			count(*) cnt
		from {$this->_table}
		where
			`ecs_order`={$args['ecs_order']}
			and
			`ecs_eca_idx`={$args['ecs_eca_idx']}
		";

		if( $seq ) $sql .= " and `ecs_idx` != {$seq}";

		$cnt = parent::listAllBySql($sql);

		if( $cnt[0]['cnt'] >= 1 ) return 'duplicate_order';
		else return false;
	}


}

?>

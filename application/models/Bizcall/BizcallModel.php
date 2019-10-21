<?
/*
create table bizcall(
bz_idx int not null primary key auto_increment,
bz_seq int unsigned not null,
bz_sdt varchar(14) not null,
bz_edt varchar(14),
bz_swidt varchar(14),
bz_fromn varchar(20),
bz_vn varchar(15) not null,
bz_ton varchar(15),
bz_crid varchar(38),
bz_irid varchar(38),
bz_memo varchar(100),
bz_memo2 varchar(100),
bz_cause varchar(10),
bz_closed_from varchar(4),
bz_indur varchar(10),
bz_outdur varchar(10),
index(bz_sdt, bz_seq)
);
alter table bizcall add bz_checked char(1) not null default 'N';

*/

defined('BASEPATH') OR exit('No direct script access allowed');

class BizcallModel extends MY_Model{

	function __construct(){
		$this->_table = 'bizcall';
		$this->_cols = array(
			'bz_idx'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'bz_seq'  => array(TYPE_INT, 11 , ATTR_NOTNULL),
			'bz_sdt'  => array(TYPE_VARCHAR, 14, ATTR_NOTNULL),
			'bz_edt'  => array(TYPE_VARCHAR, 14, ATTR_NONE),
			'bz_swidt'  => array(TYPE_VARCHAR, 14, ATTR_NONE),
			'bz_fromn'  => array(TYPE_VARCHAR, 20, ATTR_NONE),
			'bz_vn'  => array(TYPE_VARCHAR, 15, ATTR_NONE),
			'bz_ton'  => array(TYPE_VARCHAR, 15, ATTR_NOTNULL),
			'bz_crid'  => array(TYPE_VARCHAR, 38, ATTR_NONE),
			'bz_irid'  => array(TYPE_VARCHAR, 38, ATTR_NONE),
			'bz_memo'  => array(TYPE_VARCHAR, 100, ATTR_NONE),
			'bz_memo2'  => array(TYPE_VARCHAR, 100, ATTR_NONE),
			'bz_cause'  => array(TYPE_VARCHAR, 10, ATTR_NONE),
			'bz_closed_from'  => array(TYPE_VARCHAR, 4, ATTR_NONE),
			'bz_indur'  => array(TYPE_VARCHAR, 10, ATTR_NONE),
			'bz_outdur'  => array(TYPE_VARCHAR, 10, ATTR_NONE),
			'bz_checked'  => array(TYPE_VARCHAR, 1, ATTR_NONE),
		);
		
		parent::__construct();
	}

	function existSeq($bz_seq){
		$where = array('bz_seq' => $bz_seq);

		if(parent::count($where) > 0) return true;
		else return false;
	}

	function insertArgs($args){
		if( $this->existSeq($args['bz_seq']) ){
			$where = array('bz_seq' => $args['bz_seq']);
			parent::update($args, $where);
		}else{
			$args['bz_checked'] = 'N';
			parent::insert($args);
		}
		return true;
	}

	function setCheck($idx, $flag = 'Y'){
		$where = array('bz_idx' => $idx);
		$args = array('bz_checked' => $flag);
		parent::update($args, $where);
		return true;
	}

	function getRowByIdx($idx){
		if(!is_numeric($idx)) return array();
		$where = array('bz_idx' => $idx);
		return parent::row('*', $where);
	}
}

?>
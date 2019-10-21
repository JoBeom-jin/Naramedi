<?
/*
create table close_shop(
cs_seq int not null primary key auto_increment,
cs_name varchar(255) not null,
cs_file_path varchar(255) not null,
cs_ctime int not null
);
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class CloseShopModel extends MY_Model{

	public $message = false;

	function __construct() {
		$this->_table = 'close_shop';
		$this->_cols = array(
			'cs_seq'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'cs_name' => array(TYPE_VARCHAR, 255, ATTR_NOTNULL),
			'cs_file_path' => array(TYPE_VARCHAR, 255, ATTR_NOTNULL),
			'cs_ctime' => array(TYPE_INT, 255, ATTR_NOTNULL),
		);

		parent::__construct();
	}

	function insertArgs($args){
		$args['cs_ctime'] = time();
		parent::insert($args);
	}

	function getMaxValue(){
		return parent::maxValue('cs_seq', '');
	}

	function deleteBySeq($seq){
		if(!is_numeric($seq)) return false;

		$where = array('cs_seq' => $seq);
		$row = parent::row('*', $where);

		if(is_file($row['cs_file_path'])) @unlink($row['cs_file_path']);
		parent::delete($where);
		return true;
	}

	function getRowBySeq($seq){
		if(!is_numeric($seq)) return false;
		$where =array('cs_seq' => $seq);
		return parent::row('*', $where);
	}

	function getListOrderByName(){
		return parent::listAll('*', false, 'cs_name asc');
	}


}

?>

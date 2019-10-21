<?
defined('BASEPATH') OR exit('No direct script access allowed');

/*
create table hansinmedi_user(
hu_seq int unsigned not null primary key auto_increment,
hu_name varchar(64) not null,
hu_type_code char(6) not null,
hu_phone varchar(20) not null,
hu_comment varchar(255),
hu_email varchar(255) not null,
hu_ctime int not null,
hu_cip varchar(30) not null,
hu_accept char(1) not null
);

alter table hansinmedi_user add hu_accept char(1) not null
*/


class HansinUserModel extends MY_Model{

	private $_types = array();

	function __construct(){
		$this->_table = 'hansinmedi_user';
		$this->_cols = array(
			'hu_seq'  => array(TYPE_INT, 20, ATTR_PK | ATTR_NOTNULL),
			'hu_name'  => array(TYPE_VARCHAR, 64, ATTR_NOTNULL),
			'hu_type_code'  => array(TYPE_VARCHAR, 6, ATTR_NOTNULL),
			'hu_phone'  => array(TYPE_VARCHAR, 20, ATTR_NOTNULL),
			'hu_comment'  => array(TYPE_VARCHAR, 255, ATTR_NONE),
			'hu_email'  => array(TYPE_VARCHAR, 255, ATTR_NOTNULL),
			'hu_ctime' => array(TYPE_INT, 11, ATTR_NONE),
			'hu_cip' => array(TYPE_VARCHAR, 30, ATTR_NOTNULL),
			'hu_accept' => array(TYPE_VARCHAR, 1, ATTR_NOTNULL),
			'hu_code' => array(TYPE_VARCHAR, 30, ATTR_NOTNULL),
		);

		$this->_types = array(
				'TPE001'=>'모던검진(20~30대추천)',
				'TPE002'=>'스페셜검진(30~40대추천)',
				'TPE003'=>'크라운검진(30~50대추천)',
				'TPE004'=>'프레스티지검진(40대이상)',
				'TPE005'=>'프레스티지플러스검진(40대이상)',
			);
		
		parent::__construct();
	}

	function deleteBySeq($seq){
		if(!is_numeric($seq)) return false;
		$where = array('hu_seq' => $seq);
		return parent::delete($where);
	}

	function getTypes(){
		return $this->_types;
	}
	


}

?>
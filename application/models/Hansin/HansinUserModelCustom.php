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


class HansinUserModelCustom extends MY_Model{

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
				'TPH001'=>'한신메디피아(서울 서초구)',
				'TPH002'=>'다온헬스케어의원(서울 송파구)',
				'TPH003'=>'루가의료재단나은병원(인천 서구)',
				'TPH004'=>'송도지안검진센터(인천 연수구)',
				'TPH005'=>'천주성삼병원(대구 수성구)',
				'TPH006'=>'필립메디컬센터(경기 성남)',
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
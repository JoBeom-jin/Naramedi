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


class HansinUserModelKosfo extends MY_Model{

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
				'TPK001'=>'한신메디피아',
				'TPK002'=>'다온헬스케어의원',
				'TPK003'=>'KMI 한국의학연구소(광화문)',
				'TPK004'=>'KMI 한국의학연구소(여의도)',
				'TPK005'=>'KMI 한국의학연구소(강남)',
				'TPK006'=>'KMI 한국의학연구소(수원)',
				'TPK007'=>'GC 녹십자 아이메드',
				'TPK008'=>'KMI 한국의학연구소(대구)',
				'TPK009'=>'KMI 한국의학연구소(부산)',
				'TPK010'=>'좋은강안병원 건강증진센터',
				'TPK011'=>'KMI 한국의학연구소(광주)',
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
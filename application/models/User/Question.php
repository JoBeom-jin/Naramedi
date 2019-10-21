<?
/*
create table user_question(
uq_seq int not null primary key auto_increment,
uq_meid varchar(64) not null,
uq_ctime int not null,
uq_subject varchar(255) not null,
uq_question text,
uq_an_meid varchar(64) not null,
uq_an_ctime int not null,
uq_answer text
);
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends MY_Model{
	
	function __construct(){
		$this->_table = 'user_question';
		$this->_cols = array(
			'uq_seq'  => array(TYPE_INT, 20, ATTR_PK | ATTR_ID),
			'uq_meid'  => array(TYPE_VARCHAR, 20, ATTR_NOTNULL, '작성자 아이디'),
			'uq_ctime'  => array(TYPE_INT, 100, ATTR_NOTNULL, '작성시간'),
			'uq_subject'  => array(TYPE_VARCHAR, 64, ATTR_NOTNULL, '질문 제목'),			
			'uq_question'  => array(TYPE_VARCHAR, 11, ATTR_NOTNULL, '질문 내용'),
			'uq_an_meid'  => array(TYPE_VARCHAR, 11, ATTR_NOTNULL, '답변자 아이디'),
			'uq_an_ctime'  => array(TYPE_INT, 11, ATTR_NOTNULL, '답변 시간'),
			'uq_answer'  => array(TYPE_VARCHAR, 11, ATTR_NOTNULL, '답변내용'),
		);	
		
		parent::__construct();
	}

	
	function listAllByMeseq($me_id){
		if(!is_string($me_id)) return array();

		$where = array('uq_meid' => $me_id);
		return parent::listAll('*', $where);
	}

	function insertRow($args){
		parent::insert($args);
		return true;
	}

	function getRowBySeqMeid($uq_seq, $meid){
		if(!is_numeric($uq_seq) || !$meid) return false;
		$where = array('uq_seq' => $uq_seq, 'uq_meid' => $meid);
		return parent::row('*', $where);
	}

	function getRowBySeq($seq){
		if(!is_numeric($seq)) return false;

		$where = array('uq_seq' => $seq);
		return parent::row('*', $where);
	}

	function insertAnswer($args){
		if(!is_numeric($args['uq_seq'])) return false;

		$where = array('uq_seq' => $args['uq_seq']);
		return parent::update($args, $where);
	}

	function countWaitQna(){
		$where = "uq_an_ctime < 1";
		$cnt =  parent::count($where);
		return $cnt;
		
	}


}
?>
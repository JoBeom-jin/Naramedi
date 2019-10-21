<?
defined('BASEPATH') OR exit('No direct script access allowed');

/*
create table cash_history(
ch_seq int unsigned not null primary key auto_increment,
ch_ctime int not null,
ch_inOut varchar(3),
ch_meid varchar(64),
ch_name varchar(128),
ch_result int not null,
ch_hiseq int not null,
ch_eiseq int
);

create table cash_mng_history(
cmh_seq int unsigned not null primary key auto_increment,
cmh_ctime int not null,
cmh_inOut varchar(3),
cmh_meid varchar(64),
cmh_name varchar(128),
cmh_result int not null,
cmh_hiseq int not null
);
*/

class CashModel extends MY_Model{

	public $error_message;

	function __construct(){
		$this->_table = 'cash_history';
		$this->_cols = array(
			'ch_seq'  => array(TYPE_INT, 20, ATTR_PK | ATTR_NOTNULL),
			'ch_ctime'  => array(TYPE_VARCHAR, 11, ATTR_NOTNULL, '입력 시간'),
			'ch_in'  => array(TYPE_INT, 11, ATTR_NONE, '입금'),
			'ch_out'  => array(TYPE_INT, 11, ATTR_NONE, '출금'),
			'ch_meid'  => array(TYPE_VARCHAR, 1, ATTR_NONE, '변경자 아이디'),
			'ch_name'  => array(TYPE_VARCHAR, 11, ATTR_NONE, '변경자 이름'),
			'ch_result'  => array(TYPE_INT, 1, ATTR_NONE, '결과 금액'),
			'ch_hiseq' => array(TYPE_INT, 11, ATTR_NONE, '병원정보 seq'),					
			'ch_eiseq' => array(TYPE_INT, 11, ATTR_NONE, '이벤트 seq'),					
			'ch_memo' => array(TYPE_VARCHAR, 11, ATTR_NONE, '충전 메모'),					
		);

		$this->error_message = false;

		parent::__construct();	
	}

	function insertCash($args, $me_id, $me_name){
		if(!$this->chk->hasText($me_id) || !$this->chk->hastext($me_name)){
			$this->error_message = '캐쉬를 충전할 권한이 없습니다.';
		}else if($this->checkInParam($args) ){
			$args['ch_ctime'] = time();
			$args['ch_out'] = 0;
			$args['ch_meid'] = $me_id;
			$args['ch_name'] = $me_name;

			parent::insert($args);
		}

		if(!$this->error_message) return true;
		else return false;

	}

	function checkInParam(&$args){
		$this->error_message = false;
		if(!is_numeric($args['ch_in']) || $args['ch_in'] < 0 ) $this->error_message = '캐쉬값이 입력되지 않았습니다.';
		else if(!is_numeric($args['ch_hiseq']))  $this->error_message = '병원이 선택되지 않았습니다.';

		if(!$this->error_message) return true;
		else return false;
	}

	function getCashHistoryBySeqs($seqs){
		if(!$seqs) return false;
		else if(is_string($seqs)) $seqs = array($seqs);
		
		if($this->chk->isArray($seqs)){
			$where = 'ch_hiseq in ('.implode(',', $seqs).')';
			$sql = "select ch_hiseq, sum(ch_in) as in_total, sum(ch_out) as out_total, (sum(ch_in) - sum(ch_out)) as total from {$this->_table} where {$where} group by ch_hiseq";
			return  parent::listAllBySql($sql, 'ch_hiseq');
		}
		
		return false;
	}

	function getAccumulateByHiseq($hi_seq){
		if(!is_numeric($hi_seq)) return false;
		$inner_query = "select ( sum(ch_in)-sum(ch_out) ) as total from cash_history where  ch_hiseq={$hi_seq} and ch_seq <= rs.ch_seq group by ch_hiseq ";
		$sql = "select *, ({$inner_query}) as accum from cash_history rs where ch_hiseq={$hi_seq} order by ch_seq desc";
		return parent::listAllBySql($sql);
	}

	function getRowBySeq($seq){
		if(!is_numeric($seq)) return false;

		$where = array('ch_seq' => $seq);
		return parent::row('*', $where);
	}

}

?>
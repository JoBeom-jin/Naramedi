<?
defined('BASEPATH') OR exit('No direct script access allowed');

class AgencyDefaultModel extends MY_Model{

	function __construct(){
		$this->_table = 'hospital_default';
		$this->_cols = array(
			'hd_seq'  => array(TYPE_INT, 20, ATTR_PK | ATTR_NOTNULL),
			'hd_name'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL),
			'hd_type_name'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL),
			'hd_addr1'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL),
			'hd_addr2'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL),
			'hd_addr'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL),
			'hd_code' => array(TYPE_VARCHAR, 100, ATTR_NONE),
			'hd_time_code' => array(TYPE_VARCHAR, 100, ATTR_NONE),
		);
		
		parent::__construct();
	}	

	function insertRow($ex_args){
		$where = array('hd_name'=>$ex_args['A'], 'hd_addr'=>$ex_args['E']);

		if(!parent::exist($where)){
			$args['hd_name'] = $ex_args['A'];
			$args['hd_type_name'] = $ex_args['B'];
			$args['hd_addr1'] = $ex_args['C'];
			$args['hd_addr2'] = $ex_args['D'];
			$args['hd_addr'] = $ex_args['E'];
			return parent::insert($args);
		}else return true;		
	}

	function insertAddRow($ex_args){
		$where = array('hd_name'=>$ex_args['B'], 'hd_addr'=>$ex_args['F']);

		if(!parent::exist($where)){
			$args['hd_name'] = $ex_args['B'];
			$args['hd_type_name'] = $ex_args['C'];
			$args['hd_addr1'] = $ex_args['D'];
			$args['hd_addr2'] = $ex_args['E'];
			$args['hd_addr'] = $ex_args['F'];
			$args['hd_code'] = 'not found';
			return parent::insert($args);
		}else return true;
	}

	function insertCodeBySeq($code, $seq){
		if(!is_numeric($seq) || !$this->chk->hasText($code)) return false;
		$where = array('hd_seq' => $seq);
		$args = array('hd_code' => $code);
		return parent::update($args, $where);
	}

	function insertTimeCodeBySeq($code, $seq){
		if(!is_numeric($seq) || !$this->chk->hasText($code)) return false;
		$where = array('hd_seq' => $seq);
		$args = array('hd_time_code' => $code);
		return parent::update($args, $where);
	}

	function rowBySeq($seq){
		if(!is_numeric($seq)) return false;

		$where = array('hd_seq' => $seq);
		
		return parent::row('*', $where);
		
	}

	function getTotalLestRowByAddTime(){
		$sql = "select count(*) as num from {$this->_table} left join agency_info on ai_number = hd_code where ai_seq is not null and ai_number is not null and ( hd_time_code<>'complete' or hd_time_code is null )";
		$row = parent::rowBySql($sql);
		return $row['num'];
	}

	function getListForAddData(){
		$sql = "select * from {$this->_table} left join agency_info on ai_number = hd_code where ai_seq is not null and ai_number is not null and ( hd_time_code<>'complete' or hd_time_code is null ) limit 500";		
		return parent::listAllBySql($sql);
	}
	
}

?>
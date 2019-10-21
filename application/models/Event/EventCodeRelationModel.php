<?
defined('BASEPATH') OR exit('No direct script access allowed');

/*
create table eventinfo_codes(
ec_eiseq int unsigned  not null,
ec_cdcode char(6) not null,
primary key(ec_eiseq, ec_cdcode)
);
*/

class EventCodeRelationModel extends MY_Model{

	function __construct(){
		$this->_table = 'eventinfo_codes';
		$this->_cols = array(
			'ec_eiseq'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'ec_cdcode'  => array(TYPE_VARCHAR, 6, ATTR_NOTNULL, '코드'),				
		);
		
		parent::__construct();
	}

	function insertCodeBySeq($code, $seq){
		if(!$this->chk->hasText($code) || !is_numeric($seq)) return false;
		$args = array(
				'ec_eiseq' => $seq,
				'ec_cdcode' => $code
			);
		
		parent::insert($args);
		return true;
	}

	function getListBySeq($seq){
		if(!is_numeric($seq)) return array();
		$where = array('ec_eiseq' => $seq);
		return parent::listAll('*', $where, false, FETCH_ASSOC, 'ec_cdcode');
	}

	function getListByCodes($codes){
		if(!is_array($codes) || count($codes) < 1) return array();
		$items = array();
		foreach($codes as $k => $v){
			$items[] = "'{$v}'";
		}
		$where_in = '('.implode(',', $items).')';		
		$sql = "select * from {$this->_table} where ec_cdcode in {$where_in} group by ec_eiseq";
		return parent::listAllBySql($sql);
	}

	function getListByCodesAnd($codes){
		if(!is_array($codes) || count($codes) < 1) return array();		
		$sql = false;
		$ei_seqs = false;

		foreach($codes as $k => $v){
			if(!$ei_seqs){
				$sql = "select ec_eiseq from {$this->_table} where ec_cdcode = '{$v}'";
				$temp = parent::listAllBySql($sql, 'ec_eiseq');
			}else{
				$items = array();
				foreach($ei_seqs as $k2 => $seqs){
					$items[] = "'{$seqs}'";
				}
				$where_in = '('.implode(',', $items).')';
				$sql = "select ec_eiseq from {$this->_table} where ec_eiseq in {$where_in} and ec_cdcode='{$v}'";
				$temp = parent::listAllBySql($sql, 'ec_eiseq');
			}

			if(is_array($temp) && count($temp)>0){
				$ei_seqs = array_keys($temp);				
			}else{
				return array();
			}			
		}
		
		$result = array();

		if(is_array($temp) && count($temp)>0){
			foreach($ei_seqs as $k => $v){
				$temp = array();
				$temp['ec_eiseq'] = $v;
				$result[] = $temp;
			}
		}
		
		return $result;
	}

	function deleteCodesBySeq($ei_seq){
		if(!is_numeric($ei_seq)) return false;
		$where = array('ec_eiseq' => $ei_seq);
		parent::delete($where);
		return true;
	}

}

?>
<?
defined('BASEPATH') OR exit('No direct script access allowed');

/*
create table user_check_event(
	uce_meseq int not null,
	uce_eiseq int not null,
	primary key(uce_meseq, uce_eiseq)
);
*/

class UserCheckEventModel extends MY_Model{

	public $error_message;

	function __construct(){
		$this->_table = 'user_check_event';
		$this->_cols = array(
			'uce_meseq'  => array(TYPE_INT, 20, ATTR_NOTNULL, '사용자 seq'),
			'uce_eiseq'  => array(TYPE_INT, 255, ATTR_NOTNULL, '이벤트 seq'),					
			'uce_ctime'  => array(TYPE_INT, 255, ATTR_NOTNULL, '등록일'),					
		);

		$this->error_message = false;

		parent::__construct();
	}

	function insertCheck($seq, $meseq){
		if(!is_numeric($seq) || !is_numeric($meseq)){
			$this->error_message = '시스템에 오류가 있습니다.';
			return false;
		}

		$args = array(
			'uce_meseq' => $meseq,
			'uce_eiseq' => $seq
		);	


		if(parent::exist($args)){
			$this->error_message = '이미 찜하신 상품입니다.';
			return false;
		}		

		$args['uce_ctime'] = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

		parent::insert($args);
		return true;
	}

	function updateCheck($seq, $meseq){
		if(!is_numeric($seq) || !is_numeric($meseq)){
			$this->error_message = '시스템에 오류가 있습니다.';
			return false;
		}

		$where = array(
			'uce_meseq' => $meseq,
			'uce_eiseq' => $seq
		);	

		parent::delete($where);
		return true;
	}

	function alreadyExists($seq, $meseq){
		$args = array(
			'uce_meseq' => $meseq,
			'uce_eiseq' => $seq
		);

		return parent::exist($args);
	}

	function getListByMeseq($meseq){
		if(!is_numeric($meseq)) return array();

		$where = "uce_meseq={$meseq}";
		$sql = "select uce_eiseq from {$this->_table} where {$where}";
		$list = parent::listAllBySql($sql, 'uce_eiseq');

		if(is_array($list)) return array_keys($list);
		return array();
	}
}

?>
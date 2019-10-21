<?
defined('BASEPATH') OR exit('No direct script access allowed');

/*
create table event_count(
ec_eiseq int unsigned  not null,
ec_ctime int not null,
ec_view int unsigned default 0,
ec_click int unsigned default 0,
primary key(ec_eiseq, ec_ctime)
);
*/

class EventCountModel extends MY_Model{

	public $error_message;
	private $_ctime = false;

	function __construct(){
		$this->_table = 'event_count';
		$this->_cols = array(
			'ec_eiseq'  => array(TYPE_INT, 20, ATTR_PK | ATTR_NOTNULL),
			'ec_ctime'  => array(TYPE_INT, 11, ATTR_NOTNULL, '입력 날짜'),
			'ec_view'  => array(TYPE_INT, 11, ATTR_NONE, '노출수'),
			'ec_click'  => array(TYPE_INT, 11, ATTR_NONE, '클릭수'),								
		);

		$this->error_message = false;
		$this->_ctime = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

		parent::__construct();	
	}

	function insertViewByEiseqs(array $ec_eiseqs){
		if(!isArray_($ec_eiseqs)) return false;

		foreach($ec_eiseqs as $k => $v){
			$this->insertViewByEiseq($v);	
		}		
	}

	function insertViewByEiseq($ec_eiseq){
		if(!is_numeric($ec_eiseq)) return false;

		$where = array(
			'ec_eiseq'=>$ec_eiseq,
			'ec_ctime' => $this->_ctime
		);

		$args['ec_eiseq'] = $ec_eiseq;
		$args['ec_ctime'] = $this->_ctime;
		
		if(parent::exist($where)){
			$args['ec_view'] = 'ec_view+1';
			
			parent::update($args, $where);
		}else{			
			$args['ec_view'] = 1;
			$args['ec_click'] = 0;
			parent::insert($args);
		}
	}

	function insertClickByEiseqs(array $ec_eiseqs){
		if(!isArray_($ec_eiseqs)) return false;

		foreach($ec_eiseqs as $k => $v){
			$this->insertClickByEiseq($v);	
		}
	}

	function insertClickByEiseq($ec_eiseq){
		if(!is_numeric($ec_eiseq)) return false;

		$where = array(
			'ec_eiseq'=>$ec_eiseq,
			'ec_ctime' => $this->_ctime
		);

		$args['ec_eiseq'] = $ec_eiseq;
		$args['ec_ctime'] = $this->_ctime;
		
		if(parent::exist($where)){
			$args['ec_click'] = 'ec_click+1';
			
			parent::update($args, $where);
		}else{			
			$args['ec_view'] = 0;
			$args['ec_click'] = 1;

			parent::insert($args);
		}

	}

}

?>
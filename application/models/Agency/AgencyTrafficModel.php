<?
/*
create table agency_traffic(
at_seq int unsigned not null primary key auto_increment,
at_aiseq int unsigned not null,
at_inct_bus_yn boolean not null default 0,
at_inc_bus varchar(40),
at_sbwy_yn boolean not null default 0,
at_sbwy_route varchar(40),
at_sbwy_goal varchar(60),
at_vll_bus_yn boolean not null default 0,
at_vll_bus_route varchar(40),
at_vll_bus_goal varchar(60),
INDEX(at_aiseq)
);
alter table agency_traffic change at_inct_bus_yn at_inc_bus_yn boolean default 0,
alter table agency_traffic change at_inc_bus at_inc_bus_goal varchar(60);
alter table agency_traffic add at_inc_bus varchar(40);


alter table agency_traffic add at_inc_bus_way varchar(20);
alter table agency_traffic add at_inc_bus_dis varchar(4);

alter table agency_traffic add at_sbwy_way varchar(20);
alter table agency_traffic add at_sbwy_dis varchar(4);

alter table agency_traffic add at_vll_bus_way varchar(20);
alter table agency_traffic add at_vll_bus_dis varchar(4);



alter table agency_traffic change at_sbwy_yn at_sbwy_yn boolean default 0;
alter table agency_traffic change at_vll_bus_yn at_vll_bus_yn boolean default 0;

*/

defined('BASEPATH') OR exit('No direct script access allowed');

class AgencyTrafficModel extends MY_Model{

	private $_mapping = array();

	function __construct(){
		$this->_table = 'agency_traffic';
		$this->_cols = array(
			'at_seq'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'at_aiseq'  => array(TYPE_INT, 11 , ATTR_NOTNULL),
			'at_inc_bus_yn'  => array(TYPE_INT, 1, ATTR_NONE),			
			'at_inc_bus'  => array(TYPE_VARCHAR, 40, ATTR_NONE),
			'at_inc_bus_goal'  => array(TYPE_VARCHAR, 60, ATTR_NONE),
			'at_sbwy_yn'  => array(TYPE_INT, 1, ATTR_NONE),
			'at_sbwy_route'  => array(TYPE_VARCHAR, 40, ATTR_NONE),
			'at_sbwy_goal'  => array(TYPE_VARCHAR, 60, ATTR_NONE),
			'at_vll_bus_yn'  => array(TYPE_INT, 1, ATTR_NONE),
			'at_vll_bus_route'  => array(TYPE_VARCHAR, 40, ATTR_NONE),
			'at_vll_bus_goal'  => array(TYPE_VARCHAR, 60, ATTR_NONE),
			
			'at_inc_bus_way'  => array(TYPE_VARCHAR, 20, ATTR_NONE),	
			'at_inc_bus_dis'  => array(TYPE_VARCHAR, 4, ATTR_NONE),	
			'at_sbwy_way'  => array(TYPE_VARCHAR, 20, ATTR_NONE),	
			'at_sbwy_dis'  => array(TYPE_VARCHAR, 4, ATTR_NONE),	
			'at_vll_bus_way'  => array(TYPE_VARCHAR, 20, ATTR_NONE),	
			'at_vll_bus_dis'  => array(TYPE_VARCHAR, 4, ATTR_NONE),			
			
		);

		/* api to db mapping 정보 */
		$this->_mapping['inctBusInfoInYn'] = 'at_inc_bus_yn';
		$this->_mapping['inctBusGoffJijumNm'] = 'at_inc_bus_goal';
		$this->_mapping['inctBusRouteInfo'] = 'at_inc_bus';
		$this->_mapping['sbwyInfoInYn'] = 'at_sbwy_yn';
		$this->_mapping['sbwyRouteInfo'] = 'at_sbwy_route';
		$this->_mapping['sbwyGoffJijumNm'] = 'at_sbwy_goal';
		$this->_mapping['vllgBusInfoInYn'] = 'at_vll_bus_yn';
		$this->_mapping['vllgBusGoffJijumNm'] = 'at_vll_bus_goal';
		$this->_mapping['vllgBusRouteInfo'] = 'at_vll_bus_route';		
		$this->_mapping['inctBusYoyangDrt'] = 'at_inc_bus_way';
		$this->_mapping['inctBusYoyangDstc'] = 'at_inc_bus_dis';
		$this->_mapping['sbwyYoyangDrt'] = 'at_sbwy_way';
		$this->_mapping['sbwyYoyangDstc'] = 'at_sbwy_dis';
		$this->_mapping['vllgBusYoyangDrt'] = 'at_vll_bus_way';
		$this->_mapping['vllgBusYoyangDstc'] = 'at_vll_bus_dis';
		
		parent::__construct();
	}

	function insertArgsByAiseq($args, $at_aiseq){
		if(!is_numeric($at_aiseq)) return false;
		$args['at_aiseq']= $at_aiseq;
		return parent::insert($args);
	}

	function updateArgsByAiSeq($args, $at_aiseq){
		if(!is_numeric($at_aiseq)) return false;		

		if($this->chk->hasArrayValue('at_inc_bus', $args) || $this->chk->hasArrayValue('at_inc_bus_goal', $args) || $this->chk->hasArrayValue('at_inc_bus_way', $args) || $this->chk->hasArrayValue('at_inc_bus_dis', $args)){
			$args['at_inc_bus_yn'] = 1;
		}else $args['at_inc_bus_yn'] = 0;

		if($this->chk->hasArrayValue('at_sbwy_route', $args) || $this->chk->hasArrayValue('at_sbwy_goal', $args) || $this->chk->hasArrayValue('at_sbwy_way', $args) || $this->chk->hasArrayValue('at_sbwy_dis', $args)){ 
			$args['at_sbwy_yn'] = 1;
		}
		else $args['at_sbwy_yn'] = 0;

		if($this->chk->hasArrayValue('at_vll_bus_route', $args) || $this->chk->hasArrayValue('at_vll_bus_goal', $args) || $this->chk->hasArrayValue('at_vll_bus_way', $args) || $this->chk->hasArrayValue('at_vll_bus_dis', $args)){
			$args['at_vll_bus_yn'] = 1;
		}
		else $args['at_vll_bus_yn'] = 0;

		$where = array('at_aiseq' => $at_aiseq);

		if(parent::exist($where)) $result = parent::update($args, $where);		
		else{
			$args['at_aiseq'] = $at_aiseq;
			$result = parent::insert($args);
		}

		return $result;
	}

	/*
	* 신규 교통 정보를 입력합니다.
	*/
	function insertFromApiResult(&$data, $seq){
		if(!$data || !is_array($data) || count($data) < 1 || !is_numeric($seq)) return false;		
		$args = $this->_mappingField($data);
		$args['at_aiseq'] = $seq;
		parent::insert($args);		
	}


	/*
	* 기존 교통 정보를 수정합니다.
	*/
	function updateFromApiResult($data, $row, $seq, $ignore_flag = false){
		if(!$data || !is_array($data) || count($data) < 1 || !is_numeric($seq) || !$row || count($row) < 1) return false;
		$args = $this->_mappingField($data);
		if(!is_array($args) || count($args) < 1) return false;

		if(!$ignore_flag) $args = $this->_removeItemForAlreadyExists($args, $row);
		$where = array('at_aiseq' => $seq);
		return parent::update($args, $where);
	}

	/*
	* API 데이터를 DB 필드 데이터로 변경
	*/
	private function _mappingField($data){
		$row = array();
		foreach($data as $k => $v){
			if(!array_key_exists($k, $this->_mapping)) continue;

			$key = $this->_mapping[$k];
			$row[$key] = $v;			
		}

		if($this->chk->hasArrayValue('at_inc_bus', $row) || $this->chk->hasArrayValue('at_inc_bus_goal', $row) || $this->chk->hasArrayValue('at_inc_bus_way', $row) || $this->chk->hasArrayValue('at_inc_bus_dis', $row)){
			$row['at_inc_bus_yn'] = 1;
		}else $row['at_inc_bus_yn'] = 0;

		if($this->chk->hasArrayValue('at_sbwy_route', $row) || $this->chk->hasArrayValue('at_sbwy_goal', $row) || $this->chk->hasArrayValue('at_sbwy_way', $row) || $this->chk->hasArrayValue('at_sbwy_dis', $row)){ 
			$row['at_sbwy_yn'] = 1;
		}
		else $row['at_sbwy_yn'] = 0;

		if($this->chk->hasArrayValue('at_vll_bus_route', $row) || $this->chk->hasArrayValue('at_vll_bus_goal', $row) || $this->chk->hasArrayValue('at_vll_bus_way', $row) || $this->chk->hasArrayValue('at_vll_bus_dis', $row)){
			$row['at_vll_bus_yn'] = 1;
		}
		else $row['at_vll_bus_yn'] = 0;



		return $row;								
	}

	/*
	* 이미 존재하는 row 값과 비교하여 빈 곳만 업데이트 정보로 채운다.
	* @$args : API에서 호출한 값
	* @$current_row : 현재 DB에 저장된 값
	*/
	private function _removeItemForAlreadyExists($args, $current_row){
		foreach($current_row as $k => $row){
			if(!$row){
				$current_row[$k] = $args[$k];
			}
		}		
		return $current_row;
	}

	/*
	* 해당 정보가 중복인지 확인하고 중복이면 1개를 제외하고 삭제
	*/
	function removeDuplicate($ai_seq){
		$where = array('at_aiseq' => $ai_seq);
		$list = parent::listAll('*', $where);		
		if(is_array($list) && count($list) > 1){			
			foreach($list as $k => $v){			
				if($k == 0) continue;							
				$where = array('at_seq' => $v['at_seq']);
				parent::delete($where);			
			}
		}				
	}
}

?>
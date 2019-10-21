<?
/*
create table agency_park(
ap_seq int unsigned not null primary key auto_increment,
ap_aiseq int unsigned not null,
ap_pay_yn boolean not null default 0,
ap_number int unsigned not null default 0,
ap_self_yn boolean not null default 0,
INDEX(ap_aiseq)
);
alter table agency_park add ap_comment varchar(255);

alter table agency_park change ap_pay_yn ap_pay_yn boolean;
alter table agency_park change ap_number ap_number int unsigned default 0;
alter table agency_park change ap_self_yn ap_self_yn boolean default 0;

alter table agency_park change ap_number ap_number varchar(6) default 0;

alter table agency_park add ap_satYn int default 0;
alter table agency_park change ap_satYn ap_satYn char(1) default '0';

alter table agency_park add ap_sat_jin_start varchar(6);
alter table agency_park add ap_sat_jin_end varchar(6);
alter table agency_park add ap_sat_rsv_start varchar(6);
alter table agency_park add ap_sat_rsv_end varchar(6);

alter table agency_park add ap_lun_start varchar(6);
alter table agency_park add ap_lun_end varchar(6);
alter table agency_park add ap_jin_start varchar(6);
alter table agency_park add ap_jin_end varchar(6);
alter table agency_park add ap_rsv_start varchar(6);
alter table agency_park add ap_rsv_end varchar(6);




*/

defined('BASEPATH') OR exit('No direct script access allowed');

class AgencyParkModel extends MY_Model{

	private $_mapping = array();

	function __construct(){
		$this->_table = 'agency_park';
		$this->_cols = array(
			'ap_seq'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'ap_aiseq'  => array(TYPE_INT, 11 , ATTR_NOTNULL),
			'ap_pay_yn'  => array(TYPE_INT, 1, ATTR_NONE),
			'ap_number'  => array(TYPE_VARCHAR, 11, ATTR_NONE),
			'ap_self_yn'  => array(TYPE_INT, 1, ATTR_NONE),					
			'ap_comment'  => array(TYPE_VARCHAR, 255, ATTR_NONE),					
			'ap_satYn'  => array(TYPE_VARCHAR, 1, ATTR_NONE),

			'ap_sat_jin_start'  => array(TYPE_VARCHAR, 6, ATTR_NONE),					
			'ap_sat_jin_end'  => array(TYPE_VARCHAR, 6, ATTR_NONE),					
			'ap_sat_rsv_start'  => array(TYPE_VARCHAR, 6, ATTR_NONE),					
			'ap_sat_rsv_end'  => array(TYPE_VARCHAR, 6, ATTR_NONE),					

			'ap_lun_start'  => array(TYPE_VARCHAR, 6, ATTR_NONE),					
			'ap_lun_end'  => array(TYPE_VARCHAR, 6, ATTR_NONE),					

			'ap_jin_start'  => array(TYPE_VARCHAR, 6, ATTR_NONE),					
			'ap_jin_end'  => array(TYPE_VARCHAR, 6, ATTR_NONE),					
			'ap_rsv_start'  => array(TYPE_VARCHAR, 6, ATTR_NONE),					
			'ap_rsv_end'  => array(TYPE_VARCHAR, 6, ATTR_NONE),
		);

		$this->_mapping['pkgCostBrdnYn'] = 'ap_pay_yn';
		$this->_mapping['pkgPsblCnt'] = 'ap_number';
		$this->_mapping['pkglotRunYn'] = 'ap_self_yn';
		$this->_mapping['pkgEtcComt'] = 'ap_comment';
		$this->_mapping['satAllSusmdtYn'] = 'ap_satYn';
		$this->_mapping['satMcareFrTm'] = 'ap_sat_jin_start';
		$this->_mapping['satMcareToTm'] = 'ap_sat_jin_end';
		$this->_mapping['satRecvFrTm'] = 'ap_sat_rsv_start';
		$this->_mapping['satRecvToTm'] = 'ap_sat_rsv_end';
		$this->_mapping['wkdayLunchFrTm'] = 'ap_lun_start';
		$this->_mapping['wkdayLunchToTm'] = 'ap_lun_end';
		$this->_mapping['wkdayMcareFrTm'] = 'ap_jin_start';
		$this->_mapping['wkdayMcareToTm'] = 'ap_jin_end';
		$this->_mapping['wkdayRecvFrTm'] = 'ap_rsv_start';
		$this->_mapping['wkdayRecvToTm'] = 'ap_rsv_end';		
		
		parent::__construct();
	}

	function insertArgsByAiseq(&$args, $aiseq){		

		if(!$args['ap_pay_yn']) $args['ap_pay_yn'] = null;
		if(!$args['ap_self_yn']) $args['ap_self_yn'] = null;	
		$args['ap_aiseq'] = $aiseq;	

		return parent::insert($args);		
	}

	function updateArgsByAiSeq(&$args, $aiseq){
		if(!is_numeric($aiseq)) return false;

		if(!$args['ap_pay_yn']) $args['ap_pay_yn'] = 0;
		if(!$args['ap_self_yn']) $args['ap_self_yn'] = 0;

		if($args['ap_lun_start_time'] &&  $args['ap_lun_start_minuet']) $args['ap_lun_start'] = $args['ap_lun_start_time'].$args['ap_lun_start_minuet'];
		else $args['ap_lun_start'] = '';

		if($args['ap_lun_end_time'] &&  $args['ap_lun_end_minuet']) $args['ap_lun_end'] = $args['ap_lun_end_time'].$args['ap_lun_end_minuet'];
		else $args['ap_lun_end'] = '';

		if($args['ap_jin_start_time'] &&  $args['ap_jin_start_minuet']) $args['ap_jin_start'] = $args['ap_jin_start_time'].$args['ap_jin_start_minuet'];
		else $args['ap_jin_start'] = '';

		if($args['ap_jin_end_time'] &&  $args['ap_jin_end_minuet']) $args['ap_jin_end'] = $args['ap_jin_end_time'].$args['ap_jin_end_minuet'];
		else $args['ap_jin_end'] = '';

		if($args['ap_rsv_start_time'] &&  $args['ap_rsv_start_minuet']) $args['ap_rsv_start'] = $args['ap_rsv_start_time'].$args['ap_rsv_start_minuet'];
		else $args['ap_rsv_start'] = '';

		if($args['ap_rsv_end_time'] &&  $args['ap_rsv_end_minuet']) $args['ap_rsv_end'] = $args['ap_rsv_end_time'].$args['ap_rsv_end_minuet'];
		else $args['ap_rsv_end'] = '';

		if($args['ap_sat_jin_start_time'] &&  $args['ap_sat_jin_start_minuet']) $args['ap_sat_jin_start'] = $args['ap_sat_jin_start_time'].$args['ap_sat_jin_start_minuet'];
		else $args['ap_sat_jin_start'] = '';

		if($args['ap_sat_jin_end_time'] &&  $args['ap_sat_jin_end_minuet']) $args['ap_sat_jin_end'] = $args['ap_sat_jin_end_time'].$args['ap_sat_jin_end_minuet'];
		else $args['ap_sat_jin_end'] = '';

		if($args['ap_sat_rsv_start_time'] &&  $args['ap_sat_rsv_start_minuet']) $args['ap_sat_rsv_start'] = $args['ap_sat_rsv_start_time'].$args['ap_sat_rsv_start_minuet'];
		else $args['ap_sat_rsv_start'] = '';

		if($args['ap_sat_rsv_end_time'] &&  $args['ap_sat_rsv_end_minuet']) $args['ap_sat_rsv_end'] = $args['ap_sat_rsv_end_time'].$args['ap_sat_rsv_end_minuet'];
		else $args['ap_sat_rsv_end'] = '';

		$where = array('ap_aiseq' => $aiseq);

		if(parent::exist($where)){
			return parent::update($args, $where);
		}else{
			$args['ap_aiseq'] = $aiseq;
			return parent::insert($args);
		}
		
	}

	/*
	* 신규 정보를 입력합니다.
	*/
	function insertFromApiResult(&$data, $seq){
		if(!$data || !is_array($data) || count($data) < 1 || !is_numeric($seq)) return false;		
		$args = $this->_mappingField($data);
		$args['ap_aiseq'] = $seq;		
		parent::insert($args);
	}

	/*
	* 기존 정보를 수정합니다.
	*/
	function updateFromApiResult($data, $row, $seq, $ignore_flag = false){
		if(!$data || !is_array($data) || count($data) < 1 || !is_numeric($seq) || !$row || count($row) < 1) return false;
		$args = $this->_mappingField($data);
		if(!is_array($args) || count($args) < 1) return false;

		if(!$ignore_flag) $args = $this->_removeItemForAlreadyExists($args, $row);
		$where = array('ap_aiseq' => $seq);
		return parent::update($args, $where);
	}


	/*
	* API 정보를 Table 필드에 맞게 변경
	*/
	private function _mappingField(&$data){
		$row = array();

		foreach($data as $k => $v){
			if(!array_key_exists($k, $this->_mapping)) continue;

			$key = $this->_mapping[$k];
			$row[$key] = $v;			
		}

		if(!isset($row['ap_pay_yn']) || !$row['ap_pay_yn']) $row['ap_pay_yn'] = 0;
		if(!isset($row['ap_self_yn']) || !$row['ap_self_yn']) $row['ap_self_yn'] = 0;
		
		return $row;
	}

	/*
	* 이미 존재하는 row 값과 비교하여 빈 곳만 업데이트 정보로 채운다.
	* @$args : API에서 호출한 값을 table 필드로 매핑한 값
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
		$where = array('ap_aiseq' => $ai_seq);
		$list = parent::listAll('*', $where);			
		if(is_array($list) && count($list) > 1){			
			foreach($list as $k => $v){			
				if($k == 0) continue;							
				$where = array('ap_seq' => $v['ap_seq']);
				parent::delete($where);			
			}
		}				
	}
}

?>
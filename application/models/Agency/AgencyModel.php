<?
/*
create table agency_info(
ai_seq int unsigned not null primary key auto_increment,
ai_number int unsigned not null,
ai_name varchar(200) not null,
ai_phone varchar(20) not null,
ai_x varchar(40) not null,
ai_y varchar(40) not null,
ai_ex_fax varchar(20),
ai_ex_phone varchar(100),
ai_gren_cd char(2),
ai_bc_cd char(2),
ai_cc_cd char(2),
ai_cvxca_cd char(2),
ai_ichk_cd char(2),
ai_lvca_cd char(2),
ai_mchk_cd char(2),
ai_stmca_cd char(2),
ai_addr varchar(200),
ai_post char(6),
ai_sido_cd char(2),
ai_sigungu_cd char(3),
ai_lunch_start char(6),
ai_lunch_end char(6),
ai_ctime int not null,
INDEX(ai_name(200), ai_x(40), ai_y(40))
);
alter table agency_info add ai_addr_text1 varchar(50);
alter table agency_info add ai_addr_text2 varchar(50);
alter table agency_info add ai_homepage varchar(255);
alter table agency_info add ai_adddata_utime int;
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class AgencyModel extends MY_Model{

	function __construct(){
		$this->_table = 'agency_info';
		$this->_cols = array(
			'ai_seq'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'ai_number'  => array(TYPE_INT, 11 , ATTR_NOTNULL),
			'ai_name'  => array(TYPE_VARCHAR, 200, ATTR_NOTNULL),
			'ai_phone'  => array(TYPE_VARCHAR, 20, ATTR_NONE),
			'ai_x'  => array(TYPE_VARCHAR, 40, ATTR_NONE),
			'ai_y'  => array(TYPE_VARCHAR, 40, ATTR_NONE),
			'ai_ex_fax'  => array(TYPE_VARCHAR, 20, ATTR_NONE),
			'ai_ex_phone'  => array(TYPE_VARCHAR, 100, ATTR_NONE),
			'ai_gren_cd'  => array(TYPE_VARCHAR, 2, ATTR_NONE),
			'ai_bc_cd'  => array(TYPE_VARCHAR, 2, ATTR_NONE),
			'ai_cc_cd'  => array(TYPE_VARCHAR, 2, ATTR_NONE),
			'ai_cvxca_cd'  => array(TYPE_VARCHAR, 2, ATTR_NONE),
			'ai_ichk_cd'  => array(TYPE_VARCHAR, 2, ATTR_NONE),
			'ai_lvca_cd'  => array(TYPE_VARCHAR, 2, ATTR_NONE),
			'ai_mchk_cd'  => array(TYPE_VARCHAR, 2, ATTR_NONE),
			'ai_stmca_cd'  => array(TYPE_VARCHAR, 2, ATTR_NONE),
			'ai_addr'  => array(TYPE_VARCHAR, 200, ATTR_NONE),
			'ai_post'  => array(TYPE_VARCHAR, 6, ATTR_NONE),
			'ai_sido_cd'  => array(TYPE_VARCHAR, 2, ATTR_NONE),
			'ai_sigungu_cd'  => array(TYPE_VARCHAR, 3, ATTR_NONE),
			'ai_lunch_start'  => array(TYPE_VARCHAR, 6, ATTR_NONE),
			'ai_lunch_end'  => array(TYPE_VARCHAR, 6, ATTR_NONE),
			'ai_ctime'  => array(TYPE_INT, 11, ATTR_NOTNULL),
			'ai_addr_text1'  => array(TYPE_VARCHAR, 11, ATTR_NOTNULL),
			'ai_addr_text2'  => array(TYPE_VARCHAR, 11, ATTR_NOTNULL),
			'ai_homepage'  => array(TYPE_VARCHAR, 255, ATTR_NONE),
			'ai_adddata_utime'  => array(TYPE_INT, 11, ATTR_NONE),
		);
		
		parent::__construct();
	}

	function getSeqAfterInsertArgs(&$args){
		if(!$this->checkInsertParam($args)) return false;

		$args['ai_ctime'] = time();
		parent::insert($args);

		$where = array('ai_number'=>$args['ai_number']);
		return parent::value('ai_seq', $where);
	}
	
	/*
	* 검증기관 정보를 입력. 
	* 관리자가 직접 입력하는 값이므로 파라메터 값에 대한 검증이 API 방식과 다르다.
	*/
	function getSeqAfterInsertArgsDirectly(&$args, &$return){
		$msg = false;
		$msg = $this->checkInsertArgs($args);		
		
		if(!$msg){
			$args['ai_ctime'] = time();
			parent::insert($args);
			$where = array(
					'ai_number' => $args['ai_number']
				);
			$return = parent::value('ai_seq', $where);
		}		

		return $msg;
	}

	function checkInsertArgs(&$args){
		$msg = false;

		if(!$this->chk->hasText($args['ai_name'])) $msg = '검진기관명은 반드시 입력하셔야 합니다.';
		else if(!$this->chk->hasText($args['ai_number']) || !is_numeric($args['ai_number']) ) $msg = '검진기관 번호는 반드시 입력하셔야 합니다.';
		else if(!$this->chk->hasText($args['ai_addr_text1'])) $msg = '시도 정보는 반드시 입력하셔야 합니다.';
		else if(!$this->chk->hasText($args['ai_addr_text2'])) $msg = '시군구 정보는 반드시 입력하셔야 합니다.';
		else if(!$this->chk->hasText($args['ai_addr'])) $msg = '좌표를 구하기 위해 주소는 반드시 입력해주셔야 합니다.';
		else if(!$this->chk->hasText($args['ai_phone'])) $msg = '전화번호를 입력해주세요.';
		else if(!$this->chk->hasText($args['ai_ex_phone'])) $msg = '검진실 전화번호를 입력해주세요.';
		else if(!$this->chk->hasArrayValue('ai_gren_cd', $args) && !$this->chk->hasArrayValue('ai_bc_cd', $args) && !$this->chk->hasArrayValue('ai_cc_cd', $args) && !$this->chk->hasArrayValue('ai_cvxca_cd', $args) && !$this->chk->hasArrayValue('ai_ichk_cd', $args) && !$this->chk->hasArrayValue('ai_lvca_cd', $args) && !$this->chk->hasArrayValue('ai_mchk_cd', $args) && !$this->chk->hasArrayValue('ai_stmca_cd', $args) ) $msg = '검진항목은 적어도 1개 이상 선택되어야 합니다.'; 
		
		if(!$msg){
			$where = array('ai_number' => $args['ai_number']);
			if(parent::exist($where)) $msg = '이미 존재하는 검진기관 번호입니다.';
		}

		return $msg;
	}


	function updateBySeq(&$args, $ai_seq){
		$msg = false;
		if(!is_numeric($ai_seq)) $msg = 'Seq가 전달되지 않았습니다.';				

		if(!$msg && $this->checkInsertParam($args)){	
			$this->setArgs($args);			

			$where = array('ai_seq' => $ai_seq);
			parent::update($args, $where);
		}

		return $msg;
	}


	function updateByNumber(&$args, $ai_number){
		$msg = false;		
		if(!is_numeric($ai_number)) $msg = 'ai_number 값을 알 수 없습니다.';

		if(!$msg){
			$this->setArgs($args);			
			$where = array('ai_number' => $ai_number);
			parent::update($args, $where);
		}

		return $msg;
	}

	function setArgs(&$args){
//		if($args['ai_lunch_start_time'] && $args['ai_lunch_start_minuet']) $args['ai_lunch_start'] = $args['ai_lunch_start_time'].$args['ai_lunch_start_minuet'];
//		else $args['ai_lunch_start'] = false;
//
//		if($args['ai_lunch_end_time'] && $args['ai_lunch_end_minuet']) $args['ai_lunch_end'] = $args['ai_lunch_end_time'].$args['ai_lunch_end_minuet'];
//		else $args['ai_lunch_end']=false;

		if(!$this->chk->hasArrayValue('ai_gren_cd', $args)) $args['ai_gren_cd'] = 0;
		if(!$this->chk->hasArrayValue('ai_bc_cd', $args)) $args['ai_bc_cd'] = 0;
		if(!$this->chk->hasArrayValue('ai_cc_cd', $args)) $args['ai_cc_cd'] = 0;
		if(!$this->chk->hasArrayValue('ai_cvxca_cd', $args)) $args['ai_cvxca_cd'] = 0;
		if(!$this->chk->hasArrayValue('ai_ichk_cd', $args)) $args['ai_ichk_cd'] = 0;
		if(!$this->chk->hasArrayValue('ai_lvca_cd', $args)) $args['ai_lvca_cd'] = 0;
		if(!$this->chk->hasArrayValue('ai_mchk_cd', $args)) $args['ai_mchk_cd'] = 0;
		if(!$this->chk->hasArrayValue('ai_stmca_cd', $args)) $args['ai_stmca_cd'] = 0;

		if(!isset($args['ai_phone']) || !$this->chk->hasText($args['ai_phone'])) $args['ai_phone'] = 'none';
		if(!isset($args['ai_x']) || !$this->chk->hasText($args['ai_x'])) $args['ai_x'] = 'nodata';
		if(!isset($args['ai_y']) || !$this->chk->hasText($args['ai_y'])) $args['ai_y'] = 'nodata';
	}

	function checkInsertParam(&$args){
		if(!$this->chk->hasText($args['ai_number'])) return false;
		else if(!$this->chk->hasText($args['ai_name'])) return false;		
		
		return true;
	}

	function getTotal(){
		return parent::count();
	}

	function getTotalMember(){
		$sql = "select count(*) as num from {$this->_table} left join hospital_info on ai_number = hi_org_number where hi_active='Y'";
		$result = parent::rowBySql($sql);
		return $result['num'];
	}

	function getSido(){
		$sql = "select ai_addr_text1 from {$this->_table} group by ai_addr_text1";
		return parent::listAllBySql($sql);
	}

	function getSigungu($sido){
		if(!$this->chk->hasText($sido)) return false;
		$where = " where ai_addr_text1='{$sido}'";		
		$sql = "select ai_addr_text2 from {$this->_table} {$where} group by ai_addr_text2";
		return parent::listAllBySql($sql);
	}

	function getFullInfoBySeq($seq){
		if(!is_numeric($seq)) return false;
		$where = " where ai_seq={$seq}";
		$sql = "select * from {$this->_table} left join hospital_info on ai_number = hi_org_number left join agency_park on ai_seq = ap_aiseq left join agency_traffic on ai_seq = at_aiseq {$where}";
		$row = parent::rowBySql($sql);

		$this->setTimeByRow($row);	


		return $row;
	}

	function setStringByArgs(&$args){		

		$lunch_string = '';

		$work = array();			//검진항목
		$args['works'] = false;
		if($args['ai_gren_cd']) $work[] = '일반(생애 1, 2차)';
		if($args['ai_bc_cd']) $work[] = '유방암';
		if($args['ai_cc_cd']) $work[] = '대장암';
		if($args['ai_cvxca_cd']) $work[] = '자궁경부암';
		if($args['ai_ichk_cd']) $work[] = '영유아';
		if($args['ai_lvca_cd']) $work[] = '간암';
		if($args['ai_mchk_cd']) $work[] = '구강검진';
		if($args['ai_stmca_cd']) $work[] = '위암';
		if(count($work) > 0) $args['works'] = implode(', ', $work);	
		
		$args['bus'] = false;
		if($args['at_inc_bus_yn'] && $this->chk->hasText($args['at_inc_bus'])){
			$bus_string[] = '시내버스 : '.$args['at_inc_bus'];		
			if($this->chk->hasText($args['at_inc_bus_goal'])) $bus_string[] = $args['at_inc_bus_goal'];
			if($this->chk->hasText($args['at_inc_bus_way'])) $bus_string[] = $args['at_inc_bus_way'];
			if($this->chk->hasText($args['at_inc_bus_dis'])) $bus_string[] = $args['at_inc_bus_dis'];
			$args['bus'] = implode(' / ', $bus_string);
		}

		$args['subway'] = false;
		if($args['at_sbwy_yn'] && $this->chk->hasText($args['at_sbwy_route'])){
			$subway[] = '지하철 : '.$args['at_sbwy_route'];
			if($this->chk->hasText($args['at_sbwy_goal'])) $subway[] = $args['at_sbwy_goal'];
			if($this->chk->hasText($args['at_sbwy_way'])) $subway[] = $args['at_sbwy_way'];
			if($this->chk->hasText($args['at_sbwy_dis'])) $subway[] = $args['at_sbwy_dis'];
			$args['subway'] = implode(' / ', $subway);
		}
		
		$args['park'] = '';
		$park = array();
		if($args['ap_number'] && $args['ap_number'] > 0) $park[] = "가능대수 : {$args['ap_number']}대";
		if($args['ap_pay_yn'] == 0 ) $park[] = '무료';
		else if($args['ap_pay_yn'] == 1) $park[] = '유료';
		if($this->chk->hasText($args['ap_comment'])) $park[] = "({$args['ap_comment']})";
		$args['park'] = implode(', ', $park);

		$args['lunch'] = '';
		$lunch = array();
		if($args['ap_lun_start']) $lunch[] = substr($args['ap_lun_start'], 0,2).':'.substr($args['ap_lun_start'], 2,2);
		if($args['ap_lun_end']) $lunch[] = substr($args['ap_lun_end'], 0,2).':'.substr($args['ap_lun_end'], 2,2);
		$args['lunch'] = implode(' ~ ', $lunch);		

		$args['sat_jin'] = '';
		$_sat_jin = array();
		if($args['ap_sat_jin_start']) $_sat_jin[] = substr($args['ap_sat_jin_start'], 0,2).':'.substr($args['ap_sat_jin_start'], 2,2);
		if($args['ap_sat_jin_end']) $_sat_jin[] = substr($args['ap_sat_jin_end'], 0,2).':'.substr($args['ap_sat_jin_end'], 2,2);
		$args['sat_jin'] = implode(' ~ ', $_sat_jin);


		$args['sat_rsv'] = '';
		$_sat_rsv = array();
		if($args['ap_sat_rsv_start']) $_sat_rsv[] = substr($args['ap_sat_rsv_start'], 0,2).':'.substr($args['ap_sat_rsv_start'], 2,2);
		if($args['ap_sat_rsv_end']) $_sat_rsv[] = substr($args['ap_sat_rsv_end'], 0,2).':'.substr($args['ap_sat_rsv_end'], 2,2);
		$args['sat_rsv'] = implode(' ~ ', $_sat_rsv);

		$args['jin'] = '';
		$_jin = array();
		if($args['ap_jin_start']) $_jin[] = substr($args['ap_jin_start'], 0,2).':'.substr($args['ap_jin_start'], 2,2);
		if($args['ap_jin_end']) $_jin[] = substr($args['ap_jin_end'], 0,2).':'.substr($args['ap_jin_end'], 2,2);
		$args['jin'] = implode(' ~ ', $_jin);

		$args['rsv'] = '';
		$_rsv = array();
		if($args['ap_rsv_start']) $_rsv[] = substr($args['ap_rsv_start'], 0,2).':'.substr($args['ap_rsv_start'], 2,2);
		if($args['ap_rsv_end']) $_rsv[] = substr($args['ap_rsv_end'], 0,2).':'.substr($args['ap_rsv_end'], 2,2);
		$args['rsv'] = implode(' ~ ', $_rsv);
	}

	function existAgencyByNumber($number){
		if(!$number) return false;
		$where = array('ai_number' => $number);
		return parent::exist($where);

	}

	function rowBySeq($seq){
		if(!is_numeric($seq)) return false;
		$where = array('ai_seq' => $seq);
		return parent::row('*', $where);
	}

	function getSeqByAinumber($ai_number){
		if(!is_numeric($ai_number)) return false;
		$where = array('ai_number' => $ai_number);
		return parent::value('ai_seq', $where);
	}

	function searchByName($name){
		if(!$this->chk->hasText($name)) return false;
		
		$where = "ai_name like '%{$name}%'";
		$order = 'binary(ai_name) asc';
		return parent::listAll('*', $where, $order);
	}

	function getCities(){
		$sql = "select ai_addr_text1 from {$this->_table} where ai_addr_text1 is not null and ai_addr_text1 <>'' group by ai_addr_text1 order by binary(ai_addr_text1) asc";
		return parent::listAllBySql($sql);
	}
	
	function getLocal($name){
		if(!$name) return false;

		$sql = "select ai_addr_text2 from {$this->_table} where ai_addr_text1='{$name}' and ai_addr_text2 is not null and ai_addr_text2 <>'' group by ai_addr_text2 order by binary(ai_addr_text2) asc";

		return parent::listAllBySql($sql);
	}

	function getListByMap($ne_x, $ne_y, $sw_x, $sw_y, $ignore_data =array() , $start = false, $number = false){
		if(!is_numeric($ne_x) || !is_numeric($ne_y) || !is_numeric($sw_x) || !is_numeric($sw_y)) return array();

		$add_where = '';
		if(isArray_($ignore_data)){
			$query_string = '('.implode(',',$ignore_data).')';
			$add_where = "and ai_seq not in {$query_string}";
		}

		$limit = '';
		if(is_numeric($start) && is_numeric($number)){
			$limit = " limit {$start}, {$number}";
		}

		$sub_sql = "( select avg(ac_obj) from agency_comment  where ac_aiseq=ai_seq group by ac_aiseq ) as obj_avg";

		$where = "ai_x < {$ne_x} and ai_x > {$sw_x} and ai_y < {$ne_y} and ai_y > {$sw_y} {$add_where}";
		$sql = "select *, {$sub_sql} from {$this->_table} where {$where} {$limit}";
		return parent::listAllBySql($sql);		
	}

	function getRowByNumber($number){
		if(!$number) return array();

		$where = array('ai_number' => $number);
		return parent::row('*', $where);
	}

	function setTimeByRow(&$row){
		//점심시간 시작
		if($this->chk->hasText($row['ap_lun_start'])){
			$row['ap_lun_start_time'] = substr($row['ap_lun_start'], 0, 2);
			$row['ap_lun_start_minuet'] = substr($row['ap_lun_start'], 2, 2);
		}else{
			$row['ap_lun_start_time'] = false;
			$row['ap_lun_start_minuet'] = false;
		}

		//점심시간 종료
		if($this->chk->hasText($row['ap_lun_end'])){
			$row['ap_lun_end_time'] = substr($row['ap_lun_end'], 0, 2);
			$row['ap_lun_end_minuet'] = substr($row['ap_lun_end'], 2, 2);
		}else{
			$row['ap_lun_end_time'] = false;
			$row['ap_lun_end_minuet'] = false;
		}

		//토요일 진료시간 시작
		if($this->chk->hasText($row['ap_sat_jin_start'])){
			$row['ap_sat_jin_start_time'] = substr($row['ap_sat_jin_start'], 0, 2);
			$row['ap_sat_jin_start_minuet'] = substr($row['ap_sat_jin_start'], 2, 2);
		}else{
			$row['ap_sat_jin_start_time'] = false;
			$row['ap_sat_jin_start_minuet'] = false;
		}

		//토요일 진료시간 종료
		if($this->chk->hasText($row['ap_sat_jin_end'])){
			$row['ap_sat_jin_end_time'] = substr($row['ap_sat_jin_end'], 0, 2);
			$row['ap_sat_jin_end_minuet'] = substr($row['ap_sat_jin_end'], 2, 2);
		}else{
			$row['ap_sat_jin_end_time'] = false;
			$row['ap_sat_jin_end_minuet'] = false;
		}

		//토요일 예약시작 시간
		if($this->chk->hasText($row['ap_sat_rsv_start'])){
			$row['ap_sat_rsv_start_time'] = substr($row['ap_sat_rsv_start'], 0, 2);
			$row['ap_sat_rsv_start_minuet'] = substr($row['ap_sat_rsv_start'], 2, 2);
		}else{
			$row['ap_sat_rsv_start_time'] = false;
			$row['ap_sat_rsv_start_minuet'] = false;
		}

		//토요일 예약종료 시간
		if($this->chk->hasText($row['ap_sat_rsv_end'])){
			$row['ap_sat_rsv_end_time'] = substr($row['ap_sat_rsv_end'], 0, 2);
			$row['ap_sat_rsv_end_minuet'] = substr($row['ap_sat_rsv_end'], 2, 2);
		}else{
			$row['ap_sat_rsv_end_time'] = false;
			$row['ap_sat_rsv_end_minuet'] = false;
		}

		//평일 검진 시작 시간
		if($this->chk->hasText($row['ap_jin_start'])){
			$row['ap_jin_start_time'] = substr($row['ap_jin_start'], 0, 2);
			$row['ap_jin_start_minuet'] = substr($row['ap_jin_start'], 2, 2);
		}else{
			$row['ap_jin_start_time'] = false;
			$row['ap_jin_start_minuet'] = false;
		}

		//평일 검진 종료 시간
		if($this->chk->hasText($row['ap_jin_end'])){
			$row['ap_jin_end_time'] = substr($row['ap_jin_end'], 0, 2);
			$row['ap_jin_end_minuet'] = substr($row['ap_jin_end'], 2, 2);
		}else{
			$row['ap_jin_end_time'] = false;
			$row['ap_jin_end_minuet'] = false;
		}

		//평일 예약 시작 시간
		if($this->chk->hasText($row['ap_rsv_start'])){
			$row['ap_rsv_start_time'] = substr($row['ap_rsv_start'], 0, 2);
			$row['ap_rsv_start_minuet'] = substr($row['ap_rsv_start'], 2, 2);
		}else{
			$row['ap_rsv_start_time'] = false;
			$row['ap_rsv_start_minuet'] = false;
		}

		//평일 예약 종료 시간
		if($this->chk->hasText($row['ap_rsv_end'])){
			$row['ap_rsv_end_time'] = substr($row['ap_rsv_end'], 0, 2);
			$row['ap_rsv_end_minuet'] = substr($row['ap_rsv_end'], 2, 2);
		}else{
			$row['ap_rsv_end_time'] = false;
			$row['ap_rsv_end_minuet'] = false;
		}
	}
}

?>
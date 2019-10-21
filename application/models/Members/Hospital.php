<?
/*
* member Table과는 1:1 관계이며, 검진기관 번호는 중복되어 등록될 수 없다.
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital extends MY_Model{
	
	function __construct(){
		$this->_table = 'hospital_info';
		$this->_cols = array(
			'hi_seq'  => array(TYPE_INT, 11, ATTR_PK | ATTR_ID),
			'hi_meseq'  => array(TYPE_INT, 11, ATTR_NOTNULL),
			'hi_mng_name'  => array(TYPE_VARCHAR, 50, ATTR_NOTNULL, '담당자(관리자)'),
			'hi_open_name'  => array(TYPE_VARCHAR, 50, ATTR_NOTNULL, '검진기관명(오픈용)'),
			'hi_org_number'  => array(TYPE_VARCHAR, 50, ATTR_NOTNULL, '검진기관번호'),
			'hi_biz_number'  => array(TYPE_VARCHAR, 50, ATTR_NOTNULL, '사업자등록번호'),
			'hi_mng_phone'  => array(TYPE_VARCHAR, 20, ATTR_NOTNULL, '관리자전화번호'),
			'hi_mng_email'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL, '관리자 이메일'),
			'hi_revmng_phone'  => array(TYPE_VARCHAR, 20, ATTR_NOTNULL, '예약담당자 전화번호'),
			'hi_ctime'  => array(TYPE_INT, 11, ATTR_NOTNULL, '생성일'),
			'hi_active'  => array(TYPE_VARCHAR, 1, ATTR_NOTNULL, '승인여부'),
			'hi_type' => array(TYPE_VARCHAR, 6, ATTR_NONE, '병원구분'),
			'hi_system_phone' =>array(TYPE_VARCHAR, 20, ATTR_NONE, '할당전화번호'),
		);	
		
		parent::__construct();
	}

	function listAllByGrid($mg_grid, $accept_code = false){
		if(!$this->chk->hasText($mg_grid)) return false;
		$where = "mg_grid='{$mg_grid}'";
		if($this->chk->hasText($accept_code)) $where .= " and hi_active='{$accept_code}'";
		$sql = "select * from members left join member_groups on me_seq=mg_meseq left join hospital_info on me_seq=hi_meseq where {$where} order by hi_ctime asc";
		return parent::listAllBySql($sql);		
	}

	/*
	* 병원 회원 가입 승인 대기 인원
	*/
	function countWaitMember(){
		$sql = "select count(*) as cnt from {$this->_table} where hi_active = 'N'";
		$row = parent::rowBySql($sql);
		return intval($row['cnt']);
	}

	function insertArgs($args, $hi_meseq){
		$msg = false;
		if(!is_numeric($hi_meseq)) $msg =  'Member 기본키가 설정되지 않았습니다.';	
		if(!$msg && parent::exist(array('hi_meseq' => $hi_meseq))) $msg = '중복된 정보가 입력되었습니다.';
		if(!$msg){
			$args['hi_ctime'] = time();
			$msg = $this->checkInsertParam($args);
			if($msg) return $msg;
		}

		if(!$msg) parent::insert($args);		
		return $msg;	
	}

	function updateArgsByHiseq(&$args, $hi_seq, $check_org_number = true){
		$msg = false;
		if(!$hi_seq) $msg = 'has error : cannot be empty';			


		if(!$msg) $msg = $this->checkUpdateParam($args, $check_org_number);
		if(!$check_org_number) unset($args['hi_org_number']);

		if($msg) return $msg;

		$where = array('hi_seq' => $hi_seq);
		parent::update($args, $where);
		return false;
	}

	function insertArgsGetSeq($args, $hi_meseq){
		$msg = false;
		$args['hi_meseq'] = $hi_meseq;
		$msg = $this->insertArgs($args, $hi_meseq);
		if($msg) return false;

		$where = array('hi_meseq' => $hi_meseq);
		return parent::value('hi_seq', $where);				
	}

	function checkInsertParam(&$args){
		$msg = false;
		$msg = $this->checkUpdateParam($args);
		return $msg;
	}

	function checkUpdateParam(&$args, $check_org_number = true){
		$msg = false;
		if(!$this->chk->hasText($args['hi_mng_name'])) $msg = '담당자명은 반드시 입력하셔야 합니다.';
		else if(!$this->chk->hasText($args['hi_open_name'])) $msg = '검진기관명은 반드시 입력하셔야 합니다.';
		else if($check_org_number && !$this->chk->hasText($args['hi_org_number'])) $msg = '검진기관번호는 반드시 입력하셔야 합니다.';
		else if(!$this->chk->hasText($args['hi_biz_number'])) $msg = '사업자번호는 반드시 입력하셔야 합니다.';
		else if(!$this->chk->hasText($args['hi_mng_phone'])) $msg = '관리자 전화번호는 반드시 입력하셔야 합니다.';
		else if(!$this->chk->hasText($args['hi_mng_email'])) $msg = '관리자 이메일은 반드시 입력하셔야 합니다.';
		else if(!$this->chk->email($args['hi_mng_email'])) $msg = '이메일이 형식에 맞지 않습니다.';
		else if(!$this->chk->hasText($args['hi_revmng_phone'])) $msg = '예약담당자 전화번호는 반드시 입력하셔야 합니다.';
		return $msg;
	}

	function getFullInfoByMeseq($me_seq, $mg_grid, $accept_code = false){
		if(!is_numeric($me_seq) && !$this->chk->hasText($mg_grid) ) return false;

		$where = "me_seq={$me_seq} and mg_grid='{$mg_grid}'";		
		if($accept_code) $where .= " and hi_active='{$accept_code}'";

		$sql = "select * from members left join member_groups on me_seq=mg_meseq left join hospital_info on me_seq=hi_meseq left join agency_info on hi_org_number = ai_number where {$where}";
		$row = parent::rowBySql($sql);
		if($row['me_seq'] != $me_seq) return false;
		return $row;
	}

	function getAllInfoByNumberMeseq($hi_number, $hi_meseq){
		if(!$hi_number ||!is_numeric($hi_number) || !$hi_meseq || !is_numeric($hi_meseq)) return false;
		$sql = "select * from hospital_info left join agency_info on hi_org_number = ai_number left join agency_park on ai_seq = ap_aiseq left join agency_traffic on at_aiseq = ai_seq  where hi_org_number = {$hi_number} and hi_meseq ={$hi_meseq}";
		return parent::rowBySql($sql);
	}

	function getListWithFullInfoByHiname($hi_open_name, $is_active = true){
		if(!hasText_($hi_open_name)) return array();

		if($is_active){
			$wheres[] = "ei_status='doing'";
			$wheres[] = 'ei_end > '.time();
			$wheres[] = "hi_active = 'Y'";
		}
		$wheres[] = "hi_open_name like '%{$hi_open_name}%' ";
		$where = implode(' and ', $wheres);
		$table = 'hospital_info left join event_info on ei_hiseq = hi_seq left join agency_info on hi_org_number = ai_number';
		$sql = "select * from {$table} where {$where} order by binary(ei_name) asc";
		return parent::listAllBySql($sql);
	}

	function getInfoByMeseq($me_seq){
		if(!is_numeric($me_seq)) return array();

		$where = array('hi_meseq' => $me_seq, 'hi_active' => 'Y');
		return parent::row('*', $where);
	}
	


	function deleteByMeseq($me_seq){
		if(!is_numeric($me_seq)) return false;
		$where = array('hi_meseq' => $me_seq);
		return parent::delete($where);
	}

	function getSeqByMeseq($me_seq){
		if(!is_numeric($me_seq)) return false;
		$where = array('hi_meseq' => $me_seq);
		return parent::value('hi_seq', $where);
	}

	function getHospitalByNumbers($numbers){
		if(!$this->chk->isArray($numbers) || count($numbers) < 1) return false;
		
		$where = implode(', ', $numbers);
		$where = "hi_org_number in ( {$where} ) and hi_active='Y'";
		$list = parent::listAll('*', $where, false, FETCH_ASSOC, 'hi_org_number');
		return 	array_keys($list);	
	}

	function getHospitalByNumbersWithEvent($numbers){
		if(!$this->chk->isArray($numbers) || count($numbers) < 1) return false;
		$where = implode(', ', $numbers);
		$where = "hi_org_number in ( {$where} ) and hi_active='Y'";
		
		$ctime = time();
		$sub_select = "( select count(*) from event_info where ei_hiseq=hi_seq and ei_status='doing' and ( ei_end > {$ctime} or ei_auto_flag='Y')  ) as event_cnt, ( select count(*) from event_info where ei_hiseq=hi_seq and ei_status='doing' and ( ei_end > {$ctime} or ei_auto_flag='Y') and ei_event_type='hot') as hot_cnt";
		$sql = "select *, {$sub_select} from {$this->_table} where {$where}";
		return parent::listAllBySql($sql, 'hi_org_number');
	}

	function getRowByNumber($number){
		if(!is_numeric($number)) return false;
		$where = array('hi_org_number'=>$number);
		return parent::row('*', $where);
	}

	function getListByNumbers($numbers){
		if(!$this->chk->isArray($numbers) || count($numbers) < 1) return false;
		
		$where = implode(', ', $numbers);
		$where = "hi_org_number in ( {$where} )";
		$list = parent::listAll('*', $where, false, FETCH_ASSOC, 'hi_org_number');
		return $list;	
	}

	function getOrgNumberBySeq($hi_seq){
		if(!is_numeric($hi_seq)) return false;

		$where = array('hi_seq'=>$hi_seq);
		return parent::value('hi_org_number', $where);
	}

	function existActive($hi_org_number, $active = false){
		if(!is_numeric($hi_org_number)) return false;
		$wheres['hi_org_number'] = $hi_org_number;
		if($active) $wheres['hi_active'] = 'Y';
		return parent::exist($wheres);
	}

	function getRowBySeq($seq){
		if(!is_numeric($seq)) return array();
		$sql = "select * from hospital_info left join agency_info on ai_number = hi_org_number where hi_seq = {$seq}";
		return parent::rowBySql($sql);
	}



	function existActiveByMeseq($meseq){
		if(!is_numeric($meseq)) return false;
		$where = array('hi_meseq'=>$meseq, 'hi_active'=>'Y');
		$row = parent::row('*', $where);
		return parent::exist($where);
	}

	function searchByName($name){
		if(!$this->chk->hasText($name)) return array();
		$where = "hi_open_name like '%{$name}%'  and  hi_active='Y'";
		$order = 'binary(hi_open_name) asc';
		$sql = "select * from hospital_info left join agency_info on hi_org_number = ai_number where {$where} order by {$order}";
		return parent::listAllBySql($sql);
	}

	function getRandomRow($num = 10){
		$ctime = time();
		$where = "hi_active = 'Y' ";

		$sql = "select * from {$this->_table} left join agency_info on ai_number = hi_org_number where {$where} order by rand() limit {$num} ";
		return parent::listAllBySql($sql);
	}

	/*
	* 제휴체크
	*/
	function isMemberByAiseq($aiseq){
		if(!is_numeric($aiseq)) return false;
		$sql = "select * from hospital_info left join agency_info on hi_org_number = ai_number where ai_seq = {$aiseq} and hi_active='Y'";
		$row = parent::rowBySql($sql);
		if(is_array($row) && array_key_exists('hi_seq', $row) && is_numeric($row['hi_seq']) ) return $row['hi_seq'];
		else return false;
	}

	/*
	* 진행되고 있는 이벤트가 있는지 확인
	*/
	function hasEventByAiseq($aiseq){
		if(!is_numeric($aiseq)) return false;
		$this->load->model('Event/EventInfoModel', 'eventModel');
		$where = 'hi_org_number = ai_number';
		$sub_sql = $this->eventModel->getSubQueryForCountActiveEvent($where);

		$sql = "select ( {$sub_sql} ) as event_cnt from hospital_info left join agency_info on hi_org_number = ai_number where ai_seq = {$aiseq} and hi_active='Y'";
		$row = parent::rowBySql($sql);
		if($row['event_cnt'] > 0) return true;
		else return false;
	}

	function cancelSystemPhone($seq){
		if(!is_numeric($seq)) return false;
		$where = array('hi_seq'=>$seq);
		$args['hi_system_phone'] = '';
		return parent::update($args, $where);
	}

	function updatePhonebySeq($phone, $seq){
		if(!is_numeric($phone) || !is_numeric($seq)) return false;
		
		$where = array('hi_seq' => $seq);
		$args['hi_system_phone'] = $phone;
		return parent::update($args, $where);
	}
}
?>
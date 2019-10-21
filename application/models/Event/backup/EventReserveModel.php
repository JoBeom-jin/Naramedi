<?
defined('BASEPATH') OR exit('No direct script access allowed');
/*
create table event_reserve(
er_seq int unsigned primary key auto_increment,
er_mall char(6) not null,
er_method char(6) not null,
er_name varchar(100),
er_meid varchar(128),
er_phone varchar(50) not null,
er_eiseq int unsigned not null,
er_ainum int unsigned not null,
er_ctime int not null,
er_time char(6),
er_reserve_time int,
er_status char(6) not null,
index(er_eiseq, er_reserve_time, er_mall)
);

alter table event_reserve add er_account int unsigned default 0;
alter table event_reserve add er_mall_name varchar(128);
alter table event_reserve add er_check_time int;
alter table event_reserve add er_memo varchar(255);
ALTER TABLE `okmedi`.`event_reserve`     ADD COLUMN `er_hope_time` INT(11) NULL AFTER `er_time`;
*/


class EventReserveModel extends MY_Model{

	public $_mall_code = array();
	public $_status_code = array();
	public $_method_code = array();
	public $_time_code = array();
	public $error_message = false;

	function __construct(){
		$this->_table = 'event_reserve';
		$this->_cols = array(
			'er_seq'  => array(TYPE_INT, 20, ATTR_PK | ATTR_NOTNULL),
			'er_mall'  => array(TYPE_VARCHAR, 6, ATTR_NOTNULL, '몰 타입'),
			'er_mall_name' => array(TYPE_VARCHAR, 10, ATTR_NONE, '폐쇄몰일 경우 몰 이름'),
			'er_method'  => array(TYPE_VARCHAR, 11, ATTR_NONE, '온, 오프라인'),
			'er_name'  => array(TYPE_VARCHAR, 11, ATTR_NONE, '이름'),
			'er_meid'  => array(TYPE_VARCHAR, 1, ATTR_NOTNULL, '아이디'),
			'er_phone'  => array(TYPE_VARCHAR, 11, ATTR_NONE, '전화번호'),
			'er_eiseq'  => array(TYPE_INT, 1, ATTR_NONE, '이벤트 시퀀스'),
			'er_ainum' => array(TYPE_VARCHAR, 11, ATTR_NONE, '기관넘버'),
			'er_ctime' => array(TYPE_INT, 255, ATTR_NONE, '생성일'),
			'er_status' => array(TYPE_VARCHAR, 6, ATTR_NONE, '현재상태'),
			'er_time' => array(TYPE_VARCHAR, 255, ATTR_NONE, '연락가능 시간'),
			'er_hope_time' => array(TYPE_INT, 11, ATTR_NONE, '희망 검진 시간'),
			'er_reserve_time' => array(TYPE_INT, 11, ATTR_NOTNULL, '예약시간'),
			'er_account' => array(TYPE_INT, 11, ATTR_NONE, '예약시 금액'),
			'er_device' => array(TYPE_VARCHAR, 10, ATTR_NONE, 'PC, MOBILE'),
			'er_check_time' => array(TYPE_INT, 11, ATTR_NONE, '상태변경시간'),
			'er_memo' => array(TYPE_VARCHAR, 11, ATTR_NONE, '남기실 말'),
		);

		$this->_mall_code = array(
				'MLL001' => array(
					'name' => '오픈몰',
					'icon' => 'O',
					'color' => 'default',
				),
				'MLL002' => array(
					'name' => '폐쇄몰',
					'icon' => 'C',
					'color' => 'primary',
				),
			);

		$this->_status_code = array(
				'STS001' => array(
					'name' => '미접촉',
					'status' => '대기',
					'end_flag' => 'WAIT',	//'WAIT : 예약자', 'RESERVED : 예약 확정자, 'COMPLETET' : 누적 예약자
					'bg_color' => '#ffaaaa',
				),

				'STS002' => array(
					'name' => '부재중',
					'status' => '대기',
					'end_flag' => 'WAIT',
					'bg_color' => 'green',
				),

				'STS003' => array(
					'name' => '틀린번호',
					'status' => '대기',
					'end_flag' => 'COMPLETET',
					'bg_color' => 'black',
				),

				'STS004' => array(
					'name' => '미처리',
					'status' => '예약',
					'end_flag' => 'RESERVED',
					'bg_color' => '#ffaaaa',
				),

				'STS005' => array(
					'name' => '예약일변경',
					'status' => '예약',
					'end_flag' => 'RESERVED',
					'bg_color' => '#88ff88',
				),

				'STS006' => array(
					'name' => '수검완료',
					'status' => '예약',
					'end_flag' => 'COMPLETET',
					'bg_color' => 'blue',
				),

				'STS007' => array(
					'name' => '미수검',
					'status' => '예약',
					'end_flag' => 'COMPLETET',
					'bg_color' => 'black',
				),


				'STS008' => array(
					'name' => '사용자취소',
					'status' => '예약',
					'end_flag' => 'COMPLETET',
					'bg_color' => 'red',
				),
			);

			$this->_method_code = array(
				'MED001' => array(
					'name' => '온라인',
				),
				'MED002' => array(
					'name' => '전화'
				),

			);

			$this->_time_code = array(
				'TIM001' => array(
						'name' =>'언제나',
						'sub_name' => '언제나 가능',
				),
				'TIM002' => array(
						'name' =>'오전',
						'sub_name' => '오전에 가능',
				),
					'TIM003' => array(
						'name' =>'오후',
						'sub_name' => '오후에 가능',
				),

			);

		parent::__construct();
	}


	function insertArgs($args, $type='MLL001'){
		$this->checkInsertArgs($args);
		if($this->error_message) return false;

		$meid = false;
		if($this->auth->isLogin()) $meid = $this->auth->id();

		$shop_name = false;
		if(isset($args['shop_name']) && $args['shop_name']) $shop_name = $args['shop_name'];

		$device = 'PC';
		if(isset($args['er_device'])) $device = $args['er_device'];

		$args = array(
				'er_mall' => $type,
				'er_method' => 'MED001',
				'er_name' => $args['er_name'],
				'er_meid' => $meid,
				'er_phone' => $args['er_phone'],
				'er_eiseq' => $args['ei_seq'],
				'er_ainum' => $args['ai_number'],
				'er_ctime' => time(),
				'er_time' => $args['er_time'],
				'er_status' => 'STS001',
				'er_account' => $args['er_account'],
				'er_mall_name' => $shop_name,
				'er_memo' => $args['er_memo'],
				'er_device' => $device,
			);


		parent::insert($args);
		return true;
	}

	function insertArgsFromPhone($args, $type='MLL001'){
		$this->checkInsertArgs($args);
		if($this->error_message) return false;

		$device = 'PC';
		if(isset($args['er_device'])) $device = $args['er_device'];

		$ei_row = $this->eventModel->getRowBySeq($args['ei_seq']);

		$args = array(
				'er_mall' => $args['er_mall'],
				'er_method' => 'MED002',
				'er_name' => $args['er_name'],
				'er_phone' => $args['er_phone'],
				'er_eiseq' => $args['ei_seq'],
				'er_ainum' => $args['ai_number'],
				'er_ctime' => time(),
				'er_time' => $args['er_time'],
				'er_account' => $ei_row['ei_account'],
				'er_memo' => $args['er_memo'],
				'er_status' => 'STS001',
				'er_device' => $device,
			);


		parent::insert($args);
		return true;
	}

	function insertFromPhone($args){
		$args['er_mall'] = 'MLL001';
		$args['er_method'] = 'MED002';
		$args['er_ctime'] = time();
		$args['er_time'] = 'TIM001';
		$args['er_status'] = 'STS001';
		$args['er_check_time'] = time();

		if(!isset($args['er_device'])) $args['er_device'] = 'PC';



		parent::insert($args);
		return true;
	}

	function cancelFromPhone($args){

		$args['er_mall'] = 'MLL001';
		$args['er_method'] = 'MED002';
		$args['er_ctime'] = time();
		$args['er_time'] = 'TIM001';
		$args['er_status'] = 'STS008';
		$args['er_check_time'] = time();

		parent::insert($args);
		return true;
	}

	function checkInsertArgs(&$args){
		$this->error_message = false;

		if(!hasText_($args['er_name']))  $this->error_message = '이름은 반드시 입력하셔야 합니다.';
		else if(!hasText_($args['er_phone'])) $this->error_message = '휴대폰번호는 반드시 입력하셔야 합니다.';
		else if(!is_numeric($args['er_phone'])) $this->error_message = '휴대폰 번호는 숫자로 입력해 주세요.';
		else if(!hasText_($args['er_time'])) $this->error_message = '연락받을 시간을 선택해주세요.';
		else if(!is_numeric($args['ei_seq'])) $this->error_message = '이벤트가 존재하지 않습니다.';
		else if(!is_numeric($args['ai_number'])) $this->error_message = '이벤트가 존재하지 않습니다.';
	}

	function checkUpdateArgs(&$args){
		$this->error_message = false;

		if(!hasText_($args['er_status']) ) $this->error_message = '상태값을 선택해주세요.';
	}

	function modifyBySeq($args, $er_seq){
		if(!is_numeric($er_seq)){
			$this->error_message = '정상적인 접근이 아닙니다.';
			return false;
		}

		$this->checkUpdateArgs($args);
		if(hasText_($this->error_message)) return false;


		if(array_key_value('er_reserve_time', $args)){
			list($year, $month, $day) = explode('-', $args['er_reserve_time']);
			$args['er_reserve_time'] = mktime(0, 0, 0, $month, $day, $year);
		}else{
			unset($args['er_reserve_time']);
		}

		$where = array('er_seq' => $er_seq);
		parent::update($args, $where);
		return true;
	}

	function updateArgsFromPhoneBySeq($args, $er_seq){
		if(!is_numeric($er_seq)){
			$this->error_message = '정상적인 접근이 아닙니다.';
			return false;
		}

		$this->checkInsertArgs($args);
		if(hasText_($this->error_message)) return false;

		$ei_row = $this->eventModel->getRowBySeq($args['ei_seq']);

		$args = array(
				'er_mall' => $args['er_mall'],
				'er_name' => $args['er_name'],
				'er_phone' => $args['er_phone'],
				'er_eiseq' => $args['ei_seq'],
				'er_ainum' => $args['ai_number'],
				'er_time' => $args['er_time'],
				'er_account' => $ei_row['ei_account'],
				'er_memo' => $args['er_memo'],
			);

		$where = array('er_seq' => $er_seq);
		parent::update($args, $where);
		return true;
	}

	function getOpenMallCode(){
		return 'MLL001';
	}

	function getCloseMallCode(){
		return 'MLL002';
	}

	function addStatusFromList(&$list){
		if(!isArray_($list)) return false;

		$ctime = mktime(0, 0, 0, date('m'), date('d'), date('Y') );
		foreach($list as $k => $v){
			$list[$k]['status'] = $this->getStatustFromRow($v);
		}
	}

	function getStatustFromRow(&$row){

		$ctime = time();
		if($row['er_method'] == 'MED001'){				//온라인

				if($row['er_reserve_time'] && $row['er_status'] == 'STS005' && $row['er_reserve_time'] > $ctime){
					return '입력대기중';
				}else if($row['er_reserve_time'] && $row['er_status'] == 'STS005' && $row['er_reserve_time'] <= $ctime){
					return '입력요망';
				}

				return $this->_status_code[$row['er_status']]['name'];

			}else if($row['er_method'] == 'MED002'){		//전화예약

				if($row['er_status'] == 'STS001' && !$row['er_reserve_time']){
					return '미입력';
				}

				if($row['er_reserve_time'] && $row['er_status'] == 'STS005' && $row['er_reserve_time'] > $ctime){
					return '입력대기중';
				}else if($row['er_reserve_time'] && $row['er_status'] == 'STS005' && $row['er_reserve_time'] <= $ctime){
					return '입력요망';
				}
			}

	}



	function getRowBySeq($seq){
		if(!is_numeric($seq)) return false;

		$where = array('er_seq'=>$seq);

		return parent::row('*', $where);
	}

	function getRowBySeqWithEvent($seq){
		if(!is_numeric($seq)) return false;
		$sql = "select * from {$this->_table} left join event_info on ei_seq = er_eiseq where er_seq={$seq}";
		return parent::rowBySql($sql);
	}

	function getListByMeid($meid){
		$where = array('er_meid' => $meid);
		return parent::listAll('*', $where);
	}


	function didHeFished($meid, $ai_number){
		$where = array(
			'er_meid'  => $meid,
			'er_ainum' => $ai_number,
			'er_status' => 'STS006'
		);

		if(parent::count($where) > 0) return true;
		else return false;
	}

	function getCompleteCodes(){
		$codes = array();
		foreach($this->_status_code as $code => $v){
			if($v['end_flag'] == 'COMPLETET') $codes[] = $code;
		}

		return $codes;
	}


	function getWaitCodes(){
		$codes = array();
		foreach($this->_status_code as $code => $v){
			if($v['end_flag'] == 'WAIT') $codes[] = $code;
		}

		return $codes;
	}

	function getReservedCode(){
		$codes = array();
		foreach($this->_status_code as $code => $v){
			if($v['end_flag'] == 'RESERVED') $codes[] = $code;
		}

		return $codes;
	}

	function getListByReserveType($ai_number, $wait_codes){
		if(!isArray_($wait_codes) || !$ai_number) return array();


		$wheres = array();
		$wheres[] = "er_ainum={$ai_number}";
		$codes = array();
		foreach($wait_codes as $k => $v){
			$codes[] = "'{$v}'";
		}
		$wheres[] = 'er_status in ('.implode(',', $codes).')';
		$where = implode(' and ', $wheres);

		$join_table = "event_reserve left join event_info on ei_seq = er_eiseq";
		$order = 'er_reserve_time asc';

		$sql = "select * from {$join_table} where {$where} order by {$order}";

		return 	parent::listAllBySql($sql);
	}

	function setCancel($er_seq){
		if(!$er_seq) return false;
		$code = 'STS008';

		$this->_setStatus($er_seq, $code);
		return true;
	}

	function setWrongNumber($er_seq){
		if(!$er_seq) return false;
		$code = 'STS003';

		$this->_setStatus($er_seq, $code);
		return true;
	}

	function setNotAccept($er_seq){
		if(!$er_seq) return false;
		$code = 'STS002';

		$this->_setStatus($er_seq, $code);
		return true;
	}

	function setComplete($er_seq){
		if(!$er_seq) return false;
		$code = 'STS006';

		$this->_setStatus($er_seq, $code);
		return true;
	}

	function setReserved($er_seq, $date){
		if(!$er_seq || !$date) return false;
		$where = array('er_seq' => $er_seq);
		$args = array('er_status' => 'STS004', 'er_reserve_time'=>strTotime($date), 'er_check_time'=>time() );

		parent::update($args, $where);
		return true;
	}

	function changeReserved($er_seq, $date){
		if(!$er_seq || !$date) return false;
		$where = array('er_seq' => $er_seq);
		$args = array('er_status' => 'STS005', 'er_reserve_time'=>strTotime($date), 'er_check_time'=>time() );

		parent::update($args, $where);
		return true;
	}


	function getTodayNormalReserveNumber(){
		$start = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$end = mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))-1;

		$sql = "select count(*) as cnt from {$this->_table} where er_eiseq < 1 and er_ctime > {$start} and er_ctime < {$end}";
		$row = parent::rowBySql($sql);
		return intval($row['cnt']);
	}

	function getTodayEventReserveNumber(){
		$start = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$end = mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))-1;

		$sql = "select count(*) as cnt from {$this->_table} where er_eiseq > 0 and er_ctime > {$start} and er_ctime < {$end}";
		$row = parent::rowBySql($sql);
		return intval($row['cnt']);
	}

	function getTodayEventReserveNumberCloseMall($er_mall_name){
		$start = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$end = mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))-1;

		$sql = "select count(*) as cnt from {$this->_table} where er_eiseq > 0 and er_ctime > {$start} and er_ctime < {$end} and er_mall_name = '{$er_mall_name}'";
		$row = parent::rowBySql($sql);
		return intval($row['cnt']);
	}

	function getListTodayReserve(){
		$start = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$end = mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))-1;

		$sql = "select * from {$this->_table} left join agency_info on er_ainum = ai_number where  er_ctime > {$start} and er_ctime < {$end}";
		$list = parent::listAllBySql($sql);
		return $list;
	}

	function countTodayReserveByStatus($status=false, $ai_number=false){
		if(!is_numeric($ai_number)) return array();

		$start = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$end = mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))-1;

		$wheres = array();
		$wheres[] = "er_ainum = {$ai_number}";
		$wheres[] = "er_ctime > {$start}";
		$wheres[] = "er_ctime < {$end}";
		if(is_array($status) && count($status) > 0){
			$codes = array();
			foreach($status as $code){
				$codes[] = "'{$code}'";
			}

			$_temp_str = '('.implode(',', $status).')';
			$wheres[] = "er_status in {$_temp_str}";
		}

		$where_string = implode(' and ', $wheres);

		$sql = "select count(*) as cnt from {$this->_table} where  {$where_string} ";
		$row = parent::rowBySql($sql);
		return intval($row['cnt']);
	}

	function countReserveByStatus($status=false, $ai_number=false, $only_phone = false){
		if(!is_numeric($ai_number)) return array();
		$wheres = array();
		$wheres[] = "er_ainum = {$ai_number}";
		if(is_array($status) && count($status) > 0){
			$codes = array();
			foreach($status as $code){
				$codes[] = "'{$code}'";
			}

			$_temp_str = '('.implode(',', $codes).')';
			$wheres[] = "er_status in {$_temp_str}";
		}

		if($only_phone){
			$wheres[] = "er_method='MED002'";
		}

		$where_string = implode(' and ', $wheres);

		$sql = "select count(*) as cnt from {$this->_table} where  {$where_string} ";
		$row = parent::rowBySql($sql);
		return intval($row['cnt']);
	}

	function getCountByEiseqs($ei_seqs){
		if(!is_array($ei_seqs) || count($ei_seqs) < 1) return false;

		$where_string = '('.implode(',', $ei_seqs).')';

		$sql = "select count(*) as cnt, er_eiseq, er_seq from {$this->_table} where er_eiseq in {$where_string} group by er_eiseq";
		$list = parent::listAllBySql($sql, 'er_eiseq');
		return $list;
	}

	function getRowBySeqWithHospital($er_seq){
		if(!$er_seq) return false;
		$sql = "select * from {$this->_table} left join hospital_info on er_ainum = hi_org_number where er_seq = {$er_seq}";
		return parent::rowBySql($sql);
	}

	function deleteBySeq($seq){
		if(!is_numeric($seq)) return false;
		$where = array('er_seq'=>$seq);
		return parent::delete($where);
	}

	private function _setStatus($er_seq, $code){
		$where = array('er_seq' => $er_seq);
		$args = array('er_status' => $code, 'er_check_time'=>time() );

		parent::update($args, $where);
		return true;
	}

}
?>

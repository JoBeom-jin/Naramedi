<?
defined('BASEPATH') OR exit('No direct script access allowed');

/*
create table event_info (
ei_seq int not null primary key auto_increment,
ei_name varchar(255) not null,
ei_start int,
ei_end int,
ei_auto_flag char(1) not null default 'Y',
ei_account int unsigned default 0,
ei_closed_display_flag char(1) default 'Y',
ei_closed_discount int,
ei_ages varchar(255),
ei_types varchar(255),
ei_meid varchar(64) not null,
ei_cip varchar(30) not null,
ei_ctime int unsigned not null,
ei_hiseq int unsigned not null
);

alter table event_info add ei_status varchar(10) not null;

alter table event_info add ei_img_banner varchar(255) not null;
alter table event_info add ei_img_slider varchar(255) not null;
alter table event_info add ei_img_top varchar(255) not null;
alter table event_info add ei_img_bottom varchar(255) not null;
alter table event_info add ei_img_middle varchar(255) not null;

alter table event_info add ei_cash_openmall int;
alter table event_info add ei_cash_closemall int;
alter table event_info add ei_event_type varchar(10);

ALTER TABLE `okmedi`.`event_info`     ADD COLUMN `ei_category` INT(11) NULL AFTER `ei_seq`;
ALTER TABLE `okmedi`.`event_info`     ADD COLUMN `ei_category_sub` INT(11) NULL AFTER `ei_category`;
ALTER TABLE `okmedi`.`event_info`     ADD COLUMN `ei_explain` VARCHAR(200) NULL AFTER `ei_category_sub`;

alter table event_info add ei_img_banner2 varchar(255) not null;
alter table event_info add ei_img_middle2 varchar(255) not null;
alter table event_info add ei_img_middle3 varchar(255) not null;
alter table event_info add ei_img_middle4 varchar(255) not null;
alter table event_info add ei_img_middle5 varchar(255) not null;
alter table event_info add ei_img_middle6 varchar(255) not null;
alter table event_info add ei_img_middle7 varchar(255) not null;
alter table event_info add ei_img_middle8 varchar(255) not null;
alter table event_info add ei_img_middle9 varchar(255) not null;
alter table event_info add ei_img_middle10 varchar(255) not null;
alter table event_info add ei_closed_account int default null;
*/

class EventInfoModel extends MY_Model{

	public $error_message;

	private $_status;
	private $_upload_path = false;

	function __construct(){
		$this->_table = 'event_info';
		$this->_cols = array(
			'ei_seq'  => array(TYPE_INT, 20, ATTR_PK | ATTR_NOTNULL),
			'ei_category'  => array(TYPE_INT, 11, ATTR_NONE, '이벤트 카테고리'),
			'ei_category_sub'  => array(TYPE_INT, 11, ATTR_NONE, '이벤트 카테고리 세부'),
			'ei_explain'  => array(TYPE_VARCHAR, 200, ATTR_NOTNULL, '이벤트 설명'),
			'ei_name'  => array(TYPE_VARCHAR, 255, ATTR_NOTNULL, '이벤트 명'),
			'ei_start'  => array(TYPE_INT, 11, ATTR_NONE, '이벤트 시작일'),
			'ei_end'  => array(TYPE_INT, 11, ATTR_NONE, '이벤트 종료일'),
			'ei_auto_flag'  => array(TYPE_VARCHAR, 1, ATTR_NOTNULL, '자동 연장 여부'),
			'ei_account'  => array(TYPE_INT, 11, ATTR_NONE, '금액'),
			'ei_closed_display_flag'  => array(TYPE_VARCHAR, 1, ATTR_NONE, '폐쇄몰 여부'),
			'ei_closed_discount' => array(TYPE_INT, 11, ATTR_NONE, '폐쇄몰 할인율'),
			'ei_ages' => array(TYPE_VARCHAR, 255, ATTR_NONE, '해당 연령대'),
			'ei_types' => array(TYPE_VARCHAR, 255, ATTR_NONE, '검진 분류'),
			'ei_meid' => array(TYPE_VARCHAR, 64, ATTR_NOTNULL, '등록자 아이디'),
			'ei_cip' => array(TYPE_VARCHAR, 100, ATTR_NOTNULL, '등록자 아이피'),
			'ei_ctime' => array(TYPE_INT, 11, ATTR_NOTNULL, '등록일'),
			'ei_hiseq' => array(TYPE_INT, 11, ATTR_NOTNULL, '해당 병원'),
			'ei_status' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '이벤트 상태'),
			'ei_img_banner' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '이벤트 베너'),
			'ei_img_slider' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '슬라이드 배너'),
			'ei_img_top' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '상단 이미지'),
			'ei_img_middle' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '중단 이미지'),
			'ei_img_middle2' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '중단 이미지'),
			'ei_img_middle3' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '중단 이미지'),
			'ei_img_middle4' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '중단 이미지'),
			'ei_img_middle5' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '중단 이미지'),
			'ei_img_middle6' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '중단 이미지'),
			'ei_img_middle7' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '중단 이미지'),
			'ei_img_middle8' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '중단 이미지'),
			'ei_img_middle9' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '중단 이미지'),
			'ei_img_middle10' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '중단 이미지'),
			'ei_img_bottom' => array(TYPE_VARCHAR, 10, ATTR_NOTNULL, '하단 이미지'),
			'ei_cash_openmall' => array(TYPE_INT, 10, ATTR_NONE, '오픈몰 캐쉬'),
			'ei_cash_closemall' => array(TYPE_INT, 10, ATTR_NONE, '폐쇄몰 캐쉬'),
			'ei_event_type' => array(TYPE_VARCHAR, 10, ATTR_NONE, '이벤트 속성'),
			'ei_original_account' => array(TYPE_INT, 11, ATTR_NONE, '정상가격'),
			'ei_age_text' => array(TYPE_VARCHAR, 255, ATTR_NONE, '적정연령'),
			'ei_theme_text' => array(TYPE_VARCHAR, 255, ATTR_NONE, '테마'),
		);

		$this->error_message = false;
		$this->_status = array(
				'wait' => '대기중',
				'doging' => '진행중',
				'end' => '종료'
			);

		$this->_file_config = array(
			'upload_path' => $this->_site_config['dir']['upload'].DIRECTORY_SEPARATOR.'event_image',
			'allowed_types' => 'gif|jpg|png|jpeg',
			'max_size' => 3000,
			'max_width' => 0,
			'max_height' => 0,
			'max_filename' => 255,
			'encrypt_name' => true,
			'remove_spaces' => true,
		);

		parent::__construct();
		$this->checkEnd();
	}


	function countWaitEvent(){
		$sql = "select count(*) as cnt from {$this->_table} where ei_status='wait'";
		$row = parent::rowBySql($sql);
		return intval($row['cnt']);
	}

	function insertArgsByHiseq(&$args, $hi_seq){
		if(!is_numeric($hi_seq)){
			$this->error_message = '정상적인 접근이 아닙니다.';
			return false;
		}

		if(!$this->_checkInsertParam($args)) return false;

		$this->Form2DB($args);
		$args['ei_meid'] = $this->auth->id();
		$args['ei_cip'] = $_SERVER['REMOTE_ADDR'];
		$args['ei_ctime'] = time();
		$args['ei_hiseq'] = $hi_seq;
		$args['ei_status'] = 'wait';

		$this->uploadFile($args);


		parent::insert($args);
		$where = array(
				'ei_meid' => $args['ei_meid'],
				'ei_ctime' => $args['ei_ctime']
			);
		return parent::value('ei_seq', $where);
	}

	function updateArgs(&$args){
		if(!is_numeric($args['ei_seq'])){
			$this->error_message = '정상적인 접근이 아닙니다.';
			return false;
		}

		if(!$this->_checkUpdateParam($args)) return false;

		$this->Form2DB($args);
		$this->uploadFile($args);

//'ei_category'  => array(TYPE_INT, 11, ATTR_NONE, '이벤트 카테고리'),
//			'ei_category_sub'  => array(TYPE_INT, 11, ATTR_NONE, '이벤트 카테고리 세부'),
//			'ei_explain'  => array(TYPE_VARCHAR, 200, ATTR_NOTNULL, '이벤트 설명'),
		/*
		* 2018.09.18 by haram4004 ( ei_category, ei_category_sub, ei_explain )
		* 업데이트 되지 않는 오류 수정. 각 Int형 필드에 대한 Null 처리
		*/
		if(!is_numeric($args['ei_category'])) $args['ei_category'] = null;
		if(!is_numeric($args['ei_category_sub'])) $args['ei_category_sub'] = null;
		// 수정 완료

		if(!array_key_exists('ei_auto_flag', $args) || $args['ei_auto_flag'] != 'Y') $args['ei_auto_flag'] = 'N';

		$where = array('ei_seq' => $args['ei_seq']);
		parent::update($args, $where);

		return true;
	}

	function getRandomRow($row = '*', $num =10){
		$ctime = time();
		$wheres[] = "ei_status = 'doing'";
		$wheres[] = "ei_end > {$ctime}";
		$wheres[] = 'ei_img_slider is not null';
		$where = implode(' and ', $wheres);

		$sql = "select {$row} from {$this->_table} where {$where} order by rand() limit {$num}";
		return parent::listAllBySql($sql);
	}

	function getRandomRowWithHosinfo($row = '*', $num =10, $is_closed = false){
		$ctime = time();
		$wheres[] = "ei_status = 'doing'";
		$wheres[] = "ei_end > {$ctime}";
		$wheres[] = 'ei_img_slider is not null';
		if($is_closed){
			$wheres[] = "ei_closed_display_flag='Y'";
		}
		$where = implode(' and ', $wheres);

		$sql = "select {$row} from {$this->_table} left join hospital_info on hi_seq = ei_hiseq left join agency_info on ai_number = hi_org_number where {$where} order by rand() limit {$num}";
		return parent::listAllBySql($sql);
	}

	public function getStatus(){
		return $this->_status;
	}

	function acceptBySeq($ei_seq){
		if(!is_numeric($ei_seq)) return false;
		$where = array('ei_seq' => $ei_seq);
		$args = array('ei_status' => 'doing');
		parent::update($args, $where);
		return true;
	}

	function getRowBySeq($seq){
		if(!is_numeric($seq)) return parent::getEmptyRow();
		$where = array('ei_seq' => $seq);
		return parent::row('*', $where);
	}

	function getTotalActive(){
		$ctime = time();
		$wheres[] = "ei_status = 'doing'";
		$wheres[] = "ei_end > {$ctime}";
		$where = implode(' and ', $wheres);

		$sql = "select count(*) as num from {$this->_table} where {$where}";
		$result =  parent::rowBySql($sql);
		return $result['num'];
	}

	function getListWithFullInfoByEiname($ei_name, $is_active = true){
		if(!hasText_($ei_name)) return array();


		if($is_active){
			$wheres[] = "ei_status='doing'";
			$wheres[] = 'ei_end > '.time();
			$wheres[] = "hi_active = 'Y'";
		}
		$wheres[] = "ei_name like '%{$ei_name}%' ";
		$where = implode(' and ', $wheres);
		$table = 'event_info left join hospital_info on ei_hiseq = hi_seq left join agency_info on hi_org_number = ai_number';
		$sql = "select * from {$table} where {$where} order by binary(ei_name) asc";
		return parent::listAllBySql($sql);
	}


	function getFullInfoListBySeqs($seqs){
		if(!isArray_($seqs)) return false;

		$wheres[] = 'ei_seq in ('.implode(',', $seqs).')';
		$wheres[] = "ei_status='doing'";
		$wheres[] = 'ei_end > '.time();
		$wheres[] = "hi_active = 'Y'";

		$where = implode(' and ', $wheres);

		$table = 'event_info left join hospital_info on ei_hiseq = hi_seq left join agency_info on hi_org_number = ai_number';

		$sql = "select * from {$table} where {$where}";
		return parent::listAllBySql($sql);
	}

	function getFullInfoListTest($seqs){
		if(!isArray_($seqs)) return false;

		$wheres[] = 'ei_seq in ('.implode(',', $seqs).')';

		$where = implode(' and ', $wheres);

		$table = 'event_info left join hospital_info on ei_hiseq = hi_seq left join agency_info on hi_org_number = ai_number';

		$sql = "select * from {$table} where {$where}";
		return parent::listAllBySql($sql);
	}

	function getListBySearchName($name){
		if(!hasText_($name)) return array();

		$sql = "select ei_seq from {$this->_table} left join hospital_info on ei_hiseq = hi_seq where hi_open_name like '%{$name}%'";
		$list = parent::listAllBySql($sql, 'ei_seq');
		if(isArray_($list)) return array_keys($list);
		else return array();
	}


	function getListBySearchNumber($number){
		if(!hasText_($number)) return array();

		$sql = "select ei_seq from {$this->_table} left join hospital_info on ei_hiseq = hi_seq where hi_org_number like '%{$number}%'";
		$list = parent::listAllBySql($sql, 'ei_seq');
		if(isArray_($list)) return array_keys($list);
		else return array();
	}

	private function _checkInsertParam(&$args){
		$this->error_message = false;
		if(!$this->chk->hasText($args['ei_name'])) $this->error_message = '이벤트 명을 입력해주세요.';
		else if(!$this->chk->hasText($args['ei_start'])) $this->error_message = '이벤트 시작일을 선택해주세요.';
		else if(!$this->chk->hasText($args['ei_end'])) $this->error_message = '이벤트 종료일을 선택해주세요.';
		else if(!is_numeric($args['ei_account']) || $args['ei_account'] < 1) $this->error_message = '가격을 입력해주세요. 가격은 숫자만 입력할 수 있습니다.';
		else if(!is_numeric($args['ei_original_account']) || $args['ei_original_account'] < 1) $this->error_message = '정상 가격을 입력해주세요. 정상 가격 값은 숫자만 입력 가능합니다.';
		// else if($args['ei_closed_display_flag'] == 'Y' && ( !is_numeric($args['ei_closed_discount']) || $args['ei_closed_discount'] < 1) ) $this->error_message = '폐쇄몰 할인율을 입력해주세요. 할인율은 숫자만 입력하실 수 있습니다.';
		else if($args['ei_closed_display_flag'] == 'Y' && ( !is_numeric($args['ei_closed_discount']) || $args['ei_closed_discount'] < -1) ) $this->error_message = '폐쇄몰 할인율을 입력해주세요. 할인율은 숫자만 입력하실 수 있습니다.';

		if(!$this->error_message)	return true;
		else return false;
	}

	private function _checkUpdateParam(&$args){
		$this->error_message = false;
		$this->_checkInsertParam($args);

		if(!$this->error_message) return true;
		else return false;
	}


	function Form2DB(&$args){
		if($args['ei_start']) $args['ei_start'] = strtotime($args['ei_start']);
		if($args['ei_end']){
			list($y, $m, $d) = explode('-', $args['ei_end']);
			$args['ei_end'] = mktime(0, 0, 0, $m, $d+1, $y)-1;
		}

		if(!array_key_exists('ei_closed_discount', $args) || !$args['ei_closed_discount'] ) $args['ei_closed_discount']=0;
		if(!array_key_exists('ei_cash_openmall', $args) || !$args['ei_cash_openmall'] ) $args['ei_cash_openmall']=0;
		if(!array_key_exists('ei_cash_closemall', $args) || !$args['ei_cash_closemall'] ) $args['ei_cash_closemall']=0;

		if(!array_key_exists('ages', $args) ) $args['ei_ages'] = '';
		else $args['ei_ages'] = implode(',', $args['ages']);

		if(!array_key_exists('types', $args) ) $args['ei_types'] = '';
		else $args['ei_types'] = implode(',', $args['types']);

	}

	function DB2Form(&$args){
		if($args['ei_start']) $args['start'] = date('Y-m-d', $args['ei_start']);
		if($args['ei_end']) $args['end'] = date('Y-m-d', $args['ei_end']);
		if($args['ei_ages']) $args['ages'] = explode(',', $args['ei_ages']);
		else $args['ages'] = array();

		if($args['ei_types']) $args['types'] = explode(',', $args['ei_types']);
		else $args['types'] = array();
		if($args['ei_closed_display_flag'] != 'Y') $args['ei_closed_discount'] = 0;

		if($args['ei_img_banner']) $args['img_banner'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_banner']));

		if($args['ei_img_slider']) $args['img_slider'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_slider']));

		if($args['ei_img_top']) $args['img_top'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_top']));

		if($args['ei_img_bottom']) $args['img_bottom'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_bottom']));

		if($args['ei_img_middle']) $args['img_middle'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_middle']));
		if($args['ei_img_middle2']) $args['img_middle2'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_middle2']));
		if($args['ei_img_middle3']) $args['img_middle3'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_middle3']));
		if($args['ei_img_middle4']) $args['img_middle4'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_middle4']));
		if($args['ei_img_middle5']) $args['img_middle5'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_middle5']));
		if($args['ei_img_middle6']) $args['img_middle6'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_middle6']));
		if($args['ei_img_middle7']) $args['img_middle7'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_middle7']));
		if($args['ei_img_middle8']) $args['img_middle8'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_middle8']));
		if($args['ei_img_middle9']) $args['img_middle9'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_middle9']));
		if($args['ei_img_middle10']) $args['img_middle10'] = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($this->_site_config['dir']['root'], '', $args['ei_img_middle10']));
	}

	function uploadFile(&$args){
		$this->load->library('upload', $this->_file_config);

		if(is_array($_FILES) && count($_FILES) > 0){
			foreach($_FILES as $name => $f){
				if($f['error'] === 0){
					$this->upload->do_upload($name);
					$upload_info = $this->upload->data();
					$args[$name] = $upload_info['full_path'];
				}else{
					unset($args[$name]);
				}
			}
		}
	}

	function deleteFile($ei_seq, $type){
		$info = $this->getRowBySeq($ei_seq);
		if($info[$type] && is_file($info[$type])){
			@unlink($info[$type]);
		}

		$where = array('ei_seq' => $ei_seq);
		$args = array($type => '' );
		parent::update($args, $where);
	}

	function getEmptyRow(){
		$row = parent::getEmptyRow();
		$row['start'] = false;
		$row['end'] = false;
		$row['ages'] = array();
		$row['types'] = array();
		$row['codes'] = array();
		$row['img_banner'] = false;
		$row['img_slider'] = false;
		$row['img_top'] = false;
		$row['img_bottom'] = false;
		$row['img_middle'] = false;

		return $row;
	}

	function checkEnd(){
		$this->checkAutoFlag();
		$ctime = time();
		$where = "ei_end < {$ctime}";
		if(parent::exist($where)){
			$args['ei_status'] = 'end';
			parent::update($args, $where);
		}
	}

	function checkAutoFlag(){
		$ctime = time();
		$where = "ei_end < {$ctime} and ei_auto_flag = 'Y'";
		if(parent::exist($where)){
				$this_date = date('Y-m');
				$this_last_day =  date('t');
				$args['ei_start'] = strtotime($this_date.'-01 00:00:00');
				$args['ei_end'] = strtotime($this_date.'-'.$this_last_day.' 23:59:59');
				parent::update($args, $where);
		}
	}

	function getFullInfoByCiseq($seq){
		if(!is_numeric($seq)) return false;

		$sql = "select * from event_info left join hospital_info on hi_seq = ei_hiseq left join agency_info on ai_number = hi_org_number where ei_seq = {$seq} limit 1";
		return parent::rowBySql($sql);
	}

	function getListByEiseqs($ei_seqs){
		if(!isArray_($ei_seqs)) return false;
		$where = '('.implode(',', $ei_seqs).')';
		$sql = "select * from event_info where ei_seq in {$where}";
		return parent::listAllBySql($sql, 'ei_seq');
	}



	/*sql 선언*/
	function getSubQueryForCountActiveEvent($add_where = false){
		$ctime = time();
		$where = "ei_status='doing' and ( ei_end > {$ctime} || ei_auto_flag = 'Y') ";
		if($add_where) $where = $where.' and '.$add_where;
		$sql = "select count(*) from {$this->_table} where {$where} ";
		return $sql;
	}

}

?>

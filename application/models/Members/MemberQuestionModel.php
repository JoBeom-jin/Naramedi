<?
/*
create table member_question(
mq_seq int unsigned not null primary key auto_increment,
mq_type char(6) not null,
mq_name varchar(255) not null,
mq_email varchar(255) not null,
mq_text varchar(255) not null,
mq_ctime int not null,
mq_cip varchar(20) not null
);
alter table member_question add mq_status varchar(6);
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberQuestionModel extends MY_Model{

	public $error_message = false;
	public $types = array();
	private $_status_codes = array();
	
	function __construct(){
		$this->_table = 'member_question';
		$this->_cols = array(
			'mq_seq'  => array(TYPE_INT, 11, ATTR_PK | ATTR_ID),
			'mq_type'  => array(TYPE_VARCHAR, 11, ATTR_NOTNULL, '질문 타입'),
			'mq_name'  => array(TYPE_VARCHAR, 50, ATTR_NOTNULL, '질문자이름'),
			'mq_email'  => array(TYPE_VARCHAR, 50, ATTR_NOTNULL, '이메일'),
			'mq_text'  => array(TYPE_VARCHAR, 50, ATTR_NOTNULL, '문의내용'),
			'mq_ctime'  => array(TYPE_INT, 50, ATTR_NOTNULL, '등록일'),
			'mq_cip'  => array(TYPE_VARCHAR, 20, ATTR_NOTNULL, '사용자아이피'),
			'mq_status' =>array(TYPE_VARCHAR, 6, ATTR_NOTNULL, '현재처리상태'),
		);	
		
		parent::__construct();

		$this->types = array(
				'QST001' => '검진기관 제휴 문의',
				'QST002' => '단체 예약 문의',
				'QST003' => '해외 검진 문의',
			);

		$this->_status_codes = array(
				'QSA001' => '처리중',
				'QSA002' => '처리완료',			
			);
		
	}

	function insertArgs($args){
		$this->checkInsertParam($args);
		if($this->error_message) return false;

		$args['mq_ctime'] = time();
		$args['mq_cip'] = $_SERVER['REMOTE_ADDR'];
		$args['mq_text'] = strip_tags($args['mq_text']);	
		$args['mq_status'] = 'QSA001';
		parent::insert($args);

		return true;

	}

	function checkInsertParam(&$args){
		if(!hasText_($args['mq_type'])) $this->error_message = '문의내용을 선택해주세요.';
		else if(!hasText_($args['mq_name'])) $this->error_message = '이름/회사명을 입력해주세요.';
		else if(!hasText_($args['mq_email'])) $this->error_message = '이메일을 입력해주세요.';
		else if(!hasText_($args['mq_text'])) $this->error_message = '문의내용을 입력해주세요.';
	}

	function countTodayCount(){
//		list($year, $month, $day) = explode('-', date('Y-m-d'));
//		$start = mktime(0, 0, 0,$month, $day, $year);
//		$end =  mktime(0, 0, 0, $month, $day+1, $year)-1;
		
		$where = "mq_status='QSA001'";
		return parent::count($where);
	}

	function getStatusCodes(){
		return $this->_status_codes;
	}

	function setCompleteBySeq($seq){
		if(!is_numeric($seq)) return false;
		$where = array('mq_seq' => $seq);
		$args['mq_status'] = 'QSA002';
		return parent::update($args, $where);
	}

}

?>
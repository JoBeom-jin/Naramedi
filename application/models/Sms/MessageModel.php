<?
/*
Create Table Msg_Tran (
Msg_Id Int not null Auto_Increment,
Phone_No Varchar(32) not null,
Callback_No Varchar(32),
Status Int Default 0 not null,
Msg_Type Int not null,
Send_Time Datetime not null,
Save_Time Datetime not null,
Subject Varchar(40),
Message Varchar(2000),
Kakao_Ad_Flag Varchar(1),
Kakao_Nation_Code Varchar(5),
Kakao_Sender_Key Varchar(40),
Kakao_Template_Code Varchar(30),
Kakao_Timeout Int,
Kakao_Button Varchar(1000),
Kakao_ReSend Varchar(1),
Kakao_ReMessage Varchar(2000),
Kakao_ReType Int,
Kakao_Org_Id Int,
File_Count Int Default 0 not null,
File_Type1 Varchar(3),
File_Type2 Varchar(3),
File_Type3 Varchar(3),
File_Name1 Varchar(100),
File_Name2 Varchar(100),
File_Name3 Varchar(100),
Spam_Check Varchar(1) Default ‘N’ not null,
Deny_No Varchar(20),
Tran_time Datetime,
Tran_Id Varchar(30),
Result Int,
Telecom Varchar(3),
Delivery_Time Datetime,
Result_Time DateTime,
Primary key (Msg_Id),
Key ix_Msg_Tran_Sched (Status, Send_Time)
)Auto_Increment=1
*/

defined('BASEPATH') OR exit('No direct script access allowed');

/*
* SMS, 알림톡 발송 DB.
* DB에 값 입력시 java module이 지정된 시간마다 검사하여 Onshot 업체로 전송한다.
* 본 파일 최 하단에 사용방법 메뉴얼이 정리 되어있습니다.
*/

class MessageModel extends MY_Model{

	private $_msg_types = array();
	private $_callback = false;
	private $_template_code = array();
	private $_Kakao_Nation_Code = false;
	private $_Kakao_Sender_Key = false;

	public $_error_msg = false;

	function __construct(){
		$this->_table = 'Msg_Tran';
		$this->_cols = array(
			'Msg_Id'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'Phone_No'  => array(TYPE_VARCHAR, 32 , ATTR_NOTNULL, '수신번호'),
			'Callback_No'  => array(TYPE_VARCHAR, 32, ATTR_NONE, '발신번호'),
			'Status'  => array(TYPE_INT, 11, ATTR_NOTNULL, '상태값 ( 0 : 발송요청, 1 : 전송중, 2 : 전송됨. 결과대기, 3 : 결과수신'),
			'Msg_Type'  => array(TYPE_INT, 11, ATTR_NOTNULL, '메시지 타입(4:SMS, 6:LMS,MMS, 7:알림톡, 8:친구톡)'),
			'Send_Time'  => array(TYPE_DATETIME, 11, ATTR_NOTNULL, '전송시간'),
			'Save_Time'  => array(TYPE_DATETIME, 11, ATTR_NOTNULL, '저장시간'),
			'Subject'  => array(TYPE_VARCHAR, 40, ATTR_NONE, '메세지 제목(LMS, MMS에서 사용)'),
			'Message'  => array(TYPE_VARCHAR, 2000, ATTR_NONE, '메세지(SMS:90byte, LMS/MMS:2000byte, 카카오:1000자)'),
			'Kakao_Ad_Flag'  => array(TYPE_VARCHAR, 1, ATTR_NONE, '카카오 광고성 메시지 필수 표시사항 노출(Y/N)'),
			'Kakao_Nation_Code'  => array(TYPE_VARCHAR, 5, ATTR_NONE, '카카오 발신 국가코드'),
			'Kakao_Sender_Key'  => array(TYPE_VARCHAR, 40, ATTR_NONE, '카카오 발신 프로필 키'),
			'Kakao_Template_Code'  => array(TYPE_VARCHAR, 30, ATTR_NONE, '알림톡 발신 탬플릿 코드'),
			'Kakao_Timeout'  => array(TYPE_INT, 4, ATTR_NONE, '카카오 발신 타임아웃'),
			'Kakao_Button'  => array(TYPE_VARCHAR, 1000, ATTR_NONE, '카카오 버튼 메시지'),
			'Kakao_ReSend'  => array(TYPE_VARCHAR, 1, ATTR_NONE, '카카오 대체 발송(Y/N)'),
			'Kakao_ReMessage'  => array(TYPE_VARCHAR, 2000, ATTR_NONE, '카카오 대체 메세지'),
			'Kakao_ReType'  => array(TYPE_INT, 11, ATTR_NONE, '카카오 대체 메시지 타입'),
			'Kakao_Org_Id'  => array(TYPE_VARCHAR, 1, ATTR_NONE, '카카오 대체발송 일 때 원본 메시지 아이디'),
			'File_Count'  => array(TYPE_INT, 11, ATTR_NONE, '첨부파일 갯수'),
			'File_Type1'  => array(TYPE_VARCHAR, 3, ATTR_NONE, '파일타입'),
			'File_Type2'  => array(TYPE_VARCHAR, 3, ATTR_NONE, '파일타입'),
			'File_Type3'  => array(TYPE_VARCHAR, 3, ATTR_NONE, '파일타입'),
			'File_Name1'  => array(TYPE_VARCHAR, 100, ATTR_NONE, '첨부파일 명(절대경로)'),
			'File_Name2'  => array(TYPE_VARCHAR, 100, ATTR_NONE, '첨부파일 명(절대경로)'),
			'File_Name3'  => array(TYPE_VARCHAR, 100, ATTR_NONE, '첨부파일 명(절대경로)'),
			'Spam_Check'  => array(TYPE_VARCHAR, 1, ATTR_NONE, '스팸체크(Y/N)'),	//Msg_Spam 테이블에 전화번호를 발송하지 않음
			'Deny_No'  => array(TYPE_VARCHAR, 20, ATTR_NONE, '080번호'),	//환경설정(conf)파일에 개별 스팸 체크를 선택 했을 경우 해당 080번호와 전화번호가 일치 할 때만 차단되고 그룹 일 때는 080번호 상관없이 전화번호가 일치하면 차단된다.(이해못함)
			'Tran_time'  => array(TYPE_DATETIME, 11, ATTR_NONE, '발송시간'),
			'Tran_Id'  => array(TYPE_VARCHAR, 30, ATTR_NONE, '발송아이디'),
			'Result'  => array(TYPE_INT, 11, ATTR_NONE, '발송결과'),
			'Telecom'  => array(TYPE_VARCHAR, 3, ATTR_NONE, '이통사'),
			'Delivery_Time'  => array(TYPE_VARCHAR, 1, ATTR_NONE, '휴대폰에 도착 시간'),
			'Result_Time'  => array(TYPE_VARCHAR, 1, ATTR_NONE, '결과 수신 시간'),
		);
		
		$this->_msg_types = array(
			'SMS' => 4,
			'LMS' => 6,
			'MMS' => 6,
			'AlimTalk' => 7,
			'FriendTalk' => 8
		);

		$this->_callback = '15889419';

		$this->_templates = array(
			'questionUser' => array(
				'name' => '상담신청고객',
				'key' => 'ufit_2017102519243206094002441',
				'message' => "{name} 고객님의 상담신청이 접수되었습니다.\n신청하신 검진기관에서 연락을 드릴 예정입니다.\n혹시 장시간 연락이 오지 않을 경우\n고객센터 1588-9419 로 연락주시면 친절히 상담드리겠습니다.\n감사합니다.\n-오케이검진-",
			),

			'questionManager' => array(
				'name' => '상담병원담당자',
				'key' => 'ufit_2017102519252000042723436',
				'message' => "{name} 고객님({phone})의 상담신청이 접수되었습니다.\n- 오케이검진-",
			),

			'reserveOk' => array(
				'name' => '예약확정고객',
				'key' => 'ufit_2017102519265700039657437',
				'message' => "{name}고객님의 예약신청은 {reserve_date} {org_name} (으)로 등록되었습니다. 감사합니다.\n-오케이검진-",
			),

			'checkQuestion' => array(
				'name' => '중앙관리자의 병원발송',
				'key' => 'ufit_2017102519274206094303442',
				'message' => "{name} 고객님({question_date} 상담요청)의 처리가 지연되고 있습니다. 확인 요청드립니다.\n-오케이검진 관리자-",
			),
			
		);
		

		$this->_Kakao_Nation_Code = '82';
		$this->_Kakao_Sender_Key = '83fb14e5b22298d9648574e3cad3975dec9f25ae';


		parent::__construct();
	}

	/* sms 발송 */
	function sendSMS($args, $is_current = true){
		$this->_error_msg = false;
		$type_code = $this->_msg_types['SMS'];
		$args = $this->getDbArgsFromData($args);	

		$args['Callback_No'] = $this->_callback;
		$args['Msg_Type'] = $type_code;

		if(!array_key_exists('Phone_No', $args) || !$args['Phone_No']) $this->_error_msg = '핸드폰 번호 값이 비었습니다.';
		if(!array_key_exists('Message', $args) || !$args['Message']) $this->_error_msg = '전송할 내용이 없습니다.';

		if($is_current){
			$args['Save_Time'] = $args['Send_Time'] = 'SysDate()';			
		}else{		
			if(!array_key_exists('Send_Time', $args) || !$args['Send_Time']) $this->_error_msg = '발송시간이 명확하지 않습니다.';
			$args['Save_Time'] = $args['Send_Time'] ;
		}

		if($this->_error_msg) return false;
		parent::insert($args);
		return true;
	}

	/* 알림톡 발송 */
	function sendAlimTalk($phone_number, $msg, $code){
		$this->error_msg = false;
		if(!$code) show_error('템플릿 코드가 설정되지 않았습니다.');

		$args = array();

		$args['Phone_No'] = $phone_number;
		$args['Message'] = $msg;
		$args['Msg_Type'] = $this->_msg_types['AlimTalk'];
		$args['Callback_No'] = $this->_callback;
		$args['Kakao_Sender_Key'] = $this->_Kakao_Sender_Key;
		$args['Kakao_Template_Code'] = $code;
		$args['Kakao_Nation_Code'] = $this->_Kakao_Nation_Code;
		$args['Save_Time'] = $args['Send_Time'] = 'SysDate()';
		$args['Kakao_ReSend'] = 'Y';
		$args['Kakao_ReMessage'] = $msg;
		$args['Kakao_ReType'] = 4;
		
		if($this->_error_msg) return false;
		parent::insert($args);
		return true;		
	}

	/* 알림톡 발송 (상담신청 고객)*/
	function sendAlimTalk2QuestionUser($phone_number, $name){		
		$tpl_ = 'questionUser';

		$tpl_code = $this->_templates[$tpl_]['key'];

		$tpl_message = $this->_templates[$tpl_]['message'];		
		$msg = str_replace('{name}', $name, $tpl_message);

		$phone_number = preg_replace("/[^0-9]/", "",$phone_number);
		return $this->sendAlimTalk($phone_number, $msg, $tpl_code);
	}


	/* 알림톡 발송 (상담신청 고객)*/
	function sendAlimTalk2QuestionManager($phone_number, $user_name, $user_phone){		
		$tpl_ = 'questionManager';

		$tpl_code = $this->_templates[$tpl_]['key'];

		$tpl_message = $this->_templates[$tpl_]['message'];		
		$msg = str_replace('{name}', $user_name, $tpl_message);
		$msg = str_replace('{phone}', $user_phone, $msg);

		$phone_number = preg_replace("/[^0-9]/", "",$phone_number);
		return $this->sendAlimTalk($phone_number, $msg, $tpl_code);
	}

	/* 알림톡 발송 (예약 확정 고객)*/
	function sendAlimTalk2ReserveUser($phone_number, $user_name, $rsv_date, $h_name){
		$tpl_ = 'reserveOk';
		$tpl_code = $this->_templates[$tpl_]['key'];
		$tpl_message = $this->_templates[$tpl_]['message'];		

		$msg = str_replace('{name}', $user_name, $tpl_message);
		$msg = str_replace('{reserve_date}', $rsv_date, $msg);
		$msg = str_replace('{org_name}', $h_name, $msg);

		$phone_number = preg_replace("/[^0-9]/", "",$phone_number);
		return $this->sendAlimTalk($phone_number, $msg, $tpl_code);		
	}

	function sendAlimTalk2HospitalManager($phone_number, $user_name, $rqs_date){
		$tpl_ = 'checkQuestion';
		$tpl_code = $this->_templates[$tpl_]['key'];
		$tpl_message = $this->_templates[$tpl_]['message'];		

		$msg = str_replace('{name}', $user_name, $tpl_message);
		$msg = str_replace('{question_date}', $rqs_date, $msg);

		$phone_number = preg_replace("/[^0-9]/", "",$phone_number);
		return $this->sendAlimTalk($phone_number, $msg, $tpl_code);
	}



	







	/*
	* form 필드 네임과 DB row 네임을 매칭 
	*/
	private function getDbArgsFromData($data){
		$args = array();
		if(array_key_exists('phone', $data)) $args['Phone_No'] = preg_replace("/[^0-9]/", "",$data['phone']);
		if(array_key_exists('msg', $data)) $args['Message'] = $data['msg'];
		if(array_key_exists('ymd', $data) && array_key_exists('hour', $data) && array_key_exists('minuet', $data)){
			$args['Send_Time'] = $this->getSysDate($data['ymd'], $data['hour'], $data['minuet']);			
		}
	

		return $args;
	}

	/*
	* form에서 전달된 예약 시간 정보를 SysDate 형식에 맞도록 변경 (2017-10-13 10:34:52)
	*/
	private function getSysDate($ymd, $hour, $minuet){
		if(!$ymd || !is_numeric($hour) || !is_numeric($minuet)) return false;
		
		return $ymd.' '.str_pad($hour, 2, '0', STR_PAD_LEFT).':'.str_pad($minuet, 2, '0', STR_PAD_LEFT).':'.'00';
	}
	
}



/*
* 사용법
SMS 전송 시 필수 필드 : (Msg_Id, Status, Phone_No, Callback_No, Message, Msg_Type, Send_Time, Save_Time) : Msg_Id는 auto_increment, Status : 0
예약 발송시 : SendTime 설정. 즉시 전송시 Mysql은 SysDate() 함수 사용. (결과 : 2017-10-13 10:34:52) (SysDate, Getdate, Current)
*/

?>
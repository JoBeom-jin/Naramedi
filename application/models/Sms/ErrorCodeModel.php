<?
/*
Create Table Msg_ErrorCode (
Error_Code Int not null,
Error_Msg Varchar(100) not null,
Primary key (Error_Code)
)
성공일 경우 최종 착신망 : SKT, KTF, LGT
실패일 경우 : ETC
*/

defined('BASEPATH') OR exit('No direct script access allowed');

/*
* SMS, 알림톡 발송 에러 메세지 테이블
*/

class ErrorCodeModel extends MY_Model{

	function __construct(){
		$this->_table = 'Msg_ErrorCode';
		$this->_cols = array(
			'Error_Code'  => array(TYPE_INT, 11, ATTR_NOTNULL, '결과코드'),
			'Error_Msg'  => array(TYPE_VARCHAR, 32 , ATTR_NOTNULL, '결과메세지'),
		);
		
		parent::__construct();
	}	
}

?>
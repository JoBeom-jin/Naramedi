<?
/*
Create Table Msg_ChangePhone (
Phone_No Varchar(32) not null,
Change_No Varchar(32) not null,
Save_Time Datetime not null,
Primary key (Phone_No)
)
*/

defined('BASEPATH') OR exit('No direct script access allowed');

/*
* SMS, 알림톡 스팸 정보 테이블
*/

class ChangePhoneModel extends MY_Model{

	function __construct(){
		$this->_table = 'Msg_ChangePhone';
		$this->_cols = array(
			'Phone_No'  => array(TYPE_VARCHAR, 20, ATTR_NOTNULL, '발송 번호'),
			'Change_No'  => array(TYPE_VARCHAR, 32 , ATTR_NOTNULL, '번호이동된 번호'),
			'Save_Time'  => array(TYPE_DATETIME, 11, ATTR_NOTNULL, '수신시간'),			
		);
		
		parent::__construct();
	}	
}
?>
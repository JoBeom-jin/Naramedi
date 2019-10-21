<?
/*
Create Table Msg_Spam (
Deny_No Varchar(20) not null,
Phone_No Varchar(32) not null,
Save_Time DateTime not null,
Primary key (Deny_No, Phone_No)
)

*/

defined('BASEPATH') OR exit('No direct script access allowed');

/*
* SMS, 알림톡 스팸 정보 테이블
*/

class SpamModel extends MY_Model{

	function __construct(){
		$this->_table = 'Msg_Spam';
		$this->_cols = array(
			'Deny_No'  => array(TYPE_VARCHAR, 20, ATTR_NOTNULL, '080 번호'),
			'Phone_No'  => array(TYPE_VARCHAR, 32 , ATTR_NOTNULL, '스팸요청번호'),
			'Save_Time'  => array(TYPE_DATETIME, 11, ATTR_NOTNULL, '저장시간'),			
		);
		
		parent::__construct();
	}	
}

?>
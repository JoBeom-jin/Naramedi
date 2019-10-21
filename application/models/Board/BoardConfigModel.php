<?
/*
create table board_config(
bc_id varchar(16) not null primary key,
bc_name varchar(128) not null,
bc_skin1 varchar(64) not null,
bc_skin2 varchar(64) not null,
bc_file_cnt int not null default 3,
bc_link_cnt int not null default 0,
bc_access_list varchar(255),
bc_access_view varchar(255),
bc_access_insert varchar(255),
bc_access_modify varchar(255),
bc_access_delete varchar(255),
bc_access_comment varchar(255),
bc_lock_flag char(1) not null default 'N',
bc_ctime int not null
);

alter table board_config change  bc_editor_flag bc_editor_flag char(1) default 'N';
alter table board_config change bc_notice_flag bc_notice_flag char(1) default 'N';
alter table board_config change bc_reply_flag bc_reply_flag char(1) default 'N';
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class BoardConfigModel extends MY_Model{

	private $_default_skin_name = 'default';
	private $_lock_flags = array('N'=>'사용하지않음', 'Y'=>'사용함', 'A'=>'게시글 모두숨김 처리');
	private $_editor_flags = array('N'=>'사용하지 않음', 'Y' => '모두 사용함', 'M' => '관리자만 사용함');	

	public $message = false;


	function __construct(){
		$this->_table = 'board_config';
		$this->_cols = array(
			'bc_id'  => array(TYPE_VARCHAR, 16, ATTR_PK | ATTR_NOTNULL),
			'bc_name'  => array(TYPE_VARCHAR, 128, ATTR_NOTNULL),			
			'bc_skin1'  => array(TYPE_VARCHAR, 64, ATTR_NOTNULL),
			'bc_skin2'  => array(TYPE_VARCHAR, 64, ATTR_NOTNULL),
			'bc_file_cnt'  => array(TYPE_INT, 11, ATTR_NOTNULL),
			'bc_link_cnt' => array(TYPE_INT, 11, ATTR_NOTNULL),
			'bc_access_list' => array(TYPE_VARCHAR, 255, ATTR_NONE),
			'bc_access_view' => array(TYPE_VARCHAR, 255, ATTR_NONE),
			'bc_access_insert' => array(TYPE_VARCHAR, 255, ATTR_NONE),
			'bc_access_modify' => array(TYPE_VARCHAR, 255, ATTR_NONE),
			'bc_access_delete' => array(TYPE_VARCHAR, 255, ATTR_NONE),
			'bc_access_comment' => array(TYPE_VARCHAR, 255, ATTR_NONE),
			'bc_lock_flag' => array(TYPE_VARCHAR, 1, ATTR_NONE),
			'bc_editor_flag' => array(TYPE_VARCHAR, 1, ATTR_NONE),
			'bc_notice_flag' => array(TYPE_VARCHAR, 1, ATTR_NONE),
			'bc_reply_flag' => array(TYPE_VARCHAR, 1, ATTR_NONE),
			'bc_ctime' => array(TYPE_INT, 11, ATTR_NOTNULL),
		);
		
		parent::__construct();
	}

	/*
	* 게시판 최초 생성 : bc_id와 bc_name만으로 생성
	*/
	function insertInitArgs(&$args){
		$this->checkInsertParam($args);
		if($this->message) return false;

		$args['bc_skin1'] = $this->_default_skin_name;
		$args['bc_skin2'] = $this->_default_skin_name;
		$args['bc_file_cnt'] = 0;
		$args['bc_link_cnt'] = 0;
		$args['bc_ctime'] = time();		
		
		parent::insert($args);
		return true;
	}

	function modifyArgsBySeq($args, $id){
		$this->message = false;
		if(!$this->chk->hasText($id)){
			$this->message = '게시판 아이디가 설정되지 않았습니다.';
			return false;
		}

		if($this->chk->hasArrayValue('bc_id', $args)) unset($args['bc_id']);

		$this->_makeArgs($args);
		$this->checkUpdateParam($args);
		if($this->message) return false;	

		$where = array('bc_id' => $id);
		parent::update($args, $where);
		return true;
	}


	function checkUpdateParam(&$args){
		$this->message = false;
		
		if(!$this->chk->hasText($args['bc_name'])) $this->message = '게시판 이름은 반드시 입력하셔야 합니다.';		
		else if(strlen($args['bc_name']) > 64) $this->message = '게시판 이름이 너무 깁니다. 다시 시도해주세요.';				
		else if(!$this->chk->hasText($args['bc_skin1'])) $this->message = '기본스킨을 선택해 주세요.';
		else if(!$this->chk->hasText($args['bc_skin2'])) $this->message = '예비스킨을 선택해 주세요.';
		else if(!$this->chk->hasText($args['bc_access_delete'] ) ) $this->message = '글 삭제 권한 그룹은 반드시 1개 이상의 그룹이 선택되어야 합니다.';
	}

	function checkInsertParam(&$args){
		if(!$this->chk->hasText($args['bc_id'])) $this->message = '게시판 아이디는 반드시 입력하셔야 합니다.';
		else if(!ctype_alnum($args['bc_id']) || strlen($args['bc_id']) > 16) $this->message = '게시판 아이디는 숫자,영어만 사용할 수 있으며 16글자 이내여야합니다.';
		if(!$this->chk->hasText($args['bc_name'])) $this->message = '게시판 이름은 반드시 입력하셔야 합니다.';		
		else if(strlen($args['bc_name']) > 64) $this->message = '게시판 이름이 너무 깁니다. 다시 시도해주세요.';
		
		if(!$this->message){
			$where = array('bc_id' => $args['bc_id']);
			if(parent::exist($where)) $this->message = '이미 존재하는 게시판 아이디입니다.';
		}				
	}

	function getConfigById($id){
		if(!$this->chk->hasText($id)) return false;

		$where = array('bc_id' => $id);
		$row = parent::row('*', $where);
		$this->_setAccessListToArray($row);
		return $row;
	}

	function getLockFlags(){
		return $this->_lock_flags;
	}

	function getEditorFlags(){
		return $this->_editor_flags;
	}


	private function _makeArgs(&$args){
		$key_list = array('bc_access_list', 'bc_access_view', 'bc_access_insert', 'bc_access_modify', 'bc_access_delete', 'bc_access_comment');

		foreach($key_list as $name){			
			if(array_key_exists($name, $args) && is_array($args[$name])) $args[$name] = implode(',', $args[$name]);
			else $args[$name] = '';
		}
	}

	private function _setAccessListToArray(&$args){
		$key_list = array('bc_access_list', 'bc_access_view', 'bc_access_insert', 'bc_access_modify', 'bc_access_delete', 'bc_access_comment');

		foreach($key_list as $name){			
			if(array_key_exists($name, $args) && $this->chk->hasText($args[$name])) $args[$name] = explode(',', $args[$name]);
			else $args[$name] = array();
		}
	}
	

}

?>                                                                                   
<?
/*
* 코드 그룹 관리 테이블
create table code_group(
cg_code char(3) not null primary key default '',
cg_name varchar(100) default null,
cg_add1 varchar(100) default null,
cg_add2 varchar(100) default null,
cg_add3 varchar(100) default null,
cg_add4 varchar(100) default null,
cg_add5 varchar(100) default null
);
*/

class CodeGroupModel extends MY_Model{

	public $error_message = false;

	function __construct() {	
		$this->_table = 'code_group';
		$this->_cols = array(
			'cg_code'  => array(TYPE_VARCHAR, 3, ATTR_PK),
			'cg_name'  => array(TYPE_VARCHAR, 40, ATTR_NOTNULL, '코드 그룹명'),
			'cg_add1'  => array(TYPE_VARCHAR, 40, ATTR_NONE, '코드 추가 필드명1'),
			'cg_add2'  => array(TYPE_VARCHAR, 40, ATTR_NONE, '코드 추가 필드명2'),
			'cg_add3'  => array(TYPE_VARCHAR, 40, ATTR_NONE, '코드 추가 필드명3'),
			'cg_add4'  => array(TYPE_VARCHAR, 40, ATTR_NONE, '코드 추가 필드명4'),
			'cg_add5'  => array(TYPE_VARCHAR, 40, ATTR_NONE, '코드 추가 필드명5'),
		);

		parent::__construct();
	}

	/*
	* 코드 그룹 등록
	*/
	function insertArgs(&$args){
		if(!$this->checkInsertParam($args)) return false;


		parent::insert($args);
		return true;
	}

	/*
	* 신규 row 입력 전 검증
	*/
	function checkInsertParam(&$args){
		$this->error_message = false;
		if(!$this->checkUpdateParam($args)) return false;

		if(!$this->chk->hasText($args['cg_code'])) $this->error_message = '그룹코드는 반드시 입력하셔야 합니다.';
		else if(strlen($args['cg_code']) > 3) $this->error_message = '그룹코드는 3자로 이내로 입력하셔야 합니다.';
		else if(!ctype_alnum($args['cg_code'])) $this->error_message = '그룹코드는 영문 또는 숫자로 이루어져야 합니다.';
		else if($this->_isDuple($args['cg_code'])) $this->error_message ='이미 등록된 그룹코드입니다. 다른 그룹코드로 입력해주세요.';	

		if($this->error_message) return false;
		else return true;
	}


	/*
	* 기존 row 업데이트 전 검증
	*/
	function checkUpdateParam(&$args){
		$this->error_message = false;		
		if(!$this->chk->hasText($args['cg_name'])) $this->error_message = '그룹명은 반드시 입력하셔야 합니다.';

		if($this->error_message) return false;
		else return true;
	}

	/*
	* 그룹 코드가 중복되는지 검사
	* 중복되면 true, 최초이면 false를 리턴한다.
	*/
	function _isDuple($cg_code){
		if(!$this->chk->hasText($cg_code)) return true;
		
		$where = array('cg_code'=>$cg_code);
		return parent::exist($where);
	}


	/*
	* 코드 그룹 목록 
	*/
	function getListAll(){
		return parent::listAll('*', false, 'cg_name asc');
	}


	function insertCodeGroup(&$args){
		return parent::insert($args);
	}


	/*
	* 코드 그룹 정보
	*/
	function getGroupByCode($code){
		if(!$this->chk->hasText($code)) return false;
		return parent::row('*', array('cg_code'=>$code));
	}
	
	/*
	* 코드 그룹 수정
	*/
	function updateCodeGroupByCode(&$args, $cg_code){
		$this->error_message = false;
		if(!$this->chk->hasText($cg_code)){
			$this->error_message = '잘못된 접근 경로 입니다. cg_code is null.';
			return false;
		}
		if(!$this->checkUpdateParam($args)) return false;
		
		$where = array('cg_code'=>$cg_code);
		return parent::update($args, $where);
	}

	/*
	* 코드 그룹 삭제
	* 코드 유지를 위해 그룹이 삭제되어도 코드는 삭제되지 않도록 함.
	*/
	function deleteGroupByCode($cg_code){
		if(!$this->chk->hasText($cg_code)) return false;
		$where = array('cg_code'=>$cg_code);
		return parent::delete($where);		
	}
	

	


	

	

	


}
?>
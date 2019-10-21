<?
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthGroup extends MY_Model{

	function __construct(){
		$this->_table = 'groups';
		$this->_cols = array(
			'gr_id'  => array(TYPE_VARCHAR, 20, ATTR_PK | ATTR_NOTNULL),
			'gr_name'  => array(TYPE_VARCHAR, 100),
		);
		
		parent::__construct();
	}

	function insertArgs(&$args){
		$msg = $this->_checkParams($args);
		if($msg) return $msg;

		parent::insert($args);
		return false;
	}

	function deleteById($id){
		if(!$this->chk->hasText($id)) return false;
		$where = array('gr_id'=>$id);
		return parent::delete($where);
	}

	private function _checkParams(&$args){
		$msg = false;

		$where = array('gr_id' => $args['gr_id']);
		if(!$this->chk->hasText($args['gr_id'])) $msg = '아이디 값은 반드시 필요합니다.';
		else if(!$this->chk->hasText($args['gr_name'])) $msg = '그룹명은 반드시 필요합니다.';
		else if(!ctype_alnum($args['gr_id'])) $msg = '그룹아이디는 영문 혹은 숫자만 가능합니다.';
		else if(parent::count($where) > 0) $msg = '이미 등록된 그룹아이디입니다.';

		return $msg;
	}

	
}
?>
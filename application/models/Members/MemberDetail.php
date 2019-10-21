<?
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberDetail extends MY_Model{

	private $_gender = array();
	
	function __construct(){
		$this->_table = 'member_detail';
		$this->_cols = array(
			'md_seq'  => array(TYPE_INT, 11, ATTR_PK | ATTR_ID),
			'md_meseq'  => array(TYPE_INT, 11, ATTR_NOTNULL, 'member table 기본키'),
			'md_phone'  => array(TYPE_VARCHAR, 30, ATTR_NOTNULL, '전화번호'),
			'md_gender'  => array(TYPE_VARCHAR, 6, ATTR_NOTNULL, '성별'),
			'md_birth'  => array(TYPE_INT, 6, ATTR_NOTNULL, '생년월일'),
			'md_ctime'  => array(TYPE_INT, 11, ATTR_NOTNULL, '등록일'),
		);	
		
		parent::__construct();

		$this->_gender = array('MAN' => '남', 'WOMAN'=>'여');
				
	}

	function getGender(){
		return $this->_gender;
	}


	function updateDetail(&$args, $md_meseq){
		$msg = false;		

		if(!is_numeric($md_meseq)) $msg = '수정할 정보를 찾지 못하였습니다. [md_meseq]';
		else $msg = $this->checkUpdateParam($args);
		
		if($msg) return $msg;		

		$args['md_birth'] = mktime(0, 0, 0, $args['month'], $args['day'], $args['year']);
		
		$where = array('md_meseq'=>$md_meseq);

		if(parent::exist($where)){			
			parent::update($args, $where);
		}else{
			$args['md_meseq'] = $md_meseq;
			$args['md_ctime'] = time();
			parent::insert($args);
		}
		return $msg;
	}

	function checkUpdateParam(&$args){
		$msg = false;		
		if(!$msg) $msg = $this->checkInsertParam($args);

		return $msg;		
	}

	function checkInsertParam(&$args){
		$msg = false;
		if( !$this->chk->hasText($args['md_phone']) || !is_numeric($args['md_phone']) ) $msg ='전화번호를 입력해주세요.';
//		elseif( !$this->chk->phone($args['md_phone']) ) $msg = '전화번호가 형식에 맞지 않습니다.';
		elseif( !$this->chk->hasText($args['md_gender']) ) $msg= '성별을 선택해주세요.';
		return $msg;		
	}


	function getDetailByMeseq($me_seq){
		if(!is_numeric($me_seq)) return false;
		$where = array('md_meseq'=>$me_seq);
		$row = parent::row('*', $where);
		list($row['year'], $row['month'], $row['day']) = explode('-', date('Y-m-d', $row['md_birth'] ) );
		return $row;

	}

	function getEmptyRow(){
		$row = parent::getEmptyRow();
		$row['year'] = false;
		$row['month'] = false;
		$row['day'] = false;
		return $row;
	}

	function deleteByMeseq($md_meseq){
		if(!is_numeric($md_meseq)) return false;
		$where = array('md_meseq'=>$md_meseq);
		return parent::delete($where);
	}



}
?>
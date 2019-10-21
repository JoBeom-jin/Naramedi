<?
/*
create table board_reply(
br_seq int unsigned  not null primary key auto_increment,
br_bcid varchar(64) not null,
br_step int not null,
br_depth varchar(100) not null,
br_comment varchar(255) not null,
br_cid varchar(64) not null,
br_cname varchar(128) not null,
br_ctime int not null,
index(br_bcid, br_step, br_depth)
);
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class BoardReplyModel extends MY_Model{

	public $error_message = false;

	function __construct() {
		$this->_table = 'board_reply';
		$this->_cols = array(
			'br_seq'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'br_bcid' => array(TYPE_VARCHAR, 64, ATTR_NOTNULL),
			'br_step' => array(TYPE_INT, 11, ATTR_NOTNULL),
			'br_depth' => array(TYPE_VARCHAR, 100, ATTR_NOTNULL),
			'br_comment' => array(TYPE_VARCHAR, 255, ATTR_NOTNULL),
			'br_cid' => array(TYPE_VARCHAR, 64, ATTR_NOTNULL),
			'br_cname' => array(TYPE_VARCHAR, 128, ATTR_NOTNULL),
			'br_ctime' => array(TYPE_INT, 11, ATTR_NOTNULL)		
		);

		parent::__construct();
	}

	function insertArgsByBcid(&$args, $bcid){
		$args['br_bcid'] = $bcid;
		if(!$this->checkParam($args)) return false;		

		//대댓글 확인
		if(array_key_exists('pseq', $args) && is_numeric($args['pseq'])){
			$p_reply = $this->getRowBySeq($args['pseq']);
			if(!$p_reply || $p_reply['br_seq'] != $args['pseq']){
				$this->error_message = '상위 댓글을 찾을 수 없습니다.';
				return false;
			}
			
			$args['br_step'] = $p_reply['br_step'];
			$args['br_depth'] = $this->_getNextDepth($bcid, $p_reply);			
						
		}else{
			$step = parent::value('MAX(br_step)', array('br_bcid'=>$bcid) ) + 1;
			$args['br_step'] = $step;
			$args['br_depth'] = 'A';			
		}	

		$args['br_cid'] = $this->auth->id();
		$args['br_cname'] = $this->auth->name();
		$args['br_ctime'] = time();

		parent::insert($args);
		return true;

	}

	function getRowBySeq($br_seq){
		if(!is_numeric($br_seq)) return false;
		
		$where = array('br_seq'=>$br_seq);
		return parent::row('*', $where);
	}

	function checkParam(&$args){
		$this->error_message = false;

		if(!$this->chk->hasText($args['br_bcid'])) $this->error_message = '게시판을 찾을 수 없습니다.';
		else if(!$this->auth->isLogin())	$this->error_message = '댓글을 사용할 권한이 없습니다.';
		else if(!$this->chk->hasText($args['br_comment'])) $this->error_message = '댓글의 내용이 없습니다.';	
		

		if(!$this->error_message) return true;
		else return false;
	}

	function getListByBcid($bcid){
		if(!$this->chk->hasText($bcid)) return array();
		
		$where = array('br_bcid' => $bcid);
		$order = "br_step desc, br_depth asc, br_seq desc";
		return parent::listAll('*', $where, $order);
	}

	private function _getNextDepth($bcid, $p_row){
		$str_leng = strlen($p_row['br_depth']) + 1;
		$sql = "select br_depth from {$this->_table} where br_bcid='{$bcid}' and br_step={$p_row['br_step']} and br_depth like '{$p_row['br_depth']}%' and char_length(br_depth)  = {$str_leng} order by br_depth desc limit 1";
		$row = parent::rowBySql($sql);
		if(!$row['br_depth']) $char = 'A';
		else{
			$char = substr($row['br_depth'], $row['br_depth']-1, 1);
			++$char;		
		}

		return $p_row['br_depth'].$char;
	}
	
}

?>
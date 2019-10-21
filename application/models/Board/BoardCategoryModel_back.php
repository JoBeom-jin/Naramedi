<?
/*
create table board_category(
bdc_seq int unsigned not null primary key auto_increment,
bdc_name varchar(124) not null,
bdc_bcid varchar(16) not null,
bdc_depth varchar(3),
index(bdc_bcid(16))
);

alter table board_category add bdc_bdcseq int;
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class BoardCategoryModel extends MY_Model{

	public $message = false;

	function __construct(){
		$this->_table = 'board_category';
		$this->_cols = array(
			'bdc_seq'  => array(TYPE_INT, 16, ATTR_PK | ATTR_NOTNULL),
			'bdc_name'  => array(TYPE_VARCHAR, 128, ATTR_NOTNULL),			
			'bdc_bdcseq'  => array(TYPE_INT, 11, ATTR_NOTNULL),			
			'bdc_bcid'  => array(TYPE_VARCHAR, 64, ATTR_NOTNULL),
			'bdc_depth'  => array(TYPE_VARCHAR, 64, ATTR_NOTNULL),
		);
		
		parent::__construct();
	}

	function getListByBcid($bdc_bcid){
		if(!$this->chk->hasText($bdc_bcid)) return false;
		
		$where = array('bdc_bcid' => $bdc_bcid);
		$order = ' bdc_depth asc';
		return parent::listAll('*', $where, $order);
	}

	function getParentListByBcid($bdc_bcid){
		if(!$this->chk->hasText($bdc_bcid)) return false;
		
		$where = "bdc_bcid = '{$bdc_bcid}' and bdc_bdcseq is null";
		$order = ' bdc_depth asc';
		return parent::listAll('*', $where, $order);
	}

	function insertArgs($args){
		$this->checkInsertArgs($args);
		if($this->message) return false;
		
		$this->_setInsertNext($args);
		parent::insert($args);
		return true;
	}

	function checkInsertArgs(&$args){
		$this->message = false;
		if(!$this->chk->hasText($args['bdc_name'])) $this->message = '카테고리 이름은 반드시 입력하셔야 합니다.';
		if(!$this->chk->hasText($args['bdc_bcid'])) $this->message = '카테고리 DB 필수 입력요소가 비었습니다. 개발자에게 문의바랍니다.';	
		if(!$this->chk->hasText($args['parent'])) $this->message = '부모 카테고리가 설정되지 않았습니다.';
	}

	function getRowBySeq($seq){
		if(!is_numeric($seq)) return false;
		$where = array('bdc_seq' => $seq);
		return parent::row('*', $where);
	}

	function updateNameBySeq($bdc_name, $bdc_seq){
		$this->message = false;
		if(!$this->chk->hasText($bdc_name)) $this->message = '카테고리 이름은 반드시 입력하셔야 합니다.';
		else if(!is_numeric($bdc_seq)) $this->message = '올바르지 않은 접근입니다.';

		if($this->message) return false;

		$args = array('bdc_name' => $bdc_name);
		$where = array('bdc_seq' => $bdc_seq);
		parent::update($args, $where);
		
		return true;
	}

	function positionUp($bdc_bcid, $bdc_seq){
		if(!$this->chk->hasText($bdc_bcid) || !is_numeric($bdc_seq)){
			$this->message = '재정렬에 필요한 정보가 갖추어지지 않았습니다.';
			return false;
		}

		$current_row = $this->getRowBySeq($bdc_seq);
		if(!$this->_changePosition($current_row)) return false;

		return true;
	}

	function positionDown($bdc_bcid, $bdc_seq){
		if(!$this->chk->hasText($bdc_bcid) || !is_numeric($bdc_seq)){
			$this->message = '재정렬에 필요한 정보가 갖추어지지 않았습니다.';
			return false;
		}

		$current_row = $this->getRowBySeq($bdc_seq);
		if(!$this->_changePosition($current_row, 'next')) return false;

		return true;
	}


	private function _changePosition($crow, $op = 'prev'){
		$cdepth = $crow['bdc_depth'];
		if($op == 'prev'){
			$char = substr($cdepth, strlen($cdepth)-1, 1);	
			
			if($char == 'A') $this->message = '더이상 위로 올라갈 수 없습니다.';
			$char = chr(ord($char)-1);							


		}else if($op == 'next'){
			$char = substr($cdepth, strlen($cdepth)-1, 1);
			$last_row = $this->_getLastRow($crow['bdc_bcid'], $crow['bdc_bdcseq']);
			$last_char = substr($last_row['bdc_depth'], strlen($last_row['bdc_depth'])-1, 1);

			if($char == $last_char) $this->message = '더이상 아래로 내려갈 수 없습니다.';
			
			$char = chr(ord($char)+1);
		}		
		

		if(!$this->message){

			$wheres[] = "bdc_bcid='{$crow['bdc_bcid']}'";

			if(strlen($cdepth) < 1)	$wheres[] = "bdc_depth='{$char}'";
			else{
				$temp = substr($cdepth, 0, strlen($cdepth)-1).$char;
				$wheres[] = "bdc_depth='{$temp}'";
			}

			if($crow['bdc_bdcseq']) $where[] = "bdc_bdcseq ={$crow['bdc_bdcseq']}";
			else 'bdc_bdcseq is null';

			$where = implode(' and ' , $wheres);


			$target_row = parent::row('*', $where);
			$target_args = array( 'bdc_depth' => $crow['bdc_depth'] );
			$target_where = array( 'bdc_seq' => $target_row['bdc_seq'] );
			parent::update($target_args, $target_where);

			

			$c_args = array( 'bdc_depth' => $target_row['bdc_depth'] );
			$c_where = array( 'bdc_seq' => $crow['bdc_seq'] );
			parent::update($c_args, $c_where);				

			$childs = parent::listAll('*', array('bdc_bdcseq' => $crow['bdc_seq']));

			if($this->chk->isArray($childs)){
				foreach($childs as $k => $v){
					$where = array('bdc_seq' => $v['bdc_seq']);
					$char = $target_row['bdc_depth'].substr($v['bdc_depth'], strlen($target_row['bdc_depth']));
					$args = array('bdc_depth' => $char);
					parent::update($args, $where);						
				}
			}

			$target_childs = parent::listAll('*', array('bdc_bdcseq' => $target_row['bdc_seq']));

			if($this->chk->isArray($target_childs)){
				foreach($target_childs as $k => $v){
					$where = array('bdc_seq' => $v['bdc_seq']);
					$char = $crow['bdc_depth'].substr($v['bdc_depth'], strlen($crow['bdc_depth']));						
					$args = array('bdc_depth' => $char);
					parent::update($args, $where);						
				}					
			}

			return true;

		}
		else return false;		
	}

	function deleteBySeq($seq){
		$this->message = false;

		if(!is_numeric($seq)) return false;	

		$where = array('bdc_bdcseq' => $seq);
		if(parent::exist($where))$this->message = '자식 노드가 존재하는 정보는 삭제하실 수 없습니다.';

		$where = array('bdc_seq' => $seq);
		$crow = parent::row('*', $where);
		if(!$crow) $this->message = '삭제할 정보가 존재하지 않습니다.';

		if($this->message) return false;

		parent::delete($where);

		$wheres[] = "bdc_bcid='{$crow['bdc_bcid']}'";
		if(!$crow['bdc_bdcseq']) $wheres[] = " bdc_bdcseq is null";
		else $wheres[] = " bdc_bdcseq = {$crow['bdc_bdcseq']}";
		$order = 'bdc_depth asc';

		$where = implode(' and ', $wheres);
		$list = parent::listAll('*', $where, $order);		

		return true;		
	}

	private function _setInsertNext(&$args){
		$last_row = $this->_getLastRow($args['bdc_bcid'], $args['parent']);		

		if($args['parent'] == 'top'){

			if(!$last_row){
				$args['bdc_depth'] = 'A';
			}else{
				$depth = $last_row['bdc_depth'];	
				$depth_char = chr(ord($depth)+1);
				$args['bdc_depth'] = $depth_char;
			}
			
		}else{

			$parent = parent::row('*', array('bdc_seq'=>$args['parent']));	

			if(!$last_row){
				$args['bdc_depth'] = $parent['bdc_depth'].'A';
			}else{
				$depth = $last_row['bdc_depth'];
				$depth_char = substr($depth, strlen($depth)-1, 1);
				$depth_char = chr(ord($depth_char)+1);			
				$depth_char = substr($depth, 0, strlen($depth)-1).$depth_char;
				$args['bdc_depth'] = $depth_char;
			}
			$args['bdc_bdcseq'] = $parent['bdc_seq'];
		}	
	}


	private function _getLastRow($bdc_bcid, $parent = false){	
		
		if($parent == 'top' || !$parent){
			$where = "bdc_bcid='{$bdc_bcid}' and bdc_bdcseq is null "; 
			$sql = " select * from {$this->_table} where {$where} order by bdc_depth desc limit 1 ";
		}else{			
			$where = "bdc_bcid='{$bdc_bcid}' and bdc_bdcseq={$parent} "; 
			$sql = " select * from {$this->_table} where {$where} order by bdc_depth desc limit 1";
		}

		return parent::rowBySql($sql);
	}

}

?>
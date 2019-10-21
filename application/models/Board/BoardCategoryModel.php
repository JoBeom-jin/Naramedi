<?
/*
create table board_category2(
bdc_seq int unsigned not null primary key auto_increment,
bdc_name varchar(124) not null,
bdc_bcid varchar(16) not null,
bdc_sort int not null,
index(bdc_bcid(16))
);

alter table board_category add bdc_bdcseq int;
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class BoardCategoryModel extends MY_Model{

	public $message = false;

	function __construct(){
		$this->_table = 'board_category2';
		$this->_cols = array(
			'bdc_seq'  => array(TYPE_INT, 16, ATTR_PK | ATTR_NOTNULL),
			'bdc_name'  => array(TYPE_VARCHAR, 128, ATTR_NOTNULL),						
			'bdc_bcid'  => array(TYPE_VARCHAR, 64, ATTR_NOTNULL),
			'bdc_sort'  => array(TYPE_INT, 64, ATTR_NOTNULL),
		);
		
		parent::__construct();
	}

	function getListByBcid($bdc_bcid){
		if(!$this->chk->hasText($bdc_bcid)) return false;
		
		$where = array('bdc_bcid' => $bdc_bcid);
		$order = ' bdc_sort asc';
		return parent::listAll('*', $where, $order, FETCH_ASSOC, 'bdc_seq');
	}

	function getRowBySeq($seq){
		if(!is_numeric($seq)) return false;
		$where = array('bdc_seq' => $seq);
		return parent::row('*', $where);
	}

	function insertArgs($args){
		$this->checkInsertArgs($args);
		if($this->message) return false;
		
		$args['bdc_sort'] = $this->getNextBybcid($args['bdc_bcid']);
		parent::insert($args);
		return true;
	}

	function checkInsertArgs(&$args){
		$this->message = false;
		if(!$this->chk->hasText($args['bdc_name'])) $this->message = '카테고리 이름은 반드시 입력하셔야 합니다.';
		if(!$this->chk->hasText($args['bdc_bcid'])) $this->message = '카테고리 DB 필수 입력요소가 비었습니다. 개발자에게 문의바랍니다.';	
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
		if($current_row['bdc_sort'] == 1){
			$this->message = '더이상 위로 이동할 수 없습니다.';
			return false;
		}

		$prev_row = $this->_getPrevRow($current_row['bdc_bcid'], $current_row['bdc_sort']);	

		$this->_updateSortBySeq($prev_row['bdc_sort'], $current_row['bdc_seq']);
		$this->_updateSortBySeq($current_row['bdc_sort'], $prev_row['bdc_seq']);			

		return true;
	}

	function positionDown($bdc_bcid, $bdc_seq){
		if(!$this->chk->hasText($bdc_bcid) || !is_numeric($bdc_seq)){
			$this->message = '재정렬에 필요한 정보가 갖추어지지 않았습니다.';
			return false;
		}

		$current_row = $this->getRowBySeq($bdc_seq);
		$max = parent::maxValue('bdc_sort', array('bdc_bcid'=>$current_row['bdc_bcid']));

		if($current_row['bdc_sort'] == $max){
			$this->message = '더이상 아래로 이동할 수 없습니다.';
			return false;
		}

		$next_row = $this->_getNextRow($current_row['bdc_bcid'], $current_row['bdc_sort']);
		
		$this->_updateSortBySeq($next_row['bdc_sort'], $current_row['bdc_seq']);
		$this->_updateSortBySeq($current_row['bdc_sort'], $next_row['bdc_seq']);		
		
		return true;
	}

	function deleteBySeq($seq){
		$this->message = false;

		if(!is_numeric($seq)) return false;	

		$where = array('bdc_seq' => $seq);
		$crow = parent::row('*', $where);
		if(!$crow) $this->message = '삭제할 정보가 존재하지 않습니다.';
		if($this->message) return false;

		parent::delete($where);
		$this->_resetSorting($crow['bdc_bcid']);
				

		return true;		
	}

	private function _resetSorting($bdc_bcid){
		if(!$this->chk->hasText($bdc_bcid)) return false;
		
		$where = array('bdc_bcid' => $bdc_bcid);
		$list = parent::listAll('*', $where);

		$sort_num = 1;
		if($this->chk->isArray($list)){
			foreach($list as $k => $l){
				$where = array('bdc_seq'=>$l['bdc_seq']);
				$args = array('bdc_sort' => $sort_num);
				parent::update($args, $where);
				$sort_num++;
			}			
		}
	}

	private function _updateSortBySeq($sort, $seq){
		if(!is_numeric($sort) || !is_numeric($seq)) return false;
		$args= array('bdc_sort'=>$sort);
		$where = array('bdc_seq' => $seq);

		return parent::update($args, $where);
	}

	private function getNextBybcid($bcid){
		if(!$this->chk->hasText($bcid)) show_error('bcid can be empty! '.__FILE__.' : '.__LINE__);
		$where = array('bdc_bcid' => $bcid);
		return parent::nextValue('bdc_sort', $where);
	}

	private function _getPrevRow($bdc_bcid, $c_sort){
		$sort = $c_sort - 1;
		$where = array('bdc_bcid' => $bdc_bcid, 'bdc_sort'=> $sort);
		return parent::row('*', $where);	
	}

	private function _getNextRow($bdc_bcid, $c_sort){
		$sort = $c_sort + 1;
		$where = array('bdc_bcid' => $bdc_bcid, 'bdc_sort'=> $sort);
		return parent::row('*', $where);	
	}

}

?>
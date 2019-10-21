<?
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberGroup extends MY_Model{

	public $_search_option = array();

	function __construct(){
		$this->_table = 'member_groups';
		$this->_cols = array(
			'mg_grid'  => array(TYPE_VARCHAR, 20, ATTR_PK),
			'mg_meseq'  => array(TYPE_INT, 8, ATTR_PK),
		);
		$this->_search_option = array(
				'me_id' => '아이디',
				'me_name' => '이름',
				'md_phone' => '전화번호'
			);
		parent::__construct();
	}


	function listByMember($mg_meseq){
		if(!is_numeric($mg_meseq)) return false;
		$where = array('mg_meseq' => $mg_meseq);
		return parent::listAll('*', $where);
	}

	function listByGroup($mg_grid){
		$where = array('mg_grid' => $mg_grid);
		return parent::listAll('*', $where);
	}

	function groupArrayByMeseq($mg_meseq){
		if(!is_numeric($mg_meseq)) return false;
		$where = array('mg_meseq' => $mg_meseq);
		$list = parent::listAll('mg_grid', $where, false, FETCH_ASSOC, 'mg_grid');

		if(is_array($list) && count($list) > 0) return array_keys($list);
		else array();
	}

	function getIngroupByMeseq($mg_meseq){
		$list = $this->listByMember($mg_meseq);
		$groups = array();
		if($this->chk->isArray($list)){
			foreach($list as $gr) $groups[] = $gr['mg_grid'];
		}
		return $groups;
	}

	function insertGroup($meseq, $groups){
		if(!empty($groups) && $meseq){
			if($this->chk->isArray($groups)){
				foreach($groups as $v){
					$args['mg_grid'] = $v;
					$args['mg_meseq'] = $meseq;

					if(parent::count($args) < 1) parent::insert($args);
				}
			}
		}
	}

	function updateGroup($mg_meseq, $groups){
		$this->deleteByMember($mg_meseq);
		$this->insertGroup($mg_meseq, $groups);
	}

	function deleteByMember($mg_meseq) {
		if(!is_numeric($mg_meseq)) return false;
		return parent::delete(array('mg_meseq' => $mg_meseq));
	}

	function getListById($gr_id){
		if(!$this->chk->hasText($gr_id)) return false;

		$sql_string = "select * from members left join member_groups on mg_meseq=me_seq where mg_grid='{$gr_id}'";
		return parent::listAllBySql($sql_string);
	}

	function getMemberBySeqId($me_seq, $id){
		if(!is_numeric($me_seq) || !$this->chk->hasText($id)) return false;
		$where = " where mg_meseq={$me_seq} and mg_grid='{$id}'";
		$sql_string = "select * from members left join member_groups on mg_meseq=me_seq {$where}";
		return parent::rowBySql($sql_string);
	}
}
?>

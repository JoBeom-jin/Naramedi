<?
/*
create table board_link(
bl_seq int unsigned not null primary key auto_increment,
bl_bdseq int unsigned  not null,
bl_url varchar(255) not null
);
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class BoardLinkModel extends MY_Model{

	public $message = false;

	function __construct() {
		$this->_table = 'board_link';
		$this->_cols = array(
			'bl_seq'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'bl_bdseq' => array(TYPE_INT, 11, ATTR_NOTNULL),
			'bl_url' => array(TYPE_VARCHAR, 255, ATTR_NOTNULL),
		);

		parent::__construct();
	}
	
	function insertLink($links, $bl_bdseq){
		if(!is_array($links) || count($links) < 1 || !is_numeric($bl_bdseq)){
			$this->message = '시스템에 오류가 발생하였습니다.';
			return false;
		}

		$args = array(
				'bl_bdseq' => $bl_bdseq
			);	

		foreach($links as $k => $v){
			$url = str_replace('http://', '', $v);
			$args['bl_url'] = $url;
			parent::insert($args);
		}

		return true;		
	}

	function getLinksBySeq($bl_bdseq){
		if(!is_numeric($bl_bdseq)) return false;
		$where = array('bl_bdseq' => $bl_bdseq);
		return parent::listAll('*', $where);
	}

	function deleteBySeq($bl_seq){
		if(!is_numeric($bl_seq)) return false;

		$where = array('bl_seq' => $bl_seq);
		return parent::delete($where);

	}

	function deleteAllBySeq($bd_seq){
		if(!is_numeric($bd_seq)) return false;
		$where = array( 'bl_bdseq' => $bd_seq);
		return parent::delete($where);
	}
}

?>
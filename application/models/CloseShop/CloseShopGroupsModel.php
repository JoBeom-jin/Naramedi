<?
/*
CREATE TABLE `close_shop_groups` (
  `csg_csseq` int(11) DEFAULT NULL,
  `csg_meseq` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class CloseShopGroupsModel extends MY_Model{

	public $message = false;

	function __construct() {
		$this->_table = 'close_shop_groups';
		$this->_cols = array(
			'csg_csseq'  => array(TYPE_INT, 11, ATTR_NOTNULL, 'closeShop seq'),
			'csg_meseq' => array(TYPE_INT, 255, ATTR_NOTNULL, 'member seq'),
		);

		parent::__construct();
	}

	function listByCsseq($csg_csseq){
		if(!is_numeric($csg_csseq)) return false;
		$where = array('csg_csseq' => $csg_csseq);
		return parent::listAll('*', $where);
	}

	function listByMeseq($csg_meseq){
		if(!is_numeric($csg_meseq)) return false;
		$where = array('csg_meseq' => $csg_meseq);
		return parent::listAll('*', $where);
	}

	function updateGroup($csg_csseq, $groups){
		$this->deleteByCsseq($csg_csseq);
		$this->insertGroup($csg_csseq, $groups);
	}

	function insertGroup($csg_csseq, $groups){
		if(!empty($groups) && $csg_csseq){
			if($this->chk->isArray($groups)){
				foreach($groups as $v){
					$args['csg_meseq'] = $v;
					$args['csg_csseq'] = $csg_csseq;

					if(parent::count($args) < 1) parent::insert($args);
				}
			}
		}
	}

	function deleteByCsseq($csg_csseq){
		if(!is_numeric($csg_csseq)) return false;

		$where = array('csg_csseq' => $csg_csseq);
		$row = parent::row('*', $where);

		parent::delete($where);
		return true;
	}

	// function getRowBySeq($seq){
	// 	if(!is_numeric($seq)) return false;
	// 	$where =array('cs_seq' => $seq);
	// 	return parent::row('*', $where);
	// }


}

?>

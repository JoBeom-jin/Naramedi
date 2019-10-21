<?
defined('BASEPATH') OR exit('No direct script access allowed');

/*
create table agency_comment(
ac_seq int unsigned not null primary key auto_increment,
ac_aiseq int unsigned not null,
ac_meseq int unsigned not null,
ac_comment varchar(255),
ac_jin int unsigned,
ac_kind int unsigned,
ac_obj int unsigned,
ac_ctime int not null,
index(ac_aiseq, ac_meseq)
);
*/

class UserReplyModel extends MY_Model{

	public $error_message;

	function __construct(){
		$this->_table = 'agency_comment';
		$this->_cols = array(
			'ac_seq'  => array(TYPE_INT, 20, ATTR_PK | ATTR_NOTNULL),
			'ac_aiseq'  => array(TYPE_INT, 11, ATTR_NOTNULL, 'agency info'),
			'ac_meseq'  => array(TYPE_INT, 11, ATTR_NONE, 'member seq'),
			'ac_comment'  => array(TYPE_VARCHAR, 11, ATTR_NONE, '코멘트'),
			'ac_jin'  => array(TYPE_INT, 1, ATTR_NONE, '진료 만족도'),
			'ac_kind'  => array(TYPE_INT, 11, ATTR_NONE, '기관친절도'),
			'ac_obj'  => array(TYPE_INT, 1, ATTR_NONE, '시설만족도'),
			'ac_ctime' => array(TYPE_INT, 11, ATTR_NONE, '생성시간'),								
		);

		$this->error_message = false;

		parent::__construct();	
	}

	function modifyBySeq($args, $seq){
		if(!$args || !is_numeric($seq)) return false;

		if(isset($args['ac_jin'])){
			if(!is_numeric($args['ac_jin'])) $args['ac_jin'] = 0;
			else if($args['ac_jin'] > 5) $args['ac_jin'] = 5;
		}

		if(isset($args['ac_kind'])){
			if(!is_numeric($args['ac_kind'])) $args['ac_kind'] = 0;
			else if($args['ac_kind'] > 5) $args['ac_kind'] = 5;
		}
		if(isset($args['ac_obj'])){
			if(!is_numeric($args['ac_obj'])) $args['ac_obj'] = 0;
			else if($args['ac_obj'] > 5) $args['ac_obj'] = 5;
		}

		$where = array('ac_seq' => $seq);
		return parent::update($args, $where);
	}

	function getListByMeseq($acmeseq){
		if(!is_numeric($acmeseq)) return array();
		$where = "ac_meseq = {$acmeseq}";
		$order = 'ac_seq desc';

		$sql = "select * from agency_comment left join agency_info on ai_seq = ac_aiseq where {$where} order by {$order}";

		return parent::listAllBySql($sql);
	}

	function canStar($ai_number){
		if(!$this->auth->isLogin()) return false;
		$meid = $this->auth->id();
		$this->load->model('Event/EventReserveModel', 'reserveModel');
		
		
		return $this->reserveModel->didHeFished($meid, $ai_number);
	}

	function insertArgs($args, $meseq){
		if(!$this->auth->isLogin()) return false;

		$args['ac_meseq'] = $meseq;
		$args['ac_ctime'] = time();

		$where = array(
			'ac_aiseq' => $args['ac_aiseq'],
			'ac_meseq' => $meseq
		);

		$row = parent::row('*', $where);
		if(!$row){
			parent::insert($args);
		}else{
			$where = array('ac_seq' => $row['ac_seq']);
			parent::update($args, $where);
		}
	}

	function getTotalByAiseq($ai_seq){
		$where = "ac_aiseq={$ai_seq} and ac_jin > 0 and ac_kind > 0 and ac_obj > 0 ";
		$sql = "select avg(ac_jin) as avg_jin, avg(ac_kind) as avg_kind, avg(ac_obj) as avg_obj from {$this->_table} where {$where} group by ac_aiseq";
		$row = parent::rowBySql($sql);		

		if($row){
			$row['avg_jin'] = round($row['avg_jin'], 2);
			$row['avg_kind'] = round($row['avg_kind'], 2);
			$row['avg_obj'] = round($row['avg_obj'], 2);
			$row['total'] = ($row['avg_jin']+$row['avg_kind']+$row['avg_obj'])/3;
			$row['total'] = round($row['total'], 2);
		}else{
			$row['avg_jin'] = 0;
			$row['avg_kind'] = 0;
			$row['avg_obj'] = 0;
			$row['total'] = 0;
		}

		return $row;
	}

	function deleteBySeq($seq){
		if(!$seq) return false;
		$where = array('ac_seq' => $seq);
		return parent::delete($where);
	}

	function getListByAiseq($aiseq){
		if(!is_numeric($aiseq)) return array();

		$sql = "select * from {$this->_table} left join members on ac_meseq = me_seq where ac_aiseq = {$aiseq} order by ac_seq desc";

		return parent::listAllBySql($sql);
	}

	function getRowWithAgencyBySeq($acseq, $ac_meseq){
		if(!is_numeric($acseq) || !is_numeric($ac_meseq)) return false;
		$sql = "select * from {$this->_table} left join agency_info on ai_seq = ac_aiseq where ac_seq={$acseq} and ac_meseq={$ac_meseq}";	
		return parent::rowBySql($sql);
	}

	function rowWithAgencyBySeq($seq){
		if(!is_numeric($seq)) return false;
		$sql = "select * from {$this->_table} left join agency_info on ai_seq = ac_aiseq left join members on me_seq = ac_meseq where ac_seq={$seq}";	
		return parent::rowBySql($sql);
	}

}

?>
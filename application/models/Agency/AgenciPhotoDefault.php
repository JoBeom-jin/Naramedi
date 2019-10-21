<?
defined('BASEPATH') OR exit('No direct script access allowed');
/*


create table agency_photo_default(
apd_seq int unsigned not null primary key auto_increment,
apd_source varchar(255) not null,
apd_dir varchar(255) not null,
apd_exists char(1) not null
);

alter table agency_photo_default add apd_source_add varchar(255);		//사진 변경. 폴더
alter table agency_photo_default add apd_add_flag char(1) default 'N';				//사진 플래그
alter table agency_photo_default add apd_dir_exists char(1) default 'N';		//사진 존재여부
alter table agency_photo_default add apd_ai_exists char(1) default 'N';		// agency_info 기관 정보의 존재유무
alter table agency_photo_default add apd_ai_seq int;		// agency_info 기관 정보의 존재유무
*/

class AgenciPhotoDefault extends MY_Model{

	function __construct(){
		$this->_table = 'agency_photo_default';
		$this->_cols = array(
			'apd_seq'  => array(TYPE_INT, 20, ATTR_PK | ATTR_NOTNULL),
			'apd_source'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL),
			'apd_target'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL),
			'apd_dir'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL),
			'apd_exists'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL),			
			'apd_addr'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL),			
			'apd_aiseq'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL),			
			'apd_source_add'  => array(TYPE_VARCHAR, 255, ATTR_NOTNULL),			
			'apd_add_flag'  => array(TYPE_VARCHAR, 1, ATTR_NOTNULL),			
			'apd_dir_exists'  => array(TYPE_VARCHAR, 1, ATTR_NOTNULL),			
			'apd_ai_exists'  => array(TYPE_VARCHAR, 1, ATTR_NOTNULL),						
		);
		
		parent::__construct();
	}	
	
	function insertDefault($args){
		parent::insert($args);
	}

	function getDir($name){
		$where = array('apd_source' => $name);
		return parent::value('apd_target', $where);
	}

	function rowBySeq($seq){
		if(!is_numeric($seq)) return false;
		$where = array('apd_seq' => $seq);
		return parent::row('*', $where);
	}

	function rowWithAgencyBySeq($seq){
		if(!is_numeric($seq)) return false;
		$sql = "select * from agency_photo_default left join agency_info on ai_seq = apd_aiseq where apd_seq={$seq}";
		return parent::rowBySql($sql);
	}

	function photoModel($args, $seq){
		if(!is_numeric($seq)) return false;
		$where = array('apd_seq' => $seq);
		return parent::update($args, $where);
	}

	function truncate(){
		$sql = 'truncate table agency_photo_default';
		return parent::listAllBySql($sql);
	}

	/* 이전 가능한 목록 얻기*/
	function getMoveList(){
		$where = array(
				'apd_dir_exists' => 'Y',
				'apd_ai_exists' => 'Y',				
				'apd_add_flag' => 'N',
			);

		return parent::listAll('*', $where);
	}

	/*파일 이전에 성공한 데이터 체크*/
	function checkMoveImageOkBySeq($apd_seq){
		if(!is_numeric($apd_seq)) return false;
		$args['apd_add_flag'] = 'Y';
		$where = array('apd_seq' => $apd_seq);
		return parent::update($args, $where);
	}
}

?>
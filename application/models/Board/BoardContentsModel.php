<?
/*
create table board(
bd_seq int unsigned not null primary key auto_increment,
bd_bcid varchar(16) not null,
bd_step int not null,
bd_bdcseq int,
bd_thread varchar(20) not null,
bd_id varchar(16),
bd_pass varchar(128),
bd_name varchar(64),
bd_subject varchar(255) not null,
bd_content text not null,
bd_notice_flag char(1) not null,
bd_lock_flag char(1) not null,
bd_html_flag char(1) not null,
bd_display_flag char(1) not null,
bd_view_cnt int,
bd_create_ip varchar(20),
bd_ctime int not null
);
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class BoardContentsModel extends MY_Model{

	public $message = false;

	function __construct(){
		$this->_table = 'board';
		$this->_cols = array(
			'bd_seq'  => array(TYPE_INT, 11, ATTR_PK | ATTR_NOTNULL),
			'bd_bcid' => array(TYPE_VARCHAR, 16, ATTR_NOTNULL),
			'bd_step' => array(TYPE_INT, 11, ATTR_NOTNULL),
			'bd_bdcseq' => array(TYPE_INT, 11),
			'bd_thread' => array(TYPE_VARCHAR, 20, ATTR_NOTNULL),
			'bd_id' => array(TYPE_VARCHAR, 16),
			'bd_pass' => array(TYPE_VARCHAR, 64),
			'bd_name' => array(TYPE_VARCHAR, 64),
			'bd_subject' => array(TYPE_VARCHAR, 255),			
			'bd_content' => array(TYPE_TEXT, 2000, ATTR_EDITOR),			
			'bd_notice_flag' => array(TYPE_VARCHAR, 1, ATTR_NOTNULL),
			'bd_lock_flag' => array(TYPE_VARCHAR, 1, ATTR_NOTNULL),			
			'bd_view_cnt' => array(TYPE_INT, 11),
			'bd_ctime' => array(TYPE_INT, 11),
			'bd_display_flag' => array(TYPE_VARCHAR, 1, ATTR_NOTNULL),
			'bd_html_flag' => array(TYPE_VARCHAR, 1, ATTR_NOTNULL),
			'bd_create_ip' => array(TYPE_VARCHAR, 20, ATTR_NOTNULL),
		);
		
		parent::__construct();
	}


	function insertArticle(&$args, $bcid, &$config){
		$this->message = false;

		if(!$this->chk->hasText($bcid)){
			$this->message = '게시판이 선언되지 않았습니다.';
			return 'script';
		}
		
		$where = array('bd_bcid' => $bcid);

		$args['bd_step'] = $this->value('MAX(bd_step)', array('bd_bcid'=>$bcid) ) + 1;
		$args['bd_ctime'] = time();
		$args['bd_create_ip'] = $_SERVER['REMOTE_ADDR'];

		if($this->auth->isLogin()) $args['bd_id'] = $this->auth->id();	
		$args['bd_bcid'] = $bcid;	
		$args['bd_view_cnt'] = 0;
		$args['bd_display_flag'] = '1';

		if($args['bd_html_flag'] != 'Y') $args['bd_html_flag'] = 'N';
		$args['bd_thread'] = 'A';

		if($config['bc_lock_flag'] == 'A') $args['bd_lock_flag'] = 'Y';
		else if($config['bc_lock_flag'] == 'N') $args['bd_lock_flag'] = 'N';
		if(!$this->chk->hasArrayValue('bd_lock_flag', $args)) $args['bd_lock_flag'] = 'N';	

		if($args['bd_html_flag'] == 'N') $args['bd_content'] = nl2br(strip_tags($args['bd_content']));

		if(!$this->chk->hasArrayValue('bd_notice_flag', $args)) $args['bd_notice_flag'] = 'N';

		$this->checkInsertParam($args);
		if($this->message) return false;
		
		parent::insert($args);

		$where = array(			
				'bd_ctime' => $args['bd_ctime'],
				'bd_create_ip' => $args['bd_create_ip']
			);			

		return parent::value('bd_seq', $where);
	}

	function modifyArticle(&$args, $bd_seq, $bcid, &$config){
		if(!is_numeric($bd_seq) || !$this->chk->hasText($bcid)) return false;		
		$args['bd_bcid'] =$bcid;
		$this->checkUpdateParam($args);
		if($this->message) return false;


		if($args['bd_html_flag'] != 'Y') $args['bd_html_flag'] = 'N';
		if($config['bc_lock_flag'] == 'A') $args['bd_lock_flag'] = 'Y';
		else if($config['bc_lock_flag'] == 'N') $args['bd_lock_flag'] = 'N';
		if(!$this->chk->hasArrayValue('bd_lock_flag', $args)) $args['bd_lock_flag'] = 'N';	

		if($args['bd_html_flag'] == 'N') $args['bd_content'] = nl2br(strip_tags($args['bd_content']));

		if(!$this->chk->hasArrayValue('bd_notice_flag', $args)) $args['bd_notice_flag'] = 'N';

		$where = array('bd_seq'=>$bd_seq, 'bd_bcid'=>$bcid);
		parent::update($args, $where);
		return true;
	}

	function deleteBySeq($bd_seq, $bcid){
		if(!is_numeric($bd_seq) || !$this->chk->hasText($bcid)) return false;
		$where = array('bd_seq'=>$bd_seq, 'bd_bcid'=>$bcid);
		parent::delete($where);
		return true;
	}

	function checkInsertParam(&$args){		
		$this->message = false;
		if( !$this->chk->hasText($args['bd_bcid']) ) $this->message = '게시판을 찾을 수 없습니다.';
		else if(!$this->chk->hasText($args['bd_subject'])) $this->message = '제목을 입력해주세요.';
		else if(!$this->chk->hasText($args['bd_content'])) $this->message = '내용을 입력해주세요.';
		else if(!$this->chk->hasText($args['bd_name'])) $this->message = '작성자를 입력해주세요.';
		else if(!$this->auth->isLogin() && !$this->chk->hasText($args['bd_pass']) ) $this->message = '비밀번호를 입력하세요.';
		else if(array_key_exists('bd_bdcseq', $args) && (!$args['bd_bdcseq'] || !is_numeric($args['bd_bdcseq']))) $this->message = '분류를 선택해주세요.';		
	}

	function checkUpdateParam(&$args){
		$this->message = false;
		$this->checkInsertParam($args);
	}


	//게시물 얻기
	function & getArticle($seq, $bd_bcid){		
		if(!is_numeric($seq) || !$this->chk->hasText($bd_bcid) ) show_error('This is wrong way access!');
		$where = array('bd_seq' => $seq, 'bd_bcid'=>$bd_bcid);
		$rows = $this->row('*', $where);		
		return $rows;
	}


	function updateHit($bd_seq){
		if(!is_numeric($bd_seq)) return false;
		$session_name = 'board_hidt_check_'.$bd_seq;

		if($this->session->userdata($session_name) != 'on'){
			$args = array('bd_view_cnt' => 'bd_view_cnt+1');
			$result = $this->update($args, array('bd_seq' => $bd_seq));			
			$this->session->set_userdata(array($session_name=>'on'));
		}
	}


	function getArticleByBcid($bcid, $number = 10){
		$where = "bd_bcid = '{$bcid}'";
		$order = 'bd_seq desc';
		$sql = "select * from {$this->_table} where {$where} order by {$order} limit {$number}";
		return parent::listAllBySql($sql);
		
	}

	function getRandomArticleByBcid($bcid, $number = 10, $cat_seq = false){
		$where = "bd_bcid = '{$bcid}'";
		if($cat_seq) $where = $where." and bd_bdcseq={$cat_seq}";

		$sql = "select * from {$this->_table} where {$where} order by rand() limit {$number}";
		return parent::listAllBySql($sql);
		
	}

	function getArticleWithThumByBcid($bcid, $number = 10){
		if(!$bcid || !is_numeric($number) || $number < 1) return array();
		$list = $this->getArticleByBcid($bcid, $number);	
		if(isArray_($list)){
			$seqs = array();
			foreach($list as $k => $v){
				$seqs[] = $v['bd_seq'];
			}
			$this->load->model('Board/BoardFileModel', 'boardImageModel');
			$image_list = $this->boardImageModel->getThumBySeqs	($seqs);			
			
			$this->load->helper('my_file');
			foreach($list as $k => $v){
				if(array_key_exists($v['bd_seq'], $image_list)){
					$list[$k]['thum'] = path2url_($image_list[$v['bd_seq']]['bf_path']);			
				}
			}
		}
		return $list;
	}

	function getArticleRandomWithTumByBcid($bcid, $number = 10, $cat_seq=false){
		if(!$bcid || !is_numeric($number) || $number < 1) return array();
		$list = $this->getRandomArticleByBcid($bcid, $number, $cat_seq);	

		if(isArray_($list)){
			$seqs = array();
			foreach($list as $k => $v){
				$seqs[] = $v['bd_seq'];
			}
			$this->load->model('Board/BoardFileModel', 'boardImageModel');
			$image_list = $this->boardImageModel->getThumBySeqs	($seqs);			
			
			$this->load->helper('my_file');
			foreach($list as $k => $v){
				if(array_key_exists($v['bd_seq'], $image_list)){
					$list[$k]['thum'] = path2url_($image_list[$v['bd_seq']]['bf_path']);			
				}
			}
		}
		return $list;

	}
}

?>
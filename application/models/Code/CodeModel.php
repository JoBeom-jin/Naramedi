<?
/*
create table codes(
cd_code varchar(6) not null primary key default '',
cd_group char(3) not null default '',
cd_name varchar(250) not null,
cd_add1 varchar(250) default null,
cd_add2 varchar(250) default null,
cd_add3 varchar(250) default null,
cd_add4 varchar(250) default null,
cd_add5 varchar(250) default null,
cd_sort int unsigned not null default 1,
cd_use char(1) not null default 'Y'
);

*/
defined('BASEPATH') OR exit('No direct script access allowed');

class CodeModel extends MY_Model{

	public $error_message = false;

	function __construct(){
		$this->_table = 'codes';
		$this->_cols = array(
			'cd_code'  => array(TYPE_VARCHAR, 6, ATTR_PK ),
			'cd_name'  => array(TYPE_VARCHAR, 40, ATTR_NOTNULL, '코드명'),
			'cd_group'  => array(TYPE_VARCHAR, 3, ATTR_NOTNULL, '코드 그룹 명'),
			'cd_add1'  => array(TYPE_VARCHAR, 40, ATTR_NONE, '코드 추가값1'),
			'cd_add2'  => array(TYPE_VARCHAR, 40, ATTR_NONE, '코드 추가값2'),
			'cd_add3'  => array(TYPE_VARCHAR, 40, ATTR_NONE, '코드 추가값3'),
			'cd_add4'  => array(TYPE_VARCHAR, 40, ATTR_NONE, '코드 추가값4'),
			'cd_add5'  => array(TYPE_VARCHAR, 40, ATTR_NONE, '코드 추가값5'),
			'cd_sort' => array(TYPE_VARCHAR, 40, ATTR_NONE, '코드 정렬순'),
		);
		
		parent::__construct();
	}

	function getListByCgCode($cg_code, $order=false){
		if(!$this->chk->hasText($cg_code)) return array();
		if(!$order) $order = 'cd_sort asc';
		$where = "cd_code like '{$cg_code}%'";
		return parent::listAll('*', $where, $order, FETCH_ASSOC, 'cd_code');
	}

	function insertCode($args){
		$this->error_message = false;		

		if(!$this->checkInsertParam($args)) return false;

		$args['cd_code'] = $args['cg_code'].$args['cd_code'];
		$args['cd_group'] = $args['cg_code'];
		$args['cd_sort'] = $this->_nextSortNumber($args['cg_code']);


		parent::insert($args);
		return true;
	}



	/*
	* 코드 수정 완료
	*/
	function updateCodeByCode(&$args, $cd_code){
		if(!$this->chk->hasText($cd_code)) return false;
		unset($args['cd_code']);

		if(!$this->checkUpdateParam($args)) return false;

		$where = array('cd_code' => $cd_code);
		parent::update($args, $where);
		return true;	
	}

	/*
	* DB 신규 입력 전 파라메터 체크
	*/
	function checkInsertParam(&$args){
		$this->error_message = false;
		if(!$this->checkUpdateParam($args)) return false;


		if(!$this->chk->hasText($args['cd_code'])) $this->error_message = '코드는 반드시 입력하셔야 합니다.';
		else if(!ctype_alnum($args['cd_code'])) $this->error_message = '코드는 반드시 영문 혹은 숫자로 만들어져야 합니다.';
		else if(strlen($args['cd_code']) != 3) $this->error_message = '코드는 반드시 3글자여야 합니다.';
		else if($this->_isDuple($args['cg_code'], $args['cd_code'])) $this->error_message = '이미 존재하는 코드 명입니다.';

		if($this->error_message) return false;
		return true;
	}

	/*
	* DB 업데이트 전 파라메터 체크
	*/
	function checkUpdateParam(&$args){
		$this->error_message = false;

		if(!$this->chk->hasText($args['cd_name'])) $this->error_message = '코드명은 반드시 입력되어야 합니다.';		
		else if(!$this->chk->hasText($args['cg_code'])) $this->error_message = '잘못된 코드 그룹이 선택되었습니다. 처음부터 다시 시도하세요.';

		if(!$this->error_message) return true;
		else return false;
	}

	/*
	* 코드 row 얻기
	*/
	function getCodeByCode($code){
		if(!$this->chk->hasText($code)) return false;
		$where = array('cd_code' => $code);
		return parent::row('*', $where);
	}

	/*
	* 코드 삭제
	*/
	function deleteCodeByCode($code){
		if(!$this->chk->hasText($code)) return false;
		$where = array('cd_code' => $code);
		return parent::delete($where);
	}

	/*
	* 코드 정렬 : 위로
	*/
	function upCode($code){
		$this->error_message = false;
		if(!$this->chk->hasText($code)){
			$this->error_message = '잘못된 접근입니다.';
			return false;
		}

		$source_code_info = $this->getCodeByCode($code);
		if($source_code_info['cd_code'] != $code){
			$this->error_message = '잘못된 접근입니다.';
			return false;
		}

		$where = array('cd_sort' => $source_code_info['cd_sort']-1);
		$target_code_info = parent::row('*', $where);

		if(!$this->chk->hasText($target_code_info['cd_code'])){
			$this->error_message = '정렬을 변경할 수 없습니다.';
			return false;
		}
		
		$source_code_info['cd_sort'] = $source_code_info['cd_sort']-1;
		$where = array('cd_code' => $source_code_info['cd_code']);
		parent::update($source_code_info, $where);

		$target_code_info['cd_sort'] = $target_code_info['cd_sort']+1;
		$where = array('cd_code' => $target_code_info['cd_code']);
		parent::update($target_code_info, $where);

		return true;
	}


	/*
	* 코드 정렬 : 아래로
	*/
	function downCode($code){
		if(!$this->chk->hasText($code)){
			$this->error_message = '잘못된 접근입니다.';
			return false;
		}

		$source_code_info = $this->getCodeByCode($code);
		if($source_code_info['cd_code'] != $code){
			$this->error_message = '잘못된 접근입니다.';
			return false;
		}

		$where = array('cd_sort' => $source_code_info['cd_sort']+1);
		$target_code_info = parent::row('*', $where);

		if(!$this->chk->hasText($target_code_info['cd_code'])){
			$this->error_message = '정렬을 변경할 수 없습니다.';
			return false;
		}
		
		$source_code_info['cd_sort'] = $source_code_info['cd_sort']+1;
		$where = array('cd_code' => $source_code_info['cd_code']);
		parent::update($source_code_info, $where);

		$target_code_info['cd_sort'] = $target_code_info['cd_sort']-1;
		$where = array('cd_code' => $target_code_info['cd_code']);
		parent::update($target_code_info, $where);

		return true;
	}

	/*
	* 부위별 코드(i)의 코드 값을 얻고, 부위 상세별 코드로 재배열하여 리턴
	* ex) codes=array() 를 codes = array('전신' => array()) 로 변환
	*/
	function getBodyPartList(){
		$codes = $this->getListByCgCode('i');
		$result = $this->getBodyDetailParts($codes);
		return $result;
	}

	/*
	* 부위별 코드를 각 파트별로 분류하여 array를 재구성한다.	
	*/
	function getBodyDetailParts($types){
		$body_parts = array('전신', '뇌', '폐', '척추검사', '상복부', '하복부', '심혈관계', '내분비계', '소화기검사', '예방의학', '여성검진', '기타');

		$return = array();

		foreach($body_parts as $k=>$v){
			$temp = array();
			$temp['name'] = $v;
			foreach($types as $k2 => $v2){
				if($v2['cd_add3'] == $v){
					$temp['data'][] = $v2;
					unset($types[$k2]);
				}
			}
			$return[$k] = $temp;			
		}

		return $return;
	}

	/*
	* 부위별 코드(i)의 코드 값을 얻고, 부위별 코드로 재배열하여 리턴
	* ex) codes=array() 를 codes = array('전신' => array()) 로 변환
	* 
	* 
	*/
	function getBodyPartList2(){
		$codes = $this->getListByCgCode('i');
		$result = $this->getBodyDetailParts2($codes);
		return $result;
	}

	/*
	* 부위별 코드를 각 파트별로 분류하여 array를 재구성한다.	
	*/
	function getBodyDetailParts2($types){
//		$body_parts = array('전신', '머리', '목', '가슴', '유방', '허리', '상복부', '하복부', '기타');
		$body_parts = array('머리', '목', '가슴', '유방', '허리', '상복부', '하복부', '기타');

		$return = array();

		foreach($body_parts as $k=>$v){
			$temp = array();
			$temp['name'] = $v;
			foreach($types as $k2 => $v2){

				if($v2['cd_add2'] == $v || ($v2['cd_add2'] == '전신(허리,대퇴)' && $v == '기타') || ($v2['cd_add2'] == '전신' && $v == '기타') ){
					$temp['data'][] = $v2;
					unset($types[$k2]);
				}


			}
			$return[$k] = $temp;			
		}

		return $return;
	}



	/*
	* 중복된 코드가 있는지 확인
	* 중복 코드가 있으면 true 없으면 false
	*/
	private function _isDuple($group_code, $code){
		if(!$this->chk->hasText($group_code) || !$this->chk->hasText($code)) return true;
		$code = $group_code.$code;
		$where = array('cd_code' => $code);
		return parent::exist($where);
	}

	/*
	* 다음 정렬 번호
	*/
	private function _nextSortNumber($cg_code){
		if(!$this->chk->hasText($cg_code)) return false;
		
		$where = "cd_code like '{$cg_code}%'";
		return parent::nextValue('cd_sort', $where);
	}



}

?>
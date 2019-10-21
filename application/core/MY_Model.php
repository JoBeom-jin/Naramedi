<?
defined('BASEPATH') OR exit('No direct script access allowed');

define('TYPE_NONE',     0x0000, true);
define('TYPE_VARCHAR',  0x0001, true);
define('TYPE_INT',      0x0002, true);
define('TYPE_TEXT',     0x0004, true);
define('TYPE_DATE',     0x0008, true);
define('TYPE_DATETIME', 0x0010, true);
define('TYPE_CHAR',     0x0020, true);
define('TYPE_BLOB',    0x0040, true);
define('TYPE_PASS',    0x0050, true);
define('TYPE_OLDPASS',    0x0060, true);

define('ATTR_NONE',          0x0000, true);
define('ATTR_PK',            0x0001, true);
define('ATTR_NOTNULL',       0x0002, true);
define('ATTR_ID',            0x0004, true);
define('ATTR_FLAG',          0x0008, true);
define('ATTR_FILE',          0x0010, true);
define('ATTR_LIST',          0x0020, true);
define('ATTR_EDITOR',        0x0040, true);
define('ATTR_TIMESTAMP',     0x0080, true);
define('ATTR_TIMESTAMP8',    0x0100, true);
define('ATTR_BLOB',          0x0200, true);
define('ATTR_TIMESTAMP19',   0x0400, true);


define('FETCH_ASSOC', 0x01, true);
define('FETCH_OBJECT', 0x04, true);


class MY_Model extends CI_Model {
	protected $_db;
	protected $_table;
	protected $_cols;
	protected $_colnames = array();
	protected $_pks = array();

	function __construct(){ 
		parent::__construct();	
		$this->init();
	}

	/*
	* 테이블의 cols를 반환합니다.
	*/
	function getCols() {
		return $this->_cols;
	}

	/**
	 * 데이터베이스 (테이블) 에서 한 행 얻기
	 *
	 * @param string $col 열 목록
	 * @param mixed $where 조건 절
	 * @param int $fetch_method 인출 방법
	 * @return mixed
	 */
	function row($col = '', $where = false, $fetch_method = FETCH_ASSOC){		
		return $this->rowBySql($this->_sql($col, $where), $fetch_method);
	}

	/**
	 * 데이터베이스 (테이블) 에서 한 행 얻기
	 * sql 문으로 얻기
	 */
	function rowBySql($sql, $fetch_method = FETCH_ASSOC) {
		$query = $this->db->query($sql);
		return $this->_row_result($query, $fetch_method);
	}


	/**
	 * 테이블의 한 행에서 단일 값 얻기.
	 * 최초의 행을 얻은 후 해당 열의 값을 리턴
	 *
	 * @param string $col 열 이름
	 * @param mixed $where 조건 절
	 * @return string 결과 값.
	 */
	function value($col, $where = false) {
		$row = $this->row($col, $where);
		return $this->_value($row);
	}

	function valueBySql($sql) {
		$row = $this->rowBySql($sql);
		return $this->_value($row);
	}

	private function _value(&$row){
		if(is_array($row) && count($row) > 0){
			$values = array_values($row);
			return $values[0];
		}
		return false;		
	}

	/**
	 * 테이블의 행 수를 얻는다.
	 *
	 * @param mixed $where WHERE 절
	 * @return int 행의 행 수
	 */
	function count($where = false, $table = false) {		
		$num = 0;
		if(!$table) $num = $this->value('count(*) as num', $where);
		else{
			$where_string = '';
			if($where) $where_string = $this->_where($where);
			$sql = "select count(*) as num from {$table}";
			if($this->chk->hasText($where_string)) $sql = $sql." {$where_string}";
			$row = $this->rowBySql($sql);
			$num = $row['num'];
		}
		return intval($num);
	}


	/**
	 * row의 존재여부를 확인한다.
	 */
	function exist($where){
		$num = $this->count($where);
		if($num > 0) return true;
		else return false;
	}

	/**
	 * SQL 을 받아 수행하고 결과 목록을 리턴
	 *
	 * @param string $sql 수행할 SQL 문
	 * @param int $fetch_method 인출 방법
	 * @param string $key_col MAP 형식으로 결과를 받을때, 키가될 컬럼
	 * @param string $value_col $key=>$value 형식의 MAP 으로 결과를 받을 때, 값이 될 컬럼
	 * @return array
	 */
	function listAllBySql($sql, $key_col = false, $value_col = false, $fetch_method = FETCH_ASSOC) {
		$query = $this->db->query($sql);
		if ($key_col) return $this->_map($query, $key_col, $value_col, $fetch_method);
		else return $this->_list_result($query, $fetch_method);
	}

	function listAll($col = '*', $where = false, $order = false, $fetch_method = FETCH_ASSOC, $key_col = false, $value_col = false, $test = false) {
		$sql = $this->_sql($col, $where, $order);
		if ($test){ echo $sql; exit;}
		return $this->listAllBySql($sql, $key_col, $value_col, $fetch_method);
	}




	/**
	 * INSERT 수행
	 *
	 * @param array $data 열-값 쌍의 배열
	 * @param boolean $test 테스트 여부
	 * @return int 업데이트 된 행 수
	 */
	function insert(&$data, $test = false){		
		$values = $this->_values($data);

		foreach ($this->_pks as $pk => $desc) {
			if($this->_cols[$pk]['attr'] & ATTR_ID) {				
				if(array_key_exists($pk, $values)) unset($values[$pk]);
			}
		}		

		$sql = 'INSERT INTO '.$this->_table.'('.implode(', ', array_keys($values)).') ';
		$sql .= 'VALUES('.implode(', ', $values).')';
		if ($test){	echo $sql;	exit;}
		$this->db->query($sql);		
		return $this->db->affected_rows();
	}


	/**
	 * UPDATE 수행
	 *
	 * @param array $data 열-값 쌍의 배열
	 * @param mixed $where wherw 절
	 * @param boolean $test 테스트 여부
	 * @return int 업데이트 된 행 수
	 */
	function update($data, $where = false, $test = false) {	
		$pk_wheres = false;		

		//업데이트 데이터에서 pk 열은 제외
		foreach ($this->_pks as $pk => $desc) {
			if(array_key_exists($pk, $data)){
				$pk_wheres[$pk] = $data[$pk];
				unset($data[$pk]);
			}
		}


		if ($pk_wheres !== false && $where === false) $where = $pk_wheres;
		$values = $this->_values($data);

		$sql = 'UPDATE '.$this->_table.' SET ';
		$sets = array();
		foreach ($values as $k=>$v) $sets[] = $k.' = '.$v;
		$sql .= implode(' , ', $sets);
		if (!$where) show_error('require WHERE at UPDATE');
		if ($where) $sql .= $this->_where($where);

		if($test){
			echo $sql;
			exit;
		}

		$this->db->query($sql);		
		return $this->db->affected_rows();
	}


	function delete($where, $test = false) {
		$sql = 'delete from ' . $this->_table . $this->_where($where);
		if ($test){ echo $sql; exit; }
		$this->db->query($sql);		
		return $this->db->affected_rows();
	}


	/**
	 * 페이징 쿼리를 수행하고 결과 행들을 리턴
	 *
	 * @param paging $paging 일반 쿼리 인자
	 * @param array $params 인자 목록
	 * @param int $fetch_method 인출 방법
	 * @return unknown
	 */
	function listPage(Paging & $paging, $params = array(), $fetch_method = FETCH_ASSOC, $test = false) {
		$table = (isset($params['table'])) ? $params['table'] : $this->_table;
		$cols = (isset($params['cols'])) ? $params['cols'] : $this->cols();

		$where = '';
		if (isset($params['where'])) $where = $this->_where($params['where'], '', '');
		if ($paging->where()) {
			if ($where) $where = '(' . $where . ') and (' . $paging->where() . ')';
			else $where = $paging->where();
		}

		$order = '';
		if (isset($params['order'])) $order = $params['order'];
		if ($paging->order()) {
			if ($order) $order .= ',' . $paging->order();
			else $order = $paging->order();
		}				

		$paging->setTotalRows($this->count($where, $table) );	

		if ($test){
			echo '<pre>';
			print_r($paging);
			echo '</pre>';
			exit;
		}

		$query = $this->paging($table, $cols, $where, $order, $paging);

		if (isset($params['key'])) return $this->map($query, $params['key'], $params['value'],  $fetch_method);
		else return $this->_list_result($query, $fetch_method);
	}

	function nextValue($col, $where, $default = 1){
		$where_string = $this->_where($where);
		$sql = "select MAX({$col}) as {$col} from {$this->_table} {$where_string} order by {$col} desc limit 1";
		$row = $this->rowBySql($sql);	
		if(!is_array($row) || count($row) < 1) return $default;
		else return ++$row[$col];
	}

	function maxValue($col, $where){
		$where_string = $this->_where($where);
		$sql = "select max({$col}) as max from {$this->_table} {$where_string}";
		$row = $this->rowBySql($sql);
		if(!is_array($row) || count($row) < 1) return 1;
		else return $row['max'];
		
	}

	protected function paging($table, $cols, $where, $order, paging $paging) {
		$sql = $this->getPagingSql($table, $cols, $where, $order, $paging);		
		return $this->db->query($sql);	
	}

	protected function getPagingSql($table, $cols, $where, $order, paging $paging) {
		$sql = "select {$cols} from {$table}";
		if ($where) $sql .= " where {$where}";
		if ($order) $sql .= ' order by ' . $order;
		$sql .= ' limit ' . $paging->start . ',' . $paging->pageSize;

		return $sql;
	}





	/**
	 * 결과 내보내기 list
	 */
	protected function _list_result(&$query, $fetch_method){
		if($fetch_method == FETCH_OBJECT){
			return $query->result();
		}
		else if($fetch_method == FETCH_ASSOC){
			return $query->result_array();
		}		
	}



	/**
	 * 결과 내보내기
	 */
	protected function _row_result(&$query, $fetch_method){
		if($fetch_method == FETCH_OBJECT){
			return $query->row();
		}
		else if($fetch_method == FETCH_ASSOC){
			return $query->row_array();
		}		
	}	

	/*
	* sql string을 얻는다.
	*/
	protected function _sql($col = false, $where = null, $order = null) {
		$col = ($col) ? $col : $this->cols();
		$where = $this->_where($where);
		$order = $this->_order($order);
		return 'SELECT ' . $col . ' FROM ' . $this->_table . $where . $order;
	}


	/*
	* where문을 얻는다.
	* @$where : array or string
	*/
	protected function _where($where, $prefix = ' WHERE ( ', $suffix = ')') {
		if(is_string($where) && $where != '' ){
			return $prefix . $where . $suffix;

		}else if(is_array($where) && count($where) > 0){
			$keys = array_keys($where);

			if (is_string($keys[0])){
				return $prefix . $this->_where_array($where) . $suffix;
			}else{
				return $prefix . $this->_where_pk($where) . $suffix;
			}

		}else if(is_null($where) || !$where || empty($where)) return '';
		else throw new show_error('invalid where cause');
	}

	/*
	* where 문 생성
	* where : pk의 값으로만 이뤄진 배열일 경우
	*/
	protected function _where_pk($where) {
		$new_where = array();
		$cnt = 0;
		foreach ($this->_pks as $col => $desc) {
			$new_where[$col] = $where[$cnt++];
		}
		return $this->_where_array($new_where);
	}

	/*
	* 배열로 전달된 where을 string으로 변경
	*/
	protected function _where_array($where) {
		$ws = array();

		foreach ($where as $k => $v){
			if (is_array($v)) {
				$op = $v[0];
				$value = $v[1];
			} else {
				$op = '=';
				$value = $v;
			}
			if ($value === null || $value == 'null') {
				$op = '';
				$val = 'is null';
			} else {
				switch ($this->_cols[$k]['type']) {
					case TYPE_VARCHAR:
					case TYPE_CHAR:
					case TYPE_TEXT:
						$val = '\''. stripslashes( str_replace("'", "''", $v) ).'\'';
						break;
					case TYPE_INT:
						$val = "{$value}";
						break;
					case TYPE_PASS:
						$val = 'password(\''. stripslashes( str_replace("'", "''", $v) ).'\')';
						break;
				}
			}

			$ws[] = "{$k} {$op} {$val}";
		}

		return implode(' AND ', $ws);
	}


	/*
	* order string 생성
	*/
	protected function _order($order) {
		if ($order === null) return '';

		if (is_string($order)) {
			return ' ORDER BY ' . $order;
		} else if (is_array($order)) {
			$os = array();

			foreach ($order as $o) {
				if (is_string($o)) {
					$os[] = $o;
				} else if (is_array($o)) {
					$os[] = $o[0].' '.$o[1];
				}
			}

			return ' ORDER BY ' . implode(',', $os);
		}
	}


	/*
	* 값에 대한 처리
	*/
	protected function _values($values) {
		$arr = array();	
		
		foreach ($values as $k => $v) {
			if(!array_key_exists($k, $this->_cols)) continue;

			$col = $this->_cols[$k];

			if ($v === null && $col['default'] !== null) $v = $col['default'];
			if ($v === null) {
				$arr[$k] = 'NULL';
			} else {
				switch ($col['type']) {
					case TYPE_VARCHAR:
					case TYPE_TEXT:
					case TYPE_CHAR:
						$arr[$k] = '\''. stripslashes( str_replace("'", "''", $v) ).'\'';
						break;					
					case TYPE_PASS:
						$arr[$k] = 'password(\''. stripslashes( str_replace("'", "''", $v) ).'\')';
						break;
					case TYPE_OLDPASS:
						$arr[$k] = '\'old_password('. stripslashes( str_replace("'", "''", $v) ).')\'';
						break;
					case TYPE_INT:						
						$arr[$k] = "{$v}";
						break;
					case TYPE_DATETIME : 
						if(preg_match("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/", $v)){
							$arr[$k] = "'{$v}'";
						}else{
							$arr[$k] = "{$v}";
						}
						break;												
				}
			}
		}

		return $arr;
	}


	/**
	 * Record Set 의 모든 행을 Map (associated array)으로 모두 인출
	 *
	 * @param reource $rs 이전에 실행되어 돌려받은 RS
	 * @param string $key 키로 사용할 컬럼 명
	 * @param string $value 값으로 사용할 컬럼 명 (기본값은 false, 한행을 값으로 사용)
	 * @param int $method 인출 방법 (FETCH_ASSOC / FETCH_NUM / FETCH_OBJECT / FETCH_BOTH)
	 * @return array
	 */
	protected function & _map(&$query, $key, $value = false, $method = FETCH_ASSOC) {
		$list = array();

		$rows = $query->result_array();
		foreach($rows as $row){
			if ($value) {
				$list[$row[$key]] = $row[$value];
			} else {
				$list[$row[$key]] = $row;
			}
		}
		return $list;
	}


	function init() {
		$cols = array();
		foreach ($this->_cols as $col => $desc) {
			$cols[$col] = array(
				'name'    => $col,
				'type'    => ($desc[0]) ? $desc[0] : TYPE_NONE,
				'size'    => ($desc[1]) ? $desc[1] : 0,
				'attr'    => (array_key_exists(2, $desc) && $desc[2] ) ? $desc[2] : ATTR_NONE,
				'title' => (array_key_exists(3, $desc) && $desc[3] ) ? $desc[3] : ATTR_NONE, 
				'default' => (array_key_exists(4, $desc) && $desc[4] !== null) ? $desc[4] : null,				
			);
			if ($cols[$col]['attr'] & ATTR_PK) $this->_pks[$col] = $cols[$col];
		}
		$this->_cols = $cols;
	}

	function getEmptyRow(){
		$cols = $this->getCols();
		foreach($cols as $k => $v){
			$cols[$k] = false;
		}
		return $cols;
	}

	/**
	 * 서비스에 설정된 컬럼 목록을 얻는다.
	 * SELECT 절에 사용하기 위해 사용.
	 *
	 * @param boolean $asString 컬럼 목록을 문자열로 받을 지 여부 (true)
	 * @return mixed 컬럼명 목록을 배열 혹은 문자열로 받는다.
	 */
	protected function cols($asString = true) {
		$cols = array_keys($this->_cols);
		if (!$asString) return $cols;
		return implode(',', $cols);
	}



}
?>
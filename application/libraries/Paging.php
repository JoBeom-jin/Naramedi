<?php
class Paging {

	public $totalRows = -1;
	public $totalPages = -1;
	public $page = 1;
	public $pageSize = 10;
	public $pagesPerGroup = 10;
	public $start = 0;
	public $end = 0;
	public $prev = 0;
	public $next = 0;
	public $pages;
	public $orders = array();
	public $orderOptions = array();
	public $wheres = array();
	public $whereConnector = 'and';
	public $name = 'q';
	public $add_url = false;
	private $_ci = false;


	function __construct($name = 'q', $size = 20, $groups = 10) {
		$this->_ci = & get_instance();
		$this->page = 1;
		$this->pageSize = $size;
		$this->pagesPerGroup = $groups;
		$this->bind($name);
	}

	/*
	* 최초 query instance 생성시 각 파라메터를 bind
	*/
	function bind($name = 'q') {
		$this->name = $name;	

		$pageSize = intval($this->_ci->request->param($this->name.'_size', METHOD_BOTH, $this->pageSize));
		if ($pageSize == 0) $pageSize = PHP_INT_MAX;
		$this->setPageSize( $pageSize );
		$this->setPage(intval($this->_ci->request->param($this->name . '_page', METHOD_BOTH, 1)));
		$this->setPagesPerGroup(intval($this->_ci->request->param($this->name.'_pages', METHOD_BOTH, $this->pagesPerGroup)));
		$this->whereConnector = $this->_ci->request->param($this->name.'_connector', METHOD_BOTH, 'and');
		
		$this->bind_orders($this->_ci->request->param($this->name.'_orders'));
		$this->bind_where();
	}

	function setPageSize($size) {
		$this->pageSize = $size;
		if ($this->totalRows > -1) $this->_computeTotalPages();
		$this->_computeStartEnd();
	}	

	private function _computeTotalPages() {
		$this->totalPages = intval($this->totalRows / $this->pageSize);
		if (($this->totalRows % $this->pageSize) > 0) $this->totalPages++;
		if ($this->totalRows > 0) $this->_computeLinks();
		$this->_computeStartEnd();
	}

	private function _computeStartEnd() {
		$this->start = ($this->page - 1) * $this->pageSize;
		$this->end = $this->start + $this->pageSize - 1;
	}

	private function _computeLinks() {
		$start = $end = $last = 0;

		if ($this->page % $this->pagesPerGroup == 0) $start = intval(floor(($this->page - 1) / $this->pagesPerGroup) * $this->pagesPerGroup + 1);
		else $start = intval(floor($this->page / $this->pagesPerGroup) * $this->pagesPerGroup + 1);

		$end = $start + $this->pagesPerGroup - 1;

		if ($this->totalPages % $this->pagesPerGroup == 0) $last = intval(floor(($this->totalPages - 1) / $this->pagesPerGroup) * $this->pagesPerGroup + 1);
		else $last = intval(floor($this->totalPages / $this->pagesPerGroup) * $this->pagesPerGroup + 1);

		if ($start > 1) $this->prev = $start - 1;
		else $perv = 0;

		if ($this->page < $last) $this->next = $end + 1;
		else $this->next = 0;

		$this->pages = array();
		for ($i = $start; $i <= $end && $i <= $this->totalPages; $i++) $this->pages[] = $i;
	}

	function setPagesPerGroup($groups) {
		$this->pagesPerGroup = $groups;
		if ($this->totalRows > 0) $this->_computeLinks();
	}

	function setPage($page) {
		$this->page = $page;
		$this->_computeStartEnd();
		if ($this->totalRows > 0) $this->_computeLinks();
	}


	/*
	* bind()시에 order bind
	*/
	function bind_orders($orders){
		if($this->_ci->chk->isArray($orders)){
			foreach($orders as $k => $v){
				list($cols, $options) = explode(':', $v);
				if($cols && $options){
					$this->addOrder($cols, $options);
					$this->orderOptions[] = $v;
				}
			}
		}

		$ocols = $this->_ci->request->params($this->name.'_ocols');		//order column name
		$oms = $this->_ci->request->params($this->name.'_oms');			//order option
		for ($i = 0, $j = count($ocols); $i < $j; $i++) $this->addOrder($ocols[$i], $oms[$i]);
	}

	/*
	* bind() 시 where bind
	*/
	function bind_where(){
		$cols = $this->_ci->request->params($this->name.'_wcols');		//where column
		$ops = $this->_ci->request->params($this->name.'_wops');			//where option
		$vals1 = $this->_ci->request->params($this->name.'_wvals1');	//where value
		$vals2 = $this->_ci->request->params($this->name.'_wvals2');	//where bitween의 경우 두번째 value
		for ($i = 0; $i < count($cols); $i++) $this->addWhere($cols[$i], $ops[$i], $vals1[$i], $vals2[$i]);
	}

	//▽ orders
	/*
	* defaultOrder : 설정된 order가 없을 시에만 실행.	
	*/
	function defaultOrder($col, $method = 'desc') {
		if (count($this->orders) == 0) {
			if (is_array($col)) $this->orders = $col;
			else $this->setOrder($col, $method);
		}
	}

	/*
	* setOrder : 현재 $this->orders 배열을 초기화 한 후 setting
	*/
	function setOrder($col, $method = 'desc') {		
		$this->orders = array();
		$this->orders[] = array($col, $method);		 
	}

	/*
	* addOrder : 현재 $this->orders배열에 추가
	*/
	function addOrder($col, $method = 'desc') {
		$order = $this->getNoDuplicateOrder($col, $method);
		if($order) $this->orders[] = $order;
	}	
	

	function order() {
		if (is_array($this->orders) && count($this->orders) > 0) {
			$orders = array();
			foreach($this->orders as $order) {
				$orders[] = $order[0] . ' ' . $order[1];
			}
			return implode(',', $orders);
		} else {
			return null;
		}
	}


	//▽ Where
	/*
	* setWhereString : 현재 $this->wheres 배열을 초기화 한 후 setting : ( string )
	*/
	function setWhereString($where) {
		$this->wheres = $where;
	}

	/*
	* setWhere : 현재 $this->wheres 배열을 초기화 한 후 setting 
	*/
	function setWhere($col, $op, $val1, $val2 = null) {
		$this->wheres = array(array($col, $op, $val1, $val2));
	}

	/*
	* addWhere : 현재 $this->wheres 배열에 추가
	*/
	function addWhere($col, $op, $val1, $val2 = null) {
		$this->wheres[] = array($col, $op, $val1, $val2);
	}


	function getWhereValues($col) {
		foreach ($this->wheres as $w) {
			if ($w[0] == $col) return array($w[2],$w[3]);
		}
		return null;
	}

	function getWhereValue1($col) {
		foreach ($this->wheres as $w) {
			if ($w[0] == $col) return $w[2];
		}
		return null;
	}


	function getWhereValue2($col) {
		foreach ($this->wheres as $w) {
			if ($w[0] == $col) return $w[3];
		}
		return null;
	}

	

	function where() {
		if (is_string($this->wheres)) {
			return $this->wheres;
		}else if (is_array($this->wheres) && count($this->wheres)) {
			$wheres = array();
			foreach($this->wheres as $where) {
				$col = $where[0];
				$op = '';
				switch ($where[1]) {
					case '=':
					case '!=':
					case '>':
					case '<':
					case '<>':
					case '>=':
					case '<=':
						$op = "{$where[1]} '{$where[2]}'";
						break;
					case 'eq':
						$op= "= '{$where[2]}'";
						break;
					case 'like':
						$op = "like '%{$where[2]}%'";
						break;
					case 'start':
						$op = "like '{$where[2]}%'";
						break;
					case 'end':
						$op = "like '%{$where[2]}'";
						break;
					case 'between':
						$op = "between '{$where[2]}' and '{$where[3]}'";
						break;
					case 'in':
					case 'not in':
						if(is_array($where[2])) $op = "{$where[1]} ('" . implode("','", $where[2]) . "')";
						else $op = "{$where[1]} ('" . implode("','", explode(',', $where[2])) . "')";						
						break;
					case 'is' :
						$op = " is {$where[2]}";
						break;
				}

				if (strpos($col, ',') > 0) {
					$cwheres = array();
					foreach(explode(',', $col) as $c) $cwheres[] = $c . ' ' . $op;
					$wheres[] = '('.implode(' or ', $cwheres).')';
				} else {
					$wheres[] = $col . ' ' . $op;
				}
			}
			return implode(' ' . $this->whereConnector . ' ', $wheres);
		}
		return null;
	}










	function setTotalRows($total) {		
		$this->totalRows = $total;
		$this->_computeTotalPages();
	}

	function getUrl($page = 1, $is_js = false){
		$urls  = '';
		$params[$this->name.'_page'] = $page;				

		if($this->orders && count($this->orders) > 0){
			foreach($this->orders as $k => $v){
				$orders = array();
				$orders[$this->name.'_ocols[]'] = $v[0];
				$orders[$this->name.'_oms[]'] = $v[1];
			}			
		}
		
		$temps = array();
		if(count($params) >0){			
			foreach($params as $k => $p){							
				if(is_string($p) || is_array($p)){				
					if(is_array($p)){						
						foreach($p as $k2 => $p2){
							$temps[] = $k.'[]='.$p2;
						}						
					}else{
						$temps[] = $k.'='.$p;
					}
				}
			}
		}
		$temps[] = $this->name.'_page='.$page;

		if(is_array($this->add_url)) $temps = array_merge($this->add_url, $temps);

		$url = implode('&amp;', $temps);	
		if($is_js) $url = str_replace('&amp;', '&', $url);
		
		return $url;
	}

	function getPageNum($idx = 0){		
		return $this->totalRows - ( ($this->page - 1) * $this->pageSize + $idx );
	}
	
	//옵션의 select 여부를 확인
	function isOrderSelected($col, $opt){
		$search = array($col, $opt);
		if(in_array($search, $this->orders)) return true;
		return false;		
	}
	
	//추가할 url
	function addUrl($url){
		if($this->_ci->chk->hasText($url)) $this->add_url[] = $url;
	}

	//▽ private functions
	/*
	* order parametor들이 중복 출력되지 않도록 
	* $this->orders : 현재 세팅된 orders와 비교
	*/
	private function getNoDuplicateOrder($col, $method){
		if(!$this->_ci->chk->hasText($col)) return false;

		if($this->_ci->chk->isArray($this->orders)){
			foreach($this->orders as $k => $v){
				if($v[0] == $col){
					return false;
				}
			}			
		}
		return array($col, $method);
	}
}
?>

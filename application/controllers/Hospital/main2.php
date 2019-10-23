<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main2{



	function onInit(&$ci){
		$ci->load->model('Members/AuthGroup', 'authgroup');	
	}

	function index(&$data, &$ci){

		
		return 'site/main2';
	}

	private function & getList_HotdealHospital(&$ci){
		$ci->load->model('Members/Hospital', 'hospitalModel');


		$ctime = time();
		$sql = "select distinct(ei_hiseq) from  event_info where ei_event_type='hot' and ei_status='doing' and ( ei_end > {$ctime} or ei_auto_flag='Y')";
		$list = $ci->hospitalModel->listAllBySql($sql);
		$seqs = array();
		if(isArray_($list)){
			foreach($list as $k => $v){
				$seqs[] = $v['ei_hiseq'];
			}			
		}

		$ci->load->library('paging');
		$paging = &$ci->paging;

		$paging->setPageSize(3);
		$paging->addWhere('hi_active', '=', 'Y');
		$paging->addWhere('hi_seq', 'in', $seqs);
		$paging->setOrder('rand()', '');

		$sub_query = "( select aim_path from agency_image where ai_seq = aim_aiseq limit 1 ) as path";
		$paging_params = array(
				'table' => 'hospital_info left join agency_info on hi_org_number = ai_number',
				'cols' => "*, {$sub_query}",
			);
		$list = $ci->hospitalModel->listPage($paging, $paging_params);

		return $list;		
	}


//	public function contents(){			
//
//		$_controller = $this->getControllerByMenu();						
//
//		$action = $this->_action = $this->uri->segment(4, 'index');
//		if(!method_exists($_controller, $action)) show_error('could not find method');
//
//		$this->_data['act'] = $action;
//		$this->_data['sact'] = array();
//		$this->_data['msg'] = false;
//		
//		$_controller->onInit($this->CI);
//		$this->_data['accessable_menu_list'] = $this->setAccessableMenuList($this->_data['menu_list']);
//		$tpl = $_controller->$action($this->_data, $this->CI);
//
//		parent::viewPage($tpl, $this->_data);
//	}

}
?>

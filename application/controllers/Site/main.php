<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main{



	function onInit(&$ci){
		$ci->load->model('Members/AuthGroup', 'authgroup');	
	}

	function index(&$data, &$ci){
		$ci->load->model('Event/EventInfoModel', 'eventModel');

		//상단 슬라이드
		$ci->load->Model('Event/EventBannerModel', 'bannerModel');
		$data['banner_list'] = $ci->bannerModel->getList(7);
		$ci->load->helper('my_file');
		


		//하단 리스트
		$event_list = $ci->eventModel->getRandomRowWithHosinfo('*', 8, $data['is_closed']);
		$event_images = array();
		$ei_seqs = array();
		if(is_array($event_list) && count($event_list) > 0){
			foreach($event_list as $k => $v){
				$temp['url'] =str_replace(DIRECTORY_SEPARATOR, '/', str_replace($ci->_site_config['dir']['root'], '', $v['ei_img_banner']));			
				$temp['name'] = $v['ei_name'];
				$temp['ei_seq'] = $v['ei_seq'];
				$images[] = $temp;
				$ei_seqs[] = $v['ei_seq'];
			}
		}	

		$ci->load->model('Event/EventCountModel', 'eventCountModel');
		$ci->eventCountModel->insertViewByEiseqs($ei_seqs);	

		$data['event_list'] = &$event_list;
		$data['event_images'] = &$event_images;


		$data['slider_images'] = &$images;
		$data['hot_hospital_list'] = $this->getList_HotdealHospital($ci);	

		$ci->load->model('Members/Hospital', 'hospitalModel');
		$ci->load->model('Agency/AgencyImageModel', 'fileModel');

		$ci->load->model('Board/BoardContentsModel', 'boardModel');
		$data['articles'] = array();
		$temp = $ci->boardModel->getArticleRandomWithTumByBcid('healthinfo', 1, 1);
		$data['articles'][] = $temp[0];
		$temp = $ci->boardModel->getArticleRandomWithTumByBcid('healthinfo', 1, 4);
		$data['articles'][] = $temp[0];
		$temp = $ci->boardModel->getArticleRandomWithTumByBcid('healthinfo', 1, 3);
		$data['articles'][] = $temp[0];


		$ci->load->helper('my_file');
		$data['hospital_list'] = &$hos_list;
		return 'site/main';
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

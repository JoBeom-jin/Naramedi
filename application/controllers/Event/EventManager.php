<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventManager{

	private $_info = array();
	
	function onInit(&$ci){
		$ci->load->model('Event/EventInfoModel', 'eventModel');
		$ci->load->model('Event/EventCodeRelationModel', 'relationModel');
		$ci->load->model('Members/Hospital', 'hospitalModel');
		$ci->load->model('Event/EventReserveModel', 'reserveModel');
		
		$this->_info = $ci->hospitalModel->getFullInfoByMeseq($ci->auth->seq(), 'HOSPITAL', 'Y');
		if(!$ci->auth->isLogin() || $this->_info['hi_meseq'] != $ci->auth->seq() ) show_error('컨트롤러에 접근할 수 있는 권한이 없습니다. EventManager');
	}
	
	function index(&$data, &$ci){			
		$data['active'] = $active = $ci->request->param('active', METHOD_BOTH, 'Y');

		if($active == 'Y' ) $this->doActive($data, $ci);
		else if($active == 'N') $this->doStop($data, $ci);

		$data['status'] = $ci->eventModel->getStatus();

		return 'event/list';
	}

	function doActive(&$data, &$ci){
		$ci->load->library('paging');
		$paging = $ci->paging;

		$ctime = time(); 
		$paging->setWhere('ei_end', '>', $ctime);
		$paging->setOrder('ei_seq', 'desc');
		$paging->addWhere('ei_hiseq', '=', $this->_info['hi_seq']);


		$list = $ci->eventModel->listPage($paging);		
		$ei_seqs = array();
		if(is_array($list) && count($list) > 0 ){
			foreach($list as $k => $v){
				$ei_seqs[] = $v['ei_seq'];
				$list[$k]['thum'] = $this->path2url($v['ei_img_banner'], $ci);

				if($v['ei_status'] == 'wait' ){
					$list[$k]['status'] = '대기중';
				}else if($v['ei_status'] == 'doing'){
					$list[$k]['status'] = '진행중';									
				}else{
					$list[$k]['status'] = 'unknown';
				}
			}
		}

		$data['count_list'] = $ci->reserveModel->getCountByEiseqs($ei_seqs);	

		$data['list'] = &$list;

		$data['paging'] = &$paging;
	}

	function doStop(&$data, &$ci){
		$ci->load->library('paging');
		$paging = $ci->paging;

		$ctime = time(); 
		$paging->setWhere('ei_end', '<', $ctime);
		$paging->setOrder('ei_seq', 'desc');
		$paging->addWhere('ei_hiseq', '=', $this->_info['hi_seq']);

		$list = $ci->eventModel->listPage($paging);		

		$ei_seqs = array();
		if(is_array($list) && count($list) > 0 ){
			foreach($list as $k => $v){
				$ei_seqs[] = $v['ei_seq'];
				$list[$k]['thum'] = $this->path2url($v['ei_img_banner'], $ci);
				$list[$k]['status'] = '종료됨';
			}
		}

		$data['count_list'] = $ci->reserveModel->getCountByEiseqs($ei_seqs);	
		

		$data['list'] = &$list;

		$data['paging'] = &$paging;
	}

	function insertEvent(&$data, &$ci){
		$this->setInitData($data, $ci);
		$data['event'] = $ci->eventModel->getEmptyRow();

		$ci->addJS('/resource/js/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.js');
		$ci->addCss('/resource/js/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.css');
		return 'event/form';
	}

	function insertEventOk(&$data, &$ci){	
		$args = $ci->request->getAll();				
		if(!( $seq = $ci->eventModel->insertArgsByHiseq($args, $this->_info['hi_seq']) ) ){
			$data['msg'] = $ci->eventModel->error_message;		
		}else{
			if(array_key_exists('codes', $args) && count($args['codes']) > 0){
				foreach($args['codes'] as $k => $code){
					$ci->relationModel->insertCodeBySeq($code, $seq);			
				}
			}

			$data['msg'] = '등록되었습니다.';
			$data['sact'] = 'PR';			
		}
		
		return 'script';
	}

	function modifyEvent(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!$this->_canModify($seq, $ci)){
			$data['msg'] = '수정 권한이 없는 이벤트 입니다.';
			$data['sact'] = 'BACK';
			return 'script';
		}

		$this->setInitData($data, $ci);

		$event = $ci->eventModel->getRowBySeq($seq);	
		$ci->eventModel->DB2Form($event);

		$event['codes'] = $ci->relationModel->getListBySeq($event['ei_seq']);
		if(is_array($event['codes'])) $event['codes'] = array_keys($event['codes']);
		$data['event'] = &$event;

		$ci->addJS('/resource/js/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.js');
		$ci->addCss('/resource/js/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.css');
		return 'event/form';
	}

	function modifyEventOk(&$data, &$ci){
		$args = $ci->request->getAll();
		if(!$this->_canModify($args['ei_seq'], $ci)){
			$data['msg'] = '수정 권한이 없는 이벤트 입니다.';
			$data['sact'] = 'BACK';
			return 'script';
		}

		if(!$ci->eventModel->updateArgs($args) ){
			$data['msg'] = $ci->eventModel->error_message;			
		}else{
			$ci->relationModel->deleteCodesBySeq($args['ei_seq']);

			if(array_key_exists('codes', $args) && count($args['codes']) > 0){
				foreach($args['codes'] as $k => $code){
					$ci->relationModel->insertCodeBySeq($code, $args['ei_seq']);			
				}
			}

			$data['msg'] = '수정되었습니다.';
			$data['sact'] = 'PR';			
		}

		return 'script';
	}

	function deleteFile(&$data, &$ci){
		$type = $ci->request->param('type', METHOD_BOTH, false);
		$ei_seq = $ci->request->param('seq', METHOD_BOTH, false);

		if(!$this->_canModify($ei_seq, $ci)){
			$data['msg'] = '삭제권한이 없습니다.';
		}else{
			$ci->eventModel->deleteFile($ei_seq, $type);
			$data['msg'] = '삭제되었습니다.';
			$data['sact'] = 'PR';
		}

		return 'script';
	}

	function viewImage(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$data['event'] = $ci->eventModel->getRowBySeq($seq);
		$ci->eventModel->DB2Form($data['event']);
		
		$ci->setFrame('window');
		return 'event/image_viewer';
	}


	function setInitData(&$data, &$ci){
		$ci->load->model('Code/CodeModel', 'codeModel');
		$data['ages'] = $ci->codeModel->getListByCgCode('AGE');
		$data['hos_types'] = $ci->codeModel->getListByCgCode('TYP');
		$data['body_checkup'] = $ci->codeModel->getListByCgCode('i');
		$data['body_part'] = $this->_getBodyDetailParts($data['body_checkup']);
		$data['status'] = $ci->eventModel->getStatus();
	}

	private function _canModify($seq, &$ci){
		if(!is_numeric($seq)) return false;

		$event = $ci->eventModel->getRowBySeq($seq);
		if($event && ( $event['ei_hiseq'] == $this->_info['hi_seq']	) ) return $event;
		return false;
	}

	private function _getBodyDetailParts($types){
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


	function path2url($path, &$ci){
		if(!$ci->chk->hasText($path)) return '';
		else if(!is_file($path)) return '';
		$path = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($ci->_site_config['dir']['root'], '', $path));

		return $path;
	}
	
}
?>

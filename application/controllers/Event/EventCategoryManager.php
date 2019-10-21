<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventCategoryManager{

	function onInit(&$ci){
		$ci->load->model('Event/EventCategoryModel', 'categoryModel');
		$ci->load->model('Event/EventCategorySubModel', 'categoryModelSub');
	}

	function index(&$data, &$ci){
		$ci->load->library('paging');
		$paging = & $ci->paging;

		$paging->setOrder('eca_idx', 'desc');

		$paging_param = array(
				'table' => 'event_category',
				'cols' => '*'
			);
		$data['list'] = $ci->categoryModel->listPage($paging, $paging_param);
		$data['paging'] = &$paging;


		return 'event/list_category';
	}

	function insert(&$data, &$ci){
		$data['reply'] = array(
			'eca_idx'=>''
			,'eca_order'=>''
			,'eca_name'=>''
			,'eca_open_menu'=>''
		);
		$ci->setFrame('window');
		return 'event/list_category_form';
	}

	function insertOk(&$data, &$ci){
		$args = $ci->request->getAll();

		$ci->categoryModel->insertCategory($args);

		$data['msg'] = '저장되었습니다.';
		$data['sact'] = array('PR', 'POR');
		return 'script';
	}

	function modify(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!is_numeric($seq)){
			$data['msg'] = '잘못된 접근입니다.';
			return 'script';
		}

		$data['reply'] = $ci->categoryModel->getModify($seq);
		$ci->setFrame('window');
		return 'event/list_category_form';
	}

	function modifyOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$seq = $ci->request->param('seq', METHOD_POST, false);

		$ci->categoryModel->modifyBySeq($args, $seq);

		$data['msg'] = '수정되었습니다.';
		$data['sact'] = array('PR', 'POR');
		return 'script';
	}

	function deleteOk(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH);
		$ci->categoryModel->deleteBySeq($seq);

		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = array('PR');
		return 'script';

	}

}
?>

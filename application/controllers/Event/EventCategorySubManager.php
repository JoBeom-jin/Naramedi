<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventCategorySubManager{

	function onInit(&$ci){
		$ci->load->model('Event/EventCategoryModel', 'categoryModel');
		$ci->load->model('Event/EventCategorySubModel', 'categoryModelSub');
	}

	function index(&$data, &$ci){

		$data['category_arr'] = $ci->categoryModel->getNameArr();

		$ci->load->library('paging');
		$paging = & $ci->paging;

		$paging->setOrder('ecs_idx', 'desc');

		$paging_param = array(
				'table' => 'event_category_sub',
				'cols' => '*'
			);
		$data['list'] = $ci->categoryModel->listPage($paging, $paging_param);
		$data['paging'] = &$paging;


		return 'event/list_category_sub';
	}

	function insert(&$data, &$ci){

		$data['category_list'] = $ci->categoryModel->getList();

		$data['reply'] = array(
			'ecs_idx'=>''
			,'ecs_eca_idx'=>''
			,'ecs_order'=>''
			,'ecs_name'=>''
			,'ecs_open_menu'=>''
		);
		$ci->setFrame('window');
		return 'event/list_category_sub_form';
	}

	function insertOk(&$data, &$ci){
		$args = $ci->request->getAll();

		$rlt = $ci->categoryModelSub->insertCategory($args);

		if( $rlt == 'duplicate_order' ){
			$data['msg'] = '순서가 겹칩니다.';
		}
		else{
			$data['msg'] = '저장되었습니다.';
			$data['sact'] = array('PR', 'POR');
		}
		return 'script';

	}

	function modify(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!is_numeric($seq)){
			$data['msg'] = '잘못된 접근입니다.';
			return 'script';
		}

		$data['category_list'] = $ci->categoryModel->getList();

		$data['reply'] = $ci->categoryModelSub->getModify($seq);
		$ci->setFrame('window');
		return 'event/list_category_sub_form';
	}

	function modifyOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$seq = $ci->request->param('seq', METHOD_POST, false);

		$rlt = $ci->categoryModelSub->modifyBySeq($args, $seq);
		if( $rlt == 'duplicate_order' ){
			$data['msg'] = '순서가 겹칩니다.';
		}
		else{
			$data['msg'] = '수정되었습니다.';
			$data['sact'] = array('PR', 'POR');
		}
		return 'script';
	}

	function deleteOk(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH);
		$ci->categoryModelSub->deleteBySeq($seq);

		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = array('PR');
		return 'script';

	}

}
?>

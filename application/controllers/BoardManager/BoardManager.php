<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BoardManager{

	
	function onInit(&$ci){
		$ci->load->model('Board/BoardConfigModel', 'configModel');
		$ci->load->model('Board/BoardCategoryModel', 'categoryModel');
	}

	function index(&$data, &$ci){
		$data['list'] = $ci->configModel->listAll('*');
		
		return 'board/manager/list';
	}

	function createBoard(&$data, &$ci){
		$args = $ci->request->getAll();

		if($ci->configModel->insertInitArgs($args)){
			$data['msg'] = '정상적으로 등록되었습니다.';
			$data['sact'] = 'PR';
			
		}else{
			$data['msg'] = $ci->configModel->message;
		}
		
		return 'script';
	}

	function modifyBoardConfig(&$data, &$ci){
		$id = $ci->request->param('id', METHOD_GET, false);
		$data['view'] = $ci->configModel->getConfigById($id);

		$data['lock_flags'] = $ci->configModel->getLockFlags();
		$data['editor_flags'] = $ci->configModel->getEditorFlags();

		$ci->load->model('Members/AuthGroup', 'authgroup');
		$data['auth_groups'] = $ci->authgroup->listAll('*');

		$ci->setFrame('window');
		return 'board/manager/config_form';
	}

	function modifyBoardConfigOk(&$data, &$ci){
		$bc_id = $ci->request->param('bc_id', METHOD_POST, false);
		$args = $ci->request->getAll();
		if($ci->configModel->modifyArgsBySeq($args, $bc_id)){
			$data['msg'] = '정상적으로 수정되었습니다.';			
			$data['sact'] = array('POR', 'PR');
		}else{
			$data['msg'] = $ci->configModel->message;			
		}

		return 'script';
	}

	function createBoardCategory(&$data, &$ci){
		$bc_id = $data['bc_id'] = $ci->request->param('id', METHOD_GET, false);
		$data['list'] = $ci->categoryModel->getListByBcid($bc_id);

		$data['modify'] = false;
		$modify_seq = $ci->request->param('bdc_seq', METHOD_GET, false);
		if($modify_seq) $data['modify'] = $ci->categoryModel->getRowBySeq($modify_seq);			
		
		$ci->setFrame('window');
		return 'board/manager/category_form';
	}

	function updateBoardCategory(&$data, &$ci){
		$args = $ci->request->getAll();
		$bdc_seq = $ci->request->param('bdc_seq', METHOD_POST, false);
		
		if(!$bdc_seq){
			if($ci->categoryModel->insertArgs($args)){
				$data['msg'] = '정상적으로 등록되었습니다.';
				$data['sact'] = 'PR';			
			}else{
				$data['msg'] = $ci->categoryModel->message;
			}
		}else{

			if($ci->categoryModel->updateNameBySeq($args['bdc_name'], $bdc_seq)){
				$data['msg'] = '정상적으로 수정되었습니다.';
				$data['sact'] = 'PR';			
			}else{
				$data['msg'] = $ci->categoryModel->message;
			}

		}

		return 'script';		
	}


	function reSorting(&$data, &$ci){
		$bc_id = $ci->request->param('id', METHOD_GET, false);
		$bdc_seq = $ci->request->param('bdc_seq', METHOD_GET, false);
		$option = $ci->request->param('op', METHOD_GET, false);

		if($option == 'up') $result = $ci->categoryModel->positionUp($bc_id, $bdc_seq);
		else if($option == 'down') $result = $ci->categoryModel->positionDown($bc_id, $bdc_seq);

		if(!$result){
			$data['msg'] = $ci->categoryModel->message;			
		}else{
			$data['sact'] = 'PR';
		}			

		return 'script';
	}

	function deleteCategory(&$data, &$ci){
		$bdc_seq = $ci->request->param('bdc_seq', METHOD_GET, false);
		if($ci->categoryModel->deleteBySeq($bdc_seq)){
			$data['sact'] = 'PR';
			$data['msg'] = '삭제되었습니다.';			
		}else{
			$data['msg'] = $ci->categoryModel->message;
		}		
		return 'script';
	}
}
?>

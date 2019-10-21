<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventBanner{
	private $_upload_dir = false;
	
	function onInit(&$ci){		
		$ci->load->model('Event/EventBannerModel', 'bannerModel');		
		$this->_upload_dir  = $ci->bannerModel->upload_dir;
		$ci->load->helper('my_file');
	}
	
	function index(&$data, &$ci){	
		$ci->load->library('paging');
		$paging = &$ci->paging;
		$paging->addOrder('eb_sort', 'desc');
		
		$data['list'] = $ci->bannerModel->listPage($paging);
		$data['paging'] = &$paging;
		
		return 'banner/list';
	}

	function insertBanner(&$data, &$ci){
		$ci->setFrame('window');
		$data['banner'] = $ci->bannerModel->getEmptyRow();
		return 'banner/form';
	}

	function insertBannerOk(&$data, &$ci){
		$args = $ci->request->getAll();
		
		if(!hasText_($args['eb_subject'])){
			$data['msg'] = '제목을 입력해주세요.';
			return 'script';
		}

		$file_config = array(
			'upload_path'=> $this->_upload_dir,
			'allowed_types' => 'gif|jpg|png',
			'max_size' => 5120,
			'overwrite' => false,
			'encrypt_name' => true
		);

		$ci->load->library('upload', $file_config);
		
		$ci->upload->do_upload('upload');
		$data['msg'] = $ci->upload->display_errors('', '');
		if($data['msg']) return 'script';
		
		$upload = $ci->upload->data();
		$args['eb_file_path'] =  $upload['full_path'];		
		
		$ci->bannerModel->insertArgs($args);

		$data['msg'] = '정상적으로 등록되었습니다.';
		$data['sact'] = array('POR', 'PCLZ');
		return 'script';
	}

	function updateBanner(&$data, &$ci){
		$seq = $data['eb_seq'] = $ci->request->param('seq', METHOD_BOTH, false);
		if(!$seq) show_error('잘못된 접근 방식 입니다.');

		$ci->setFrame('window');
		$data['banner'] = $ci->bannerModel->getRowBySeq($seq);
		return 'banner/form';
	}

	function updateBannerOk(&$data, &$ci){
		$seq = $data['eb_seq'] = $ci->request->param('eb_seq', METHOD_BOTH, false);
		if(!$seq) show_error('잘못된 접근 방식 입니다.');

		$args = $ci->request->getAll();

		if(!hasText_($args['eb_subject'])){
			$data['msg'] = '제목을 입력해주세요.';
			return 'script';
		}

		if($_FILES['upload']['error'] === 0){
			$file_config = array(
				'upload_path'=> $this->_upload_dir,
				'allowed_types' => 'gif|jpg|png',
				'max_size' => 5120,
				'overwrite' => false,
				'encrypt_name' => true
			);

			$ci->load->library('upload', $file_config);
			$ci->upload->do_upload('upload');
			$data['msg'] = $ci->upload->display_errors('', '');
			if($data['msg']) return 'script';

			$upload = $ci->upload->data();
			$args['eb_file_path'] =  $upload['full_path'];	
		}


		$ci->bannerModel->updateArgsBySeq($args, $seq);

		$data['msg'] = '정상적으로 수정되었습니다.';
		$data['sact'] = array('POR', 'PCLZ');
		return 'script';		

		
	}

	function deleteBanner(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!$seq) show_error('잘못된 접근 방식입니다.');
		
		$ci->bannerModel->deleteBySeq($seq);
		
		$data['sact'] = 'PR';
		$data['msg'] = '삭제되었습니다.';
		return 'script';
	}

	function deleteImage(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!$seq) show_error('잘못된 접근 방식입니다.');

		$ci->bannerModel->deleteImageBySeq($seq);
		$data['sact'] = array('PR', 'POR');
		$data['msg'] = '삭제되었습니다.';
		return 'script';
	}
	
}
?>
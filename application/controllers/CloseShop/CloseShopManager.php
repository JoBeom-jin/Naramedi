<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CloseShopManager{

	private $_file_config = false;

	function onInit(&$ci){
		$ci->load->model('CloseShop/CloseShopModel', 'shopModel');
		$ci->load->model('CloseShop/CloseShopGroupsModel', 'shopModelGroups');
		$ci->load->model('Members/members', 'members');
		$ci->load->model('Members/MemberGroup', 'memberGroup');

		$this->_file_config = array(
			'upload_path' => $ci->_site_config['dir']['upload'].DIRECTORY_SEPARATOR.'closeShop',
			'allowed_types' => 'gif|jpg|png|jpeg',
			'max_size' => 3000,
			'max_width' => 0,
			'max_height' => 0,
			'max_filename' => 255,
			'encrypt_name' => true,
			'remove_spaces' => true,
		);

		$ci->load->helper('my_file');
	}

	function index(&$data, &$ci){
		$ci->load->library('paging');
		$paging = &$ci->paging;

		$paging->addOrder('cs_seq', 'desc');
		$data['list'] = $ci->shopModel->listPage($paging);
		$data['paging'] = &$paging;

		return 'closed_shop/list.php';
	}

	function insertShop(&$data, &$ci){
		$data['shop'] = $ci->shopModel->getEmptyRow();

		$data['CMManagerList'] = $this->getCMMlist($ci);
		$data['inCMManagerList'] = array();

		$ci->addJs($data['_site_config']['url']['resource'].'/js/jquery/jquery-1.12.3.min.js');
		$ci->addJs($data['_site_config']['url']['resource'].'/js/jquery/lib/movingselect.js');

		$ci->setFrame('window');
		return 'closed_shop/form.php';
	}

	function insertShopOk(&$data, &$ci){
		$subject = $ci->request->param('cs_name', METHOD_POST, false);
		$gets = $ci->request->getAll();

		if(!hasText_($subject)){
			$data['msg'] = '폐쇄몰 업체명은 반드시 입력하셔야 합니다.';
			return 'script';
		}


		$ci->load->library('upload', $this->_file_config);
		$ci->upload->do_upload('upload');

		$data['msg'] = $ci->upload->display_errors('', '');
		if($data['msg']) return 'script';

		$upload = $ci->upload->data();
		$args['cs_seq'] = $ci->shopModel->getMaxValue()+1;
		$args['cs_name'] = $subject;
		$args['cs_file_path'] =  $upload['full_path'];

		$ci->shopModel->insertArgs($args);

		if(isset($gets['groups'])){
			$ci->shopModelGroups->updateGroup($args['cs_seq'], $gets['groups']);
		}

		$data['msg'] = '정상적으로 등록되었습니다.';
		$data['sact'] = array('POR', 'PCLZ');
		return 'script';
	}

	function updateShop(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!is_numeric($seq)) show_error('정상적인 접근 방식이 아닙니다.');

		$data['shop'] = $ci->shopModel->getRowBySeq($seq);

		$data['CMManagerList'] = $this->getCMMlist($ci);
		$data['inCMManagerList'] = array();
		foreach($ci->shopModelGroups->listByCsseq($seq) as $tk=>$tv){
			$data['inCMManagerList'] []= $tv['csg_meseq'];
		}
		// print_r($data['CMManagerList']);
		// print_r($data['inCMManagerList']);

		$ci->addJs($data['_site_config']['url']['resource'].'/js/jquery/jquery-1.12.3.min.js');
		$ci->addJs($data['_site_config']['url']['resource'].'/js/jquery/lib/movingselect.js');

		$ci->setFrame('window');
		return 'closed_shop/form.php';
	}

	function updateShopOk(&$data, &$ci){
		$args = $ci->request->getAll();

		if(!hasText_($args['cs_name'])){
			$data['msg'] = '폐쇄몰 업체명은 반드시 입력하셔야 합니다.';
			return 'script';
		}

		if(isset($args['groups'])){
			$ci->shopModelGroups->updateGroup($args['cs_seq'], $args['groups']);
		}
		else{
			$ci->shopModelGroups->deleteByCsseq($args['cs_seq']);
		}

		if($_FILES['upload']['error'] === 0){
			$ci->load->library('upload', $this->_file_config);
			$ci->upload->do_upload('upload');

			$data['msg'] = $ci->upload->display_errors('', '');
			if($data['msg']) return 'script';

			$upload = $ci->upload->data();
			$args['cs_file_path'] =  $upload['full_path'];
		}

		$where = array('cs_seq' => $args['cs_seq']);
		$ci->shopModel->update($args, $where);

		$data['msg'] = '정상적으로 수정되었습니다.';
		$data['sact'] = array('POR', 'PCLZ');
		return 'script';
	}


	function deleteShop(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$ci->shopModel->deleteBySeq($seq);
		$ci->shopModelGroups->deleteByCsseq($seq);

		$data['msg'] ='삭제되었습니다.';
		$data['sact'] ='PR';
		return 'script';
	}

	function deleteImage(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		if(!is_numeric($seq)) show_error('잘못된 접근입니다.');
		$row = $ci->shopModel->getRowBySeq($seq);

		if(is_file($row['cs_file_path'])) @unlink($row['cs_file_path']);

		$args['cs_file_path'] = '';
		$where = array('cs_seq' => $seq);
		$ci->shopModel->update($args, $where);

		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = array('PR', 'POR');
		return 'script';
	}

	function getCMMlist(&$ci){
		$CMGroupList = $ci->memberGroup->listByGroup('CLOSEMALL');
		$CMManagerList = array();

		foreach($CMGroupList as $tk=>$tv){
			$tmp1 = $ci->members->getMemberBySeq($tv['mg_meseq']);
			$CMManagerList[$tmp1['me_seq']] = $tmp1['me_name'];
		}

		return $CMManagerList;
	}

}
?>

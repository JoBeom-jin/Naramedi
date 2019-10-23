<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
* 한신 메디피아 페이지 ( http://hsmedipia.com/one_page_web.html )에서 
* 릴레이 켐페인을 통해 등록된 유저 목록 관리
*/

class HansinUsersCustom{

	
	function onInit(&$ci){
		$ci->load->model('Hansin/HansinUserModelCustom', 'userModel');
	}

	/*
	* 목록 페이지
	*/
	function index(&$data, &$ci){
		$ci->load->library('paging');
		$paging = &$ci->paging;

		$paging->addOrder('hu_seq', 'desc');
		$data['list'] = $ci->userModel->listPage($paging);
		$data['paging'] = &$paging;	
		$data['types'] = $ci->userModel->getTypes();
		

		return  'Hansin/newyear';
	}	

	/*
	* 정보 삭제
	*/
	function deleteOk(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_GET, false);
		$ci->userModel->deleteBySeq($seq);

		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = 'PR';
		return 'script';
	}
}
?>

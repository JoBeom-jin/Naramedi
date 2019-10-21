<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class codeManager{
	
	function onInit(&$ci){
		$ci->load->model('Code/CodeGroupModel', 'groupModel');
		$ci->load->model('Code/CodeModel', 'codeModel');
	}

	/*
	* 코드 그룹 목록 표시
	* 코드그룹 PK가 넘어올 경우 해당 코드 목록 출력
	*/
	function index(&$data, &$ci){
		$data['group_list'] = $ci->groupModel->getListAll();
		$data['cg_code'] = $code_group = $ci->request->param('cg_code', METHOD_BOTH, false);

		if($ci->chk->hasText($code_group)){
			$data['group_info'] = $ci->groupModel->getGroupByCode($code_group);
			$data['code_list'] = $ci->codeModel->getListByCgCode($code_group);
		}

		return 'code/list';
	}


	/*
	* 신규 코드 그룹 등록
	*/
	function insertGroup(&$data, &$ci){
		$data['group_info'] = $ci->groupModel->getEmptyRow();

		return 'code/code_group_form';
	}


	/*
	* 신규 코드 그룹 등록 Ok 
	*/
	function insertGroupOk(&$data, &$ci){
		$args = $ci->request->getAll();
		if($ci->groupModel->insertArgs($args)){
			$data['msg'] = '등록되었습니다.';
			$data['sact'] = 'PR';
		}else{
			$data['msg']= $ci->groupModel->error_message;
		}

		return 'script';
	}


	/*
	* 신규 코드 등록 폼
	*/
	function insertCode(&$data, &$ci){
		if(!( $cg_code = $ci->request->param('cg_code', METHOD_BOTH, false)) ){
			$data['msg'] = '정상적인 접근 방식이 아닙니다.';
			$data['sact'] = 'SCLZ';
			return 'script';
		}

		$data['group_info'] = $ci->groupModel->getGroupByCode($cg_code);
		if($data['group_info']['cg_code'] != $cg_code){
			$data['msg'] = '정상적인 접근 방식이 아닙니다.';
			$data['sact'] = 'SCLZ';
			return 'script';
		}

		$data['code_info'] = $ci->codeModel->getEmptyRow();
		$ci->setFrame('window');
		return 'code/code_form';
	}

	/*
	* 신규 코드 등록 
	*/
	function insertCodeOk(&$data, &$ci){
		$args = $ci->request->getAll();

		if(!$ci->codeModel->insertCode($args)){
			$data['msg'] = $ci->codeModel->error_message;
			return 'script';
		}

		$data['sact'] = array('PR', 'POR');
		$data['msg'] = '등록되었습니다.';
		return 'script';
	}

	/*
	* 기존 코드 수정 폼
	*/
	function modifyCode(&$data, &$ci){

		$code = $ci->request->param('code', METHOD_BOTH, false);

		if(!$ci->chk->hasText($code) ){
			$data['msg'] = '정상적인 접근 방식이 아닙니다.';
			$data['sact'] = 'SCLZ';
			return 'script';
		}

		$cg_code = substr($code, 0, 1);
		if(!$ci->chk->hasText($cg_code) ){
			$data['msg'] = '정상적인 접근 방식이 아닙니다.';
			$data['sact'] = 'SCLZ';
			return 'script';
		}

		$data['group_info'] = $ci->groupModel->getGroupByCode($cg_code);		
		$data['code_info'] = $ci->codeModel->getCodeByCode($code);
		$data['code_info']['cd_code'] = substr($data['code_info']['cd_code'], 1,3);

		$ci->setFrame('window');
		return 'code/code_form';
	}

	/*
	* 기존 코드 수정 완료
	*/
	function modifyCodeOk(&$data, &$ci){
		$args = $ci->request->getAll();

		if(!$ci->codeModel->updateCodeByCode($args, $args['cg_code'].$args['cd_code'])){
			$data['msg'] = $this->codeModel->error_message;			
		}else{
			$data['msg'] = '수정되었습니다.';
			$data['sact'] = array('PR', 'POR');
		}

		return 'script';
	}

	/*
	* 기존 코드 삭제
	*/
	function deleteCode(&$data, &$ci){
		$code = $ci->request->param('code', METHOD_BOTH, false);
		$ci->codeModel->deleteCodeByCode($code);

		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = 'PR';
		return 'script';
	}

	/*
	* 그룹 수정
	*/
	function modifyGroup(&$data, &$ci){
		$cg_code = $ci->request->param('cg_code', METHOD_BOTH, false);
		if(!$ci->chk->hasText($cg_code) ){
			$data['msg'] = '정상적인 접근 방식이 아닙니다.';
			$data['sact'] = 'BACK';
			return 'script';
		}


		$data['group_info'] = $ci->groupModel->getGroupByCode($cg_code);

		return 'code/code_group_form';
	}

	/*
	* 그룹 수정 완료
	*/
	function modifyGroupOk(&$data, &$ci){
		$cg_code = $ci->request->param('cg_code', METHOD_BOTH, false);
		$args = $ci->request->getAll();

		if(!$ci->groupModel->updateCodeGroupByCode($args, $cg_code)){
			$data['msg'] = $ci->groupModel->error_message;
		}else{
			$data['msg'] = '수정되었습니다.';
			$data['sact'] = array('PR', 'POR');			
		}

		return 'script';
	}

	/*
	* 그룹 전체 삭제
	*/
	function deleteGroup(&$data, &$ci){
		$cg_code = $ci->request->param('cg_code', METHOD_BOTH, false);
		$ci->groupModel->deleteGroupByCode($cg_code);
		
		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = 'PR';
		
		return 'script';
	}

	/*
	* 정렬 순서 변경 : 바로 위로 이동
	*/
	function upCode(&$data, &$ci){
		$code = $ci->request->param('code', METHOD_BOTH, false);
		
		if(!$ci->codeModel->upCode($code)){
			$data['msg'] = $ci->codeModel->error_message;
		}else{
			$data['sact'] = 'PR';
		}

		return 'script';		
	}

	function downCode(&$data, &$ci){
		$code = $ci->request->param('code', METHOD_BOTH, false);


		if(!$ci->codeModel->downCode($code)){
			$data['msg'] = $ci->codeModel->error_message;
		}else{
			$data['sact'] = 'PR';
		}

		return 'script';

	}


}
?>

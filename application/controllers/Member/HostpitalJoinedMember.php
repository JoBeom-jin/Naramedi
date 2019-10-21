<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HostpitalJoinedMember{

	private $_user_code = 'HOSPITAL';
	
	function onInit(&$ci){
		$ci->load->model('Members/MemberGroup', 'member_groupModel');
		$ci->load->model('Members/Members', 'memberModel');	
		$ci->load->model('Members/Hospital', 'hospitalModel');
		$ci->load->model('Members/HospitalFileModel', 'fileModel');
		$ci->load->model('Code/CodeModel', 'codeModel');
	}

	function index(&$data, &$ci){
		$data['member_list'] = $ci->hospitalModel->listAllByGrid($this->_user_code, 'Y');
		
		return 'Member/hospital_member_joined_list';
	}

	function view(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_GET, false);
		$data['member'] = $ci->hospitalModel->getFullInfoByMeseq($seq, $this->_user_code, 'Y');
		$data['member']['image'] = $ci->fileModel->getImageByHiseq($data['member']['hi_seq']);
		$data['hi_types'] = $ci->codeModel->getListByCgCode('HOS');

		if(!$data['member']['hi_type']) $data['member']['hi_type'] = 'HOS001';
		

		$ci->setFrame('window');
		return 'Member/hospital_member_joined_view';
	}

	function modify(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$data['member'] = $ci->hospitalModel->getFullInfoByMeseq($seq, $this->_user_code, 'Y');	
		$data['hi_types'] = $ci->codeModel->getListByCgCode('HOS');

		if(!$data['member']){
			$data['msg'] = '사용자 정보를 찾을 수 없습니다.';
			$data['sact'] = 'SCLZ';
			return 'script';
		}

		$data['member']['image'] = $ci->fileModel->getImageByHiseq($data['member']['hi_seq']);

		$ci->setFrame('window');

		//BIZCALL
		$ci->load->library('Bizcall');
		$data['bizcall'] = false;

		if(!$data['member']['hi_system_phone']){
			//할당된 전화번호가 없는경우						
			if($data['member']['ai_phone']){
				$phone_number = preg_replace("/[^0-9]*/s", "", $data['member']['ai_phone']);
				$data['bizcall'] = $ci->bizcall->getAuthData( $phone_number, 'set_number');
			}
		}else{
			//할당된 전화번호가 있는경우
			$data['bizcall'] = $ci->bizcall->getAuthData($data['member']['hi_system_phone'], 'remove_number');			
		}

//		//최초 등록일 경우 기본 세팅
//		$flag = $data['first_flag'] = $ci->request->param('first_flag', METHOD_POST, false);	
//
//		if($flag == 'Y' && $data['member']['hi_system_phone']){
//			$data['set_bizcall'] = $ci->bizcall->getSetConfigData($data['member']['hi_system_phone'], $data['member']['hi_revmng_phone'], 'set_config');		
//		}


		return 'Member/hospital_member_joined_form';
	}

	function cancelPhone(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$hospital_info = $ci->hospitalModel->getRowBySeq($seq);
		$system_phone_number = $hospital_info['hi_system_phone'];
		if(!is_numeric($system_phone_number)){
			$data['msg'] = '할당된 전화번호가 없습니다.';
			return 'script';
		}

		$ci->load->library('Bizcall');		
		$res = $ci->bizcall->cancel($system_phone_number);
		
		if($res != 'SUCCESS'){		
			$data['msg'] = '050 번호 할당 취소에 실패하였습니다.\n프로그램 관리자에게 문의하세요.';			
		}else{
			$ci->hospitalModel->cancelSystemPhone($seq);
			$data['msg'] = '취소되었습니다.';
			$data['sact'] = 'PR';
		}
		
		return 'script';
	}

	function insertPhone(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$hospital_info = $ci->hospitalModel->getRowBySeq($seq);
		$system_phone_number = $hospital_info['hi_system_phone'];
		$ai_phone =  preg_replace("/[^0-9]/", "", $hospital_info['ai_phone']);
		if(is_numeric($system_phone_number)){
			$data['msg'] = '이미 할당된 전화번호가 있습니다.';
			return 'script';
		}else if(!is_numeric($ai_phone)){
			$data['msg'] = '기관 전화번호가 잘못되었습니다.';
			return 'script';
		}
			

		$ci->load->library('Bizcall');		
		$res = $ci->bizcall->mappingNumber($ai_phone, 'set_number', $hospital_info['hi_seq']);
		$result = json_decode($res);

		if($result->rs != 'SUCCESS'){
			$data['msg'] = '번호 할당 중 오류가 발생하였습니다. 개발관리자에게 문의하세요.';
			return 'script';
		}else{
			$system = $result->vn;
			$ci->hospitalModel->updatePhonebySeq($system, $seq);
			$data['msg'] = '번호가 할당되었습니다.';
			$data['sact'] = 'PR';
			return 'script';
		}
	}

	function modifyOk(&$data, &$ci){
		$msg = false;
		$args = $ci->request->getAll();
		$args['hi_active'] = 'Y';		

		$org_number = $ci->hospitalModel->getOrgNumberBySeq($args['hi_seq']);
		$ci->load->model('Agency/AgencyModel', 'agencyModel');

		if(!$ci->agencyModel->existAgencyByNumber($org_number)){
			$msg = '등록되지 않은 검진기관 번호입니다.';
		}
				
		if(!$msg) $msg = $ci->hospitalModel->updateArgsByHiseq($args, $args['hi_seq'], false);

		if(!$msg){
			$msg = '정상적으로 수정되었습니다.';
			$data['sact'] = array('POR', 'PCLZ');
		}

		$data['msg'] = $msg;

		$ci->setFrame('noframe');
		$data['sact'] = array('POR', 'PR');
		return 'script';
	}

	function deleteOk(&$data, &$ci){
		$_HospitalController = & $ci->getController('Member_HospitalMember');

		$html = $_HospitalController->deleteOk($data, $ci);
		$data['sact'] = array('POR', 'PCLZ');
		return $html;
	}
	
}
?>

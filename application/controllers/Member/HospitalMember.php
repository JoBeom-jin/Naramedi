<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HospitalMember{

	private $_user_code = 'HOSPITAL';
	
	function onInit(&$ci){
		$ci->load->model('Members/MemberGroup', 'member_groupModel');
		$ci->load->model('Members/Members', 'memberModel');	
		$ci->load->model('Members/Hospital', 'hospitalModel');
		$ci->load->model('Members/HospitalFileModel', 'fileModel');
	}

	function index(&$data, &$ci){
		$data['member_list'] = $ci->hospitalModel->listAllByGrid($this->_user_code, 'N');
		
		return 'Member/hospital_list';
	}

	function insertMember(&$data, &$ci){
		$member = $ci->memberModel->getEmptyRow();
		$hospital = $ci->hospitalModel->getEmptyRow();	
		$data['member'] = array_merge($member, $hospital);
		$ci->setFrame('window');
		return 'Member/hospital_form';
	}

	function insertMemberOk(&$data, &$ci){
		$msg = false;
		$args = $ci->request->getAll(METHOD_POST);
		$msg = $ci->memberModel->checkInsertParam($args);
		if(!$msg) $msg = $ci->hospitalModel->checkInsertParam($args);
		
		$upload = array('full_path'=>false);
		if(!$msg) $msg = $ci->fileModel->checkInsertParam('business_file', $upload);

		if($ci->chk->hasText($msg)){
			if($upload['full_path'] && is_file($upload['full_path'])) @unlink($upload['full_path']);
			$data['msg'] = $msg;
			return 'script';
		}

		$me_seq = $ci->memberModel->insertMemberGetSeq($args);
		$ci->member_groupModel->insertGroup($me_seq, array($this->_user_code));
		$hi_seq = $ci->hospitalModel->insertArgsGetSeq($args, $me_seq);
		if($upload) $ci->fileModel->insertUpload($upload, $hi_seq);
		$data['msg'] = '정상적으로 등록되었습니다.';								
		$data['sact'] = array('PR', 'POR');
		return 'script';		
	}

	function modify(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$data['member'] = $ci->hospitalModel->getFullInfoByMeseq($seq, $this->_user_code, 'N');		

		if(!$data['member']){
			$data['msg'] = '사용자 정보를 찾을 수 없습니다.';
			$data['sact'] = 'SCLZ';
			return 'script';
		}

		$data['member']['image'] = $ci->fileModel->getImageByHiseq($data['member']['hi_seq']);

		$ci->load->library('Bizcall');
		$data['bizcall'] = false;
		$data['bizcall'] = $ci->bizcall->getAuthData($data['member']['hi_system_phone'], 'remove_number');			

		$ci->setFrame('window');
		return 'Member/hospital_form';
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

		if($ci->hospitalModel->existActive($org_number, true)){
			$msg = '해당 검진기관 정보에는 이미 관리자가 할당되어 있습니다.';
		}	

		if(!is_numeric($args['hi_revmng_phone'])){
			$data['msg'] = '전화번호에는 숫자만 입력해주세요.';
			return 'script';
		}


		$agency = $ci->agencyModel->getRowByNumber($org_number);
		$biz_call_mapping_phone = $agency['ai_phone'];

		if($biz_call_mapping_phone){
			$biz_call_mapping_phone = preg_replace("/[^0-9]/", "", $agency['ai_phone']);
			//BIZCALL
			$ci->load->library('Bizcall');
			if($biz_call_mapping_phone && is_numeric($biz_call_mapping_phone)){
				$bizcall = $ci->bizcall->mappingNumber($biz_call_mapping_phone, 'set_number', $args['hi_seq']);
				$bizcall = json_decode($bizcall);
				if($bizcall->rs == 'SUCCESS'){						
					$args['hi_system_phone']  = $bizcall->vn;					
				}
			}
		}		
				
		if(!$msg) $msg = $ci->hospitalModel->updateArgsByHiseq($args, $args['hi_seq'], false);

		if(!$msg){
			$msg = '정상적으로 적용되었습니다.';
			$data['sact'] = array('POR', 'PCLZ');
		}

		$data['msg'] = $msg;

		$ci->setFrame('noframe');
		return 'script';
	}

	function deleteOk(&$data, &$ci){
		$me_seq = $ci->request->param('seq', METHOD_GET, false);
		$member = $ci->memberModel->getMemberBySeq($me_seq);
		if(!$ci->chk->hasArrayValue('me_seq', $member) || $member['me_seq'] !== $me_seq){
			$data['msg'] = '정보를 찾을 수 없습니다.';			
			return 'script';
		}		

		$ci->memberModel->deleteByMeSeq($me_seq);
		$ci->member_groupModel->deleteByMember($me_seq);
		$hi_seq = $ci->hospitalModel->getSeqByMeseq($me_seq);
		$ci->hospitalModel->deleteByMeseq($me_seq);
		$ci->fileModel->deleteByHiseq($hi_seq);

		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = array('POR', 'PCLZ');
		return 'script';
	}


	
}
?>

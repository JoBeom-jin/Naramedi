<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyHospitalInfo{

	private $_user_code = 'HOSPITAL';
	
	function onInit(&$ci){
		$ci->load->model('Members/MemberGroup', 'member_groupModel');
		$ci->load->model('Members/Members', 'memberModel');	
		$ci->load->model('Members/Hospital', 'hospitalModel');
		$ci->load->model('Members/HospitalFileModel', 'fileModel');

		$ci->load->model('Agency/AgencyModel', 'AgencyModel');
		$ci->load->model('Agency/AgencyImageModel', 'imageModel');
		$ci->load->model('Agency/AgencyParkModel', 'ParkModel');
		$ci->load->model('Agency/AgencyTrafficModel', 'TrafficModel');
		$ci->load->model('Agency/AgencyImageModel', 'imageModel');
	}

	/*
	* 병원 정보 관리 > 병원정보 관리
	*/
	function index(&$data, &$ci){		
		$hi_org_number = $data['_info']['hi_org_number'];

		$info = $ci->hospitalModel->getAllInfoByNumberMeseq($hi_org_number, $ci->auth->seq() );		

		$ci->AgencyModel->setTimeByRow($info);
		$data['modify'] = &$info;
//		$data['modify']['images'] = $ci->fileModel->getImageByHiseq($data['modify']['hi_seq']);
		$data['file_list'] = $ci->imageModel->getListByAiseq($info['ai_seq']);

		$data['times'] = range(1, 24);
		$data['minuets'] = range(0, 59);


		return 'info_manager/hospitalinfo';
	}

	/*
	* 병원 정보 관리 > 수정 확인
	*/
	
	function modifyOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$ai_number = $data['_info']['hi_org_number'];

		$ai_seq = $ci->AgencyModel->getSeqByAinumber($ai_number);				
		$msg = $ci->AgencyModel->updateByNumber($args, $ai_number);		

		if(!$msg){
			$ci->ParkModel->updateArgsByAiSeq($args, $ai_seq);
			$ci->TrafficModel->updateArgsByAiSeq($args, $ai_seq);
		}

		if($msg) $data['msg'] = $msg;
		else{
			$data['msg'] = '정상적으로 수정되었습니다.';
			$data['sact'] = 'PR';			
		}

		return 'script';
	}

	function deleteImage(&$data, &$ci){
		$seq = $ci->request->param('fseq', METHOD_GET, false);
		

		$ci->imageModel->deleteAllBySeq($seq);

		$data['msg'] = '정상적으로 삭제되었습니다.';
		$data['sact'] = 'PR';

		return 'script';
	}


	function modifyFileOK(&$data, &$ci){
		$msg = false;

		
		$file_config = $ci->imageModel->getFileConfig();
		$ci->load->library('FileUpload', $file_config);
		$ci->fileupload->do_multi_upload('upload');		
		
		if($ci->fileupload->hasError()){
			$ci->fileupload->rollback();
			$errors = $ci->fileupload->getErrors();
			$data['msg'] = '파일 업로드 중 다음과 같은 문제가 발생하였습니다.\n'.implode('\n', $errors);						
		}else{
			$ai_seq = $ci->request->param('seq', METHOD_POST, false);
			$file_data_list = $ci->fileupload->data();
			$ci->imageModel->insertFileListByAiseq($file_data_list, $ai_seq);
			$data['msg'] = '정상적으로 등록되었습니다.';
			$data['sact']= 'PR';
		}

		return 'script';
	}
	
}
?>

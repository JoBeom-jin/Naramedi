<?
class HospitalMyInfo{

	private $_user_code = false;

	private $_meseq = false;
	private $_info = false;				//information of hospital

	function onInit(&$ci){
		$ci->load->model('Members/MemberGroup', 'member_groupModel');
		$ci->load->model('Members/Members', 'memberModel');	
		$ci->load->model('Members/Hospital', 'hospitalModel');
		$ci->load->model('Members/HospitalFileModel', 'fileModel');
		$this->_user_code = 'HOSPITAL';

		$this->_meseq = $ci->auth->seq();
		$this->_info = $ci->hospitalModel->getInfoByMeseq($this->_meseq);
	}

	function index(&$data, &$ci){
		$data['member'] = &$this->_info;
		$data['myid'] = $ci->auth->id();
		$data['myname'] = $ci->auth->name();
		$data['member']['image'] = $ci->fileModel->getImageByHiseq($this->_info['hi_seq']);

		return '/info_manager/myinfo';
	}

	function modifyOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$error_msg = $ci->hospitalModel->updateArgsByHiseq($args, $this->_info['hi_seq'], false);


		if(!$error_msg && $ci->chk->hasText($args['me_pass'])){
			if($args['me_pass'] == $args['me_pass_check']){
				$error_msg = $ci->memberModel->changePasswordByMeseq($args['me_pass'], $this->_info['hi_meseq']);
			}else{
				$error_msg = '비밀번호와 비밀번호 확인이 다릅니다. 다시 확인하고 시도해주세요.';
			}

			if($error_msg){
				$data['msg'] = $error_msg;
				return 'script';
			}
		}		

		if( count($_FILES) > 0 && $_FILES['upload']['error'] === 0){			
			$ci->upload->do_upload('upload');
			$msg = $ci->upload->display_errors('', '');
			if(strlen($msg) > 0){
				$error_msg = '파일 업로드 중 오류가 발생하여 사업자 등록증이 등록되지 못하였습니다.\n'.$msg;
			}else{
				$upload = $ci->upload->data();
				$ci->fileModel->insertUpload($upload, $this->_info['hi_seq']);
			}

			if($error_msg){
				$data['msg'] = $error_msg;
				return 'script';
			}
		}

		if(!$error_msg){
			$data['msg'] = '수정되었습니다.';
			$data['sact'] = 'PR';
		}else $data['msg'] = $error_msg;
		return 'script';
	}

	/*
	* 병원 정보 관리 > 계정관리에 등록된 사업자등록증 이미지 파일 삭제
	*/
	function deleteFile(&$data, &$ci){
		$hi_seq = $this->_info['hi_seq'];
		$ci->fileModel->deleteByHiseq($hi_seq);
		$data['sact'] = 'PR';
		$data['msg'] = '삭제되었습니다.';
		return 'script';
	}
}
?>
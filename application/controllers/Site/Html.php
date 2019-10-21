<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Html{

	function onInit(&$ci){		
	}

	function index(&$data, &$ci){
		$action = $ci->getMenuParams('do');
		$action = 'do'.ucfirst($action);

		return $this->$action($data, $ci);
	}

	function doIntro(&$data, &$ci){
		return 'site/intro';
	}

	function doTerms(&$data, &$ci){
		$window = $ci->request->param('win', METHOD_BOTH, false);
		if($window == 'Y'){
			$ci->setFrame('window');
		}

		return 'site/terms';			

	}

	function doPersonal(&$data, &$ci){
		$window = $ci->request->param('win', METHOD_BOTH, false);
		if($window == 'Y'){
			$ci->setFrame('window');
		}
		return 'site/personal';
	}


	function doGuide(&$data, &$ci){
		$ci->load->model('User/Question', 'questionModel');
		$data['list'] = array();
		if($ci->auth->isLogin()){
			$me_id = $ci->auth->id();
			$data['list'] = $ci->questionModel->listAllByMeseq($me_id);
			$uq_seq = $ci->request->param('seq', METHOD_BOTH, false);
			$data['detail'] = false;
			$detail = $ci->questionModel->getRowBySeqMeid($uq_seq, $me_id);
			if($detail && array_key_exists('uq_meid', $detail) && $detail['uq_meid'] = $me_id){
				$data['detail'] = $detail;
			}
		}

		
		return 'site/guide';
	}

	function questionOk(&$data, &$ci){
		$args = $ci->request->getAll();	

		if(!$ci->auth->isLogin()){
			$data['msg'] = '로그인 사용자만 사용하실 수 있습니다.';
		}else if(!$args['uq_subject']){
			$data['msg'] = '제목은 반드시 입력하셔야 합니다.';
		}else if(!$args['uq_question']){
			$data['msg'] = '문의 내용은 반드시 입력하셔야 합니다.';
		}else{
			$ci->load->model('User/Question', 'questionModel');
			$args['uq_meid'] = $ci->auth->id();
			$args['uq_ctime'] = time();
			$args['uq_subject'] = strip_tags($args['uq_subject']);
			$args['uq_question'] = strip_tags($args['uq_question']);

			$ci->questionModel->insertRow($args);

			$data['msg'] = '1:1 상담내용이 접수되었습니다. 빠른 시간 내에 답변드릴 수 있도록 하겠습니다. 감사합니다. ';
			$data['back_url'] = '/index.php/medical/contents/etc_gcenter#questionOk';
			$data['sact'] = 'PGOTO';
		}

		return 'script';		
	}

}
?>

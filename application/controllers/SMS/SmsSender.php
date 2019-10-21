<?
class SMsSender{
	private $_templates = array();
	function onInit(&$ci){
		$ci->load->model('Sms/MessageModel', 'smsModel');
		
	}

	function index(&$data, &$ci){
		$tables = $data['tables'] =  $this->getLogTables($ci);
		$select = $data['select'] = $ci->request->param('select', METHOD_BOTH, false);
		if(!$select) $select = $tables[0];	
		
		$data['list'] = $this->getLogListFromTable($ci, $select);
		
		return 'sms/errors';
	}

	function msgList(&$data, &$ci){
		$ci->load->library('paging');
		$paging = &$ci->paging;
		
		$paging->addOrder('Msg_Id', 'desc');
		$data['list'] = $ci->smsModel->listPage($paging);
		return 'sms/list';
	}


	function testSMS(&$data, &$ci){
		$data['tempaltes'] = $this->_templates;

		
		return 'sms/sms_test';
	}

	function testSMSOk(&$data, &$ci){
		$args = $ci->request->getAll();

		if(array_key_exists('reserve', $args) && $args['reserve'] == 'y'){
			$ci->smsModel->sendSMS($args, false);
		}else{
			$ci->smsModel->sendSMS($args, true);
		}

		if($msg = $ci->smsModel->_error_msg){
			$data['msg'] = $msg;
		}else{
			$data['msg'] = 'SMS 전송 요청되었습니다.';
		}

		return 'script';
	}

	function AlimTalkOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$template_key = $this->_templates[$args['template']]['key'];
		//todo 수정

		$ci->smsModel->sendAlimTalk($args, $template_key);
		
		if($msg = $ci->smsModel->_error_msg){
			$data['msg'] = $msg;
		}else{
			$data['msg'] = '알림톡 전송 요청되었습니다.';
		}

		return 'script';
	}

	/* 알림톡 발송 테스트 (상담신청 고객) */
	function alimTalkQuestionUserOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$send_phone = $args['phone'];
		$user_name = '장정호';

		$ci->smsModel->sendAlimTalk2QuestionUser($send_phone, $user_name);

		if($msg = $ci->smsModel->_error_msg){
			$data['msg'] = $msg;
		}else{
			$data['msg'] = '알림톡 전송 요청되었습니다.';
		}

		return 'script';
	}

	/*알림톡 발송 테스트 (상담 병원담당자)*/
	function alimTalkQuestionManagerOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$send_phone = $args['phone'];
		$user_name = '테스터';
		$user_phone = '01012345678';

		$ci->smsModel->sendAlimTalk2QuestionManager($send_phone, $user_name, $user_phone);

		if($msg = $ci->smsModel->_error_msg){
			$data['msg'] = $msg;
		}else{
			$data['msg'] = '알림톡 전송 요청되었습니다.';
		}

		return 'script';		
	}


	/*알림톡 발송 테스트(예약확정 유저에게)*/
	function alimTalkReserveUserOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$send_phone = $args['phone'];
		$user_name = '테스터';
		$reserve_date = '11월 3일';
		$hi_name = '테스트병원';

		$ci->smsModel->sendAlimTalk2ReserveUser($send_phone, $user_name, $reserve_date, $hi_name);

		if($msg = $ci->smsModel->_error_msg){
			$data['msg'] = $msg;
		}else{
			$data['msg'] = '알림톡 전송 요청되었습니다.';
		}

		return 'script';		

	}

	
	/*알림톡 발송 테스트(중앙관리자가 병원 관리자에게)*/
	function alimTalkHospitalManagerOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$send_phone = $args['phone'];
		$user_name = '테스터';
		$question_date = '11월 3일';

		$ci->smsModel->sendAlimTalk2HospitalManager($send_phone, $user_name, $question_date);

		if($msg = $ci->smsModel->_error_msg){
			$data['msg'] = $msg;
		}else{
			$data['msg'] = '알림톡 전송 요청되었습니다.';
		}

		return 'script';		

	}



	private function getLogTables(&$ci){
		$sql = "show tables in okmedi like 'Msg_Log_%'";
		$result = $ci->smsModel->listAllBySql($sql);

		$tables = array();
		if(is_array($result) && count($result)){
			foreach($result as $k => $v){
				$tables[] = $v['Tables_in_okmedi (Msg_Log_%)'];
			}
		}
		arsort($tables);
		return $tables;
	}

	private function getLogListFromTable(&$ci, $table_name){
		if(!$table_name) return array();

		$sql = "select * from {$table_name} left join Msg_ErrorCode on Error_Code = Result";
		return $ci->smsModel->listAllBySql($sql);
	}
}
?>
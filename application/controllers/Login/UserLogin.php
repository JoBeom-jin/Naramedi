<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserLogin{

	private $_ci = false;
	private $_naver_id = false;
	private $_naver_secret = false;

	function onInit(&$ci){
		$ci->load->model('Members/members', 'memberService');	
		$ci->load->model('Members/AuthGroup', 'authGroup');
		$ci->load->model('Members/MemberGroup', 'memberGroup');
		$ci->load->model('Members/MemberDetail', 'detailModel');
		$this->_ci = &$ci;
		$this->_naver_id = 'FXT4MlBkst5Pw4RWopIY';
		$this->_naver_secret = 'pdhJaFEHEt';
	}


	function index(&$data, &$ci){
		$data['naver_token'] = $this->setNaverSession();
		$data['naver_backurl'] = urlencode('http://okaymedi.com/index.php/medical/contents/login_login/loginBySNS?method=naver');
		$data['naver_auth_url'] = "https://nid.naver.com/oauth2.0/authorize?client_id={$this->_naver_id}&response_type=code&redirect_uri={$data['naver_backurl']}&state={$data['naver_token']}";
		
		return 'login/login.php';	
		if($ci->auth->isLogin()){		
			return '';
		}
		else return 'login/login.php';		
	}

	function findPass(&$data, &$ci){
		return 'login/find_pass';
	}

	function findPassOk(&$data, &$ci){
		$ci->load->model('Members/hospital', 'hospitalModel');

		$me_id = $ci->request->param('id_email', METHOD_POST, false);
		if(!$ci->chk->email($me_id)){
			$data['msg'] = '아이디는 이메일 형식이어야 합니다.';
			return 'script';
		}

		$where = array('me_id' => $me_id);
		if($ci->memberService->exist($where)){
			$row = $ci->memberService->row('*', $where);

			$ci->load->library('email');
		
			$config['useragent'] = "CodeIgniter";
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.gmail.com';
			$config['smtp_user'] = 'okaymedi@gmail.com';
			$config['smtp_pass'] = '1q2w3e4r!';
			$config['smtp_port'] = 465;
			$config['wordwrap'] = TRUE;
	//		$config['mailtype'] = 'html';
			$config['charset'] = 'utf-8';
			$config['crlf'] = "\r\n";
			$config['newline'] = "\r\n";
			$ci->email->initialize($config);
			$ci->email->clear(true);

			srand(time());
			$new_pass = substr(md5(uniqid(rand(), true)), 0, 8);		

			
			$ci->email->from('okaymedi@gmail.com', 'OK MEDICAL');
			$ci->email->to($me_id);
			$ci->email->subject('임시 비밀번호가 발급되었습니다.');
			$ci->email->message('오케이 메디컬 임시 비밀번호는 ['.$new_pass.'] 입니다.로그인 하신 뒤 반드시 비밀번호를 변경해주세요.');

			if($ci->email->send()){
				$ci->memberModel->changePass($new_pass, $row['me_seq']);
				$data['msg'] = '임시 비밀번호가 이메일로 발송되었습니다.';
				$data['sact'] = array('PR');
			}else{
				$msg = $ci->email->print_debugger();			
				echo $msg;
				exit;
	
				$data['msg'] = '메일 서버 문제로 인하여 메일을 전송하지 못하였습니다. 관리자에게 문의하세요.';
				return 'script';
				exit;
			}
			
			return 'script';

		}else{
			$data['msg'] = '존재하지 않는 이메일 정보입니다.';
			return 'script';

		}

	}

	function loginOk(&$data, &$ci){
		$args = $ci->request->getAll();

		$data['msg'] = false;
		$data['sact'] = false; 

		$id = $ci->input->post('id_email');
		$pass = $ci->input->post('password');

		if(!$ci->chk->hasText($id)){
			$data['msg'] = '아이디는 반드시 입력하셔야 합니다.';
		}
		else if(!$ci->chk->hasText($pass)){
			$data['msg'] = '비밀번호는 반드시 입력하셔야 합니다.';
		}else{
			$ci->auth->logout();
			$ci->auth->loginByIdPass($id, $pass);						

			if(!$ci->auth->isLogin()){
				$data['msg'] = '아이디를 찾을 수 없거나 비밀번호가 다릅니다.';				
			}
			else{
				$data['msg'] = '환영합니다.';				
				$data['back_url'] = '/';
				$data['sact'] = 'PGOTO';
			}
		}	

		return 'script';		
	}

	function loginBySNS(&$data, &$ci){
		$method = $data['method'] = $ci->request->param('method', METHOD_BOTH, false);

		if($method == 'facebook'){
			return 'login/login_sns';


		}else if($method == 'naver'){

			$data['naver_code'] = $ci->request->param('code', METHOD_BOTH, false);
			$data['naver_state'] = 	$ci->request->param('state', METHOD_BOTH, false);
			if($data['naver_state'] == $this->getNaverSession()){
				$data['naver_url'] = "https://nid.naver.com/oauth2.0/token?client_id={$this->_naver_id}&client_secret={$this->_naver_secret}&grant_type=authorization_code&state={$data['naver_state']}&code={$data['naver_code']}";
				$json = file_get_contents($data['naver_url']);
				$obj = json_decode($json);
				$naver['access_token'] = $obj->access_token;
				$naver['refresh_toke'] = $obj->refresh_token;
				$naver['token_type'] = $obj->token_type;
				$return =  $this->excuteCurl($obj->token_type, $obj->access_token);
				if(!$return){
					$data['msg'] = '네이버 로그인 중 오류가 발생하였습니다.';
					$data['sact'] = 'GOTO';
					$data['back_url'] = '/';
					return 'script';
				}	
				
				if($return['gender'] == 'M') $return['gender'] = 'MAN';
				else $return['gender'] = 'WOMAN';

				$data['id'] = $return['id'] ;
				$data['name'] = $return['name'] ;
				$data['email'] = $return['email'] ;
				$data['gender'] = $return['gender'] ;

				return 'login/login_sns';

			}else{
				$data['msg'] = '네이버 로그인 중 오류가 발생하였습니다.';
				$data['sact'] = 'GOTO';
				$data['back_url'] = '/';
				return 'script';
			}

			return 'login/login_sns';
		}else if($method == 'kakao'){
			return 'login/login_sns';
			
		}
	}

	function loginFromSNS(&$data, &$ci){
		$sns = $ci->request->param('sns', METHOD_POST, false);
		$email = $ci->request->param('email', METHOD_POST, false);
		$name = $ci->request->param('name', METHOD_POST, 'noname');
		$gender = $ci->request->param('gender', METHOD_POST, false);

		if($gender == 'male') $gender = 'MAN';
		else if($gender == 'femail') $gender = 'WOMAN';

		if($email && $sns){
			if($ci->auth->loginBySNS($email, $sns)){
				$data['msg'] = '환영합니다.';				
				$data['back_url'] = '/';
				$data['sact'] = 'GOTO';				
				return 'script';
			}else{
				$args['me_sns'] = $sns;
				$args['me_id'] = $email;
				$args['me_name'] = $name;	
				
				if($ci->memberService->existId($email)){
					$data['msg'] = '이미 같은 이메일로 가입된 정보가 있습니다. 보안을 위해 메인페이지로 돌아갑니다.';
					$data['back_url'] = '/';
					$data['sact'] = 'GOTO';
					return 'script';
				}

				if(!$ci->memberService->insertUserFromSNS($args)){
					$data['msg'] = $ci->memberService->error_message;
					return 'script';			
				}

				$groups = array('LOGIN');
				$member = $ci->memberService->getMemberById($args['me_id']);

				$args['md_gender'] = $gender;
				$args['md_phone'] = '010';
				$args['year'] = date('Y');
				$args['month'] = date('m');
				$args['day'] = date('d');

				$msg = $ci->detailModel->updateDetail($args, $member['me_seq']);
				if($msg){
					if(array_key_value('me_seq', $member)){
						$ci->memberService->deleteByMeSeq($member['me_seq']);
					}					

					$data['msg'] = $msg;
					return 'script';
				}

				$ci->memberGroup->insertGroup($member['me_seq'], $groups);

				if($ci->auth->loginBySNS($email, $sns)){
					$data['msg'] = '환영합니다.';				
					$data['back_url'] = '/';
					$data['sact'] = 'GOTO';									
					return 'script';
				}				
			}
		}


		$data['msg'] = 'facebook 로그인 중 오류가 발생하였습니다.';
		$data['back_url'] = '/';
		$data['sact'] = 'GOTO';									
		return 'script';

	}


	function loginFromSNSOk(&$data, &$ci){
		$args = $ci->request->getAll();		

		if(!array_key_exists('features1', $args) || $args['features1'] != 1){
			$data['msg'] = '[개인정보취급방침]에 동의해주세요.';
			return 'script';
		}else if(!array_key_exists('features2', $args) || $args['features2'] != 2){
			$data['msg'] = '[개인정보3자제공동의]에 동의해주세요.';
			return 'script';
		}

		srand(time());
		$password = md5(uniqid(rand(), true));
		$args['password'] = $args['password_chk'] =$password;

		$args = $this->getParams($args);

		if(!$ci->memberService->insertUser($args)){
			$data['msg'] = $ci->memberService->error_message;
			return 'script';			
		}

		$groups = array('LOGIN');
		$member = $ci->memberService->getMemberById($args['me_id']);
		$msg = $ci->detailModel->updateDetail($args, $member['me_seq']);
		if($msg){
			if(array_key_value('me_seq', $member)){
				$ci->memberService->deleteByMeSeq($member['me_seq']);
			}
			$data['msg'] = $msg;
			return 'script';
		}

		$ci->memberGroup->insertGroup($member['me_seq'], $groups);

		$data['msg'] = '가입을 축하드립니다.\n정상적으로 가입되어 로그인 화면으로 이동합니다.';
		$data['sact'] = 'PGOTO';
		$data['back_url'] = '/index.php/medical/contents/login_login';

		return 'script';

	}




	function joinForm(&$data, &$ci){
		$data['method'] = $ci->request->param('method', METHOD_BOTH, false);
		$data['naver_token'] = $this->setNaverSession();
		$data['naver_backurl'] = urlencode('http://okaymedi.com/index.php/medical/contents/login_login/loginBySNS?method=naver');
		$data['naver_auth_url'] = "https://nid.naver.com/oauth2.0/authorize?client_id={$this->_naver_id}&response_type=code&redirect_uri={$data['naver_backurl']}&state={$data['naver_token']}";

		return 'login/join_form';
	}

	function joinFormOk(&$data, &$ci){
		$args = $ci->request->getAll();		

		if(!array_key_exists('features1', $args) || $args['features1'] != 1){
			$data['msg'] = '[개인정보취급방침]에 동의해주세요.';
			return 'script';
		}else if(!array_key_exists('features2', $args) || $args['features2'] != 2){
			$data['msg'] = '[개인정보3자제공동의]에 동의해주세요.';
			return 'script';
		}

		$args = $this->getParams($args);		


		if(!$ci->memberService->insertUser($args)){
			$data['msg'] = $ci->memberService->error_message;
			return 'script';			
		}

		$groups = array('LOGIN');
		$member = $ci->memberService->getMemberById($args['me_id']);
		$msg = $ci->detailModel->updateDetail($args, $member['me_seq']);
		if($msg){
			if(array_key_value('me_seq', $member)){
				$ci->memberService->deleteByMeSeq($member['me_seq']);
			}
			$data['msg'] = $msg;
			return 'script';
		}

		$ci->memberGroup->insertGroup($member['me_seq'], $groups);

		$data['msg'] = '가입을 축하드립니다.\n정상적으로 가입되어 로그인 화면으로 이동합니다.';
		$data['sact'] = 'PGOTO';
		$data['back_url'] = '/index.php/medical/contents/login_login';

		return 'script';
	}

	function & getParams($args){
		
		$params = array();
		$params['me_id'] = $args['id_email'];
		$params['me_name'] = $args['name'];
		$params['me_pass'] = $args['password'];
		$params['pass_chk'] = $args['password_chk'];
		$params['md_gender'] = $args['md_gender'];
		$params['md_phone'] = $args['phone'];
		$params['year']  = $args['year'];
		$params['month']  = $args['month'];
		$params['day']  = $args['day'];
		if(array_key_exists('me_sns', $params)) $params['me_sns'] = $args['me_sns'];

		return $params;
	}


	function setNaverSession(){
		$mt = microtime();
	    $rand = mt_rand();
		$session_data = array('token' => md5($mt . $rand));		
		$this->_ci->session->set_userdata($session_data);
		return $session_data['token'];
	}

	function getNaverSession(){
		return $this->_ci->session->userdata('token');
	}

	function excuteCurl($token_type, $access_token){
		$url = 'https://openapi.naver.com/v1/nid/me';

		$data['Authorization'] = $token_type.' '.$access_token;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Authorization: '.$data['Authorization']
			));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$user_info = curl_exec($ch);
		curl_close($ch);

		$user_info = json_decode($user_info);
		$return = array();
		if($user_info->resultcode == '00'){
			$return['id'] = $user_info->response->id;
			$return['name'] = $user_info->response->name;
			$return['email'] = $user_info->response->email;
			$return['gender'] = $user_info->response->gender;
		}else $return = false;

		return $return;

	}



}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BoardDefault{

	public $_config = array();

	protected $_admin_groups = array();
	protected $_ci = false;

	protected $_Auth = false;

	protected $_bcid =  false;	
	protected $_skin_path = false;
	protected $_category = false;
	protected $_upload_dir = false;
	protected $_save_dir = false;

	protected $_auth_insert = false;
	protected $_auth_modify = false;
	protected $_auth_delete = false;
	protected $_auth_list = false;

	protected $_bd_sesssion_id = 'my_board_password';


	
	function onInit(&$ci){
		$this->_ci = &$ci;
		$this->_admin_groups = array('SUPERVISOR', 'BOARDMANAGER');					

		$ci->load->model('Board/BoardConfigModel', 'configModel');
		$ci->load->model('Board/BoardCategoryModel', 'categoryModel');			
		$ci->load->model('Board/BoardContentsModel', 'contentModel');
		$ci->load->model('Board/BoardFileModel', 'fileModel');
		$ci->load->model('Board/BoardLinkModel', 'linkModel');
		$ci->load->model('Board/BoardReplyModel', 'replyModel');

		$this->_Auth = &$ci->auth;
		$this->_bcid = $ci->getMenuParams('bc_id');				
		$this->_upload_dir = $ci->_site_config['dir']['board_files'];
		$this->_save_dir = $this->_upload_dir.DIRECTORY_SEPARATOR.$this->_bcid;
		$this->_save_url = $ci->_site_config['url']['board_files'].'/'.$this->_bcid;
		$this->_makeUploadDir();	
		
		
		$ci->addCss('/resource/css/board.css');
		if(!$ci->chk->hasText($this->_bcid) || !( $this->_config = $ci->configModel->getConfigById($this->_bcid) ) ) show_error('게시판을 찾을 수 없습니다.');		
	}

	function index(&$data, &$ci){
		$data['categories'] = $ci->categoryModel->getListByBcid($this->_bcid);
		$data['bcid'] = $this->_bcid;	
		$data['_config'] = &$this->_config;
		$data['data_url'] = $this->_save_url;

		$data['_auth_insert'] = $this->_auth_insert = $this->_hasAuth('insert');
		$data['_auth_modify'] = $this->_auth_modify = $this->_hasAuth('modify');
		$data['_auth_delete'] = $this->_auth_delete = $this->_hasAuth('delete');
		$data['_auth_list'] = $this->_auth_list = $this->_hasAuth('list');
		$data['_auth_view'] = $this->_auth_view = $this->_hasAuth('view');

		$action = $data['bact'] =  $ci->request->param('act', METHOD_BOTH, 'list');
		$action = 'do'.ucfirst($action);
		$tpl = $this->$action($data, $ci);

		if($tpl == 'script') return 'script';
		else return $this->getTpl($tpl);
	}

	function doInsertReply(&$data, &$ci){	
		if($this->_config['bc_reply_flag'] != 'Y' || !$ci->auth->isLogin()){
			$data['msg'] = '댓글 권한이 없습니다.';
			return 'script';
		}
		
		$args = $ci->request->getAll();
		if(!$ci->replyModel->insertArgsByBcid($args, $this->_bcid)){
			$data['msg'] = $ci->replyModel->error_message;			
		}else{
			$data['msg'] = '등록 되었습니다';
			$data['sact'] = 'PR';
		}		
		return 'script';
	}


	function doList(&$data, &$ci){
		if(!$this->_auth_list) show_error('목록을 검색할 수 있는 권한이 없습니다.');
		$ci->load->library('Paging');
		$paging = &$ci->paging;

		$bdc_seq = $data['bdc_seq'] =  $ci->request->param('bdc_seq', METHOD_BOTH, false);
		if($bdc_seq) $paging->addWhere('bd_bdcseq', '=', $bdc_seq);

		$paging->addWhere('bd_bcid', '=', $this->_bcid);
//		$paging->addWhere('bd_display_flag', '=', '1');
		
		$paging->addOrder('bd_notice_flag', 'desc');
		$paging->addOrder('bd_step', 'desc');
		$paging->addOrder('bd_thread', 'asc');

		$data['list'] = $ci->contentModel->listPage($paging);
		$data['paging'] = &$paging;

		return 'list';
	}

	function doInsert(&$data, &$ci){
		if(!$this->_auth_insert) show_error('글쓰기 권한이 없습니다.');	
		$data['article'] = $ci->contentModel->getEmptyRow();
		$data['files'] = array();
		$data['links'] = array();

		$this->_setFormData($data);
		return 'form';
	}

	function doInsertOk(&$data, &$ci){
		if(!$this->_auth_insert){$data['msg'] = '글쓰기 권한이 없습니다.'; return 'script';}

		$args = $ci->request->getAll();
		$this->_setFormData($args);
		if( !($seq = $ci->contentModel->insertArticle($args, $this->_bcid, $this->_config))){
			$data['msg'] = $ci->contentModel->message;
			return 'script';
		}

		if(!$ci->fileModel->insertFile($_FILES, $seq, $this->_save_dir)){
			$ci->fileModel->error_msgs[] = '업로드 파일 중 오류가 발생하였습니다.\n성공한 파일은 정상 처리됩니다.';
			$data['msg'] = implode('\n', $ci->fileModel->error_msgs);
		}else{
			$data['msg'] = '정상적으로 등록되었습니다.';
		}
		
		$links = $ci->request->param('bd_links', METHOD_POST, false);

		if(is_array($links) && count($links) > 0 ){
			if(!$ci->linkModel->insertLink($links, $seq))	$data['msg'] = $ci->linkModel->message;
		}
		
		$data['sact'] = 'PR';
		return 'script';
	}

	function doAddInsert(&$data, &$ci){

		$data['article'] = $ci->contentModel->getEmptyRow();
		$data['files'] = array();
		$data['links'] = array();

		$this->_setFormData($data);			
		return 'form';
	}

	function doView(&$data, &$ci){		
		if(!$this->_auth_view){$data['msg'] = '글 읽기 권한이 없습니다.'; return 'script';}
		$bd_seq = $ci->request->param('seq', METHOD_BOTH, false);
		$article = & $ci->contentModel->getArticle($bd_seq, $this->_bcid);
		if(!array_key_exists('bd_seq', $article) || $bd_seq != $article['bd_seq']){
			$data['msg'] = '게시글이 존재하지 않습니다.';
			return 'notice';
		}

		$input_pass = $ci->request->param('bd_pass', METHOD_POST, false);
		if($article['bd_lock_flag'] == 'Y' && !$this->_isManager() && !$this->_isSelf($article, $input_pass)){
			if($this->_Auth->isLogin()){
				$data['msg'] = '게시글을 볼 수 있는 권한이 없습니다.';
				return 'notice';
			}else{
				$data['bd_seq'] = $bd_seq;
				$data['wrong_password'] = false;
				if($ci->chk->hasText($input_pass)) $data['wrong_password'] = true;
				return 'password_form';
			}
		}

		$ci->contentModel->updateHit($bd_seq);

		$args[$this->_bd_sesssion_id] = $input_pass;
		$ci->session->set_userdata($args);
		
		$data['article'] = &$article;
		$data['article']['files'] = $ci->fileModel->getFiles($article['bd_seq']);
		$data['article']['links'] = $ci->linkModel->getLinksBySeq($article['bd_seq']);

		$data['reply_list'] = $this->_getReplyList();		

		return 'view';
	}

	function doModify(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$data['article'] = $article = $ci->contentModel->getArticle($seq, $this->_bcid);
		$input_pass = $ci->request->param('bd_pass', METHOD_POST, false);

		if($this->_isManager() || ( $this->_hasAuth('modify') && $this->_isSelf($article, $input_pass) ) ){	
			$this->_setFormData($data);
			$data['files'] = $ci->fileModel->getFiles($article['bd_seq']);
			$data['links'] = $ci->linkModel->getLinksBySeq($article['bd_seq']);
			return 'form';			
		}else if($article['bd_pass']){
			$data['wrong_password'] = false;
			if($ci->chk->hasText($input_pass)) $data['wrong_password'] = true;
			return 'password_form';
		}

		$data['msg'] = '게시글을 수정할 권한이 없습니다.';		
		return 'notice';
	}

	function doModifyOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$bd_seq = $args['bd_seq'];
		
		$article = $ci->contentModel->getArticle($bd_seq, $this->_bcid);			
		
		if(!is_numeric($bd_seq) || !$article || $article['bd_seq'] != $bd_seq){
			$data['msg'] = '게시물이 존재하지 않습니다.';
			return 'script';
		}		

		if(!$this->_isManager()){
			if(! $this->_hasAuth('modify') ){
				$data['msg'] = '게시글을 수정할 권한이 없습니다.';
				return 'script';
			}else	if($article['bd_id'] ){
				if( $article['bd_id'] != $ci->auth->id()){
					$data['msg'] = '게시글을 수정할 권한이 없습니다.';
					return 'script';
				}
			}else if( $ci->chk->hasText($article['bd_pass']) ){
				$input_pass = $ci->request->param('bd_pass', METHOD_POST, false);
				if($article['bd_pass'] != $input_pass){
					if($ci->chk->hasText($input_pass)) $data['wrong_password'] = true;
					return 'password_form';					
				}
			}else{
				$data['msg'] = '정상적인 게시글이 아닙니다. 관리자에게 문의하세요 : no access point';
				return 'script';
			}
		}

		if($ci->contentModel->modifyArticle($args, $bd_seq, $this->_bcid, $this->_config)){

			if(!$ci->fileModel->insertFile($_FILES, $bd_seq, $this->_save_dir)){
				$ci->fileModel->error_msgs[] = '업로드 파일 중 오류가 발생하였습니다.\n성공한 파일은 정상 처리됩니다.';
				$data['msg'] = implode('\n', $ci->fileModel->error_msgs);
			}else{
				$links = $ci->request->param('bd_links', METHOD_POST, false);
				$ci->linkModel->insertLink($links, $bd_seq);
				$data['msg'] = '수정되었습니다.';
			}				
			$data['sact'] = 'PR';						

		}else{
			$data['msg'] = $ci->contentModel->message;			
		}
		
		return 'script';	
	}

	function doDelete(&$data, &$ci){
		$bd_seq = $ci->request->param('seq', METHOD_GET, false);
		
		$article = $ci->contentModel->getArticle($bd_seq, $this->_bcid);			
		
		if(!is_numeric($bd_seq) || !$article || $article['bd_seq'] != $bd_seq){
			$data['msg'] = '게시물이 존재하지 않습니다.';
			return 'script';
		}		


		if(!$this->_isManager()){
			if(! $this->_hasAuth('delete') ){
				$data['msg'] = '게시글을 삭제할 권한이 없습니다.';
				return 'script';
			}else	if($article['bd_id'] ){
				if( $article['bd_id'] != $ci->auth->id()){
					$data['msg'] = '게시글을 삭제할 권한이 없습니다.';
					return 'script';
				}
			}else if( $ci->chk->hasText($article['bd_pass']) ){
				$input_pass = $ci->request->param('bd_pass', METHOD_POST, false);
				if($article['bd_pass'] != $input_pass){
					if($ci->chk->hasText($input_pass)) $data['wrong_password'] = true;
					return 'password_form';					
				}
			}else{
				$data['msg'] = '정상적인 게시글이 아닙니다. 관리자에게 문의하세요 : no access point';
				return 'script';
			}
		}

		if($ci->contentModel->deleteBySeq($bd_seq, $this->_bcid) ){
			$ci->fileModel->deleteAllBySeq($bd_seq);
			$ci->linkModel->deleteAllBySeq($bd_seq);

			$data['msg'] = '삭제되었습니다.';
			$data['sact'] = 'GOTO';					
			$data['back_url'] = $data['menu_url'];
		}else{
			$data['msg'] = $ci->contentModel->message;			
		}
		return 'script';
	}

	function doDownFile(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$bd_seq = $ci->request->param('bd_seq', METHOD_BOTH, false);
		$article = $ci->contentModel->getArticle($bd_seq, $this->_bcid);	

		if(!array_key_exists('bd_seq', $article) || $bd_seq != $article['bd_seq']){
			$data['msg'] = '게시글이 존재하지 않습니다.';
			return 'script';
		}

		$input_pass = $ci->session->userdata($this->_bd_sesssion_id);
		if($article['bd_lock_flag'] == 'Y' && !$this->_isManager() && !$this->_isSelf($article, $input_pass)){
				$data['msg'] = '게시글을 볼 수 있는 권한이 없습니다.';
				return 'script';
		}


		if(!($msg = $ci->fileModel->downFileBySeq($seq, $bd_seq)) ){
			$data['msg'] = $this->fileModel->message;
			return 'script';
		}
		exit;
	}

	function doDeleteLink(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$bd_seq = $ci->request->param('bd_seq', METHOD_BOTH, false);
		$article = $ci->contentModel->getArticle($bd_seq, $this->_bcid);	

		if(!array_key_exists('bd_seq', $article) || $bd_seq != $article['bd_seq']){
			$data['msg'] = '게시글이 존재하지 않습니다.';
			return 'script';
		}

		$input_pass = $ci->session->userdata($this->_bd_sesssion_id);
		if($article['bd_lock_flag'] == 'Y' && !$this->_isManager() && !$this->_isSelf($article, $input_pass)){
				$data['msg'] = '게시글을 볼 수 있는 권한이 없습니다.';
				return 'script';
		}

		$ci->linkModel->deleteBySeq($seq);
		
		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = 'PR';
		return 'script';
	}

	function doDeleteFile(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$bd_seq = $ci->request->param('bd_seq', METHOD_BOTH, false);
		$article = $ci->contentModel->getArticle($bd_seq, $this->_bcid);	

		if(!array_key_exists('bd_seq', $article) || $bd_seq != $article['bd_seq']){
			$data['msg'] = '게시글이 존재하지 않습니다.';
			return 'script';
		}

		$input_pass = $ci->session->userdata($this->_bd_sesssion_id);
		if($article['bd_lock_flag'] == 'Y' && !$this->_isManager() && !$this->_isSelf($article, $input_pass)){
				$data['msg'] = '게시글을 볼 수 있는 권한이 없습니다.';
				return 'script';
		}

		$ci->fileModel->deleteBySeq($seq, $bd_seq);

		$data['msg'] = '삭제되었습니다.';
		$data['sact'] = 'PR';
		return 'script';
		
	}

	/* 게시물 소유자 확인 */
	private function _isSelf(&$article, $input_pass=false){
		if($article['bd_id'] && $article['bd_id'] === $this->_ci->auth->id() ) return true;
		else if($this->_ci->chk->hasText($article['bd_pass']) && $this->_ci->chk->hasText($input_pass) && $article['bd_pass'] === $input_pass) return true;

		return false;
	}

	private function _setFormData(&$data){
		if($this->_config['bc_editor_flag'] == 'Y' || ($this->_config['bc_editor_flag'] == 'M' && $this->_isManager())){
			$data['use_editor'] = 'Y';
			$data['bd_html_flag'] = 'Y';
		}else{
			$data['use_editor'] = 'N';
			$data['bd_html_flag'] = 'N';
		}
	}

	
	function getTpl($file){
		$default_skin_name = 'default';		
		$dir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'board'.DIRECTORY_SEPARATOR.'skin';

		$skin_path1 = $dir.DIRECTORY_SEPARATOR.$this->_config['bc_skin1'].DIRECTORY_SEPARATOR.$file.'.php';
		$skin_path2 = $dir.DIRECTORY_SEPARATOR.$this->_config['bc_skin2'].DIRECTORY_SEPARATOR.$file.'.php';
		$default_skin_path = $dir.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.$file.'.php';

		if(!is_file($skin_path1)) return 'board/skins/'.$this->_config['bc_skin1'].'/'.$file;
		else if(!is_file($skin_path2)) return 'board/skins/'.$this->_config['bc_skin1'].'/'.$file;
		else return 'board/skins/default/'.$file;
	}

	private function _hasAuth($method){
		if(!$this->_ci->chk->hasText($method)) return false;
		if($this->_isManager()) return true;

		if($method == 'list'){
			$groups = $this->_config['bc_access_list'];
			if(count($groups) < 1) return true;
			else return $this->_Auth->inGroups($groups);
		}else if($method == 'insert'){
			$groups = $this->_config['bc_access_insert'];			
			if(count($groups) < 1) return true;
			else return $this->_Auth->inGroups($groups);
		}else if($method == 'view'){
			$groups = $this->_config['bc_access_view'];
			if(count($groups) < 1) return true;
			else return $this->_Auth->inGroups($groups);
		}else if($method == 'modify'){
			$groups = $this->_config['bc_access_modify'];
			if(count($groups) < 1) return true;
			else return $this->_Auth->inGroups($groups);
		}else if($method == 'delete'){
			$groups = $this->_config['bc_access_delete'];
			if(count($groups) < 1) return true;
			else return $this->_Auth->inGroups($groups);
		}

		return false;
	}

	private function _isManager(){
		if(!$this->_ci->auth->isLogin()) return false;
		if($this->_ci->auth->inGroups($this->_admin_groups)) return true;
		return false;		
	}

	private function _makeUploadDir(){
		if(!is_dir($this->_save_dir)){
			if(@mkdir($this->_save_dir, 0777) && is_dir($this->_save_dir)) @chmod($this->_save_dir, 0777);
		}
	}

	private function _getReplyList(){
		if($this->_config['bc_reply_flag'] == 'Y'){
			return $this->_ci->replyModel->getListByBcid($this->_bcid);
		}
	}
}
?>

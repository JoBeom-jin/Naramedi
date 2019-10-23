<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$ci = &get_instance();
$ci->getController('Board_BoardDefault');

class HealthBoard extends BoardDefault{	

	function doList(&$data, &$ci){
		if(!$this->_auth_list) show_error('목록을 검색할 수 있는 권한이 없습니다.');
		$ci->load->library('Paging');
		$paging = &$ci->paging;
		$paging->setPageSize(21);

		$bdc_seq = $data['bdc_seq'] =  $ci->request->param('bdc_seq', METHOD_BOTH, false);
		if($bdc_seq) $paging->addWhere('bd_bdcseq', '=', $bdc_seq);

		$paging->addWhere('bd_bcid', '=', $this->_bcid);
//		$paging->addWhere('bd_display_flag', '=', '1');
		
		$paging->addOrder('bd_notice_flag', 'desc');
		$paging->addOrder('bd_step', 'desc');
		$paging->addOrder('bd_thread', 'asc');

		$sch_type = $data['sch_type'] = $ci->request->param('sch_type', METHOD_BOTH, false);
		$sch_text = $data['sch_text'] = $ci->request->param('sch_text', METHOD_BOTH, false);

		if($sch_type && $sch_text){
			$sch_field = false;
			if($sch_type == 'subject') $sch_field = 'bd_subject';
			else if($sch_type == 'comment') $sch_field = 'bd_content';
			if($sch_field) $paging->addWhere($sch_field, 'like', $sch_text);
		}



		$data['list'] = $ci->contentModel->listPage($paging);
		$data['paging'] = &$paging;


		$seqs = array();
		if(is_array($data['list']) && count($data['list']) > 0){
			foreach($data['list'] as $k => $l){
				$seqs[] = $l['bd_seq'];
			}
		}

		$data['thums'] = $ci->fileModel->getThumBySeqs($seqs);
		if(is_array($data['thums']) && count($data['thums']) > 0){
			foreach($data['thums'] as $k => $v){
				$data['thums'][$k] = str_replace(DIRECTORY_SEPARATOR,'/' ,str_replace($ci->_site_config['dir']['root'], '', $v['bf_path']));
			}
		}

		return 'list';
	}

	function doView(&$data, &$ci){
		$tpl = parent::doView($data, $ci);

		$article = $data['article'];
		$image = $article['files'][0]['url'];

		$domain = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'];
		$full_url = $data['full_url'] =  $domain.$_SERVER['REQUEST_URI'];
		$comment = $data['twitter_text'] = mb_substr(strip_tags($article['bd_content']),0, 80, 'utf-8');

		$data['meta_datas'] = array();
		$data['meta_datas'][] = '<meta property="og:type" content="website" />';
		$data['meta_datas'][] = '<meta property="og:title" content="'.$article['bd_subject'].'" />';
		$data['meta_datas'][] = '<meta property="og:url" content="'.$full_url.'" />';
		$data['meta_datas'][] = '<meta property="og:description" content="'.$comment.'" />';
		$data['meta_datas'][] = '<meta property="og:image" content="'.$domain.$image.'" />';
		$data['twitter_text'] = urlencode($data['twitter_text']);
		
		/* full url 변경 */
		$ci->load->helper('url');
		$menu_url = $data['menu_url'];
		$act = $data['act'];
		$data['_full_url'] = "https://okaymedi.com{$menu_url}/{$act}/act/view/seq/".$article['bd_seq'];
		return 'view';
	}


	function getTpl($file){
		$default_skin_name = 'default';		
		$dir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'board'.DIRECTORY_SEPARATOR.'health_skins';

		$skin_path1 = $dir.DIRECTORY_SEPARATOR.$this->_config['bc_skin1'].DIRECTORY_SEPARATOR.$file.'.php';
		$skin_path2 = $dir.DIRECTORY_SEPARATOR.$this->_config['bc_skin2'].DIRECTORY_SEPARATOR.$file.'.php';
		$default_skin_path = $dir.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.$file.'.php';

		if(!is_file($skin_path1)) return 'board/health_skins/'.$this->_config['bc_skin1'].'/'.$file;
		else if(!is_file($skin_path2)) return 'board/health_skins/'.$this->_config['bc_skin1'].'/'.$file;
		else return 'board/skins/default/'.$file;
	}

}
?>

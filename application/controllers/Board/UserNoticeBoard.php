<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$ci = &get_instance();
$ci->getController('Board_BoardDefault');

class UserNoticeBoard extends BoardDefault{	

	function doList(&$data, &$ci){
		$tpl = parent::doList($data, $ci);

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


	function getTpl($file){
		$default_skin_name = 'default';		
		$dir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'board'.DIRECTORY_SEPARATOR.'notice_skins';

		$skin_path1 = $dir.DIRECTORY_SEPARATOR.$this->_config['bc_skin1'].DIRECTORY_SEPARATOR.$file.'.php';
		$skin_path2 = $dir.DIRECTORY_SEPARATOR.$this->_config['bc_skin2'].DIRECTORY_SEPARATOR.$file.'.php';
		$default_skin_path = $dir.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.$file.'.php';

		if(!is_file($skin_path1)) return 'board/notice_skins/'.$this->_config['bc_skin1'].'/'.$file;
		else if(!is_file($skin_path2)) return 'board/notice_skins/'.$this->_config['bc_skin1'].'/'.$file;
		else return 'board/skins/default/'.$file;
	}

}
?>

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HospitalPhoto{
	
	private $_path;
	private $_dir = '';
	
	function onInit(&$ci){		
		$ci->load->model('Agency/AgenciPhotoDefault', 'photoModel');
		$ci->load->model('Agency/AgencyModel', 'agencyModel');
		$ci->load->model('Agency/AgencyImageModel', 'imageModel');
		$this->_dir = $ci->_site_config['dir']['root'].DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'hospital_photo_resize'.DIRECTORY_SEPARATOR;
	}

	function index(&$data, &$ci){
		$ci->load->library('paging');
		$paging = &$ci->paging;
		$paging->setOrder('apd_seq', 'desc');
		$data['total'] = $ci->photoModel->count();
		$where = array('apd_ai_exists' => 'Y');
		$data['mapping_total'] = $ci->photoModel->count($where);
		$where = array('apd_dir_exists' => 'Y');
		$data['exist_dir_total'] = $ci->photoModel->count($where);
		$where = array('apd_add_flag' => 'Y');
		$data['complete_total'] = $ci->photoModel->count($where);
		$where = array('apd_dir_exists'=>'Y', 'apd_ai_exists'=>'Y', 'apd_add_flag'=>'N');
		$data['lest_total'] = $ci->photoModel->count($where);


		$data['type'] = $type = $ci->request->param('type', METHOD_BOTH, false);

		if($type == 'no_agency'){
			$paging->addWhere('apd_ai_exists', '=', 'N');
		}else if($type == 'no_dir'){
			$paging->addWhere('apd_dir_exists', '=', 'N');
		}

		$paging->setOrder('binary(apd_source)', 'asc');
		$data['list'] = $ci->photoModel->listPage($paging);		
		$data['paging'] = &$paging;

		
		return 'photo/photo_manager';
	}


	/*
	* 정보 수정
	*/
	function modify(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$data['modify'] = $ci->photoModel->rowWithAgencyBySeq($seq);
		$data['photo_dir']  = $this->_dir.$data['modify']['apd_target'];

		$data['search'] = $ci->request->param('search_text', METHOD_POST, false);
		$data['agency_list'] = array();
		if(isset($data['search']) && $data['search'] ) $data['agency_list'] = $ci->agencyModel->searchByName($data['search']);

		$ci->setFrame('window');
		return 'photo/photo_manager_modify';
	}

	/*
	*	폴더가 존재하는지 여부 확인
	* 존재하면 해당 폴더 이름을 변경
	*/
	function modifyTarget(&$data, &$ci){
		$apd_target = $ci->request->param('apd_target', METHOD_POST, false);
		$seq = $ci->request->param('seq', METHOD_POST, false);
		
		$dir = $this->_dir.$apd_target;
		if(!is_dir($dir)){
			$data['msg'] = '서버에 해당 폴더가 존재하지 않습니다. 정보를 변경할 수 없습니다.';
			return 'script';
		}

		$args['apd_source_add'] = $dir;
		$args['apd_dir_exists'] = 'Y';
		$args['apd_target'] = $apd_target;

		$ci->photoModel->photoModel($args, $seq);

		$data['msg'] = '수정되었습니다.';
		$data['sact'] = array('PR', 'POR');
		return 'script';
	}

	/*
	* 엑셀정보와 기관 정보 1:1 매칭
	*/
	function matchAgency(&$data, &$ci){
		$ai_seq = $ci->request->param('aiseq', METHOD_BOTH, false);
		$apd_seq = $ci->request->param('apdseq', METHOD_BOTH, false);
		if(!is_numeric($ai_seq) || !is_numeric($apd_seq) ){
			$data['msg'] = '잘못된 접근 입니다.';
			return 'script';
		}

		$agency = $ci->agencyModel->rowBySeq($ai_seq);


		if(isset($agency['ai_seq'])){
			$args['apd_addr'] = $agency['ai_addr'];
			$args['apd_aiseq'] = $agency['ai_seq'];
			$args['apd_ai_exists'] = 'Y';
			$ci->photoModel->photoModel($args, $apd_seq);
		}

		$data['msg'] = '기관정보와 매칭되었습니다.';
		$data['sact'] = array('POR', 'PR');

		return 'script';
	}



	function existsData(&$data, &$ci){
//		$where = array('apd_ai_exists' => 'N');
		$list = $ci->photoModel->listAll();				
		if(is_array($list) && count($list) > 0){
			foreach($list as $k=> $v){
				$where = array('ai_addr' => $v['apd_addr']);
				$count = $ci->agencyModel->count($where);
				if( $count > 0 ){
					$args = array();
					if($count > 1){
						$where['ai_name'] = $v['apd_source'];
					}
					$row = $ci->agencyModel->row('*', $where);									

					if($row){					
						$args['apd_ai_exists'] = 'Y';
						$args['apd_aiseq'] = $row['ai_seq'];
						$dir  = $ci->_site_config['dir']['root'].DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'hospital_photo_resize'.DIRECTORY_SEPARATOR.$v['apd_target'];
						if(is_dir($dir)){
							$args['apd_source_add'] = $dir;
							$args['apd_dir_exists'] = 'Y';
						}
						$ci->photoModel->update($args, array('apd_seq'=>$v['apd_seq']));
					}
				}
			}
		}
		
		$data['msg'] = '매칭이 완료되었습니다.';
		return 'script';
	}

	/*
	* 사진 이전
	* 폴더와 매칭된 기관정보가 존재하는 DataList만 실행
	* 매칭된 기관 정보의 현재 사진은 제거
	* 새로운 사진을 입력하고, 최초 사진을 섬네일로 등록한다.
	*/
	function movePhoto(&$data, &$ci){
		$list = $ci->photoModel->getMoveList();
		if($list && is_array($list) && count($list) > 0){			
			foreach($list as $k => $v){								
				$source_dir = $v['apd_source_add'];
				$ai_seq = $v['apd_aiseq'];				
				if(!is_dir($source_dir) || !is_numeric($ai_seq) ) continue;
				$agency_info = $ci->agencyModel->rowBySeq($ai_seq);
				
				$ci->imageModel->removeImageByAiseq($ai_seq);
				$ci->imageModel->moveImageByAiseqFolder($ai_seq, $source_dir);								
				$ci->photoModel->checkMoveImageOkBySeq($v['apd_seq']);							
			}
		}
	}

	/*
	* 엑셀 데이터 이전
	*/
	function excel(&$data, &$ci){
		$this->_path = $ci->_site_config['dir']['upload'].DIRECTORY_SEPARATOR.'photo_list.xls';

		$ci->load->library('Util/Excel', 'excel');
		$objPHPExcel = PHPExcel_IOFactory::load($this->_path);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

		if($ci->chk->isArray($sheetData)){
//			$ci->photoModel->truncate();
			foreach($sheetData as $k => $v){
				$args = array();
				$args['apd_source'] = $v['A'];
				$args['apd_target'] = $v['B'];
				$args['apd_addr'] = $v['C'];
				$ci->photoModel->insertDefault($args);
			}
		}

		$data['sact'] = 'PR';
		$data['msg'] = 'DB로 등록되었습니다.';
		return 'script';
	}

	function nameSearch(&$data, &$ci){
		$list = $ci->photoModel->listAll();
		
		foreach($list as $k => $v){
			$where = array('ai_name' => $v['apd_source']);

			if($ci->agencyModel->count($where) == 1 ){

				$args = array();
				$row = $ci->agencyModel->row('*', $where);				
				$args['apd_exists'] = 'Y';
				$args['apd_aiseq'] = $row['ai_seq'];
				$ci->photoModel->update($args, array('apd_seq'=>$v['apd_seq']));

			}
		}

		$data['sact'] = 'PR';
		$data['msg'] = 'DB로 등록되었습니다.';
		return 'script';		
	}

	function addrSearch(&$data, &$ci){		

		$sql = "select * from agency_photo_default left join agency_info on ai_addr=apd_addr and ai_name=apd_source where apd_exists";
		$list = $ci->photoModel->listAllBySql($sql);			

		foreach($list as $k => $v){
			$where = array('apd_seq' => $v['apd_seq']);
			$args = array();
			$args['apd_aiseq'] = $v['ai_seq'];
			$args['apd_dir'] = $ci->_site_config['dir']['root'].DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'hospital_photo'.DIRECTORY_SEPARATOR.$v['apd_target'];
			$args['apd_exists'] = 'Y';
			$ci->photoModel->update($args, $where);
		}

		$data['sact'] = 'PR';
		$data['msg'] = 'DB로 등록되었습니다.';
		return 'script';
	}

	function copyPhoto(&$data, &$ci){
		$config = $ci->imageModel->getFileConfig();
		$upload_dir = $config['upload_path'];
		

		$where = "apd_aiseq is not null and apd_exists='Y'";
		$list = $ci->photoModel->listAll('*', $where);
		
		if(isArray_($list)){			
			$ci->load->helper('file');
			foreach($list as $k => $v){
				$file_list = array();

				$source_path = $v['apd_dir'];
				$file_list = get_dir_file_info($source_path);

				if(is_array($file_list) && count($file_list) > 0){

					foreach($file_list as $file){										
						
						if(is_file($file['server_path'])){
							$file_info = pathinfo($file['server_path']);
							$ext = $file_info['extension'];

							srand(time());
							$new_file_name = md5(uniqid(rand(), true));
							$new_file_name = $new_file_name.'.'.$ext;

							if(copy($file['server_path'], $upload_dir.DIRECTORY_SEPARATOR.$new_file_name)){
								$args = array();
								$args['aim_aiseq'] = $v['apd_aiseq'];
								$args['aim_fname'] = $file['name'];
								$args['aim_real_fname'] = $new_file_name;
								$args['aim_path'] = $upload_dir.DIRECTORY_SEPARATOR.$new_file_name;
								$args['aim_fsize'] = $file['size'];

								$img_info = getimagesize($file['server_path']);
								if(array_key_exists('0', $img_info)) $args['width'] = $img_info[0];
								if(array_key_exists('1', $img_info)) $args['height'] = $img_info[1];

								$ci->imageModel->insert($args);
							}
						}
					}
				}
				

				$photo_args = array();
				$photo_args = array(
						'apd_exists'=>'A'
					);
				$ci->photoModel->update($photo_args, array('apd_seq' => $v['apd_seq']));
			}
		}

		$data['sact'] = 'PR';
		$data['msg'] = '파일이 복사되었습니다.';
		return 'script';		
	}

	
}
?>

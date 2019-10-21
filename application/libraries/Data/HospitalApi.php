<?
defined('BASEPATH') OR exit('No direct script access allowed');

class HospitalApi{

	private $_target_urls = array();
	private $_key = 'W6kS1bWboSbQhm8hroOnan%2BPfN8X1LeggX1klR017yDfvs8Vg9dCAWjidGd9%2BgsxKb8b1M%2B6D5uXhFgGSofXBg%3D%3D';
	private $_mapping_db = array();

	function __construct(){	
		$this->_target_urls = array(
				'list' => 'http://openapi1.nhis.or.kr/openapi/service/rest/HmcSearchService/getRegnHmcList',
				'trans' => 'http://openapi1.nhis.or.kr/openapi/service/rest/HmcSpecificInfoService/getHmcTransInfoDetail',
				'work' => 'http://openapi1.nhis.or.kr/openapi/service/rest/HmcSpecificInfoService/getWorkHourInfoDetail',
				'sigungu' => 'http://openapi1.nhis.or.kr/openapi/service/rest/CodeService/getSiGunGuList',
			);

		$this->_mapping_db = array(



			 'ai_name' =>'hmcNm' ,				
			 'ai_number' => 'hmcNo',				
			 'ai_phone' => 'hmcTelNo',				
			 'ai_x' => 'cxVl',				
			 'ai_y' => 'cyVl',				
			 'ai_ex_fax' => 'exmdrFaxNo',				
			 'ai_ex_phone' => 'exmdrTelNo',				
			 'ai_gren_cd' => 'grenChrgTypeCd',				
			 'ai_bc_cd' => 'bcExmdChrgTypeCd',				
			 'ai_cc_cd' => 'ccExmdChrgTypeCd',				
			 'ai_cvxca_cd' => 'cvxcaExmdChrgTypeCd',				
			 'ai_ichk_cd' => 'ichkChrgTypeCd',				
			 'ai_lvca_cd' => 'lvcaExmdChrgTypeCd',				
			 'ai_mchk_cd' => 'mchkChrgTypeCd',				
			 'ai_stmca_cd' => 'stmcaExmdChrgTypeCd',				
			 'ai_addr' => 'locAddr',				
			 'ai_post' => 'locPostNo',				
			 'ai_sido_cd' => 'siDoCd',				
			 'ai_sigungu_cd' => 'siGunGuCd',				
			 'ai_lunch_start' => 'wkdayLunchFrTm',				
			 'ai_lunch_end' => 'wkdayLunchToTm',				
			 'at_inc_bus_yn' => 'inctBusInfoInYn',				
			 'at_inc_bus_goal' => 'inctBusGoffJijumNm',				
			 'at_inc_bus' => 'inctBusRouteInfo',
			 'at_sbwy_yn' => 'sbwyInfoInYn',				
			 'at_sbwy_route' => 'sbwyRouteInfo',				
			 'at_sbwy_goal' => 'sbwyGoffJijumNm',				
			 'at_vll_bus_yn' => 'vllgBusInfoInYn',				
			 'at_vll_bus_goal' => 'vllgBusGoffJijumNm',				
			 'at_vll_bus_route' => 'vllgBusRouteInfo',

			 'at_inc_bus_way' => 'inctBusYoyangDrt',
			 'at_inc_bus_dis' => 'inctBusYoyangDstc',
			 'at_sbwy_way' => 'sbwyYoyangDrt',
			 'at_sbwy_dis' => 'sbwyYoyangDstc',
			 'at_vll_bus_way' => 'vllgBusYoyangDrt',
			 'at_vll_bus_dis' => 'vllgBusYoyangDstc',
				 

			 'ap_pay_yn' => 'pkgCostBrdnYn',				
			 'ap_number' => 'pkgPsblCnt',				
			 'ap_self_yn' =>'pkglotRunYn',				
			 'ap_comment' => 'pkgEtcComt',	
				 
			'ap_satYn'  => 'satAllSusmdtYn',
			'ap_sat_jin_start'  => 'satMcareFrTm',					
			'ap_sat_jin_end'  => 'satMcareToTm',					
			'ap_sat_rsv_start'  => 'satRecvFrTm',					
			'ap_sat_rsv_end'  => 'satRecvToTm',					

			'ap_lun_start'  => 'wkdayLunchFrTm',					
			'ap_lun_end'  => 'wkdayLunchToTm',					

			'ap_jin_start'  => 'wkdayMcareFrTm',					
			'ap_jin_end'  => 'wkdayMcareToTm',					
			'ap_rsv_start'  => 'wkdayRecvFrTm',					
			'ap_rsv_end'  => 'wkdayRecvToTm',
		);
	}


	function & getDataByName($name){
		$params = array(			
			'hmcNm' => urlencode($name),
			'ServiceKey' => $this->_key,
			'numOfRows' => 100,
		);	

		$result = $this->getDataByUrl($this->_target_urls['list'], $params);
		$object = simplexml_load_string($result);	

		$header = get_object_vars($object->header);


		$data = array();
		if($header && $header['resultCode'] == '00' ){		

			$items = get_object_vars($object->body->items);
			if(array_key_exists('item', $items)){			
				
				if(is_object($items['item'])){
					$data[] = get_object_vars($items['item']);
				}else if(is_array($items['item'])){
					foreach($items['item'] as $value){
						$data[] = get_object_vars($value);									
					}			
				}				
			}
		}else $data = 'limited';
		
		return $data;
	}

	//api로 접속이 안됨. access denied error
	function & getListSigungu($sido_code, $gungu_code){
		$params = array(			
			'siDoCd' => $sido_code,
			'siGunGuCd' => $gungu_code,
			'ServiceKey' => $this->_key,			
		);

		$result_string = simplexml_load_string($this->getDataByUrl($this->_target_urls['sigungu'], $params));
		$result = $this->_xmlToArray($result_string);

	}

	function & getTrafficDataByCode($code){
		if(!$code || !is_string($code) ) return false;

		$params = array(			
			'ykiho' => $code,
			'ServiceKey' => $this->_key,
		);

		$result_string = simplexml_load_string($this->getDataByUrl($this->_target_urls['trans'], $params));
		$result = $this->_xmlToArray($result_string);
		
		$return = false;
		if(array_key_exists('header', $result) && array_key_exists('resultCode', $result['header']) && $result['header']['resultCode'] != '00') return $return;

		if(!array_key_exists('cmmMsgHeader', $result) && array_key_exists('body', $result) && array_key_exists('item', $result['body']) ){		
			$return = & $result['body']['item'];		
		}		
		
		return $return;
	}

	function & getWorkByCode($code){
		if(!$code || !is_string($code) ) return false;

		$params = array(			
			'ykiho' => $code,
			'ServiceKey' => $this->_key,
		);

		$result_string = simplexml_load_string($this->getDataByUrl($this->_target_urls['work'], $params));		
		$result = $this->_xmlToArray($result_string);		


		if(array_key_exists('header', $result) && array_key_exists('resultCode', $result['header']) && $result['header']['resultCode'] != '00') return false;

		$return = 'nodata';
		if(!array_key_exists('cmmMsgHeader', $result) && array_key_exists('body', $result) && array_key_exists('item', $result['body']) ){		
			$return = & $result['body']['item'];		
		}
		return $return;
	}

	function getCodeByNameAddr($name, $addr){
		$data = & $this->getDataByName($name);

		if($data == 'limited') return false;

		$result = array();
		if(is_array($data) && count($data) > 0){
			foreach($data as $k => $v){
				if($v['locAddr'] == $addr){
					$result = $v;
					break;
				}
			}
		}

		return $result;
	}

	function getDataByUrl($url, $params = array()){
		$result = array();
		if(count($params) > 0){
			foreach($params as $k => $p){
				$result[] = $k.'='.$p;
			}			
		}
		$target_url =  $url.'?'.implode('&', $result);		
		return @file_get_contents($target_url);
	}

	function setArgsByData(&$args, $default, $traffic, $work){

		$args['ai_name'] = $default[$this->_mapping_db['ai_name']];
		$args['ai_number'] = $default[$this->_mapping_db['ai_number']];
		$args['ai_phone'] = $default[$this->_mapping_db['ai_phone']];
		$args['ai_x'] = $default[$this->_mapping_db['ai_x']];
		$args['ai_y'] = $default[$this->_mapping_db['ai_y']];
		$args['ai_ex_fax'] = $default[$this->_mapping_db['ai_ex_fax']];
		$args['ai_ex_phone'] = $default[$this->_mapping_db['ai_ex_phone']];
		$args['ai_gren_cd'] = $default[$this->_mapping_db['ai_gren_cd']];
		$args['ai_bc_cd'] = $default[$this->_mapping_db['ai_bc_cd']];
		$args['ai_cc_cd'] = $default[$this->_mapping_db['ai_cc_cd']];
		$args['ai_cvxca_cd'] = $default[$this->_mapping_db['ai_cvxca_cd']];
		$args['ai_ichk_cd'] = $default[$this->_mapping_db['ai_ichk_cd']];
		$args['ai_lvca_cd'] = $default[$this->_mapping_db['ai_lvca_cd']];
		$args['ai_mchk_cd'] = $default[$this->_mapping_db['ai_mchk_cd']];
		$args['ai_stmca_cd'] = $default[$this->_mapping_db['ai_stmca_cd']];
		$args['ai_addr'] = $default[$this->_mapping_db['ai_addr']];
		$args['ai_post'] = $default[$this->_mapping_db['ai_post']];
		$args['ai_sido_cd'] = $default[$this->_mapping_db['ai_sido_cd']];
		$args['ai_sigungu_cd'] = $default[$this->_mapping_db['ai_sigungu_cd']];
		$args['ai_lunch_start'] = $work[$this->_mapping_db['ai_lunch_start']];
		$args['ai_lunch_end'] = $work[$this->_mapping_db['ai_lunch_end']];	


		$args['at_inc_bus_yn'] = $traffic[$this->_mapping_db['at_inc_bus_yn']];		
		$args['at_inc_bus'] = $traffic[$this->_mapping_db['at_inc_bus']];
		$args['at_inc_bus_goal'] = $traffic[$this->_mapping_db['at_inc_bus_goal']];
		$args['at_sbwy_yn'] = $traffic[$this->_mapping_db['at_sbwy_yn']];
		$args['at_sbwy_route'] = $traffic[$this->_mapping_db['at_sbwy_route']];
		$args['at_sbwy_goal'] = $traffic[$this->_mapping_db['at_sbwy_goal']];
		$args['at_vll_bus_yn'] = $traffic[$this->_mapping_db['at_vll_bus_yn']];
		$args['at_vll_bus_goal'] = $traffic[$this->_mapping_db['at_vll_bus_goal']];
		$args['at_vll_route'] = $traffic[$this->_mapping_db['at_vll_route']];

		$args['at_inc_bus_way'] = $traffic[$this->_mapping_db['at_inc_bus_way']];
		$args['at_inc_bus_dis'] = $traffic[$this->_mapping_db['at_inc_bus_dis']];
		$args['at_sbwy_way'] = $traffic[$this->_mapping_db['at_sbwy_way']];
		$args['at_sbwy_dis'] = $traffic[$this->_mapping_db['at_sbwy_dis']];
		$args['at_vll_bus_way'] = $traffic[$this->_mapping_db['at_vll_bus_way']];
		$args['at_vll_bus_dis'] = $traffic[$this->_mapping_db['at_vll_bus_dis']];
		


		$args['ap_pay_yn'] = $work[$this->_mapping_db['ap_pay_yn']];
		$args['ap_number'] = $work[$this->_mapping_db['ap_number']];
		$args['ap_self_yn'] = $work[$this->_mapping_db['ap_self_yn']];
		$args['ap_comment'] = $work[$this->_mapping_db['ap_comment']];

		$args['ap_satYn'] = $work[$this->_mapping_db['ap_satYn']];
		$args['ap_sat_jin_start'] = $work[$this->_mapping_db['ap_sat_jin_start']];
		$args['ap_sat_jin_end'] = $work[$this->_mapping_db['ap_sat_jin_end']];
		$args['ap_sat_rsv_start'] = $work[$this->_mapping_db['ap_sat_rsv_start']];
		$args['ap_sat_rsv_end'] = $work[$this->_mapping_db['ap_sat_rsv_end']];
		$args['ap_lun_start'] = $work[$this->_mapping_db['ap_lun_start']];
		$args['ap_lun_end'] = $work[$this->_mapping_db['ap_lun_end']];
		$args['ap_jin_start'] = $work[$this->_mapping_db['ap_jin_start']];
		$args['ap_jin_end'] = $work[$this->_mapping_db['ap_jin_end']];
		$args['ap_rsv_start'] = $work[$this->_mapping_db['ap_rsv_start']];
		$args['ap_rsv_end'] = $work[$this->_mapping_db['ap_rsv_end']];

	}

	function setArgsByAddData(&$args, $work){

		$args['ap_pay_yn'] = $work[$this->_mapping_db['ap_pay_yn']];
		$args['ap_number'] = $work[$this->_mapping_db['ap_number']];
		$args['ap_self_yn'] = $work[$this->_mapping_db['ap_self_yn']];
		$args['ap_comment'] = $work[$this->_mapping_db['ap_comment']];

		$args['ap_satYn'] = $work[$this->_mapping_db['ap_satYn']];
		$args['ap_sat_jin_start'] = $work[$this->_mapping_db['ap_sat_jin_start']];
		$args['ap_sat_jin_end'] = $work[$this->_mapping_db['ap_sat_jin_end']];
		$args['ap_sat_rsv_start'] = $work[$this->_mapping_db['ap_sat_rsv_start']];
		$args['ap_sat_rsv_end'] = $work[$this->_mapping_db['ap_sat_rsv_end']];
		$args['ap_lun_start'] = $work[$this->_mapping_db['ap_lun_start']];
		$args['ap_lun_end'] = $work[$this->_mapping_db['ap_lun_end']];
		$args['ap_jin_start'] = $work[$this->_mapping_db['ap_jin_start']];
		$args['ap_jin_end'] = $work[$this->_mapping_db['ap_jin_end']];
		$args['ap_rsv_start'] = $work[$this->_mapping_db['ap_rsv_start']];
		$args['ap_rsv_end'] = $work[$this->_mapping_db['ap_rsv_end']];
	}

	private function _xmlToArray($xml){
		$return = false;

		if(is_object($xml)){
			$xml = get_object_vars($xml);
			$return = $this->_xmlToArray($xml);
		}else if(is_array($xml) && count($xml) > 0){
			foreach($xml as $k => $v){
				$return[$k] = $this->_xmlToArray($v);
			}
		}else{
			$return = $xml;
		}
		return $return;		
	}

	



}
?>
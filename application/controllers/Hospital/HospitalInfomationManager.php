<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HospitalInfomationManager{
	
	function onInit(&$ci){
		$ci->load->model('Members/MemberGroup', 'member_groupModel');
		$ci->load->model('Members/Members', 'memberModel');	
		$ci->load->model('Members/Hospital', 'hospitalModel');
		$ci->load->model('Members/HospitalFileModel', 'fileModel');
		$ci->load->model('Agency/AgencyModel', 'AgencyModel');
		$ci->load->model('Agency/AgencyParkModel', 'ParkModel');
		$ci->load->model('Agency/AgencyTrafficModel', 'TrafficModel');
		$ci->load->model('Agency/AgencyImageModel', 'imageModel');
	}

	function index(&$data, &$ci){
		
	}	

	function doList(&$data, &$ci){

	}

	function doCash(&$data, &$ci){
		
	}

	
}
?>

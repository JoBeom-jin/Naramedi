<?php
function print_r2($var) {
	ob_start();
	print_r($var);
	$str = ob_get_contents();
	ob_end_clean();
	$str = preg_replace("/ /", "&nbsp;", $str);
	echo nl2br("<span style=\'font-family:Tahoma, 굴림; font-size:9pt;\'>$str</span>");
}


function custom_event_list($code, $count){

	$ci =& get_instance();

	$event_list = $ci->db->query("SELECT ei_seq, ei_img_banner, ei_name, ei_ages, ei_ctime, ei_start, ei_end ,ei_account, ei_original_account, ei_hiseq, ei_types, ei_status FROM okmedi.event_info where ei_types LIKE '%".$code."%' and ei_status != 'end' ORDER BY ei_seq DESC limit ".$count.";");

	// foreach ($event_list->result_array() as $row) {
	// 	echo $row['ecs_name'];
	// }

	$event_list = $event_list->result_array();
	// print_r($event_list);

	return $event_list;
}

function getHosInfo($ei_hiseq){

	$ci =& get_instance();

	// $eventinfo = $ci->db->query("SELECT hi_seq, hi_open_name, hi_org_number FROM okmedi.hospital_info WHERE hi_seq = ".$ei_hiseq);
	// $eventinfo_array = $eventinfo->result_array();

	$hosinfo = $ci->db->query("SELECT hi_seq, hi_open_name, hi_org_number, hd_addr1, hd_addr2, hd_addr FROM okmedi.hospital_info JOIN okmedi.hospital_default ON hi_org_number = hd_code WHERE hi_seq = ".$ei_hiseq.";");
	$hosinfo_array = $hosinfo->result_array();

	return $hosinfo_array;

}

function replaceText($text){

	$patternValue = array('/AGE001/', '/AGE002/', '/AGE003/', '/AGE004/', '/AGE005/', '/AGE006/', '/TYP001/', '/TYP002/', '/TYP003/', '/TYP004/', '/TYP005/', '/TYP006/');
	$replaceValue = array('10대', '20대', '30대','40대','50대','60대 이상','2030검진','3040검진','5060검진','예비부부검진','여성정밀검진','숙박검진');

	$test = preg_replace($patternValue, $replaceValue, $text);

	echo $test;
}




?>
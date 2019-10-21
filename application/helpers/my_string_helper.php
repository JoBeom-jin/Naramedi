<?
defined('BASEPATH') OR exit('No direct script access allowed');
function biz_str2date($time){
	if(!$time) return '';
	$year = substr($time, 0, 4);
	$month = substr($time, 4, 2);
	$day = substr($time, 6, 2);
	$hour = substr($time, 8, 2);
	$min = substr($time, 10, 2);
	$sec = substr($time, 12, 2);

	return $year.'.'.$month.'.'.$day.' '.$hour.':'.$min.':'.$sec;
}
?>
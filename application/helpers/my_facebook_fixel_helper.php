<?
/*
* key : controller_action
* 컨트롤러와 action을 통해 각 페이지에 facebook fixel 이벤트 코드를 추가합니다.
*/
function printFbqs($fbqs_list){
	if(!is_array($fbqs_list) || count($fbqs_list) < 1) return false;
	$codes = array_keys($fbqs_list);
	foreach($codes as $k => $id){
		echo "fbq('track', '{$id}');";
	}	
}

function getFbqs($controller = false, $action = false){
	if(!is_string($controller) || !is_string($action)) return array();

	$fbqs_list = array(
		'MapSearch_index' => array(
			'ViewContent'=>array(),
			'Search' => array(),
			'Lead' => array()
		),
	);

	$key = $controller.'_'.$action;

	if(array_key_exists($key, $fbqs_list)){
		return $fbqs_list[$key];
	}else{
		return array();
	}
}


?>
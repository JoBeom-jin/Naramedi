<?
$_site_config = array(

	/* 사이트 기본정보 (필수 정보)*/
	'site' => array(
		'site_id' => 'cms',
		'title' => 'Contents Manager System',
		'logo' => 'CMS',
	),

	/* 사이트 메뉴 정보 (필수 정보) */
	'menu' => array(
		'type' => 'file',
	),

	'auth' => array(
		'model' => 'Members/Members',
	),

	'adminGroup' => array('SUPERVISOR', 'MANAGER', 'SUBMANAGER'),
	'first_menu' => array(
		'SUPERVISOR' => '/index.php/Manager/contents/dashboard_crrt',
		'MANAGER' => '/index.php/Manager/contents/dashboard_crrt',
		'SUBMANAGER' => '',
	),
);




$_site_config['menu'] = array(
	'type' => 'file',
);


/* 사이트 권한정보 */
$_site_config['url']['root'] = '/index.php/';
$_site_config['url']['index'] = $_site_config['url']['root'].'close_mall';
$_site_config['url']['contents'] = $_site_config['url']['root'].'close_mall/contents';

$_site_config['url']['resource'] = '/resource';
$_site_config['url']['images'] = $_site_config['url']['resource'].'images';
$_site_config['url']['css'] = $_site_config['url']['resource'].'/css';
$_site_config['url']['js'] = $_site_config['url']['resource'].'/js';
$_site_config['url']['upload'] = '/upload';
$_site_config['url']['board_files'] = $_site_config['url']['upload'].'/board_files';


$_site_config['dir']['root'] = dirname(dirname(dirname(dirname(__FILE__))));
$_site_config['dir']['upload'] = $_site_config['dir']['root'].DIRECTORY_SEPARATOR.'upload';
$_site_config['dir']['board_files'] = $_site_config['dir']['upload'].DIRECTORY_SEPARATOR.'board_files';

$config['site_config'] = &$_site_config;

?>

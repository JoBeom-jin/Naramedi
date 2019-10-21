<?
$config['menu_list'] = array(


	'login' => array(
		'title' => '로그인',
		'hidden' => true,
		'childs' => array(
			'login' => array(
				'title'=>'로그인 페이지',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Login_login',
			),
			'logout' => array(
				'title'=>'로그아웃',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Login_logout',
			),
		),
	),

	// 'close' => array(
	// 	'title' => '폐쇄몰관리',
	// 	'hidden' => false,
	// 	'childs' => array(
	// 		'shopmng' => array(
	// 			'title'=>'폐쇄몰관리',
	// 			'frame'=>'default',
	// 			'access_groups' => false,
	// 			'controller' => 'CloseMall_CloseMallManager',
	// 		),
	// 	),
	// ),

	'reserv' => array(
		'title' => '예약관리',
		'hidden' => false,
		'childs' => array(
			'normal' => array(
				'title'=>'예약관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'CloseMall_NormalReserve',
			),
		),
	),


);
?>

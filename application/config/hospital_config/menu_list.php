<?
$config['menu_list'] = array(
	'login' => array(
		'title' => '로그인 로그아웃',
		'hidden' => true,
		'childs' => array(
			'logout' => array(
				'title'=>'로그아웃',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Login_logout',									
			),
		),
	),
	
	'reserve' => array(
		'title' => '예약자관리',
		'hidden' => false,
		'childs' => array(
			'phone' => array(
				'title'=>'전화예약입력',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_PhoneReserveHospitalManager',									
			),
			'wait' => array(
				'title'=>'대기자현황',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_StayReserveHospitalManager',									
			),
			'total' => array(
				'title'=>'누적예약자현황',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_CompleteReserveHospitalManager',									
			),
		),
	),


	'event' => array(
		'title' => '이벤트관리',
		'hidden' => false,
		'childs' => array(
			'eventmng' => array(
				'title'=>'이벤트 관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_EventManager',									
			),
			'statistics' => array(
				'title'=>'통계관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_CountManager',									
			),
		),
	),


	'cash' => array(
		'title' => '캐쉬관리',
		'hidden' => false,
		'childs' => array(
			'cashmng' => array(
				'title'=>'캐쉬 내역',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Hospital_HospitalCashManager',									
			),
		),
	),


	'info' => array(
		'title' => '병원정보관리',
		'hidden' => false,
		'childs' => array(
			'auth' => array(
				'title'=>'계정정보 관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Member_HospitalMyInfo',									
			),
			'hospital' => array(
				'title'=>'병원정보 관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Member_MyHospitalInfo',									
			),
		),
	),


	'notice' => array(
		'title' => '공지사항 관리',
		'hidden' => false,
		'childs' => array(
			'board' => array(
				'title'=>'병원 공지사항',
				'frame'=>'default',
				'controller' => 'Board_BoardDefault',	
				'params' => array(
					'bc_id' => 'noticehospital'
				)								
			),
		),
	),




);
?>
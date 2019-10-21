<?
$config['menu_list'] = array(
	'dashboard' => array(
		'title' => '대쉬보드',
		'hidden' => false,
		'childs' => array(
			'crrt' => array(
				'title'=>'상황판',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'DashBoard_TotalManager',
			),
		),

	),
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
			'loginout' => array(
				'title'=>'로그아웃',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Login_logout',
			),
		),
	),

	'member' => array(
		'title' => '회원관리',
		'hidden' => false,
		'childs' => array(
			'list' => array(
				'title'=>'회원목록',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Member_member',
				'hidden' => false
			),

			'groups' => array(
				'title'=>'회원그룹관리',
				'frame'=>'default',
				'access_groups' => array('SUPERVISOR'),
				'controller' => 'Member_group',
				'hidden' => false
			),


			'user' => array(
				'title'=>'일반회원관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Member_user',
				'hidden' => false
			),

			'hosjoin' => array(
				'title'=>'병원 회원 가입 승인',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Member_HospitalMember',
				'hidden' => false
			),

			'hosmng' => array(
				'title'=>'병원 회원 관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Member_HostpitalJoinedMember',
				'hidden' => false
			),

			'userfaq' => array(
				'title'=>'온라인 1:1상담',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Manager_Faq',
				'hidden' => false
			),
		),
	),

	'hos' => array(
		'title' => '병원관리',
		'hidden' => false,
		'childs' => array(
			'joined' => array(
				'title'=>'제휴병원 관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Hospital_AffiliatedHospital',
			),
			'mng' => array(
				'title'=>'검진기관 관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Agency_AgencyManager',
			),
			'question' => array(
				'title'=>'제휴문의',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Member_GuideManager',
			),

			'out' => array(
				'title'=>'검진기관 API 테스트',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Agency_AgencyDefault',
			),

			'photo' => array(
				'title'=>'병원사진 자동입력',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Hospital_HospitalPhoto',
			),
		),
	),

	'reserv' => array(
		'title' => '예약관리',
		'hidden' => false,
		'childs' => array(
			'normal' => array(
				'title'=>'예약관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Reserve_NormalReserve',
			),
			'phone' => array(
				'title'=>'전화예약 관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Reserve_PhoneReserve',
			),
		),
	),


	'event' => array(
		'title' => '이벤트관리',
		'hidden' => false,
		'childs' => array(
			'stay' => array(
				'title'=>'승인대기 이벤트',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_AllEventManager',
				'params'=>array(
					'type' => 'wait'
				)
			),
			'ing' => array(
				'title'=>'진행중인 이벤트',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_AllEventManager',
				'params'=>array(
					'type' => 'ing'
				)
			),
			'past' => array(
				'title'=>'지난 이벤트',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_AllEventManager',
				'params'=>array(
					'type' => 'ended'
				)
			),
			'banner' => array(
				'title'=>'이벤트 배너관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_EventBanner',
			),


			'device' => array(
				'title'=>'기기 통계',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_DeviceAnalytics',
			),

			'reply' => array(
				'title'=>'후기관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_ReplyManager',
			),

			'category' => array(
				'title'=>'카테고리 관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_EventCategoryManager',
				'params'=>array(
					'type' => 'category'
				)
			),

			'categorysub' => array(
				'title'=>'카테고리 세부 관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_EventCategorySubManager',
				'params'=>array(
					'type' => 'categorysub'
				)
			),

		),
	),


	'board' => array(
		'title' => '게시판관리',
		'hidden' => false,
		'access_groups' => array('SUPERVISOR', 'MANAGER'),
		'childs' => array(
			'mng' => array(
				'title'=>'게시판 관리',
				'frame'=>'default',
				'access_groups' => array('SUPERVISOR'),
				'controller' => 'BoardManager_BoardManager',
			),
			'healthboard' => array(
				'title'=>'건강정보 게시판',
				'frame'=>'default',
				'access_groups' => array('SUPERVISOR', 'MANAGER'),
				'controller' => 'Board_BoardDefault',
				'params' => array(
					'bc_id' => 'healthinfo'
				)
			),

			'normalnotice' => array(
				'title'=>'일반 공지사항',
				'frame'=>'default',
				'access_groups' => array('SUPERVISOR', 'MANAGER'),
				'controller' => 'Board_BoardDefault',
				'params' => array(
					'bc_id' => 'nusernotice'
				)
			),

			'hosboard' => array(
				'title'=>'병원 공지사항',
				'frame'=>'default',
				'access_groups' => array('SUPERVISOR', 'MANAGER'),
				'controller' => 'Board_BoardDefault',
				'params' => array(
					'bc_id' => 'noticehospital'
				)
			),
		),
	),

	'close' => array(
		'title' => '폐쇄몰관리',
		'hidden' => false,
		'childs' => array(
			'shopmng' => array(
				'title'=>'폐쇄몰관리',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'CloseShop_CloseShopManager',
			),
		),
	),

	'hansin' => array(
		'title' => '한신이벤트',
		'hidden' => false,
		'childs' => array(
			'users' => array(
				'title'=>'고객목록(수원)',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Hansin_HansinUsers',
			),
			'newyear' => array(
				'title'=>'고객목록(새해)',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Hansin_HansinUsersCustom',
			),
			'monthlyevent' => array(
				'title'=>'고객목록(월간)',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Hansin_HansinUsersMonthly',
			),
			'kosfoevent' => array(
				'title'=>'고객목록(코스포)',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Hansin_HansinUsersKosfo',
			),
		),
	),


	'code' => array(
		'title' => '그룹 및 코드관리',
		'hidden' => false,
		'access_groups' => array('SUPERVISOR'),
		'childs' => array(
			'codelist' => array(
				'title'=>'코드 목록',
				'frame'=>'default',
				'access_groups' => array('SUPERVISOR'),
				'controller' => 'Code_codeManager',
			),
		),
	),

	'analytics' => array(
		'title' => '통계관리',
		'hidden' => false,
		'access_groups' => false,
		'childs' => array(
			'codelist' => array(
				'title'=>'Google Analytics',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => false,
				'url' => 'https://analytics.google.com/analytics/web/?authuser=0#realtime/rt-overview/a108011009w161260884p162392088/'
			),

			'listview' => array(
				'title'=>'이벤트 통계',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_Analytics',
			),
		),
	),

	'sms' => array(
		'title' => 'SMS',
		'hidden' => false,
		'access_groups' => array('SUPERVISOR'),
		'childs' => array(
			'codelist' => array(
				'title'=>'SMS 기능 테스트',
				'frame'=>'default',
				'access_groups' => array('SUPERVISOR'),
				'controller' => 'SMS_SmsSender',
			),
		),
	),
);
?>

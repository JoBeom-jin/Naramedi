<?
$config['menu_list'] = array(
	'search' => array(
		'title' => '검진기관찾기',
		'hidden' => false,
		'childs' => array(
			'hospital' => array(
				'title'=>'검진기관 검색',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_MapSearch',
				'descript' => '국내 검진 기관 정보를 검색. 이름으로 검색할 가능하며 맵 정보를 통하여 주변의 검진기관을 빠르게 검색할 수 있다.'
			),
//			'test' => array(
//				'title'=>'검색메뉴',
//				'frame'=>'default',
//				'access_groups' => false,
//				'controller' => 'Event_MapTest',
//			),
		),
	),

	'search2' => array(
		'title' => '검진기관찾기',
		'hidden' => true,
		'childs' => array(
			'hospital2' => array(
				'title'=>'검진기관 검색',
				'frame'=>'okplus',
				'access_groups' => false,
				'controller' => 'Event_MapSearch2',
				'descript' => '국내 검진 기관 정보를 검색. 이름으로 검색할 가능하며 맵 정보를 통하여 주변의 검진기관을 빠르게 검색할 수 있다.'
			),
		),
	),


	'hot' => array(
		'title' => '핫딜',
		'hidden' => false,
		'childs' => array(
			'hospital' => array(
				'title'=>'핫딜 병원 검색',
				'frame'=>'default',
				'access_groups' => false,
//				'controller' => 'Event_HotdealEvent',
				'controller' => 'Hotdeal_UserPage',
				'icon' => '/resource/images/medical/icons/menu_hot_icon.png',
				'descript' => 'OK건강검진의 제휴업체가 진행하는 이벤트 중 가장 핫한 이벤트들을 모아두었습니다.',
			),

			'test' => array(
				'title'=>'핫딜 병원 검색',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Hotdeal_UserPage',
				'icon' => '/resource/images/medical/icons/menu_hot_icon.png',
				'descript' => 'OK건강검진의 제휴업체가 진행하는 이벤트 중 가장 핫한 이벤트들을 모아두었습니다.',
			),

		),
	),

	'event' => array(
		'title' => '이벤트',
		'hidden' => false,
		'childs' => array(
			'hospital' => array(
				'title'=>'이벤트 검색',
				'frame'=>'default',
				'access_groups' => false,
//				'controller' => 'Event_EventUser',
				'controller' => 'Event_EventUserPage',
				'descript' => 'OK건강검진의 제휴업체가 진행하는 이벤트 다양한 이벤트들을 볼 수 있습니다.',
			),

			'test' => array(
				'title'=>'이벤트 테스트',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Event_EventUserPage',
				'descript' => 'OK건강검진의 제휴업체가 진행하는 이벤트 다양한 이벤트들을 볼 수 있습니다.',
			),
		),
	),

	'okmedi' => array(
		'title' => 'OK건강정보',
		'hidden' => false,
		'childs' => array(
			'healthboard' => array(
				'title'=>'건강정보 게시판',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Board_HealthBoard',
				'params' => array(
					'bc_id' => 'healthinfo'
				),
				'descript' => 'OK건강검진은 일반인들이 잘 모르거나 건강에 도움이 되는 정보를 주기적으로 업로드 하고 있습니다.',
			),
		),
	),

	'okmedi2' => array(
		'title' => 'OK건강정보',
		'hidden' => true,
		'childs' => array(
			'healthboard2' => array(
				'title'=>'건강정보 게시판',
				'frame'=>'okplus',
				'access_groups' => false,
				'controller' => 'Board_HealthBoard',
				'params' => array(
					'bc_id' => 'healthinfo'
				),
				'descript' => 'OK건강검진은 일반인들이 잘 모르거나 건강에 도움이 되는 정보를 주기적으로 업로드 하고 있습니다.',
			),
		),
	),

	'notice' => array(
		'title' => '공지사항',
		'hidden' => true,
		'childs' => array(
			'notice' => array(
				'title'=>'공지사항',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Board_UserNoticeBoard',
				'params' => array(
					'bc_id' => 'nusernotice'
				),
				'descript' => 'OK건강검진의 공지사항 게시판입니다. 중요 변경사항이나 알림 내용들을 전달합니다.',
			),
		),
	),


	'login' => array(
		'title' => '로그인',
		'hidden' => true,
		'childs' => array(
			'login' => array(
				'title'=>'로그인 폼',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Login_UserLogin',
				'descript' => '로그인 페이지 입니다. 아이디와 비밀번호를 정확하게 입력해주세요.',
			),
		),
	),


	'my' => array(
		'title' => '유저메뉴',
		'hidden' => true,
		'childs' => array(
			'lastest' => array(
				'title'=>'최근본상품',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'My_Lastest',
				'descript' => '사용자가 최근 돌아본 상품(이벤트) 목록입니다. ',
			),

			'change' => array(
				'title'=>'정보변경',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'My_Myinfo',
				'descript' => '로그인된 사용자의 정보를 변경합니다.',
			),

			'reserve' => array(
				'title'=>'내가 한 예약 목록',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'My_Reserved',
				'descript' => '로그인한 유저가 한 예약 목록을 보여줍니다.',
			),


			'checked' => array(
				'title'=>'찜한 이벤트',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'My_CheckedEvent',
				'descript' => '사용자가 찜한 이벤트 목록입니다. 찜한 이벤트를 다시 보거나 찜하기를 취소하실 수 있습니다.',
			),

			'check' => array(
				'title'=>'이벤트찜하기',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'My_CheckEvent',
			),

			'myinfo' => array(
				'title'=>'개인정보 변경',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'My_Myinfo',
				'descript' => '로그인한 사용자 정보를 변경합니다. ',
			),

			'reply' => array(
				'title'=>'후기남기기',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'My_Reply',
				'descript' => '직접 방문한 기관이나 이벤트에 대하여 남긴 후기를 확인하고 삭제할 수 있습니다. ',
			),
		),
	),


	'etc' => array(
		'title' => '기타',
		'hidden' => true,
		'childs' => array(
			'intro' => array(
				'title'=>'OK검진소개',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Site_Html',
				'params' => array('do' => 'intro' ),
				'descript' => 'OK검진은 전국 7000여개의 검진기관 정보와 30여개의 제휴병원 정보를 제공하고 있습니다.',
			),
			'fileupload' => array(
				'title'=>'파일 업로드',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Site_Fileupload',
			),
			'guide' => array(
				'title'=>'제휴문의',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Member_Guide',
				'descript' => 'OK검진과 함께할 병원을 찾습니다.',
			),

			'terms' => array(
				'title'=>'이용약관',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Site_Html',
				'params' => array('do' => 'terms' ),
				'descript' => 'OK검진 이용약관 입니다.',
			),

			'personal' => array(
				'title'=>'개인정보취급방침',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Site_Html',
				'params' => array('do' => 'personal' ),
				'descript' => 'OK검진 개인정보 취급방침 정보입니다.',
			),

			'gcenter' => array(
				'title'=>'고객센터',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Site_Html',
				'params' => array('do' => 'guide' ),
				'descript' => 'OK검진 고객센터입니다. 문의를 남겨주시면 빠른 시간내에 답을 해드리겠습니다.',
			),

			'logout' => array(
				'title'=>'로그아웃',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Login_logout',
			),
			'joinout' => array(
				'title'=>'회원탈퇴',
				'frame'=>'default',
				'access_groups' => false,
				'controller' => 'Login_Joinout',
			),
		),
	),


);
?>

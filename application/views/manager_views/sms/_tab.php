<h2 class="title">SMS 관리 및 테스트 메뉴입니다.</h2>

<div class="btn-area-left">
	<a href="<?=$menu_url?>" class="btn btn-<?if($act == 'index'):?>primary<?else:?>default<?endif;?>">결과로그</a>
	<a href="<?=$menu_url?>/msgList" class="btn btn-<?if($act == 'msgList'):?>primary<?else:?>default<?endif;?>">보낸목록</a>
	<a href="<?=$menu_url?>/testSMS" class="btn btn-<?if($act == 'testSMS'):?>primary<?else:?>default<?endif;?>">SMS테스트</a>
</div>
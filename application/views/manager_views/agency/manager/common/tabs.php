<div id="agency-tab-menu">
	<div class="btn-area-left">	
		<a href="<?=$menu_url?>/" class="btn <?if($act == 'index'):?>btn-primary<?else:?>btn-default<?endif;?>">검진기관 목록</a>
		<a href="<?=$menu_url?>/duplicate" class="btn <?if($act == 'duplicate'):?>btn-primary<?else:?>btn-default<?endif;?>">검진기관 중복 목록</a>
		<a href="<?=$menu_url?>/addInfo" class="btn <?if($act == 'addInfo' || $act == 'individual'):?>btn-primary<?else:?>btn-default<?endif;?>">검진기관 추가 정보 관리</a>
	</div>
</div>
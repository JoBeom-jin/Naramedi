<div id="my-tab-menu" >
	<ul class="tab-list">		
		<li <?if($act == 'index'):?>class="active"<?endif;?> >
			<a href="<?=$menu_url?>">일반검색</a>
		</li>
		<li <?if($act == 'detail'):?>class="active"<?endif;?>>
			<a href="<?=$menu_url?>/detail">상세검색</a>
		</li>
		<li <?if($act == 'part'):?>class="active"<?endif;?>>
			<a href="<?=$menu_url?>/part">부위별검색</a>
		</li>
	</ul>
</div>
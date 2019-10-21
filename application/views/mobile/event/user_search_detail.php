<div id="event-list">
	<!-- 슬라이더 시작-->
	<div id="wrapper2" style="margin-bottom:10px;">
		<ul id="adaptive" class="cs-hidden">
			<?if(is_array($banner_images) && count($banner_images) > 0):?>
			<?foreach($banner_images as $img):?>
			<li class="item-e"> 
				<a href="/m/index.php/mobile/contents/event_hospital/viewEvent?seq=<?=$img['ei_seq']?>">
					<img src="<?=$img['url']?>" alt="<?=$img['name']?>">
				</a>
			 </li>
			<?endforeach;?>
			<?endif;?>		
		</ul>	
	</div>
	<!-- END :: 슬라이더 -->	
	
	<?=$event_search_tab_menu?>	

</div>



<?=$event_search_footer?>
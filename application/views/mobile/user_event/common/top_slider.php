<!-- 슬라이더 시작-->
<div id="wrapper2" style="height:auto;">
	<ul id="adaptive" class="cs-hidden">
		<?if(is_array($banner_images) && count($banner_images) > 0):?>		
		<?$idx = 0;?>
		<?foreach($banner_images as $img):?>
		<li class="item-e" <?if($idx != 0):?>style="display:none;"<?endif;?>> 
			<a href="/m/index.php/mobile/contents/event_hospital/viewEvent?seq=<?=$img['ei_seq']?>">
				<img src="<?=$img['url']?>" alt="<?=$img['name']?>">
			</a>
		 </li>
		 <?$idx++;?>
		<?endforeach;?>
		<?endif;?>
	</ul>	
</div>
<!-- END :: 슬라이더 -->

<script>
$(document).ready(function(){
	$('.item-e').attr('style', '');
});
</script>
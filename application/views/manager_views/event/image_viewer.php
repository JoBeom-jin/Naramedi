<div id="image-viewer">
	<?if(array_key_exists('img_top', $event) && $event['img_top']):?>
	<div>
		<img src="<?=$event['img_top']?>" alt="상단 이미지" />
	</div>
	<?endif;?>
	<?if(array_key_exists('img_middle', $event) && $event['img_middle']):?>
	<div>
		<img src="<?=$event['img_middle']?>" alt="중단 이미지" />
	</div>
	<?endif;?>
	<?if(array_key_exists('img_bottom', $event) && $event['img_bottom']):?>
	<div>
		<img src="<?=$event['img_bottom']?>" alt="하단 이미지" />
	</div>
	<?endif;?>	
</div>

<style type="text/css">
.window-form #content .cont {padding:0; margin:0;}
#image-viewer{width:1000px;}
#image-viewer div{width:1000px; overflow:hidden;}
#image-viewer div img{width:100%;}
</style>
<section class="block4">
	<div style="height: 30px"></div>
</section>
<div id="wrapper2" style="position:relative; overflow:hidden; height:499px;">
	<ul id="adaptive" class="cs-hidden">
		<?if(is_array($banner_images) && count($banner_images) > 0):?>
		<?foreach($banner_images as $img):?>
		<li class="item-e"> 
			<a href="/index.php/medical/contents/event_hospital/viewEvent?seq=<?=$img['ei_seq']?>">
			<img src="<?=$img['url']?>" alt="<?=$img['name']?>" style="width:1142px; height:499px;" >
			</a>
		 </li>
		<?endforeach;?>
		<?endif;?>		
	</ul>	
</div>
<section class="hero-image" style="height: 640px !important;">
	<div class="background" style="background:url(/resource/images/medical/event_banner.png) center;">
	</div>
</section>
<section class="container" id="user-event-list" style="padding-left: 0 !important; padding-right: 0 !important;">
	<!-- 슬라이더 -->
	<!-- <?=$top_slider?> -->
	
	<!-- 탭 메뉴 -->
	<?=$tab_menu?>
	
	<!-- 일반 검색 -->
	<form method="get" action="<?=$menu_url?>/<?=$act?>" id="search-form">
		<input type="hidden" name="hi_seq" value="<?=$hi_seq?>" />		
		<input type="hidden" name="local" value="<?=$local_value?>" />		
		<input type="hidden" name="type" value="<?=$type_value?>" />
		<input type="hidden" name="sort" value="<?=$sort_value?>" />
		<input type="hidden" name="goto_page" value="<?=$page_value?>" />
	</form>

	<figure id="search-opts" class="filter clearfix">
		<div class="location-search">
			<div>				
				<img src="/resource/images/medical/icons/area_off_01.png" data-hover="/resource/images/medical/icons/area_on_01.png" alt="전체지역" data-local="" <?if(!$local_value):?>class="selected"<?endif;?>>				
			</div>
			<div>				
				<img src="/resource/images/medical/icons/area_off_02.png" data-hover="/resource/images/medical/icons/area_on_02.png" alt="서울 경기 인천" data-local="서울경기인천" <?if($local_value=='서울경기인천'):?>class="selected"<?endif;?>>				
			</div>
			<div>				
				<img src="/resource/images/medical/icons/area_off_03.png" data-hover="/resource/images/medical/icons/area_on_03.png"  alt="충청" 	data-local="충청도" <?if($local_value=='충청도'):?>class="selected"<?endif;?>>				
			</div>
			<div>				
				<img src="/resource/images/medical/icons/area_off_04.png" data-hover="/resource/images/medical/icons/area_on_04.png"  alt="전라도" data-local="전라도" <?if($local_value=='전라도'):?>class="selected"<?endif;?>>				
			</div>
			<div>			
				<img src="/resource/images/medical/icons/area_off_05.png" data-hover="/resource/images/medical/icons/area_on_05.png"  alt="경상" data-local="경상도" <?if($local_value=='경상도'):?>class="selected"<?endif;?>>				
			</div>
			<div>				
				<img src="/resource/images/medical/icons/area_off_06.png" data-hover="/resource/images/medical/icons/area_on_06.png"  alt="강원" data-local="강원도" <?if($local_value=='강원도'):?>class="selected"<?endif;?>>				
			</div>

			<div>				
				<img src="/resource/images/medical/icons/area_off_07.png" data-hover="/resource/images/medical/icons/area_on_07.png"  alt="제주" data-local="제주도" <?if($local_value=='제주도'):?>class="selected"<?endif;?>>				
			</div>			
		</div>

		<div class="type-search">
			<div>				
				<img src="/resource/images/medical/icons/kind_off_01.png" data-hover="/resource/images/medical/icons/kind_on_01.png" alt="전체유형" data-type="" <?if(!$type_value):?>class="selected"<?endif;?>/>				
			</div>
			<div>				
				<img src="/resource/images/medical/icons/kind_off_02.png" data-hover="/resource/images/medical/icons/kind_on_02.png" alt="2030검진" data-type="TYP001" <?if($type_value=='TYP001'):?>class="selected"<?endif;?>/>				
			</div>
			<div>
				
				<img src="/resource/images/medical/icons/kind_off_03.png" data-hover="/resource/images/medical/icons/kind_on_03.png" alt="3040검진" data-type="TYP002" <?if($type_value=='TYP002'):?>class="selected"<?endif;?>/>				
			</div>
			<div>
				
				<img src="/resource/images/medical/icons/kind_off_04.png" data-hover="/resource/images/medical/icons/kind_on_04.png" alt="5060검진" data-type="TYP003" <?if($type_value=='TYP003'):?>class="selected"<?endif;?>/>				
			</div>
			<div>
				<img src="/resource/images/medical/icons/kind_off_05.png" data-hover="/resource/images/medical/icons/kind_on_05.png" alt="예비부부검진" data-type="TYP004" <?if($type_value=='TYP004'):?>class="selected"<?endif;?>/>
			</div>
			<div>				
				<img src="/resource/images/medical/icons/kind_off_06.png" data-hover="/resource/images/medical/icons/kind_on_06.png" alt="여성정밀검진" data-type="TYP005" <?if($type_value=='TYP005'):?>class="selected"<?endif;?>/>				
			</div>
			<div>				
				<img src="/resource/images/medical/icons/kind_off_07.png" data-hover="/resource/images/medical/icons/kind_on_07.png" alt="숙박검진" data-type="TYP006" <?if($type_value=='TYP006'):?>class="selected"<?endif;?>/>				
			</div>			
		</div>
	</figure>

	<!-- 소트 메뉴 -->
	<?=$sort_menu?>

	<!-- 이벤트 리스트 -->	
	<section class="block equal-height"  style="padding: 1px;">
		<div class="row" id="event-photo-list" data-total="">
			
		</div>										
		<!--/.row-->
	</section>
	<!--end Listing Grid-->

	<div class="btn-area-center">
		<a href="#" id="more-btn" id="more-btn" class="btn btn-default" style="color:white; width:99%;" onclick="return false;">더보기</a>
	</div>

</section>


<script>
/*tab hover*/
var local_img = false;
var local_off_images = new Array();
var local_on_images = new Array();
var local_select_num = 0;

var type_img = false;
var type_off_images = new Array();
var type_on_images = new Array();
var type_select_num = 0;

$(document).ready(function(){
	initTabs();
	runHoverImage();
	runClickImage();	
});

function initTabs(){
	local_img = $('#search-opts .location-search img');
	$.each(local_img, function(i, item){
		if($(item).hasClass('selected')){
			$(item).attr('src',	$(item).attr('src').replace('_off_', '_on_') );				
		}else{
			$(item).attr('src',	$(item).attr('src').replace('_on_', '_off_') );				
		}
	});

	type_img = $('#search-opts .type-search img');
	$.each(type_img, function(i, item){
		if($(item).hasClass('selected')){
			$(item).attr('src',	$(item).attr('src').replace('_off_', '_on_') );				
		}else{
			$(item).attr('src',	$(item).attr('src').replace('_on_', '_off_') );				

		}
	});
}

function runHoverImage(){	
	local_img.on('mouseenter', function(e){
		var image = $(this).attr('src');

		if(!$(this).hasClass('selected')){ 
			$(this).attr('src',  image.replace('_off_', '_on_'));
		}
	});

	local_img.on('mouseleave', function(e){
		var image = $(this).attr('src');

		if(!$(this).hasClass('selected')){ 
			$(this).attr('src',  image.replace('_on_', '_off_'));
		}
	});


	type_img.on('mouseenter', function(e){
		var image = $(this).attr('src');

		if(!$(this).hasClass('selected')){ 
			$(this).attr('src',  image.replace('_off_', '_on_'));
		}
	});

	type_img.on('mouseleave', function(e){
		var image = $(this).attr('src');

		if(!$(this).hasClass('selected')){ 
			$(this).attr('src',  image.replace('_on_', '_off_'));
		}
	});	
}

function runClickImage(){
	local_img.on('click', function(){
		if(!$(this).hasClass('selected')){
			$('input[name="local"]').val( encodeURI($(this).data('local')));
			local_img.removeClass('selected');
			$(this).attr('class', 'selected');
			initTabs();

			$('input[name="hi_seq"]').val('');
			clear_area();
			more_list();
		}		
	});

	type_img.on('click', function(){
		if(!$(this).hasClass('selected')){
			$('input[name="type"]').val($(this).data('type'));
			type_img.removeClass('selected');
			$(this).attr('class', 'selected');
			initTabs();	
			clear_area();
			more_list();
		}		
	});
}


</script>
<?=$contents_footer?>
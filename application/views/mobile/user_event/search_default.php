<div id="event-list">
	<!-- 슬라이더 -->
	<?=$top_slider?>
	
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

	<figure id="search-opts">
		<div class="location-search area" style="overflow-x:scroll;">
			<ul style=" margin:0px; ">
				<li data-local="" <?if(!$local_value):?>class="selected"<?endif;?>>
					전체지역	
				</li>
				<li data-local="서울경기인천" <?if($local_value=='서울경기인천'):?>class="selected"<?endif;?>>
					서울/경기/인천				
				</li>
				<li data-local="충청도" <?if($local_value=='충청도'):?>class="selected"<?endif;?>>
					충청도
				</li>
				<li  data-local="전라도" <?if($local_value=='전라도'):?>class="selected"<?endif;?>>
					전라도				
				</li>
				<li data-local="경상도" <?if($local_value=='경상도'):?>class="selected"<?endif;?>>
					경상도			
				</li>
				<li data-local="강원도" <?if($local_value=='강원도'):?>class="selected"<?endif;?>>
					강원도			
				</li>
				<li data-local="제주도" <?if($local_value=='제주도'):?>class="selected"<?endif;?>>
					제주도			
				</li>
			</ul>
			<span class="clear"></span>
		</div>
		<div class="type-search area" style="overflow-x:scroll;">
			<ul style=" margin:0px;">
				<li data-type="" <?if(!$type_value):?>class="selected"<?endif;?>>전체검진<span class="type-search-dot">●</span></li>
				<li data-type="TYP001" <?if($type_value=='TYP001'):?>class="selected "<?endif;?>>2030검진<span class="type-search-dot">●</span></li>
				<li data-type="TYP002" <?if($type_value=='TYP002'):?>class="selected "<?endif;?>>3040검진<span class="type-search-dot">●</span></li>
				<li data-type="TYP003" <?if($type_value=='TYP003'):?>class="selected "<?endif;?>>5060검진<span class="type-search-dot">●</span></li>
				<li data-type="TYP004" <?if($type_value=='TYP004'):?>class="selected "<?endif;?>>예비부부검진<span class="type-search-dot">●</span></li>
				<li data-type="TYP005" <?if($type_value=='TYP005'):?>class="selected "<?endif;?>>여성정밀검진<span class="type-search-dot">●</span></li>
				<li data-type="TYP006" <?if($type_value=='TYP006'):?>class="selected "<?endif;?>>숙박검진<span class="type-search-dot">●</span></li>
			</ul>
			<span class="clear"></span>
		</div>
	</figure>

	<!-- 소트 메뉴 -->
	<?=$sort_menu?>

	<!-- 이벤트 리스트 -->	
	<section class="block equal-height" >
		<div class="row" id="event-photo-list" data-total="" style="margin:0px;">
			
		</div>										
		<!--/.row-->
	</section>
	<!--end Listing Grid-->

	<div class="btn-area-center btn-area-renew">
		<a href="#" id="more-btn" id="more-btn" class="btn btn-default" style="color:white; width:100%;" onclick="return false;">더보기</a>
	</div>

</div>


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
		if($(item).hasClass('selected selected2')){
			$(item).attr('src',	$(item).attr('src').replace('_off_', '_on_') );	
						
		}else{
			$(item).attr('src',	$(item).attr('src').replace('_on_', '_off_') );		
			
		}
	});

	local_txt = $('#search-opts .location-search li');
	$.each(local_txt, function(i, item){
		if($(item).hasClass('selected')){
			$(item).addClass('selected3');				
		}else{
			$(item).removeClass('selected3');				
		}
	});

	type_txt = $('#search-opts .type-search ul li');
	$.each(type_txt, function(i, item){
		if($(item).hasClass('selected')){
			$(item).addClass('selected2');
			$(item).children('.type-search-dot').css('visibility','visible');
		}else{
			$(item).removeClass('selected2');
			$(item).children('.type-search-dot').css('visibility','hidden');
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
	local_txt.on('click', function(){
		if(!$(this).hasClass('selected')){
			$('input[name="local"]').val( encodeURI($(this).data('local')));
			local_txt.removeClass('selected');
			$(this).attr('class', 'selected');
			initTabs();

			$('input[name="hi_seq"]').val('');
			clear_area();
			more_list();
		}		
	});

	type_txt.on('click', function(){
		if(!$(this).hasClass('selected')){
			$('input[name="type"]').val($(this).data('type'));
			type_txt.removeClass('selected');
			$(this).attr('class', 'selected');
			initTabs();	
			clear_area();
			more_list();
		}		
	});
	
	
}


</script>
<?=$contents_footer?>
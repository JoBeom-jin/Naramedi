<div id="event-list">
	<!-- 슬라이더 -->
	<?=$top_slider?>
	
	<!-- 탭 메뉴 -->
	<?=$tab_menu?>
	<div id="event_detail-search" class="block6 bg-white3" >
		<form method="get" action="<?=$menu_url?>/<?=$act?>" id="search-form">
			<input type="hidden" name="max_account" value="<?=$max_value?>" />
			<input type="hidden" name="min_account" value="<?=$min_value?>" />
			<input type="hidden" name="sort" value="<?=$sort_value?>" />
			<input type="hidden" name="goto_page" value="<?=$page_value?>" />			
			<input type="hidden" name="select_city" value="<?=$city_value?>" />			
			<input type="hidden" name="gungu" value="<?=$local_value?>" />			
			<input type="hidden" name="age" value="<?=$age_value?>" />						
			<?if(isset($codes_array) && is_array($codes_array) && count($codes_array) > 0):?>
			<?foreach($codes_array as $k => $v):?>
			<input type="hidden" name="codes[]" value="<?=$v?>" />									
			<?endforeach;?>
			<?endif;?>

			<div class="btn-area-center" style="position:relative;">
				<input type="button" value="상세검색하기" class="btn2 btn-primary btn-full modal-trigger" />
				<img type="button" src="/resource/images/mobile/bottom-arrow-icon.png" alt="bottom-arrow-icon" style="float:right;position: absolute; right: 30px; top: 15px; cursor: pointer;">
			</div>			
		</form>		
	</div>

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


var search_form = false;

$(document).ready(function(){		
	search_form = $('#search-form');
	

	search_form.on('submit', function(e){
		e.preventDefault();		
		clear_area();
		more_list();
	});
});




$(document).ready(function(){
	<?if(!$not_act_modal):?>
	runModal();
	<?endif;?>

	$('.modal-trigger').on('click', function(e){
		e.preventDefault();	
		runModal();				
	});

});

function runModal(){
	$('<div/>').addClass('modal-window multichoice fade_in').appendTo('body');
	$('<div/>').addClass('modal-background fade_in').appendTo('.modal-window');
	$('<div/>').addClass('modal-wrapper').appendTo('.modal-window');
	$('<div/>').addClass('modal-body').appendTo('.modal-wrapper');
	$('<div/>').addClass('modal-close').appendTo('.modal-body');
	$('<img src="/resource/assets/img/close.png" />').appendTo('.modal-close');
	$('<div/>').addClass('modal-content').appendTo('.modal-body');
	
	var html_name = $(this).data('name');
	var ai_seq = $(this).data('seq');
	modalFrame();
}


function modalFrame(){		
	var hangle = $('input[name="select_city"]').val();
	$('input[name="select_city"]').val(encodeURI(hangle));
	var query = $('#search-form').serialize();
	$('input[name="select_city"]').val(hangle);
	$('.modal-content').load( '<?=$menu_url?>/detailForm?'+query, function() {
		var rtl = false; // Use RTL
		initializeOwl(rtl);
		drawOwlCarousel(rtl);

		 rating('.modal-content');
	});

	$('.modal-window .modal-background, .modal-close').on('click',  function(e){
		$('.modal-window').addClass('fade_out');
		setTimeout(function() {
			$('.modal-window').remove();
		}, 300);
	});
}


function reloadModalFrame(ai_seq){


	$('.modal-content').load( '/m/index.php/mobile/html?id=hosinfo&seq='+ai_seq, function() {
		var rtl = false; // Use RTL
		initializeOwl(rtl);
		drawOwlCarousel(rtl);
		 rating('.modal-content');

		$('#tab-1').removeClass('active');
		$('#tab-2').addClass('active');
		$('#tab_default_1').css('display', 'none');
		$('#tab_default_2').css('display', 'block');
	});

}


</script>
<?=$contents_footer?>
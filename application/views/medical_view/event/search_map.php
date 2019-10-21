<!-- Map Canvas-->
<style>
	#toTop{
		visibility: hidden;
	}
	#page-footer, #hidden-space{
		display: none;
	}
	#page-content{
		padding-bottom: 0;
	}
</style>
<div class="map-canvas list-width-30" style="padding-top: 130px;">

	<!-- Map -->
	<div class="map">

		<div class="toggle-navigation" id="map-resize-icon">
			<div class="icon">
				<div class="line"></div>
				<div class="line"></div>
				<div class="line"></div>
			</div>
		</div>

		<!--/오른쪽 지도 부분-->
		<div class="search-bar horizontal">

			<form class="main-search border-less-inputs" role="form" method="post" onsubmit="return searchByAddr(this);">
				<div class="input-row" style="margin-top:8px;">
					<div class="form-group notauto" style="width:100%;">
						<div class="input-group location">	
							<input type="text" class="form-control" name="addr" id="location" placeholder="검색지역 및 검진기관을 입력해주세요." style="width:90%; margin-right:20px;">
							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
						</div>						
					</div>
				</div>
				<!-- /.input-row -->
			</form>
			<!-- /.main-search -->
		</div>

		<!--/.toggle-navigation-->
		<div id="map" class="has-parallax"></div>

		
		<!-- 오른쪽 지도 부분 끝p -->
	</div>


	<!--왼쪽 병원 리스트 부분 -->
	<div class="items-list">
		<div class="inner">
			<div class="scroller1">
				<div class="filter">
					<form id="main-search" class="main-search" role="form" method="GET" action="<?=$menu_url?>/<?=$act?>">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<label for="location">병원명 검색</label>
									<div class="input-group location">
										<input type="text" id="ai-name" name="ai_name" value="<?=$ai_name?>" class="form-control" placeholder="병원명을 입력하세요." >	
									</div>
								</div>
								<!-- /.form-group -->
							</div>
						</div>
						<!--/.row-->
					</form>
				</div>
				<!--end Filter-->

				<h3 class="pull-left"><span id="row-total"><?=number_format($total)?></span> 개의 결과가 있습니다. </h3>

				<ul id="main-left-list" class="results list">
					<?if(isArray_($list)):?>					
					<?foreach($list as $k => $v):?>					
					
					<li>
						<div class="item" id="<?=$k+1?>" data-seq="<?=$v['ai_seq']?>">
							<a href="#" class="image loaded">
								<div class="inner">
									<div class="item-specific"></div>
									<?if(array_key_exists($v['ai_seq'], $thums)):?>
									<img src="<?=$thums[$v['ai_seq']]['url']?>" alt="" class="mCS_img_loaded">
									<?else:?>
									<img src="/resource/images/medical/map_images/none_image.png" alt="" class="mCS_img_loaded">
									<?endif;?>
								</div>
							</a>
							
							<div class="wrapper">
								<a href="#" id="<?=$k+1?>"><h3><?=$v['ai_name']?></h3></a>
								<figure>
									<?=$v['ai_addr']?>
								</figure>
								
								
								<div class="price">
								<?if($v['has_event']):?>
									<img src="/resource/images/medical/icons/icon_event.png" alt="이벤트 중" />
								<?endif;?>
								<?if($v['is_alied']):?>
									<img src="/resource/images/medical/icons/icon_alied.png" alt="제휴 중" />
								<?endif;?>								
								</div>
								

								<div class="info">
									<div class="rating" data-rating="4">
										<span class="stars">
<!-- 											<i class="fa fa-star s1" data-score="1"></i> -->
<!-- 											<i class="fa fa-star s2" data-score="2"></i> -->
<!-- 											<i class="fa fa-star s3" data-score="3"></i> -->
<!-- 											<i class="fa fa-star s4" data-score="4"></i> -->
<!-- 											<i class="fa fa-star s5" data-score="5"></i> -->
										</span>
									</div>
								</div>
							</div>
						</div>						
					</li>
					<?endforeach;?>
					<?endif;?>
				</ul>
				<div class="btn-area-center" style="margin-bottom:30px;">
					<?if($ai_name):?>
					<input type="button" value="더보기" id="more-btn" class="btn btn-default" data-page="<?=$page_total?>" style="width:95%;" onclick="searchNextPage()"/>
					<?else:?>
					<input type="button" value="더보기" id="more-btn" class="btn btn-default" style="width:95%;" onclick="nextPage()"/>
					<?endif;?>
				</div>

				<div id="default-location" class="hide" data-x="<?=$default_x?>" data-y="<?=$default_y?>" data-zoom="<?=$default_zoom?>"></div>				
			</div>
			<!--results-->
		</div>
		<!--end Items List-->
	</div>

</div>
<!-- end Map Canvas-->
<!--Featured-->


<script type="text/javascript" src="/resource/assets/js/jquery.nouislider.all.min.js"></script>
<script type="text/javascript" src="/resource/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCWkP87YE94jxFb3nSPHSTzSb9VsijOFTg&amp;libraries=places"></script>
<script type="text/javascript" src="/resource/assets/js/infobox.js"></script>
<script type="text/javascript" src="/resource/assets/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="/resource/assets/js/markerclusterer.js"></script>
<script type="text/javascript" src="/resource/assets/js/new_maps.js"></script>

<script type="text/javascript">

$(window).load(function(){
	var rtl = false; // Use RTL
	initializeOwl(rtl);
});

autoComplete();

var defalut_lat = 37.5640907;
var default_lng = 126.99794029999998;

var change_lat = false;
var change_lng = false;

$(document).ready(function(){
	change_lat = $('#default-location').data('x');
	change_lng = $('#default-location').data('y');
	change_zoom = $('#default-location').data('zoom');

	getCurrentLocation(change_lat, change_lng, change_zoom);
});

function searchByAddr(form){
	$('#ai-name').val('');
	var geocoder = new google.maps.Geocoder();
	var addr_value = form.addr.value;
	var lat = '';
	var lng = '';

	geocoder.geocode(
		{'address':addr_value},
		function(results, status){

			if(results != ""){
				var location = results[0].geometry.location;
				lat = location.lat();
				lng = location.lng();
				
				document.location.href='/index.php/medical/contents/search_hospital/index?x='+lat+'&y='+lng;
			}
			else $("#map_canvas").html("위도와 경도를 찾을 수 없습니다.");
			
		}
	);	
	return false;
}


function getCurrentLocation(x, y, zoom){
	if(x && y && x != '' && y != ''){
		createGoogleMap(x,y, zoom);
	}else{		

		//위치를 찾을 수 없을 경우. 서울특별시를 기준으로 한다.
		 if (navigator.geolocation) {				 
			 navigator.geolocation.getCurrentPosition(function(cposition){	
				var pos = {
					lat: cposition.coords.latitude,
					lng: cposition.coords.longitude
				};					


				createGoogleMap(pos.lat,pos.lng, zoom);
			 },
			 function(error) { 
				 createGoogleMap(defalut_lat,default_lng, zoom);
				 }
			 );

		 }else{
			 createGoogleMap(defalut_lat,default_lng, zoom);
		 }	
	}
}


function modalFrame(html_name, ai_seq){		
	
	$('.modal-content').load( '/index.php/medical/html?id='+html_name+'&seq='+ai_seq, function() {
		var rtl = false; // Use RTL
		initializeOwl(rtl);
		drawOwlCarousel(rtl);

		 rating('.modal-content');
	});

	$('.modal-window .modal-background, .modal-close').live('click',  function(e){
		$('.modal-window').addClass('fade_out');
		setTimeout(function() {
			$('.modal-window').remove();
		}, 300);
	});
}

function reloadModalFrame(ai_seq){
	

	$('.modal-content').load( '/index.php/medical/html?id=hosinfo&seq='+ai_seq, function() {
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

var map = false;
function createSimpleMap(new_lat, new_lng, el_id) {
	var uluru = {lat: new_lat, lng: new_lng};
	 map = new google.maps.Map(document.getElementById(el_id), {
	  zoom: 18,
	  center: uluru
	});

	var marker = new google.maps.Marker({
	  position: uluru,
	  map: map
	});
}


/*검색시 paging*/
var cpage = 1;
function searchNextPage(){
	cpage++;
	var total_page = $('#more-btn').data('page');
	if(cpage >= total_page){
		$('#more-btn').val('마지막 페이지 입니다.');
	}
	
	
	var name = $('input[name="ai_name"]').val();
	if(name){
	var json_url = '<?=$menu_url?>/paging?q_page='+cpage+'&ai_name='+name;

	//json 부분
		var json_obj = $.getJSON(json_url)
		.done(function(json) {	
			if(json.length < 1){
				alert('마지막 페이지 입니다.');
			}else{
				for(var i = 0; i < json.length ; i++){
					addList(json[i], i);		
				}				
			}
		}); //json 종료	
	}
}

function addList(data, i){
	var target = $('#main-left-list');
	var id = data['ai_seq'];

	var list_area = $('<li/>');
	var item_area = $('<div/>').attr({
		'id' : id,
		'data-seq' : id,
		'class' : 'item'
	});

	item_area.appendTo(list_area);

	//item	
	var inner_image_loaded = $('<a/>').attr({
		'href' : '#',
		'class' : 'image loaded',
	});

	var inner_area = $('<div/>').attr({
		'class' : 'inner'
	});

	var item_specific = $('<div/>').attr({'class':'item-specific'});
	var thum_image = $('<img/>').attr({'src':data['thum'], 'class':'mCS_img_loaded', 'alt':''});

	item_specific.appendTo(inner_area);
	thum_image.appendTo(inner_area);
	inner_area.appendTo(inner_image_loaded);
	inner_image_loaded.appendTo(item_area);
	// end item

	// wrapper
	var wrapper_ = $('<div/>').attr({'class':'wrapper'});
	var link_ = $('<a/>').attr({'href':'#', 'id':id});
	var h3_ = $('<h3/>').html(data['ai_name']);
	var figure_ = $('<figure/>').html(data['ai_addr']);
	var price_ = $('<div/>').attr({'class':'price'});
	price_.html(data['has_event']+''+data['is_alied']);	


	h3_.appendTo(link_);
	link_.appendTo(wrapper_);
	figure_.appendTo(wrapper_);
	price_.appendTo(wrapper_);
	wrapper_.appendTo(item_area);
	// wrapper end

	var info_  = $('<div/>').attr({'class':'info'});
	var rating_ = $('<div/>').attr({'class' : 'rating', 'data-rating':'4'});
	var star_ = $('<span/>').attr({'class' : 'starts'});
	star_.appendTo(rating_);
	rating_.appendTo(info_);
	info_.appendTo(item_area);
	
	
	list_area.appendTo(target);

}
</script>

<script>
	$(document).ready(function(){
		var sch_string = $('#ai-name').val();
		fbq('track', 'Search', { 
			search_string: sch_string,
			content_category: 'pc_map_search',
		});
	});
</script>
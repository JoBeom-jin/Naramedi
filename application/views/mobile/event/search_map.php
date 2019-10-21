<!-- Map Canvas-->
<div class="map-canvas" id="map-search">

	<!-- Map -->
	<div class="map" id="map-search-area">		

		<!--/오른쪽 지도 부분-->
		<div class="search-bar horizontal">

			<form class="main-search border-less-inputs" role="form" method="post" onsubmit="return searchByAddr(this);">
				<div class="input-row" style="margin-top:8px;">
					<div class="form-group notauto" style="width:100%;">
						<div class="input-group location" style="text-align:center;">	
							<input type="text" class="form-control" name="addr" id="location" placeholder="지역 또는 검진기관을 입력해주세요." style="ime-mode:auto">
							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
						</div>						
					</div>
				</div>
				<!-- /.input-row -->
			</form>
			<!-- /.main-search -->
		</div>
		<!--/.toggle-navigation-->

		<div id="map-area">
			<div class="map-btn-area">				
				<input type="button" value=" 현재위치에서 검색된 검진기관 보기 >> " id="list-btn" onclick="listPage();"/>
			</div>
			<div id="map" class="has-parallax"></div>
		</div>		
		<!-- 오른쪽 지도 부분 끝p -->
		<div id="default-location" class="hide" data-x="<?=$default_x?>" data-y="<?=$default_y?>" data-zoom="<?=$default_zoom?>"></div>	
	</div>


</div>
<!-- end Map Canvas-->
<!--Featured-->


<script type="text/javascript" src="/resource/assets/js/jquery.nouislider.all.min.js"></script>
<script type="text/javascript" src="/resource/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="/resource/assets/js/mobile.custom.js"></script>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCWkP87YE94jxFb3nSPHSTzSb9VsijOFTg&amp;libraries=places"></script>
<script type="text/javascript" src="/resource/assets/js/infobox.js"></script>
<script type="text/javascript" src="/resource/assets/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="/resource/assets/js/markerclusterer.js"></script>
<script type="text/javascript" src="/resource/assets/js/mobile.maps.js"></script>

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


var list_menu_url = '';
function setListMenu(x, y){
	var default_url = '/m/index.php/mobile/contents/search_hospital/doList?';
	list_menu_url = default_url+'x='+x+'&y='+y;
}

function listPage(){
	document.location.href=list_menu_url;
}

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
				
				document.location.href='/m/index.php/mobile/contents/search_hospital/index?x='+lat+'&y='+lng;
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
			 navigator.geolocation.getCurrentPosition(function(position){
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
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
			console.log(json);
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
	var list_area = $('#map-list-area');
	function toggleList(){
//		if(list_area.is(':visible')){
//			list_area.hide(1000);
//			$('#map-search-area').show();
//		}else{
//			$('#map-search-area').hide();			
//			list_area.show(1000);			
//		}				
	}


	$(document).ready(function(){
		$('#list-btn').on('click', function(){
			toggleList();
		});
		var sch_string = $('#ai-name').val();
		fbq('track', 'Search', { 
			search_string: sch_string,
			content_category: 'pc_map_search',
		});
	});


	var cookie_path = "<?=$menu_url?>";	
	function setCookie(x, y, zoom){
		document.cookie='mapX='+x;
		document.cookie='mapY='+y;
		document.cookie='mapZoom='+zoom;
	}
</script>
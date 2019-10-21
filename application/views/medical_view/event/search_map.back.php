<!-- Map Canvas-->
<div class="map-canvas list-width-30">

	<!-- Map -->
	<div class="map">

		<div class="toggle-navigation">
			<div class="icon">
				<div class="line"></div>
				<div class="line"></div>
				<div class="line"></div>
			</div>
		</div>

		<!--/.toggle-navigation-->
		<div id="map" class="has-parallax"></div>

		<!--/오른쪽 지도 부분-->
		<div class="search-bar horizontal">

			<form class="main-search border-less-inputs" role="form" method="post" onsubmit="return searchByAddr(this);">
				<div class="input-row" style="margin-top:8px;">
					<div class="form-group notauto" style="width:100%;">
						<div class="input-group location">	
							<input type="text" class="form-control" name="addr" id="location" placeholder="검색하실 지역을 입력하세요." style="width:90%; margin-right:20px;">
<!-- 							<span class="input-group-addon">								 -->
<!-- 								<i class="fa fa-map-marker geolocation" data-toggle="tooltip" data-placement="bottom" title="Find my position"></i> -->
<!-- 							</span> -->
							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
						</div>						
					</div>
				</div>
				<!-- /.input-row -->
			</form>
			<!-- /.main-search -->
		</div>
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
					<?$default_x = false;?>
					<?$default_y = false;?>
					<?if(isArray_($list)):?>					
					<?foreach($list as $k => $v):?>					
					<?if(!$default_x) $default_x = $v['ai_x'];?>
					<?if(!$default_y) $default_y = $v['ai_y'];?>
					
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

				<div id="default-location" class="hide" data-x="<?=$default_x?>" data-y="<?=$default_y?>"></div>

				<?if($paging && count($paging->pages) > 0):?>
				<!--Pagination-->
				<nav id="pagination">
					<ul class="pagination pull-right">

						<?if($paging->page > 1):?>
						<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->prev)?>&amp;ai_name=<?=$ai_name?>" class="previous"><i class="fa fa-angle-left"></i></a></li>
						<?endif;?>

						<?foreach($paging->pages as $k => $v):?>
						<li <?if($v == $paging->page):?>class="active"<?endif;?>>
							<a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($v)?>&amp;ai_name=<?=$ai_name?>"><?=$v?></a>
						</li>
						<?endforeach;?>
						<?if($paging->next > 0):?>
						<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->next)?>" class="next"><i class="fa fa-angle-right"></i></a></li>
						<?endif;?>
					</ul>
				</nav>
				<!--end Pagination-->
				<?endif;?>
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

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCWkP87YE94jxFb3nSPHSTzSb9VsijOFTg&sensor=false&amp;libraries=places"></script>
<script type="text/javascript" src="/resource/assets/js/infobox.js"></script>
<script type="text/javascript" src="/resource/assets/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="/resource/assets/js/markerclusterer.js"></script>
<script type="text/javascript" src="/resource/assets/js/maps.js"></script>

<script type="text/javascript">

var defalut_lat = 37.5640907;
var default_lng = 126.99794029999998;
createHomepageGoogleMap(defalut_lat,default_lng);

$(window).load(function(){
	var rtl = false; // Use RTL
	initializeOwl(rtl);
});

autoComplete();


$(document).ready(function(){	
	getCurrentLocation();
});

function searchByAddr(form){
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
				
				createHomepageGoogleMap(lat, lng);
			}
			else $("#map_canvas").html("위도와 경도를 찾을 수 없습니다.");
			
		}
	);	
	return false;
}


function getCurrentLocation(){

	//위치를 찾을 수 없을 경우. 서울특별시를 기준으로 한다.
	 if (navigator.geolocation) {				 
		 navigator.geolocation.getCurrentPosition(function(position){
			var pos = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};					
			createHomepageGoogleMap(pos.lat,pos.lng);
		 },
		 function(error) { 
//			 var lat = defalut_lat;
//			 var lng = default_lng;
//			 createHomepageGoogleMap(lat,lng);
		 }
		 );

	 }else{
//		 var lat = defalut_lat;
//		 var lng = default_lng;
//		 createHomepageGoogleMap(lat,lng);
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
</script>
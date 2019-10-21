"use strict";
var $ = jQuery.noConflict();

var mapStyles = [ {"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"},{"lightness":20}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"on"},{"lightness":10}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":50}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#a1cdfc"},{"saturation":30},{"lightness":49}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"hue":"#f49935"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"hue":"#fad959"}]}, {featureType:'road.highway',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-92},{lightness:60},{visibility:'on'}]}, {featureType:'landscape.natural',elementType:'all',stylers:[{hue:'#c8c6c3'},{saturation:-71},{lightness:-18},{visibility:'on'}]},  {featureType:'poi',elementType:'all',stylers:[{hue:'#d9d5cd'},{saturation:-70},{lightness:20},{visibility:'on'}]} ];

// Set map height to 100% ----------------------------------------------------------------------------------------------
var $body = $('body');
if( $body.hasClass('map-fullscreen') ) {
    if( $(window).width() > 768 ) {
        $('.map-canvas').height( $(window).height() - $('.header').height() );
    }
    else {
        $('.map-canvas #map').height( $(window).height() - $('.header').height() );
    }
}

var data_list = [];		//기본 json data. 맵에 노출될 데이터를 보관


function createGoogleMap(_latitude,_longitude, default_zoom){
	$.get("/resource/assets/external/_infobox.js", function() {
        gMap();
    });


	function gMap(){
		
		/*
		* infobox  그리기
		*/
		function createInfoBox(marker, seq){
			return function(){
				 google.maps.event.addListener(map, 'click', function(event) {
                        lastClicked = marker;
                    });
				activeMarker = marker;

				if( activeMarker != lastClicked ){
					newMarkers.forEach(function(maker_){
						if(maker_.content && maker_.content.className) maker_.content.className = 'marker-loaded';
						if(maker_.infobox) maker_.infobox.close();
					});						
				}

				marker.infobox.open(map, this);
				marker.infobox.setOptions({ boxClass:'fade-in-marker'});
				marker.content.className = 'marker-active marker-loaded';
				markerClicked = 1;
				
			}
		}

		function closeInfoBox(marker, seq){
			return function(){
				activeMarker = 0;
				marker.content.className = 'marker-loaded';
				marker.infobox.setOptions({ boxClass:'fade-out-marker' });
			}
		}


		//클러스터 옵션
		var clusterStyles = [{ url: '/resource/assets/img/cluster.png', height: 34, width: 34}];
		var clusterOptions = {gridSize:80, minimumClusterSize: 1, styles: clusterStyles, maxZoom: 19 };

		if(!default_zoom) default_zoom = 16;
		
		/*기본 맵 생성*/	
		var mapCenter = new google.maps.LatLng(_latitude,_longitude);
		var maxZoomLevel = 13;

		var mapOptions = {
            zoom: default_zoom,
			maxZoom : 20,
			minZoom : 2,
            center: mapCenter,
            disableDefaultUI: false,
            scrollwheel: true,
            styles: mapStyles,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.BOTTOM_CENTER
            },
            panControl: false,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
				position : google.maps.ControlPosition.RIGHT_CENTER
            },
				streetViewControl : false
//			,gestureHandling: 'greedy'
        };

		

		var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);	


		/* 기본 맵 생성 종료 */

		
		var newMarkers = [];
		var markerCluster = false;
		var markerClicked = 0;
		var activeMarker = false;
		var lastClicked = false;
		var ignore_seqs = [];
		
		

		

		var search_count = 0;
		google.maps.event.addListener(map, 'idle', function() {						
			if(search_count > 5 ){				
//				document.location.href='/index.php/medical/contents/search_hospital/index?x='+map.getBounds().getCenter().lat()+'&y='+map.getBounds().getCenter().lng()+'&zoom='+map.getZoom();
				search_count = 0;
			}
			search_count++;

			var active_marker_number =0;
			var data_length = data_list.length;
			var first_flag = true;
			var ne = map.getBounds().getNorthEast();
			var sw = map.getBounds().getSouthWest();
			var current_zoom = map.getZoom();
			var icon_view = false;
			if(current_zoom > 15) icon_view = true;		//클러스터가 아닌 아이콘으로 보여준다.
//			clearData();

			var json_url = '/index.php/medical/contents/search_hospital/searchLat';
			if(data_length){
				json_url = '/index.php/medical/contents/search_hospital/searchLatAdd';
				first_flag = false;
			}

			//json 부분
			var target_json_url = json_url+'?ne='+ne+'&sw='+sw;
			var json_obj = $.getJSON(target_json_url)
			.done(function(json) {	
				var index = data_length;
				for(var i = 0; i < json.data.length ; i++){

					if(ignore_seqs.length < 1  || ( $.inArray( parseInt(json.data[i]['ai_seq']), ignore_seqs) < 0 )){
						data_list[index] = json.data[i];
						index++;
						ignore_seqs.push(parseInt(json.data[i]['ai_seq']));						
					}
				}				
			}); //json 종료

			//json 종료 후
			json_obj.complete(function(){							

				if(icon_view && markerCluster){
					markerCluster.setMap(null);
					markerCluster = false;
				}

				for(var i = 0; i < data_list.length ; i++){

					var ai_seq = data_list[i]['ai_seq'];
					var pointer = new google.maps.LatLng( data_list[i].latitude, data_list[i].longitude );	//좌표
					var in_array = false;
					var visable_data_list = [];
					if(map.getBounds().contains(pointer)) in_array = true;										//좌표가 맵 영역 안인지 여부


					if(icon_view){					

						if(data_list[i].marker == 'cluster'  ){		//remove 클러스터 마커의 경우							

							 data_list[i]['marker'] = false;
							 if(newMarkers[ai_seq].content) newMarkers[ai_seq].content.className = '';
							 newMarkers[ai_seq].setMap(null);


						}else if(data_list[i].marker == 'icon' && !in_array ){	 //범위에 속하지 않는 아이콘 마커일 경우							

							data_list[i]['marker'] = false;

							if(newMarkers[ai_seq].content) newMarkers[ai_seq].content.className = '';
							newMarkers[ai_seq].setMap(null);

						}

						
						//범위에 속한 마커 중 이미 그려지지 않은 마커를 그린다.
						if(in_array && data_list[i].marker != 'icon' )	{	//신규 마커		

							 // 아이콘용 마커 생성
							var markerContent = document.createElement('div');	
							markerContent.id = 'icon-'+ai_seq;

							if( data_list[i].featured == 1 ) {
								markerContent.innerHTML =
									'<div class="map-marker featured' + color + '">' +
										'<div class="icon">' +
										'<img src="' + data_list[i].type_icon +  '">' +
										'</div>' +
									'</div>';
							}
							else {
								markerContent.innerHTML =
									'<div class="map-marker ' + data_list[i].color + '">' +
										'<div class="icon">' +
										'<img src="' + data_list[i].type_icon +  '">' +
										'</div>' +
									'</div>';
							}

							markerContent.className += 'bounce-animation marker-loaded';
							
							var marker = new RichMarker({
								position: new google.maps.LatLng( data_list[i].latitude, data_list[i].longitude ),
								map: map,
								draggable: false,
								content: markerContent,
								flat: true
							});

							data_list[i]['marker'] = 'icon';					
							newMarkers[ai_seq] = marker;	
							//기본 마커 생성 완료

							//마커 클릭시 infobox
							var infoboxContent = document.createElement("div");
							var infoboxOptions = {
								content: infoboxContent,
								disableAutoPan: false,
								pixelOffset: new google.maps.Size(-18, -42),
								zIndex: null,
								alignBottom: true,
								boxClass: "infobox",
								enableEventPropagation: true,
								closeBoxMargin: "0px 0px -30px 0px",
								closeBoxURL: "/resource/assets/img/close.png",
								infoBoxClearance: new google.maps.Size(1, 1)
							};

							var category = data_list[i].category;
				            infoboxContent.innerHTML = drawInfobox_new(category, infoboxContent, data_list[i]);
							newMarkers[ai_seq].infobox = new InfoBox(infoboxOptions);							

							newMarkers[ai_seq].addListener('click', createInfoBox(marker, ai_seq) );		
							google.maps.event.addListener(newMarkers[ai_seq].infobox, 'closeclick', closeInfoBox(marker, ai_seq) );									

													
						}
						


					}else{						

						if(newMarkers[ai_seq] && newMarkers[ai_seq].content){
							newMarkers[ai_seq].content.className = '';			 
							newMarkers[ai_seq].setMap(null);
						}


						if(data_list[i].marker == 'cluster'){		//remove 클러스터 마커의 경우						
							//이미 존재하는 마커 중 영역을 벗어난 마커 제거
							 if ( !in_array ){
								 data_list[i]['marker'] = false;
								 newMarkers[ai_seq].setMap(null);
							 }						

						}
						else if(data_list[i].marker == 'icon'){	 //remove 아이콘일 경우							


							data_list[i]['marker'] = false;							 
														
							//범위 내라면 새로운 클러스터 마커로 추가한다.
							 if ( in_array ){

								 // 클러스터용 마커 생성
								var marker = new RichMarker({
									position: pointer
								});

								data_list[i]['marker'] = 'cluster';					
								newMarkers[ai_seq] = marker;	
								 
							 }

						}else{					
							
							 // 클러스터용 마커 생성
							var marker = new RichMarker({
								position: pointer
							});

							data_list[i]['marker'] = 'cluster';					
							newMarkers[ai_seq] = marker;							


							if(markerCluster) markerCluster.addMarker(marker);	
						}
						
						
					}	// 아이콘으로 표시 될지 클러스터로 표시될지 여부 : END	
					


				}	//for 반복문 종료


				//사이드 바 노출
				setSideFrame(ne, sw);

				if(!icon_view){	
					//icon_view 형태가 아닐경우에만 클러스터를 보인다.
					if(!markerCluster) markerCluster = new MarkerClusterer(map, newMarkers, clusterOptions);
					else{						
						markerCluster.repaint();
					}
				}
				

			});			

		});/* addListener idle 끝 */		

		redrawMap('google', map);

	}	//gMap 종료

	
	
}


//functions
var side_data_list = [];
var list_number = 0;
var visibleItemsArray = [];
var current_page = 0;

function setSideFrame(ne, sw){	
	var search_text = $('#ai-name').val();	
	if(search_text) return false;
	clearData();

	var json_url = '/index.php/medical/contents/search_hospital/searchLat';					
	//json 부분
	var target_json_url = json_url+'?ne='+ne+'&sw='+sw+'&page=1';
	
	var json_obj = $.getJSON(target_json_url)
	.done(function(json) {	
		for(var i = 0; i < json.data.length ; i++){
			addData(json.data[i]);						
		}				
	}); //json 종료

	json_obj.complete(function(){	
		$('#row-total').html(side_data_list.length);
		$('#more-btn').val('더보기');	
		nextPage();	
	});
}

function clearData(){
	current_page = 0;
	side_data_list = [];
	$('.items-list .results').html('');
	visibleItemsArray = [];
	list_number = 0;
}

function addData(data, i){
	side_data_list[list_number] = data;
	list_number++;
}

function nextPage(){
	var page_per_row = 10;
	current_page++;
	var start_pointer = (current_page-1) * page_per_row;
	var last_pointer = start_pointer+page_per_row;	

	var pointer = 0;
	$.each(side_data_list, function(a) {
		if( pointer >= start_pointer && pointer < last_pointer){

			if(side_data_list[a]){
				pushItemsToArray2(side_data_list[a], visibleItemsArray);
				$('.items-list .results').html( visibleItemsArray );
				rating('.results .item');
			}

			pointer++;
		}else if(pointer < start_pointer){
			pointer++;
			return true;
		}else if(pointer >= last_pointer) return false;
		
	});
	
	//hover
	var $singleItem = $('.results .item');
	$singleItem.hover(
		function(){
			var seq = $(this).data('seq');
			var el_id = '#icon-'+seq;
			if($(el_id).length > 0){
				$(el_id).attr('class', 'marker-active marker-loaded');
			}

		},
		function() {
			var seq = $(this).data('seq');
			var el_id = '#icon-'+seq;
			if($(el_id).length > 0){
				$(el_id).attr('class', 'marker-loaded');				
			}
		}
	);



	if(pointer >= side_data_list.length){
		$('#more-btn').val('마지막 페이지 입니다.');	
	}

}

function pushItemsToArray2(data, visibleItemsArray){
    var itemPrice;

	var add_string = '';

	if(data.rating && data.rating > 0){
		add_string = '<div class="rating" data-rating="' + data.rating + '"></div>';				
	}

    visibleItemsArray.push(
        '<li>' +
            '<div class="item" id="' +data.id + '"  data-seq="'+data.ai_seq+'" >' +
                '<a href="#" class="image">' +
                    '<div class="inner">' +
                        '<div class="item-specific">' +                            
                        '</div>' +
                        '<img src="' + data.gallery[0] + '" alt="">' +
                    '</div>' +
                '</a>' +
                '<div class="wrapper">' +
                    '<a href="#" id="' + data.id + '"><h3>' +data.title + '</h3></a>' +
                    '<figure>' + data.location + '</figure>' +
                    '<div class="price">' +
					data.type +
					data.price +
					'</div>'+
                    '<div class="info">' +                       
                        add_string+
                    '</div>' +
                '</div>' +
            '</div>' +
        '</li>'
    );

    function drawPrice(price){
        if( price ){
            itemPrice = '<div class="price">' + price +  '</div>';
            return itemPrice;
        }
        else {
            return '';
        }
    }
}






























////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// OpenStreetMap - Homepage
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function createHomepageOSM(_latitude,_longitude,json,mapProvider){

    $.get("/resource/assets/external/_infobox.js", function() {
        osmMap();
    });

    function osmMap(){
        var map = L.map('map', {
                center: [_latitude,_longitude],
                zoom: 14,
                scrollWheelZoom: false
        });

        L.tileLayer.provider(mapProvider).addTo(map);

        var markers = L.markerClusterGroup({
            showCoverageOnHover: false,
            zoomToBoundsOnClick: false
        });

        var loadedMarkers = [];

        // Create markers on the map -----------------------------------------------------------------------------------

        for (var i = 0; i < json.data.length; i++) {

            // Set icon for marker -------------------------------------------------------------------------------------

            if( json.data[i].type_icon ) var icon = '<img src="' + json.data[i].type_icon +  '">';
            else icon = '';

            if( json.data[i].color ) var color = json.data[i].color;
            else color = '';

            var markerContent =
                '<div class="map-marker ' + color + '">' +
                    '<div class="icon">' +
                    icon +
                    '</div>' +
                '</div>';

            var _icon = L.divIcon({
                html: markerContent,
                iconSize:     [36, 46],
                iconAnchor:   [18, 32],
                popupAnchor:  [130, -28],
                className: ''
            });

            var title = json.data[i].title;
            var marker = L.marker(new L.LatLng( json.data[i].latitude, json.data[i].longitude ), {
                title: title,
                icon: _icon
            });

            loadedMarkers.push(marker);

            // Infobox HTML element ------------------------------------------------------------------------------------

            var category = json.data[i].category;
            var infoboxContent = document.createElement("div");
            marker.bindPopup(
                drawInfobox(category, infoboxContent, json, i)
            );
            markers.addLayer(marker);

            // Set hover states for marker -----------------------------------------------------------------------------

            marker.on('popupopen', function () {
                this._icon.className += ' marker-active';
            });
            marker.on('popupclose', function () {
                this._icon.className = 'leaflet-marker-icon leaflet-zoom-animated leaflet-clickable marker-loaded';
            });

        }

        map.addLayer(markers);

        // Animate already created markers -----------------------------------------------------------------------------

        animateOSMMarkers(map, loadedMarkers, json);
        map.on('moveend', function() {
            animateOSMMarkers(map, loadedMarkers, json);
        });

        markers.on('clusterclick', function (a) {

            var markersInCLuster = a.layer.getAllChildMarkers();
            var latitudeArray = [];
            var longitudeArray = [];

            for (var b=0; b < markersInCLuster.length; b++)
            {
                var formattedLatitude = parseFloat( markersInCLuster[b]._latlng.lat ).toFixed(6);
                var formattedLongitude = parseFloat( markersInCLuster[b]._latlng.lng ).toFixed(6);
                latitudeArray.push( formattedLatitude );
                longitudeArray.push( formattedLongitude );
            }

            Array.prototype.allValuesSame = function() {
                for(var i = 1; i < this.length; i++)
                {
                    if(this[i] !== this[0])
                        return false;
                }
                return true;
            };

            if( latitudeArray.allValuesSame() && longitudeArray.allValuesSame() ){
                multiChoice(latitudeArray[0], longitudeArray[0], json);
            }
            else {
                a.layer.zoomToBounds();
            }
        });

        $('.results .item').hover(
            function(){
                loadedMarkers[ $(this).attr('id') - 1 ]._icon.className = 'leaflet-marker-icon leaflet-zoom-animated leaflet-clickable marker-loaded marker-active';
            },
            function() {
                loadedMarkers[ $(this).attr('id') - 1 ]._icon.className = 'leaflet-marker-icon leaflet-zoom-animated leaflet-clickable marker-loaded';
            }
        );

        $('.geolocation').on("click", function() {
            map.locate({setView : true})
        });

        $('body').addClass('loaded');
        setTimeout(function() {
            $('body').removeClass('has-fullscreen-map');
        }, 1000);
        $('#map').removeClass('fade-map');

        redrawMap('osm', map);
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Item Detail Map - Google
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function itemDetailMap(json){
    var mapCenter = new google.maps.LatLng(json.latitude,json.longitude);
    var mapOptions = {
        zoom: 14,
        center: mapCenter,
        disableDefaultUI: true,
        scrollwheel: false,
        styles: mapStyles,
        panControl: false,
        zoomControl: false,
        draggable: true
    };
    var mapElement = document.getElementById('map-detail');
    var map = new google.maps.Map(mapElement, mapOptions);
    if( json.type_icon ) var icon = '<img src="' + json.type_icon +  '">';
    else icon = '';

    // Google map marker content -----------------------------------------------------------------------------------

    var markerContent = document.createElement('DIV');
    markerContent.innerHTML =
        '<div class="map-marker">' +
            '<div class="icon">' +
            icon +
            '</div>' +
        '</div>';

    // Create marker on the map ------------------------------------------------------------------------------------

    var marker = new RichMarker({
        position: new google.maps.LatLng( json.latitude, json.longitude ),
        map: map,
        draggable: false,
        content: markerContent,
        flat: true
    });

    marker.content.className = 'marker-loaded';
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Simple Google Map (contat, submit...)
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function simpleMap(_latitude, _longitude, draggableMarker){
    //console.log(_latitude,_longitude,draggableMarker );
    var mapCenter = new google.maps.LatLng(_latitude, _longitude);
    var mapOptions = {
        zoom: 14,
        center: mapCenter,
        disableDefaultUI: true,
        scrollwheel: false,
        styles: mapStyles,
        panControl: false,
        zoomControl: false,
        draggable: true
    };
    var mapElement = document.getElementById('map-simple');
    var map = new google.maps.Map(mapElement, mapOptions);

    // Google map marker content -----------------------------------------------------------------------------------

    var markerContent = document.createElement('DIV');
    markerContent.innerHTML =
        '<div class="map-marker">' +
            '<div class="icon"></div>' +
        '</div>';

    // Create marker on the map ------------------------------------------------------------------------------------

    var marker = new RichMarker({
        //position: mapCenter,
        position: new google.maps.LatLng( _latitude, _longitude ),
        map: map,
        draggable: draggableMarker,
        content: markerContent,
        flat: true
    });

    marker.content.className = 'marker-loaded';
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Functions
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Push items to array and create <li> element in Results sidebar ------------------------------------------------------

function pushItemsToArray(json, a, category, visibleItemsArray){
    var itemPrice;
    visibleItemsArray.push(
        '<li>' +
            '<div class="item" id="' + json.data[a].id + '"  data-seq="'+json.data[a].ai_seq+'" >' +
                '<a href="#" class="image">' +
                    '<div class="inner">' +
                        '<div class="item-specific">' +
                            drawItemSpecific(category, json, a) +
                        '</div>' +
                        '<img src="' + json.data[a].gallery[0] + '" alt="">' +
                    '</div>' +
                '</a>' +
                '<div class="wrapper">' +
                    '<a href="#" id="' + json.data[a].id + '"><h3>' + json.data[a].title + '</h3></a>' +
                    '<figure>' + json.data[a].location + '</figure>' +
                    '<div class="price">' +
					json.data[a].type +
					json.data[a].price +
					'</div>'+
                    '<div class="info">' +
//                        '<div class="type">' +
//                            '<i><img src="' + json.data[a].type_icon + '" alt=""></i>' +
//                            '<span>' + json.data[a].type + '</span>' +
//                        '</div>' +
                        '<div class="rating" data-rating="' + json.data[a].rating + '"></div>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</li>'
    );

    function drawPrice(price){
        if( price ){
            itemPrice = '<div class="price">' + price +  '</div>';
            return itemPrice;
        }
        else {
            return '';
        }
    }
}

// Center map to marker position if function is called (disabled) ------------------------------------------------------

function centerMapToMarker(){
    $.each(json.data, function(a) {
        if( json.data[a].id == id ) {
            var _latitude = json.data[a].latitude;
            var _longitude = json.data[a].longitude;
            var mapCenter = new google.maps.LatLng(_latitude,_longitude);
            map.setCenter(mapCenter);
        }
    });
}

// Create modal if more items are on the same location (example: one building with floors) -----------------------------

function multiChoice(sameLatitude, sameLongitude, json) {
    //if (clickedCluster.getMarkers().length > 1){
        var multipleItems = [];
        $.each(json.data, function(a) {
            if( json.data[a].latitude == sameLatitude && json.data[a].longitude == sameLongitude ) {
                pushItemsToArray(json, a, json.data[a].category, multipleItems);
            }
        });
        $('body').append('<div class="modal-window multichoice fade_in"></div>');
        $('.modal-window').load( '/resource/assets/external/_modal-multichoice.html', function() {
            $('.modal-window .modal-wrapper .items').html( multipleItems );
            rating('.modal-window');
        });
        $('.modal-window .modal-background, .modal-close').live('click',  function(e){
            $('.modal-window').addClass('fade_out');
            setTimeout(function() {
                $('.modal-window').className = '';
            }, 300);
        });
    //}
}

// Animate OSM marker --------------------------------------------------------------------------------------------------

function animateOSMMarkers(map, loadedMarkers, json){
    var bounds = map.getBounds();
    var visibleItemsArray = [];
    var multipleItems = [];

    $.each( loadedMarkers, function (i) {
        if ( bounds.contains( loadedMarkers[i].getLatLng() ) ) {
            var category = json.data[i].category;
            pushItemsToArray(json, i, category, visibleItemsArray);

            setTimeout(function(){
                if( loadedMarkers[i]._icon != null ){
                    loadedMarkers[i]._icon.className = 'leaflet-marker-icon leaflet-zoom-animated leaflet-clickable marker-loaded';
                }
            }, i* 50);
        }
        else {
            if( loadedMarkers[i]._icon != null ){
                loadedMarkers[i]._icon.className = 'leaflet-marker-icon leaflet-zoom-animated leaflet-clickable';
            }
        }
    });

    // Create list of items in Results sidebar -------------------------------------------------------------------------

    $('.items-list .results').html( visibleItemsArray );

    rating('.results .item');

    $('.results .item').hover(
        function(){
            if( loadedMarkers[ $(this).attr('id') - 1 ]._icon ){
                loadedMarkers[ $(this).attr('id') - 1 ]._icon.className = 'leaflet-marker-icon leaflet-zoom-animated leaflet-clickable marker-loaded marker-active';
            }
        },
        function() {
            if( loadedMarkers[ $(this).attr('id') - 1 ]._icon ){
                loadedMarkers[ $(this).attr('id') - 1 ]._icon.className = 'leaflet-marker-icon leaflet-zoom-animated leaflet-clickable marker-loaded';
            }
        }
    );

}

// Redraw map after item list is closed --------------------------------------------------------------------------------

function redrawMap(mapProvider, map){
	console.log('확인!');
    $('#map-resize-icon').click(function() {		
		console.log('클릭');
        $('.map-canvas').toggleClass('results-collapsed');
        $('.map-canvas .map').one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
            if( mapProvider == 'osm' ){
                map.invalidateSize();
            }
            else if( mapProvider == 'google' ){
                google.maps.event.trigger(map, 'resize');
            }
        });
    });
}
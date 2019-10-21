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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Homepage map - Google
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




function createHomepageGoogleMap(_latitude,_longitude){
    $.get("/resource/assets/external/_infobox.js", function() {
        gMap();
    });

    function gMap(){	
		createGoogleMap();
    } // map end

	/*
	* 기본 맵 생성
	*/		
	function createGoogleMap(){
		var map_obj = false;
		var newMarkers = [];
		var markerCluster = false;
		var loading_number = 0;


		var mapCenter = new google.maps.LatLng(_latitude,_longitude);

        var mapOptions = {
            zoom: 10,
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
            },
			mapTypeId : 'roadmap'
        };
        var mapElement = document.getElementById('map');
        map_obj = new google.maps.Map(mapElement, mapOptions);

		var pixelOffset = new google.maps.Size(-18, -42);
		var infoBoxClearance = new google.maps.Size(1, 1);
		
		google.maps.event.addListener(map_obj, 'idle', function() {

			//마커 초기화
			if(newMarkers.length > 0){
				for(var i=0 ; newMarkers.length > i; i++){
	//				newMarkers[i].content.className = '';
					newMarkers[i].setMap(null);
				}
				newMarkers = [];
			}

			//클러스터 초기화
			if(markerCluster){
				markerCluster.setMap(null);
			}

			var ne = map_obj.getBounds().getNorthEast();
			var sw = map_obj.getBounds().getSouthWest();

			var json_url = '/index.php/medical/contents/search_hospital/searchLat?ne='+ne+'&sw='+sw;
			$.getJSON(json_url)
			.done(function(json) {					

				
				for (var i = 0; i < json.data.length; i++) {

					//마커 생성
					var marker = new google.maps.Marker({
						position: new google.maps.LatLng(json.data[i].latitude, json.data[i].longitude ),
//						map: map_obj,
						draggable: true,
//						content: content,
						flat: true
					});
					newMarkers.push(marker);
					//마커 생성 끝

				}				

				//클러스터
				var clusterStyles = [
					{
						url: '/resource/assets/img/cluster.png',
						height: 34,
						width: 34
					}
				];


				markerCluster = new MarkerClusterer(map_obj, newMarkers, { styles: clusterStyles, maxZoom: 17, gridSize:80 });
//				markerCluster.onClick = function(clickedClusterIcon, sameLatitude, sameLongitude) {
//					return multiChoice(sameLatitude, sameLongitude, json);
//				};

				//클러스터 종료

				console.log('확인 기능 : '+ json.data.length);	
			});

		});
	}

	function clearMarker(){
		if(newMarkers.length > 0){
			for(var i=0 ; newMarkers.length > i; i++){
//				newMarkers[i].content.className = '';
				newMarkers[i].setMap(null);
			}
			newMarkers = [];
		}
	}

	function clearCluster(){
		if(markerCluster){
			markerCluster.setMap(null);
		}
	}



	
}
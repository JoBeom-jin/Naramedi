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


//google map
var google_map = false;
var json_url = '/index.php/medical/contents/search_hospital/searchLat';

//make map functions
function createEmptyMap(_latitude, _longitude){	
	var mapCenter = new google.maps.LatLng(_latitude,_longitude);
	var mapOptions = getMapConfig(mapCenter);

	var mapElement = document.getElementById('map');
	google_map = new google.maps.Map(mapElement, mapOptions); 
}

/*
* json data로 마커 생성
*/
function addMakerByLocation(){
	if(!google_map) return false;	

	google.maps.event.addListener(google_map, 'idle', function() {
		var ne = google_map.getBounds().getNorthEast();
		var sw = google_map.getBounds().getSouthWest();

		//json 부분
		var json_path = json_url+'?ne='+ne+'&sw='+sw;
		console.log(json_path);
		
		$.getJSON(json_path)
		.done(function(json) {
			reflashMakerByJsonData(json);				
		})
		.fail(function( jqxhr, textStatus, error ) {
			console.log(error);
		});
	});	
}

function reflashMakerByJsonData(json){
	if(!json || !json.data || json.data.length < 1) return false;

	var newMarkers = [];
	var markerClicked = 0;
	var activeMarker = false;
	var lastClicked = false;

	/*
	* json data에 따라 marker를 만든다.
	* maker click : infobox 를 만들고 보여준다.
	*/
	for (var i = 0; i < json.data.length; i++) {

		// Google map marker content -----------------------------------------------------------------------------------
		if( json.data[i].color ) var color = json.data[i].color;
		else color = '';

		var markerContent = document.createElement('DIV');

		/*추천 세팅*/
		if( json.data[i].featured == 1 ) {
			markerContent.innerHTML =
				'<div class="map-marker featured' + color + '">' +
					'<div class="icon">' +
					'<img src="' + json.data[i].type_icon +  '">' +
					'</div>' +
				'</div>';
		}
		else {
			markerContent.innerHTML =
				'<div class="map-marker ' + json.data[i].color + '">' +
					'<div class="icon">' +
					'<img src="' + json.data[i].type_icon +  '">' +
					'</div>' +
				'</div>';
		}



		// Create marker on the map ------------------------------------------------------------------------------------
		var marker = new RichMarker({
			position: new google.maps.LatLng( json.data[i].latitude, json.data[i].longitude ),
			map: google_map,
			draggable: false,
			content: markerContent,
			flat: true
		});

		newMarkers.push(marker);
		/*추천 세팅 END*/

		// Create infobox for marker -----------------------------------------------------------------------------------

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

		// Infobox HTML element ----------------------------------------------------------------------------------------

		var category = json.data[i].category;
		infoboxContent.innerHTML = drawInfobox(category, infoboxContent, json, i);

		// Create new markers ------------------------------------------------------------------------------------------
		newMarkers[i].infobox = new InfoBox(infoboxOptions);

		// Show infobox after click ------------------------------------------------------------------------------------

		google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
				google.maps.event.addListener(map, 'click', function(event) {
					lastClicked = newMarkers[i];
				});
				activeMarker = newMarkers[i];
				if( activeMarker != lastClicked ){
					for (var h = 0; h < newMarkers.length; h++) {
						newMarkers[h].content.className = 'marker-loaded';
						newMarkers[h].infobox.close();
					}
					newMarkers[i].infobox.open(map, this);
					newMarkers[i].infobox.setOptions({ boxClass:'fade-in-marker'});
					newMarkers[i].content.className = 'marker-active marker-loaded';
					markerClicked = 1;
				}
			}
		})(marker, i));

		// Fade infobox after close is clicked -------------------------------------------------------------------------

		google.maps.event.addListener(newMarkers[i].infobox, 'closeclick', (function(marker, i) {
			return function() {
				activeMarker = 0;
				newMarkers[i].content.className = 'marker-loaded';
				newMarkers[i].infobox.setOptions({ boxClass:'fade-out-marker' });
			}
		})(marker, i));
	}	




	 // Close infobox after click on map --------------------------------------------------------------------------------

	google.maps.event.addListener(google_map, 'click', function(event) {
		if( activeMarker != false && lastClicked != false ){
			if( markerClicked == 1 ){
				activeMarker.infobox.open(google_map);
				activeMarker.infobox.setOptions({ boxClass:'fade-in-marker'});
				activeMarker.content.className = 'marker-active marker-loaded';
			}
			else {
				markerClicked = 0;
				activeMarker.infobox.setOptions({ boxClass:'fade-out-marker' });
				activeMarker.content.className = 'marker-loaded';
				setTimeout(function() {
					activeMarker.infobox.close();
				}, 350);
			}
			markerClicked = 0;
		}
		if( activeMarker != false ){
			google.maps.event.addListener(activeMarker, 'click', function(event) {
				markerClicked = 1;
			});
		}
		markerClicked = 0;
	});

	// Create marker clusterer -----------------------------------------------------------------------------------------

	var clusterStyles = [
		{
			url: '/resource/assets/img/cluster.png',
			height: 34,
			width: 34
		}
	];

	var markerCluster = new MarkerClusterer(google_map, newMarkers, { styles: clusterStyles, maxZoom: 19 });
	markerCluster.onClick = function(clickedClusterIcon, sameLatitude, sameLongitude) {
		return multiChoice(sameLatitude, sameLongitude, json);
	};

	// Dynamic loading markers and data from JSON ----------------------------------------------------------------------

	google.maps.event.addListener(google_map, 'idle', function() {
		var visibleArray = [];

		for (var i = 0; i < json.data.length; i++) {
			if ( google_map.getBounds().contains(newMarkers[i].getPosition()) ){
				visibleArray.push(newMarkers[i]);
				$.each( visibleArray, function (i) {
					setTimeout(function(){
						if ( google_map.getBounds().contains(visibleArray[i].getPosition()) ){
							if( !visibleArray[i].content.className ){
								visibleArray[i].setMap(google_map);
								visibleArray[i].content.className += 'bounce-animation marker-loaded';
								markerCluster.repaint();
							}
						}
					}, i * 50);
				});
			} else {
				newMarkers[i].content.className = '';
				newMarkers[i].setMap(null);
			}
		}

		var visibleItemsArray = [];
		var test_string = '';
		$.each(json.data, function(a) {
			if( google_map.getBounds().contains( new google.maps.LatLng( json.data[a].latitude, json.data[a].longitude ) ) ) {
				var category = json.data[a].category;
				pushItemsToArray(json, a, category, visibleItemsArray);
			}
		});

		// Create list of items in Results sidebar ---------------------------------------------------------------------		

		$('.items-list .results').html( visibleItemsArray );

		// Check if images are cached, so will not be loaded again

		$.each(json.data, function(a) {
			if( google_map.getBounds().contains( new google.maps.LatLng( json.data[a].latitude, json.data[a].longitude ) ) ) {
				is_cached(json.data[a].gallery[0], a, json);
			}
		});

		// Call Rating function ----------------------------------------------------------------------------------------

		rating('.results .item');

		var $singleItem = $('.results .item');
		$singleItem.hover(
			function(){
				newMarkers[ $(this).attr('id') - 1 ].content.className = 'marker-active marker-loaded';
			},
			function() {
				newMarkers[ $(this).attr('id') - 1 ].content.className = 'marker-loaded';
			}
		);
	});

	redrawMap('google', google_map);
}

function createDefaultMap(_latitude, _longitude){
	$.get("/resource/assets/external/_infobox.js", function() {
		createEmptyMap(_latitude, _longitude);
	});	
}

function createSelfMap(){
	$.get("/resource/assets/external/_infobox.js", function() {
		if ("geolocation" in navigator) {
			navigator.geolocation.getCurrentPosition(function(position){
				var cpos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};								
				createEmptyMap(cpos.lat, cpos.lng);
				addMakerByLocation();
			 });
		 }
	});
}























function createHomepageGoogleMap(_latitude,_longitude,json){
	$.get("/resource/assets/external/_infobox.js", function() {
        gMap();
    });	
}

function createEmptyMap222(_latitude, _longitude){	
	$.get("/resource/assets/external/_infobox.js", function() {
        gMap();			
    });
	
	function gMap(){
		var mapCenter = new google.maps.LatLng(_latitude,_longitude);

        var mapElement = document.getElementById('map');
        google_map = new google.maps.Map(mapElement, mapOptions);
        var newMarkers = [];
        var markerClicked = 0;
        var activeMarker = false;
        var lastClicked = false;		
	}
}

function getJsonDataByLocation(){	
}



function getMapConfig(mapCenter){
	var mapOptions = {
		zoom: 15,
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
		}
	};

	return mapOptions;
}

function redrawMap(mapProvider, map){
    $('.map .toggle-navigation').click(function() {
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


function is_cached(src, a, json) {
	var image = new Image();
	var loadedImage = $('.results li #' + json.data[a].id + ' .image');
	image.src = src;
	if( image.complete ){
		$(".results").each(function() {
			loadedImage.removeClass('loading');
			loadedImage.addClass('loaded');
		});
	}
	else {
		$(".results").each(function() {
			$('.results li #' + json.data[a].id + ' .image').addClass('loading');
		});
		$(image).load(function(){
			loadedImage.removeClass('loading');
			loadedImage.addClass('loaded');
		});
	}
}


function pushItemsToArray(json, a, category, visibleItemsArray){
    var itemPrice;
    visibleItemsArray.push(
        '<li>' +
            '<div class="item" id="' + json.data[a].id + '">' +
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
                    drawPrice(json.data[a].price) +
                    '<div class="info">' +
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
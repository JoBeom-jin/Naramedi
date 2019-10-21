<script src="/resource/assets/js/jssor.slider-26.3.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
	jssor_1_slider_init = function() {

		var jssor_1_SlideoTransitions = [
		  [{b:-1,d:1,o:-0.7}],
		  [{b:900,d:2000,x:-379,e:{x:7}}],
		  [{b:900,d:2000,x:-379,e:{x:7}}],
		  [{b:-1,d:1,o:-1,sX:2,sY:2},{b:0,d:900,x:-171,y:-341,o:1,sX:-2,sY:-2,e:{x:3,y:3,sX:3,sY:3}},{b:900,d:1600,x:-283,o:-1,e:{x:16}}]
		];

		var jssor_1_options = {
		  $AutoPlay: 1,
		  $SlideDuration: 3200,
		  $SlideEasing: $Jease$.$OutQuint,
		  $Align: 0,
		  $CaptionSliderOptions: {
			$Class: $JssorCaptionSlideo$,
			$Transitions: jssor_1_SlideoTransitions
		  },
		  $ArrowNavigatorOptions: {
			$Class: $JssorArrowNavigator$
		  },
		  $BulletNavigatorOptions: {
			$Class: $JssorBulletNavigator$
		  }
		};

		var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

		/*#region responsive code begin*/

		var MAX_WIDTH = 3000;

		function ScaleSlider() {
			var containerElement = jssor_1_slider.$Elmt.parentNode;
			var containerWidth = containerElement.clientWidth;

			if (containerWidth) {

				var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

				jssor_1_slider.$ScaleWidth(expectedWidth);
			}
			else {
				window.setTimeout(ScaleSlider, 30);
			}
		}

		ScaleSlider();

		$Jssor$.$AddEvent(window, "load", ScaleSlider);
		$Jssor$.$AddEvent(window, "resize", ScaleSlider);
		$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
		/*#endregion responsive code end*/
	};
</script>
<style>
	/* jssor slider loading skin spin css */
	.jssorl-009-spin img {
		animation-name: jssorl-009-spin;
		animation-duration: 1.6s;
		animation-iteration-count: infinite;
		animation-timing-function: linear;
	}

	@keyframes jssorl-009-spin {
		from {
			transform: rotate(0deg);
		}

		to {
			transform: rotate(360deg);
		}
	}


	.jssorb032 {position:absolute;}
	.jssorb032 .i {position:absolute;cursor:pointer;}
	.jssorb032 .i .b {fill:#fff;fill-opacity:0.7;stroke:#000;stroke-width:1200;stroke-miterlimit:10;stroke-opacity:0.25;}
	.jssorb032 .i:hover .b {fill:#000;fill-opacity:.6;stroke:#fff;stroke-opacity:.35;}
	.jssorb032 .iav .b {fill:#000;fill-opacity:1;stroke:#fff;stroke-opacity:.35;}
	.jssorb032 .i.idn {opacity:.3;}

	.jssora051 {display:block;position:absolute;cursor:pointer;}
	.jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
	.jssora051:hover {opacity:.8;}
	.jssora051.jssora051dn {opacity:.5;}
	.jssora051.jssora051ds {opacity:.3;pointer-events:none;}
</style>

<div id="main-content-area" style="margin-top:45px;">
	<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1230px;height:592px;overflow:hidden;visibility:hidden;">
		<!-- Loading Screen -->
		<div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
	<!-- 		<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" /> -->
		</div>


		<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1230px;height:592px;overflow:hidden;">

			<div>
				<img data-u="image" src="/resource/images/mobile/main/mobile_main01.jpg" />
				<div style="position:absolute;bottom:60px;left:-400px;width:100%; text-align:center; height:56px; z-index:0;">					
					<a href="/m/index.php/mobile/contents/search_hospital" class="button button-big  button-rounded button-fixed">
						<span>내주변 검진기관 검색하기</span>
					</a>
				</div>
			</div>
			<div>
				<img data-u="image" src="/resource/images/mobile/main/mobile_main02.jpg" />
				<div style="position:absolute;bottom:90px;left:0px;width:100%; text-align:center; height:56px; z-index:0;">						
					<a href="/m/index.php/mobile/contents/event_hospital" class="button button-big  button-rounded button-fixed">
						<span>제휴병원 이벤트 바로가기</span>
					</a>						
				</div>
			</div>
		</div>

		<!-- Bullet Navigator -->
		<div data-u="navigator" class="jssorb032" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
			<div data-u="prototype" class="i" style="width:16px;height:16px;">
				<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
					<circle class="b" cx="8000" cy="8000" r="5800"></circle>
				</svg>
			</div>
		</div>
		<!-- Arrow Navigator -->
		<div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
			<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
				<polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
			</svg>
		</div>
		<div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
			<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
				<polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
			</svg>
		</div>
	</div>
	<!-- jssor_1 end -->


	<section id="numer-info-area" class="block4 background-color-grey-dark">
		<div class="container">

			<div class="row">
				<div style="width:30%; margin-right:3%; float:left;">
					<i class="fa fa-heartbeat fa-2x"></i>
					<h5 class="timer count-title count-number" data-to="<?=$total_agency?>" data-speed="1500"></h5>
					<p class="count-text">검색 가능 검진기관</p>
				</div>

				<div style="width:30%; margin-right:3%; float:left;">
					<i class="fa fa-handshake-o fa-2x"></i>
					<h2 class="timer count-title count-number" data-to="<?=$member_agency?>" data-speed="1500"></h2>
					<p class="count-text ">OK검진 제휴기관</p>
				</div>

				<div style="width:30%; float:left;">
					<i class="fa fa-calendar-check-o fa-2x"></i>
					<h2 class="timer count-title count-number" data-to="<?=$total_event?>" data-speed="1500"></h2>
					<p class="count-text ">진행중인 이벤트</p>
				</div>
			</div>
		</div>
		<!--/.container-->
	</section>

	<section class="block4">

		<div class="row">
			<div style="text-align:middle;">
				<img src="/resource/images/medical/main/tip.png" alt="01. 지역을 선택하고, 02. 검진 유형을 선택하고, 03. 이벤트를 선택하여 예약!" style="width:100%;">
			</div>

			<div style="text-align:middle;">
				<div style="width:98%; max-width:580px; max-height:320px; margin:0 auto;">
					<video poster="/resource/movie/video_poster.jpg" width="100%" controls="controls" preload="metadata">
						<source src="/resource/movie/video.mp4" type="video/mp4" />
					</video>
				</div>
			</div>
		</div>

	</section>
</div>



<script type="text/javascript">jssor_1_slider_init();</script>
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
	.jssorb032 .i .b {fill:none;fill-opacity:0.7;stroke:#fff;stroke-width:1200;stroke-miterlimit:10;stroke-opacity:1;}
	.jssorb032 .i:hover .b {fill:#fff;fill-opacity:.6;stroke:#fff;stroke-opacity:.35;}
	.jssorb032 .iav .b {fill:#fff;fill-opacity:1;stroke:#fff;stroke-opacity:.35;}
	.jssorb032 .i.idn {opacity:.3;}

	.jssora051 {display:block;position:absolute;cursor:pointer;}
	.jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
	.jssora051:hover {opacity:.8;}
	.jssora051.jssora051dn {opacity:.5;}
	.jssora051.jssora051ds {opacity:.3;pointer-events:none;}
</style>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/application/custom_php/custom_func.php"); ?>



	<a href="#page-top" class="floating-btn  scrollup">
		<img src="/resource/images/custom/floating-btn2.png" alt="floating-btn" style="width:50px;" >	
	</a>		
	<div id="myModal" class="modal2">
	<!-- Modal content -->
		<div class="modal-content2">
			<span class="close">&times;</span>
			<div>
				<img src="/resource/images/mobile/arrow-icon.png" class="img_close" alt="arrow-icon"style="float:left; width: 20px;margin-top: 5px;">
				<div  style=" margin:0 auto; height:40px; text-align:center;" >
					연령
				</div>
				<hr>
				<div onclick="change(this)" style="padding:0px 0px 10px; ">
					20대
				</div>
				<hr>
				<div onclick="change(this)" style="padding:0px 0px 10px; ">
					30대
				</div>
				<hr>
				<div onclick="change(this)" style="padding:0px 0px 10px; ">
					40대
				</div>
				<hr>
				<div onclick="change(this)" style="padding:0px 0px 10px; ">
					50대
				</div>
				<hr>
				<div onclick="change(this)" style="padding:0px 0px 10px; ">
					60대이상
				</div>
			</div>
		</div>
	</div>
	<div id="myModal3" class="modal2">
		<!-- Modal content -->
		<div class="modal-content2">
			<span class="close2">&times;</span>
			<div>
				<img src="/resource/images/mobile/arrow-icon.png" class="img_close2" alt="arrow-icon"style="float:left; width: 20px;margin-top: 5px;">
					<div style=" margin:0 auto; height:40px; text-align:center;" >
						
						지역
					</div>
					<hr>
					<div onclick="change2(this)" style="padding:0px 0px 10px; ">
						서울특별시
					</div>
					<hr>
					<div onclick="change2(this)" style="padding:0px 0px 10px; ">
						경기도
					</div>
					<hr>
					<div onclick="change2(this)" style="padding:0px 0px 10px; ">
						인천 광역시
					</div>
					<hr>
					<div onclick="change2(this)" style="padding:0px 0px 10px; ">
						충청도
					</div>
					<hr>
					<div onclick="change2(this)" style="padding:0px 0px 10px; ">
						전라도
					</div>
					<hr>
					<div onclick="change2(this)" style="padding:0px 0px 10px; ">
						경상도
					</div>
					<hr>
					<div onclick="change2(this)" style="padding:0px 0px 10px; ">
						강원도
					</div>
					<hr>
					<div onclick="change2(this)" style="padding:0px 0px 10px; ">
						제주도
					</div>
			</div>
		</div>
	</div>
	<div id="myModal4" class="modal2">
		<!-- Modal content -->
			<div class="modal-content2">
				<span class="close3">&times;</span>
				<div>
				<img src="/resource/images/mobile/arrow-icon.png" class="img_close3" alt="arrow-icon"style="float:left; width: 20px;margin-top: 5px;">
					<div style=" margin:0 auto; height:40px; text-align:center;">
						검진테마
					</div>
					<hr>
					<div onclick="change3(this)" style="padding:0px 0px 10px; ">
						부부검진
					</div>
					<hr>
					<div onclick="change3(this)" style="padding:0px 0px 10px; ">
						여성검진
					</div>
					<hr>
					<div onclick="change3(this)" style="padding:0px 0px 10px; ">
						숙박검진
					</div>
				</div>
			</div>
		</div>
	
<div id="main-content-area" style="">
	<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px; width:1230px;height:1200px;">
		<!-- Loading Screen -->
			<div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
		<!-- 		<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" /> -->
			</div>


			<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px; width:1230px;height:1200px;overflow:hidden;">

				<div>
					<img data-u="image" src="/resource/images/mobile/main/mobile_main01.png" />
					<!-- <div style="position:absolute;bottom:220px;left:0px;width:100%; text-align:center; z-index:0;">						
						<a href="/m/index.php/mobile/contents/event_hospital" class="button button-big    button-fixed">
						<span style="font-size:40px; ">부모님의 빛나는 노후를 위하여</span>
						</a>						
					</div> -->
				</div>
				<div>
					<img data-u="image" src="/resource/images/mobile/main/mobile_main02.png" />
					<!-- <div style="position:absolute;top:450px;right:-330px;width:100%; text-align:center;  z-index:0;">					
						<a href="/m/index.php/mobile/contents/search_hospital" class="button button-big   button-fixed">
							<span style="font-size:40px;">내 몸을 지키는 올바른 길</span>
						</a>
					</div> -->
				</div>
				<div>
					<img data-u="image" src="/resource/images/mobile/main/mobile_main03.png" />
					<!-- <div style="position:absolute;top:550px;left:-300px;width:100%; text-align:center; z-index:0;">						
						<a href="/m/index.php/mobile/contents/event_hospital" class="button button-big  button-fixed">
							<span style="font-size:40px;">내 몸을 위한 똑똑한 실천</span>
						</a>						
					</div> -->
				</div>
				<div>
					<img data-u="image" src="/resource/images/mobile/main/mobile_main04.png" />
					<!-- <div style="position:absolute;bottom:220px;left:0px;width:100%; text-align:center;  z-index:0;">						
						<a href="/m/index.php/mobile/contents/event_hospital" class="button button-big   button-fixed">
							<span style="font-size:40px;">건강한 마음과 몸, 행복한 부부생활의 첫 걸음</span>
						</a>						
					</div> -->
				</div>
				
			</div>

			<!-- Bullet Navigator -->
			<div data-u="navigator" class="jssorb032" style="position:absolute;bottom:62px;right:12px; " data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
				<div data-u="prototype" class="i" style="width:30px;height:30px; ">
					<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%; ">
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
	<!-- 맟춤검색 -->
	<!-- style="z-index: 999;" -->
	<section id="numer-info-area" class="block4 background-color-grey-dark" >
		<div class="container" style=" width:100%;text-align:center; ">
			<img src="/resource/images/mobile/main/title1.png"  alt="title1_text"  style=" width:40vw; margin:30px auto 45px; " >
			<!-- <form action="/m/index.php/mobile/contents/event_hospital" method="post"></form> -->
				<div style=" padding: 30px 20px; margin:0px 25px; text-align:left;-webkit-border-radius:20px; -moz-border-radius:20px; box-shadow:5px 5px 10px silver;">
					<ul class="custom-search"  >
						<li class="s-text">연령 </li>
							<!-- <input type="text" name="user_age" id="user_age" placeholder="30대"/> -->
						<li id="l-text" class="l-text">30대<span class="caret"></span></li>
						<li class="s-text">지역</li>
						<li id="l-text2" class="l-text">서울특별시 <span class="caret"></span></li>
						<li class="s-text">검진테마 </li>
						<li id="l-text3" class="l-text">여성검진 <span class="caret"></span></li>
						<!-- 맟춤검색 버튼 이미지 -->
						<li style="text-align:center; margin-top:30px;" >
							<!-- <button type="submit"> -->
								<a href="/m/index.php/mobile/contents/event_hospital">
									<img src="/resource/images/mobile/main/custom-btn.png" alt="custom-btn" style="width:40vw;">
								</a>
							</button>
						</li>
					</ul>
				</div>
			<img src="/resource/images/mobile/main/title2.png"  alt="title2_text" style="width:41vw; margin:45px auto 25px;">
			<div style="margin-bottom:30px;"> <img src="/resource/images/custom/countdown.png" alt="countdown"> 마감까지
			<?php
			$user_age = $_POST['user_age'];
			
			// echo"
			// <input type='hidden' id='CountDown2' value='Sep 31 2019 23:59'></input>
			// <span id='CountDown' style='color:red; font-weight: bold; font-size:18px;'>  </span>
			// ";
			echo"
			<span id='CountDown' style='color:red; font-weight: bold; font-size:18px;'>  </span>
			";
			?>
			</div>
		</div>
	</section>	
</div>

<!-- 원본코드 주석처리 -->
			<!-- <div class="row">
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
		/.container
	

	<section class="block4">

		<div class="row">
			<div style="text-align:middle;">
				<img src="/resource/images/mobile/main/main_tip.png" alt="01. 지역을 선택하고, 02. 검진 유형을 선택하고, 03. 이벤트를 선택하여 예약!" style="width:100%;">
			</div>

			<div style="text-align:middle;">
				<div style="width:98%; max-width:580px; max-height:320px; margin:0 auto;">
					<video poster="/resource/movie/video_poster.jpg" width="100%" controls="controls" preload="metadata">
						<source src="/resource/movie/video.mp4" type="video/mp4" />
					</video>
				</div>
			</div>
		</div>

	</section> -->

<section class="block4" style=" " >
	<div style=" ">

	<?php 
	$earlyitem = custom_event_list("TYP007", 2);
	$index = 1;
	foreach ($earlyitem as $k=> $v) {
		$hosinfo = getHosInfo($v[ei_hiseq]);
		$hosName = $hosinfo[0][hi_open_name];
		$hosAddr = $hosinfo[0][hd_addr1]." ".$hosinfo[0][hd_addr2];
		$banner_src = str_replace("/usr/local/apache/htdocs/okmedical/", "/", $v[ei_img_banner]);
		$original_account = number_format($v[ei_original_account]);
		$account = number_format($v[ei_account]);
		$countdown = date("M d Y H:i", $v[ei_end]);
		echo "
		<div style=' width:48%; border: 1px solid #aca7a7ab; -webkit-border-radius:20px; -moz-border-radius:20px; margin:0px 1%; padding:23px 6px;float: left;'>
		<div class='item main-item' style=' height: 300px !important;'>		
		<div class='image'>
		<a href='index.php/mobile/contents/event_hospital/viewEvent?seq=$v[ei_seq]' style='display:block; height:100%'>
		<div class='overlay'>
		<div class='inner'>
		</div>
		</div>
		<img src='$banner_src' alt='' class='zoomin'>
		</a>
		</div>
		<div class='wrapper' style='min-height:140px;'>
		<p class='main-item-addr'>$hosAddr / $hosName</p>
		<div class='main-item-title'>$v[ei_name]</div>
		<div style='width:100%;position:absolute'>
		<div class='main-item-desc'><span class='item_sub_icon'>";
		replaceText($v[ei_ages]);
		echo "|";
		echo date("Y.m.d 까지", $v[ei_end]);
		echo "
		</span><br>
		</div>
		</div>
		<div style='width:100%;float:left; padding-top:40px;'>
		<input type='hidden' id='CountDown2' value='$countdown'></input>
		<div class='main-item-price' style='float: left;'>
		<font style='font-size:60%; text-decoration:line-through'>$original_account 원</font>
		<font style='font-size: 100%; color:#1e67c6; font-weight:bold;'>$account 원</font>
		</div>
		</div>
		</div>
		</div>
		</div>
		";

		$index++;
	}

	?>

</section>

<!-- 2030titile -->
	<section class="block4">
		<div style="text-align: center;">
			<img style=" margin:45px 0px; width:45vw;" src="/resource/images/mobile/main/2030title.png" alt="2030title" >
			<a href="/m/index.php/mobile/contents/event_hospital"><p style="position: absolute; right: 10px; top: 110px; font-size:12px;">더보기<i class="fa fa-angle-right" style="margin-left:5px;"></i></p></a>
			<hr>
			<?php
			$mainitem01 = custom_event_list("TYP001", 3);
		// print_r2($mainitem01);
			foreach ($mainitem01 as $k=> $v) {
				$hosinfo = getHosInfo($v[ei_hiseq]);
				$hosName = $hosinfo[0][hi_open_name];
				$hosAddr = $hosinfo[0][hd_addr1]." ".$hosinfo[0][hd_addr2];
				$banner_src = str_replace("/usr/local/apache/htdocs/okmedical/", "/", $v[ei_img_banner]);
				$original_account = number_format($v[ei_original_account]);
				$account = number_format($v[ei_account]);
				echo "				
				<div class='article' style='position: relative;'>
				<div class='article_img'>
				<a href='index.php/mobile/contents/event_hospital/viewEvent?seq=$v[ei_seq]'>
				<img src='$banner_src' alt='$v[ei_name]'>
				</a>
				</div>
				<div class='article_text'>
				<ul>
				<li class='main-item-addr'>$hosAddr / $hosName</li>
				<li class='main-item-title'>$v[ei_name]</li>
				<li class='main-item-desc'>";
				replaceText($v[ei_ages]);
				echo " | ";
				echo date("Y.m.d 까지", $v[ei_end]);
				echo "</li>
				<li> <font style='font-size:60%; text-decoration:line-through'>$original_account 원</font>
				<font class='blue-bold'>$account 원</font></li>
				<li class='heart-icon' ><img  id='heart' onclick='changeImage()' src='/resource/images/mobile/heart-in.png' alt=''></li>
				</ul>
				</div>
				</div>
				<hr>
				";
			}

			?>
			
		</div>
	</section>
	<!-- 3040title -->
	<section class="block4"  >
		<div style="text-align: center;">
			<img style=" margin:25px 0px 45px; width:40vw;" src="/resource/images/mobile/main/3040title.png" alt="3040title">
			<a href="/m/index.php/mobile/contents/event_hospital"><p style="position: absolute;right: 10px; top: 100px; font-size:12px;">더보기<i class="fa fa-angle-right" style="margin-left:5px;"></i></p></a>
			<hr>
			<?php
			$mainitem02 = custom_event_list("TYP002", 3);
		// print_r2($mainitem02);
			foreach ($mainitem02 as $k=> $v) {
				$hosinfo = getHosInfo($v[ei_hiseq]);
				$hosName = $hosinfo[0][hi_open_name];
				$hosAddr = $hosinfo[0][hd_addr1]." ".$hosinfo[0][hd_addr2];
				$banner_src = str_replace("/usr/local/apache/htdocs/okmedical/", "/", $v[ei_img_banner]);
				$original_account = number_format($v[ei_original_account]);
				$account = number_format($v[ei_account]);
				echo "				
				<div class='article' style='position: relative;'>
				<div class='article_img'>
				<a href='index.php/mobile/contents/event_hospital/viewEvent?seq=$v[ei_seq]'>
				<img src='$banner_src' alt='$v[ei_name]'>
				</a>
				</div>
				<div class='article_text'>
				<ul>
				<li class='main-item-addr'>$hosAddr / $hosName</li>
				<li class='main-item-title'>$v[ei_name]</li>
				<li class='main-item-desc'>";
				replaceText($v[ei_ages]);
				echo " | ";
				echo date("Y.m.d 까지", $v[ei_end]);
				echo "</li>
				<li> <font style='font-size:60%; text-decoration:line-through'>$original_account 원</font>
				<font class='blue-bold'>$account 원</font></li>
				<li class='heart-icon' ><img  id='heart' onclick='changeImage()' src='/resource/images/mobile/heart-in.png' alt=''></li>
				</ul>
				</div>
				</div>
				<hr>
				";
			}

			?>
		</div>
	</section>
	<!-- 5060title -->
	<section class="block4"  >
		<div style="text-align: center;">
			<img style=" margin:25px 0px 45px; width:40vw;" src="/resource/images/mobile/main/5060title.png" alt="5060title">
			<a href="/m/index.php/mobile/contents/event_hospital"><p style="position: absolute;right: 10px; top: 95px; font-size:12px;">더보기<i class="fa fa-angle-right" style="margin-left:5px;"></i></p></a>
			<hr>
			<?php
			$mainitem03 = custom_event_list("TYP003", 3);
		// print_r2($mainitem03);
			foreach ($mainitem03 as $k=> $v) {
				$hosinfo = getHosInfo($v[ei_hiseq]);
				$hosName = $hosinfo[0][hi_open_name];
				$hosAddr = $hosinfo[0][hd_addr1]." ".$hosinfo[0][hd_addr2];
				$banner_src = str_replace("/usr/local/apache/htdocs/okmedical/", "/", $v[ei_img_banner]);
				$original_account = number_format($v[ei_original_account]);
				$account = number_format($v[ei_account]);
				echo "				
				<div class='article' style='position: relative;'>
				<div class='article_img'>
				<a href='index.php/mobile/contents/event_hospital/viewEvent?seq=$v[ei_seq]'>
				<img src='$banner_src' alt='$v[ei_name]'>
				</a>
				</div>
				<div class='article_text'>
				<ul>
				<li class='main-item-addr'>$hosAddr / $hosName</li>
				<li class='main-item-title'>$v[ei_name]</li>
				<li class='main-item-desc'>";
				replaceText($v[ei_ages]);
				echo " | ";
				echo date("Y.m.d 까지", $v[ei_end]);
				echo "</li>
				<li> <font style='font-size:60%; text-decoration:line-through'>$original_account 원</font>
				<font class='blue-bold'>$account 원</font></li>
				<li class='heart-icon' ><img  id='heart' onclick='changeImage()' src='/resource/images/mobile/heart-in.png' alt=''></li>
				</ul>
				</div>
				</div>
				<hr>
				";
			}

			?>
		</div>
	</section>
	<!-- womantitle -->
	<section class="block4"  >
		<div style="text-align: center;">
			<img style="margin:25px 0px 45px; width:40vw;" src="/resource/images/mobile/main/womantitle.png" alt="womantitle">
			<a href="/m/index.php/mobile/contents/event_hospital"><p style="position: absolute;right: 10px; top: 100px; font-size:12px;">더보기<i class="fa fa-angle-right" style="margin-left:5px;"></i></p></a>
			<hr>
			<?php
			$mainitem04 = custom_event_list("TYP004", 3);
		// print_r2($mainitem04);
			foreach ($mainitem04 as $k=> $v) {
				$hosinfo = getHosInfo($v[ei_hiseq]);
				$hosName = $hosinfo[0][hi_open_name];
				$hosAddr = $hosinfo[0][hd_addr1]." ".$hosinfo[0][hd_addr2];
				$banner_src = str_replace("/usr/local/apache/htdocs/okmedical/", "/", $v[ei_img_banner]);
				$original_account = number_format($v[ei_original_account]);
				$account = number_format($v[ei_account]);
				echo "				
				<div class='article' style='position: relative;'>
				<div class='article_img'>
				<a href='index.php/mobile/contents/event_hospital/viewEvent?seq=$v[ei_seq]'>
				<img src='$banner_src' alt='$v[ei_name]'>
				</a>
				</div>
				<div class='article_text'>
				<ul>
				<li class='main-item-addr'>$hosAddr / $hosName</li>
				<li class='main-item-title'>$v[ei_name]</li>
				<li class='main-item-desc'>";
				replaceText($v[ei_ages]);
				echo " | ";
				echo date("Y.m.d 까지", $v[ei_end]);
				echo "</li>
				<li> <font style='font-size:60%; text-decoration:line-through'>$original_account 원</font>
				<font class='blue-bold'>$account 원</font></li>
				<li class='heart-icon' ><img  id='heart' onclick='changeImage()' src='/resource/images/mobile/heart-in.png' alt=''></li>
				</ul>
				</div>
				</div>
				<hr>
				";
			}

			?>
		</div>
	</section>
<!-- specialtitle -->
	<section class="block4"  >
		<div style="text-align: center;">
			<img style=" margin:25px 0px 45px; width:40vw;" src="/resource/images/mobile/main/specialtitle.png" alt="specialtitle">
			<a href="/m/index.php/mobile/contents/event_hospital"><p style="position: absolute;right: 10px; top: 100px; font-size:12px;">더보기<i class="fa fa-angle-right" style="margin-left:5px;"></i></p></a>
			<hr>
			<?php
			$mainitem05 = custom_event_list("TYP005", 3);
		// print_r2($mainitem05);
			foreach ($mainitem05 as $k=> $v) {
				$hosinfo = getHosInfo($v[ei_hiseq]);
				$hosName = $hosinfo[0][hi_open_name];
				$hosAddr = $hosinfo[0][hd_addr1]." ".$hosinfo[0][hd_addr2];
				$banner_src = str_replace("/usr/local/apache/htdocs/okmedical/", "/", $v[ei_img_banner]);
				$original_account = number_format($v[ei_original_account]);
				$account = number_format($v[ei_account]);
				echo "				
				<div class='article' style='position: relative;'>
				<div class='article_img'>
				<a href='index.php/mobile/contents/event_hospital/viewEvent?seq=$v[ei_seq]'>
				<img src='$banner_src' alt='$v[ei_name]'>
				</a>
				</div>
				<div class='article_text'>
				<ul>
				<li class='main-item-addr'>$hosAddr / $hosName</li>
				<li class='main-item-title'>$v[ei_name]</li>
				<li class='main-item-desc'>";
				replaceText($v[ei_ages]);
				echo " | ";
				echo date("Y.m.d 까지", $v[ei_end]);
				echo "</li>
				<li> <font style='font-size:60%; text-decoration:line-through'>$original_account 원</font>
				<font class='blue-bold'>$account 원</font></li>
				<li class='heart-icon' ><img  id='heart' onclick='changeImage()' src='/resource/images/mobile/heart-in.png' alt=''></li>
				</ul>
				</div>
				</div>
				<hr>
				";
			}

			?>
		</div>
	</section>



<script>
$(".scrollup").hide(); // 탑 버튼 숨김
    $(function () {
                 
        $(window).scroll(function () {
            if ($(this).scrollTop() > 1000) { // 스크롤 내릴 표시
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });
                
        $('.scrollup').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 600);  // 탑 이동 스크롤 속도
            return false;
        });
    });
</script>
<script>
// Get the modal
var modal2 = document.getElementById("myModal");
var modal3 = document.getElementById("myModal3");
var modal4 = document.getElementById("myModal4");


// Get the button that opens the modal
var btn = document.getElementById("l-text");
var btn2 = document.getElementById("l-text2");
var btn3 = document.getElementById("l-text3");


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close2")[0];
var span3 = document.getElementsByClassName("close3")[0];

var img_close = document.getElementsByClassName("img_close")[0];
var img_close2 = document.getElementsByClassName("img_close2")[0];
var img_close3 = document.getElementsByClassName("img_close3")[0];


// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal2.style.display = "block";
  modal2.style.position = "fixed";
  modal2.style.top = "0";
  modal2.style.left = "0";
}
btn2.onclick = function() {
	modal3.style.display = "block";
}
btn3.onclick = function() {
	modal4.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal2.style.display = "none";
}
span2.onclick = function() {
  modal3.style.display = "none";
}
span3.onclick = function() {
  modal4.style.display = "none";
}
img_close.onclick = function() {
  modal2.style.display = "none";
}
img_close2.onclick = function() {
  modal3.style.display = "none";
}
img_close3.onclick = function() {
  modal4.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal2 ) {
    modal2.style.display = "none";
  } else if(event.target == modal3){
	modal3.style.display = "none";
  } else if(event.target == modal4){
	modal4.style.display = "none";
  }
}
var time01 = document.getElementById("CountDown2").value;
// var countDownDate01 = new Date(time01).getTime();
var countDownDate01 = new Date(time01).getTime();


// Update the count down every 1 second
var x1 = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now and the count down date
    var distance = countDownDate01 - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));    
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    // Output the result in an element with id="demo"
    document.getElementById("CountDown").innerHTML = days + "일 " + hours + "시간 " + minutes + "분 " + seconds + "초";
    

    
    // If the count down is over, write some text 
    if (distance < 0) {
    	clearInterval(x);
    	document.getElementById("CountDown").innerHTML = "종료!";
    }
}, 1000);

</script>
<script>
// 텍스트변경
function change(v)
{
	// 연령옵션
	document.getElementById("l-text").innerHTML=v.innerHTML;
	modal2.style.display = "none";
}
function change2(v)
{
	// 지역옵션
	document.getElementById("l-text2").innerHTML=v.innerHTML;
	modal3.style.display = "none";
}
function change3(v)
{
	// 테마옵션
	document.getElementById("l-text3").innerHTML=v.innerHTML;
	modal4.style.display = "none";
}

function changeImage()
{
element=document.getElementById('heart')
if (element.src.match("out"))
  {
  element.src="/resource/images/mobile/heart-in.png";
  }
else
  {
  element.src="/resource/images/mobile/heart-out.png";
  }
}

</script>

<script type="text/javascript">jssor_1_slider_init();</script>
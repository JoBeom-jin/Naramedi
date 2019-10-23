<!DOCTYPE html>

<html lang="en-US">
<head>
	<title>
		<?=$shop_name?> 
		<?if($html_title):?>
		&gt; <?=$html_title?>
		<?endif;?>
	</title>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?if($meta_datas):?>
	<?foreach($meta_datas as $k => $v):?>
	<?=$v?>
	<?endforeach;?>
	<?endif;?>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108011009-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-108011009-1');
	</script>



	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/resource/css/reset.css"/>
	<link rel="stylesheet" href="/resource/assets/fonts/font-awesome.css"  type="text/css">    
	<link rel="stylesheet" href="/resource/assets/bootstrap/css/bootstrap.css" type="text/css">
	<link rel="stylesheet" href="/resource/assets/css/bootstrap-select.min.css" type="text/css">
	<link rel="stylesheet" href="/resource/assets/css/owl.carousel.css" type="text/css">
	<link rel="stylesheet" href="/resource/assets/css/jquery.mCustomScrollbar.css" type="text/css">
	<link rel="stylesheet" href="/resource/assets/css/style.css" type="text/css">
	<link rel="stylesheet" href="/resource/assets/css/user.style.css" type="text/css">
	<link rel="stylesheet" href="/resource/assets/css/lightslider.css"/>
	<link rel="stylesheet" href="/resource/assets/fonts/font-noto.css" />

	

	<script type="text/javascript" src="/resource/assets/js/jquery-2.1.0.min.js"></script>
	<!-- 	<script type="text/javascript" src="/resource/assets/js/before.load.js"></script> -->
	<script type="text/javascript" src="/resource/assets/js/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="/resource/assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/resource/assets/js/smoothscroll.js"></script>
	<script type="text/javascript" src="/resource/assets/js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="/resource/assets/js/jquery.hotkeys.js"></script>
	<script type="text/javascript" src="/resource/assets/js/icheck.min.js"></script>
	<script type="text/javascript" src="/resource/assets/js/custom.js"></script>
	

	<?=$js?>
	<?=$css?>	

	<!-- facebook fixel -->
	<!-- Facebook Pixel Code -->
	<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
			n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
				document,'script','https://connect.facebook.net/en_US/fbevents.js');
			fbq('init', '139985983286163');
			fbq('track', 'PageView');
			fbq('track', 'ViewContent', {content_type : 'page', content_category:'pc : content'});
			fbq('track', 'Lead', {content_name:'visit page', content_category:'pc : content'});
		</script>

		<!-- 쿠키 가져오기 -->
		<script>
			var getCookie = function(name) {
				var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
				return value? value[2] : null;
			};		
		</script>
		<style>
		.cookie{
			z-index: 0 !important;
		}
	</style>

	<noscript>
		<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=139985983286163&ev=PageView&noscript=1"/>
	</noscript>
	<!-- DO NOT MODIFY -->
	<!-- End Facebook Pixel Code -->


	<style type="text/css">
	ul{list-style: none outside none; padding-left: 0; margin: 0;}
	.demo .item{margin-bottom: 60px;}
	.content-slider li{background-color: #ed3020;text-align: center;color: #FFF;}
	.content-slider h3 {margin: 0;padding: 70px 0;}
	.demo{width: 800px;}
	.item{height:380px;}
	.container{width:1174px !important;}
	#white{
		color: white;
	}
	#white:hover{
		color: white;
	}

	/*폐쇄몰 로고*/
	#cf {
		position:relative;
		height:48px;
		width:200px;
		margin:0 auto;
	}

	#cf img {
		position:absolute;
		left:0;
		-webkit-transition: opacity 1s ease-in-out;
		-moz-transition: opacity 1s ease-in-out;
		-o-transition: opacity 1s ease-in-out;
		transition: opacity 1s ease-in-out;
	}

	@keyframes cfFadeInOut {
		0% {
			opacity:1;
		}
		45% {
			opacity:1;
		}
		55% {
			opacity:0;
		}
		100% {
			opacity:0;
		}
	}
	@keyframes cfFadeOutIn {
		0% {
			opacity:0;
		}
		45% {
			opacity:0;
		}
		55% {
			opacity:1;
		}
		100% {
			opacity:1;
		}
	}

	#cf img.top {
		animation-name: cfFadeInOut;
		animation-timing-function: ease-in-out;
		animation-iteration-count: infinite;
		animation-duration: 5s;
		animation-direction: alternate;
	}
	#cf img.bottom {
		animation-name: cfFadeOutIn;
		animation-timing-function: ease-in-out;
		animation-iteration-count: infinite;
		animation-duration: 5s;
		animation-direction: alternate;
	}
</style>


</head>
<!-- 
<script language='JavaScript' type='text/javascript'>

var domain = "https://test11.oorionefm.com";
function resizeiFrame(D)
{
	var h = document.body.scrollHeight;
	ifrmUrl = domain + "/aspLink/ifrm_asp_resize.asp?h=" + h;
	// ifrmUrl = domain + "/aspLink/ifrm_asp_resize.asp?h=1367";
	// ifrmUrl = "https://test11.oorionefm.com/aspLink/ifrm_asp_resize.asp?h=1367";
	document.resizeIfr.location.href = ifrmUrl;
	window.scrollTo(0,0);	

}
document.write("<iframe width='100%' id='resizeIfr' name='resizeIfr' src='' marginwidth='0' marginheight='0' frameBorder='0' width='0' height='0' scrolling='no' style='display: none;'></iframe>");
resizeTime = 1000;
setTimeout('resizeiFrame()',resizeTime);

</script> -->

<!-- <iframe width="100%" id="resizeIfr" name="resizeIfr" src="http://test11.oorionefm.com/aspLink/ifrm_asp_resize.asp?h=1367" marginwidth="0" marginheight="0" frameborder="0" height="0" scrolling="no" style="display: none;"></iframe> -->

<body onunload="" class="map-fullscreen page-homepage navigation-top-header" id="page-top"  >
	<!-- Outer Wrapper-->
	<div id="outer-wrapper">

		<!-- Inner Wrapper -->
		<div id="inner-wrapper">

			<!-- header -->
			<div class="header" id="header" style="background: rgba(0, 0, 0, 0.45);">
				<div style="display: inline-block;float: none;">
					<div class="" style="height: 50px; padding: 5px; line-height: 50px; padding: 0 calc(100vw / 2 - 590px);">
						<div class="user-area" style="float: left;">
							<?if(!$_Auth->isLogin()):?><!-- 
							<div>
								<a href="<?=$contents_url?>/my_lastest" class="snip1170 blue"><i class="fa fa-check" style="color:#89bae3"></i></a>
								<a href="<?=$contents_url?>/my_lastest">&nbsp;최근본상품</font></a>
							</div> -->
							
							<?if(!$shop_logo):?>
							<div style="color: white;">
								<!-- <a href="/index.php/medical/contents/login_login" class="snip1170 blue"><i class="fa fa-user" style="color:#89bae3"></i></a> -->
								<a id="white" href="/index.php/medical/contents/login_login/">로그인</a>
								&nbsp;&nbsp;|&nbsp;&nbsp;
								<a id="white" href="/index.php/medical/contents/login_login/joinForm">회원가입</a>
								&nbsp;&nbsp;|&nbsp;&nbsp;
								<a id="white" href="/index.php/medical/contents/etc_guide">제휴문의</a>
							</div>
							<?endif;?>


							<?else:?>
							<div class="dropdown">
								<font color="#ffffff">&nbsp;<?=$_Auth->name()?>님</font>
								<!-- <i class="fa fa-check" style="color:#167bd0"></i> -->

								<div class="dropdown-content" id="my-menu-list">
									<a href="<?=$contents_url?>/my_myinfo#panel1" class="noact">예약현황</a>
									<a href="<?=$contents_url?>/my_myinfo#panel2" class="noact">최근 본 상품</a>
									<a href="<?=$contents_url?>/my_myinfo#panel3" class="noact">찜한 이벤트</a>
									<a href="<?=$contents_url?>/my_myinfo#panel4" class="noact">작성후기</a>
									<a href="<?=$contents_url?>/my_myinfo#panel5" class="noact">개인정보변경</a>
									<a href="<?=$contents_url?>/etc_logout" target="formReceiver" onclick="return confirm('로그아웃 하시겠습니까?');">로그아웃</a>
								</div>
							</div>								
							<?endif;?>
						</div>
						<div style="text-align: right; padding-right: 40px;">
							<a target="_blank" href="https://pf.kakao.com/_xdKzWd"><img src="/resource/images/custom/snsicon_01.png" style="padding: 5px;" alt="kakao"></a>
							<a target="_blank" href="https://blog.naver.com/infinitycare"><img src="/resource/images/custom/snsicon_02.png" style="padding: 5px;" alt="blog"></a>
							<a target="_blank" href="https://www.facebook.com/okaymedi/"><img src="/resource/images/custom/snsicon_03.png" style="padding: 5px;" alt="facebook"></a>
							<a target="_blank" href="https://www.instagram.com/okaymedi/"><img src="/resource/images/custom/snsicon_04.png" style="padding: 5px;" alt="insta"></a>
						</div>
					</div>
					<hr style="width: 100vw;margin: 0;">
					<div style="padding: 0 calc(100vw / 2 - 590px); height: 80px;">
						<div class="wrapper"  style="/*min-width:1300px !important; */padding: 15px 0;">
							<a href="/index.php">
								<div class="brand" id="cf">
									<?if($shop_logo):?>
									<img class="bottom" src="/resource/images/medical/common/logo.png" alt="logo"/>
									<img class="top" style="height: 48px !important" src="<?=$shop_logo?>" alt="logo">
									<?else:?>
									<img class="" src="/resource/images/medical/common/logo.png" alt="logo"/>
									<?endif;?>
								</div>
							</a>
							<nav class="navigation-items">
								<div class="wrapper" style="padding-right: 40px;">
									<div class="main-navigation navigation-top-header" style="margin: 0; padding: 0;">
										<ul>
											<?foreach($accessable_menu_list as $m1_code => $m1):?>
											<?if(array_key_exists('hidden', $m1) && $m1['hidden']) continue;?>
											<?	
											$menu_code = false;
											if(array_key_exists('childs', $m1)){									
												$icon = false;
												foreach($m1['childs'] as $k => $m2){
													if(array_key_exists('hidden', $m2) && $m2['hidden']) continue;
													$menu_code = $k;
													if(array_key_exists('icon', $m2)) $icon = $m2['icon'];
													break;
												}
											}
											?>
											<li>
												<a href="<?=$_site_config['url']['contents']?>/<?=$m1_code?>_<?=$menu_code?>"><!-- 
													<?if($icon):?>
													<img src="<?=$icon?>" alt="<?=$m1['title']?>">
													<?endif;?> -->
													<strong><?=$m1['title']?></strong>
												</a>
											</li>
											<?endforeach;?>
										</ul>							
									</div><!-- 
									<div class="toggle-navigation">
										<div class="icon">
											<div class="line"></div>
											<div class="line"></div>
											<div class="line"></div>
										</div>
									</div> -->
								</div>
							</nav>
						</div>
					</div>			
				</div>
			</div>
			<!-- END :: header -->

			


			<!-- Page Canvas-->
			<div id="page-canvas" style="">
				<!--Off Canvas Navigation-->
				<nav class="off-canvas-navigation">
					<header>Navigation</header>
					<div class="main-navigation navigation-off-canvas"></div>
				</nav>
            <!--end Off Canvas Navigation-->
			<p>dddd</p>
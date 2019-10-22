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
		
		<link rel="stylesheet" href="/resource/assets/fonts/font-noto.css"  type="text/css">  
	<link rel="apple-touch-icon-precomposed" href="../okaymedi.com/favicon-152.png" />
	<link rel="stylesheet" href="<?=$_site_config['url']['css']?>/font-awesome.min.css" />
	<link rel="stylesheet" href="<?=$_site_config['url']['css']?>/materialize.min.css" />
	<link rel="stylesheet" href="<?=$_site_config['url']['css']?>/slick.css" />
	<link rel="stylesheet" href="<?=$_site_config['url']['css']?>/slick-theme.css" />
	<link rel="stylesheet" href="<?=$_site_config['url']['css']?>/owl.carousel.css" />
	<link rel="stylesheet" href="<?=$_site_config['url']['css']?>/owl.theme.css" />
	<link rel="stylesheet" href="<?=$_site_config['url']['css']?>/owl.transitions.css" />
	<link rel="stylesheet" href="<?=$_site_config['url']['css']?>/style.css" />


	<link href="<?=$_site_config['url']['assets']?>/fonts/font-awesome.css" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="<?=$_site_config['url']['assets']?>/bootstrap/css/bootstrap.css" type="text/css">
	<link rel="stylesheet" href="<?=$_site_config['url']['assets']?>/css/bootstrap-select.min.css" type="text/css">
	<link rel="stylesheet" href="<?=$_site_config['url']['assets']?>/css/owl.carousel.css" type="text/css">
	<link rel="stylesheet" href="<?=$_site_config['url']['assets']?>/css/jquery.mCustomScrollbar.css" type="text/css">
	<link rel="stylesheet" href="<?=$_site_config['url']['assets']?>/css/style.css" type="text/css">
	<link rel="stylesheet" href="<?=$_site_config['url']['assets']?>/css/user.style.css" type="text/css">
	<link rel="stylesheet"  href="<?=$_site_config['url']['assets']?>/css/lightslider.css"/>
	

	

	<?=$js?>
	<?=$css?>	

<!-- 	<script src="/resource/assets/js/mobile.custom.js"></script> -->
<!-- 	<script src="/resource/js/custom.js"></script> -->

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

	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=139985983286163&ev=PageView&noscript=1"
	/></noscript>
	<!-- DO NOT MODIFY -->
	<!-- End Facebook Pixel Code -->	

</head>
<body class="map-fullscreen">
	
	<!-- navbar -->
	<div class="navbar" style="position:fixed; padding:5px 0px 0px 0px;" id="page-top">
		<div class="container" style="height:44px; overflow:hidden;">
			<div class="panel-control-left">
				<a href="#" data-activates="slide-out-left" class="sidenav-control-left"><i class="fa fa-bars"></i></a>
			</div>
			<div class="site-title">
				<a href="<?=$_site_config['url']['root']?>" class="logo">
					<img src="<?=$_site_config['url']['images']?>/logo.gif" alt="OK검진">
				</a>
			</div>
		</div>

		<div id="menu-container" style="z-index:59;">
			<div class="menu-item">
				<h5>				
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
					<a href="<?=$_site_config['url']['contents']?>/<?=$m1_code?>_<?=$menu_code?>"><?=$m1['title']?></a> 
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<?endforeach;?>
				</h5>
			</div>
		</div>
	</div>
	<!-- end navbar -->


	<!-- panel control left -->
	<div class="panel-control-left">
		<ul id="slide-out-left" class="side-nav collapsible"  data-collapsible="accordion">


			<div style="background-color:#e6536b; padding:10px 0px 10px 0px; height: 150px; text-align:center;">
				<?if(!$_Auth->isLogin()):?>
				<br>
				<h4>
					<font color="white">로그인을 해주세요 </font>
				</h4>

				<a href="/m/index.php/mobile/contents/login_login" class="button button-mini button-border3 button-rounded3" style="width:100px; display:inline-block;">
					<span><i class="icon-gift" ></i>로그인</span>					
				</a>
				<?else:?>
				<div style="padding:0px 0px 0px 0px;">
					<i class="fa fa-user fa-lg" style="color:#f5d3eb"></i>
					<font color="white">&nbsp;<?=$_Auth->name()?></font><i class="fa fa-check" style="color:white"></i>
					<br>
					<a href="/m/index.php/mobile/contents/my_change" class="button button-mini button-border3 button-rounded3" style="width:100px; display:inline-block;">
						<span><i class="icon-gift" ></i>개인정보변경</span>
					</a>
					<a href="<?=$contents_url?>/etc_logout" class="button button-mini button-border3 button-rounded3" style="width:100px; display:inline-block;" target="formReceiver" onclick="return confirm('로그아웃 하시겠습니까?');">
						<span><i class="icon-gift" ></i>로그아웃</span>
					</a>
				</div>
				<?endif;?>		

				
			</div>
			
			<?if($_Auth->isLogin()):?>
			<li>
				<a href="/m/index.php/mobile/contents/my_reserve"><i class="fa fa-calendar fa-lg" style="color:#3b385b;"></i>나의 예약 현황</a>
			</li>
			<li>
				<a href="/m/index.php/mobile/contents/my_lastest"><i class="fa fa-eye fa-lg" style="color:#3b385b;"></i>최근 본 상품</a>
			</li>
			<li>
				<a href="/m/index.php/mobile/contents/my_checked"><i class="fa fa-heart fa-lg" style="color:#3b385b;"></i>찜한 이벤트</a>
			</li>
			<li>
				<a href="/m/index.php/mobile/contents/my_reply"><i class="fa fa-pencil fa-lg" style="color:#3b385b;"></i>작성 후기</a>
			</li>

			<hr/>
			<?endif;?>

			<li>
				<a href="<?=$_site_config['url']['contents']?>/notice_notice"><i class="fa fa-commenting fa-lg" style="color:#3b385b;"></i>공지사항</a>
			</li>
			<li>
				<a href="<?=$_site_config['url']['contents']?>/etc_intro"><i class="fa fa-check fa-lg" style="color:#3b385b;"></i>OK검진 소개</a>
			</li>
			<li>
				<a href="<?=$_site_config['url']['contents']?>/etc_gcenter"><i class="fa fa-medkit fa-lg" style="color:#3b385b;"></i>고객센터</a>
			</li>
			<li>
				<a href="<?=$_site_config['url']['contents']?>/etc_guide"><i class="fa fa-handshake-o fa-lg" style="color:#3b385b;"></i>제휴문의</a>
			</li>

			<div id="menu-area-bottom"style="border-top:1px solid #a0a0a0; border-bottom:1px solid #a0a0a0; height: 30px; text-align:center;  margin:10px 0px 20px 0px;">
				<h4>
					<font color="#a0a0a0"><a href="<?=$_site_config['url']['contents']?>/etc_terms" >이용약관 </a>
					&nbsp;&nbsp;&nbsp; 
					<a href="<?=$_site_config['url']['contents']?>/etc_personal">개인정보보호정책</a></font>
				</h4>
			</div>

			<div class="container">

				<div class="tel-fax-mail" style="text-align:center;">
					<ul>
						<li><h4><font color="#c5c5c5">㈜인피니티케어 | Tel:1588-9419</font></h4></li>
						<li><h4><font color="#c5c5c5">ⓒINFINITYCARE All Rights Reserved</font></h4>
					</ul>
				</div>
			</div>
		</ul>
	</div>
	<!-- end panel control left -->


<div id="body-contents" style="padding-top:40px; clear:both;" class="navigation">
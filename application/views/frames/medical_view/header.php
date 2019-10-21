<!DOCTYPE html>

<html lang="en-US">
<head>
	<title><?=$_site_config['site']['title']?></title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=720, initial-scale=1.0">


	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/resource/assets/fonts/font-awesome.css"  type="text/css">    
    <link rel="stylesheet" href="/resource/assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/resource/assets/css/bootstrap-select.min.css" type="text/css">
    <link rel="stylesheet" href="/resource/assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="/resource/assets/css/jquery.mCustomScrollbar.css" type="text/css">
    <link rel="stylesheet" href="/resource/assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="/resource/assets/css/user.style.css" type="text/css">
	<link rel="stylesheet" href="/resource/assets/css/lightslider.css"/>

	

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

	<style type="text/css">
		ul{list-style: none outside none; padding-left: 0; margin: 0;}
        .demo .item{margin-bottom: 60px;}
		.content-slider li{background-color: #ed3020;text-align: center;color: #FFF;}
		.content-slider h3 {margin: 0;padding: 70px 0;}
		.demo{width: 800px;}		
	</style>

</head>
<body onunload="" class="map-fullscreen page-homepage navigation-top-header" id="page-top">
<!-- Outer Wrapper-->
<div id="outer-wrapper">

	<!-- Inner Wrapper -->
    <div id="inner-wrapper">
		
		<!-- header -->
		<div class="header">
			 <div class="wrapper">
				<div class="brand">
                    <a href="/">
					<img src="<?=$_site_config['url']['images']?>/common/logo.gif" alt="logo"></a>
                </div>

				<nav class="navigation-items">
                    <div class="wrapper">
                        <div class="main-navigation navigation-top-header">
							<ul>								
								<?foreach($accessable_menu_list as $m1_code => $m1):?>
								<?if(array_key_exists('hidden', $m1) && $m1['hidden']) continue;?>
								<?	
									$menu_code = false;
									if(array_key_exists('childs', $m1)){									
										foreach($m1['childs'] as $k => $m2){
											if(array_key_exists('hidden', $m2) && $m2['hidden']) continue;
											$menu_code = $k;
											break;
										}
									}
								?>
								<li>
									<a href="<?=$_site_config['url']['contents']?>/<?=$m1_code?>_<?=$menu_code?>"><strong><?=$m1['title']?></strong></a>
								</li>
								<?endforeach;?>
							</ul>							
						</div>
                        <ul class="user-area">
							<li>
								<a href="<?=$contents_url?>/my_lastest" class="snip1170 blue"><i class="fa fa-check" style="color:#89bae3"></i></a>
								<a href="<?=$contents_url?>/my_lastest">&nbsp;최근본상품</font></a>
							</li>

							<li>
								<a href="/index.php/medical/contents/login_login" class="snip1170 blue"><i class="fa fa-user" style="color:#89bae3"></i></a>
								<a href="/index.php/medical/contents/login_login">&nbsp;로그인</font></a>
							</li>
                        </ul>

						<a href="h_cooperate.html" class="button button-mini button-border button-rounded"><span><i class="icon-gift"></i>제휴문의</span></a>
                        <div class="toggle-navigation">
                            <div class="icon">
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                </nav>
				
			 </div>			
		</div>
		<!-- END :: header -->


		<!-- Page Canvas-->
		<div id="page-canvas">
			<!--Off Canvas Navigation-->
            <nav class="off-canvas-navigation">
                <header>Navigation</header>
                <div class="main-navigation navigation-off-canvas"></div>
            </nav>
            <!--end Off Canvas Navigation-->


			 <!--Page Content-->
            <div id="page-content2">


		


		
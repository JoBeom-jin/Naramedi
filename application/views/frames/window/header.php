<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8" />
        <title><?=$_site_config['site']['title']?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
        <meta content="" name="author" /> 
		<link type="text/css"  rel="stylesheet" href="/resource/css/common.css" />
		<link rel="stylesheet" href="/resource/assets/fonts/font-noto.css"  type="text/css">  
		<?=$css?>
		<?=$js?>
	</head>

	<body  class="window-form">

	<div id="wrap">
		<!-- header --> 
		<div id="header">
			<div class="logo_wrap">
				<h1 class="logo"><a class="link" href="{_SERVER.PHP_SELF}"><?=$_site_config['site']['logo']?></a></h1>
				<strong class="tit">관리자</strong>
			</div>
			
			<div class="session_wrap">
				<p class="user_info">
					<span class="team">관리자</span>
					<strong class="name"><?=$_Auth->name()?></strong>
				</p>
				<div class="btn_wrap">
					<a href="<?=$_site_config['url']['contents']?>/login_login/logoutOk" target="formReceiver" class="logout ico"><span class="ico"></span>로그아웃</a>
				</div>
			</div>
		</div>
		<!-- header end --> 
		
		<hr class="clear"/>

		<!-- container -->
		<div id="container">		

			<!-- content --> 
			<div id="content">
				
				<!-- listBtnMenu -->
				<div class="listBtnMenu">&nbsp;</div>

				<hr/>
				<!-- content_header -->
				<div class="content_header">
				</div>
				
				<hr/>
				<!-- cont -->
				<div class="cont">
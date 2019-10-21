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
		<?=$css?>
		<?=$js?>
	</head>

	<body>

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
					<a href="<?=$_site_config['url']['contents']?>/login_logout" target="formReceiver" class="logout ico"><span class="ico"></span>로그아웃</a>
				</div>
			</div>
		</div>
		<!-- header end --> 
		
		<hr class="clear"/>

		<!-- container -->
		<div id="container">
			<!-- lft_gnb -->
			<div class="lft_gnb">
				<div class="menu_viewall_wrap">
<!-- 					<a class="btn menu_viewall" href="#none">전체메뉴</a> -->
				</div>
				<div class="nav">
					<ul class="depth1">
						<li class="menu">
							<span class="link active" >
							<span class="inner"></span>대쉬보드
							</span>
							<ul class="depth2" style="display:block;">
								<li class="menu <?if(!isset($menu2)):?>active<?endif;?>">
									<a href="/index.php/rhksflwk" class="link <?if(!isset($menu2)):?>active<?endif;?>">
									상황판
									</a>
								</li>
							</ul>							
						</li>

						<?foreach($accessable_menu_list as $m1_code => $m1):?>
						<?if($m1['hidden']) continue;?>
						<li class="menu active">							
							<span class="link active" >
							<span class="inner"></span><?=$m1['title']?>
							</span>
							<?if(count($m1['childs']) > 0):?>
							<ul class="depth2" style="display:block;">
								<?foreach($m1['childs'] as $m2_code => $m2):?>
								<li class="menu <?if($m2_code == $menu2['menu_code']):?>active<?endif;?>">
									<a class="link <?if($m2_code == $menu2['menu_code']):?>active<?endif;?>" href="<?=$_site_config['url']['contents']?>/<?=$m1_code?>_<?=$m2_code?>">
										<?=$m2['title']?>
									</a>																
								</li>		
								<?endforeach;?>
							</ul>
							<?endif;?>
						</li>	
						<?endforeach;?>						
					</ul>					
				</div>
			</div>
			<!-- //lft_gnb -->

			<hr/>

			<!-- content --> 
			<div id="content">
				<div class="btn_fold_wrap">
					<a class="btn_fold" href="#none">&nbsp;</a>
				</div>
				<!-- listBtnMenu -->
				<div class="listBtnMenu">&nbsp;</div>

				<hr/>
				<!-- content_header -->
				<div class="content_header">
				</div>
				
				<hr/>
				<!-- cont -->
				<div class="cont">
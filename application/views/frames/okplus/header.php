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
	<link rel="stylesheet" href="<?=$_site_config['url']['css']?>/materialize.min.css"/>
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

	<script src="/resource/assets/js/mobile.custom.js"></script>
	<script src="/resource/js/custom.js"></script>

<style>
#map-search,
#search-map_view{
	margin-top:0;
}

</style>


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

<div id="body-contents" style="clear:both;" class="navigation">

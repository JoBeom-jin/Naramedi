<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8" />
        <title><?=$_site['title']?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
        <meta content="" name="author" /> 
		<link type="text/css"  rel="stylesheet" href="/resource/css/common.css" />
		<?=$css?>
		<?=$js?>


		<?if(in_array('COMPLETE', $sact)):?>
		<!-- facebook fixel -->
			<!-- Facebook Pixel Code -->
			<script>
				!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
				n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
				n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
				t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
				document,'script','https://connect.facebook.net/en_US/fbevents.js');
				fbq('init', '139985983286163');
			</script>

			<noscript><img height="1" width="1" style="display:none"
			src="https://www.facebook.com/tr?id=139985983286163&ev=PageView&noscript=1"
			/></noscript>
			<!-- DO NOT MODIFY -->
			<!-- End Facebook Pixel Code -->
		<?endif;?>
	</head>

	<body>
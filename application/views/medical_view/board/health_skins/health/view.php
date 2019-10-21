<section class="hero-image" style="height: 640px !important;">
	<div class="background" style="background:url(/resource/images/medical/health_post/health_post_top.png) center;">
	</div>
</section>
<div class="container" id="borde-health" style="position: absolute; top: 569px; left: calc(100vw/2 - 587px); padding-top: 0px;">

	<?php

		$bdc_seq = $_REQUEST['bdc_seq'];
		$bdc_seq_1 = null;
		$bdc_seq_3 = null;
		$bdc_seq_4 = null;
		if (isset($bdc_seq)) {
			switch ($bdc_seq) {
				case '1':
					$bdc_seq_1 = "menu-on";
					break;
				case '4':
					$bdc_seq_4 = "menu-on";
					break;
				case '3':
					$bdc_seq_3 = "menu-on";
					break;
				default:
					break;
			}
		}

?>

	<div class="col_third" id="menu_box">
		<div class="at-icon-box" style="background-color:white !important; color: #666666;">

			<div class="at-icon-box-text ">
				<h4 class="<?=$bdc_seq_1?>">건강정보</h4>
			</div>


			<a class="link" href="<?=$menu_url?>/<?=$act?>?bdc_seq=1"></a>
		</div>
	</div>

	<div class="col_third" id="menu_box">
		<div class="at-icon-box" style="background-color:white !important; color: #666666;">

			<div class="at-icon-box-text ">

				<h4 class="<?=$bdc_seq_4?>">검진항목</h4>
			</div>

			<a class="link" href="<?=$menu_url?>/<?=$act?>?bdc_seq=4"></a>
		</div>
	</div>

	<div class="col_third" id="menu_box">
		<div class="at-icon-box" style="background-color:white !important; color: #666666;">
			<div class="at-icon-box-text ">

				<h4 class="<?=$bdc_seq_3?>">자주하는 질문</h4>
			</div>


			<a class="link" href="<?=$menu_url?>/<?=$act?>?bdc_seq=3"></a>
		</div>
	</div>
</div>
<section class="container">

	<div class="">

		<div class="bg-white" style="/* border:1px solid #cdcdcd; */">
			<section class="block" id="main-content">
				<div class="">
					<div class="page-title" style="height: 65px; border-bottom: 2px black solid; line-height: 35px !important; font-weight: 600;">
						<?=$categories[$article['bd_bdcseq']]['bdc_name']?>
					</div>
					<section>
						<div style="height: 60px;">
							<div style="float: left">
								<h1>
									<?=$article['bd_subject']?>
								</h1>
							</div>
							<div style="float: right;">
								<img src="/resource/images/medical/icons/snsicon_text.png" style="padding-top:13px; padding-right: 5px;">
								<a href="http://www.facebook.com/sharer/sharer.php?u=<?=$_full_url?>" target="_blank">
									<img src="/resource/images/medical/icons/snsicon_newf.png" style="padding-top:13px; padding-right: 5px;">
								</a>

								<a href="https://twitter.com/intent/tweet?text=<?=$twitter_text?>&url=<?=$_full_url?>" target="_blank">
									<img src="/resource/images/medical/icons/snsicon_newt.png" style="padding-top:13px; padding-right: 5px;">
								</a>

								<a href="https://story.kakao.com/share?url=<?=$_full_url?>" target="_blank">
									<img src="/resource/images/medical/icons/snsicon_newk.png" style="padding-top:13px; padding-right: 5px;">
								</a>
							</div>
						</div>
						<hr />
						<div style="border-bottom: 2px black solid">
							<?if($article['links'][0]['bl_url']):?>
							<a href="http://<?=$article['links'][0]['bl_url']?>" target="_blank" class="button button-small button-border2 button-rounded2"
							 style="position:absolute; top:30px; right:45px;"><span>관련이벤트</span></a>
							<?endif;?>


							<!-- <a href="#" class="snip1160 red cd-popup-trigger" style="position:absolute; top:-5px; right:-35px;" data-popnum="1"><i class="fa fa-share-alt" style="color:#656565"></i></a> -->


							<?=$article['bd_content']?>




							<?if($article['links'][0]['bl_url']):?>
							<a href="http://<?=$article['links'][0]['bl_url']?>" target="_blank" class="button button-big button-border2 button-rounded2"
							 style="float:right;"><span>관련이벤트 바로가기</span></a>
							<?endif;?>
						</div>
					</section>

				</div>
			</section>
		</div>
	</div>
	


<div class="" style="margin-top:30px;">
				<section class="block" id="main-content" style="width: 164px; height: 48px; float: left; visibility: hidden;">
					<a href="<?=$menu_url?>">
						<div style="margin: auto; width: 164px; height: 48px; border: none; background-image: url('/resource/images/medical/notice/content_arrow_pre.png'); background-repeat: no-repeat;background-position: center;">&nbsp;</div>
					</a>
				</section>
				<section class="block" id="main-content" style="width: 164px; height: 48px; margin: 0 calc(100vw/2 - 450px); position: absolute;">
					<a href="<?=$menu_url?>">
						<div style="margin: auto; width: 164px; height: 48px; border: none; background-color: #393f4b; color: white; font-size: 16px; line-height: 48px; text-align: center">목록</div>
					</a>
				</section>
				<section class="block" id="main-content" style="width: 164px; height: 48px; float: right; visibility: hidden;">
					<a href="<?=$menu_url?>">
						<div style="margin: auto; width: 164px; height: 48px; border: none; background-image: url('/resource/images/medical/notice/content_arrow_next.png'); background-repeat: no-repeat;background-position: center;">&nbsp;</div>
					</a>
				</section>
		</div>

</section>

<!-- 
<div class="cd-popup popnum1" role="alert">
	<div class="cd-popup-container">
		<p>SNS 공유하기</p>

		<a href="http://www.facebook.com/sharer/sharer.php?u=<?=$_full_url?>" target="_blank">
			<img src="/resource/images/medical/icons/snsicon_f.png" style="padding-bottom:30px;">
		</a>

		<a href="https://twitter.com/intent/tweet?text=<?=$twitter_text?>&url=<?=$_full_url?>" target="_blank">
			<img src="/resource/images/medical/icons/snsicon_t.png" style="padding-bottom:30px;">
		</a>

		<a href="https://story.kakao.com/share?url=<?=$_full_url?>" target="_blank">
			<img src="/resource/images/medical/icons/snsicon_k.png" style="padding-bottom:30px;">
		</a>
		<a href="#0" class="cd-popup-close img-replace">Close</a>
	</div>
</div> -->

<script type="text/javascript" src="/resource/js/popup_require_jq.js"></script>
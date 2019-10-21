<section class="container3" id="health-view">
	<div>
		<img src="/resource/images/mobile/post/post_main_img2.png" alt="post메인이미지" style="width:100%;">
	</div>
	<div class="row">
		<div class="tab-box">
			<a class="link" href="<?=$menu_url?>/<?=$act?>?bdc_seq=1">
				<h4 class="blue">건강정보</h4>
			</a>

			<a class="link" href="<?=$menu_url?>/<?=$act?>?bdc_seq=4">
				<h4 class="orange">검진항목</h4>
			</a>
			
			<a class="link" href="<?=$menu_url?>/<?=$act?>?bdc_seq=3">
				<h4 class="gray">자주하는 질문</h4>
			</a>

		</div>
	</div>	

	<div class="row">
		<div class="col-md-2 col-sm-2"></div>

		<div class="col-md-8 col-sm-8 bg-white" style="padding:0px; border-top: 1px solid #393f4b;">
			<section class="block" id="main-content">
				<div class="col-md-12 col-sm-12" style="padding:0px;">
				
					<section>
						<article class="block">
							<header>
								<!-- <font color="gray" size="4px"><?=$categories[$article['bd_bdcseq']]['bdc_name']?></font> -->
								<h1 style="width:80%;line-height: inherit; margin: 10px; font-size:15px;"><?=$article['bd_subject']?></h1>
							</header>
						</article>

						

						<div style="background:#fff !important;">
						<?if($article['links'][0]['bl_url']):?>
						<a href="http://<?=$article['links'][0]['bl_url']?>" target="_blank" class="button button-small button-border2 button-rounded2" style="position:absolute; top:30px; right:45px;"><span>관련이벤트</span></a>
						<?endif;?>		
						

						<a href="#" class="cd-popup-trigger" style="position:absolute; top:10px; right:10px; width:20px;" data-popnum="1" >
						<img src="/resource/images/mobile/action_icon.png" alt="action_icon">
						</a>						

						<div id="board-content-area">
							<?=$article['bd_content']?>
						</div>
						
						
						<?if($article['links'][0]['bl_url']):?>
						<a href="http://<?=$article['links'][0]['bl_url']?>" target="_blank" class="button button-big button-border2 button-rounded2" style="float:right;"><span>관련이벤트 바로가기</span></a>
						<?endif;?>
						</div>
						
					</section>

				</div>			
			</section>			
		</div>		
	</div>
	<!-- 건강 포스트 이전글, 다음글 기능 -->
	<div class="post_title" id="post_title2" style="height:140px;">
		<div class="prv_post_title" style="padding: 10px; border-bottom: 1px solid #cdcdcd;">
			<i class="fa fa-angle-up" style="font-weight:bold;"></i>
			<a href="<?=$menu_url?>?act=view&amp;seq=100">
			<span style="font-weight:bold;">이전글</span> $menu_url,act=view&amp;seq=100
			</a>
		</div>
		<div class="next_post_title" style="padding: 10px; border-bottom: 1px solid #cdcdcd;">
			<i class="fa fa-angle-down" style="font-weight:bold;"></i>
			<a href="<?=$menu_url?>?act=view&amp;seq=95">
			<span style="font-weight:bold;">다음글</span> $menu_url,act=view&amp;seq=95
			</a>
		</div>
		<div class="btn-area-center">
			<a href="<?=$menu_url?>" id="" class="btn btn-default" style="background:#393f4b; width:25%; padding: 8px;">목록</a>
		</div>
		
	</div>
	
</section>



<div class="cd-popup popnum1" role="alert">
	<div class="cd-popup-container">
		<p>SNS 공유하기</p>
		<div class="sns_icon_pop">
		<a href="http://www.facebook.com/sharer/sharer.php?u=<?=$full_url?>" target="_blank">
			<img src="/resource/images/medical/icons/face-icon.png" style="margin-right:10px; width:60px;">
			<h5 style="margin-right:10px; font-weight: normal;font-size:10px;">페이스북</h5>
		</a>
		</div>
		<div class="sns_icon_pop">
		<a href="https://twitter.com/intent/tweet?text=<?=$twitter_text?>&url=<?=$full_url?>" target="_blank">
			<img src="/resource/images/medical/icons/twi-icon.png" style="margin-right:10px; width:60px;">
			<h5 style="margin-right:10px; font-weight: normal; font-size:10px;">트위터</h5>
		</a>
		</div>
		<div class="sns_icon_pop">
		<a href="https://story.kakao.com/share?url=<?=$full_url?>" target="_blank">
			<img src="/resource/images/medical/icons/cas-icon.png" style="margin-right:10px; width:60px;">
			<h5 style="margin-right:10px; font-weight: normal; font-size:10px;">카카오스토리</h5>
		</a>
		</div>
		<div class="sns_icon_pop">
		<a id="kakao-link-btn" href="#" onclick="return false;">
			<img src="/resource/images/medical/icons/kakao-icon.png" style=" width:60px;"/>
			<h5 style="margin-right:10px; font-weight: normal; font-size:10px;">카카오톡</h5>
		</a>
		</div>
		
		<a href="#0" class="cd-popup-close img-replace">Close</a>

	</div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->

<script type="text/javascript" src="/resource/js/popup_require_jq.js"></script>

<script>
	$(document).ready(function(){
		$('#board-content-area img').attr('style','');		
		$('#board-content-area img').eq(0).attr('style','width:50%;');		
	});
</script>


<!-- 카카오톡 공유하기 -->
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type='text/javascript'>
//<![CDATA[
	Kakao.init('df28779445828d8bf6d9df65ac094735');

	Kakao.Link.createTalkLinkButton({
		container: '#kakao-link-btn',
		label: 'OK검진 건강정보.',
		<?if($thumnail):?>
		image: {
			src: "https://okaymedi.com/<?=$thumnail?>",
			width: '<?=$image_w?>',
			height: '<?=$image_h?>'
		},
		<?endif;?>

		webButton: {
			text: "<?=$article['bd_subject']?>",
			url: '<?=$kakao_full_url?>'
		}
	});
//]]>



function setHtml(bd_seq){	
	var a = $('<a/>').attr('href', '<?=$menu_url?>?act=view&seq='+bd_seq);
	
	// $(".prv_post_title").append(a);
	$(".prv_post_title").appendTo(a);
}


</script>
<div id="event-view">
	<!-- container -->
	<section class="container">
		<!-- first row -->
		<div class="row">

			<!--Item Detail Content-->
			<div class="col-md-9 bg-white" style="border:1px solid #cdcdcd;">
				<!-- section -->
				<section class="block" id="main-content">
					<!-- second row -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<section>

								<!-- /.item-gallery list -->
								<article class="block" style="position:relative; padding:20px 0;">
									<header >
										<font color="#454545" size="5"><b><?=$view['hi_open_name']?></b></font>
									</header>


									<a href="#" class="button button-small button-border2 button-rounded2 modal-trigger" data-name='hosinfo' data-seq="<?=$view['ai_seq']?>" style="position:absolute; top:19px; right:0px;"><span>병원정보</span></a>


									<figure>
										<i class="fa fa-map-marker" style="color:red"></i><font color="#878787"><?=$view['ai_addr']?></font>
									</figure>
								</article>									
								<!-- END :: /.item-gallery list-->

								<hr/>


								<!-- /. detail block -->
								<article class="block">
									<header>
										<h1><?=$view['ei_name']?></h1>
										<font color="#45ae30" size="6px">
											<span class="suga">
												<?if($is_closed):?>
												제휴 할인
												<?else:?>
												이벤트 수가
												<?endif;?>
											</span>&nbsp;
											<b>												
												<?if($is_closed && $view['ei_closed_discount'] > 0):?>
												<span class="not-price"><?=number_format($view['ei_account'])?> 원</span> 
												<?=number_format($view['ei_account']-($view['ei_account']*( $view['ei_closed_discount']) /100) )?> 원
												<?else:?>
												<span class="not-price"><?=number_format($view['ei_original_account'])?> 원</span> 
												<?=number_format($view['ei_account'])?> 원
												<?endif;?>
											</b>
										</font>
										<font color="gray" size="4px">~<?=date('Y년 m월 d일', $view['ei_end'])?> 까지</font>
									</header>
								 </article>

								<!-- END :: /. detail block -->

								<hr/>

								<a href="<?=$contents_url?>/my_check/checkIn?seq=<?=$view['ei_seq']?>" class="snip1160 red" style="position:absolute; top:90px; right:25px;" target="formReceiver">
									<?if(in_array($view['ei_seq'], $like_list)):?>
									<i class="fa fa-heart" style="color:red;"></i>
									<?else:?>
									<i class="fa fa-heart-o" style="color:red;"></i>
									<?endif;?>
								</a>

								<a href="#" class="snip1160 red cd-popup-trigger" data-popnum="1" style="position:absolute; top:90px; right:-25px;"><i class="fa fa-share-alt" style="color:#656565"></i></a>

								<?if($view['top'] != ''):?>
								<p>
									<img src="<?=$view['top']?>" alt="<?=$view['ei_name']?>">							
								</p>
								<?endif;?>

								<?if($view['middle'] != ''):?>
								<p>
									<img src="<?=$view['middle']?>" alt="<?=$view['ei_name']?>">							
								</p>
								<?endif;?>

								<?if($view['bottom'] != ''):?>
								<p>
									<img src="<?=$view['bottom']?>" alt="<?=$view['ei_name']?>">							
								</p>
								<?endif;?>

								<img src="/resource/images/medical/event_add_image.jpg" alt="복잡하고 비싼 검강검진 NO!" />
								
								
							</section>							
						</div>						
					</div>
					<!-- END :: second row -->
				</section>
				<!-- END :: section -->
			</div>
			<!-- END :: Item Detail Content-->


			<!--Sidebar : right pop menu-->
			<div class="col-md-3">
				<!-- aside -->
				<aside id="sidebar" class="bg-white" style="position:fixed; width:248px; border:1px solid #cdcdcd; padding:15px;">

					<!-- section :: Contact Form-->
					<section>
						<figure>
							<form id="item-detail-form" role="form" method="post" action="<?=$menu_url?>/reserve" target="formReceiver">								
								<input type="hidden" name="ei_seq" value="<?=$view['ei_seq']?>" />		
								<div style="margin-bottom:10px;">
									<img src="/resource/images/medical/subpage/reserve_01.png" alt="상담 신청" />
								</div>
								<div class="form-group">
									<label for="item-detail-name">이름</label>
									<input type="text" class="form-control framed" id="item-detail-name" value ="<?=$user['name']?>" name="er_name" required="required">
								</div>
								
								<div class="form-group">
									<label for="item-detail-email">휴대폰번호</label>
									<input type="text" class="form-control framed" id="item-detail-email" value ="<?=$user['phone']?>"  name="er_phone" required="required" placeholder="숫자만 입력해주세요.">
								</div>

								<label for="item-detail-email">연락받을 시간</label>

								<div class="form-group">
									<select class="framed" name="er_time">
										<?foreach($reserve_times as $k => $v):?>
										<option value="<?=$k?>"><?=$v['sub_name']?></option>
										<?endforeach;?>										
									</select>
								</div>

								<ul class="list-unstyled checkboxes">
									<li>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="accept_one" value="Y" style="margin-left:0px;">&nbsp;<a href="/index.php/medical/contents/etc_personal?win=Y" onclick="window.open(this.href,'accept','height=810px; width=810px;'); return false;" target="_blank" title="새창" >개인정보취급방침 동의(필수)</a>
											</label>
										</div>
									</li>                                  									
								</ul>

								<div class="form-group">
									<button type="submit" class="btn framed icon" onclick="_gaq.push(['_trackEvent','신청','상담신청']);">상담 신청하기<i class="fa fa-angle-right" style="color:#e8a5a5"></i></button>
								</div>
							</form>				
						</figure>			
					</section>
					<!-- END :: section :: Contact Form-->
					
					
				</aside>
				<!-- END :: aside -->

				<!-- aside : phone call -->
<!-- 				<aside id="sidebar" class="bg-white" style="position:fixed; width:248px; border:1px solid #cdcdcd; padding:15px; margin-top:417px;"> -->
<!-- 					<section> -->
<!-- 						<figure> -->
<!-- 							<label for="item-detail-email">직접 전화 하기</label> -->
<!--  -->
<!-- 							<div class="form-group"> -->
<!-- 								<button type="submit" class="btn framed icon"><i class="fa fa-phone fa-2x" style="color:#00cc6a; display:inline-block; margin-left:0;"></i>&nbsp;<font size=5>050-6623-4482</font></button> -->
<!-- 							</div> -->
<!-- 						</figure> -->
<!-- 					</section>					 -->
<!-- 				</aside> -->
				<!-- END :: aside : phone call -->
				
			</div>
			<!-- END :: Sidebar : right pop menu-->
			
			
		</div>
		<!-- END :: first row -->
	</section>
	<!-- END :: container -->

	
</div>

<div class="cd-popup popnum1" role="alert">
	<div class="cd-popup-container">
		<p>SNS 공유하기</p>
		
		<a href="http://www.facebook.com/sharer/sharer.php?u=<?=$full_url?>" target="_blank">
			<img src="/resource/images/medical/icons/snsicon_f.png" style="padding-bottom:30px;">
		</a>

		<a href="https://twitter.com/intent/tweet?text=<?=$twitter_text?>&url=<?=$full_url?>" target="_blank">
			<img src="/resource/images/medical/icons/snsicon_t.png" style="padding-bottom:30px;">
		</a>

		<a href="https://story.kakao.com/share?url=<?=$full_url?>" target="_blank">
			<img src="/resource/images/medical/icons/snsicon_k.png" style="padding-bottom:30px;">
		</a>
		<a href="#0" class="cd-popup-close img-replace">Close</a>
	</div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->



<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCWkP87YE94jxFb3nSPHSTzSb9VsijOFTg&sensor=false&amp;libraries=places"></script>
<script type="text/javascript">

	$(document).ready(function(){
					

		$('.modal-trigger').on('click', function(e){
			e.preventDefault();		
			
			$('<div/>').addClass('modal-window multichoice fade_in').appendTo('body');
			$('<div/>').addClass('modal-background fade_in').appendTo('.modal-window');
			$('<div/>').addClass('modal-wrapper').appendTo('.modal-window');
			$('<div/>').addClass('modal-body').appendTo('.modal-wrapper');
			$('<div/>').addClass('modal-close').appendTo('.modal-body');
			$('<img src="/resource/assets/img/close.png" />').appendTo('.modal-close');
			$('<div/>').addClass('modal-content').appendTo('.modal-body');
			
			var html_name = $(this).data('name');
			var ai_seq = $(this).data('seq');
			modalFrame(html_name, ai_seq);			
		});

	});

	function modalFrame(html_name, ai_seq){		
		
		$('.modal-content').load( '/index.php/medical/html?id='+html_name+'&seq='+ai_seq, function() {
			var rtl = false; // Use RTL
	        initializeOwl(rtl);
			drawOwlCarousel(rtl);

			 rating('.modal-content');
        });

		$('.modal-window .modal-background, .modal-close').live('click',  function(e){
            $('.modal-window').addClass('fade_out');
            setTimeout(function() {
                $('.modal-window').remove();
            }, 300);
        });
	}


	function reloadModalFrame(ai_seq){
	

		$('.modal-content').load( '/index.php/medical/html?id=hosinfo&seq='+ai_seq, function() {
			var rtl = false; // Use RTL
			initializeOwl(rtl);
			drawOwlCarousel(rtl);
			 rating('.modal-content');

			$('#tab-1').removeClass('active');
			$('#tab-2').addClass('active');
			$('#tab_default_1').css('display', 'none');
			$('#tab_default_2').css('display', 'block');
		});

	}




var map = false;
function createSimpleMap(new_lat, new_lng, el_id) {
	var uluru = {lat: new_lat, lng: new_lng};
	 map = new google.maps.Map(document.getElementById(el_id), {
	  zoom: 18,
	  center: uluru
	});

	var marker = new google.maps.Marker({
	  position: uluru,
	  map: map
	});
}
</script>



<script>
fbq('track', 'ViewContent', {content_type : 'event detail', content_name: "<?=$view['ei_name']?>", content_category:'pc : event detail'});

fbq('track', 'Lead', {
	content_type: 'event detail',
	content_category: 'pc : event detail',
});	
</script>
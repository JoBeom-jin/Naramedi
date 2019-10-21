

<div id="event-view" style="margin:0px;">
	<section>
		<div>
			<!-- 이벤트 클릭후 그에맞는 썸네일, 내용이미지 DB -->
			<img src="<?=$view['ei_img_top']?>" alt="" style="width:100%;">
			<!-- <? print_r($view);?> -->
		</div>
	</section>
	<!-- container -->
	<section class="container container3" style="width:100%; margin-bottom: 0px; padding-bottom: 0px;">		
		<!-- first row -->
		<div class="row" style="margin:0px;">

			<!--Item Detail Content-->
			<div class="col-md-9 bg-white" style="padding:0px;">
				<!-- section -->
				<section class="block" id="main-content">
					<!-- second row -->
					<div class="row" style="margin-bottom:0px;">
						<div class="col-md-12 col-sm-12" style="padding: 0px; background:#fff;">
							<section>

								<!-- /.item-gallery list -->
								<article class="block" style="position:relative;padding: 5px 20px;">
									<!-- <div class="btn-right-area">										
										<a href="#" class="button button-small button-border2 button-rounded2 modal-trigger" data-name='hosinfo' data-seq="<?=$view['ai_seq']?>">
											<span>병원정보</span>
										</a>
										<a href="<?=$contents_url?>/my_check/checkIn?seq=<?=$view['ei_seq']?>" class="snip1160 red" target="formReceiver">
											<?if(in_array($view['ei_seq'], $like_list)):?>
											<i class="fa fa-heart" style="color:white;"></i>
											<?else:?>
											<i class="fa fa-heart-o" style="color:white;"></i>
											<?endif;?>
										</a>

										<a href="#" class="snip1160 red cd-popup-trigger" data-popnum="1"><i class="fa fa-share-alt" style="color:#fff;"></i></a>																			
									</div> -->

									<header>
										<font color="#454545" size="5"><b><?=$view['hi_open_name']?></b></font>
									</header>							


									<figure>
										<i class="fa fa-map-marker" style="color:#1e67c6;"></i>
										<font color="#878787" style="font-size:12px;"><?=$view['ai_addr']?></font>
										<a href="#" class="modal-trigger" data-name='hosinfo' data-seq="<?=$view['ai_seq']?>">
											<i class="fa fa-angle-right" style="float:right;line-height: 1px; font-size: xx-large; color:#b8b9bb;"></i>
										</a>
									</figure>
								</article>									
								<!-- END :: /.item-gallery list-->

								<hr/>


								<!-- /. detail block -->
								<article class="block event-info" style="padding:5px 20px;">
									<header>
										<h5><?=$view['ei_name']?></h5>
										<div class="event-duration">~<?=date('Y년 m월 d일', $view['ei_end'])?> 까지</div>
										<div class="price">
											<span class="suga">
												<?if($is_closed):?>
												제휴할인
												<?else:?>
												이벤트 수가
												<?endif;?>
											</span><br/>
											<b>			
												<?if($is_closed && $view['ei_closed_discount'] > 0):?>
												<span class="not-price"><?=number_format($view['ei_original_account'])?>원</span> 
												<?=number_format($view['ei_account']-($view['ei_account']*( $view['ei_closed_discount']) /100) )?> 
												<?else:?>
												<span class="not-price"><?=number_format($view['ei_original_account'])?>원</span>
												<?=number_format($view['ei_account'])?>원
												<?endif;?>
											</b>
										</div>	
										<div class="btn-right-area">										
										<a href="<?=$contents_url?>/my_check/checkIn?seq=<?=$view['ei_seq']?>" class="snip1160 red" target="formReceiver">
											<?if(in_array($view['ei_seq'], $like_list)):?>
											<i class="fa fa-heart" style="color:white; "></i>
											<?else:?>
											<i class="fa fa-heart-o" style="color:white; "></i>
											<?endif;?>
										</a>
										<a href="#" class="snip1160 blue cd-popup-trigger" data-popnum="1" style="background: #083682 !important; line-height: 0px; font-size: 27px;">
										<!-- <i class="fa fa-share-alt" style="color:#fff; "></i> -->
										<img src="/resource/images/mobile/share_icon.png" alt="share_icon">
										</a>																			
										</div> 																					
										

									</header>
								 </article>

								<!-- END :: /. detail block -->

								<img src="/upload/event_image/test-sumnail2.png" alt="" style="width:100%;">


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
								<div id="rsv-btn-normal">
									<div class="btn-area" style="display: inline-flex;">
									<img src="/upload/event_image/talk-icon.png" alt="" style="margin-right:10px;">
										<a href="#" class="cd-popup-trigger" data-popnum="<?=$view['ai_seq']?>">상담신청하기</a>
									</div>
								</div>	
								
							</section>							
						</div>						
					</div>
					<!-- END :: second row -->
				</section>
				<!-- END :: section -->
			</div>
			<!-- END :: Item Detail Content-->			
			
		</div>
		<!-- END :: first row -->				
	</section>
	<!-- END :: container -->
	<div id="rsv-btn">
		<div class="btn-area scroll"  style="display: inline-flex;">
			<img src="/upload/event_image/talk-icon.png" alt="" style="margin-right:10px;">
			<a href="#" class="cd-popup-trigger" data-popnum="<?=$view['ai_seq']?>">
			상담신청하기
			</a>
		</div>
	</div>

	
</div>

<div  id="event-reserve-form" class="cd-popup popnum<?=$view['ai_seq']?>" role="alert">
	<div class="cd-popup-container">
		<!-- section :: Contact Form-->
		<section>
			<figure>
				<form id="item-detail-form" role="form" method="post" action="<?=$menu_url?>/reserve" target="formReceiver">								
					<input type="hidden" name="ei_seq" value="<?=$view['ei_seq']?>" />	
					<div class="consulting_title" style="font-size:18px;">
								상담신청하기
							</div>	
									<table class="form-group consulting_group">
                                            <colgroup>
                                                <col width="35%" />
                                                <col width="64%" />
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <td><label for="item-detail-name">상담유형<sup style="color: red;">*</sup></label></td>
                                                    <td>
													<!-- 상담유형에 카톡&전화 기능 -->
														<div style="font-size:12px;">
															<input type="radio" class="inputs form-control framed" id="item-detail-talk" value ="<?=$user['talk']?>" name="er_talk" required="required">카톡상담 &nbsp;&nbsp;
															<input type="radio" class="inputs form-control framed" id="item-detail-talk" value ="<?=$user['talk']?>" name="er_talk" required="required">전화상담
														</div>
                                                    </td>
												</tr>
												
                                                <tr>
                                                    <td><label for="item-detail-name">이름<sup style="color: red;">*</sup></label></td>
                                                    <td>
														<input type="text" class="inputs form-control framed framed99" id="item-detail-name" value ="<?=$user['name']?>" name="er_name" required="required">
                                                    </td>
												</tr>
												
                                                <tr>
                                                    <td><label for="item-detail-email">핸드폰번호<sup style="color: red;">*</sup></label></td>
													<td>
														<input type="number" class="inputs form-control framed framed99" id="item-detail-email" value ="<?=$user['phone']?>"  name="er_phone" required="required" >
													</td>
                                                </tr>
                                                <tr>
                                                    <td><label for="item-detail-time">상담시간<sup style="color: red;">*</sup></label></td>
													<td style="position: relative;"><select class="inputs framed framed99" name="er_time" id="item-detail-time" >
															<?foreach($reserve_times as $k => $v):?>
															<option value="<?=$k?>" ><?=$v['sub_name']?></option>
															<?endforeach;?>	
														</select>
														<i class="fa fa-angle-down" style="position: absolute; top: 30px; right: 30%;"></i>
													</td>
                                                </tr>
                                               
                                                <tr>
                                                    <td><label for="item-detail-memo">문의<sup style="color: red;">*</sup></label></td>
                                                    <td>
														<input type="text" class="inputs form-control framed framed99" id="item-detail-memo" value ="" name="er_memo" >
													</td>
                                                </tr>

											</tbody>

										</table>	
										
										<ul class="list-unstyled checkboxes">
												<li>
													<div class="checkbox">
														<label>
															<input type="checkbox" name="accept_one" value="Y" style="margin-left:0px;">&nbsp;개인정보취급방침동의
															<a href="/index.php/medical/contents/etc_personal?win=Y" onclick="window.open(this.href,'accept','height=810px; width=810px;'); return false;" target="_blank" title="새창" ><span style="color:#0051d6;">&nbsp;[자세히보기]</span></a>
														</label>
													</div>
												</li>                                  									
											</ul>
											
							<div class="submit-btn-area form-group" >
								<button type="submit" class="btn framed3 icon" style="box-shadow:none;">
									<img src="/resource/images/mobile/cd-popup-icon.png" alt="상담신청버튼" style="width:33vw;">
								</button>
							</div>
					<!-- 원래 코드  
						<div class="form-scroll">
						<div class="scroll">
							<div class="consulting_title">
								상담신청하기
							</div>	
							<div class="form-group" style="margin-top: 20px; color: #9e9e9e; font-weight: bold;">
								<label for="item-detail-name">상담유형<sup style="color: red;">*</sup></label>
								<div style="margin-right:40px; font-size:12px;">
									<input type="radio" class="inputs form-control framed" id="item-detail-talk" value ="<?=$user['talk']?>" name="er_talk" required="required">카톡상담
									<input type="radio" class="inputs form-control framed" id="item-detail-talk" value ="<?=$user['talk']?>" name="er_talk" required="required">전화상담
								</div>
							</div>
							<div class="form-group">
								<label for="item-detail-name">이름<sup style="color: red;">*</sup></label>
								<input type="text" class="inputs form-control framed framed99" id="item-detail-name" value ="<?=$user['name']?>" name="er_name" required="required">
							</div>
							<div class="form-group">
								<label for="item-detail-email">핸드폰번호<sup style="color: red;">*</sup></label>
								<input type="number" class="inputs form-control framed framed99" id="item-detail-email" value ="<?=$user['phone']?>"  name="er_phone" required="required" >
							</div>						
							<div class="form-group">
								<label for="item-detail-time">상담시간<sup style="color: red;">*</sup></label>
								<select class="inputs framed framed99" name="er_time" id="item-detail-time">
									<?foreach($reserve_times as $k => $v):?>
									<option value="<?=$k?>"><?=$v['sub_name']?></option>
									<?endforeach;?>										
								</select>
							</div>
							<div class="form-group" style="margin-bottom: 10px;">
								<label for="item-detail-memo">문의<sup style="color: red;">*</sup></label>
								<input type="text" class="inputs form-control framed framed99" id="item-detail-memo" value ="" name="er_memo" >
							</div>
							<ul class="list-unstyled checkboxes">
								<li>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="accept_one" value="Y" style="margin-left:0px;">&nbsp;개인정보취급방침동의
											<a href="/index.php/medical/contents/etc_personal?win=Y" onclick="window.open(this.href,'accept','height=810px; width=810px;'); return false;" target="_blank" title="새창" ><span style="color:#0051d6;">&nbsp;[자세히보기]</span></a>
										</label>
									</div>
								</li>                                  									
							</ul>

							<div class="submit-btn-area form-group" style="padding:0px 10px 50px;">
								<button type="submit" class="btn framed3 icon" style="box-shadow:none;">
									<img src="/resource/images/mobile/cd-popup-icon.png" alt="상담신청버튼" style="width:33vw;">
								</button>
							</div>
						</div>
					</div> -->
				</form>				
			</figure>			
		</section>
		<!-- END :: section :: Contact Form-->
		<a href="#0" class="cd-popup-close img-replace">Close</a>
	</div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->


<div class="cd-popup popnum1" role="alert">
	<div class="cd-popup-container" style="padding-left:0px; padding-right:0px; text-align:center;">
		<p>SNS 공유하기</p>
		<div class="sns_icon_pop">
		<a href="http://www.facebook.com/sharer/sharer.php?u=<?=$full_url?>" target="_blank">
			<img src="/resource/images/medical/icons/face-icon.png" class="sns_img_pop">
		</a>
		<h5 class="sns_title_pop">페이스북</h5>
		</div>
		<div class="sns_icon_pop">
		<a href="https://twitter.com/intent/tweet?text=<?=$twitter_text?>&url=<?=$full_url?>" target="_blank">
			<img src="/resource/images/medical/icons/twi-icon.png" class="sns_img_pop">
			<h5 class="sns_title_pop">트위터</h5>
		</a>
		</div>
		<div class="sns_icon_pop">
		<a href="https://story.kakao.com/share?url=<?=$full_url?>" target="_blank">
			<img src="/resource/images/medical/icons/cas-icon.png"  class="sns_img_pop">
			<h5 class="sns_title_pop">카카오스토리</h5>
		</a>
		</div>
		<div class="sns_icon_pop">
		<a id="kakao-link-btn" href="#" onclick="return false;">
			<img src="/resource/images/medical/icons/kakao-icon.png" class="sns_img_pop">
			<h5 class="sns_title_pop">카카오톡</h5>
		</a>
		</div>




		<a href="#0" class="cd-popup-close img-replace">Close</a>
	</div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->



<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCWkP87YE94jxFb3nSPHSTzSb9VsijOFTg&sensor=false&amp;libraries=places"></script>
<script type="text/javascript">
/*
* 팝업시 윈도우 스크롤 정지
*/
function stopScroll(){
	$('html, body').css({'overflow': 'hidden', 'height': '100%'});		
}

function resumeScroll(){
	$('html, body').css({'overflow': 'auto', 'height': '100%'});		
}

function setForm(){
	$('.form-scroll').animate({scrollTop : 100}, 400);
}

	$(document).ready(function(){
		var its_first = true;
		$('.cd-popup-trigger').on('click', function(e){
			stopScroll();
		});
		$('.cd-popup-close').on('click', function(e){
			resumeScroll();
			$('.form-scroll').animate({scrollTop : 0}, 400);
			its_first = true;
		});
		
		$('#event-reserve-form .form-scroll input, #event-reserve-form .form-scroll select').on('focus', function(e){
			if(its_first){
				setForm();				
			}
			its_frist = false;
		});
					

		$('.modal-trigger').on('click', function(e){
			e.preventDefault();		
			
			$('<div/>').addClass('modal-window multichoice fade_in').appendTo('body');
			$('<div/>').addClass('modal-background fade_in').appendTo('.modal-window');
			$('<div/>').addClass('modal-wrapper').appendTo('.modal-window');
			$('<div/>').addClass('modal-body').appendTo('.modal-wrapper');
			$('<div/>').addClass('modal-close').appendTo('.modal-body');
			$('<img src="/resource/assets/img/close.png" />').appendTo('.modal-close');
			$('<div/>').addClass('modal-content').attr('id','hospital-info-modal').appendTo('.modal-body');
			
			var html_name = $(this).data('name');
			var ai_seq = $(this).data('seq');
			modalFrame(html_name, ai_seq);			
		});

	});

	function modalFrame(html_name, ai_seq){	
		console.log('/m/index.php/mobile/html?id='+html_name+'&seq='+ai_seq);
		
		$('.modal-content').load( '/m/index.php/mobile/html?id='+html_name+'&seq='+ai_seq, function() {
			var rtl = false; // Use RTL
	        initializeOwl(rtl);
			drawOwlCarousel(rtl);

			 rating('.modal-content');
        });

		$('.modal-window .modal-background, .modal-close').on('click',  function(e){
            $('.modal-window').addClass('fade_out');
            setTimeout(function() {
                $('.modal-window').remove();
            }, 300);
        });
	}


	function reloadModalFrame(ai_seq){
	

		$('.modal-content').load( '/m/index.php/mobile/html?id=hosinfo&seq='+ai_seq, function() {
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
	$('html, body').css({'overflow': 'hidden', 'height': '100%'}); // 모달팝업 중 html,body의 scroll을 hidden시킴 
	$('#element').on('scroll touchmove mousewheel', function(event) { // 터치무브와 마우스휠 스크롤 방지     
	event.preventDefault();    
	event.stopPropagation(); 
	return false; });

	$('html, body').css({'overflow': 'auto', 'height': '100%'}); //scroll hidden 해제 
	$('#element').off('scroll touchmove mousewheel'); // 터치무브 및 마우스휠 스크롤 가능

    $(function () {
                 
        $(window).scroll(function () {
            if ($(this).scrollTop() == 100%) { // 스크롤 내릴 표시
                $('.scroll').css({
					'display':'none'
				})
            } 
        })
                
    })

// $("body").unbind('touchmove'); //스크롤 방지 해제

// $("body").bind('touchmove', function(e){e.preventDefault()}); //스크롤방지

fbq('track', 'ViewContent', {content_type : 'event detail', content_name: "<?=$view['ei_name']?>", content_category:'pc : event detail'});

fbq('track', 'Lead', {
	content_type: 'event detail',
	content_category: 'pc : event detail',
});	
</script>

<script>
$(document).scroll(function() {
	checkOffset();
	
});
function checkOffset() {
    if($('#rsv-btn').offset().top + $('#rsv-btn').height() 
                                           >= $('footer').offset().top - 10){
	        $('#rsv-btn').hide();
			$('#rsv-btn-normal').show();
	}
    if($(document).scrollTop() + window.innerHeight < $('footer').offset().top){
        $('#rsv-btn').show(); // restore when you scroll up
		$('#rsv-btn-normal').hide();
	}
}
</script>


<!-- 카카오톡 공유하기 -->
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type='text/javascript'>
//<![CDATA[
	Kakao.init('df28779445828d8bf6d9df65ac094735');

	Kakao.Link.createTalkLinkButton({
		container: '#kakao-link-btn',
		label: 'OK검진 이벤트 소개.',
		image: {
			src: "https://okaymedi.com/<?=$view['ei_img_banner']?>",
			width: '365',
			height: '160'
		},

		webButton: {
			text: "<?=$view['ei_name']?>",
			url: '<?=$full_url?>'
		}
	});
//]]>
</script>
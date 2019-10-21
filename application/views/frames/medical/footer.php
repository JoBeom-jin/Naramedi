				</div>
				<!-- END :: page Content -->
			 <!-- 
			</div> -->
		<!-- END :: Page Canvas-->
<div id="hidden-space" style="text-align: right;height: 50px; width: 100%; padding: 0 400px; margin: 0 auto; color: white; background-color: white;">
	<!-- <span class="right"><a href="#page-top" class="to-top roll"><i class="fa fa-angle-up"></i></a></span> -->
</div>
<style>
	.pad2{
		padding: 2px;
	}
	#chat{
		background-image: url('/resource/images/medical/sidebar/side_chat.png');
		width: 124px;
		height: 104px;
		transition: 500ms;
	}
	#find{
		background-image: url('/resource/images/medical/sidebar/side_find.png');
		width: 124px;
		height: 105px; 
		transition: 500ms;
	}
	#call{
		background-image: url('/resource/images/medical/sidebar/side_call.png');
		width: 124px;
		height: 117px;
		transition: 500ms;
	}

	#chat:hover{
		background-image: url('/resource/images/medical/sidebar/side_chat_o.png');
		transition: 500ms;
	}
	#find:hover{
		background-image: url('/resource/images/medical/sidebar/side_find_o.png');
		transition: 500ms;
	}
	#call:hover{
		background-image: url('/resource/images/medical/sidebar/side_call_o.png');
		transition: 500ms;
	}

</style>
<div id="toTop" style="position: absolute; top: 240px; left: 1550px;">
	<ul>
		<li class="pad2">
			<a href="https://pf.kakao.com/_xdKzWd" target="_blank">
				<!-- <img src="/resource/images/medical/sidebar/side_chat.png" alt="카톡상담"> -->
				<div id="chat"></div>
			</a>
		</li>
		<li class="pad2">
			<a href="/index.php/medical/contents/search_hospital">
				<!-- <img src="/resource/images/medical/sidebar/side_find.png" alt="검진기관찾기"> -->
				<div id="find"></div>
			</a>
		</li>
		<li class="pad2">
			<a href="tel:15889419">
				<!-- <img src="/resource/images/medical/sidebar/side_call.png" alt="전화"> -->
				<div id="call"></div>
			</a>
		</li>
		<li class="pad2">
			<a href="javascript:void(0)">
				<!-- <img src="/resource/images/medical/sidebar/side_top.png" id="topButton" alt="top"> -->
				<div id="topButton" style="width: 124px; height: 25px; background-image: url(/resource/images/medical/sidebar/side_top.png)"></div>
			</a>
		</li>
	</ul>
</div>
<!--Page Footer-->
<footer id="page-footer">
	<div class="contact" style="">
		<div class="contact-bar">
			<div class="col-md-2 snslayoutText">
				<a href="<?=$contents_url?>/etc_intro">
					<div class="bar-info">오케이검진 소개</div>
				</a>
			</div>
			<div class="col-md-2 snslayoutText">
				<a href="<?=$contents_url?>/etc_guide">
					<div class="bar-info">제휴문의</div>
				</a>
			</div>
			<div class="col-md-2 snslayoutText">
				<a href="<?=$contents_url?>/etc_terms">
					<div class="bar-info">이용약관</div>
				</a>
			</div>
			<div class="col-md-2 snslayoutText">
				<a href="<?=$contents_url?>/etc_personal">
					<div class="bar-info">개인정보취급방침</div>
				</a>
			</div>
		</div>
	</div>
	<div class="inner">
		<!--/.footer-top-->
		<div class="footer-bottom">
			<div class="container" style="padding:30px 200px; background:url(/resource/images/medical/common/logo_gray.png) no-repeat; background-position:18px 50px">
				<span class="left">
					서울시 서초구 강남대로 97길 32, 4층<br>
					주식회사 인피니티케어 | 사업자등록번호 114-87-15991 | 대표자 강한승 | TEL 02-596-0721<br>
					COPYRIGHT©2018 INFINITYCARE, ALL RIGHTS RESERVED.
				</span>
								<!-- <span class="left">
									<a href="<?=$contents_url?>/etc_intro">OK검진소개</a>
									| 
									<a href="<?=$contents_url?>/etc_guide">제휴문의</a>
									| 
									<a href="<?=$contents_url?>/etc_gcenter">고객센터</a>
									| 
									<a href="<?=$contents_url?>/etc_terms">이용약관</a>
									| 
									<a href="<?=$contents_url?>/etc_personal">개인정보취급방침</a>
									© 2017 INFINITYCARE, All Rights Reserved.
								</span> -->
								<!-- <span class="right"><a href="#page-top" class="to-top roll"><i class="fa fa-angle-up"></i></a></span> -->
							</div>
						</div>
						<!--/.footer-bottom-->
					</div>
				</footer>
				<!--end Page Footer-->
			</div>
			<!-- END :: Inner Wrapper -->
		</div>		
		<!-- END :: Outer Wrapper-->
	<!-- <iframe id="formReceiver" name="formReceiver" title="프로그램용 - 내용없음"></iframe> -->


<script src="//ajax.googleapis.com/ajax/libs/webfont/1.4.10/webfont.js"></script>
<script type="text/javascript">
  WebFont.load({
 
    // For early access or custom font
    custom: {
        families: ['Nanum Gothic'],
        urls: ['https://fonts.googleapis.com/earlyaccess/nanumgothic.css']
    } 
  });
</script>
<script>
$(window).scroll(function(){
		var currentPosition = parseInt($("#toTop").css("top"));
		if ($(this).scrollTop() > 10) {
				// $('#toTop').fadeIn("slow");
				$('#toTop').animate({top:$(window).scrollTop()+240+"px" },{queue: false, duration: 500});
			}else{
        	// $('#toTop').fadeOut("slow");
        }
    });  

	$("#topButton").click(function() {
		$('html, body').animate({scrollTop : 0}, 400);
		return false;
	});
</script>
</body>
</html>
	<div id="myModal5" class="modal2">
		<div class="modal-content3">
			<div>
				<img src="/resource/images/mobile/arrow-icon.png" alt="arrow-icon"style="float:left; width: 20px; color: black; opacity: 1; margin-left: 15px;" class="close">  
				<h2 style=" margin: 20px 45px 20px 0px; text-align: center; color:#000000; font-weight:normal;"> 개인정보수정</h2>		
				
				<?if($_Auth->isLogin()):?>
				
				<form role="form" id="form-sign-in-account" method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">
							<div class="form-group2 form-group22">
								<div class="form-group3">
									<img src="/resource/images/mobile/join-us-icon.png" alt="ss">
								</div>
								<div class="form-group4">
									아이디
								</div>
								<div class="form-group7 col-xs-12" >
									<input type="email" class="form-control" id="form-sign-in-email" name="id_email" placeholder="이메일 주소를 입력해주세요." required>								
								</div>
							</div>
							<div class="form-group2 form-group22">
								<div class="form-group3" >
									<img src="/resource/images/mobile/join-us-icon.png" alt="ss">
								</div>
								<div class="form-group4">
									패스워드
								</div>
								<div class="form-group7 col-xs-12" >
								<input type="password" class="form-control" id="form-sign-in-password" name="password" placeholder="비밀번호를 입력해주세요." required>
								</div>
							</div>
							<div class="form-group2 form-group22">
								<div class="form-group3" >
									<img src="/resource/images/mobile/join-us-icon.png" alt="ss">
								</div>
								<div class="form-group4">
									패스워드 확인
								</div>
								<div class="form-group7 col-xs-12" >
									<input type="password" class="form-control" id="form-sign-in-email" name="password_chk" placeholder="비밀번호를 재입력해주세요." required>
								</div>
							</div>
							<div class="form-group2 form-group22">
								<div class="form-group3" >
									<img src="/resource/images/mobile/join-us-icon.png" alt="ss">
								</div>
								<div class="form-group4">
									이름
								</div>
								<div class="form-group7 col-xs-12" >
									<input type="text" class="form-control" id="form-sign-in-password" name="name" placeholder="성함을 입력해주세요." required>
								</div>
							</div>
							<div class="form-group2 form-group22">
								<div class="form-group3" >
									<img src="/resource/images/mobile/join-us-icon.png" alt="ss">
								</div>
								<div class="form-group4">
									연락처
								</div>
								<div class="form-group7 col-xs-12" >
									<input type="text" class="form-control" id="form-sign-in-email" name="phone" placeholder="휴대폰번호를 입력하세요.(-없이 입력)" required>
								</div>
							</div>
							<div class="form-group2 form-group22">
								<div class="form-group3" >
									<img src="/resource/images/mobile/join-us-icon.png" alt="ss">
								</div>
								<div class="form-group4">
									생년월일
								</div>
								<div class="form-group2 col-xs-12" style="width:66%;">
									<div class="row">
										<div class="col-xs-4" style="    padding-right: 0px;">
											<select name="year" title="생년" data-size="5" size="5" class="runway">
												<option value=""> 년도 </option>
												<?$years = range(date('Y'), 1900)?>
												<?foreach($years as $v):?>
												<option value="<?=$v?>"><?=$v?>년</option>
												<?endforeach;?>
											</select>
											<i class="fa fa-angle-down" style="position: absolute; right:7px; top: 18px;"></i>
										</div>
										<div class="col-xs-4" style="    padding-right: 0px;">
											<select name="month" title="월" data-height="100" data-size="5" size="5">
											<option value=""> 월 </option>
											<?$months = range(1, 12);?>
											<?foreach($months as $v):?>
											<option value="<?=$v?>"><?=$v?>월</option>
											<?endforeach;?>
											</select>
											<i class="fa fa-angle-down" style="position: absolute; right: 9px; top: 18px;"></i>
										</div>
										<div class="col-xs-4"style="    padding-right: 0px; " >
											<select name="day" title="일" data-size="5" size="5">
											<option value=""> 일 </option>
											<?$days = range(1, 31);?>
											<?foreach($days as $v):?>
											<option value="<?=$v?>"><?=$v?>일</option>
											<?endforeach;?>
											</select>
											<i class="fa fa-angle-down" style="position: absolute; right: 9px; top: 18px;"></i>
										</div>	
									</div>
								</div>
							</div>
							<div class="form-group2 form-group22">
								<div class="form-group3" >
									<img src="/resource/images/mobile/join-us-icon.png" alt="ss">
								</div>
								<div class="form-group4">
									성별선택 
								</div>
								<div class="form-group6 col-xs-12" style="width: 40%;" >
									<select class="framed" name="md_gender" title="성별선택">
										<option value=""> 성별선택 <span class="caret"></span></option>
										<option value="MAN"> 남성</option>
										<option value="WOMAN"> 여성</option>
									</select>	
									<i class="fa fa-angle-down" style="position: absolute; right: 25px; top: 18px;"></i>					
								</div>
							</div>
								<div class="form-group7 col-xs-12" style="width:100%; text-align:center; margin-top: 20px;">
									<button type="submit"  style="width:83px; margin-right:10px;" class="btn framed icon">확인</button>
									<button type="cancel"  style="width:83px" class="btn framed2 icon" >
									<a href="/m/index.php/mobile/contents/my_change">취소</a>
									</button>
									
								</div>
						</form>
				<?endif;?>	
			</div>
		</div>
	</div>
			<!--오리지널 내정보 변경 코드
				 <form role="form" id="form-sign-in-account" method="post" action="<?=$menu_url?>/changeOk" target="formReceiver">
					
					<input type="hidden" name="me_seq" value="<?=$member['me_seq']?>" />

					
					<div class="form-group2">
						<input type="text" class="form-control" id="form-sign-in-password" name="me_name" placeholder="이름을 입력하세요." value="<?=$member['me_name']?>" required="required">
					</div>
					<div class="form-group2">
						<input type="text" class="form-control" id="form-sign-in-email" name="md_phone" placeholder="휴대폰번호를 입력하세요.(-없이 입력)" value="<?=$detail['md_phone']?>" required="required">
					</div>
					<div class="form-group2">							
						<div style="width:30%; float:left; margin-right:3%;">
							<select name="year" title="생년 입력" data-size="5">
								<option value="">생년</option>
								<?$years = range(date('Y'), 1900)?>
								<?foreach($years as $v):?>
								<option value="<?=$v?>" <?if($detail['year'] == $v):?>selected="selected"<?endif;?>><?=$v?>년</option>
								<?endforeach;?>
							</select>
						</div>
						<div style="width:30%; float:left; margin-right:3%;">
							<select name="month" title="월 입력" data-size="5">
							<option value="">월</option>
							<?$months = range(1, 12);?>
							<?foreach($months as $v):?>
							<option value="<?=$v?>" <?if($detail['month'] == $v):?>selected="selected"<?endif;?>><?=$v?>월</option>
							<?endforeach;?>
							</select>
						</div>
						<div style="width:30%; float:left; margin-right:3%;">
							<select name="day" title="일 입력" data-size="5">
							<option value="">일</option>
							<?$days = range(1, 31);?>
							<?foreach($days as $v):?>
							<option value="<?=$v?>" <?if($detail['day'] == $v):?>selected="selected"<?endif;?>><?=$v?>일</option>
							<?endforeach;?>
							</select>
						</div>
						<br/>
					
						<select class="framed" name="md_gender">
							<option value="">성별선택</option>
							<option value="MAN" <?if($detail['md_gender'] == 'MAN'):?>selected="selected"<?endif;?>>
							남성
							</option>
							<option value="WOMAN" <?if($detail['md_gender'] == 'WOMAN'):?>selected="selected"<?endif;?>>
							여성
							</option>
						</select>
					</div>

					<div class="form-group2" style="color:red;">
						※ 비밀번호 변경시에만 입력해주세요.
					</div>

					<div class="form-group2">
						<input type="password" class="form-control" id="form-sign-in-password" name="me_pass" placeholder="비밀번호를 입력하세요.">
					</div>

					<div class="form-group2">
						<input type="password" class="form-control" id="form-sign-in-email" name="pass_chk" placeholder="비밀번호 재입력.">
					</div>

					<div class="form-group2">
						<button type="submit"  style="width: 100%;" class="btn framed icon">회원정보 변경<i class="fa fa-angle-right" style="color:#e8a5a5"></i></button>
					</div>
					<div>
						<p align=center><a href="#" title="새창" onclick=" window.open('/index.php/medical/contents/etc_joinout', 'join_out_form', 'width=810, height=700'); "><font color=blue>회원탈퇴</font><a>
					</div>

				</form>	 -->
<div id="edit-my-info">

<div>
	<img src="/resource/images/mobile/post/mypage.png" alt="mypage메인이미지" style="width:100%;">
</div>
	<!-- section container -->
	<section class="container3">
		<!-- row area -->		
		<header style="text-align:center;">
			<h1 class="page-title" style=" font-weight:normal; color:#474747;">홍길동</h1>
			<p>honghong@naver.com</p>
			<img src="/resource/images/mobile/post/myinfo.png" alt="내정보" style="width:100px;cursor: pointer; " id="edit5" >
			
		</header>
		<div class="info_menu">
			<ul>
				<li><a href="/m/index.php/mobile/contents/my_reserve"><img src="/resource/images/mobile/post/page-icon1.png" alt=""> 예약현황 <i class="fa fa-angle-right" style="float:right; font-size:24px;"></a></i></li>
				<li><a href="/m/index.php/mobile/contents/my_lastest"><img src="/resource/images/mobile/post/page-icon2.png" alt=""> 최근본상품 <i class="fa fa-angle-right" style="float:right; font-size:24px;"></a></i></li>
				<li><a href="/m/index.php/mobile/contents/my_checked"><img src="/resource/images/mobile/post/page-icon3.png" alt=""> 찜한이벤트 <i class="fa fa-angle-right" style="float:right; font-size:24px;"></a></i></li>
				<li><a href="/m/index.php/mobile/contents/my_reply"><img src="/resource/images/mobile/post/page-icon4.png" alt=""> 작성후기 <i class="fa fa-angle-right" style="float:right; font-size:24px;"></a></i></li>
			</ul>
		</div>
		<div style="text-align:center;background:#f1f1f1; height:130px;padding:10px;">
		<h2 style="font-family: 'Montserrat', sans-serif !important; font-size:20px; font-weight:normal; color:black;">1588-9419</h2>
		<p>평일 9:00 ~ 18:00 (점심시간 12:30 ~13:30)<br/>토/일/공휴일휴무</p>
		</div>
	</section>
</div>

<style>
	.form-group2{
		background:#f1f1f1;
	}
	.form-group3{
		margin-left:10px;
	}
	form .form-group7{
		width:60%;
	}
	.form-group22{
		border-bottom:1px solid #cdcdcd !important;
	}
	.row{
		margin-bottom:0px;
	}
	input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="number"], input[type="date"], .select-wrapper input.select-dropdown{border: 1px solid #e1e1e1; height:42px; -moz-box-shadow: none;
	padding:10px;
	margin:5px 0px;
	}
	form .form-group7{
		margin-bottom:0px;
	}
</style>

<script>
var modal5 = document.getElementById("myModal5");
var btn = document.getElementById("edit5");
var close = document.getElementsByClassName("close")[0];
var close2 = document.getElementsByClassName("close2")[0];

btn.onclick = function() {
  modal5.style.display = "block";
  modal5.style.position = "fixed";
  modal5.style.top = "0";
  modal5.style.left = "0";
}
close.onclick = function() {
  modal5.style.display = "none";
}
close2.onclick = function() {
  modal5.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal5 ) {
    modal5.style.display = "none";
  } else if(event.target == modal3){
	modal5.style.display = "none";
  }
}

</script>
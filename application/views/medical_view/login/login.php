<style>
	.login-form{
		width: 388px !important;
		height: 49px !important;
	}
	.login_text{
		color: #818181;
	}
	.login_text:clicked{
		color: #818181;
	}
	.sns_img{
		margin: 0 10px;
	}
</style>
<section class="hero-image" style="height: 617px !important;">
	<div class="background" style="background:url(/resource/images/medical/login/login_top.png) center;">
	</div>
</section>
<section>
	<div style="border:1px solid #cdcdcd; background-image: url(/resource/images/medical/login/login_area.png); width: 1056px; height: 522px; position: absolute; top: -240px; left: calc(100vw/2 - 528px);">
		<form role="form" id="form-sign-in-account" method="post" action="<?=$menu_url?>/loginOk" target="formReceiver" style="height: 120px;">

			<div style="width: 560px; margin: 200px auto 0;">
				<div style="float: left; width: 390px;">
					<input type="email" class="login-form" id="form-sign-in-email" name="id_email" placeholder="이메일 주소를 입력하세요." style="margin-bottom: 15px;"
					 required>
					<input type="password" class="login-form" id="form-sign-in-password" name="password" placeholder="비밀번호를 입력하세요."
					 required>
				</div>
				<div style="float: right;">
					<button type="submit" class="btn framed icon" style="width: 143px; height: 113px; background-color: #1e67c6; color: white; font-size: 23px">로그인</button>
				</div>
			</div>
		</form>


		<div style="text-align: center;" class="login_text">
			<br>
			<p>
				<a href="javascript:void(0)" class="login_text" >
					아이디 찾기
				</a>
				|
				<a href="<?=$menu_url?>/findPass" class="login_text" >
					비밀번호 찾기
				</a>
				|
				<a href="<?=$menu_url?>/joinForm" class="login_text" >
					회원가입
				</a>
			</p>
			<br>
			<div>
				<a href="<?=$naver_auth_url?>" id="naver_login" target="_blank" title="새창">
					<img class="sns_img" src="/resource/images/medical/login/login_sns_naver.png">
				</a>
				<!-- 					<a href="/index.php/medical/contents/login_login/loginBySNS?method=kakao" id="kakao-login-btn"> -->
				<!-- 						<img src="/resource/assets/img/snsicon2.gif"> -->
				<!-- 					</a> -->
				<a href="/index.php/medical/contents/login_login/loginBySNS?method=facebook" id="facbook_login">
					<img class="sns_img" src="/resource/images/medical/login/login_sns_face.png">
				</a>
			</div>
		</div>
	</div>
</section>
<div style="height: 300px;">&nbsp;</div>
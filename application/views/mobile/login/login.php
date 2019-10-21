<div class="login_banner">
		<img src="/resource/images/mobile/login_banner.png" alt="login_banner" style="width:100%;">
	</div>
<section class="container5" id="login-form">
	
	<div class="block2 bg-white2" >
		<div class="row">
			<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
			
				<form role="form" id="form-sign-in-account" method="post" action="<?=$menu_url?>/loginOk" target="formReceiver">

					<div class="form-group7" style="width:65%; margin:10px 0px 5px;">
						<!-- <label for="form-sign-in-email">ID(Email):</label> -->
						<input type="email" class="form-control" id="form-sign-in-email" name="id_email" placeholder="이메일 " required="required">
					</div>

					<div class="form-group5" style="width:65%; margin:10px 0px 5px;">
						<!-- <label for="form-sign-in-password">Password:</label> -->
						<input type="password" class="form-control" id="form-sign-in-password" name="password" placeholder="비밀번호" required>
					</div>

					 <div class="form-group form-group2">
					 <button type="submit"  style=" width:100%; height:100%; font-size:11px;" class="btn framed icon">로그인 하기</button>
					 </div>
				</form>

				<div style="float:left; width:100%; margin:10px 0px; font-size:11.5px;" >

					<p align=center>
					<!-- 아이디,비밀번호 찾기 기능 -->
					<a href=""><font color=#818181>&nbsp;아이디 찾기 &nbsp;&nbsp;</font> | 
					<a href="<?=$menu_url?>/findPass"><font color=#818181>&nbsp;&nbsp;비밀번호 찾기 &nbsp;&nbsp;</font></a> | 
					<a href="<?=$menu_url?>/joinForm"><font color=#818181>&nbsp;&nbsp;회원가입</font><a>
					
					</p>

				</div>
				<!-- 네이버,페이스북 로그인 기능 -->
				 <div align="center" style="float:left; width:100%;">
					<a href="<?=$naver_auth_url?>" id="naver_login" target="_blank" title="새창" >
						<img src="/resource/images/mobile/naver.png" style="width:25vw; margin-right:10px;">
					</a>
					<a href="/m/index.php/mobile/contents/login_login/loginBySNS?method=facebook" id="facbook_login" >
						<img src="/resource/images/mobile/face.png" style="width:25vw;">
					</a>
				</div>

			</div>
		</div>
	</div>
</section>
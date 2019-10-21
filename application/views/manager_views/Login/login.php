<div id="wrap"> 
	<div id="loging-page">
		<div class="login-title">
			<?=$_site_config['site']['title']?>			
		</div>

		<div class="login-form">
			<form method="POST" action="<?=$login_url?>" target="formReceiver">
				<div class="form-title">
					<p>
						<span class="first">환영합니다.</span>
						<span class="sub-text">오케이메디컬 관리자 페이지입니다.</span>
					</p>
					<p class="alert-text">
						※ 크롬 브라우저에 최적화 되었습니다.
					</p>
				</div>
				<div class="form-group">
					<input type="text" id="user_id" value="" name="user_id" title="아이디" placeholder="아이디 ..." autocomplete="off"/>
				</div>
				<div class="form-group">
					<input type="password" id="user_password" value="" name="user_password" class="ui_input"  title="비밀번호" placeholder="비밀번호"/>
				</div>

				<div class="form-group">
					<input type="submit" value="LOGIN">
				</div>
			</form>	
		</div>		
	</div> 
</div>
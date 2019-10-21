<section class="container" style="margin-top:55px;">
	<div class="block2 bg-white" style="border:1px solid #cdcdcd;">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
				<header>
					<h1 class="page-title">비밀번호 찾기</h1>
					<font color=gray>이메일을 입력해주시면 해당 이메일로 임시 비밀번호가 발송됩니다.</font>
				</header>
				<hr>

				<form role="form" id="form-sign-in-account" method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">

					<div class="form-group">
						<label for="form-sign-in-email">ID(Email):</label>
						<input type="email" class="form-control" id="form-sign-in-email" name="id_email" placeholder="이메일 주소를 입력하세요." required="required">
					</div><!-- /.form-group -->					

					 <div class="form-group">
					 <button type="submit"  style="width: 100%;" class="btn framed icon">비밀번호 찾기<i class="fa fa-angle-right" style="color:#e8a5a5"></i></button>
					 </div>
				</form>			

			</div>
		</div>
	</div>
</section>
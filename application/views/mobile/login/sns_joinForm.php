<div id="join-form">
	<section class="container">
		<div class="block2 bg-white" style="border:1px solid #cdcdcd;">
			<div class="row">
				<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
					<header>
						<h1 class="page-title">회원 가입</h1>
					</header>
					<hr>

					<p>
						SNS을 통한 첫 로그인입니다.<br/>
						시스템 사용에 필요한 기본 정보를 입력해주세요.
					</p>
					<form role="form" id="form-sign-in-account" method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">
						<input type="hidden" name="me_sns" value="<?=$sns?>" />
						<div class="form-group">
							<input type="email" class="form-control" id="form-sign-in-email" value="<?=$email?>" name="id_email" placeholder="아이디로 사용할 이메일 주소를 입력하세요." required <?if($email):?>readonly="reaonly"<?endif;?>>
						</div><!-- /.form-group -->
						<div class="form-group">
							<input type="text" class="form-control" id="form-sign-in-password" value="<?=$name?>" name="name" placeholder="이름을 입력하세요." required>
						</div><!-- /.form-group -->
						 <div class="form-group">
							<input type="text" class="form-control" id="form-sign-in-email" name="phone" placeholder="휴대폰번호를 입력하세요.(-없이 입력)" required>
						</div><!-- /.form-group -->
						<div class="form-group">

							<div style="width:24%; float:left;">
								<select name="year" title="생년 입력">
									<option value="">생년</option>
									<?$years = range(date('Y'), 1900)?>
									<?foreach($years as $v):?>
									<option value="<?=$v?>" ><?=$v?>년</option>
									<?endforeach;?>
								</select>
							</div>

							<div style="width:24%; float:left;">
								<select name="month" title="월 입력">
								<option value="">월</option>
								<?$months = range(1, 12);?>
								<?foreach($months as $v):?>
								<option value="<?=$v?>"><?=$v?>월</option>
								<?endforeach;?>
								</select>
							</div>
							
							<div style="width:24%; float:left;">
								<select name="day" title="일 입력">
								<option value="">일</option>
								<?$days = range(1, 31);?>
								<?foreach($days as $v):?>
								<option value="<?=$v?>"><?=$v?>일</option>
								<?endforeach;?>
								</select>
							</div>
							<span style="clear:both; display:block;"></span>
						</div><!-- /.form-group -->

						 <div class="form-group">
								<select class="framed" name="md_gender" title="성별선택">
									<option value="">성별선택</option>
									<option value="MAN" <?if($gender == 'MAN'):?>selected="seleced"<?endif;?>>남성</option>
									<option value="WOMAN" <?if($gender == 'WOMAN'):?>selected="seleced"<?endif;?>>여성</option>
								</select>
							</div>


						<hr>
							 <h4>약관 동의</h4>
							<ul class="list-unstyled checkboxes">
							<li>
								<div class="checkbox"><label><input type="checkbox" name="features1" value="1" style="margin-left:0px;">&nbsp;개인정보취급방침 동의(필수)</label></div>
							</li>
							<li>
								<div class="checkbox"><label><input type="checkbox" name="features2" value="2"  style="margin-left:0px;">&nbsp;개인정보3자제공동의(필수)</label></div></li>
							</ul>
						<hr>

						 <div class="form-group">
							 <button type="submit"  style="width: 100%;" class="btn framed icon">회원가입 하기<i class="fa fa-angle-right" style="color:#e8a5a5"></i></button>
						 </div>
					</form>

				</div>
			</div>
		</div>
	</section>
</div>
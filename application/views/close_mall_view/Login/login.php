<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8" />
        <title><?=$_site_config['site']['title']?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
        <meta content="" name="author" />
		<link type="text/css"  rel="stylesheet" href="/resource/css/common.css" />
		<?=$css?>
		<?=$js?>

		<script type="text/javascript">
			$(document).ready(
				function(){
					$('#user_id').focus();
				}
			);
		</script>
	</head>
<body>
<div id="wrap">
	<div id="loging-page">
		<div class="login-title">
			<?=$_site_config['site']['title']?>
		</div>

		<div class="login-form">
			<form method="POST" action="/index.php/close_mall?bact=loginOk" target="formReceiver">
				<div class="form-title">
					<p>
						<span class="first">환영합니다.</span>
						<span class="sub-text">폐쇄몰 관리자 페이지입니다.</span>
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

			<div class="btn-area-center">
				<a href="/index.php/close_mall?bact=join">검진기관 신규회원 가입</a>
				&nbsp; | &nbsp;
				<a href="/index.php/close_mall?bact=find">비밀번호 찾기</a>
			</div>

			<div class="notice">
				제휴기관 가입과 관련 문의사항이 있을 경우<br/>
				OKAYMEDI협력업체 서비스 센터로 연락 주세요.

				<p>
					가입문의  : <span>1588-9419</span>
				</p>
			</div>
		</div>
	</div>
</div>
</body>

<iframe id="formReceiver" name="formReceiver" title="프로그램용 - 내용없음"></iframe>
</html>

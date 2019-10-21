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
		
		<style type="text/css">
		#join-form{margin:10px auto; padding:15px; width:700px; background-color:#fff; border:2px solid #e3e3e3; }
		#join-form h2{font-weight:bold; font-size:18px; padding:8px; text-align:center; }		
		#join-form h3 span{font-weight:bold;}

		#join-form table .text-area{text-align:center; line-height:24px; font-size:14px; }
		</style>
	</head>
<body>
<div id="wrap"> 
	<div id="join-form">
		<h2>OKAYMEDI 비밀번호 찾기</h2>		

		<form method="post" action="/index.php/rhksflwk?bact=findOk" target="formReceiver" enctype="multipart/form-data">
			<input type="hidden" name="hi_org_number" value="" id="hi_org_number"/>
			<table summary="병원회원 등록 폼" class="table table-form">
			<caption>병원회원 등록 폼</caption>

			<colgroup>
				<col width="30%" />
				<col width="70%" />
			</colgroup>

			<tbody>
				<tr>
					<td>
						<input type="text" name="me_id" value="" title="아이디 입력" placeholder="아이디 입력 ... " class="middle" />
					</td>
				</tr>
				<tr>
					<td class="text-area">
						회원가입하신 아이디를 입력해 주세요.</br>
						가입시 등록한 이메일로 임시 비밀번호를 발송해 드립니다.
					</td>
				</tr>
				
			</tbody>
		</table>
		<div class="btn-area-center">
			<input type="submit" value="이메일 전송" class="btn btn-primary" />
			<a href="/index.php/rhksflwk" class="btn btn-default">돌아가기</a>
		</div>
	</div>	
</div>
</body>

<iframe id="formReceiver" name="formReceiver" title="프로그램용 - 내용없음"></iframe>
</html>
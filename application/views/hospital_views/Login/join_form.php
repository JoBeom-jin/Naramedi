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
		</style>
	</head>
<body>
<div id="wrap"> 
	<div id="join-form">
		<h2>OKAYMEDI 제휴 검진기관 등록</h2>
		<h3 class="title"><span class="strong">OKAYMEDI에 오신것을 환영합니다.</span><br/>
			저희는 대한민국의 최고의 건강검진 서비스 포털을 지향하며 고객과 병원을 잇는 가교 역할을 하고자 합니다
		</h3>
		<form method="post" action="/index.php/rhksflwk?bact=joinOk" target="formReceiver" enctype="multipart/form-data">
			<input type="hidden" name="hi_org_number" value="" id="hi_org_number"/>
			<table summary="병원회원 등록 폼" class="table table-form">
			<caption>병원회원 등록 폼</caption>

			<colgroup>
				<col width="30%" />
				<col width="70%" />
			</colgroup>

			<tbody>
				
				<tr>
					<th>검진기관명</th>
					<td>
						<input type="text" value="" name="me_name" id="me_name" title="검진기관명" class="middle" required="required" readonly="readonly"/>
						<a href="/index.php/rhksflwk?bact=search" class="btn btn-default" onclick="window.open(this.href, 'seach-form', 'width=700, height=700'); return false;">찾아보기</a>
					</td>
				</tr>			
				<tr>
					<th>검진기관명(노출용)</th>
					<td>
						<input type="text" value="" name="hi_open_name"  title="검진기관명(오픈용)" required="required"/>
					</td>
				</tr>
				<tr>
					<th>사업자번호</th>
					<td>
						<input type="text" value="" name="hi_biz_number"  title="사업자번호" required="required"/>
					</td>
				</tr>
				<tr>
					<th>로그인 아이디</th>
					<td>						
						<input type="text" value="" name="me_id" title="아이디" />
					</td>				
				</tr>
				<tr>
					<th>비밀번호</th>
					<td>
						<input type="password" value="" name="me_pass" title="비밀번호" />
					</td>
				</tr>
				<tr>
					<th>비밀번호 확인</th>
					<td>
						<input type="password" value="" name="me_pass_check" title="비밀번호 확인"/>
					</td>
				</tr>
				<tr>
					<th>담당자명</th>
					<td>
						<input type="text" value="" name="hi_mng_name"  title="담당자명" required="required"/>
					</td>
				</tr>
				<tr>
					<th>담당자전화번호</th>
					<td>
						<input type="text" value="" name="hi_mng_phone"  title="담당자전화번호" required="required"/>
					</td>
				</tr>
				<tr>
					<th>담당자이메일</th>
					<td>
						<input type="text" value="" name="hi_mng_email"  title="담당자이메일" required="required"/>
					</td>
				</tr>
				<tr>
					<th>예약담당자 전화번호</th>
					<td>
						<input type="text" value="" name="hi_revmng_phone"  title="예약담당자 전화번호" required="required"/><br/>
						※ 예약 SMS 수신을 위해 반드시 휴대폰 번호를 입력해 주세요.
					</td>
				</tr>				
				<tr>
					<th>사업자 등록증</th>
					<td>						
						<input type="file" name="business_file" title="사업자 등록증 등록" />												
					</td>
				</tr>				
				<tr>					
					<td colspan="4" class="tcenter">
						<input type="submit" value="가입신청" class="btn btn-primary"/> 
						<a href="<?=$menu_url?>" class="btn btn-default">로그인 페이지로</a>
					</td>
				</tr>
				
			</tbody>
		</table>			
		</form>
	</div>	
</div>
</body>

<iframe id="formReceiver" name="formReceiver" title="프로그램용 - 내용없음"></iframe>
</html>
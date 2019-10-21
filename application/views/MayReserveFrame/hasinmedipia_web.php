<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="noindex,nofollow">
	<meta name="hansin medipia" content="hansin medipia">
	<title>::5월 가정의달::건강검진:: 신청하기 입력폼</title>

	<style type="text/css">
	body{margin:0; padding:0; background-color:#bccb5b; width: 100vw; height: 100vh;}
	iframe{overflow: hidden;}
	#form-bg{background:url('/_resource/landingPage/may_image.png') no-repeat; width:100%; height:315px; margin:0 auto; position:relative; text-align: center;}

	#form-bg input[type="text"], #form-bg select, #form-bg textarea{
		/*display: block;*/
		width: 196px;
		height:34px;
		padding:1px 12px;
		font-size: 14px;
		line-height: 1.42857143;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		/*border-radius: 4px;*/
		-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
		-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
		transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}

	#form-bg span, #form-bg p{
		color: white;
		vertical-align: middle;
	}
	a {
		text-decoration: none !important;
		color: #53a4ef;
	}

	#reserv_name{position: absolute; top: 75px; left: 800px}
	#reserv_tel{position: absolute; top: 130px; left: 800px}
	#reserv_email{position: absolute; top: 175px; left: 800px}
	#reserv_hos{position: absolute; top: 75px; left: 1160px}
	#reserv_ques{position: absolute; top: 130px; left: 1160px}
	#reserv_check{position: absolute; top: 170px; left: 1160px}
	#reserv_check1{position: absolute; top: 170px; left: 1180px}
	#reserv_checkText{position: absolute; top: 190px; left: 1236px}
	#reserv_button{position: absolute; top: 40px; left: 1450px}


	/*#form-bg textarea{height:60px;}*/

	/*#form-bg select{width:212px;}*/
	/*#form-bg .inline input{display:inline-block; width:35px;}*/
	/*#form-bg .inline input:nth-child(1){width:30px;}*/

	/*#form-bg .inline{color:#fff;}*/
	/*#form-bg .row-one{position:absolute; top:41px;}*/
	/*#form-bg .row-two{position:absolute; top:90px;}*/
	/*#form-bg .row-three{position:absolute; top:139px;}*/

	/*#form-bg .col-one{position:absolute; left:580px;}*/
	/*#form-bg .col-two{position:absolute; left:890px;}*/
	/*#form-bg input[type="checkbox"]{top:155px; left:880px;}*/
	/*#form-bg a.link-checkbox{display:block; position:absolute; width:150px; top:150px; left:900px; padding:5px 0; cursor:pointer;}*/

	/*#form-bg .send-btn{display:block; position:absolute;  left:50%; bottom:70px;}*/

</style>
</head>

<body>

	<div id="form-bg">
		<form method="post" action="/index.php/Customreserveframe/insertOK" target="formReceiver" style="width: 750px; height: 200px; text-align: center; margin: auto;">

			<div id="reserv_name">
				<input type="text" name="hu_name" value="" title="이름" placeholder="신청자 이름" class="row-one col-one"/>
			</div>

			<div id="reserv_tel">
				<input type="text" name="phone[]" value="" title="연락처" style="width: 36px" /> <span>-</span>
				<input type="text" name="phone[]" value="" title="연락처" style="width: 36px" /> <span>-</span>
				<input type="text" name="phone[]" value="" title="연락처" style="width: 36px" />
			</div>

			<div id="reserv_email">
				<input type="text" name="hu_email" value="" title="이메일" />
			</div>
			<div id="reserv_hos">
				<select name="hu_type_code" title="검진항목 선택" style="width: 222px;">
					<option value="">검진병원</option>
					<?foreach($types as $code => $name):?>
					<option value="<?=$code?>"><?=$name?></option>
					<?endforeach;?>
				</select>
			</div>
			<div id="reserv_ques">
				<textarea name="hu_comment" title="문의내용" class="row-two col-two" maxlength="255" style="line-height: 34px; resize:none;"></textarea>

				<!-- 			<input type="text" name="hu_comment" value="" title="문의내용" placeholder="문의내용" class="row-two col-two"/> -->
			</div>
			<div id="reserv_check">
				<input type="checkbox" name="hu_accept" id="hu_accept" value="y" title="개인정보취급방침동의" class="row-three col-two"/>
			</div>
			<div id="reserv_check1">
				<span style="font-size: 12px;">개인정보 수집 및 사용에 동의합니다.</span>
			</div>
			<div id="reserv_checkText">
				<a href="/index.php/Customreserveframe/acception" onclick="window.open(this.href, 'acception', 'width=700, height=700'); return false; " class="link-checkbox" style="text-decoration-line: none;">[개인정보 취급방침]</a>
			</div>
			<div id="reserv_button">
				<input type="image" alt="건강검진 접수하기" src="/_resource/landingPage/may_button.png" class="send-btn"/>
			</div>
			<input type="hidden" name="hu_code" value="nm" />
		</div>
	</form>
</div>
<iframe  src="" id="formReceiver" name="formReceiver" style="display:none; width:100%; height:300px; border:1px solid red;"></iframe>
</body>

</html>

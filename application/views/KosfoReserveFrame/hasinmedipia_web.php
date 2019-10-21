<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="noindex,nofollow">
	<meta name="hansin medipia" content="hansin medipia">
	<script>
		window.navigator.__defineGetter__('userAgent', function () {
    return 'Mozilla/5.0 (Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36';
});
	</script>
	<title>::코리아스타트업포럼::건강검진:: 신청하기 입력폼</title>

	<style type="text/css">
	body{margin:0; padding:0; background-color:#64afb4; width: 100vw; height: 100vh;}
	iframe{overflow: hidden;}
	/* body{background:url('/_resource/landingPage/may_image.png') no-repeat;} */

	label{
		text-align: right;
		font-size: 1.25vw;
		text-overflow: ellipsis;
		overflow: hidden;
		color: white;
		display: inline-block;
		width: 7vw;
		white-space: nowrap;
	}

	#form-bg input[type="text"], #form-bg select, #form-bg textarea{
		/*display: block;*/
		width: 9vw;
		height: 2.3vw;
		padding: 0px 0.6vw;
		font-size: 0.7vw;
		line-height: 2.3vw;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		/*border-radius: 4px;*/
		/* -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
		-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
		transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s; */
	}

	#form-bg span, #form-bg p{
		color: white;
		vertical-align: middle;
	}
	a {
		text-decoration: none !important;
		color: #53a4ef;
	}

	/* #reserv_name{position: absolute; top: 3vw; left: 41.6vw}
	#reserv_tel{position: absolute; top: 6.7vw; left: 41.6vw}
	#reserv_email{position: absolute; top: 9.1vw; left: 41.6vw}
	#reserv_hos{position: absolute; top: 3vw; left: 60vw}
	#reserv_ques{position: absolute; top: 6.7vw; left: 60vw}
	#reserv_check{position: absolute; top: 8.8vw; left: 60vw}
	#reserv_check1{position: absolute; top: 8.8vw; left: 61.45vw}
	#reserv_checkText{position: absolute; top: 9.9vw; left: 64vw}
	#reserv_button{position: absolute; top: 2vw; left: 74.5vw} */


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

	.float-left{
		float:left;
	}
	tr{
		margin: 3vw;
	}
	#form-plate{
		float: left;
		margin: 2.5vw 1vw;
	}
	#form-bg{
		position: absolute;
		top: 1.5vw;
		/* width: 100vw; */
		text-align: end;
		margin-left: 20vw;
	}
	#form-img{
		width: 14vw;
		float: left;
		padding: 2vw 1.5vw 2vw 0;
		border-right: 1px solid #9bcbce;
	}
</style>
</head>

<body>

	<div id="form-bg">
		<form method="post" action="/index.php/Kosforeserveframe/insertOK" target="formReceiver" style="width: 100vw; margin: auto;">
		<img id="form-img" src="/_resource/landingPage/kosfo/reserveText.png" alt="">
			<div id="form-plate" style="max-width: 30vw;">
				<table style="margin-bottom: 0.5vw;">
					<tr>
						<td>
							<label for="hu_name">이    름</label>
						</td>
						<td>
							<div id="reserv_name">
								<input type="text" id="hu_name" name="hu_name" value="" title="이름" placeholder="신청자 이름" class="row-one col-one"/>
							</div>
						</td>
						<td>
							<label for="hu_type_code">검진병원</label>
						</td>
						<td>
							<div id="reserv_hos">
								<select id="hu_type_code" name="hu_type_code" title="검진항목 선택" style="width: 10.3vw">
									<option value="">검진병원</option>
									<?foreach($types as $code => $name):?>
									<option value="<?=$code?>"><?=$name?></option>
									<?endforeach;?>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<label for="hu_phone">전화번호</label>
						</td>
						<td>
							<div id="reserv_tel">
								<input type="text" id="hu_phone" name="phone" value="" title="연락처" placeholder="전화번호"/>
							</div>
						</td>
						<td>
							<label for="hu_type_code">패키지선택</label>
						</td>
						<td>
							<div id="reserv_hos">
								<select id="hu_type_code_sub" name="hu_type_code_sub" title="패키지선택" style="width: 10.3vw">
									<option value="">패키지선택</option>
									<option value="_10">10만원패키지</option>
									<option value="_20">20만원패키지</option>
									<option value="_30">30만원패키지</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<label for="hu_email">이 메 일</label>
						</td>
						<td>
							<div id="reserv_email">
								<input type="text" id="hu_email" name="hu_email" value="" title="이메일" placeholder="이메일" />
							</div>
						</td>
						<td>
							<label for="hu_comment">문의내용</label>
						</td>
						<td>
							<div id="reserv_ques">
								<input type="text" id="hu_comment" name="hu_comment" title="문의내용" placeholder="문의내용" style="line-height: 1.7vw; resize:none;">

								<!-- 			<input type="text" name="hu_comment" value="" title="문의내용" placeholder="문의내용" class="row-two col-two"/> -->
							</div>
						</td>
					</tr>
				</table>
				<div id="reserv_check" style="float:left; padding-left: 2.5vw;">
					<input type="checkbox" name="hu_accept" id="hu_accept" value="y" title="개인정보취급방침동의" class="row-three col-two"/>
				</div>
				<div id="reserv_check1" style="float:left;">
					<span style="font-size: 0.6vw;">개인정보 수집 및 사용에 동의합니다.</span>
				</div>
				<div id="reserv_checkText" style="float:left;">
					<a href="/index.php/Kosforeserveframe/acception" onclick="window.open(this.href, 'acception', 'width=700, height=700'); return false; " class="link-checkbox" style="text-decoration-line: none; color: #9ef9ff; font-size: 0.6vw">[개인정보 취급방침]</a>
				</div>
			</div>
			<div id="reserv_button" style="float: left; margin: 1.5vw 5vw;">
				<input type="image" alt="건강검진 접수하기" src="/_resource/landingPage/kosfo/reserveImage.png" class="send-btn" style="width: 11vw; height: 11vw;"/>
			</div>
			<input type="hidden" name="hu_code" value="kosfo" />
		</div>
	</form>
</div>
<iframe  src="" id="formReceiver" name="formReceiver" style="display:none; width:100%; height:300px; border:1px solid red;"></iframe>
</body>

</html>

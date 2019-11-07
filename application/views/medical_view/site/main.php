<body style="margin:0; padding:0">
<!--메인이미지 -->
<div id="wrapper12">
	<div id="alert_back" src="/resource/images/main/nemo.svg">
		<img id="alert_back1" src="/resource/images/main/nemo.svg">
	</div>
	<div id="c_alert">
		<div>
			<img src="/resource/images/main/splash_esc.svg" onclick="close_esc()" class="c_btn">
			<img src="/resource/images/main/splash_exit.svg" onclick="close_exit()" class="c_btn1">
		</div>
	</div>
	<div id="c_alert2">
		<div>
			<img src="/resource/images/main/splash_esc.svg" onclick="close_esc2()" class="c_btn">
			<img src="/resource/images/main/splash_exit.svg" onclick="close_exit2()" class="c_btn1">
		</div>
	</div>
	<div id="container1" class="containers">
		<img src="/resource/images/main/splash_title23.png" class="splash_title">
		<img src="/resource/images/main/splash_bottom.svg" class="splash_bottom">
		<img src="/resource/images/main/splash_middle.svg" class="splash_middle">
		<img src="/resource/images/main/start_button12.svg" class="start_btn" onclick="start_c()">
	</div>
	<div id="container2" class="containers">
		<img class="close_btn" src="/resource/images/main/ic_close_btn.svg" onclick="close_c()">
	
			<p class="container_ment">
				 안녕하세요 :)<br>
				 나라검진을 통해<br>
				 국가무료검진을 예약을 하셨나요?
			</p>
			<div class="div_p1">
			<p class="q_sub_title" onclick="next_1();">
				<input style="display:none;" type="radio" name="yes" id="yes_1" value="yes_1"><label id="yes_1" class="uncheck_text" onclick="change_radio(this)" for="yes_1">
				네.예약했어요. </label>
			</p>
			<p class="q_sub_title1" onclick="next();">
				<input style="display:none;" type="radio" name="yes" id="yes_2" value="yes_2"><label id="yes_2" class="uncheck_text" onclick="change_radio(this)" for="yes_2">
				아니요. </label>
			</p>
		</div>
		<p class="marks">
			 “
		</p>
		<img class="next_btn" id="next_btn" src="/resource/images/main/splash113_next1.svg" onclick="next_c1()">
		<img class="next_btn" id="next_btn_1" src="/resource/images/main/splash113_next1.svg" onclick="next_c1_1()">
	 </div>
	 <!-- 예약번호 페이지 -->
	<div id="container2_1" class="container" style="background-image:url('/resource/images/main/splash113.svg'); background-size:cover; height:100%; display:none; position:relative;">
		<img class="close_btn" src="/resource/images/main/ic_close_btn.svg" onclick="close_c()" style="position:absolute; top:2.6%; left:4.5%; max-width:6.6%; height:auto">
		<p style="position: absolute; font-size: 2.8vh; top: 26.5%; left:13.3%; font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR	;color:#fff; ">
			 병원에서 안내 받은<br>
			 예약번호를 입력해주세요.<br>
		</p>
		<p style="position:absolute; top:1%; left:4.5%; font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR; font-size:18.44vh; color: rgba(255,255,255,0.26);">
			 “
		</p>
		
		<input type="text" name="date_text5" id="date_text5" class="date_text" placeholder="예약번호 6자리" maxlength="6" oninput="numberMaxLength(this);" onkeyup="birth_c()"
		style="position:absolute; top:48%; left:16%; max-width:67.8%; height:auto; border-radius:0px;border-bottom: 2px solid #FFFFFF; background:none; border-top:none; border-right:none; border-left:none; color:#FFFFFF; opacity:0.8; background-image:url('/resource/images/main/ic_check_disable.png'); background-position:right 0px;background-repeat:no-repeat;">
		
		<div onclick="next_c1_2()">
		<p style="position:absolute; max-width:26.3%; height:auto; left:53.6%; top:51.7%; font-size:10px; color:#FFFFFF; font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;">
		* 예약번호 모르는 경우
		</p>
		<img src="/resource/images/main/greater.svg" style="position:absolute; max-width:auto; height:auto; top:53.4%; left:81%;">
		</div>
		<img class="confirm_btn" id="confirm_btn" src="/resource/images/main/confirm_btn.svg" onclick="" style="position:absolute; max-width:75%; height:auto; top:63.8%; left:12.5%;">
	</div> 
	<!-- 10월31일 예약번호찾기 페이지 -->
		<div id="container2_2" class="container" style="background-image:url('/resource/images/main/splash113.svg'); background-size:cover; height:100%; display:none; position:relative;">
		<img class="close_btn" src="/resource/images/main/ic_close_btn.svg" onclick="close_c()" style="position:absolute; top:2.6%; left:4.5%; max-width:6.6%; height:auto">
		<p style="position: absolute; font-size: 2.8vh; top: 26.5%; left:13.3%; font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR	;color:#fff; ">
			 예약번호찾기<br>
		</p>
		<p style="position:absolute; top:1%; left:4.5%; font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR; font-size:18.44vh; color: rgba(255,255,255,0.26);">
			 “
		</p>
		<input type="text" name="date_text1" id="date_text1" class="date_text" placeholder="이름" maxlength="6" oninput="numberMaxLength(this);" onkeyup="birth_c1()"
		style="position:absolute; top:38%; left:16%; max-width:67.8%; height:auto; border-radius:0px;border-bottom: 2px solid #FFFFFF; background:none; border-top:none; border-right:none; border-left:none; color:#FFFFFF; opacity:0.8; background-image:url('/resource/images/main/ic_check_disable.png'); background-position:right 0px;background-repeat:no-repeat;">
		<input type="text" name="date_text2" id="date_text2" class="date_text" placeholder="생년월일 6자리" maxlength="6" oninput="numberMaxLength(this);" onkeydown="return onlyNumber(event)" onkeyup="birth_c2()"
		style="position:absolute; top:50%; left:16%; max-width:67.8%; height:auto; border-radius:0px;border-bottom: 2px solid #FFFFFF; background:none; border-top:none; border-right:none; border-left:none; color:#FFFFFF; opacity:0.8; background-image:url('/resource/images/main/ic_check_disable.png'); background-position:right 0px;background-repeat:no-repeat;">
		<input type="text" name="date_text3" id="date_text3" class="date_text" placeholder="핸드폰번호입력" maxlength="11" oninput="numberMaxLength(this);" onkeydown="return onlyNumber(event)" onkeyup="birth_c3()"
		style="position:absolute; top:62%; left:16%; max-width:67.8%; height:auto; border-radius:0px;border-bottom: 2px solid #FFFFFF; background:none; border-top:none; border-right:none; border-left:none; color:#FFFFFF; opacity:0.8; background-image:url('/resource/images/main/ic_check_disable.png'); background-position:right 0px;background-repeat:no-repeat;">
		<img class="confirm_btn" id="confirm_btn" src="/resource/images/main/confirm_btn.svg" onclick="prev_c5()" style="position:absolute; max-width:75%; height:auto; top:74%; left:12.5%;">
	</div> 



	<div id="container3" class="containers">
		<img class="close_btn" src="/resource/images/main/ic_close_btn.svg" onclick="close_c()">
			
			<p class="container_ment">
				 올해 국가무료검진<br>
				 대상자이신가요?
			</p>
			<div class="div_p2">
			<p class="q_sub_title2" onclick="next1();">
				<input style="display:none;" type="radio" name="yes2" id="yes_11" value="yes_11"><label class="uncheck_text" onclick="change_radio(this)" for="yes_11">네.올해대상자에요. </label>
			</p>
			<p class="q_sub_title2" onclick="next1();">
				<input style="display:none;" type="radio" name="yes2" id="yes_22" value="yes_22"><label class="uncheck_text" onclick="change_radio(this)" for="yes_22">아니요. 모르겠어요. </label>
			</p>
		</div>
		<img class="next_btn1" id="next_btn1" src="/resource/images/main/splash113_next1.svg" onclick="next_c2()">
		<img class="btn_prev" id="btn_prev1" src="/resource/images/main/splash113_back.svg" onclick="prev_c1()">
		<img class="bottom_bar" src="/resource/images/main/splash_bottom_bar.svg" width="92%">
		<p class="marks">
			 “
		</p>
	</div>
	<div id="container4" class="containers">
		<img class="close_btn" src="/resource/images/main/ic_close_btn.svg" onclick="close_c2()">
		<p class="container_ment2">
			 반갑습니다. <br>
			 당신의 이름을 알려주세요.
		</p>
		<input type="text" name="name_text" id="name_text" class="text_enter" placeholder="이름" onkeyup="name_c()">
		<img class="next_btn1" id="next_btn2" src="/resource/images/main/splash113_next1.svg" onclick="next_c3()">
		<img class="btn_prev" id="btn_prev2" src="/resource/images/main/splash113_back.svg" onclick="prev_c2()">
		<img class="bottom_bar" src="/resource/images/main/splash_bottom_bar2.svg" width="92%">
		<p class="marks">
			 “
		</p>
	</div>
	<div id="container5" class="containers">
		<img class="close_btn" src="/resource/images/main/ic_close_btn.svg" onclick="close_c2()">
		<p class="container_ment2">
			<span id="my_name1">ddd</span>님,<br>
			 생년월일을 알려주세요.
		</p>
		<input type="text" name="date_text" id="date_text" class="text_enter" placeholder="생년월일 6자리" maxlength="6" oninput="numberMaxLength(this);" onkeyup="birth_c()">
		<img class="next_btn1" id="next_btn3" src="/resource/images/main/splash113_next1.svg" onclick="next_c4()">
		<img class="btn_prev" id="btn_prev3" src="/resource/images/main/splash113_back.svg" onclick="prev_c3()">
		<img class="bottom_bar" src="/resource/images/main/splash_bottom_bar3.svg" width="92%">
		<p class="marks">
			 “
		</p>
	</div>
	<div id="container6" class="containers">
		<img class="close_btn" src="/resource/images/main/ic_close_btn.svg" onclick="close_c2()">
		<p class="container_ment2">
			<span id="my_name2">ddd</span>님의<br>
			 성별을 알려주세요.
		</p>
		<div class="div_p3">
			<p class="gender" onclick="next2();" id="man">
				<input style="display:none;" type="radio" name="gender" id="gender_1" value="gender_1"><label class="uncheck_text" onclick="change_radio(this)" for="gender_1">
				남자 </label>
			</p>
			<p class="gender" onclick="next2();" id="woman">
				<input style="display:none;" type="radio" name="gender" id="gender_2" value="gender_2"><label class="uncheck_text" onclick="change_radio(this)" for="gender_2">
				여자 </label>
			</p>
		</div>
		<img class="next_btn1" id="next_btn4" src="/resource/images/main/splash113_next1.svg" onclick="next_c5()">
		<img src="/resource/images/main/splash113_back.svg" class="btn_prev" id="btn_prev4" onclick="prev_c4()">
		<img class="bottom_bar" src="/resource/images/main/splash_bottom_bar4.svg" width="92%">
		<p class="marks">
			 “
		</p>
	</div>
	<div id="container7" class="containers">
		<img class="close_btn" src="/resource/images/main/ic_close_btn.svg" onclick="close_c2()">
		<p class="container_ment2">
			<span id="my_name3">ddd</span>님,<br>
			 자녀가 있으신가요?
		</p>
		<p class="baby">
			 *생후 4개월~71개월인 경우
		</p>
		<div class="div_p4">
			<p class="gender2" onclick="next3();" id="man">
				<input style="display:none;" type="radio" name="child" id="child_1" value="child_1"><label class="uncheck_text" onclick="change_radio(this)" for="child_1">
				예.있어요. </label>
			</p>
			<p class="gender2" onclick="next3();" id="woman">
				<input style="display:none;" type="radio" name="child" id="child_2" value="child_2"><label class="uncheck_text" onclick="change_radio(this)" for="child_2">
				아니요.없습니다. </label>
			</p>
		</div>
		<img class="next_btn1" id="next_btn5" src="/resource/images/main/splash113_next1.svg" onclick="next_c6()">
		<img src="/resource/images/main/splash113_back.svg" class="btn_prev" id="btn_prev5" onclick="prev_c5()">
		<img class="bottom_bar" src="/resource/images/main/splash_bottom_bar5.svg" width="92%">
		<p class="marks">
			 “
		</p>
	</div>
	<div id="container8" class="containers">
		<p class="container_ment2">
			 소중한 정보 감사합니다!<br>
			 이제 <span id="my_name4">123123</span>님에게 적합한<br>
			 검진 기관을 찾아볼까요?:)
		</p>
		<a href="/index.php/Mainset">
		<img class="splash_end" src="/resource/images/main/splash_end.svg">
		</a>
		<p class="marks">
			 “
		</p>
	</div>
</div>
<script>
var q_close = document.getElementsByClassName("q_close");
var c_alert = document.getElementById("c_alert");
var c_alert2 = document.getElementById("c_alert2");

var btn_next = document.getElementById("btn_next");
var btn_next1 = document.getElementById("btn_next1");
var btn_next2 = document.getElementById("btn_next2");
var btn_next3 = document.getElementById("btn_next3");
var btn_next4 = document.getElementById("btn_next4");
var btn_next5 = document.getElementById("btn_next5");

var btn_prev1 = document.getElementById("btn_prev1");
var btn_prev2 = document.getElementById("btn_prev2");



var my_name = document.getElementById("my_name1");
var my_name2 = document.getElementById("my_name2");
var my_name3 = document.getElementById("my_name3");
var my_name4 = document.getElementById("my_name4");


var container1 = document.getElementById("container1");
var container2 = document.getElementById("container2");
var container2_1 = document.getElementById("container2_1");
var container2_2 = document.getElementById("container2_2");
var container3 = document.getElementById("container3");
var container4 = document.getElementById("container4");
var container5 = document.getElementById("container5");
var container6 = document.getElementById("container6");
var container7 = document.getElementById("container7");
var container8 = document.getElementById("container8");

var alert_back = document.getElementById("alert_back");



var text;

</script>
</body>
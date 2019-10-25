

	  
<body>

<div id="container">

<img id="alert_back" src="/resource/images/main/nemo.svg">

<div id="c_alert">
<div style="text-align:center">
<img src="/resource/images/main/splash_esc.svg" onclick="close_esc()" class="c_btn" style="border-bottom-left-radius: 14px;">
<img src="/resource/images/main/splash_exit.svg" onclick="close_exit()" class="c_btn" style="border-bottom-right-radius: 14px;">
</div>
</div>

<div id="c_alert2">
<img src="/resource/images/main/splash_esc.svg" onclick="close_esc2()" class="c_btn" style="border-bottom-left-radius: 14px;margin-left: 26px;">
<img src="/resource/images/main/splash_exit.svg" onclick="close_exit2()" class="c_btn" style="border-bottom-right-radius: 14px;">
</div>
<!-- 메인 이미지 -->
        <img src="/resource/images/main/splash_title2.png" class="splash_title">        
	<img src="/resource/images/main/splash3.svg" width="100%" height="100%">
	
	<img src="/resource/images/main/btn_start.svg"  class="start_btn" width="100%" style="max-width:104px;"  onclick="start_c()">

<div id="myModal" class="modal2">

<img src="/resource/images/main/ic_close_btn.svg" class="q_close" width="24" onclick="close_c()" >
<div class="q_title" width="100%" style="max-width:212px;">
        <p>안녕하세요 :)</p>
        <p>나라검진을 통해</p>
        <p>국가무료검진 예약을 하셨나요?</p>
</div>

<!-- <img src="/resource/images/main/q_00_yes.svg" style="top:43%;max-width:84px;" class="q_sub_title" width="100%">
<img src="/resource/images/main/q_00_no.svg" style="top:48%;max-width:42px;"  onclick="next();" class="q_sub_title" width="100%"> -->

<p style="top:46%;min-width:84px;opacity:1;" class="q_sub_title" onclick="next();"><input style="display:none;" type="radio" name="yes" id="yes_1" value="yes_1"><label id="yes_1" class="uncheck_text" onclick="change_radio(this)" for="yes_1">네.예약했어요.</label></p>

<p style="top:52%;min-width:42px;opacity:1;" class="q_sub_title" onclick="next();"><input style="display:none;" type="radio" name="yes" id="yes_2" value="yes_2"><label id="yes_2" class="uncheck_text" onclick="change_radio(this)" for="yes_2">아니요.</label></p>

<img src="/resource/images/main/btn_next.svg" id="btn_next" class="btn_next" style=" display: none;" onclick="next_c1()">

<p style="position:absolute;left:13px;top:18%;color: rgba(255,255,255,0.26);
        font-size: 118px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" >“</p>
<img src="/resource/images/main/q_main.svg" width="100%">
</div>



<div id="myModal2" class="modal3">
<img src="/resource/images/main/ic_close_btn.svg" class="q_close" width="24" onclick="close_c()" >

<div style="color: #fff;
        font-size: 18px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" class="q_title" width="100%">
<p style="margin:0">올해 국가무료검진</p>
	<p style="fill: #fff;">대상자이신가요?</p>
</div>

<!-- <img src="/resource/images/main/q_01_yes.svg" style="top:43%;max-width:115px;" class="q_sub_title" width="100%">
<img src="/resource/images/main/q_01_no.svg" style="top:48%;max-width:112px;"  onclick="next();" class="q_sub_title" width="100%"> -->

<p style="top:46%;min-width:84px;" class="q_sub_title" onclick="next1();"><input style="display:none;" type="radio" name="yes2" id="yes_11" value="yes_11"><label class="uncheck_text" onclick="change_radio(this)" for="yes_11">네.올해대상자에요.</label></p>

<p style="top:52%;min-width:42px;" class="q_sub_title" onclick="next1();"><input style="display:none;" type="radio" name="yes2" id="yes_22" value="yes_22"><label class="uncheck_text" onclick="change_radio(this)" for="yes_22">아니요.모르겠어요.</label></p>



<img src="/resource/images/main/btn_next.svg" class="btn_next" id="btn_next1" style="display:none;left:30%;" onclick="next_c2()">
<img src="/resource/images/main/btn_back.svg" class="btn_prev" id="btn_prev1"  onclick="prev_c1()" >

<img src="/resource/images/main/q_01_percent.svg" width="100%" class="percentage">

<p style="position:absolute;left:13px;top:18%;color: rgba(255,255,255,0.26);
        font-size: 118px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" >“</p>
<img src="/resource/images/main/q_main.svg" width="100%">
</div>


<div id="myModal3" class="modal4">
<img src="/resource/images/main/ic_close_btn.svg" class="q_close" width="24" onclick="close_c2()" >
<div style="color: #fff;
        font-size: 18px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" class="q_title" width="100%">
<p style="margin:0">반갑습니다.</p>
	<p style="fill: #fff;">당신의 이름을 알려주세요</p>
</div>

<input type="text" name="name_text" id="name_text" class="name_text" placeholder="이름" onkeyup="name_c()" style="border-radius:0px;border-bottom: 2px solid #FFFFFF; background:none; border-top:none; border-right:none; border-left:none; color:#FFFFFF; opacity:0.7;background-image:url('/resource/images/main/ic_check_disable.png'); 
        background-position:right 0px;background-repeat:no-repeat;">

<img src="/resource/images/main/btn_next.svg" class="btn_next" id="btn_next2" style="display:none;left:30%;"  onclick="next_c3()">
<img src="/resource/images/main/btn_back.svg" class="btn_prev" id="btn_prev2"  onclick="prev_c2()"  >

<img src="/resource/images/main/q_02_percent.svg" width="100%" class="percentage">

<p style="position:absolute;left:13px;top:18%;color: rgba(255,255,255,0.26);
        font-size: 118px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" >“</p>
<img src="/resource/images/main/q_main.svg" width="100%">
</div>



<div id="myModal4" class="modal5">
<img src="/resource/images/main/ic_close_btn.svg" class="q_close" width="24" onclick="close_c2()" >
<div style="color: #fff;
        font-size: 18px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" class="q_title" width="100%">
<p style="margin:0"><span id="my_name1">ddd</span>님,</p>
	<p style="fill: #fff;">생년월일을 알려주세요</p>
</div>

<input type="text" id="date_text" class="date_text" placeholder="생년월일" 
maxlength="6" oninput="numberMaxLength(this);" onkeyup="birth_c()" style="border-bottom: 2px solid #FFFFFF;border-radius:0px; background:none; border-top:none; border-right:none; border-left:none; color:#FFFFFF; opacity:0.7; background-image:url('/resource/images/main/ic_check_disable.png'); 
        background-position:right 0px;background-repeat:no-repeat;">


<img src="/resource/images/main/btn_next.svg" class="btn_next" id="btn_next3" style="display:none;left:30%;" onclick="next_c4()">
<img src="/resource/images/main/btn_back.svg" class="btn_prev" id="btn_prev3"  onclick="prev_c3()" >

<img src="/resource/images/main/q_03_percent.svg" width="100%" class="percentage">

<p style="position:absolute;left:13px;top:18%;color: rgba(255,255,255,0.26);
        font-size: 118px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" >“</p>
<img src="/resource/images/main/q_main.svg" width="100%">
</div>


<div id="myModal5" class="modal6">
<img src="/resource/images/main/ic_close_btn.svg" class="q_close" width="24" onclick="close_c2()" >
<div style="color: #fff; font-size: 18px; font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR; font-weight: 500; letter-spacing: -0.02em;" class="q_title" width="100%">
<p style="margin:0"><span id="my_name2">ddd</span>님,</p>
	<p style="fill: #fff;">성별을 알려주세요</p>
</div>

<p class="gender" onclick="next2();" id="man"><input style="display:none;" type="radio" name="gender" id="gender_1" value="gender_1"><label class="uncheck_text" onclick="change_radio(this)" for="gender_1">남자</label></p>

<p style="top: 49%;" onclick="next2();" class="gender" id="woman"><input style="display:none;" type="radio" name="gender" id="gender_2" value="gender_2"><label class="uncheck_text" onclick="change_radio(this)" for="gender_2">여자</label></p>



<img src="/resource/images/main/btn_next.svg" class="btn_next" id="btn_next4" style="display:none;left:30%;" onclick="next_c5()">
<img src="/resource/images/main/btn_back.svg" class="btn_prev" id="btn_prev4"  onclick="prev_c4()" >

<img src="/resource/images/main/q_04_percent.svg" width="100%" class="percentage">

<p style="position:absolute;left:13px;top:18%;color: rgba(255,255,255,0.26);
        font-size: 118px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" >“</p>
<img src="/resource/images/main/q_main.svg" width="100%">
</div>



<div id="myModal6" class="modal7">
<img src="/resource/images/main/ic_close_btn.svg" class="q_close" width="24" onclick="close_c2()" >
<div style="color: #fff;
        font-size: 18px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" class="q_title" width="100%">
<p style="margin:0"><span id="my_name3">ddd</span>님,</p>
	<p style="fill: #fff;">자녀가 있으신가요?</p>
</div>

<p class="gender" id="man" onclick="next3();"><input style="display:none;" type="radio" name="child" id="child_1" value="child_1"><label class="uncheck_text" onclick="change_radio(this)" for="child_1">예.있어요.</label></p>

<p style="top: 49%;" class="gender" id="woman" onclick="next3();"><input style="display:none;" type="radio" name="child" id="child_2" value="child_2"><label class="uncheck_text" onclick="change_radio(this)" for="child_2">아니요.없습니다.</label></p>


<img src="/resource/images/main/btn_next.svg" class="btn_next" id="btn_next5" style="display:none;left:30%;" onclick="next_c6()">
<img src="/resource/images/main/btn_back.svg" class="btn_prev" id="btn_prev5"  onclick="prev_c5()" >

<img src="/resource/images/main/q_05_percent.svg" width="100%" class="percentage">

<p style="position:absolute;left:13px;top:18%;color: rgba(255,255,255,0.26);
        font-size: 118px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" >“</p>
<img src="/resource/images/main/q_main.svg" width="100%">
</div>



<div id="myModal7" class="modal8">
<div style="color: #fff;
        font-size: 18px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
		letter-spacing: -0.02em;" class="q_title" width="100%">
		<p>소중한 정보 감사합니다!</p>
<p style="margin:0">이제 <span id="my_name4">ddd</span>님에게 적합한</p>
	<p style="fill: #fff;">검진 기관을 찾아볼까요?</p>
</div>


<a href="/index.php/Mainset">
<button><img src="/resource/images/main/btn_start_2.svg" class="btn_main" id="btn_main"></button>
</a>


<p style="position:absolute;left:13px;top:18%;color: rgba(255,255,255,0.26);
        font-size: 118px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" >“</p>
<img src="/resource/images/main/q_main.svg" width="100%">
</div>







</div>



<script>
var start_btn = document.getElementsByClassName("start_btn");
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


var modal1 = document.getElementById("myModal");
var modal2 = document.getElementById("myModal2");
var modal3 = document.getElementById("myModal3");
var modal3 = document.getElementById("myModal3");
var modal4 = document.getElementById("myModal4");
var modal5 = document.getElementById("myModal5");
var modal6 = document.getElementById("myModal6");
var modal7 = document.getElementById("myModal7");

var alert_back = document.getElementById("alert_back");



var text;


</script>







</body>


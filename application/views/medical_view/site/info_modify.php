
	  
<body>

<div id="container3">
<div id="c_alert">
<img src="/resource/images/main/splash_esc.svg" onclick="close_esc()" class="c_btn" style="border-bottom-left-radius: 14px;">
<img src="/resource/images/main/splash_exit.svg" onclick="close_exit()" class="c_btn" style="border-bottom-right-radius: 14px;">
</div>

<!-- 메인 이미지 -->
        



<div id="myModal2" class="modal3" style="display:block;">
<img src="/resource/images/main/ic_back_white.svg" class="q_close" width="24" onclick="close_c()" >

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

<p style="top:46%;min-width:84px;" class="q_sub_title" onclick="next1();"><input style="display:none;" type="radio" name="yes2" id="yes_11" value="yes_11"><label id="yes_111" class="uncheck_text" onclick="change_radio(this)" for="yes_11">네.올해대상자에요.</label></p>

<p style="top:52%;min-width:42px;" class="q_sub_title" onclick="next1();"><input style="display:none;" type="radio" name="yes2" id="yes_22" value="yes_22"><label id="yes_222" class="uncheck_text" onclick="change_radio(this)" for="yes_22">아니요.모르겠어요.</label></p>





<p style="position:absolute;left:13px;top:18%;color: rgba(255,255,255,0.26);
        font-size: 118px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" >“</p>

<img src="/resource/images/app_main/btn_save_enable.svg" onclick="save1()" style="max-width:720px;width:100%;bottom:0;position: fixed;">

<img src="/resource/images/main/q_main.svg" width="100%">
</div>


<div id="myModal3" class="modal4">
<img src="/resource/images/main/ic_back_white.svg" class="q_close" width="24" onclick="close_c()" >
<div style="color: #fff;
        font-size: 18px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" class="q_title" width="100%">
<p style="margin:0">반갑습니다.</p>
	<p style="fill: #fff;">당신의 이름을 알려주세요</p>
</div>

<input type="text" name="name_text" id="name_text" class="name_text" placeholder="이름" onkeyup="name_c()" style="border-bottom: 2px solid #FFFFFF; background:none; border-top:none; border-right:none; border-left:none; color:#FFFFFF; opacity:0.7;background-image:url('/resource/images/main/ic_check_disable.png'); 
        background-position:right 0px;background-repeat:no-repeat;">



<p style="position:absolute;left:13px;top:18%;color: rgba(255,255,255,0.26);
        font-size: 118px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" >“</p>

<img src="/resource/images/app_main/btn_save_enable.svg" onclick="save2()" style="max-width:720px;width:100%;bottom:0;position: fixed;">
<img src="/resource/images/main/q_main.svg" width="100%">
</div>



<div id="myModal4" class="modal5">
<img src="/resource/images/main/ic_back_white.svg" class="q_close" width="24" onclick="close_c()" >
<div style="color: #fff;
        font-size: 18px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" class="q_title" width="100%">
<p style="margin:0"><span id="my_name1">ddd</span>님,</p>
	<p style="fill: #fff;">생년월일을 알려주세요</p>
</div>

<input type="text" id="date_text" class="date_text" placeholder="생년월일" 
maxlength="6" oninput="numberMaxLength(this);" onkeyup="birth_c()" style="border-bottom: 2px solid #FFFFFF; background:none; border-top:none; border-right:none; border-left:none; color:#FFFFFF; opacity:0.7; background-image:url('/resource/images/main/ic_check_disable.png'); 
        background-position:right 0px;background-repeat:no-repeat;">




<p style="position:absolute;left:13px;top:18%;color: rgba(255,255,255,0.26);
        font-size: 118px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" >“</p>
<img src="/resource/images/app_main/btn_save_enable.svg" onclick="save3()" style="max-width:720px;width:100%;bottom:0;position: fixed;">
<img src="/resource/images/main/q_main.svg" width="100%">
</div>


<div id="myModal5" class="modal6">
<img src="/resource/images/main/ic_back_white.svg" class="q_close" width="24" onclick="close_c()" >
<div style="color: #fff; font-size: 18px; font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR; font-weight: 500; letter-spacing: -0.02em;" class="q_title" width="100%">
<p style="margin:0"><span id="my_name2">ddd</span>님,</p>
	<p style="fill: #fff;">성별을 알려주세요</p>
</div>

<p class="gender" onclick="next2();" id="man"><input style="display:none;" type="radio" name="gender" id="gender_1" value="gender_1"><label id="gender_111" class="uncheck_text" onclick="change_radio(this)" for="gender_1">남자</label></p>

<p style="top: 49%;" onclick="next2();" class="gender" id="woman"><input style="display:none;" type="radio" name="gender" id="gender_2" value="gender_2"><label id="gender_222" class="uncheck_text" onclick="change_radio(this)" for="gender_2">여자</label></p>





<p style="position:absolute;left:13px;top:18%;color: rgba(255,255,255,0.26);
        font-size: 118px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" >“</p>
<img src="/resource/images/app_main/btn_save_enable.svg" onclick="save4()" style="max-width:720px;width:100%;bottom:0;position: fixed;">
<img src="/resource/images/main/q_main.svg" width="100%">
</div>



<div id="myModal6" class="modal7">
<img src="/resource/images/main/ic_back_white.svg" class="q_close" width="24" onclick="close_c()" >
<div style="color: #fff;
        font-size: 18px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" class="q_title" width="100%">
<p style="margin:0"><span id="my_name3">ddd</span>님,</p>
	<p style="fill: #fff;">자녀가 있으신가요?</p>
</div>

<p class="gender" id="man" onclick="next3();"><input style="display:none;" type="radio" name="child" id="child_1" value="child_1"><label id="child_111" class="uncheck_text" onclick="change_radio(this)" for="child_1">예.있어요.</label></p>

<p style="top: 49%;" class="gender" id="woman" onclick="next3();"><input style="display:none;" type="radio" name="child" id="child_2" value="child_2"><label id="child_222" class="uncheck_text" onclick="change_radio(this)" for="child_2">아니요.없습니다.</label></p>




<p style="position:absolute;left:13px;top:18%;color: rgba(255,255,255,0.26);
        font-size: 118px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;" >“</p>
<img src="/resource/images/app_main/btn_save_enable.svg" onclick="save5()" style="max-width:720px;width:100%;bottom:0;position: fixed;">
<img src="/resource/images/main/q_main.svg" width="100%">
</div>









</div>







<script>

var y = sessionStorage.getItem("yes");
var n = sessionStorage.getItem("name");
var g = sessionStorage.getItem("gender");
var b = sessionStorage.getItem("birth");
var c = sessionStorage.getItem("child");
var check = sessionStorage.getItem("yes_check");
	
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
var modal4 = document.getElementById("myModal4");
var modal5 = document.getElementById("myModal5");
var modal6 = document.getElementById("myModal6");
var modal7 = document.getElementById("myModal7");

var tt;
var text;

my_name.innerHTML = n;
my_name2.innerHTML = n;
my_name3.innerHTML = n;

// var label = $("input:radio[name=view]:checked").prop("labels");
var code = sessionStorage.getItem("code");

if(code == 1){
        modal2.style.display = "block";
      //  $('#yes22').prop('checked', true);
      if(y == "네.올해대상자에요."){
        $('#yes_111').addClass('check');    
      }
      else{
        $('#yes_222').addClass('check');    
      }
}
else if(code == 2){
        modal3.style.display = "block";
        document.getElementById("name_text").value = n;
}
else if(code == 3){
        modal4.style.display = "block";
        document.getElementById("date_text").value = b;
}
else if(code == 4){
        modal5.style.display = "block";
        if(g == "남자"){
        $('#gender_111').addClass('check');         
        }
        else{
        $('#gender_222').addClass('check');    
      }
}
else if(code == 5){
        modal6.style.display = "block";
        if(c == "예.있어요."){
        $('#child_111').addClass('check');         
        }
        else{
        $('#child_222').addClass('check');    
      }
}







</script>



</body>


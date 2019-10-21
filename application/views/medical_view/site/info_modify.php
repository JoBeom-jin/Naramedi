
<style>

radio input[type="radio"]{
	display:none;
}

/* radio input[type="radio"] + label{
	border:2px solid #A8A8AA;
	color:#A8A8AA;
	border-radius: 20px;
	font-weight: 400;
	padding:5px 10px 5px 10px;
	width: 95px;
	text-align: center;
}

radio input[type="radio"]:checked + label {
	border:2px solid #4E88C7;
	font-weight: bold;
	color:#4E88C7;
} */

#container {
    margin: 0 auto;
    max-width: 720px;
    -webkit-box-shadow: 0px 1px 4px 1px rgba(0,0,0,0.15);
    box-shadow: 0px 1px 4px 1px rgba(0,0,0,0.15);
	height: auto;
	position: relative;
	
}

.start_btn {
position: absolute;
left: 50%;
top: 85%;
max-width: 106px;
transform: translate( -50%, -50% );
 }

 #myModal, #myModal2, #myModal3, #myModal4, #myModal5, #myModal6, #myModal7 {
	position: absolute;
	top:0;
	margin: 0 auto;
	max-width: 720px;
	height: auto;
	display:none;
	width:100%
}



.gender {
		position: absolute;
		top: 41%;
		left: 15%;
        color: #fff;
        font-size: 14px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;
        
      }


.check { opacity: 1;color:white;}
		
.uncheck { opacity: 0.7}

label {opacity:0.7}


#c_alert { display:none; position: absolute; max-width: 720px; width:100%; z-index: 1000; margin-top:108px; height:186px; background-image:url('/resource/images/main/exit_alert.svg');background-position: center; background-reqeat:no-repeat;}
.q_close { position: absolute; margin: 16px; max-width: 48vw; }
.q_title { position: absolute; top: 27%; left: 13%; min-width: 212px;}
.q_sub_title { position: absolute; left: 13%; color:white;}
.btn_next { position: absolute; left: 10%; top: 60%; max-width: 104px; display: none;}
.btn_main { position: absolute; left:10%; top: 45%; min-width: 160px;}
.btn_prev { position: absolute; left:5%; top: 60%; max-width: 104px;}
.percentage {position:absolute; bottom:32px; max-width: 688px;margin:0 16px 0 16px; width:auto;}
.name_text { 
        position:absolute; top:50%; left:13%; max-width: 248px;
        color: #fff;
        font-size: 16px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;
        
 }
.date_text { 
        position:absolute; top:50%; left:13%; max-width: 248px; 
        color: #fff;
        font-size: 16px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;
        }
.splash_title { position:absolute; top:27%;left:25%;color:#fff;font-size:20px;font-family:Sandoll GongbyunggakPen, Sandoll GongbyunggakPen;font-weight:500;}

.c_btn {
        max-width:360px;
        float:left;
        margin-top:140px;
}
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	  
<body>

<div id="container">
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


var text;

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




function name_c() {

var name_textt = document.getElementById("name_text");
var name_text = document.getElementById("name_text").value;
if(name_text == ""){
        name_textt.style.opacity = 0.7;
        name_textt.style.backgroundImage = "url('/resource/images/main/ic_check_disable.png')";
}
else{
        name_textt.style.opacity = 1.0;
        name_textt.style.backgroundImage = "url('/resource/images/main/ic_check_enble.png')";
}
}

function close_c() {
c_alert.style.display = "block";
}




function close_esc() {
c_alert.style.display = "none";
}



function close_exit() {
c_alert.style.display = "none";
sessionStorage.setItem("message", 1); 
location.href='/index.php/Mainset';
}


function save1() {
        var label = $("input:radio[name=yes2]:checked").prop("labels");
        if($('input:radio[name=yes2]').is(':checked') == true){
        modal2.style.display = "none";
        sessionStorage.setItem("yes", $(label).text()); 
        sessionStorage.setItem("message", 1); 
        location.href='/index.php/Mainset';
        }
}


function save2() {
        var name_text = document.getElementById("name_text").value;
        if(name_text != ""){
        modal2.style.display = "none";
        sessionStorage.setItem("name", name_text); 
        sessionStorage.setItem("message", 1); 
        location.href='/index.php/Mainset';
        }
}

function save3() {
        var date_text = document.getElementById("date_text").value;
        if(date_text != ""){
        modal2.style.display = "none";
        sessionStorage.setItem("birth", date_text); 
        sessionStorage.setItem("message", 1); 
        location.href='/index.php/Mainset';
        }
}

function save4() {
        var label = $("input:radio[name=gender]:checked").prop("labels");
        if($('input:radio[name=gender]').is(':checked') == true){
        modal2.style.display = "none";
        sessionStorage.setItem("gender", $(label).text()); 
        sessionStorage.setItem("message", 1); 
        location.href='/index.php/Mainset';
        }
}

function save5() {
        var label = $("input:radio[name=child]:checked").prop("labels");
        if($('input:radio[name=child]').is(':checked') == true){
        modal2.style.display = "none";
        sessionStorage.setItem("child", $(label).text()); 
        sessionStorage.setItem("message", 1); 
        location.href='/index.php/Mainset';
        }
}







function birth_c() {

var date_text = document.getElementById("date_text").value;
if(date_text == ""){
        document.getElementById("date_text").style.opacity = 0.7;
        document.getElementById("date_text").style.backgroundImage = "url('/resource/images/main/ic_check_disable.png')";
}
else{
        document.getElementById("date_text").style.opacity = 1.0;
        document.getElementById("date_text").style.backgroundImage = "url('/resource/images/main/ic_check_enble.png')";
}
}



function change_radio(val){
		f_val = val
		get_name = document.getElementById(f_val.htmlFor).getAttribute('name')

		for (i = 0; i < document.getElementsByName(get_name).length ; i++) {
			get_id = document.getElementsByName(get_name)[i].getAttribute('id')
			$('label[for='+get_id+']').removeClass('check')
			$('label[for='+get_id+']').addClass('uncheck')
		}
		$(val).toggleClass("check")
		$(val).toggleClass("uncheck")
	}
	
// 1. 선택된 Radio 버튼의 값(value) 가져오기

// var st = $(":input:radio[name="+value+"]:checked").val();

// 2. Radio 버튼 값 설정(선택)하기

// $('input:radio[name=search_type]:input[value=' + st + ']').attr("checked", true);


function numberMaxLength(e){
        if(e.value.length > e.maxLength){
            e.value = e.value.slice(0, e.maxLength);
        }
    }



</script>



</body>


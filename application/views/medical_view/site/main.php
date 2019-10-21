<link href='http://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>

<style>



@font-face {
  font-family: NotoSansCJKkr-Medium;
  src: local(NotoSansCJKkr-Medium),
       local(NotoSansCJKkr-Medium),
       url(NotoSansCJKkr-Medium.eot?#iefix) format('embedded-opentype'),
       url(NotoSansCJKkr-Medium.woff) format('woff'),
       url(NotoSansCJKkr-Medium.ttf) format('truetype');
  font-style: normal;
  font-weight: normal;
  unicode-range: U+0-10FFFF;
}

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


#c_alert { display:none; position: absolute; max-width: 720px; width:100%; z-index: 1000; top:20%; height:240px; background-image:url('/resource/images/main/close_alert2.svg');background-position:center;background-repeat:no-repeat;}
#c_alert2 { display:none; position: absolute; max-width: 720px; width:100%; z-index: 1000; top:20%; height:240px; background-image:url('/resource/images/main/close_alert3.svg');background-position:center;background-repeat:no-repeat;border-bottom-left-radius: 14px;border-bottom-right-radius: 14px;}
#alert_back { display:none; position: absolute; max-width: 720px; width:100%; z-index: 999; height:100%; }
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
        margin-top:192px;
}
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	  
<body>

<div id="container">

<img id="alert_back" src="/resource/images/main/nemo.svg">

<div id="c_alert">
<img src="/resource/images/main/splash_esc.svg" onclick="close_esc()" class="c_btn" style="border-bottom-left-radius: 14px;margin-left: 26px;">
<img src="/resource/images/main/splash_exit.svg" onclick="close_exit()" class="c_btn" style="border-bottom-right-radius: 14px;">
</div>

<div id="c_alert2">
<img src="/resource/images/main/splash_esc.svg" onclick="close_esc2()" class="c_btn" style="border-bottom-left-radius: 14px;margin-left: 26px;">
<img src="/resource/images/main/splash_exit.svg" onclick="close_exit2()" class="c_btn" style="border-bottom-right-radius: 14px;">
</div>
<!-- 메인 이미지 -->
        <img src="/resource/images/main/splash_title2.png" class="splash_title">        
	<img src="/resource/images/main/splash3.svg" width="100%" height="100%">
	<button class="start_btn" type="button" onclick="start_c()">
		<img src="/resource/images/main/start_btn.svg" width="106px" height="40px">
	</button>

<div id="myModal" class="modal2">

<img src="/resource/images/main/ic_close_btn.svg" class="q_close" width="24" onclick="close_c()" >
<img src="/resource/images/main/q_00_title.svg" class="q_title" width="100%" style="max-width:212px;">

<!-- <img src="/resource/images/main/q_00_yes.svg" style="top:43%;max-width:84px;" class="q_sub_title" width="100%">
<img src="/resource/images/main/q_00_no.svg" style="top:48%;max-width:42px;"  onclick="next();" class="q_sub_title" width="100%"> -->

<p style="top:46%;min-width:84px;opacity:1;" class="q_sub_title" onclick="next();"><input style="display:none;" type="radio" name="yes" id="yes_1" value="yes_1"><label class="uncheck_text" onclick="change_radio(this)" for="yes_1">네.예약했어요.</label></p>

<p style="top:52%;min-width:42px;opacity:1;" class="q_sub_title" onclick="next();"><input style="display:none;" type="radio" name="yes" id="yes_2" value="yes_2"><label class="uncheck_text" onclick="change_radio(this)" for="yes_2">아니요.</label></p>

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

<input type="text" name="name_text" id="name_text" class="name_text" placeholder="이름" onkeyup="name_c()" style="border-bottom: 2px solid #FFFFFF; background:none; border-top:none; border-right:none; border-left:none; color:#FFFFFF; opacity:0.7;background-image:url('/resource/images/main/ic_check_disable.png'); 
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
maxlength="6" oninput="numberMaxLength(this);" onkeyup="birth_c()" style="border-bottom: 2px solid #FFFFFF; background:none; border-top:none; border-right:none; border-left:none; color:#FFFFFF; opacity:0.7; background-image:url('/resource/images/main/ic_check_disable.png'); 
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
var modal4 = document.getElementById("myModal4");
var modal5 = document.getElementById("myModal5");
var modal6 = document.getElementById("myModal6");
var modal7 = document.getElementById("myModal7");

var alert_back = document.getElementById("alert_back");



var text;

// var label = $("input:radio[name=view]:checked").prop("labels");



function start_c() {
modal1.style.display = "block";

}

function next_c1() {
modal1.style.display = "none";
modal2.style.display = "block";
}

function next_c2() {
var label = $("input:radio[name=yes2]:checked").prop("labels");
var check_id = $('input[name="yes2"]:checked').attr('id');
modal2.style.display = "none";
modal3.style.display = "block";
sessionStorage.setItem("yes", $(label).text());
sessionStorage.setItem("yes_check", check_id);
}

function next_c3() {


var name_text = document.getElementById("name_text").value;
modal3.style.display = "none";

modal4.style.display = "block";
text = name_text;
my_name.innerHTML = text ;
sessionStorage.setItem("name", text);
}

function next_c4() {
var date_text = document.getElementById("date_text").value;
modal4.style.display = "none";
modal5.style.display = "block";
my_name2.innerHTML = text ;
sessionStorage.setItem("birth", date_text);
}

function next_c5() {

var label = $("input:radio[name=gender]:checked").prop("labels");

// var gender = document.getElementsByName('gender');
// var gender_check;
// for(var i=0; i<gender.length; i++) {
//     if(gender[i].checked) {
//         gender_check = gender[i].value;
//     }
// }
modal5.style.display = "none";
modal6.style.display = "block";
my_name3.innerHTML = text ;
sessionStorage.setItem("gender", $(label).text());
}

function next_c6() {
var label = $("input:radio[name=child]:checked").prop("labels");

modal6.style.display = "none";
modal7.style.display = "block";
my_name4.innerHTML = text ;
sessionStorage.setItem("child", $(label).text());


}





function prev_c1() {
modal2.style.display = "none";
modal1.style.display = "block";
}

function prev_c2() {
modal3.style.display = "none";
modal2.style.display = "block";
}

function prev_c3() {
modal4.style.display = "none";
modal3.style.display = "block";
}

function prev_c4() {
modal5.style.display = "none";
modal4.style.display = "block";
}

function prev_c5() {
modal6.style.display = "none";
modal5.style.display = "block";
}




function next() {

var select1 = document.getElementById('yes_1');
var select2 = document.getElementById('yes_2');

if(select2.checked == true){
	btn_next.style.display = "block";
        
}
else{
	btn_next.style.display = "none";
}


}


function next1() {

var select1 = document.getElementById('yes_11');
var select2 = document.getElementById('yes_22');

if(select2.checked == true || select1.checked == true){
	btn_next1.style.display = "block";
}
else{
	btn_next1.style.display = "none";
}


}


function next2() {

var select1 = document.getElementById('gender_1');
var select2 = document.getElementById('gender_2');

if(select2.checked == true || select1.checked == true){
	btn_next4.style.display = "block";
}
else{
	btn_next4.style.display = "none";
}


}



function next3() {

var select1 = document.getElementById('child_1');
var select2 = document.getElementById('child_2');

if(select2.checked == true || select1.checked == true){
	btn_next5.style.display = "block";
}
else{
	btn_next5.style.display = "none";
}


}

function name_c() {

var name_textt = document.getElementById("name_text");
var name_text = document.getElementById("name_text").value;
if(name_text == ""){
        btn_next2.style.display = "none";
        name_textt.style.opacity = 0.7;
        name_textt.style.backgroundImage = "url('/resource/images/main/ic_check_disable.png')";
}
else{
        btn_next2.style.display = "block";
        name_textt.style.opacity = 1.0;
        name_textt.style.backgroundImage = "url('/resource/images/main/ic_check_enble.png')";
}
}

function close_c() {
c_alert.style.display = "block";
alert_back.style.display = "block";
}


function close_c2() {
c_alert2.style.display = "block";
alert_back.style.display = "block";
}

function close_esc() {
c_alert.style.display = "none";
alert_back.style.display = "none";
}


function close_esc2() {
c_alert2.style.display = "none";
alert_back.style.display = "none";
}


function close_exit() {
c_alert.style.display = "none";
alert_back.style.display = "none";
window.location.reload();
}


function close_exit2() {
c_alert2.style.display = "none";
alert_back.style.display = "none";
window.location.reload();
}




function birth_c() {

var date_text = document.getElementById("date_text").value;
if(date_text == ""){
        btn_next3.style.display = "none";
        document.getElementById("date_text").style.opacity = 0.7;
        document.getElementById("date_text").style.backgroundImage = "url('/resource/images/main/ic_check_disable.png')";
}
else{
        btn_next3.style.display = "block";
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


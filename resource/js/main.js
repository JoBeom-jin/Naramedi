
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

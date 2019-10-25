// var label = $("input:radio[name=view]:checked").prop("labels");


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


var start_btn = document.getElementsByClassName("start_btn");
function start_c() {
	container1.style.display = "none";
	container2.style.display = "block";
	
	}
	
	function next_c1() {
	container2.style.display = "none";
	container3.style.display = "block";
	}

function next_c1_1() {
	container2.style.display = "none";
	container2_1.style.display = "block";
	}
		
	function next_c1_2() {
	container2_1.style.display = "none";
	container2_2.style.display = "block";
	}
	
	function next_c2() {
	var label = $("input:radio[name=yes2]:checked").prop("labels");
	var check_id = $('input[name="yes2"]:checked').attr('id');
	container3.style.display = "none";
	container4.style.display = "block";
	sessionStorage.setItem("yes", $(label).text());
	sessionStorage.setItem("yes_check", check_id);
	}
	
	function next_c3() {
	var name_text = document.getElementById("name_text").value;
	container4.style.display = "none";
	container5.style.display = "block";
	text = name_text;
	my_name.innerHTML = text ;
	sessionStorage.setItem("name", text);
	}
	
	function next_c4() {
	var date_text = document.getElementById("date_text").value;
	container5.style.display = "none";
	container6.style.display = "block";
	my_name2.innerHTML = text ;
	sessionStorage.setItem("date", date_text);
	}
	
	function next_c5() {
	
	var label = $("input:radio[name=gender]:checked").prop("labels");
	container6.style.display = "none";
	container7.style.display = "block";
	my_name3.innerHTML = text ;
	sessionStorage.setItem("gender", $(label).text());
	}
	
	function next_c6() {
	var label = $("input:radio[name=child]:checked").prop("labels");
	container7.style.display = "none";
	container8.style.display = "block";
	my_name4.innerHTML = text ;
	sessionStorage.setItem("child", $(label).text());
	
	
	}
	
	
	
	
	
	function prev_c1() {
	container3.style.display = "none";
	container2.style.display = "block";
	}
	
	function prev_c2() {
	container4.style.display = "none";
	container3.style.display = "block";
	}
	
	function prev_c3() {
	container5.style.display = "none";
	container4.style.display = "block";
	}
	
	function prev_c4() {
	container6.style.display = "none";
	container5.style.display = "block";
	}
	
	function prev_c5() {
	container7.style.display = "none";
	container6.style.display = "block";
	}
	
	
	
	
	function next()	 {
	
	var select1 = document.getElementById('yes_1');
	var select2 = document.getElementById('yes_2');
	
	if(select2.checked == true){
		next_btn.style.display = "block";
			
	}
	else{
		next_btn_1.style.display = "none";
	}
	
	
	}
	function next_1()	 {

		var select1 = document.getElementById('yes_1');
		var select2 = document.getElementById('yes_2');
		
		if(select1.checked == true){
			next_btn_1.style.display = "block";
				
		}
		else{
			next_btn.style.display = "none";
		}
		
		
		}
	
	
	function next1() {
	
	var select1 = document.getElementById('yes_11');
	var select2 = document.getElementById('yes_22');
	
	if(select2.checked == true || select1.checked == true){
		next_btn1.style.display = "block";
	}	
	else{
		next_btn1.style.display = "none";
	}
	
	
	}
	
	
	function next2() {
	
	var select1 = document.getElementById('gender_1');
	var select2 = document.getElementById('gender_2');
	
	if(select2.checked == true || select1.checked == true){
		next_btn4.style.display = "block";
	}
	else{
		next_btn4.style.display = "none";
	}
	
	
	}
	
	
	
	function next3() {
	
	var select1 = document.getElementById('child_1');
	var select2 = document.getElementById('child_2');
	
	if(select2.checked == true || select1.checked == true){
		next_btn5.style.display = "block";
	}
	else{
		next_btn5.style.display = "none";
	}
	
	
	}
	
	function name_c() {
	
	var name_textt = document.getElementById("name_text");
	var name_text = document.getElementById("name_text").value;
	if(name_text == ""){
			next_btn2.style.display = "none";
			name_textt.style.opacity = 0.7;
			name_textt.style.backgroundImage = "url('/resource/images/main/ic_check_disable.png')";
	}
	else{
			next_btn2.style.display = "block";
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
				next_btn3.style.display = "none";
				document.getElementById("date_text").style.opacity = 0.6;
				document.getElementById("date_text").style.backgroundImage = "url('/resource/images/main/ic_check_disable.png')";
		}
		else{
				next_btn3.style.display = "block";
				document.getElementById("date_text").style.opacity = 1.0;
				document.getElementById("date_text").style.backgroundImage = "url('/resource/images/main/ic_check_enble.png')";
		}
		}
		
		function birth_c1() {
		
		var date_text = document.getElementById("date_text1").value;
		if(date_text == ""){
				next_btn3.style.display = "none";
				document.getElementById("date_text1").style.opacity = 0.6;
				document.getElementById("date_text1").style.backgroundImage = "url('/resource/images/main/ic_check_disable.png')";
		}
		else{
				next_btn3.style.display = "block";
				document.getElementById("date_text1").style.opacity = 1.0;
				document.getElementById("date_text1").style.backgroundImage = "url('/resource/images/main/ic_check_enble.png')";
		}
		}
		function birth_c2() {
		
		var date_text = document.getElementById("date_text2").value;
		if(date_text == ""){
				next_btn3.style.display = "none";
				document.getElementById("date_text2").style.opacity = 0.6;
				document.getElementById("date_text2").style.backgroundImage = "url('/resource/images/main/ic_check_disable.png')";
		}
		else{
				next_btn3.style.display = "block";
				document.getElementById("date_text2").style.opacity = 1.0;
				document.getElementById("date_text2").style.backgroundImage = "url('/resource/images/main/ic_check_enble.png')";
		}
		}
		function birth_c3() {
		
		var date_text = document.getElementById("date_text3").value;
		if(date_text == ""){
				next_btn3.style.display = "none";
				document.getElementById("date_text3").style.opacity = 0.6;
				document.getElementById("date_text3").style.backgroundImage = "url('/resource/images/main/ic_check_disable.png')";
		}
		else{
				next_btn3.style.display = "block";
				document.getElementById("date_text3").style.opacity = 1.0;
				document.getElementById("date_text3").style.backgroundImage = "url('/resource/images/main/ic_check_enble.png')";
		}
		}
		
		function birth_c4() {
		
		var date_text = document.getElementById("date_text4").value;
		if(date_text == ""){
				next_btn3.style.display = "none";
				document.getElementById("date_text4").style.opacity = 0.6;
				document.getElementById("date_text4").style.backgroundImage = "url('/resource/images/main/ic_check_disable.png')";
		}
		else{
				next_btn3.style.display = "block";
				document.getElementById("date_text4").style.opacity = 0.8;
				document.getElementById("date_text4").style.backgroundImage = "url('/resource/images/main/ic_check_enble.png')";
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

// var label = $("input:radio[name=view]:checked").prop("labels");

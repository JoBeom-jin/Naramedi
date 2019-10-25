function btn_c() {
	var search_box = document.getElementById("search_box");
	var btn_img = document.getElementById("btn_img");
	if (search_box.style.display === "none") {
		  search_box.style.display = "block";
		  btn_img.style.position="static";
		  btn_img.src = "/resource/images/hospital/btn_click.svg";
	} else {
		  search_box.style.display = "none";
		  btn_img.style.position="fixed";
		  btn_img.src = "/resource/images/hospital/btn_navigation.svg";
	}
  }
  
  function open_search() {
	var hospital_search = document.getElementById("hospital_search_box");
	
	
	hospital_search.style.display = "block";
	my_modal.style.display = "none";
		  
  }
  
  
  function close_search() {
	var hospital_search = document.getElementById("hospital_search_box");
	
	
	hospital_search.style.display = "none";
	my_modal.style.display = "block";
		  
  }
  
  
  function clear_text() {
  var typing_text = document.getElementById("hospital_searchbar").value;
  var clear_btn = document.getElementById("clear_btn");
  if(typing_text == ""){
		  document.getElementById("hospital_searchbar").style.backgroundImage = "url('/resource/images/hospital/searchbar.svg')";
		  clear_btn.style.display="none";
  }
  else{
		  document.getElementById("hospital_searchbar").style.backgroundImage = "url('/resource/images/hospital/typing_text.svg')";
		  clear_btn.style.display="block";
  }
  }
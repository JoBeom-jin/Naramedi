<style>
#container {
    margin: 0 auto;
    max-width: 720px;
	height: auto;
	position: relative;
	
}

.main_title {
    color: #111;
    font-size: 18px;
    font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
    font-weight: 500;
    max-width:160px;
    width:160px;
    margin: 16px 0 17px 16px;
}


.card_title {
    color:#111;
    font-size:16px;
    font-family:NotoSansCJKkr-Regular, Noto Sans CJK KR; 
    letter-spacing:-0.02em;
    margin-bottom:24px;
    padding:0;
}

.card_sub_title {
    color:#707070;
    font-size:12px;
    font-family:NotoSansCJKkr-Regular, Noto Sans CJK KR; 
    letter-spacing:-0.02em;
    margin:0;
    width:auto;
    padding:0;
}

.main_slide {
        display:inline-block;
        white-space:nowrap;
        max-width: 720px;
        width: 100%;      
}

.box {display:inline-block;}

.btn_text {
        color: #111;
        font-size: 12px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
}

.row {max-width:720px;}



#wrapper
{
	text-align: center;
	width: 500px;
	margin: auto;
}

.scrollbar
{
	margin-left: 16px;
	overflow-x: scroll;
        margin-right:16px;
}

.force-overflow
{
	max-width:720px;
}

#style-2::-webkit-scrollbar-track
{
	width: 328px;
    height: 8px;
    border-radius:4px;
    background-color : rgb(241, 241, 241);
}

#style-2::-webkit-scrollbar
{
        width: 66px;
        height:8px;
        border-radius:4px;
	background-color: #F5F5F5;
}

#style-2::-webkit-scrollbar-thumb
{
    width: 66px;
    height: 8px;
    border-radius:4px;
    background-color: rgb(0, 167, 175);
}

#my_modal, #hospital_search_box {
        position: relative;
        margin: 0 auto;
        top:0;
	max-width: 720px;
	height: ;
        width:100%;
        z-index:99;
        background:white;
}

.profile_title {
        position:absolute;
        top:48px;
        left:75px;
        color: #fff;
        font-size: 14px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        letter-spacing: -0.02em;
}

.menu {padding:0;}

.menu li {
        list-style:none;
        padding-top:22px;
        padding-bottom:22px;
        padding-left:16px;
        border-bottom:1px solid #F1F1F1;

        color: #111;
        font-size: 14px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
}

.box img {margin-right:10.3px}

.main_menu { display:inline-block;}

.content_title {
        color: #111;
        font-size: 16px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        font-weight: 500;
        margin-left:16px;
        margin-bottom:0;
}

.content_info {
        display:inline-block;
        background-image:url('/resource/images/app_main/content_back.svg');
        background-repeat: no-repeat;
        background-size: 300px 280px;
        max-width:720px;
        width:300px;
        height:280px;
        margin-right:18px;
}


.content_info_title {
        color: #111;
        font-size: 16px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
}

.info_sub_title {
        color: #111;
        font-size: 16px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
}

.hi_textbox {
        color: #707070;
        font-size: 12px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
        margin-left:16px;
        max-width:720px;
        height:20px;
}


.info_textbox {
        color: #707070;
        font-size: 14px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
        margin-left:16px;
        margin-right:16px;
}

.span_text {
        color: #b1b1b1;
        font-size: 14px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
}

.my li {
        list-style:none;
        padding-top:22px;
        padding-bottom:22px;
        border-bottom:1px solid #F1F1F1;
}

.my1 li {
        list-style:none;
        padding-top:22px;
        padding-bottom:22px;
}


.info_label {
        color: #111;
        font-size: 16px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
}

.info_gps {
        position:absolute;
        left:71px;
        top:68px;
        color: #fff;
        font-size: 10px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
}

.noto_font {
        font-size: 16px;
        font-family: NotoSansCJKkr-Medium, Noto Sans CJK KR;
        margin-bottom:10px;
        
}


.my_modal4_content {
        border:1px solid #F1F1F1;
        height:159px;
        max-width:720px;
        margin-bottom:10px;
}

.my_modal4_wrap {
        border-bottom:1px solid #F1F1F1;
        height:120px;
        max-width:720px;
}

.my_modal4_textbox {
        padding:13px;
        float:left;
}

.my_modal4_btn {
    max-width: 720px;
    position: absolute;
    width: 100%;
    height: 34px;
}

.btn_group {
        text-align: center;
        max-width:360px;
        width:49%;
        height:32px;
        float:left;
        margin-top:5px;
}


.search_box {
    height: 85%;
    position: fixed;
    background: white;
    max-width: 720px;
    bottom: 0;
    width: 100%;
}

.hospital_searchbar::placeholder {
        color: #DBDBDB;
}

.hospital_searchbar {
        background-image:url('/resource/images/hospital/searchbar.svg'); 
        background-position:center;
        background-repeat:no-repeat;
        border:none;
        max-width: 328px;
        width: 100%;
        height: 40px;
        padding-left: 26px;
        font-size: 12px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
        margin-left:16px;
        margin-top:20px;
}


.hos_info_content {
        max-width:720px;
        width:100%;
        height:150px;
        padding: 18px 0px 23px 16px;
        border-bottom: 1px solid #F1F1F1;
}

.info_title{
        font-size: 10px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
        margin-bottom: 13px;

}

.info_title2{
        font-size: 16px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
        margin-bottom: 8px;

}

.info_sub {
        font-size: 14px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
        margin-bottom: 11px;
        color:#707070;
}

.hos_info_1 {
        padding : 17px 16px 31px 16px;
        border-bottom: 1px solid #F1F1F1;
}

.font_16 {
        font-size: 16px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
}

</style>
	  
<body>




        <div id="my_modal">
                <div class="info_head"  style="max-width:720px; width:100%;height:48px;border-bottom:1px solid #F1F1F1;">

                        <a href="/index.php/Mainset"><img src="/resource/images/app_main/ic_arrow.svg" style="position:absolute;left:16px;top:12px;"></a>
                        
                        <p class="info_sub_title" style="position:absolute;left:72px; top:12px;width:130px;text-overflow: ellipsis;white-space: nowrap;overflow:hidden;">병원 이름~~aaaaaaaaaa~</p>

                        <img src="/resource/images/hospital_info/ic_bookmark_black.svg" style="float:right;margin-top:12px; margin-right:16px;width: 26px;height: 26px;">

                        <img src="/resource/images/hospital_info/ic_share_black.svg" style="float:right;margin-top:12px; margin-right:16px;">

                        
                </div>

                
                


                <img src="/resource/images/hospital_info/info_default.svg" id="btn_img" style="max-width:720px;width:100%;">


                <div class="hos_info_content">
                        <p class="info_title"><img src="/resource/images/hospital_info/info_logo.svg"> | <span>의원</span> </p>
                        <p class="info_title2">(사)정해복지 한신메디피아</p>
                        <p class="info_sub">서울시 서초구 잠원로 94 한신공영빌딩 2층,3층</p>  

                </div>

                <div class="hos_info_middle row" style="padding: 5px 44px 5px 44px; border-bottom: 1px solid #F1F1F1;">
                        <img src="/resource/images/hospital_info/link_navigation.svg" style="display:inline;" class="col-4">
                        <img src="/resource/images/hospital_info/link_taxi.svg" style="display:inline;" class="col-4">
                        <img src="/resource/images/hospital_info/link_map.svg" style="display:inline;" class="col-4">
                </div>

                <div class="hos_info_1">
                        <p class="font_16" style="margin-bottom:16px;">기본정보</p>
                        <p class="font_16" style="color:#707070; font-size:12px;">설립구분<span class="font_16" style="font-size:14px;margin-left:28px;">사단법인</span></p>
                        <p class="font_16" style="color:#707070; font-size:12px;">전문의<span class="font_16" style="font-size:14px;margin-left:38px;">15명</span></p>
                        <p class="font_16" style="color:#707070; font-size:12px;">진료과목<span class="font_16" style="font-size:14px;margin-left:28px;width:227px">가정의학과, 내과, 안과, 영상의학과, 
일반의, 직업환경의학과, 진단검사의학과</span></p>
                </div>

                


                
                <div style="max-width:720px;width:100%;position:fixed;bottom:0;">
                <img src="/resource/images/hospital_info/btn_call.svg" style="float:left;">
                <img src="/resource/images/hospital_info/btn_counsel.svg" style="float:left;">
                </div>


        </div>


         <!-- <div id="hospital_search_box" style="display:none;">
                <div class="info_head"  style="max-width:720px; width:100%;height:48px;border-bottom:1px solid #F1F1F1;">

                        <img onclick="close_search()" src="/resource/images/app_main/ic_arrow.svg" style="position:absolute;left:16px;top:12px;">
                        
                        <p class="info_sub_title" style="position:absolute;left:72px; top:12px;">직접검색</p>
                </div>

                <input type="text" onkeyup="clear_text()" placeholder="병원명을 입력해 주세요." class="hospital_searchbar" id="hospital_searchbar" />
                <img onclick="document.getElementById('hospital_searchbar').value= '';" src="/resource/images/hospital/ic_clear.svg" id="clear_btn" style="position:absolute;right:30px;top:76px;display:none">


                


        </div> -->





<script>

var modalbox = document.getElementById("my_modal");

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



        



</script>



</body>


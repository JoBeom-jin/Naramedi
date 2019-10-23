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
	height: 100%;
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
        color: #707070;
        font-size: 12px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
        margin-left:16px;
        margin-top:20px;
}

.tab_view {
        max-width:360px;
        width:50%;
        height:48px;
        text-align:center;
        float:left;
        padding:14px 0px 14px 0px;

        color:#707070;
        font-size: 14px;
        font-family: NotoSansCJKkr-Regular, Noto Sans CJK KR;
        letter-spacing: -0.02em;
}

.tab_group {
        max-width:720px;
        width:100%;
        height:48px;
        border-bottom: 1px solid #F1F1F1;
}


</style>
	  
<body>




        <div id="my_modal">
                <div class="info_head"  style="max-width:720px; width:100%;height:48px;border-bottom:1px solid #F1F1F1;">

                        <a href="/index.php/Mainset"><img src="/resource/images/app_main/ic_arrow.svg" style="position:absolute;left:16px;top:12px;"></a>
                        
                        <p class="info_sub_title" style="position:absolute;left:72px; top:12px;width:198px;text-overflow: ellipsis;white-space: nowrap;overflow:hidden;" onclick="open_tab()">일반검진/서울특별시 서초구 잠원동</p>

                </div>

                <div style="float:right;margin-right:16px;">
                <img src="/resource/images/hospital_info/floating_location.svg" style="float:right;">
                <img src="/resource/images/hospital_info/floating_fillter.svg" style="float:right;">
                </div>               



                <img src="/resource/images/hospital/btn_navigation.svg" id="btn_img" style="max-width:720px;width:100%;bottom:0;position: fixed;" onclick="btn_c()">


                <div id="search_box" class="search_box" style="display:none;">

                <div class="my_modal4_content">
                                <div class="my_modal4_wrap">
                                <img src="/resource/images/app_main/default_img.svg" style="float:left">
                                <div class="my_modal4_textbox">
                                        <p class="noto_font">(사)정해복지 한신메디피아</p>
                                        <img src="/resource/images/app_main/ic_location_balck.svg" style="float:left">
                                        <p class="noto_font" style="font-size:12px;overflow:hidden"> <span>1.0km</span> | <span>서울시 서초구 잠원로 24...</span> </p>
                                        <p class="noto_font" style="font-size:12px;overflow:hidden"> <span>진료시간</span> | <span>am 08:00~ pm 04:00</span> </p>
                                </div>
                                </div>
                                <div class="my_modal4_btn">

                                <div class="btn_group">
                                <img src="/resource/images/app_main/call_btn.svg" >
                                </div>
                                <span style="float:left;color:#F1F1F1;margin-top:5px">|</span>
                                <div class="btn_group">
                                <img src="/resource/images/app_main/road_btn.svg">
                                </div>

                                </div>
                        </div>

                </div>


        </div>


        <div id="hospital_search_box" style="display:none;">
                <div class="info_head"  style="max-width:720px; width:100%;height:48px;border-bottom:1px solid #F1F1F1;">

                        <img onclick="close_tab()" src="/resource/images/app_main/ic_arrow.svg" style="position:absolute;left:16px;top:12px;">
                        
                        <p class="info_sub_title" style="position:absolute;left:72px; top:12px;">일반검진</p>
                </div>

                <div class="tab_group">
                <div class="tab_view" id="tab_view1" style="border-bottom:1px solid #00A7AF;">검진선택</div>
                <div class="tab_view" id="tab_view2">위치선택</div>
                </div>


                


        </div>


        



<script>

var modalbox = document.getElementById("my_modal");



function tab_click() {
var tab1 = document.getElementById("tab_view1");
var tab2 = document.getElementById("tab_view2");


}


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

function open_tab() {
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


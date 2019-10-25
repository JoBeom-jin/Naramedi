
	  
<body>




        <div id="my_modal">
                <div class="info_head"  style="max-width:720px; width:100%;height:48px;border-bottom:1px solid #F1F1F1;">

                        <a href="/index.php/Mainset"><img src="/resource/images/app_main/ic_arrow.svg" style="position:absolute;left:16px;top:12px;"></a>
                        
                        <p class="info_sub_title" style="position:absolute;left:72px; top:12px;width:198px;text-overflow: ellipsis;white-space: nowrap;overflow:hidden;" onclick="open_tab()">일반검진/서울특별시 서초구 잠원동</p>

                        <img src="/resource/images/hospital/ic_search_gray.svg" style="float:right;margin-top:12px; margin-right:16px;" onclick="open_search()">

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

                        <img src="/resource/images/hospital/ic_search_gray.svg" style="float:right;margin-top:12px; margin-right:16px;" onclick="open_search()">
                </div>

                <div class="tab_group">
                <div class="tab_view" id="tab_view1" onclick="tab_click1()" style="border-bottom:1px solid #00A7AF;">검진선택</div>
                <div class="tab_view" id="tab_view2" onclick="tab_click2()">위치선택</div>
                </div>

                <div class="btn_group" id="btn_group1" style="padding: 20px 16px 0px 16px;">
                                <div class="btn_wrap">
                                <img src="/resource/images/category_map/all_btn.svg">
                                </div>

                                <div class="btn_wrap">
                                <img src="/resource/images/category_map/btn_01.svg">
                                </div>

                                <div class="btn_wrap">
                                <img src="/resource/images/category_map/btn_02.svg">
                                </div>


                                <div class="btn_wrap">
                                <img src="/resource/images/category_map/btn_03.svg">
                                </div>

                                <div class="btn_wrap">
                                <img src="/resource/images/category_map/btn_04.svg">
                                </div>

                                <div class="btn_wrap">
                                <img src="/resource/images/category_map/btn_05.svg">
                                </div>
                                


                                <div class="btn_wrap">
                                <img src="/resource/images/category_map/btn_06.svg">
                                </div>

                                <div class="btn_wrap">
                                <img src="/resource/images/category_map/btn_07.svg">
                                </div>

                                <div class="btn_wrap">
                                <img src="/resource/images/category_map/btn_08.svg">
                                </div>



                                <div class="btn_wrap">
                                <img src="/resource/images/category_map/btn_09.svg">
                                </div>

                                <div class="btn_wrap">
                                <img src="/resource/images/category_map/btn_10.svg">
                                </div>

                                <div class="btn_wrap">
                                <img src="/resource/images/category_map/btn_11.svg">
                                </div>



                                <div class="btn_wrap">
                                <img src="/resource/images/category_map/btn_12.svg">
                                </div>

                                <div class="btn_wrap" style="background: #F1F1F1;">
                                <img src="/resource/images/category_map/logo_symbol.svg">
                                </div>

                                <div class="btn_wrap" style="background: #F1F1F1;">
                                <img src="/resource/images/category_map/logo_symbol.svg">
                                </div>
                                
                </div>




                <div class="btn_group" id="btn_group2" style="text-align: left;display:none;">

                <input type="text" onkeyup="clear_text()" placeholder="지역, 주소, 지하철역으로 검색해 주세요." class="hospital_searchbar" id="hospital_searchbar" style="caret-color:#00A7AF;" />
                <img onclick="document.getElementById('hospital_searchbar').value= '';" src="/resource/images/hospital/ic_clear.svg" id="clear_btn" style="position:absolute;right:30px;top:76px;display:none">

                <div class="font_noto" style="margin-left:48px;">내 위치에서 찾기</div>
                                
                <div style="max-width:720px; background-color:#F1F1F1;height:430px;padding-left:19px;padding-top:19px;">
                <p class="font_noto" style="margin:0;">내 주변 가까운 지하철역</p>        
                </div>

                </div>


                <img src="/resource/images/category_map/btn_03.svg">


        </div>


        



<script>

var modalbox = document.getElementById("my_modal");
var btn_group1 = document.getElementById("btn_group1");
var btn_group2 = document.getElementById("btn_group2");

var tab1 = document.getElementById("tab_view1");
var tab2 = document.getElementById("tab_view2");






        



</script>



</body>


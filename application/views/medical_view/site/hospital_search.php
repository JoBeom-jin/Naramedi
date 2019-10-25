
	  
<body>




        <div id="my_modal">
                <div class="info_head"  style="max-width:720px; width:100%;height:48px;border-bottom:1px solid #F1F1F1;">

                        <a href="/index.php/Mainset"><img src="/resource/images/app_main/ic_arrow.svg" style="position:absolute;left:16px;top:12px;"></a>
                        
                        <p class="info_sub_title" style="position:absolute;left:72px; top:12px;">병원 찾기</p>

                        <img src="/resource/images/hospital/ic_search_gray.svg" style="float:right;margin-top:12px; margin-right:16px;" onclick="open_search()">
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

                        <img onclick="close_search()" src="/resource/images/app_main/ic_arrow.svg" style="position:absolute;left:16px;top:12px;">
                        
                        <p class="info_sub_title" style="position:absolute;left:72px; top:12px;">직접검색</p>
                </div>

                <input type="text" onkeyup="clear_text()" placeholder="병원명을 입력해 주세요." class="hospital_searchbar" id="hospital_searchbar" style="caret-color:#00A7AF;" />
                <img onclick="document.getElementById('hospital_searchbar').value= '';" src="/resource/images/hospital/ic_clear.svg" id="clear_btn" style="position:absolute;right:30px;top:76px;display:none">


                


        </div>


        <!-- <div id="my_modal2">
                <div class="info_head"  style="max-width:720px; width:100%;height:48px;margin-bottom:24px;">

                        <img src="/resource/images/app_main/ic_arrow.svg" style="position:absolute;left:16px;top:12px;" onclick="close_menu2()">
                        
                        <p class="info_sub_title" style="position:absolute;left:72px; top:12px;">간편 문진 정보</p>
                </div>

                <ul class="my" style="list-style:none;margin:0;padding:0;">

                <li>
                <div class="hi_textbox">
                <span style="float:left;">국가무료검진대상자</span>
                <span style="float:right;"><span class="span_text" id="my_yes">ddd</span><img src="/resource/images/app_main/my_profile/ic_more.svg" style="float:right;margin-right:16px;"></span>
                </div>
                </li>

                
                <li>
                <div class="hi_textbox">
                <p style="float:left;">이름</p>
                <p style="float:right;"><span class="span_text" id="my_name2">ddd</span><img src="/resource/images/app_main/my_profile/ic_more.svg" style="float:right;margin-right:16px;"></p>
                </div>
                </li>

                <li>
                <div class="hi_textbox">
                <p style="float:left;">생년월일</p>
                <p style="float:right;"><span class="span_text" id="my_birth">ddd</span><img src="/resource/images/app_main/my_profile/ic_more.svg" style="float:right;margin-right:16px;"></p>
                </div>
                </li>

                <li>
                <div class="hi_textbox">
                <p style="float:left;">성별</p>
                <p style="float:right;"><span class="span_text" id="my_gender">ddd</span><img src="/resource/images/app_main/my_profile/ic_more.svg" style="float:right;margin-right:16px;"></p>
                </div>
                </li>

                <li>
                <div class="hi_textbox">
                <p style="float:left;">영유아자녀</p>
                <p style="float:right;"><span class="span_text" id="my_child">ddd</span><img src="/resource/images/app_main/my_profile/ic_more.svg" style="float:right;margin-right:16px;"></p>
                </div>
                </li>
        
                </ul>

                <img src="/resource/images/app_main/btn_save_enable.svg" style="max-width:720px;width:100%;bottom:0;position: fixed;">

        </div>


        <div id="my_modal3">
                <div class="info_head"  style="max-width:720px; width:100%;height:48px;">

                        <img src="/resource/images/app_main/ic_arrow.svg" style="position:absolute;left:16px;top:12px;" onclick="close_menu3()">
                        
                        <p class="info_sub_title" style="position:absolute;left:72px; top:12px;">상담신청내역</p>
                </div>

                <div class="my_modal3_content" style="display:none">

                <div class="box" style="margin-left:16px;">
                <img src = "/resource/images/app_main/visual_indicator.svg" style="margin-bottom:8px;margin-right:0;">
                <p class="card_sub_title">서울시 서초구 잠원로 94 …</p>
                <p class="card_title">한신메디피아</p>
                </div>

                <div class="box" style="margin-left:16px;">
                <img src = "/resource/images/app_main/visual_indicator.svg" style="margin-bottom:8px;margin-right:0;">
                <p class="card_sub_title">서울시 서초구 잠원로 94 …</p>
                <p class="card_title">한신메디피아</p>
                </div>


                <div class="box" style="margin-left:16px;">
                <img src = "/resource/images/app_main/visual_indicator.svg" style="margin-bottom:8px;margin-right:0;">
                <p class="card_sub_title">서울시 서초구 잠원로 94 …</p>
                <p class="card_title">한신메디피아</p>
                </div>


                <div class="box" style="margin-left:16px;">
                <img src = "/resource/images/app_main/visual_indicator.svg" style="margin-bottom:8px;margin-right:0;">
                <p class="card_sub_title">서울시 서초구 잠원로 94 …</p>
                <p class="card_title">한신메디피아</p>
                </div>


                </div>


                <div class="my_modal3_content" style="max-width:720px;height:600px;background-image:url('/resource/images/app_main/hospital_empty.svg');background-position: center; background-repeat:no-repeat;">
                </div>

                


        </div>


        <div id="my_modal4">
                <div class="info_head"  style="max-width:720px; width:100%;height:48px;">

                        <img src="/resource/images/app_main/ic_arrow.svg" style="position:absolute;left:16px;top:12px;" onclick="close_menu4()">
                        
                        <p class="info_sub_title" style="position:absolute;left:72px; top:12px;">관심병원</p>
                </div>

                <div>
                <img src="/resource/images/app_main/hospital_list.svg" style="max-width:720px;margin-bottom:11px;">

                <img src="/resource/images/app_main/hospital_list.svg" style="max-width:720px;margin-bottom:11px;">

                <img src="/resource/images/app_main/hospital_list.svg" style="max-width:720px;margin-bottom:11px;">

                </div>


        </div>


        <div id="my_modal5">
                <div class="info_head"  style="max-width:720px; width:100%;height:48px;">

                        <img src="/resource/images/app_main/ic_arrow.svg" style="position:absolute;left:16px;top:12px;" onclick="close_menu5()">
                        
                        <p class="info_sub_title" style="position:absolute;left:72px; top:12px;">약관 및 정책</p>
                </div>


                <ul class="menu">
                        <li>서비스 이용약관<span><img src="/resource/images/app_main/my_profile/ic_more.svg" style="float:right;margin-right:16px;"></span></li>
                        <li>개인정보 처리방침<span><img src="/resource/images/app_main/my_profile/ic_more.svg" style="float:right;margin-right:16px;"></span></li>
                </ul>

                


        </div> -->






<script>
var open = sessionStorage.getItem("op_code");

var modalbox = document.getElementById("my_modal");



        



</script>



</body>


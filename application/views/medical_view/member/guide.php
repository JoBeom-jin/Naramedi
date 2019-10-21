<style>
    div:container{
    padding: 50px 0 0 0 !important;
}
td{
    vertical-align: middle;
    height: 70px !important;
}
td input,
td select{
    width: 80% !important;
    height: 60% !important;
}
.bootstrap-select{
    width: 80% !important;
}
form{
    padding: 0 !important;
}
table{
    margin: 50px 0 0 0 !important;
}
.regi_button{
    background-image: url('/resource/images/medical/guide/guide_button_off.png');
    width: 139px;
    height: 38px;
}
.regi_button:hover{
    background-image: url('/resource/images/medical/guide/guide_button_on.png');
}
#q_button{
    width: 144px;
    height: 47px;
    margin: 5px;
}
.btnhover:hover{
    color: white !important;
}


</style>
<section class="hero-image" style="height: 640px !important;">
    <div class="background" style="background:url(/resource/images/medical/guide/guide_top.png) center;">
    </div>
</section>
<section class="container">

    <div class="at-icon-box-text" style="height: 50px;">
        <h1 class="page-title">제휴신청서</h1>
    </div>

    <div>
        <section>
            <form id="contact-form" role="form" method="post" action="<?=$menu_url?>/insertOk" class="background-color-white" target="formReceiver" style="box-shadow: none !important;">
                <div>
                    <table class="form-group">
                        <colgroup>
                            <col width="20%" />
                            <col width="30%" />
                            <col width="20%" />
                            <col width="30%" />
                        </colgroup>
                        <tbody>
                            <tr>
                                <td>검진기관등록</td>
                                <td colspan="3">
                                    <a href="/index.php/rhksflwk?bact=join">
                                        <div class="regi_button"">
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>문의유형<sup style="color: red;">*</sup></td>
                                <td>
                                    <select class="framed" name="mq_type">
                                        <option value="">문의 내용 선택</option>
                                        <?foreach($_types as $k => $v):?>
                                        <option value="<?=$k?>">
                                            <?=$v?>
                                        </option>
                                        <?endforeach;?>
                                    </select>
                                </td>
                                <td>회사/병원명<sup style="color: red;">*</sup></td>
                                <td><input type="text" name="mq_company" required=""></td>
                            </tr>
                            <tr>
                                <td>담당자명<sup style="color: red;">*</sup></td>
                                <td><input type="text" name="mq_name" required=""></td>
                                <td>이메일주소<sup style="color: red;">*</sup></td>
                                <td><input type="text" name="mq_email" required=""></td>
                            </tr>
                            <tr>
                                <td>전화번호<sup style="color: red;">*</sup></td>
                                <td><input type="text" name="mq_tel1" required></td>
                                <td>핸드폰번호<sup style="color: red;">*</sup></td>
                                <td><input type="text" name="mq_tel2" required></td>
                            </tr>
                            <tr>
                                <td>제휴/제안 내용</td>
                                <td colspan="3"><textarea name="mq_text" rows="3" required="" style="max-width: 100%; min-width: 100%; resize: none; margin-top: 10px; height: 350px;"></textarea></td>
                            </tr>

                        </tbody>

                    </table>
                </div>
<br><br>
                <a href="/index.php/medical/contents/etc_personal?win=Y" id="check_agree" onclick="window.open(this.href,'accept','height=810, width=810, scrollbars=1'); return false;" target="_blank" title="새창" style="color: #0051d6;">[개인정보 수집 및 이용 동의 안내]</a>
                <input type="checkbox" onclick="javascript:document.getElementById('check_agree').click()" required>동의합니다
<br>

                <!-- /.form-group -->
                <div class="form-group" style="text-align: center;" >
                        <button type="submit" class="btn btn-default icon btnhover" id="q_button" style="background-color: #195ab4; border-top : #c9c9c9;">확인</button>
                        <button type="" onclick="javascript:history.back()" class="btn btn-default icon" id="q_button" style="background-color: white; color: black; border:1px #c9c9c9 solid">취소</button>
                </div>
                <!-- /.form-group -->
            </form>
            <!--/#contact-form-->
        </section>
    </div>

</section>
<style>
     td:first-child{
        background: #f4f4f4;
    }
    td:last-child{
        padding:8px;
    }
    tbody td{
        padding:8px;
    }
    table{
        margin:0px;
    }
    label {
    font-size: 1rem;
    color: #474747;
    margin:0px;
    }
    form.background-color-white{
    box-shadow:none;
    }
    [type="checkbox"]:not(:checked), [type="checkbox"]:checked{
        position: inherit;
        opacity:1;
        vertical-align: bottom;
        
    }
    
</style>


<section class="container3" id="member-guide">
<div>
	<img src="/resource/images/mobile/post/coalition.png" alt="notice메인이미지" style="width:100%;">
</div>
    <div class="row" style="margin:0px; padding:0px;">
        <!--Content-->
        <div class="col-md-1"></div>
        <div class="col-md-10 bg-white3" style="border-top: 1px solid #393f4b; padding: 0px; margin-top: 15px;">
            <form id="contact-form" role="form" method="post" action="<?=$menu_url?>/insertOk" class="background-color-white" target="formReceiver" style="color:black; padding:0px;">
                    <table class="form-group">
                        <colgroup>
                            <col width="30%" />
                            <col width="20%" />
                            <col width="20%" />
                            <col width="20%" />
                        </colgroup>
                        <tbody>
                            <tr>
                                <td><label for="company-form-regist">검진기관등록</label></td>
                                <td colspan="3" style="text-align:left;">
                                    <figure>
                                        <div >
                                            <a href="/index.php/rhksflwk?bact=join" class="" onclick="alert('검진기관 가입하기 기능은 PC버전에서만 제공합니다. PC를 이용해주세요.'); return false;">
                                                <div class="regi_button">
                                                    <img src="/resource/images/medical/guide/guide_button_off.png" alt="guide_button" style="width:100px;">
                                                </div>
                                            </a>
                                        </div>
                                    </figure>
                                </td>
                            </tr>
                            <tr>
                            <!-- 제휴기관 문의 유형 선택 기능 오류 -->
                                <td><label for="company-form-name">문의유형<sup style="color: red;">*</sup></label></td>
                                <td colspan="3" style="padding-right:70px;">
                                    <select class="framed" name="mq_type">
                                        <option value="">문의 내용 선택</option>
                                        <?foreach($_types as $k => $v):?>
                                        <option value="<?=$k?>">
                                            <?=$v?>
                                        </option>
                                        <?endforeach;?>
                                    </select>
                                    <i class="fa fa-angle-down" style="position: absolute; top: 78px; right: 90px;"></i>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="company-form-name">회사/병원명<sup style="color: red;">*</sup></label></td>
                                <td colspan="3" style="padding-right:70px;"><input type="text"  class="form-control" id="company-form-name" name="mq_name" required=""></td>
                            </tr>
                            <tr>
                                <td><label for="company-form-name">담당자명<sup style="color: red;">*</sup></label></td>
                                <td colspan="3" style="padding-right:70px;"><input type="text"  class="form-control" id=""name="mq_name" required=""></td>
                            </tr>
                            <tr>
                                <td><label for="company-form-email">이메일주소<sup style="color: red;">*</sup></label></td>
                                <td colspan="3" style="padding-right:70px;"><input type="email"  class="form-control" id="company-form-email"name="mq_email" required=""></td>
                            </tr>
                            <tr>
                                <td><label for="company-form-tell">전화번호<sup style="color: red;">*</sup></label></td>
                                <td><input type="tel" name="mq_tel1"  class="form-control" id="company-form-tel1-fornt" required></td>
                                <td><input type="tel" name="mq_tel1"  class="form-control" id="company-form-tel1-center" required></td>
                                <td><input type="tel" name="mq_tel1"  class="form-control" id="company-form-tel1-back" required></td>
                            </tr>
                            <tr>
                                <td><label for="company-form-tell2">핸드폰번호<sup style="color: red;">*</sup></label></td>
                                <td><input type="tel" name="mq_tel2"  class="form-control" id="company-form-tel2-fornt" required></td>
                                <td><input type="tel" name="mq_tel2"  class="form-control" id="company-form-tel2-center" required></td>
                                <td><input type="tel" name="mq_tel2"  class="form-control" id="company-form-tel2-bnack" required></td>
                            </tr>
                            <tr>
                                <td><label for="company-form-message">제휴/제안 내용</label></td>
                                <td colspan="3"><textarea name="mq_text" class="form-control" id="company-form-message" rows="3" required=""></textarea></td>
                            </tr>

                        </tbody>

                    </table>
                
                <a href="/index.php/medical/contents/etc_personal?win=Y" id="check_agree" onclick="window.open(this.href,'accept','height=810, width=810, scrollbars=1'); return false;" target="_blank" title="새창" style="color: #0051d6; margin-left: 10px;">[개인정보 수집 및 이용 동의 안내]</a>
                <input type="checkbox" onclick="" required>동의합니다

                <!-- 제휴기관 등록기능  -->
                <div class="form-group" style="text-align: center; margin-top: 20px;" >
                    <button type="submit" class="btn btn-default icon btnhover" id="q_button" style="background-color: #195ab4; border-top : #c9c9c9; width: 82px;">확인</button>
                    <button type="" onclick="javascript:history.back()" class="btn btn-default icon" id="q_button" style="background-color: white; color: black; border:1px #c9c9c9 solid; width: 82px;">취소</button>
                </div>
                <!-- <div class="form-group2">
                    <label for="company-form-message">문의내용</label>
                    <textarea class="form-control" id="company-form-message" name="mq_text"  rows="3" required=""></textarea>
                </div>
                <div class="form-group2">
                    <button type="submit" class="btn btn-default icon">문의내용 전송하기<i class="fa fa-angle-right"></i></button>
                </div> -->
            </form>
            <!--/#contact-form -->
        </div>
    </section>
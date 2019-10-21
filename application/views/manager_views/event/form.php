<div id="all-event-form">
	<h2 class="title">이벤트 관리</h2>

	<h3 class="title">이벤트 상세</h3>

	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver" enctype="multipart/form-data">
		<?if($act == 'modifyEvent'):?>
		<input type="hidden" name="ei_seq" value="<?=$event['ei_seq']?>" />
		<?else:?>
		<input type="hidden" name="hi_seq" value="" id="hi_seq"/>
		<?endif;?>

		<table class="table table-form" summary="등록된 기존 이벤트 내용을 수정합니다.">
				<caption>이벤트 등록 및 수정 폼</caption>
				<colgroup>
					<col width="30%" />
					<col width="70%" />
				</colgroup>
				<tbody>

				<?if($act == 'insertEvent'):?>
				<tr>
					<th>검진기관명</th>
					<td>
						<input type="text" name="hi_open_name" value="" title="검진기관명" readonly="readonly" disabled="disabled" id="hi_open_name" class="normal"/>
						<a href="<?=$menu_url?>/search" class="btn btn-default" onclick="window.open(this.href, 'search_form', 'width=900, height=700'); return false;">검색</a>
					</td>
				</tr>
				<?endif;?>

				<tr>
					<th>이벤트명</th>
					<td>
						<input type="text" name="ei_name" value="<?=$event['ei_name']?>" title="이벤트명" />
					</td>
				</tr>

				<tr>
					<th>이벤트 카테고리</th>
					<td>
						<select class="" name="ei_category">
							<option value="">선택</option>
							<?foreach($event['category_list'] as $tk=>$tv):?>
							<?
								if($tv['eca_idx'] == $event['ei_category'] ) $eca_seleted = 'selected';
								else $eca_seleted = '';
							?>
							<option value="<?=$tv['eca_idx']?>" <?=$eca_seleted?>><?=$tv['eca_name']?></option>
							<?endforeach?>
						</select>
					</td>
				</tr>

				<tr>
					<th>이벤트 카테고리 세부</th>
					<td>
						<select class="" name="ei_category_sub">
						</select>
					</td>
				</tr>

				<tr>
					<th>이벤트 설명</th>
					<td>
						<input type="text" name="ei_explain" value="<?=$event['ei_explain']?>" title="가격" class="" />
					</td>
				</tr>


				<tr>
					<th>이벤트기간</th>
					<td>
						<input type="text" name="ei_start" value="<?=$event['start']?>" title="이벤트 시작 일" class="datepicker normal" readonly="readonly"/>
						<input type="text" name="ei_end" value="<?=$event['end']?>" title="이벤트 종료 일 " class="datepicker normal" readonly="readonly"/>
						<input type="checkbox" name="ei_auto_flag" value="Y" id="auto_Y" <?if($event['ei_auto_flag'] == 'Y'):?>checked="checked"<?endif;?>/>
						<label for="auto_Y">자동연장동의</label>
					</td>
				</tr>
				<tr>
					<th>정상 가격</th>
					<td>
						<input type="text" name="ei_original_account" value="<?=$event['ei_original_account']?>" title="가격" class="normal" /> 원
					</td>
				</tr>
				<tr>
					<th>이벤트 가격</th>
					<td>
						<input type="text" name="ei_account" value="<?=$event['ei_account']?>" title="가격" class="normal" /> 원
					</td>
				</tr>
				<tr>
					<th>폐쇄몰 노출여부</th>
					<td>
						<select name="ei_closed_display_flag" title="폐쇄몰 노출여부 선택" id="display_flag">
							<option value="N" <?if($event['ei_closed_display_flag']== 'N'):?>selected="selected"<?endif;?>>비노출</option>
							<option value="Y" <?if($event['ei_closed_display_flag']== 'Y'):?>selected="selected"<?endif;?> >노출</option>
						</select>
						<span id="closed_discount" class="hide"><input type="text" name="ei_closed_discount" value="<?=$event['ei_closed_discount']?>" title="할인율 입력" class="mini" /> % 할인</span>
					</td>
				</tr>
				<tr>
					<th>권장연령</th>
					<td>
						<input type="text" name="ei_age_text" value="<?=$event['ei_age_text']?>" title="권장연령" class="normal" />
					</td>
				</tr>
				<tr>
					<th>검진테마</th>
					<td>
						<input type="text" name="ei_theme_text" value="<?=$event['ei_theme_text']?>" title="검진태마" class="normal" />
					</td>
				</tr>
				<tr>
					<th>대상연령대</th>
					<td>
						<?foreach($ages as $k => $v):?>
						<input type="checkbox" name="ages[]" value="<?=$k?>" id="<?=$k?>" <?if(is_array($event['ages']) && in_array($k, $event['ages'])):?>checked="checked"<?endif;?>/>
						<label for="<?=$k?>"><?=$v['cd_name']?></label> &nbsp;&nbsp;
						<?endforeach;?>
					</td>
				</tr>
				<tr>
					<th>검진분류</th>
					<td>
						<?foreach($hos_types as $k => $v):?>
						<input type="checkbox" name="types[]" value="<?=$k?>" id="<?=$k?>" <?if(is_array($event['types']) && in_array($k, $event['types'])):?>checked="checked"<?endif;?>/>
						<label for="<?=$k?>"><?=$v['cd_name']?></label> &nbsp;&nbsp;
						<?endforeach;?>
					</td>
				</tr>

				<?foreach($body_part as $k => $part):?>
				<tr>
					<th><?=$part['name']?></th>
					<td>
						<?foreach($part['data'] as $k2 => $checkup):?>
						<input type="checkbox" name="codes[]" value="<?=$checkup['cd_code']?>" id="<?=$checkup['cd_code']?>" <?if(is_array($event['codes']) && in_array($checkup['cd_code'], $event['codes'])):?>checked="checked"<?endif;?>/>
						<label for="<?=$checkup['cd_code']?>"><?=$checkup['cd_name']?></label>
						<?endforeach;?>
					</td>
				</tr>
				<?endforeach;?>

				<tr>
					<th>이벤트 배너</th>
					<td>
						<?if(array_key_exists('img_banner', $event) && $event['img_banner']):?>
						<img src="<?=$event['img_banner']?>" alt="이벤트 베너 이미지" style="width:100px;" />
						<a href="<?=$menu_url?>/deleteFile?type=ei_img_banner&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a>
						<?else:?>
						<input type="file" name="ei_img_banner" title="이벤트 배너 등록" class="middle" />
						<a href="" class="btn btn-default">샘플 다운로드 (500 * 300 px)</a>
						<?endif;?>
					</td>
				</tr>
<!-- 				<tr> -->
<!-- 					<th>슬라이드 배너</th> -->
<!-- 					<td> -->
<!-- 						<?if(array_key_exists('img_slider', $event) && $event['img_slider']):?> -->
<!-- 						<img src="<?=$event['img_slider']?>" alt="슬라이드 베너 이미지" style="width:100px;" /> -->
<!-- 						<a href="<?=$menu_url?>/deleteFile?type=ei_img_slider&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a> -->
<!-- 						<?else:?> -->
<!-- 						<input type="file" name="ei_img_slider" title="슬라이드 배너 등록" class="middle"/> -->
<!-- 						<a href="" class="btn btn-default">샘플 다운로드 (800 * 400 px)</a> -->
<!-- 						<?endif;?>												 -->
<!-- 					</td> -->
<!-- 				</tr> -->
				<tr>
					<th>상단</th>
					<td>
						<?if(array_key_exists('img_top', $event) && $event['img_top']):?>
						<img src="<?=$event['img_top']?>" alt="상단 이미지" style="width:100px;" />
						<a href="<?=$menu_url?>/deleteFile?type=ei_img_top&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a>
						<?else:?>
						<input type="file" name="ei_img_top" title="상단 등록" class="middle"/>
						<a href="" class="btn btn-default">샘플 다운로드 (폭 1000px)</a>
						<?endif;?>
					</td>
				</tr>
				<tr>
				<th>중단</th>
					<td class="div-margin">						
						<?if(array_key_exists('img_middle', $event) && $event['img_middle']):?>
						<div>
							<img src="<?=$event['img_middle']?>" alt="중단 이미지" style="width:100px;" />
							<a href="<?=$menu_url?>/deleteFile?type=ei_img_middle&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a>
						</div>
							<?else:?>
						<div>
							<input type="file" name="ei_img_middle" title="중단 등록" class="middle"/>							
						</div>
						<?endif;?>
						
						<?if(array_key_exists('img_middle2', $event) && $event['img_middle2']):?>
						<div>
							<img src="<?=$event['img_middle2']?>" alt="중단 이미지" style="width:100px;" />
							<a href="<?=$menu_url?>/deleteFile?type=ei_img_middle2&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a>
						</div>
							<?else:?>
						<div>
							<input type="file" name="ei_img_middle2" title="중단 등록" class="middle"/>							
						</div>
						<?endif;?>

						<?if(array_key_exists('img_middle3', $event) && $event['img_middle3']):?>
						<div>
							<img src="<?=$event['img_middle3']?>" alt="중단 이미지" style="width:100px;" />
							<a href="<?=$menu_url?>/deleteFile?type=ei_img_middle3&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a>
						</div>
							<?else:?>
						<div>
							<input type="file" name="ei_img_middle3" title="중단 등록" class="middle"/>							
						</div>
						<?endif;?>

						<?if(array_key_exists('img_middle4', $event) && $event['img_middle4']):?>
						<div>
							<img src="<?=$event['img_middle4']?>" alt="중단 이미지" style="width:100px;" />
							<a href="<?=$menu_url?>/deleteFile?type=ei_img_middle4&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a>
						</div>
							<?else:?>
						<div>
							<input type="file" name="ei_img_middle4" title="중단 등록" class="middle"/>							
						</div>
						<?endif;?>

						<?if(array_key_exists('img_middle5', $event) && $event['img_middle5']):?>
						<div>
							<img src="<?=$event['img_middle5']?>" alt="중단 이미지" style="width:100px;" />
							<a href="<?=$menu_url?>/deleteFile?type=ei_img_middle5&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a>
						</div>
							<?else:?>
						<div>
							<input type="file" name="ei_img_middle5" title="중단 등록" class="middle"/>							
						</div>
						<?endif;?>

						<?if(array_key_exists('img_middle6', $event) && $event['img_middle6']):?>
						<div>
							<img src="<?=$event['img_middle6']?>" alt="중단 이미지" style="width:100px;" />
							<a href="<?=$menu_url?>/deleteFile?type=ei_img_middle6&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a>
						</div>
							<?else:?>
						<div>
							<input type="file" name="ei_img_middle6" title="중단 등록" class="middle"/>							
						</div>
						<?endif;?>

						<?if(array_key_exists('img_middle7', $event) && $event['img_middle7']):?>
						<div>
							<img src="<?=$event['img_middle7']?>" alt="중단 이미지" style="width:100px;" />
							<a href="<?=$menu_url?>/deleteFile?type=ei_img_middle7&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a>
						</div>
							<?else:?>
						<div>
							<input type="file" name="ei_img_middle7" title="중단 등록" class="middle"/>							
						</div>
						<?endif;?>

						<?if(array_key_exists('img_middle8', $event) && $event['img_middle8']):?>
						<div>
							<img src="<?=$event['img_middle8']?>" alt="중단 이미지" style="width:100px;" />
							<a href="<?=$menu_url?>/deleteFile?type=ei_img_middle8&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a>
						</div>
							<?else:?>
						<div>
							<input type="file" name="ei_img_middle8" title="중단 등록" class="middle"/>							
						</div>
						<?endif;?>

						<?if(array_key_exists('img_middle9', $event) && $event['img_middle9']):?>
						<div>
							<img src="<?=$event['img_middle9']?>" alt="중단 이미지" style="width:100px;" />
							<a href="<?=$menu_url?>/deleteFile?type=ei_img_middle9&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a>
						</div>
							<?else:?>
						<div>
							<input type="file" name="ei_img_middle9" title="중단 등록" class="middle"/>							
						</div>
						<?endif;?>

						<?if(array_key_exists('img_middle10', $event) && $event['img_middle10']):?>
						<div>
							<img src="<?=$event['img_middle10']?>" alt="중단 이미지" style="width:100px;" />
							<a href="<?=$menu_url?>/deleteFile?type=ei_img_middle10&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a>
						</div>
							<?else:?>
						<div>
							<input type="file" name="ei_img_middle10" title="중단 등록" class="middle"/>							
						</div>
						<?endif;?>

					</td>
				</tr>
				<tr>
					<th>하단</th>
					<td>
						<?if(array_key_exists('img_bottom', $event) && $event['img_bottom']):?>
						<img src="<?=$event['img_bottom']?>" alt="중단 이미지" style="width:100px;" />
						<a href="<?=$menu_url?>/deleteFile?type=ei_img_bottom&amp;seq=<?=$event['ei_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다. 삭제하시겠습니까?');" >이미지 삭제</a>
						<?else:?>
						<input type="file" name="ei_img_bottom" title="하단 등록" class="middle"/>
						<a href="" class="btn btn-default">샘플 다운로드 (폭 1000px)</a>
						<?endif;?>
					</td>
				</tr>
				<tr>
					<th>이벤트 이미지 미리보기</th>
					<td>
						<a href="<?=$menu_url?>/viewImage?seq=<?=$event['ei_seq']?>" class="btn btn-default" onclick="window.open(this.href, 'image_viewer', 'width=1030, height=700, scrollbar=0'); return false;" target="_blank">이벤트 이미지 미리보기</a>
					</td>
				</tr>
				<tr>
					<th>차감 캐쉬 설정</th>
					<td>
						<label for="openmall">오픈몰</label> &nbsp; <input type="text" name="ei_cash_openmall" value="<?=$event['ei_cash_openmall']?>" title="오픈몰" id="openmall" class="normal"/>  &nbsp;
						<span id="closemall_cash" class="hide"><label for="closedmall">폐쇄몰</label> &nbsp;<input type="text" name="ei_cash_closemall" value="<?=$event['ei_cash_closemall']?>" title="폐쇄몰" id="closedmall" class="normal"/></span>
					</td>
				</tr>
				<tr>
					<th>이벤트속성</th>
					<td>
						<select name="ei_event_type" title="이벤트 속성" />
							<option value="">이벤트 속성 선택</option>
							<option value="normal" <?if($event['ei_event_type'] == 'normal'):?>selected="selected"<?endif;?> >일반</option>
							<option value="hot" <?if($event['ei_event_type'] == 'hot'):?>selected="selected"<?endif;?>>핫딜</option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="btn-area-center">
			<?if($act == 'modifyEvent'):?>
			<input type="submit" <?if($event['ei_status'] == 'wait'):?> value="승인처리" onclick="return confirm('이벤트를 노출하시겠습니까?');"<?else:?>value="수정확인"<?endif;?> class="btn btn-primary" />
			<?else:?>
			<input type="submit" value="신규이벤트 등록" class="btn btn-primary" />
			<?endif;?>
			<a href="<?=$menu_url?>" class="btn btn-default">목록으로</a>
		</div>

	</form>
</div>


<script type="text/javascript">
var ei_category_sub = "<?=$event['ei_category_sub']?>"
var category_arr_sub = {}
<?
$tmp_arr = array();
foreach($event['category_list_sub'] as $tk=>$tv){
	if( !isset($tmp_arr[$tv['ecs_eca_idx']]) ){
		$tmp_arr[$tv['ecs_eca_idx']] = array();
		echo "category_arr_sub[".$tv['ecs_eca_idx']."] = {} \n";
	}
	// $tmp_arr[$tv['ecs_eca_idx']][$tv['ecs_idx']] = $tv['ecs_name']
	echo "category_arr_sub[".$tv['ecs_eca_idx']."][".$tv['ecs_idx']."] = '".$tv['ecs_name']."' \n";
}
?>

function draw_category_list_sub(category){
	if(category=='') return false;

	$("select[name='ei_category_sub'] option").remove()
	$("select[name='ei_category_sub']").append("<option value=''>선택</option>")
	$.each(category_arr_sub[category], function(k,v){
		var tmp1 = ''
		if( ei_category_sub == k) tmp1 = "<option value='"+k+"' selected>"+v+"</optoin>"
		else tmp1 = "<option value='"+k+"'>"+v+"</optoin>"
		$("select[name='ei_category_sub']").append(tmp1)
	})
}

 $(document).ready(function(){

	 draw_category_list_sub($("select[name='ei_category']").val())
	 $("select[name='ei_category']").change(function(){
		 var tval = $(this).val()
		 draw_category_list_sub(tval)
	 })

	  $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        yearSuffix: '년'
    });

	$('.datepicker').datepicker();

	checkClosedShop();
	$('#display_flag').on('change', function(){
		checkClosedShop();
	});

 });

 function checkClosedShop(){
	 var selected = $('#display_flag option:selected');

	 if(selected.val() == 'Y'){
		$('#closed_discount').removeClass('hide');
		$('#closemall_cash').removeClass('hide');
	 }else{
		 $('#closed_discount').addClass('hide');
		 $('#closed_discount input').val('');

		 $('#closemall_cash').addClass('hide');
		 $('#closemall_cash input').val('');
	 }
 }
</script>

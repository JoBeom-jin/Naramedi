<div id="reserve-view">
<h2 class="title">이벤트 예약관리</h2>
<h3 class="title">이벤트 예약관리 상세</h3>
<form method="post" action="<?=$menu_url?>/modifyOk" target="formReceiver">
<input type="hidden" name="er_seq" value="<?=$reserve['er_seq']?>" />

<table class="table table-form" summary="이벤트 예약관리 상세 수정 폼">
	<caption>이벤트 예약관리 상세 수정</caption>
	<colgroup>
		<col width="15%" />
		<col width="85%" />
	</colgroup>
	<tbody>
		<tr>
			<th>신청자명</th>
			<td>
				<?=$reserve['er_name']?>
			</td>
		</tr>
		<tr>
			<th>회원아이디</th>
			<td>
				<?=$reserve['er_meid']?>
			</td>
		</tr>
		<tr>
			<th>신청자 전화번호</th>
			<td>
				<?=$reserve['er_phone']?>
			</td>
		</tr>
		<tr>
			<th>신청시간</th>
			<td>
				<?=date('Y. m. d H:i', $reserve['er_ctime'])?>
			</td>
		</tr>
		<tr>
			<th>상담 요청 시간</th>
			<td>
				<?=$_times[$reserve['er_time']]['sub_name']?>
			</td>
		</tr>
		<tr>
			<th>메모</th>
			<td>
				<?=$reserve['er_memo']?>
			</td>
		</tr>
		<tr>
			<th>이벤트명</th>
			<td>
				<?=$reserve['ei_name']?>
			</td>
		</tr>
		<tr>
			<th>가격</th>
			<td>
				<?=number_format($reserve['er_account'])?> 원
			</td>
		</tr>
		<tr>
			<th>검진기관</th>
			<td>
				<?=$hospital['hi_open_name']?>
			</td>
		</tr>
		<tr>
			<th>예약확정일자</th>
			<td>
				<?if($reserve['er_reserve_time']):?>
				<?=date('Y.m.d', $reserve['er_reserve_time'])?>
				<?endif;?>
				<br/><span class="strong">예약일 변경</span> : <input type="text" name="er_reserve_time" value="" title="예약일자 변경" class="normal datepicker tcenter" />
			</td>
		</tr>
		<tr>
			<th>현재상태</th>
			<td>
				<?=$_status[$reserve['er_status']]['status']?> ( <?=$reserve['status']?> )
				<?if($_status[$reserve['er_status']]['status'] == '대기' && $reserve['status'] == '미접촉'):?>
				<a href="<?=$menu_url?>/sendSMS?seq=<?=$reserve['er_seq']?>" class="btn btn-primary" target="formReceiver">담당자에게 SMS발송하기</a>
				<?endif;?>
			</td>
		</tr>
		<tr>
			<th>상태변경</th>
			<td>
				<select name="base_status" title="상태변경값" id="base_status">
					<option value="wait" <?if($_status[$reserve['er_status']]['status']=='대기'):?>selected="selected"<?endif;?>>대기상태</option>
					<option value="reserve" <?if($_status[$reserve['er_status']]['status']=='예약'):?>selected="selected"<?endif;?>>예약상태</option>
				</select>

				<select name="wait_select" title="상태변경 (대기상태)" class="status_selecter" id="wait_select">
					<?foreach($_status as $k => $v):?>
					<?if($v['status'] != '대기') continue;?>
					<option value="<?=$k?>" <?if($k == $reserve['er_status']):?>selected="selected"<?endif;?>><?=$v['name']?></option>
					<?endforeach;?>
				</select>

				<select name="reserve_select" title="상태변경 (예약상태)" class="hide status_selecter" id="reserve_select">
					<?foreach($_status as $k => $v):?>
					<?if($v['status'] != '예약') continue;?>
					<option value="<?=$k?>" <?if($k == $reserve['er_status']):?>selected="selected"<?endif;?>><?=$v['name']?></option>
					<?endforeach;?>
				</select>
			</td>
		</tr>
	</tbody>
</table>
<div class="btn-area-center">
	<input type="submit" value="예약정보 수정" class="btn btn-primary" />
	<a href="<?=$back_url?>" class="btn btn-default">돌아가기</a>
</div>
</form>
</div>

<script type="text/javascript">
	$(document).ready(function(){
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

		statusChange();
		$('#base_status').on('change', function(e){
			statusChange();
		});
	 });



	 function statusChange(){
		 var status_selecter = $('.status_selecter');
		 var selected_value = $('#base_status option:selected').val();
		 var next_select_id = selected_value+'_select';

		 status_selecter.addClass('hide');
		 $('#'+next_select_id).removeClass('hide');
	 }
</script>

<div id="reserve-change">
	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver" onsubmit="return alert_msg();">
		<input type="hidden" name="er_seq" value="<?=$er_seq?>" />
		<table class="table table-list" summary="예약 대기자 상태를 변경합니다.">
			<caption>예약 대기자 상태 변경</caption>
			<thead>
				<tr>
					<th>예약 대기자 상태 변경</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<div>
							<select name="method" title="예약상태 선택" style="width:99%; margin:0 auto;">
								<option value="">예약상태 선택</option>
								<option value="RESERVED">예약을 확정하였습니다.</option>
								<option value="NOTACCEPT">전화를 시도했지만 받지 않습니다.</option>
								<option value="WRONGNUMBER">전화번호가 틀린번호라고 합니다.</option>
								<option value="CANCEL">고객이 예약을 취소하였습니다.</option>
							</select>						
						</div>
						<div id="picker" style="margin-top:20px; display:none;">
							<input type="text" name="date" value="" style="width:50%; margin:0 auto;" class="datepicker" placeholder="예약일자 선택......."/>
							<input type="button" value="선택취소" readonly="readonly" class="btn btn-default"/>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="btn-area-center">
			<input type="submit" value="확인" class="btn btn-primary" />
			<input type="button" value="창닫기" class="btn btn-default" onclick="self.close();" />
		</div>
	</form>
</div>

<script type="text/javascript">
	function alert_msg(){
		var method = $('select[name="method"] :selected').val();
		if(!method){
			var date = $('input[name="date"]').val();
			if(!date){
				alert('예약일을 선택해주세요');
				return false;
			}else{
				return confirm('입력하신 날짜로 예약을 확정하시겠습니까?');
			}
		}else if(method == 'RESERVED'){
			return confirm('입력하신 날짜로 예약을 확정하시겠습니까?');
		}else if(method == 'NOTACCEPT'){
			return confirm('부재중 전화는\n리스트에서 삭제되지 않습니다.\n통화가 된 후 재처리 해주세요.');
		}else if(method == 'WRONGNUMBER'){
			return confirm('틀린번호인 경우\n예약 리스트에서 삭제됩니다.\n계속하시겠습니까?');
		}else if(method == 'CANCEL'){
			return confirm('예약취소는 리스트에서 삭제됩니다.\n계속하시겠습니까?');
		}

	}	

	function removeDate(){
		$('input[name="date"]').val('');	
	}


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

		$('select[name="method"]').on('change', function(e){
			var selected_value = $('select[name="method"] :selected').val();

			if(selected_value == 'RESERVED'){
				$('#picker').css('display', 'block');				
			}else{
				$('#picker').css('display', 'none');	
				$('input[name="date"]').val();
			}
			
		});


	 });
</script>


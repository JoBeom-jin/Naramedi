<? include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'_tab.php'?>

<h3 class="title">SMS 전송테스트</h3>

<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="_blank">
	<table class="table table-form" summary="sms 전송테스트">
		<caption>전송테스트</caption>
		<tbody>
			<tr>
				<th>착신번호</th>
				<td>
					<input type="text" name="phone" value="01034243473" />
				</td>
				<th>메세지</th>
				<td>
					<input type="text" name="msg" value="메세지 발송 테스트를 하겠습니다. SMS" />
				</td>
			</tr>
			<tr>
				<th>예약발송여부</th>
				<td>
					<input type="checkbox" name="reserve" value="y" id="reserve_y"/>				
					<label for="reserve_y">※ 선택시 년월일, 시간, 분을 반드시 선택해야 합니다.</label>
				</td>
				<th>
					예약발송 일자시간 선택
				</th>
				<td>
					년월일 : <input type="text" name="ymd" value="" class="normal" placeholder="YYYY-mm-dd 로 입력"/>
					시간 : <input type="text" name="hour" value="" class="mini" placeholder="숫자만"/>				
					분 : <input type="text" name="minuet" value="" class="mini" placeholder="숫자만"/>
				</td>
			</tr>
		</tbody>
	</table>

	<div class="btn-area-center">
		<input type="submit" value="전송하기" class="btn btn-primary" />
	</div>
</form>


<h3 class="title">알림톡 전송테스트 (상담신청고객)</h3>
<form method="post" action="<?=$menu_url?>/alimTalkQuestionUserOk" target="_blank">
	<table class="table table-form" summary="sms 전송테스트">
		<caption>전송테스트</caption>
		<tbody>
			<tr>
				<th>착신번호</th>
				<td>
					<input type="text" name="phone" value="01034243473"/>					
				</td>
				<td>
					<input type="submit" value="전송하기" class="btn btn-primary" />
				</td>
			</tr>			
		</tbody>
	</table>
</form>



<h3 class="title">알림톡 전송테스트 (상담병원담당자)</h3>
<form method="post" action="<?=$menu_url?>/alimTalkQuestionManagerOk" target="_blank">
	<table class="table table-form" summary="sms 전송테스트">
		<caption>전송테스트</caption>
		<tbody>
			<tr>
				<th>착신번호</th>
				<td>
					<input type="text" name="phone" value="01034243473"/>					
				</td>
				<td>
					<input type="submit" value="전송하기" class="btn btn-primary" />
				</td>
			</tr>			
		</tbody>
	</table>
</form>


<h3 class="title">알림톡 전송테스트 (예약 확정자)</h3>
<form method="post" action="<?=$menu_url?>/alimTalkReserveUserOk" target="_blank">
	<table class="table table-form" summary="sms 전송테스트">
		<caption>전송테스트</caption>
		<tbody>
			<tr>
				<th>착신번호</th>
				<td>
					<input type="text" name="phone" value="01034243473"/>					
				</td>
				<td>
					<input type="submit" value="전송하기" class="btn btn-primary" />
				</td>
			</tr>			
		</tbody>
	</table>
</form>


<h3 class="title">알림톡 전송테스트 (중앙관리자 to 병원관리자)</h3>
<form method="post" action="<?=$menu_url?>/alimTalkHospitalManagerOk" target="_blank">
	<table class="table table-form" summary="sms 전송테스트">
		<caption>전송테스트</caption>
		<tbody>
			<tr>
				<th>착신번호</th>
				<td>
					<input type="text" name="phone" value="01034243473"/>					
				</td>
				<td>
					<input type="submit" value="전송하기" class="btn btn-primary" />
				</td>
			</tr>			
		</tbody>
	</table>
</form>
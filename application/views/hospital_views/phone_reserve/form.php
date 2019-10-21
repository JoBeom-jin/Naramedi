<h3 class="title">전화대기자 상태변경</h3>

<div id="phone-reserve-form">
	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">
		<input type="hidden" name="bz_idx" value="<?=$seq?>" />


	<table class="table table-form" summary="전화대기자 상태 변경">
		<caption>상태변경 폼</caption>
		<tbody>
			<tr>
				<td>
					<div>
						<select name="status" title="예약상태 선택">
							<option value="">예약상태 선택</option>
							<option value="reserveOk">예약을 확정하였습니다.</option>
							<option value="cancel">고객이 예약을 취소/보류하였습니다.</option>
						</select>
					</div>
				</td>
			</tr>			
		</tbody>
	</table>
	<div class="btn-area-center">
		<input type="submit" value="예약등록" class="btn btn-primary" />
		<input type="button" value="창닫기" class="btn btn-default" />
	</div>
	</form>
</div>
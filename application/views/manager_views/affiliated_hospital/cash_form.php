<div id="cash-insert-form">
	<h2 class="title">캐쉬 충전</h2>
	
	<h3 class="title">캐쉬 충전 폼</h3>

	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">
		<input type="hidden" name="ch_hiseq" value="<?=$view['hi_seq']?>" />

		<table class="table table-form" summary="캐쉬 충전을 위한 폼입니다.">
			<caption>캐쉬 충전 폼</caption>
			<tbody>
				<tr>
					<th colspan="2" class="tcenter">
						<span class="strong">[ <?=$view['hi_open_name']?> ]</span><span class="tnormal">에 캐쉬를 충전합니다.</span>
					</th>
				</tr>
				<tr>
					<th>충전금액</th>
					<td>
						<input type="text" name="ch_in" title="충전금액" />
					</td>
				</tr>
				<tr>
					<th>메모</th>
					<td>
						<input type="text" name="ch_memo" value="" title="충전시 메모" />
					</td>
				</tr>
			</tbody>
		</table>

		<div class="btn-area-center">
			<input type="submit" value="캐쉬 충전" class="btn btn-primary"/>		
			<input type="button" value="창닫기" class="btn btn-default" onclick="self.close();" />
		</div>
	</form>
</div>
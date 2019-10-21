<div id="cash-view">
	<h3 class="title">캐쉬 변동 내역</h3>
	<table class="table table-form">
		<tbody class="tcenter-all">
			<tr>
				<td>
					<span class="alertStrong">
						+<?=number_format($view['ch_in'])?>
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<?=$view['ch_memo']?>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="btn-area-center">
		<input type="button" value="확인" class="btn btn-primary" onclick="self.close();" />
	</div>
</div>
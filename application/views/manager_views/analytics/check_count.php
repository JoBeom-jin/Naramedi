<div id="view-count">
	<h3 class="title">노출수 통계</h3>

	<table class="table table-list tcenter-all">
		<caption>노출수 통계</caption>
		<colgroup>
			<col width="35%" />
			<col width="65%" />
		</colgroup>
		<thead>
			<tr>
				<th>합계</th>
				<td><?=number_format($total)?></td>
			</tr>
		</thead>
		<tbody>
			<?if(isArray_($list)):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td>
					<?=date('Y.m.d', $v['uce_ctime'])?>
				</td>
				<td>
					<?=number_format($v['cnt'])?>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="2">※ 내역이 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>
	</table>

	<div class="btn-area-center">
		<input type="button" value="창닫기" class="btn btn-default" onclick="self.close();" />
	</div>
</div>
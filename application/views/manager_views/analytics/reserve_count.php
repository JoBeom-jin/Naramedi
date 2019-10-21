<div id="view-count">
	<h3 class="title">노출수 통계</h3>

	<table class="table table-list tcenter-all">
		<caption>노출수 통계</caption>
		<colgroup>
			<col width="30%" />
			<col width="30%" />
			<col width="40%" />
		</colgroup>
		<thead>
			<tr>
				<th>신청일</th>
				<th>이름</th>
				<th>전화번호</th>
			</tr>
		</thead>
		<tbody>
			<?if(isArray_($list)):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td>
					<?=date('Y.m.d', $v['er_ctime'])?>
				</td>
				<td>
					<?=$v['er_name']?>
				</td>
				<td>
					<?=$v['er_phone']?>					
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="3">※ 내역이 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>
	</table>

	<div class="btn-area-center">
		<input type="button" value="창닫기" class="btn btn-default" onclick="self.close();" />
	</div>
</div>
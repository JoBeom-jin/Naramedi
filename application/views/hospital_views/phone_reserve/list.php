<div id="phone-reserve-list">
	<h2 class="title">전화 예약자 관리</h2>
	
	<h3 class="title">전화 대기자 현황</h3>
	<div class="btn-area-left">
		<span class="talert"><?=count($list)?></span>명의 전화예약자가 처리 대기중입니다.
	</div>

	<table class="table table-list" summary="전화 대기자 현황을 목록으로 표시합니다.">
		<caption>전화 대기자 현황</caption>
		<colgroup>
		</colgroup>
		<thead>
			<tr>
				<th>NO</th>
				<th>콜시간</th>
				<th>종료시간</th>
				<th>고객전화번호</th>
				<th>예약내용 등록</th>
			</tr>
		</thead>
		<tbody class="tcenter-all">
			<?if(isArray_($list)):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td><?=$paging->getPageNum($k)?></td>
				<td><?=biz_str2date($v['bz_sdt'])?></td>
				<td><?=biz_str2date($v['bz_edt'])?></td>
				<td><?=$v['bz_fromn']?></td>
				<td>
					<a href="<?=$menu_url?>/reserve?seq=<?=$v['bz_idx']?>" onclick="window.open(this.href, 'reserve_form', 'width=400, height=400'); return false;" class="btn btn-default">예약등록</a>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="5">※ 대기중인 예약자가 없습니다.</td>
			</tr>
			<?endif?>
		</tbody>
	</table>
</div>
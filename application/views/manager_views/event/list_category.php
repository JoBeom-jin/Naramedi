<div id="event_category_list">
	<h2 class="title">이벤트 관리</h2>

	<div class="btn-area-left">
		<a href="<?=$menu_url?>/insert" class="btn btn-primary" onclick="window.open(this.href, 'modifyForm', 'width=400, height=500'); return false;">신규 카테고리 등록</a>
	</div>

	<h3 class="title">이벤트 카테고리 목록</h3>

	<table class="table table-list" summary="후기 목록" >
		<caption>후기 목록</caption>
		<thead>
			<tr>
				<th>NO</th>
				<th>순서</th>
				<th>이름</th>
				<th>메뉴오픈</th>
				<th>기능</th>
			</tr>
		</thead>
		<tbody>
			<?if(isset($list) && is_array($list) && count($list) > 0):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td><?=$paging->getPageNum($k)?>
				<td><?=$v['eca_order']?></td>
				<td><?=$v['eca_name']?></td>
				<td><?=$v['eca_open_menu']?></td>
				<td class="tcenter">
					<a href="<?=$menu_url?>/modify?seq=<?=$v['eca_idx']?>" class="btn btn-primary" onclick="window.open(this.href, 'modifyForm', 'width=400, height=500'); return false;">수정</a>
					<a href="<?=$menu_url?>/deleteOk?seq=<?=$v['eca_idx']?>" target="formReceiver" onclick="return confirm('삭제된 데이터는 복구하실 수 없습니다. 삭제하시겠습니까?');" class="btn btn-danger">삭제</a>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="8">※ 등록된 내용이 없습니다.</td>
			</tr>
			<?endif?>
		</tbody>
	</table>
</div>

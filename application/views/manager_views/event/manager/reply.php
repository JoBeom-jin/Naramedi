<div id="reply-list">
	<h2 class="title">유저 후기 관리</h2>

	<h3 class="title">후기 목록</h3>

	<table class="table table-list" summary="후기 목록" >
		<caption>후기 목록</caption>
		<thead>
			<tr>
				<th>NO</th>
				<th>기관이름</th>
				<th>남긴이</th>
				<th>후기내용</th>
				<th>진료만족도</th>
				<th>시설만족도</th>
				<th>친절만족도</th>
				<th>기능</th>
			</tr>
		</thead>
		<tbody>
			<?if(isset($list) && is_array($list) && count($list) > 0):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td><?=$paging->getPageNum($k)?>
				<td><?=$v['ai_name']?></td>
				<td class="tcenter"><?=$v['me_name']?></td>
				<td><?=$v['ac_comment']?></td>
				<td class="tcenter"><?=number_format($v['ac_jin'])?></td>
				<td class="tcenter"><?=number_format($v['ac_obj'])?></td>
				<td class="tcenter"><?=number_format($v['ac_kind'])?></td>
				<td class="tcenter">
					<a href="<?=$menu_url?>/modify?seq=<?=$v['ac_seq']?>" class="btn btn-primary" onclick="window.open(this.href, 'modifyForm', 'width=400, height=500'); return false;">수정</a>
					<a href="<?=$menu_url?>/deleteOk?seq=<?=$v['ac_seq']?>" target="formReceiver" onclick="return confirm('삭제된 데이터는 복구하실 수 없습니다. 삭제하시겠습니까?');" class="btn btn-danger">삭제</a>
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


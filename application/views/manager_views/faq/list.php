<h2 class="title">FAQ 리스트</h2>

<h3 class="title">유저가 등록한 faq 리스트 입니다.</h3>

<table class="table table-list" summary="faq 목록 입니다.">
	<caption>faq 목록</caption>
	<thead>
		<tr>
			<th>No</th>
			<th>제목</th>
			<th>작성자 ID</th>
			<th>작성일</th>
			<th>답변여부</th>			
		</tr>
	</thead>
	<tbody class="tcenter-all">
		<?if(!is_array($list) || count($list) < 1):?>		
		<tr>
			<td colspan="5">※ faq 목록이 없습니다.</td>			
		</tr>
		<?else:?>
		<?foreach($list as $k => $v):?>
		<tr>
			<td><?=$paging->getPageNum($k)?></td>
			<td>
				<a href="<?=$menu_url?>/insertAnswer?seq=<?=$v['uq_seq']?>" onclick="window.open(this.href,'answer-form','width=600, height=800'); return false;">
				<?=$v['uq_subject']?>
			</td>
			<td><?=$v['uq_meid']?></td>
			<td><?=date('Y.m.d H:i', $v['uq_ctime'])?></td>
			<td>
				<?if($v['uq_answer']):?>
				답변됨
				<?else:?>
				<span class="tdanger">답변안됨</span>				
				<?endif;?>
			</td>
		</tr>
		<?endforeach;?>
		<?endif;?>		
	</tbody>
</table>
<div id="analytics-list">
	<h2 class="title">이벤트 노출 정보</h2>

	<h3 class="title">이벤트 리스트</h3>
	<table class="table table-list" summary="통계 관리 목록">
		<caption>이벤트 목록</caption>
		<thead>
			<tr>
				<th>NO</th>
				<th>병원명</th>
				<th>이벤트명</th>
				<th>상태</th>
				<th>노출수</th>
				<th>클릭수</th>
				<th>찜건수</th>
				<th>예약건수</th>
			</tr>
		</thead>
		<tbody class="tcenter-all">
			<?if(isArray_($list)):?>
			<?foreach($list as $k => $v):?>
			<tr>				
				<td><?=$paging->getPageNum($k)?></td>
				<td><?=$v['hi_open_name']?></td>
				<td><?=$v['ei_name']?></td>
				<td>
					<?$ctime = time();?>
					<?if($v['ei_end'] > $ctime && $v['ei_status'] == 'doing'):?>
					진행중
					<?elseif($v['ei_end'] > $ctime):?>
					대기중
					<?else:?>
					종료
					<?endif;?>
				</td>
				<td>
					<a href="<?=$menu_url?>/viewCount?seq=<?=$v['ei_seq']?>" onclick="window.open(this.href, 'view-cnt', 'width=500, height=600'); return false;"><?=number_format($v['view_cnt'])?></a>
				</td>
				<td>
					<a href="<?=$menu_url?>/clickCount?seq=<?=$v['ei_seq']?>" onclick="window.open(this.href, 'view-cnt', 'width=500, height=600'); return false;"><?=number_format($v['click_cnt'])?></a>
				</td>
				<td>
					<a href="<?=$menu_url?>/checkCount?seq=<?=$v['ei_seq']?>" onclick="window.open(this.href, 'view-cnt', 'width=500, height=600'); return false;"><?=number_format($v['check_cnt'])?></a>
				</td>
				<td>
					<a href="<?=$menu_url?>/reserveCount?seq=<?=$v['ei_seq']?>" onclick="window.open(this.href, 'view-cnt', 'width=500, height=600'); return false;"><?=number_format($v['reserve_cnt'])?></a>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="7">※ 등록된 이벤트가 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>
	</table>


	<?if(count($paging->pages) > 0):?>

	<div id="paging">
		
		<ul class="pagination">
			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl(1)?>"><span>&lt;&lt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>" onclick="return false;"><span>&lt;&lt;</span></a></li>
			<?endif;?>


			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->prev)?>"><span>&lt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>" onclick="return false;"><span>&lt;</span></a></li>				
			<?endif;?>

			
			<?foreach($paging->pages as $k => $v):?>
			<li <?if($v == $paging->page):?>class="active"<?endif;?>>
				<a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($v)?>"><span><?=$v?></span></a>
			</li>
			<?endforeach;?>
			

			<?if($paging->next > 0):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->next)?>"><span>&gt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>" onclick="return false;"><span>&gt;</span></a></li>				
			<?endif;?>

			<?if($paging->page < $paging->totalPages):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->totalPages)?>"><span>&gt;&gt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>" onclick="return false;"><span>&gt;&gt;</span></a></li>				
			<?endif;?>

		</ul>

	</div>
	
	<?endif;?>
</div>
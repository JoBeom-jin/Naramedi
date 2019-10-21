<div id="hospital-manager">
	<h2 class="title">캐쉬관리</h2>

	<h3 class="title"><span  class="total"><?=number_format($total)?></span> cash를 보유중입니다.</h3>

	<h3 class="title">캐쉬 관리</h3>

	<table class="table table-list" summary="캐쉬 사용 목록 입니다">
		<caption>캐쉬 사용 목록</caption>
		<colgroup>
		</colgroup>
		<thead>
			<tr>
				<th>NO</th>
				<th>일시</th>
				<th>신청자명</th>
				<th>이벤트명</th>
				<th>차감캐쉬</th>
				<th>누적캐쉬</th>
			</tr>
		</thead>
		<tbody>
			<?if(is_array($list) && count($list) > 0):?>
			<?foreach($list as $k => $v):?>
			<tr class="tcenter-all">
				<td><?=$paging->getPageNum($k)?></td>
				<td>
					<?=date('Y.m.d H:i', $v['ch_ctime'])?>
				</td>
				<td>
					<?=$v['ch_name']?>
				</td>
				<td>
					<?if($v['ch_in'] > 0):?>
					관리자 충전					
					<?else:?>
					<?=$event_list[$v['ch_eiseq']]['ei_name']?>
					<?endif;?>
				</td>
				<td>
					<?if($v['ch_in'] > 0):?>
					<a href="<?=$menu_url?>/viewInfo?seq=<?=$v['ch_seq']?>" onclick="window.open(this.href, 'viewinfo', 'width=400, height=400'); return false;" style="color:red;">+<?=number_format($v['ch_in'])?></a>
					<?else:?>
					-<?=number_format($v['ch_out'])?>
					<?endif;?>
				</td>
				<td>
					<?=number_format($v['accum'])?>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="6">※ 등록된 내역이 없습니다.</td>
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
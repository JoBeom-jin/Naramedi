<div class="btn-area-left">
	<a href="/index.php/Manager/contents/hos_joined" class="btn btn-default">캐쉬관리</a>
	<a href="/index.php/Manager/contents/hos_joined?act=cash" class="btn btn-primary">캐쉬 충전 이력</a>
</div>

<h2 class="title">할당한 충전 이력을 출력합니다..</h2>

<h3 class="title">현재까지 충전 이력 목록</h3>

<div id="cash-history">
	<table class="table table-list" summary="캐쉬 충전 이력을 목록으로 보여줍니다.">
		<caption>충전 이력</caption>
		<thead>
			<tr>
				<th>No</th>
				<th>충전 일시</th>
				<th>검진기관명</th>
				<th>기관번호</th>
				<th>충전캐쉬</th>
				<th>메모</th>
			</tr>
		</thead>
		<tbody>
			<?if(count($list) > 0):?>
			<?foreach($list as $k => $v):?>
			<tr class="tcenter-all">
				<td><?=$paging->getPageNum($k);?></td>
				<td>
					<?=date('Y.m.d H:i', $v['ch_ctime'])?>
				</td>
				<td>
					<?=$v['hi_open_name']?>
				</td>
				<td>
					<?=$v['hi_org_number']?>
				</td>
				<td>
					<?=number_format($v['ch_in'])?>
				</td>
				<td>
					<?=$v['ch_memo']?>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="6">※ 검색 내역이 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>
	</table>

	<div class="btn-area-right">
		<form method="get" action="<?=$menu_url?>">
			<input type="hidden" name="act" value="<?=$bact?>" />
			<table class="table table-form" summary="검색 폼입니다.">
				<tbody>
					<tr>
						<td>
							<select name="sch_type" title="검색 타입">
								<?foreach($types as $k => $v):?>
								<option value="<?=$k?>" <?if($k == $sch_type):?>selected="selected"<?endif;?>><?=$v['name']?></option>
								<?endforeach;?>
							</select>
							<input type="text" name="sch_txt" value="<?=$sch_txt?>" title="검색어" class="normal" />
							<input type="submit" value="검색" class="btn btn-primary" />
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>

	<?if(count($paging->pages) > 0):?>

	<div id="paging">
		
		<ul class="pagination">
			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl(1)?>&amp;<?=$pager_add_url?>"><span>&lt;&lt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;<?=$pager_add_url?>" onclick="return false;"><span>&lt;&lt;</span></a></li>
			<?endif;?>


			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->prev)?>&amp;<?=$pager_add_url?>"><span>&lt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;<?=$pager_add_url?>" onclick="return false;"><span>&lt;</span></a></li>				
			<?endif;?>

			
			<?foreach($paging->pages as $k => $v):?>
			<li <?if($v == $paging->page):?>class="active"<?endif;?>>
				<a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($v)?>&amp;<?=$pager_add_url?>"><span><?=$v?></span></a>
			</li>
			<?endforeach;?>
			

			<?if($paging->next > 0):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->next)?>&amp;<?=$pager_add_url?>"><span>&gt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;<?=$pager_add_url?>" onclick="return false;"><span>&gt;</span></a></li>				
			<?endif;?>

			<?if($paging->page < $paging->totalPages):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->totalPages)?>&amp;<?=$pager_add_url?>"><span>&gt;&gt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;<?=$pager_add_url?>" onclick="return false;"><span>&gt;&gt;</span></a></li>				
			<?endif;?>

		</ul>

	</div>
	
	<?endif;?>
</div>


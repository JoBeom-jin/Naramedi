
<div class="btn-area-left">
	<a href="/index.php/Manager/contents/hos_joined" class="btn btn-primary">캐쉬관리</a>
	<a href="/index.php/Manager/contents/hos_joined?act=cash" class="btn btn-default">캐쉬 충전 이력</a>
</div>

<h2 class="title">제휴병원의 정보를 관리합니다.</h2>

<h3 class="title">등록된 제휴병원 목록</h3>
<div id="affiliated-list">
	<table class="table table-list" summary="검진기관 목록 입니다">
		<caption>검진기관 목록</caption>
		<colgroup>
			<col width="8%" />
			<col width="auto" />
			<col width="15%" />
			<col width="10%" />
			<col width="10%" />
			<col width="10%" />
		</colgroup>

		<thead>
			<tr>
				<th>No</th>
				<th>검진기관명</th>
				<th>검진기관번호</th>
				<th>누적사용 캐쉬</th>
				<th>보유 캐쉬</th>
				<th>캐쉬 충전</th>
			</tr>
		</thead>

		<tbody class="tcenter-all">
			<?if(count($list) > 0):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td><?=$paging->getPageNum($k);?></td>
				<td>
					<?=$v['hi_open_name']?>
				</td>
				<td>
					<?=$v['hi_org_number']?>
				</td>
				<td>
					<?if(is_array($cash_info) && in_array($v['hi_seq'], array_keys($cash_info) )):?>
					<?=number_format($cash_info[$v['hi_seq']]['out_total']);?>
					<?else:?>
					내역없음
					<?endif;?>
				</td>
				<td>
					<?if(is_array($cash_info) && in_array($v['hi_seq'], array_keys($cash_info) )):?>
					<?=number_format($cash_info[$v['hi_seq']]['total']);?>
					<?else:?>
					내역없음
					<?endif;?>
				</td>
				<td>
					<a href="<?=$menu_url?>/insertCash?seq=<?=$v['hi_seq']?>" onclick="window.open(this.href, 'cash', 'width=700, height=700'); return false;" class="btn btn-default">캐쉬충전</a>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="6">※ 등록된 제휴업체가 없습니다.</td>
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
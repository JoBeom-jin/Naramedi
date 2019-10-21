<h2 class="title">전화 예약 관리</h2>

<div class="btn-area-left">
	<a href="<?=$menu_url?>/insert"  class="btn btn-default">전화예약 신규등록</a>
</div>
<h3 class="title">전화 예약 관리</h3>

<div id="phone-reserve-list">
	<table class="table table-list" summary="전화예약 목록">
		<caption>전화예약 목록</caption>
		<colgroup>
			<col width="8%" />
			<col width="10%" />
			<col width="10%" />
			<col width="15%" />
			<col width="10%" />
			<col width="" />
		</colgroup>

		<thead>
			<tr>
				<th>NO</th>
				<th>등록일</th>
				<th>예약자명</th>
				<th>전화번호</th>
				<th>예약내역</th>
				<th>이벤트명/기관</th>
			</tr>
		</thead>
		<tbody class="tcenter-all">
			<?if(isArray_($list)):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td><?=$k+1?></td>
				<td><?=date('Y.m.d', $v['er_ctime'])?></td>
				<td>
					<a href="<?=$menu_url?>/modify?seq=<?=$v['er_seq']?>"><?=$v['er_name']?></a>
				</td>
				<td><?=$v['er_phone']?></td>
				<td>이벤트</td>
				<td>
					<?if(isset($hospital_list[$v['er_ainum']])):?><?=$hospital_list[$v['er_ainum']]['hi_open_name']?><?else:?><span style="color:red;">삭제됨</span><?endif;?>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="6">등록된 예약이 없습니다.</td>
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
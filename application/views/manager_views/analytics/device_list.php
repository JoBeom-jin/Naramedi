<h2 class="title">기기별 통계</h2>

<div class="btn-area-left">
	<a href="/index.php/Manager/contents/event_device/index?type=PC" class="btn btn-<?if($type=='PC'):?>primary<?else:?>default<?endif;?>">PC 이벤트 예약건수</a>
	<a href="/index.php/Manager/contents/event_device/index?type=MOBILE" class="btn btn-<?if($type=='MOBILE'):?>primary<?else:?>default<?endif;?>">모바일 이벤트 예약건수</a>
</div>

<h3 class="title"><?=$type?> 예약자 목록 (총 예약 인원 : <span class="tdanger"><?=$paging->totalRows?></span>명)</h3>

<table class="table table-list" summary="통계 관리 목록">
	<caption>예약자 목록</caption>
	<thead>
		<tr>
			<th>NO</th>
			<th>예약자</th>
			<th>예약일</th>
			<th>병원명</th>		
			<th>이벤트명</th>
		</tr>
	</thead>
	<tbody class="tcenter-all">
		<?if(isArray_($list)):?>
		<?foreach($list as $k => $v):?>
		<tr>			
			<td><?=$paging->getPageNum($k)?></td>
			<td>
				<?if($v['er_name']):?>
				<?=$v['er_name']?>				
				<?else:?>
				성명없음
				<?endif;?>
			</td>
			<td>
				<?=date('Y.m.d H:i', $v['er_ctime'])?>
			</td>
			<td><?=$v['hi_open_name']?></td>
			<td><?=$v['ei_name']?></td>		
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
<div id="all-event-list">
	<h2 class="title">이벤트 관리</h2>


	<div class="btn-area-right">
		<a href="<?=$menu_url?>/insertEvent" class="btn btn-primary">신규 이벤트 등록</a>
	</div>
	<h3 class="title"><?=$sub_title?> 목록</h3>

	<table class="table table-list" summary="승인 대기 중인 이벤트 목록입니다.">
		<caption><?=$sub_title?> 목록</caption>
		<colgroup>
			<col width="10%" />
			<col width="20%" />
			<col width="20%" />
			<col width="20%" />
			<col width="20%" />
			<col width="15%" />
		</colgroup>
		<thead>
			<tr>
				<th>No</th>
				<th>이미지</th>
				<th>이벤트명</th>
				<th>가격</th>
				<th>검진기관명</th>
				<th>검진기관번호</th>
			</tr>
		</thead>
		<tbody class="tcenter-all">
			<?if(is_array($list) && count($list)):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td><?=$paging->getPageNum($k);?></td>
				<td>
					<a href="<?=$menu_url?>/modifyEvent?seq=<?=$v['ei_seq']?>">
					<?if(is_file($v['ei_img_banner'])):?>
					<?$img_url = str_replace(DIRECTORY_SEPARATOR, '/', str_replace($dir_root, '', $v['ei_img_banner']));?>
					<img src="<?=$img_url?>" title="배너 이미지" style="width:100px;" />
					<?else:?>
					이미지 없음
					<?endif;?>
					</a>
				</td>
				<td>
					<?=$v['ei_name']?>
				</td>
				<td>
					<?=$v['ei_account']?>
				</td>
				<td>
					<?if(isset($v['hi_open_name'])):?>
					<?=$v['hi_open_name']?>
					<?else:?>
					<span style="color:red;">삭제됨</span>
					<?endif;?>
				</td>
				<td>
					<?if(isset($v['hi_org_number'])):?>
					<?=$v['hi_org_number']?>
					<?else:?>
					<span style="color:red;">삭제됨</span>
					<?endif;?>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="6">※ 검색된 이벤트가 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>
	</table>

	<?if($paging->pages && count($paging->pages) > 0):?>

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
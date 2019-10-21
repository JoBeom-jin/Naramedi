<div id="banner-list">
	<h2 class="title">배너관리</h2>

	<div class="btn-area-left">
		<a href="<?=$menu_url?>/insertBanner" onclick="window.open(this.href, 'banner-form', 'width=600, height=600'); return false" class="btn btn-primary">신규배너 등록</a>
	</div>
	<h3 class="title">등록된 배너 리스트</h3>		
	<table class="table table-list" summary="배너 목록 입니다.">	
		<caption>배너 목록</caption>
		<colgroup>
			<col width="5%" />
			<col width="" />
			<col width="35%" />
			<col width="7%" />			
			<col width="7%" />			
			<col width="8%" />			
		</colgroup>
		<thead>
			<tr>
				<th>NO</th>
				<th>이미지</th>
				<th>제목</th>
				<th>사용여부</th>
				<th>정렬</th>
				<th>기능</th>
			</tr>
		</thead>
		<tbody class="tcenter-all">
			<?if(isArray_($list)):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td><?=$paging->getPageNum($k)?></td>
				<td>
					<?if(is_file($v['eb_file_path'])):?>
					<a href="<?=$menu_url?>/updateBanner?seq=<?=$v['eb_seq']?>" onclick="window.open(this.href, 'banner-form', 'width=600, height=600'); return false">
						<img src="<?=path2url_($v['eb_file_path'])?>" alt="<?=$v['eb_subject']?>" style="width:150px;" />
					</a>
					<?else:?>
					<a href="<?=$menu_url?>/updateBanner?seq=<?=$v['eb_seq']?>" onclick="window.open(this.href, 'banner-form', 'width=600, height=600'); return false">[이미지없음]</a>
					<?endif;?>
				</td>
				<td><?=$v['eb_subject']?></td>
				<td>
					<?if($v['eb_use_flag'] == 'Y'):?>
					사용중
					<?else:?>
					<span style="color:red;">사용안함</span>
					<?endif;?>
				</td>
				<td><?=$v['eb_sort']?></td>
				<td>
					<a href="<?=$menu_url?>/deleteBanner?seq=<?=$v['eb_seq']?>" target="formReceiver" class="btn btn-danger" onclick="return confirm('삭제된 데이터는 복구하실 수 없습니다. 삭제하시겠습니까?');">삭제</a>
				</td>
			</tr>			
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="5">※ 등록된 배너가 없습니다.</td>
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
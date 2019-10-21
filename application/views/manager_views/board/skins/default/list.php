<div id="board-list">

	<div class="btn-area">
		<a href="<?=$menu_url?>?bcid=<?=$bcid?>&amp;act=insert" class="btn btn-primary">글쓰기</a>
	</div>	

	<table class="table table-list" summary="게시글 목록">
		<caption>게시글 목록</caption>
		<colgroup>
			<col width="5%" />
			<col width="65%" />
			<col width="10%" />
			<col width="15%" />
			<col width="5%" />
		</colgroup>
		<thead>
			<tr>
				<th>No</th>
				<th>제목</th>
				<th>글쓴이</th>
				<th>날짜</th>
				<th>HIT</th>
			</tr>
		</thead>

		<tbody>
			<?if(is_array($list) && count($list) > 0):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td class="tcenter">
					<?if($v['bd_notice_flag'] == 'Y'):?>
					<strong class="strong">공지</strong>
					<?else:?>
					<?=$paging->getPageNum($k)?>
					<?endif;?>					
				</td>
				<td>
					<a href="<?=$menu_url?>?bcid=<?=$bcid?>&amp;act=view&amp;seq=<?=$v['bd_seq']?>">
					<?=$v['bd_subject']?>
					</a>
				</td>
				<td class="tcenter">
					<?if($v['bd_name']):?>
					<?=$v['bd_name']?>
					<?else:?>
					무명
					<?endif;?>
				</td>
				<td class="tcenter">
					<?=date('Y.m.d H:i', $v['bd_ctime'])?>
				</td>
				<td class="tcenter">
					<?=number_format($v['bd_view_cnt'])?>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="5">※ 등록된 글이 없습니다.</td>
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
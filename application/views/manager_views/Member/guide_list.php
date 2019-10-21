<div id="guide-list">
	<h2 class="title">제휴문의 관리</h2>

	<h3 class="title">등록된 제휴문의 목록</h3>
	<table class="table table-list" summary="제휴문의 목록">
		<caption>제휴문의목록</caption>
		<colgroup>
			<col width="5%" />
			<col width="8%" />
			<col width="15%" />
			<col width="10%" />
			<col width="8%" />
			<col width="auto" />
		</colgroup>
		<thead>
			<tr>
				<th>No</th>
				<th>타입</th>
				<th>이름</th>
				<th>이메일</th>
				<th>등록일</th>
				<th>문의내용</th>				
				<th>상태</th>
				<th>처리완료</th>
			</tr>
		</thead>
		<tbody>
			<?if(isArray_($list)):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td class="tcenter"><?=$paging->getPageNum($k)?></td>
				<td class="tcenter"><?=$_types[$v['mq_type']]?></td>
				<td class="tcenter"><?=$v['mq_name']?></td>
				<td class="tcenter"><?=$v['mq_email']?></td>
				<td class="tcenter"><?=date('Y.m.d', $v['mq_ctime'])?></td>
				<td><?=nl2br($v['mq_text'])?></td>
				<td class="tcenter">
					<?if(!$v['mq_status']){ $v['mq_status'] = 'QSA001';}?>
					<?=$_status_codes[$v['mq_status']]?>				
				</td>
				<td class="tcenter">
					<?if($v['mq_status'] == 'QSA001'):?>
					<a href="<?=$menu_url?>/complete?seq=<?=$v['mq_seq']?>"  target="formReceiver" class="btn btn-default">처리완료</a>			
					<?else:?>
					완료
					<?endif;?>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="6">※ 등록된 문의 내용이 없습니다.</td>
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
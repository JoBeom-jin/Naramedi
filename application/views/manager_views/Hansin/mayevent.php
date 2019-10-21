<h2 class="title">5월 가정의달 건강검진</h2>

<h3 class="title">신청자 목록</h3>

<div id="hansin-users">
	<table class="table table-list" summary="신청자의 이름, 전화 번호등의 정보 목록을 보여줍니다.">
		<caption>신청자 목록</caption>
		<colgroup>
			<col width="5%" />
			<col width="10%" />
			<col width="15%" />
			<col width="10%" />
			<col width="" />
			<col width="15%" />
			<col width="10%" />
			<col width="8%" />
		</colgroup>

		<thead>
			<tr>
				<th>No</th>
				<th>이름</th>
				<th>검진병원</th>
				<th>연락처</th>
				<th>문의내용</th>
				<th>이메일</th>
				<th>등록일</th>
				<th>삭제</th>
			</tr>
		</thead>
		<tbody>
			<?if(is_array($list) && count($list) > 0 ):?>
			<?foreach($list as $k => $v):?>
			<?php if ($v['hu_code'] != 'nm' ) { continue;} ?>
			<tr>
				<td class="tcenter"><?=$paging->getPageNum($k)?></td>
				<td class="tcenter"><?=$v['hu_name']?></td>
				<td class="tcenter"><?=$types[$v['hu_type_code']]?></td>
				<td class="tcenter"><?=$v['hu_phone']?></td>
				<td><?=$v['hu_comment']?></td>
				<td class="tcenter"><?=$v['hu_email']?></td>
				<td class="tcenter"><?=date('Y.m.d H시', $v['hu_ctime'])?></td>
				<td class="tcenter">
					<a href="<?=$menu_url?>/deleteOk/seq/<?=$v['hu_seq']?>" target="formReceiver" class="btn btn-danger" onclick="return confirm('테스트를 위해 제공되는 기능입니다.\n삭제된 데이터는 복구되지 않습니다. 삭제하시겠습니까?');">삭제</a>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="8">※ 등록된 정보가 없습니다.</td>
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
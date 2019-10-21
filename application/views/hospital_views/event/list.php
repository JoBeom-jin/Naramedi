<div id="event-list">
	<h2 class="title">이벤트 관리</h2>

	<div class="btn-area-left">
		<a href="<?=$menu_url?>?active=Y" class="btn <?if($active == 'Y'):?>btn-primary<?else:?>btn-default<?endif;?>">진행중인 이벤트 목록</a>
		<a href="<?=$menu_url?>?active=N" class="btn <?if($active == 'N'):?>btn-primary<?else:?>btn-default<?endif;?>">종료된 이벤트 목록</a>		
	</div>

	<div class="btn-area-right">
		<a href="<?=$menu_url?>/insertEvent" class="btn btn-primary">신규 이벤트 등록</a>
	</div>

	<h3 class="title">등록된 이벤트 목록 입니다.</h3>
	<table class="table table-list" summary="이벤트 목록입니다. 이벤트 이름, 섬네일, 기간 등의 정보를 보여줍니다.">
		<caption>이벤트 목록</caption>
		<thead>
			<tr>
				<th>No</th>
				<th>이미지</th>
				<th>이벤트명</th>
				<th>가격</th>
				<th>신청자현황</th>
				<th>기간</th>
				<th>상태값</th>
			</tr>
		</thead>
		<tbody class="tcenter-all">
			<?if(is_array($list) && count($list) > 0):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td><?=$paging->getPageNum($k)?></td>
				<td>
					<a href="<?=$menu_url?>/modifyEvent?seq=<?=$v['ei_seq']?>">
						<?if($v['thum']):?>
						<img src="<?=$v['thum']?>" alt="<?=$v['ei_name']?>" style="width:100px"/>
						<?else:?>
						이미지없음
						<?endif;?>
					</a>
				</td>
				<td>
					<?=$v['ei_name']?>
				</td>
				<td>
					<?=number_format($v['ei_account'])?>
				</td>
				<td>
					<?if(is_array($count_list) && isset($count_list[$v['ei_seq']])):?>
					<?=$count_list[$v['ei_seq']]['cnt']?>
					<?else:?>
					0
					<?endif;?>
				</td>
				<td>
					<?=date('Y-m-d', $v['ei_start'])?>					
					&nbsp; ~ &nbsp;
					<?=date('Y-m-d', $v['ei_end'])?>
				</td>
				<td>
					<?=$v['status']?>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>				
				<td colspan="7">※ 검색된 정보가 없습니다.</td>
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
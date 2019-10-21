<div id="complete-reserve-list">
	<h2 class="title">누적예약자 현황</h2>

	<h3 class="title">누적예약자 정보 목록 입니다.</h3>
	<table class="table table-list" summary="누적 예약자 목록입니다.">
		<caption>누적 예약자목록</caption>
		<thead>
			<tr>
				<th>NO</th>
				<th>구분</th>
				<th>예약방식</th>
				<th>신청자명</th>
				<th>신청자전화번호</th>
				<th>신청일</th>
				<th>예약일</th>
				<th>이벤트명</th>
				<th>금액</th>
				<th>결과</th>
			</tr>
		</thead>
		<tbody class="tcenter-all">
			<?if(isArray_($list)):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td><?=$paging->getPageNum($k)?></td>
				<td>
					<input type="button" value="<?=$_malls[$v['er_mall']]['name']?>" class="btn btn-<?=$_malls[$v['er_mall']]['color']?>"/>
				</td>
				<td>
					<?=$_method[$v['er_method']]['name']?>
				</td>
				<td>
					<?if($v['er_name']):?>
					<?=$v['er_name']?>
					<?else:?>
						<span class="talert strong">무명</span>
					<?endif;?>
				</td>
				<td>
					<?=$v['er_phone']?>
				</td>
				<td>
					<?=date('Y.m.d H:i', $v['er_ctime'])?>
				</td>
				<td>
					<?if($v['er_reserve_time']):?>
						<?=date('Y.m.d', $v['er_reserve_time'])?>
					<?else:?>
						<span class="talert strong">미정</span>
					<?endif;?>
				</td>
				<td>
					<?if($v['ei_name']):?>
					<?=$v['ei_name']?>
					<?else:?>
					-
					<?endif;?>
				</td>
				<td>
					<?=number_format($v['er_account'])?> 원
				</td>
				<td>
					<span style="color:<?=$_status[$v['er_status']]['bg_color']?>;"><?=$_status[$v['er_status']]['name']?></span>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="10">※ 누적 예약자가 없습니다.</td>				
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

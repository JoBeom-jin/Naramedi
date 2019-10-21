<div id="board-list">
<div>
	<img src="/resource/images/mobile/post/notice.png" alt="notice메인이미지" style="width:100%;">
</div>
	<table summary="전체 공지사항 목록 입니다." style="width:100%; margin:15px 0px;">		
		<caption class="hide">공지사항</caption>
		<thead>
			<!-- <tr>
				<th colspan="3"><font size="5">OK건강검진 공지사항</font></th>
			</tr> -->
			<tr>
				<th style="text-align:center;">제목</th>
				<th style="text-align:center;">등록일</th>
			</tr>
		</thead>
		<tbody style="background-color: #fff;">
			<?if(is_array($list) && count($list) > 0):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td style="padding:0 5px 0 10px; text-align:left; font-size:12px; line-height: 25px;">
					<a href="<?=$menu_url?>?act=view&amp;seq=<?=$v['bd_seq']?>" style="width:70%;"><?=$v['bd_subject']?></a>
				
				</td>
				<td style="padding:0 5px 0 10px; text-align:left; font-size:12px; ">
					<p style="color:#737373; text-align:center; width:30%;"><?=date('Y.m.d', $v['bd_ctime'])?></p>
				
				</td>
				
			</tr>	
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="3" style="text-align:center;">※ 등록된 게시글이 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>
	</table>

	<!--end Listing Grid-->
	<?if(count($paging->pages) > 0):?>
	<!--Pagination-->
	<nav>
		<ul class="pagination pull-right">
			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->prev)?>" class="previous"><i class="fa fa-angle-double-left" style="font-size: 1rem;padding-right: 5px;"></i>처음</a></li>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->prev)?>" class="previous"><i class="fa fa-angle-left" style="font-size: 1rem;padding-right: 5px;"></i>이전</a></li>
			<?else:?>
			<li class="disabled"><a href="#talbe-list" class="previous"  onclick="return false;"><i class="fa fa-angle-double-left" style="font-size: 1rem;padding-right: 5px;"></i>처음</a></li>	
			<li class="disabled"><a href="#talbe-list" class="previous"  onclick="return false;"><i class="fa fa-angle-left" style="font-size: 1rem;padding-right: 5px;"></i>이전</a></li>								
			<?endif;?>

			<?foreach($paging->pages as $k => $v):?>
			<li <?if($v == $paging->page):?>class="active"<?endif;?>>
				<a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($v)?>" style="border:0px;"><font color="#1e67c6"><?=$v?></font>/3</a>
				
			</li>
			<?endforeach;?>		

			<?if($paging->next > 0):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->next)?>" class="next">다음<i class="fa fa-angle-right" style="font-size: 1rem;padding-left: 5px;"></i></a></li>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->next)?>" class="next">마지막<i class="fa fa-angle-double-right" style="font-size: 1rem;padding-left: 5px;"></i></a></li>
			<?else:?>
			<li class="disabled"><a href="#table-list" class="next" onclick="return false;">다음<i class="fa fa-angle-right" style="font-size: 1rem;padding-left: 5px;"></i></a></li>
			<li class="disabled"><a href="#table-list" class="next" onclick="return false;">마지막<i class="fa fa-angle-double-right" style="font-size: 1rem;padding-left: 5px;"></i></a></li>							
			<?endif;?>			
		</ul>
	</nav>
	<!-- END :: Pagination-->
	<?endif;?>
	<div style="clear:both;">&nbsp;</div>
</div>

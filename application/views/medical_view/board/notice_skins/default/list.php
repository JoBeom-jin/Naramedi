<style>
	.pagination li:first-child a,
	.pagination li:last-child a {
		border-radius: 0 !important;
	}

	.pagination li a {
		border-radius: 0 !important;
		box-shadow: none !important;
		border: 1px solid #d9d9d9 !important;
		margin: 0 -1px 0 0 !important;
	}

	.pagination li a:hover {
		background-color: #f5f5f5;
	}
	th{
		text-align: center;
	}
th:first-child{
  padding: 0 15px 0 15px;
}
td:nth-child(2n-1) {
  padding: 0 15px 0 15px;
  background-color: white;
  text-align: center;
}
</style>
<section class="hero-image" style="height: 640px !important;">
	<div class="background" style="background:url(/resource/images/medical/notice/notice_top.png) center;">
	</div>
</section>
<div class="container" style="padding-top: 60px;">

	<div class="at-icon-box-text ">
		<h1 class="page-title">공지사항</h1>
	</div>

	<table>
		<caption class="hide">공지사항</caption>
		<colgroup>
			<col width="10%" />
			<col width="auto" />
			<col width="10%" />
			<col width="10%" />
		</colgroup>
		<thead>
			<tr>
				<th>번호</th>
				<th>제목</th>
				<th>작성자</th>
				<th>작성일</th>
			</tr>
		</thead>
		<tbody style="background-color: #fff;">
			<?if(is_array($list) && count($list) > 0):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td>
					<?
					if ($v['bd_notice_flag'] == 'Y') {

					?>
					<img src="/resource/images/medical/notice/notice_flag.png" alt="공지" style="padding-bottom: 4.5px;">
					<?
					}else{
						echo $paging->getPageNum($k);
					}
					?>
				</td>
				<td><a href="<?=$menu_url?>?act=view&amp;seq=<?=$v['bd_seq']?>">
						<?=$v['bd_subject']?></a></td>
				<td>
					<?=$v['bd_name'] ?>
				</td>
				<td style="text-align:center;">
					<?=date('Y.m.d', $v['bd_ctime'])?>
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
	<div class="container" style="text-align: center">
		<ul class="pagination" style="margin: auto !important">
			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl(1)?>" style="margin-right: 10px !important;" ><i class="fa fa-angle-double-left" style="color: #666666;" ></i></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>" onclick="return false;" style="margin-right: 10px !important;" ><i class="fa fa-angle-double-left" style="color: #666666;" ></i></a></li>
			<?endif;?>

			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->prev)?>" class="previous"><i class="fa fa-angle-left" style="color: #666666;" ></i></a></li>
			<?else:?>
			<li class="disabled"><a href="#talbe-list" class="previous" onclick="return false;"><i class="fa fa-angle-left" style="color: #666666;" ></i></a></li>
			<?endif;?>

			<?foreach($paging->pages as $k => $v):?>
			<li <?if($v==$paging->page):?>class="active"
				<?endif;?>>
				<a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($v)?>">
					<?=$v?></a>
			</li>
			<?endforeach;?>


			<?if($paging->next > 0):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->next)?>" class="next"><i class="fa fa-angle-right" style="color: #666666;" ></i></a></li>
			<?else:?>
			<li class="disabled"><a href="#table-list" class="next" onclick="return false;"><i class="fa fa-angle-right" style="color: #666666;" ></i></a></li>
			<?endif;?>

			<?if($paging->page < $paging->totalPages):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->totalPages)?>" style="margin-left: 10px !important;" ><i class="fa fa-angle-double-right" style="color: #666666;" ></i></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>" onclick="return false;" style="margin-left: 10px !important;" ><i class="fa fa-angle-double-right" style="color: #666666;" ></i></a></li>				
			<?endif;?>

		</ul>
	</div>
	<!-- END :: Pagination-->
	<?endif;?>
</div>
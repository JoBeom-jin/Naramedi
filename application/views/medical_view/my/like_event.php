<section class="container">
	<div class="">
		<!--Content-->
		<div class="">


		<header>
			<h1 class="page-title">찜한 상품</h1>
		</header>

		<!--Listing Grid-->
		<section class="block equal-height">
			<div class="row">

				<?if(is_array($checked_list) && count($checked_list) > 0):?>
				<?foreach($checked_list as $k => $v):?>			
				<div class="col-md-6 col-sm-6">
					<div class="item" style="height:351px; overflow:hidden;">
						<div class="image">						
							<div class="overlay">
								<div class="inner">
								</div>
							</div>

							<a href="/index.php/medical/contents/event_hospital/viewEvent?seq=<?=$v['ei_seq']?>">
								<?if($v['banner']):?>
								<img src="<?=$v['banner']?>" alt="<?=$v['ei_name']?>" style="width:555px; height:242px;" >
								<?endif;?>
							</a>	
						</div>

						<div class="wrapper" style="position:relative;">

							<a href="/index.php/medical/contents/event_hospital/viewEvent?seq=<?=$v['ei_seq']?>"><h3><?=$v['ei_name']?></h3></a>


							<a href="<?=$contents_url?>/my_check?seq=<?=$v['ei_seq']?>" style="position:absolute; top:20px; right:20px; display:block; width:35px; height:35px;" target="formReceiver" id="eiseq_<?=$v['ei_seq']?>">
								<?if(in_array($v['ei_seq'], $like_list)):?>
								<i class="fa fa-heart fa-2x" style="color:red; "></i>
								<?else:?>
								<i class="fa fa-heart-o fa-2x" style="color:red; "></i>
								<?endif;?>
							</a>


							<div class="price">
								<?=number_format($v['ei_account'])?> 원
							</div>	

							<font size=2 color=#818181>(~<?=date('Y년 m월 d일', $v['ei_end']) ?>까지)</font>

							<figure>
								<font size=2 color=black><b><?=$v['hi_open_name']?>&nbsp;&nbsp;</b></font><i class="fa fa-map-marker" style="color:red"></i><?=$v['ai_addr']?>
							</figure>

						</div>
					</div>
					<!-- /.item-->
				</div>
				<?endforeach;?>
				<?endif;?>


			</div>										
			<!--/.row-->
		</section>
		<!--end Listing Grid-->
		
		<?if(count($paging->pages) > 0):?>
		<!--Pagination-->
		<nav>
			<ul class="pagination pull-right">
				<?if($paging->page > 1):?>
				<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->prev)?>" class="previous"><i class="fa fa-angle-left"></i></a></li>
				<?else:?>
				<li class="disabled"><a href="#talbe-list" class="previous"  onclick="return false;"><i class="fa fa-angle-left"></i></a></li>									
				<?endif;?>

				<?foreach($paging->pages as $k => $v):?>
				<li <?if($v == $paging->page):?>class="active"<?endif;?>>
					<a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($v)?>"><?=$v?></a>
				</li>
				<?endforeach;?>		
				

				<?if($paging->next > 0):?>
				<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->next)?>" class="next"><i class="fa fa-angle-right"></i></a></li>
				<?else:?>
				<li class="disabled"><a href="#table-list" class="next" onclick="return false;"><i class="fa fa-angle-right"></i></a></li>							
				<?endif;?>

				
			</ul>
		</nav>
		<!-- END :: Pagination-->
		<?endif;?>





</section>
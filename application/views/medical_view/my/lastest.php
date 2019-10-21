<section class="container">
	<div class="">
		<!--Content-->
		<div class="">


		<header>
			<h1 class="page-title">최근 본 상품</h1>
		</header>

		<!--Listing Grid-->
		<section class="block equal-height">
			<div class="row">

				<?if(is_array($list) && count($list) > 0):?>
				<?foreach($list as $k => $v):?>			
				<div class="col-md-6 col-sm-6">
					<div class="item">
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

</section>
<section class="container3" id="lastest-list">
	<div class="">
		<!--Content-->
		<div class="">


		<header>
			<img src="/resource/images/mobile/arrow-icon.png" onclick="javascript:history.back()" alt="arrow-icon"style="width: 20px;float: left;margin-left: 15px;">
			<h1 class="page-title page-title2">최근 본 상품</h1>
		</header>

		<!--Listing Grid-->
		<section class="block equal-height">
			<div class="row" style="margin:0px; min-height:400px;  background: #f1f1f1;">

				<?if(is_array($list) && count($list) > 0):?>
				<?foreach($list as $k => $v):?>			
				<div class="col-md-6 col-sm-6 " style="padding:0px;">
					<div style="background:#fff;float: left; width: 100%; margin-top:6px;">
						<div class="item" style=" background:#fff;">
							<div class="image" style="width:110px; height:122px; background:#cdcdcd; float:left;">						
								<div class="overlay">
									<div class="inner">
									</div>
								</div>

								<!-- <a href="/m/index.php/mobile/contents/event_hospital/viewEvent?seq=<?=$v['ei_seq']?>">
									<?if($v['banner']):?>
									<img src="<?=$v['banner']?>" alt="<?=$v['ei_name']?>" style="width:555px; height:242px;" >
									<?endif;?>
								</a>	 -->
							</div>

							<div class="wrapper" style="position:relative; float:left; ">

							<figure>
							<?=$v['hi_open_name']?>
							</figure>
								<a href="/m/index.php/mobile/contents/event_hospital/viewEvent?seq=<?=$v['ei_seq']?>"><h3 style="font-size:18px;"><?=$v['ei_name']?></h3></a>


								<!-- <a href="<?=$contents_url?>/my_check?seq=<?=$v['ei_seq']?>" style="position:absolute; top:20px; right:20px; display:block; width:35px; height:35px;" target="formReceiver" id="eiseq_<?=$v['ei_seq']?>">
									<?if(in_array($v['ei_seq'], $like_list)):?>
									<i class="fa fa-heart fa-2x" style="color:red; "></i>
									<?else:?>
									<i class="fa fa-heart-o fa-2x" style="color:red; "></i>
									<?endif;?>
								</a> -->


								<div class="item-desc">
								추천대상 &nbsp;&nbsp;&nbsp;&nbsp; 30,40대 <br/>
								이벤트기간 &nbsp; <?=date('Y년 m월 d일', $v['ei_end'])?>까지 <br/>
								</div>
								<div class="price">
									<font style='font-size:60%; text-decoration:line-through'>660,000원</font>
									<?=number_format($v['ei_account'])?> 원
								</div>	
								<br/>
								<!-- <font size=2 color=#818181>(~까지)</font> -->
								<!-- <figure>
									<font size=2 color=black><b><?=$v['hi_open_name']?>&nbsp;&nbsp;</b></font><i class="fa fa-map-marker" style="color:red"></i><?=$v['ai_addr']?>
								</figure> -->

							</div>
						</div>
					<!-- /.item-->
					</div>
				</div>
				<?endforeach;?>
				
				<?else:?>
						<div style="text-align:center;  background: #f1f1f1; border:none; line-height: 20px;">
						<img src="/resource/images/mobile/alert-icon.png" alt="alert-icon" style="width:42px; margin-top:20px;  margin-bottom: 10px;"><br/>내역이 없습니다.<br/> OK검진에서 다양한 의료정보와 혜택을 찾아보세요.</td>
						</div>
						
				<?endif;?>


			</div>										
			<!--/.row-->
		</section>
		<!--end Listing Grid-->

</section>
<style>
#page-top{
	display:none;
}
.item-desc{
	font-size:12px;
}
.item .wrapper{
	padding:5px 5px 5px 5px;
}
@media (min-width: 360px){
	.item .wrapper{
	padding:5px 5px 5px 20px;
	}
}

</style>
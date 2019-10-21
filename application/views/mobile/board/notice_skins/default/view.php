<div id="board-view">
	<section class="container3">
	<div>
	<img src="/resource/images/mobile/post/notice.png" alt="notice메인이미지" style="width:100%;">
</div>
		<!--Item Detail Content-->
		<div class="row" style="margin: 15px 0px 0px; heigth:100%;">

			<div class="col-md-2 col-sm-2"></div>

			<div class="col-md-8 col-sm-8 bg-white" style="border-top: 1px solid #393f4b;; border-bottom: 1px solid #cdcdcd;min-height: 0px; padding:0px;">
				<section class="block" id="main-content">
					<div class="col-md-12 col-sm-12" style="padding:0px;">
						<section>
							<!-- /.block -->
							<article class="block6" style="border-bottom:1px solid #cdcdcd;">
								<header><h1 style="margin:10px; font-size:15px;"><?=$article['bd_subject']?></h1></header>
							</article>
							<article class="block4" style="border-bottom:1px solid #cdcdcd; padding:10px;">
							<font color="gray" size="2px">운영자</font>
							<font color="gray" size="2px" style="float:right;"><?=date('Y.m.d', $article['bd_ctime'])?></font>
							</article>
							<article class="block4" style="padding:0px 10px;">
								<?$img_max_width = 1024;?>
								<?if(count($article['files']) > 0):?>										
								<?for($i=0, $j=count($article['files']) ; $i < $j ; $i++):?>
									<?$file = $article['files'][$i];?>

									<?if(in_array(strtolower($file['bf_ext']), array('jpg', 'gif', 'png', 'jpeg'))):?>
									<div class="image-list">
										<img src="<?=$file['url']?>" alt="" <?if($file['bf_width'] > $img_max_width):?><?endif;?> />
									</div>
									<?endif;?>
								<?endfor;?>						
								<?endif;?>

								<div class="bd_content_so" style="margin-top:20px;">
									<font size="4px">
										<?=$article['bd_content']?>
									</font>
								</div>
							</article>
						<!-- /.block -->
						</section>
					</div>

						<!-- /.col-md-8-->
				</section>
						<!-- /#main-content-->
			</div><!-- /.col-md-8-->

			<div class="col-md-2 col-sm-2"></div>
		</div> <!--row-->

	<!-- 공지사항 이전글, 다음글 기능 -->
		<div class="row" style="margin:0px;">

			<div class="col-md-2 col-sm-2"></div>
			<div class="post_title" style="height:140px;">
				<div class="prv_post_title" style="padding: 10px; border-bottom: 1px solid #cdcdcd;">
				<i class="fa fa-angle-up" style="font-weight:bold;"></i>
				<a href="<?=$menu_url?>?act=view&amp;seq=125">
				<span style="font-weight:bold;">이전글</span> ?act=view&amp;seq=125
				</a>
				</div>
				<div class="next_post_title" style="padding: 10px; border-bottom: 1px solid #cdcdcd;">
				<i class="fa fa-angle-down" style="font-weight:bold;"></i>
				<a href="<?=$menu_url?>?act=view&amp;seq=101">
				<span style="font-weight:bold;">다음글</span> ?act=view&amp;seq=101
				</div>
				</a>
				<div class="btn-area-center">
					<a href="<?=$menu_url?>" id="" class="btn btn-default" style="background:#393f4b; width:25%; padding: 8px;">목록</a>
				</div>

			</div>

			<!-- <div class="col-md-8 col-sm-8">
				<section class="block" id="main-content">
					<a href="<?=$menu_url?>" class="button button-big button-border2 button-rounded2" style="float:right;"><span>목록으로</span></a>

					<div class="col-md-2 col-sm-2"></div>
				</section>
			</div> -->
			<!-- end Page Content-->
		</div>

	</section>
</div>
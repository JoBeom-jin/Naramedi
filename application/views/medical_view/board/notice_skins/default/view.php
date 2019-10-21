<style>
table{
	width: 1140px !important;
}
th{
	text-align: center;
}
td:nth-child(2n-1) {
  padding: 0 15px 0 15px !important;
  background-color: white;
}
</style>
<section class="hero-image" style="height: 640px !important;">
	<div class="background" style="background:url(/resource/images/medical/notice/notice_top.png) center;">
	</div>
</section>
<section class="container">

	<div class="at-icon-box-text ">
		<h1 class="page-title">공지사항</h1>
	</div>
	<!--Item Detail Content-->

	<div class="bg-white" style="/*border:1px solid #cdcdcd;*/">
		<section class="block" id="main-content">
			<div>
				<section>
					<!-- /.block -->
					<table style="text-align: center !important;">
						<caption class="hide">공지사항</caption>
						<colgroup>
							<col width="15%" />
							<col width="auto" />
							<col width="15%" />
							<col width="10%" />
						</colgroup>
						<thead>
							<tr>
								<th>작성자</th>
								<th>제목</th>
								<th>작성일</th>
								<th>조회수</th>
							</tr>
						</thead>
						<tbody style="background-color: #fff;">
							<tr>
								<td>
									<?=$article['bd_name']?>
								</td>
								<td>
									<?=$article['bd_subject']?>
								</td>
								<td>
									<?=date('Y.m.d', $article['bd_ctime'])?>
								</td>
								<td>
									<?=$article['bd_view_cnt']?>
								</td>
							</tr>

						</tbody>
					</table>
					<!-- 
						<article class="block3">
							<header>
								<h1>
									<?=$article['bd_subject']?>
								</h1>
								<font color="gray" size="4px">
									<?=date('Y.m.d', $article['bd_ctime'])?>
								</font>
							</header>
							<hr>
						</article> -->

					<article class="block3" style="border-bottom: 1px black solid; margin-bottom: 50px;
					
					">
						<?$img_max_width = 1024;?>
						<?if(count($article['files']) > 0):?>
						<?for($i=0, $j=count($article['files']) ; $i < $j ; $i++):?>
						<?$file = $article['files'][$i];?>

						<?if(in_array(strtolower($file['bf_ext']), array('jpg', 'gif', 'png', 'jpeg'))):?>
						<div class="image-list">
							<img src="<?=$file['url']?>" alt="" <?if($file['bf_width']> $img_max_width):?>style="width:100%;"
							<?endif;?>/>
						</div>
						<?endif;?>
						<?endfor;?>
						<?endif;?>

						<div style="margin-top:20px;">
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


	<div class="row">

		<div class="">
				<section class="block" id="main-content" style="width: 164px; height: 48px; float: left; visibility: hidden;">
					<a href="<?=$menu_url?>">
						<div style="margin: auto; width: 164px; height: 48px; border: none; background-image: url('/resource/images/medical/notice/content_arrow_pre.png'); background-repeat: no-repeat;background-position: center;">&nbsp;</div>
					</a>
				</section>
				<section class="block" id="main-content" style="width: 164px; height: 48px; margin: 0 calc(100vw/2 - 450px); position: absolute;">
					<a href="<?=$menu_url?>">
						<div style="margin: auto; width: 164px; height: 48px; border: none; background-color: #195ab4; color: white; font-size: 16px; line-height: 48px; text-align: center">목록</div>
					</a>
				</section>
				<section class="block" id="main-content" style="width: 164px; height: 48px; float: right; visibility: hidden;">
					<a href="<?=$menu_url?>">
						<div style="margin: auto; width: 164px; height: 48px; border: none; background-image: url('/resource/images/medical/notice/content_arrow_next.png'); background-repeat: no-repeat;background-position: center;">&nbsp;</div>
					</a>
				</section>
		</div>
		<!-- end Page Content-->
	</div>

</section>
<style>
	#photo-list{}
		#photo-list .item{height:auto;}		
		#photo-list .board-clear{height:2px; width:100%; clear:both;}	
		
		#menu-box{
			outline: 1px #d7d7d7 solid;
		}
		.menu-on{
			color: #4a75ba;
		}
</style>
<section class="hero-image" style="height: 640px !important;">
	<div class="background" style="background:url(/resource/images/medical/health_post/health_post_top.png) center;">
	</div>
</section>
<!-- container -->
<div class="container" id="borde-health" style="position: absolute; top: 569px; left: calc(100vw/2 - 587px); padding-top: 0px;">

<?php

		$bdc_seq = $_REQUEST['bdc_seq'];
		$bdc_seq_1 = null;
		$bdc_seq_3 = null;
		$bdc_seq_4 = null;
		if (isset($bdc_seq)) {
			switch ($bdc_seq) {
				case '1':
					$bdc_seq_1 = "menu-on";
					break;
				case '4':
					$bdc_seq_4 = "menu-on";
					break;
				case '3':
					$bdc_seq_3 = "menu-on";
					break;
				default:
					break;
			}
		}

?>

	<div class="col_third" id="menu_box">
		<div class="at-icon-box" style="background-color:white !important; color: #666666;">

			<div class="at-icon-box-text ">
				<h4 class="<?=$bdc_seq_1?>">건강정보</h4>
			</div>


			<a class="link" href="<?=$menu_url?>/<?=$act?>?bdc_seq=1"></a>
		</div>
	</div>

	<div class="col_third" id="menu_box">
		<div class="at-icon-box" style="background-color:white !important; color: #666666;">

			<div class="at-icon-box-text ">

				<h4 class="<?=$bdc_seq_4?>">검진항목</h4>
			</div>

			<a class="link" href="<?=$menu_url?>/<?=$act?>?bdc_seq=4"></a>
		</div>
	</div>

	<div class="col_third" id="menu_box">
		<div class="at-icon-box" style="background-color:white !important; color: #666666;">
			<div class="at-icon-box-text ">

				<h4 class="<?=$bdc_seq_3?>">자주하는 질문</h4>
			</div>


			<a class="link" href="<?=$menu_url?>/<?=$act?>?bdc_seq=3"></a>
		</div>
	</div>
</div>
<!-- END :: container -->

<style>
	.btn-default{
		/* outline: 1px solid #d7d7d7 !important; */
		outline: 1px solid #c9c9c9 !important;
	}
	.btn-group{
		margin-top: 1px;
	}
	.dropdown-menu{
		margin-top: 0px !important;
		outline: 1px solid #c9c9c9 !important;
		box-shadow: none !important;
	}
	#box-outline{
		/* outline: 1px solid #d7d7d7 !important; */
		outline: none !important;
		border: none !important;
		box-shadow: none;
		margin-left: 10px;
	}
	#search-button{
		height: 41px;
		width: 79px;
		background-color: #1e67c6;
		background-image: url('/resource/images/medical/health_post/search.png');
		background-position: center;
		background-repeat: no-repeat;
	}

</style>


<!-- section.container -->
<section class="container">
	<div class="">
		<!--Content-->
		<div class="">
			<figure class="filter clearfix" style=" margin:0 0 30px 0; padding:0; height:65px; border-bottom: 2px #393f4b solid;">
				<div style="float: left;">
					<h1 class="page-title">
						<?if(isset($bdc_seq) && $bdc_seq):?>
						<?=$categories[$bdc_seq]['bdc_name']?>
						<?else:?>
						전체목록
						<?endif;?>
					</h1>
				</div>
				<div style="float: right;">
					<form method="get" action="<?=$menu_url?>/<?=$act?>">
						<input type="hidden" name="bdc_seq" value="<?=$bdc_seq?>" />

						<div style="text-align:left; padding-left:0; float: left;">
							<select name="sch_type" title="검색 종류 선택">
								<option value="subject" <?if($sch_type=='subject' ):?>selected="selected"
									<?endif;?>>제목</option>
								<option value="comment" <?if($sch_type=='comment' ):?>selected="selected"
									<?endif;?>>내용</option>
							</select>
						</div>
						<div class="fixed" id="box-outline" style="float:left">
							<input type="text" name="sch_text" value="<?=$sch_text?>" title="검색어 입력" placeholder="검색어 입력" class="form-input"/>						</div>
						<div class="tcenter fixed" style="float:left">
							<input type="submit" value="" class="btn btn-primary" id="search-button" />
						</div>
						<!-- <div>
							<span style="color:#e0534c; font-weight:bold; vertical-align:bottom;">
								<?=$paging->totalRows?>개</span>의 정보가 있습니다.
						</div> -->
					</form>
				</div>
			</figure>

			<!--Listing Grid-->
			<section class="block equal-height" id="total-page" data-total="<?=$paging->totalPages?>" style="padding: 1px;">
				<?if(is_array($list) && count($list) > 0):?>

				<div class="row" id="photo-list">

					<?foreach($list as $k => $v):?>
					<div class="col-md-4 col-sm-4">
						<div class="item">
							<div class="image">
								<a href="<?=$menu_url?>?act=view&amp;seq=<?=$v['bd_seq']?>">
									<div class="overlay">
										<div class="inner">
										</div>
									</div>

									<?if(array_key_exists($v['bd_seq'], $thums) && $file_url = $thums[$v['bd_seq']]):?>
									<img src="<?=$file_url?>" alt="<?=$v['bd_subject']?>" style="width:360px; height:200px;">
									<?else:?>
									<?endif;?>
								</a>
							</div>
							<div class="wrapper">
								<a href="<?=$menu_url?>?act=view&amp;seq=<?=$v['bd_seq']?>">
									<h4>
										<?=mb_substr(strip_tags($v['bd_subject']),0, 18)?>
									</h4>
								</a>
								<figure>
									<?=mb_substr(strip_tags($v['bd_content']),0, 60)?>...</figure>
							</div>
						</div>
					</div>

					<?if($k != 0 && $k % 3 == 2):?>
					<div class="board-clear">&nbsp;</div>
					<?endif;?>
					<?endforeach;?>
				</div>

				<?endif;?>
			</section>
			<!-- END :: Listing Grid-->

			<div class="btn-area-center">
				<a href="#" id="more-btn" id="more-btn" class="btn btn-default" style="color:white; width:99%;" onclick="return false;">더보기</a>
			</div>

		</div>
	</div>
</section>
<!-- END :: section.container -->


<script type="text/javascript">
	var current_page = 1;
	var exists_more = true;
	var total_pages = 0;
	var more_btn = false;

	$(document).ready(function () {
		total_pages = parseInt($('#total-page').data('total'));
		more_btn = $('#more-btn');
		if (current_page >= total_pages) {
			close_btn();
		}

		more_btn.on('click', function () {
			more_list();
		});
	});

	function more_list() {
		if (!exists_more) {
			alert('마지막 페이지 입니다.');
			return false;
		}

		current_page++;
		if (current_page >= total_pages) {
			close_btn();
		}

		$.ajax({
			url: "/m/index.php/mobile/contents/okmedi_healthboard?method=ajax&bdc_seq=<?=$bdc_seq?>&sch_type=<?=$sch_type?>&sch_text=<?=$sch_text?>&q_page=" + current_page,
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				if (data.list.length > 0) {
					var index = 0;
					data.list.forEach(function (entry) {
						setHtml(entry.bd_seq, entry.thums, entry.subject, entry.content);
						if (index != 0 && index % 3 == 2) addLineDiv();
						index++;
					});
				} else {
					close_btn();
				}
			}
		});

	}


	var list_area = $('#photo-list');
	function setHtml(bd_seq, thums, subject, content) {
		var area = $('<div/>').attr('class', 'col-md-4 col-sm-4');
		area.appendTo(list_area);

		var item = $('<div/>').attr('class', 'item');
		item.appendTo(area);

		var image = $('<div/>').attr('class', 'image');
		image.appendTo(item);

		var a = $('<a/>').attr('href', '<?=$menu_url?>?act=view&seq=' + bd_seq);
		var overlay = $('<div/>').attr('class', 'overlay');
		var inner = $('<div/>').attr('class', 'inner');
		inner.appendTo(overlay);
		overlay.appendTo(a);

		if (thums) {
			$('<img/>').attr({
				'src': thums,
				'alt': subject,
				'style': 'width:360px; height:200px;'
			}).appendTo(a);
		}

		a.appendTo(image);

		var wrapper = $('<div/>').attr('class', 'wrapper');
		wrapper.appendTo(item);
		var a2 = $('<a/>').attr('href', '<?=$menu_url?>?act=view&amp;seq=' + bd_seq);
		a2.appendTo(wrapper);
		$('<h4/>').html(subject).appendTo(a2);
		$('<figure/>').html(content).appendTo(wrapper);
	}

	function close_btn() {
		exists_more = false;
		more_btn.html('마지막 페이지입니다.');
	}

	function addLineDiv() {
		$('<div/>').attr('class', 'board-clear').appendTo(list_area);
	}
</script>
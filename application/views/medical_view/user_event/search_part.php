<section class="hero-image" style="height: 640px !important;">
	<div class="background" style="background:url(/resource/images/medical/event_banner.png) center;">
	</div>
</section>
<style>
	#search-title{
	display: inline-block;
	position: absolute;
	background-color: white;
	background-image: url("/resource/images/custom/button_border.png");
	text-align: center;
	color: #195ab3;
	width: 500px;
	height: 60px;
	line-height: 60px;
	letter-spacing: -1px;
	font-size: 23px;
	top: 125px;
	margin: 0 calc(50% - 250px);
}
</style>
<section class="container" id="user-event-list" style="padding-left: 0 !important; padding-right: 0 !important;">
	<!-- 슬라이더 -->
	<!-- <?=$top_slider?> -->

	<!-- 탭 메뉴 -->
	<?=$tab_menu?>
	<div class="row" style="padding: 0 30px;">
		<form method="get" action="<?=$menu_url?>/<?=$act?>" id="search-form">

			<input type="hidden" name="group" value="<?=$group_value?>" />
			<input type="hidden" name="sort" value="<?=$sort_value?>" />
			<input type="hidden" name="goto_page" value="<?=$page_value?>" />


			<div class="part-search" style="border: 1px #195ab3 solid;margin-top: 30px; height: 650px;">
				<div class="row" style="padding-top: 40px;">
					<div style="width: 100%;">
						<span id="search-title">
							<font style="font-weight: bold;">걱정되거나 관심있는 검진</font>부위를 <font style="font-weight: bold;">선택</font>해주세요
						</span>
					</div>
					<div style="width:25%; float:left">&nbsp;</div>
					<div style="width: 25%; float: left;">
						<div class="body-image">
							<div class="stage-ibx">
								<div class="stage-ibx__stage">
									<!-- Image -->
									<img src="/resource/images/common/body.png" class="stage-ibx__stage-img img-responsive" alt="" title="" />
									<!--/ Image -->

									<!-- Stage point 1 -->
									<!-- 								<span style="top: 55px; left: 70px; opacity: 1;" class="stage-ibx__point kl-ib-point-1" data-title="전신"></span> -->
									<!--/ Stage point 1 -->

									<!-- Stage point 2 -->
									<span style="top: 52px; left: 132px; opacity: 1;" class="stage-ibx__point kl-ib-point-2 <?if(urldecode($group_value) == '머리'):?>selected<?endif;?>"
									 data-title="머리"></span>
									<!--/ Stage point 2 -->

									<!-- Stage point 3 -->
									<span style="top: 85px; left: 132px; opacity: 1;" class="stage-ibx__point kl-ib-point-3 <?if(urldecode($group_value) == '목'):?>selected<?endif;?>"
									 data-title="목"></span>
									<!--/ Stage point 3 -->

									<!-- Stage point 4 -->
									<span style="top: 135px; left: 120px; opacity: 1;" class="stage-ibx__point kl-ib-point-4 <?if(urldecode($group_value) == '가슴'):?>selected<?endif;?>"
									 data-title="가슴"></span>
									<!--/ Stage point 4 -->

									<!-- Stage point 5 -->
									<span style="top: 135px; left: 145px; opacity: 1;" class="stage-ibx__point kl-ib-point-5 <?if(urldecode($group_value) == '유방'):?>selected<?endif;?>"
									 data-title="유방(여성)"></span>
									<!--/ Stage point 5 -->

									<!-- Stage point 6 -->
									<span style="top: 200px; left: 100px; opacity: 1;" class="stage-ibx__point kl-ib-point-6 <?if(urldecode($group_value) == '허리'):?>selected<?endif;?>"
									 data-title="허리"></span>
									<!--/ Stage point 6 -->

									<!-- Stage point 7 -->
									<span style="top: 200px; left: 133px; opacity: 1;" class="stage-ibx__point kl-ib-point-7 <?if(urldecode($group_value) == '상복부'):?>selected<?endif;?>"
									 data-title="상복부"></span>
									<!--/ Stage point 7 -->

									<!-- Stage point 8 -->
									<span style="top: 260px; left: 133px; opacity: 1;" class="stage-ibx__point kl-ib-point-8 <?if(urldecode($group_value) == '하복부'):?>selected<?endif;?>"
									 data-title="하복부"></span>
									<!--/ Stage point 8 -->

									<!-- Stage point 9 -->
									<span style="top: 445px; left: 196px; opacity: 1;" class="stage-ibx__point kl-ib-point-9 <?if(urldecode($group_value) == '기타'):?>selected<?endif;?>"
									 data-title="기타"></span>
									<!--/ Stage point 9 -->

								</div>
								<!-- /.stage-ibx__stage -->

								<div class="clearfix"></div>
							</div>

						</div>
					</div>
					<div style="width: 50%; float: left; padding-top: 50px;">
						<div class="main-part-select" style="width: 135px; float: left;">
							<table class="main-part type03 type04" summary="부위별 검색 코드 선택">
								<caption>부위별 검색어 선택</caption>
								<tbody>
									<tr>
										<td>
											<?if(urldecode($group_value) == '머리'):?>
											<img src="/resource/images/medical/icons/event/bodypart_on_02.png" class="selected" data-title="머리" alt="머리" />
											<?else:?>
											<img src="/resource/images/medical/icons/event/bodypart_off_02.png" data-title="머리" alt="머리" />
											<?endif;?>
										</td>
									</tr>
									<tr>
										<td>
											<?if(urldecode($group_value) == '목'):?>
											<img src="/resource/images/medical/icons/event/bodypart_on_03.png" class="selected" data-title="목" alt="목" />
											<?else:?>
											<img src="/resource/images/medical/icons/event/bodypart_off_03.png" data-title="목" alt="목" />
											<?endif;?>
										</td>
									</tr>
									<tr>
										<td>
											<?if(urldecode($group_value) == '가슴'):?>
											<img src="/resource/images/medical/icons/event/bodypart_on_04.png" class="selected" data-title="가슴" alt="가슴" />
											<?else:?>
											<img src="/resource/images/medical/icons/event/bodypart_off_04.png" data-title="가슴" alt="가슴" />
											<?endif;?>
										</td>
									</tr>
									<tr>
										<td>
											<?if(urldecode($group_value) == '유방'):?>
											<img src="/resource/images/medical/icons/event/bodypart_on_05.png" class="selected" data-title="유방" alt="유방" />
											<?else:?>
											<img src="/resource/images/medical/icons/event/bodypart_off_05.png" data-title="유방" alt="유방" />
											<?endif;?>
										</td>
									</tr>
									<tr>
										<td>
											<?if(urldecode($group_value) == '허리'):?>
											<img src="/resource/images/medical/icons/event/bodypart_on_06.png" class="selected" data-title="허리" alt="허리" />
											<?else:?>
											<img src="/resource/images/medical/icons/event/bodypart_off_06.png" data-title="허리" alt="허리" />
											<?endif?>
										</td>
									</tr>
									<tr>
										<td>
											<?if(urldecode($group_value) == '상복부'):?>
											<img src="/resource/images/medical/icons/event/bodypart_on_07.png" class="selected" data-title="상복부" alt="상복부" />
											<?else:?>
											<img src="/resource/images/medical/icons/event/bodypart_off_07.png" data-title="상복부" alt="상복부" />
											<?endif;?>
										</td>
									</tr>
									<tr>
										<td>
											<?if(urldecode($group_value) == '하복부'):?>
											<img src="/resource/images/medical/icons/event/bodypart_on_08.png" class="selected" data-title="하복부" alt="하복부" />
											<?else:?>
											<img src="/resource/images/medical/icons/event/bodypart_off_08.png" data-title="하복부" alt="하복부" />
											<?endif;?>
										</td>
									</tr>
									<tr>
										<td>
											<?if(urldecode($group_value) == '기타'):?>
											<img src="/resource/images/medical/icons/event/bodypart_on_09.png" class="selected" data-title="기타" alt="기타" />
											<?else:?>
											<img src="/resource/images/medical/icons/event/bodypart_off_09.png" data-title="기타" alt="기타" />
											<?endif;?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="part-win" style="width: 250px; height:391px; float: left; /*outline: 1px #706e6e solid;*/">
							<div class="win-table">
								<table class="type03 type04" summary="부위별 검색 코드 선택">
									<caption>부위별 검색어 선택</caption>
									<thead>
										<tr>
											<td>
												<input type="button" value="전체선택" class="btn btn-default btn-allcheck" <?if(is_array($group_array) &&
												 count($group_array)> 0):?>style="display:inline-block;"
												<?endif;?> />
											</td>
										</tr>
									</thead>
									<tbody>
										<?if(is_array($group_array) && count($group_array) > 0):?>
										<?foreach($group_array as $k => $v):?>
										<tr>
											<td>
												<label for="<?=$v['cd_code']?>"><input type="checkbox" name="codes[]" value="<?=$v['cd_code']?>" id="<?=$v['cd_code']?>"
													 <?if(is_array($codes_array) && in_array($v['cd_code'], $codes_array)):?>checked="checked"
													<?endif;?>>
													<?=$v['cd_name']?></label>
											</td>
										</tr>
										<?endforeach;?>
										<?endif;?>
									</tbody>
								</table>
							</div>
						</div>
						<div style="width:20%; float:left; clear: both;"></div>

					</div>

					<!-- <input type="submit" class="btn btn-primary" value="선택 부위로 검색하기" style="background-image: url('/resource/images/medical/icons/event/search_button.png');" /> -->

					<input class="search-datail-button" type="submit" value="선택한 부위로 찾기" style="width: 239px; height: 54px; padding:5px 15px; background-image: url('/resource/images/medical/icons/search_button.png'); background-repeat: no-repeat; border:0 none; cursor:pointer; -webkit-border-radius: 30px; border-radius: 30px; color: white; font-size: 21px; letter-spacing: -1px; margin: 20px 0 0 80px">


				</div>
			</div>
		</form>
	</div>

	<!-- 소트 메뉴 -->
	<?=$sort_menu?>



	<!-- 이벤트 리스트 -->
	<section class="block equal-height">

		<div class="row" id="event-photo-list" data-total="">

		</div>

		<!--/.row-->
	</section>
	<!--end Listing Grid-->

	<div class="btn-area-center">
		<a href="#" id="more-btn" id="more-btn" class="btn btn-default" style="color:white; width:99%;" onclick="return false;">더보기</a>
	</div>

</section>


<script>
	var search_form = false;
	var click_els_table = new Array();
	var click_els_image = new Array();


	$(document).ready(function () {
		win_area = $('.win-table');
		target_el = $('.part-win table tbody');
		search_form = $('#search-form');
		click_els_table = $('.main-part tbody tr td img');
		click_els_image = $('.stage-ibx span');

		click_els_table.on('click', function (e) {
			var text = $(this).data('title');
			openWin(text);
			text = encodeURI(text);
			$('input[name="group"]').val(text);
		});

		click_els_image.on('click', function (e) {
			var text = $(this).data('title');
			if (text == '유방(여성)') text = '유방';
			openWin(text);
			text = encodeURI(text);
			$('input[name="group"]').val(text);
		});


		setOnHover();

		search_form.on('submit', function (e) {
			e.preventDefault();
			var check_box = $('.win-table input[type="checkbox"]');
			var flag = false;
			$.each(check_box, function (i, item) {
				if ($(item).prop('checked')) {
					flag = true;
					return false;
				}
			});
			if (!flag) alert('상세항목을 선택한 후 검색해 주세요.');
			else {
				clear_area();
				more_list();
			}
		});

		$('.btn-allcheck').on('click', function (e) { onCheckAll() });

	});


	var win_area = false;
	var target_el = false;
	var part_json_url = '<?=$menu_url?>/jsonBodyParts?part=';

	function openWin(text) {
		clearTable();
		if (!text || text == '') return false;
		var target_url = part_json_url + encodeURI(text);

		$.ajax({
			url: target_url,
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				if (data.list.length > 0) {
					$.each(data.list, function (i, item) {
						setItemToTable(item.cd_code, item.cd_name);
					});
					activeElenet(text);
					$('.btn-allcheck').show();
					toggleWin();
				} else {
					alert('선택할 수 없는 영역입니다.');
				}
			}
		});
	}

	function activeElenet(text) {
		//	var icons = $('.main-part tbody tr th img');
		$.each(click_els_table, function (i, e) {
			var src = $(e).attr('src').replace('_on_', '_off_');
			$(e).attr('src', src);
		});

		click_els_table.removeClass('selected');
		$.each(click_els_table, function (i, item) {
			if ($(item).data('title') == text) {
				var src = $(item).attr('src').replace('_off_', '_on_');
				$(item).attr('src', src);
				$(item).addClass('selected');
			}
		});

		click_els_image.removeClass('selected');
		$.each(click_els_image, function (i, item) {
			if (text == '유방') text = '유방(여성)';
			if ($(item).data('title') == text) {
				$(item).addClass('selected');
			}
		});

	}

	function closeWin() {
		win_area.find('tbody').html('');
		win_area.hide();
	}

	function clearTable() {
		win_area.find('tbody').html('');
	}

	function setItemToTable(code, name) {
		var tr = $('<tr/>');
		tr.appendTo(target_el);

		var td = $('<td/>');
		td.appendTo(tr);

		var label = $('<label>').attr('for', code);
		$('<input/>').attr({
			'type': 'checkbox',
			'name': 'codes[]',
			'value': code,
			'id': code
		}).appendTo(label);

		label.html(label.html() + ' ' + name);
		label.appendTo(td);
	}

	function toggleWin() {
		if (!win_area.is(":visible")) {
			win_area.find('.cls-btn').on('click', function () {
				closeWin();
			});
			win_area.show();
		}
	}

	function onCheckAll() {
		search_form.find('input[type="checkbox"]').prop('checked', true);
	}

	function setOnHover() {
		click_els_table.on({
			'mouseenter': function () {
				var src = $(this).attr('src').replace('_off_', '_on_');
				$(this).attr('src', src);
			},
			'mouseleave': function () {
				if (!$(this).hasClass('selected')) {
					var src = $(this).attr('src').replace('_on_', '_off_');
					$(this).attr('src', src);
				}
			}
		});
	}
</script>
<?=$contents_footer?>
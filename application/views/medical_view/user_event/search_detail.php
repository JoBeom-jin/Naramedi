<section class="hero-image" style="height: 640px !important;">
	<div class="background" style="background:url(/resource/images/medical/event_banner.png) center;">
	</div>
</section>
<section class="container" id="user-event-list" style="padding-left: 0 !important; padding-right: 0 !important;">
	<!-- 슬라이더 -->
	<!-- <?=$top_slider?> -->
	
	<!-- 탭 메뉴 -->
	<?=$tab_menu?>
	<div id="event_detail-search" class="block6 bg-white">
		<form method="get" action="<?=$menu_url?>/<?=$act?>" id="search-form">
			<input type="hidden" name="max_account" value="<?=$max_value?>" />
			<input type="hidden" name="min_account" value="<?=$min_value?>" />
			<input type="hidden" name="sort" value="<?=$sort_value?>" />
			<input type="hidden" name="goto_page" value="<?=$page_value?>" />

			<div class="search-op-location" style="width: 700px; height: 100px; margin: 20px auto; text-align: center;">
				<div class="options select-bar">
					<div style="float: left;width: 700px;">
						<div style="width: 100px; height: 40px;" class="bar-name"><img src="/resource/images/medical/icons/detail_icon.png" alt="" style="width: 28px; height: 28px;">
							<b style="font-size: 18px; line-height: 40px; vertical-align: middle;">가격</b>
						</div>
						<div class="bar-stick">
							<?if($min_value && $max_value):?>
							<input class="range-slider" type="hidden" min="10" max="1000" value="<?=($min_value/10000)?>,<?=($max_value/10000)?>" step="1" name="account">				
							<?else:?>
							<input class="range-slider" type="hidden" min="10" max="1000" value="10,1000" step="1" name="account">				
							<?endif;?>						
						</div>				
					</div>
				</div>
				<div style="clear: both;"></div>
				<div class="options">
					<select name="select_city" data-size="10">
						<option value="">지역 선택</option>
						<?foreach($cities as $k => $v):?>
						<option value="<?=$v['ai_addr_text1']?>" <?if($city_value == $v['ai_addr_text1']):?>selected="selected"<?endif;?> ><?=$v['ai_addr_text1']?></option>
						<?endforeach;?>
					</select>
				</div>

				<div class="options">
					<select name="gungu" data-size="10">
						<option value="">시군구 선택</option>
						<?foreach($local_list as $k => $v):?>
						<option value="<?=$v['ai_addr_text2']?>" <?if($local_value == $v['ai_addr_text2']):?>selected="selected"<?endif;?>><?=$v['ai_addr_text2']?></option>
						<?endforeach;?>
					</select>
				</div>

				<div class="options">
					<select name="age" data-size="10">
						<option value="">연령대 선택</option>
						<?foreach($age_codes as $k => $code):?>
						<option value="<?=$k?>" <?if($age_value == $k):?>selected="selected"<?endif;?> ><?=$code['cd_name']?></option>
						<?endforeach;?>
					</select>
				</div>

			</div>

			<div class="search-op-types">
				<table class="type03" summary="부위별 검색 코드 선택">
					<caption>부위별 검색어 선택</caption>
					<tbody>
						<?foreach($body_code as $k => $part):?>
						<tr>
							<th><?=$part['name']?></th>
							<td>
								<?foreach($part['data'] as $k2 => $checkup):?>
								<label for="<?=$checkup['cd_code']?>" style="">
									<input type="checkbox" name="codes[]" value="<?=$checkup['cd_code']?>" id="<?=$checkup['cd_code']?>" <?if(is_array($codes_array) && in_array($checkup['cd_code'], $codes_array)):?>checked="checked"<?endif;?> />
									<?=$checkup['cd_name']?></label>
									<?endforeach;?>
								</td>
							</tr>
							<?endforeach;?>						
						</tbody>
					</table>

					<div class="btn-area-center">
						<input  class="search-datail-button" type="submit" value="선택한 조건으로 찾기" style="width: 239px; height: 54px; padding:5px 15px; background-image: url('/resource/images/medical/icons/search_button.png'); background-repeat: no-repeat; border:0 none; cursor:pointer; -webkit-border-radius: 30px; border-radius: 30px; color: white; font-size: 21px; letter-spacing: -1px;" />
					</div>
				</div>
			</form>		
		</div>

		<!-- 소트 메뉴 -->
		<?=$sort_menu?>

		<!-- 이벤트 리스트 -->	
		<section class="block equal-height" >
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

		var min_account = 0;
		var max_account = 0;
		var gungu_url = '<?=$menu_url?>/jsonGunguList?city=';
		var city_el = '';
		var gungu_el = '';
		var search_form = false;

		$(document).ready(function(){
			max_account = $('input[name="max_account"]').val();
			min_account = $('input[name="min_account"]').val();	
			search_form = $('#search-form');

			city_el = $('.search-op-location select[name="select_city"]');
			gungu_el = $('.search-op-location select[name="gungu"]');

			runSlider('#slider', min_account, max_account);
			city_el.on('change', function(){
				var select_city = $(this).find(':selected').val();		
				getRunguList(select_city, gungu_el);				
			});


			search_form.on('submit', function(e){
				e.preventDefault();
				set_account();
				clear_area();
				more_list();
			});
		});

		function runSlider(el, min, max){
			$('.range-slider').asRange({	
				range: true,
				limit: false,
				format : function(value){return value+'만원'}	
			});	
//	$('#slider').freshslider({
//		range: true, // true or false
//		step: 10000,
//		text: true,
//		min: parseInt(min),
//		max: parseInt(max),
//		unit: '원', 
//		enabled: true,
//		value: 10, 
//		onchange:function(low, high){
//			set_account(low, high);
//		}
//	});	
}

function set_account(){	
	var account = $('.range-slider').val().split(',');	
	var max_account = parseInt(account[1])*10000;
	$('input[name="max_account"]').val(max_account);
	
	var min_account = parseInt(account[0])*10000;	
	$('input[name="min_account"]').val(min_account);
}


function getRunguList(city, select_el){	
	if(!city || city == '') return false;
	city = encodeURI(city);
	var url = gungu_url+city;

	$.ajax({
		url: url,
		type: "GET",
		dataType: "JSON",
		success: function (data) {	
			if(data.length > 0){
				makeOptionToSelect(data, select_el);			
			}
		}
	});
}

function makeOptionToSelect(list, target_select){	
	target_select.html('');
	
	$('<option/>').attr('value', '').html('시군구').appendTo(target_select);
	$.each(list, function(i, item){			
		$('<option/>').attr('value', item).html(item).appendTo(target_select);		
	});
	
	gungu_el.selectpicker('refresh');
}


</script>
<?=$contents_footer?>
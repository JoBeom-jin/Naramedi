<div id="event_detail-search">
	<form method="get" action="<?=$menu_url?>/<?=$act?>" id="search-form-modal" onsubmit="onSubmit(); return false;">
			<input type="hidden" name="max_account" value="<?=$max_value?>" />
			<input type="hidden" name="min_account" value="<?=$min_value?>" />
			<input type="hidden" name="sort" value="<?=$sort_value?>" />
			<input type="hidden" name="goto_page" value="<?=$page_value?>" />

		<div class="search-op-location">			
			<div class="options select_city">
				<select name="select_city" data-size="10" class="runway">
				  <option value="">지역 선택</option>
				  <?foreach($cities as $k => $v):?>
				  <option value="<?=$v['ai_addr_text1']?>" <?if(urldecode($city_value) == $v['ai_addr_text1']):?>selected="selected"<?endif;?> ><?=$v['ai_addr_text1']?></option>
				  <?endforeach;?>
				</select>
			</div>

			<div class="options gungu">
				<select name="gungu" data-size="10" class="runway">
				  <option value="">시군구 선택</option>
				  <?foreach($local_list as $k => $v):?>
				  <option value="<?=$v['ai_addr_text2']?>" <?if($local_value == $v['ai_addr_text2']):?>selected="selected"<?endif;?>><?=$v['ai_addr_text2']?></option>
				  <?endforeach;?>
				</select>
			</div>
 
			<div class="options age">
				<select name="age" data-size="10" class="runway">
				  <option value="">연령 선택</option>
				  <?foreach($age_codes as $k => $code):?>
				  <option value="<?=$k?>" <?if($age_value == $k):?>selected="selected"<?endif;?> ><?=$code['cd_name']?></option>
				  <?endforeach;?>
				</select>
			</div>			

			<div style="clear:both;"></div>

			<div class="select-bar">	
				<!-- <div style="" class=""></div>
				<img src="/resource/assets/img/w-icon.png" alt="w-icon"> -->
				<div style="" class="bar-name">가격</div>
				<div class="bar-stick">
					<?if($min_value && $max_value):?>
					<input class="range-slider" type="hidden" min="10" max="1000" value="<?=($min_value/10000)?>,<?=($max_value/10000)?>" step="1" name="account">				
					<?else:?>
					<input class="range-slider" type="hidden" min="10" max="1000" value="10,1000" step="1" name="account">				
					<?endif;?>
				</div>
			</div>
		</div>

		<div class="search-op-types" style="margin-top:30px;" >
			<table class="type03" summary="부위별 검색 코드 선택">
				<caption>부위별 검색어 선택</caption>
				<colgroup>
					<col width="100px" />
					<col width="" />
				</colgroup>
				
				<tbody>
					<?foreach($body_code as $k => $part):?>
					<tr>
						<th><?=$part['name']?></th>
						<td>
							<?foreach($part['data'] as $k2 => $checkup):?>
							<input type="checkbox" name="codes[]" value="<?=$checkup['cd_code']?>" id="<?=$checkup['cd_code']?>" <?if(is_array($codes_array) && in_array($checkup['cd_code'], $codes_array)):?>checked="checked"<?endif;?> />
							<label for="<?=$checkup['cd_code']?>">							
							<?=$checkup['cd_name']?></label>
							<?endforeach;?>
						</td>
					</tr>
					<?endforeach;?>						
				</tbody>
			</table>

			<div class="btn-area-center btn-area-renew">
				<input type="button" value="선택 초기화" onclick="onCheckreset();" class="btn btn-reset btn-primary btn-bottom"/>
				<input type="button" value="선택 조건으로 검색" onclick="onSubmit();" class="btn btn-primary btn-bottom"/>
			</div>
		</div>

	</form>		
</div>
<style>
tr th:first-child{
border-top: 1px solid #cdcdcd;
}
td:last-child{
padding-right: 0px; 
width: 70%;
}

</style>

<script>
var search_form2 = true;
var gungu_url = '<?=$menu_url?>/jsonGunguList?city=';
var city_el = '';
var gungu_el = '';
var min_account = 0;
var max_account = 0;

$(document).ready(function(){
	city_el = $('.search-op-location select[name="select_city"]');
	gungu_el = $('.search-op-location select[name="gungu"]');

	max_account = $('input[name="max_account"]').val();
	min_account = $('input[name="min_account"]').val();
	search_form2 = $('#search-form-modal');

	runSlider('.range-slider', min_account, max_account);
	city_el.on('change', function(){
		var select_city = $(this).find(':selected').val();		
		getRunguList(select_city, gungu_el);				
	});
});

/* send form */
function onCheckreset(){
	search_form2.find('input[type="checkbox"]').prop('checked', false);
}
function onSubmit(){
	var inputs = $('#search-form-modal input');	
	var selects  = $('#search-form-modal select');
	var target = $('#search-form');

	var send_data = new Array();	
	var send_idx = 0;

	$.each(inputs, function(idx, item){		
		send_data[send_idx] = new Array();
		if($(item).attr('name')){

			if($(item).attr('type') == 'text' || $(item).attr('type') == 'hidden'){
				if($(item).attr('name') == 'account'){
					var account = $(item).val().split(',');
					send_data[send_idx]['name'] = 'max_account';
					send_data[send_idx]['value'] = parseInt(account[1])*10000;					
					send_idx++;

					send_data[send_idx] = new Array();
					send_data[send_idx]['name'] = 'min_account';
					send_data[send_idx]['value'] = parseInt(account[0])*10000;
					send_idx++;
				}else{
					send_data[send_idx]['name'] = $(item).attr('name');
					send_data[send_idx]['value'] = $(item).val();				
					send_idx++;
				}

			}else if($(item).attr('type') == 'checkbox' && $(item).prop('checked') == true){
				send_data[send_idx]['name'] = $(item).attr('name');
				send_data[send_idx]['value'] = $(item).val();				
				send_idx++;
			}
		}
	});

	$.each(selects, function(idx, item){
		send_data[send_idx] = new Array();
		send_data[send_idx]['name'] = $(item).attr('name');
		send_data[send_idx]['value'] = $(item).find(':selected').val();
		send_idx++;
	});	

	target.find('input[type="hidden"]').remove();
	var sort_item = $('<input/>').attr({
			'type' : 'hidden',
			'name' : 'sort',
			'value' : 'new'
		});
	sort_item.appendTo(target);	
	
	$.each(send_data, function(idx, item){
		var item = $('<input/>').attr({
			'type' : 'hidden',
			'name' : item.name,
			'value' : item.value
		});
		
		item.appendTo(target);		
	});	
	
	clear_area();
	more_list();
	
	$('.modal-window').addClass('fade_out');
	setTimeout(function() {
		$('.modal-window').remove();
	}, 300);

	return false;
}

function runSlider(el, min, max){
	$('.range-slider').asRange({	
		range: true,
    limit: false,
		format : function(value){return value+'만원'}	
	});	
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

}

function set_account(low, high){
	$('input[name="max_account"]').val(high);
	$('input[name="min_account"]').val(low);
}
</script>
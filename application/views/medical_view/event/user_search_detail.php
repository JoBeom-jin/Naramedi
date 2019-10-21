<section class="container" id="user-event-list">

	<div id="wrapper2" style="position:relative; overflow:hidden; height:499px;">
		<ul id="adaptive" class="cs-hidden">
			<?if(is_array($banner_images) && count($banner_images) > 0):?>
			<?foreach($banner_images as $img):?>
			<li class="item-e"> 
				<a href="/index.php/medical/contents/event_hospital/viewEvent?seq=<?=$img['ei_seq']?>">
				<img src="<?=$img['url']?>" alt="<?=$img['name']?>" style="width:1142px; height:499px;" >
				</a>
			 </li>
			<?endforeach;?>
			<?endif;?>		
		</ul>	
	</div>
	<?=$event_search_tab_menu?>	
	
	<div id="event_detail-search" class="block6 bg-white">
		<form method="get" action="<?=$menu_url?>/<?=$act?>" id="search-form">
			<input type="hidden" name="max_account" value="<?=$max_default_account?>" />
			<input type="hidden" name="min_account" value="<?=$min_default_account?>" />
			<input type="hidden" name="sort" value="new" />

			<div class="search-op-location">
				<div class="options">
					<select name="city" data-size="10">
					  <option value="">시도</option>
					  <?foreach($cities as $k => $v):?>
					  <option value="<?=$v['ai_addr_text1']?>" <?if($select_city == $v['ai_addr_text1']):?>selected="selected"<?endif;?>><?=$v['ai_addr_text1']?></option>
					  <?endforeach;?>
					</select>
				</div>

				<div class="options">
					<select name="gungu" data-size="10">
					  <option value="">시군구</option>
					  <?foreach($local_list as $k => $v):?>
					  <option value="<?=$v['ai_addr_text2']?>" <?if($select_local == $v['ai_addr_text2']):?>selected="selected"<?endif;?>><?=$v['ai_addr_text2']?></option>
					  <?endforeach;?>
					</select>
				</div>

				<div class="options">
					<select name="age" data-size="10">
					  <option value="">연령대</option>
					  <?foreach($age_codes as $k => $code):?>
					  <option value="<?=$k?>" <?if($select_age == $k):?>selected="selected"<?endif;?>><?=$code['cd_name']?></option>
					  <?endforeach;?>
					</select>
				</div>

				<div class="options select-bar">	
					<div style="width:50px;">가격대</div>					
					<div id="slider"></div>					
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
								<input type="checkbox" name="codes[]" value="<?=$checkup['cd_code']?>" id="<?=$checkup['cd_code']?>" />
								<?=$checkup['cd_name']?></label>
								<?endforeach;?>
							</td>
						</tr>
						<?endforeach;?>						
					</tbody>
				</table>

				<div class="btn-area-center">
					<input type="submit" value="선택된 조건으로 검색" class="btn btn-primary"/>
				</div>
			</div>
		</form>		
	</div>
	
	<?=$event_search_sort_tab?>

	<!--Listing Grid-->
	<section class="block equal-height" >
		<div class="row" id="photo-list" data-total="">

		</div>										
		<!--/.row-->
	</section>
	<!--end Listing Grid-->

	<div class="btn-area-center">
		<a href="#" id="more-btn" id="more-btn" class="btn btn-default" style="color:white; width:99%;" onclick="return false;">더보기</a>
	</div>

</section>




<?=$event_search_footer?>

<script type="text/javascript">
var min_account = 0;
var max_account = 0;
var gungu_url = '/index.php/medical/contents/event_hospital/getGunguAjax?city=';
var city_el = '';
var gungu_el = '';
var search_form = false;


$(document).ready(function(){
	max_account = $('input[name="max_account"]').val();
	min_account = $('input[name="min_account"]').val();	
	search_form = $('#search-form');

	city_el = $('.search-op-location select[name="city"]');
	gungu_el = $('.search-op-location select[name="gungu"]');

	runSlider('#slider', min_account, max_account);
	city_el.on('change', function(){
		var select_city = $(this).find(':selected').val();		
		getRunguList(select_city, gungu_el);				
	});

	//sort selector
	$('.sort-selector').on('click', function(e){
		e.preventDefault();
		var sort_value = $(this).data('sort');		
		
		$('.sort-selector').find('span').attr('style', 'color:#888;');
		$('.sort-selector').find('i').remove();

		$('<i/>').attr({'class':'fa fa-check', 'style':'color:red;'}).prependTo($(this));
		$(this).find('span').attr('style', '');

		$('input[name="sort"]').val(sort_value);
		clear_area();
		more_list();
	});

	//run ajax
	total_pages = parseInt($('#photo-list').data('total'));
	more_btn = $('#more-btn');
	more_list();
	more_btn.on('click', function(){		
		more_list();
	});

	search_form.on('submit', function(e){
		e.preventDefault();		
		clear_area();
		more_list();
	});
});

function runSlider(el, min, max){
	$('#slider').freshslider({
		range: true, // true or false
		step: 10000,
		text: true,
		min: parseInt(min),
		max: parseInt(max),
		unit: '원', 
		enabled: true,
		value: 10, 
		onchange:function(low, high){
			set_account(low, high);
		}
	});	
}

function set_account(low, high){
	$('input[name="max_account"]').val(high);
	$('input[name="min_account"]').val(low);
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
			console.log(data);
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

/*list를 위한 ajax 실행*/
var current_page = 0;
var exists_more = true;
var total_pages = 0;
var more_btn = false;
var ajax_url = '/index.php/medical/contents/event_hospital/ajaxDetailSearch';

function more_list(){
	if(!exists_more){
		alert('마지막 페이지 입니다.');
		return false;
	}

	current_page++;

	var query_string = search_form.serialize();
	var target_url = ajax_url+'?q_page='+current_page+'&'+query_string;
	console.log(target_url);


	$.ajax({
		url: target_url,
		type: "GET",
		dataType: "JSON",
		success: function (data) {	
			total_pages = data.total;
			if(data.list.length > 0){				
				data.list.forEach(function(entry){
					var event_link = '<?=$contents_url?>/event_hospital/viewEvent?seq='+entry.ei_seq;
					makeItem(event_link, entry.banner_src, entry.ei_seq, entry.ei_name, entry.is_like, entry.is_close_mall, entry.ei_account, entry.ei_discounted_account, entry.end_time, entry.hi_open_name, entry.address);				
				});

				if(current_page >= total_pages){	
					close_btn();		
				}
			}else{
				close_btn();
			}
		}
	});
			
}


var list_area = $('#photo-list');
var view_link_default = '<?=$contents_url?>/event_hospital/viewEvent';
var like_link_default = '<?=$contents_url?>/my_check';

/*
* ajax data를 통해 html를 만듦
*/
function makeItem(event_list_href, banner_src, ei_seq, ei_name, is_like, is_close_mall, ei_account, ei_discounted_account, end_time, hi_open_name,   address){	
	//wrappers
	var list_wrapper = $('<div/>').attr('class', 'col-md-6 col-sm-6');
	list_wrapper.appendTo(list_area);

	var item_wrapper = $('<div/>').attr({
		'class':'item',
		'style' : 'height:351px; overflow:hidden;'
	});
	item_wrapper.appendTo(list_wrapper);

	var image_wrapper = $('<div/>').attr('class', 'image');
	image_wrapper.appendTo(item_wrapper);

	var image_link = $('<a/>').attr('href',event_list_href);
	image_link.appendTo(image_wrapper);

	var text_wrapper = $('<div/>').attr({
		'class' : 'wrapper',
		'style' : 'position:relative;'
	});
	text_wrapper.appendTo(item_wrapper);

	//elements add to image_link
	var overlay = $('<div/>').attr('class', 'overlay');
	$('<div/>').attr('class', 'inner').appendTo(overlay);

	var image = $('<img/>').attr({
		'src':banner_src,
		'alt':ei_name,
		'style' : 'width:555px; height:242px;'
	});
	overlay.appendTo(image_link);
	image.appendTo(image_link);
	//end : elements add to image_link

	//elements add to text_wapper
	var text_link = $('<a/>').attr('href', event_list_href);
	$('<h3/>').html(ei_name).appendTo(text_link);
	text_link.appendTo(text_wrapper);

	var like_link = $('<a/>').attr({
		'href' : like_link_default+'?seq='+ei_seq,
		'style' : 'position:absolute; top:20px; right:20px; display:block; width:35px; height:35px;',
		'target' : 'formReceiver',
		'id' : 'eiseq_'+ei_seq
	});
	like_link.appendTo(text_wrapper);

	var icon = $('<i/>').attr({
		'class' : 'fa fa-2x',
		'style' : 'color:red;'
	});
	if(is_like){
		icon.addClass('fa-heart');
	}else{
		icon.addClass('fa-heart-o');
	}
	icon.appendTo(like_link);

	var price = $('<div/>').attr('class', 'price');
	$('<span/>').attr('class', 'suga').html('이벤트 수가 ').appendTo(price);	
	if(is_close_mall){
		$('<span/>').attr('class', 'not-price').html(ei_account+' 원').appendTo(price);
		price.html(price.html()+ei_discounted_account+' 원');
	}else{
		price.html(price.html()+ei_account+' 원');		
	}
	price.appendTo(text_wrapper);

	$('<font/>').attr({
		'size' : '2',
		'color' : '#818181'
	}).html('~'+end_time+'까지').appendTo(text_wrapper);	

	var figure = $('<figure/>');
	var name = $('<font/>').attr({
		'size' : '3',
		'color' : 'black'
	}).appendTo(figure);	
	var b = $('<b/>').html(hi_open_name+'&nbsp;&nbsp;');
	b.appendTo(name);

	$('<i/>').attr({
			'class' : 'fa fa-map-marker',
			'style' : 'color:red'
	}).appendTo(figure);
	figure.html(figure.html()+address);
	
	figure.appendTo(text_wrapper);	
}

function close_btn(){
	exists_more = false;
	more_btn.html('마지막 페이지입니다.');
}

function clear_area(){
	current_page = 0;
	exists_more = true;
	total_pages = 0;
	more_btn.html('더보기');
	list_area.html('');
}

</script>
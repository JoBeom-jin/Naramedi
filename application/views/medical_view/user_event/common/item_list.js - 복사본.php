<script>
/*json*/
$(document).ready(function(){
//	goto_pointer = getPointer();

	total_pages = parseInt($('#event-photo-list').data('total'));
	more_btn = $('#more-btn');

	if($('input[name="goto_page"]').length > 0 && $('input[name="goto_page"]').val() > 0){
		goto_page = $('input[name="goto_page"]').val();
	}

	more_list();
	more_btn.on('click', function(){
		more_list();
	});

	$(window).scroll(function(event){
//		savePointer();
	});


});

/*
* 현재 scroll pointer를 기억한다.
*/
var cookie_path = "<?=$_SERVER['PHP_SELF']?>";
var goto_pointer = 0;
function savePointer(){
	var pointer = $('html, body').scrollTop();
	document.cookie='pointer='+pointer+';path='+cookie_path+';';
}

function getPointer(){
	var cName = 'pointer';
	cName = cName + '=';
	var cookieData = document.cookie;
	var start = cookieData.indexOf(cName);
	var cValue = '';
	if(start != -1){
		start += cName.length;
		var end = cookieData.indexOf(';', start);
		if(end == -1)end = cookieData.length;
		cValue = cookieData.substring(start, end);
	}
	return unescape(cValue);
}

var current_page = 0;
var exists_more = true;
var total_pages = 0;
var more_btn = false;
var ajax_url = '<?=$menu_url?>/jsonPage';
var goto_page = false;

function more_list(){
	var search_form = $('#search-form');
	if(!exists_more){
		alert('마지막 페이지 입니다.');
		return false;
	}

	current_page++;

	var query_string = search_form.serialize();
	var target_url = ajax_url+'?q_page='+current_page+'&'+query_string;

	$.ajax({
		url: target_url,
		type: "GET",
		dataType: "JSON",
		success: function (data) {
			total_pages = data.total;
			//첫 페이질 경우 검색결과 없음을 표시
			if(total_pages < 1){
				var div = $('<div/>').attr({
					'style' : 'text-align:center; padding:15px;'
				});

				$('<img/>').attr({
					'src' : '/resource/images/common/no-data.png',
					'alt' : '데이터가 없습니다.'
				}).appendTo(div);
				div.appendTo(list_area);
			}
			if(data.list.length > 0){
				data.list.forEach(function(entry){
					var event_link = '<?=$contents_url?>/event_hospital/viewEvent?seq='+entry.ei_seq;
					makeItem(event_link, entry.banner_src, entry.ei_seq, entry.ei_name, entry.is_like, entry.is_close_mall, entry.ei_original_account, entry.ei_account, entry.ei_discounted_account, entry.end_time, entry.hi_open_name, entry.address, entry.ei_age_text, entry.ei_theme_text);
				});

				if(current_page >= total_pages){
					close_btn();
				}
			}else{
				close_btn();
			}
		},
		complete:function(){
			onInitGotoEvent();

			if(goto_page && goto_page > 0 && goto_page > current_page){
				more_list();
			}else if(goto_page && goto_page > 0 && goto_page == current_page ){
				if(goto_pointer && goto_pointer != '' && goto_pointer > 0){
//					$('html, body').scrollTop(goto_pointer);
					goto_page = 1;
//					goto_pointer = 0;
				}
			}
		}


	});
}




var list_area = $('#event-photo-list');
var view_link_default = '<?=$contents_url?>/event_hospital/viewEvent';
var like_link_default = '<?=$contents_url?>/my_check';

/*
* ajax data를 통해 html를 만듦
*/
function makeItem(event_list_href, banner_src, ei_seq, ei_name, is_like, is_close_mall, ei_original_account,  ei_account, ei_discounted_account, end_time, hi_open_name,   address, ei_age_text, ei_theme_text){
	//wrappers
	var list_wrapper = $('<div/>').attr('class', 'col-md-6 col-sm-6');
	list_wrapper.appendTo(list_area);

	var item_wrapper = $('<div/>').attr({
		'class':'item',
	});
	item_wrapper.appendTo(list_wrapper);

	var image_wrapper = $('<div/>').attr('class', 'image');
	image_wrapper.appendTo(item_wrapper);

	var image_link = $('<a/>').attr('href',event_list_href);
	image_link.appendTo(image_wrapper);

	var text_wrapper = $('<div/>').attr({
		'class' : 'wrapper',
	});
	text_wrapper.appendTo(item_wrapper);

	//elements add to image_link
	var overlay = $('<div/>').attr('class', 'overlay');
	$('<div/>').attr('class', 'inner').appendTo(overlay);

	var image = $('<img/>').attr({
		'src':banner_src,
		'alt':ei_name,
	});
	overlay.appendTo(image_link);
	image.appendTo(image_link);
	//end : elements add to image_link

	//elements add to text_wapper
	var like_link = $('<a/>').attr({
		'href' : like_link_default+'?seq='+ei_seq,
		'target' : 'formReceiver',
		'id' : 'eiseq_'+ei_seq,
		'class' : 'like-btn'
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
	price.appendTo(text_wrapper);

	var event_suga = $('<div/>').attr('class', 'event-suga');
	event_suga.appendTo(price);
	if(is_close_mall){
		var suga_name = '제휴 할인';
	}else{
		var suga_name = '이벤트 수가';
	}


	var suga = $('<span/>').attr('class', 'suga').html(suga_name).appendTo(event_suga);


	var account = $('<div/>').attr('class', 'account');
	account.appendTo(price);

	if(is_close_mall){
		// var big_event_sale_img = $('<img/>').attr({
		// 	'src':"/resource/images/medical/event_big_sale.png",
		// 	'alt':"추가할인",
		// });
		// var big_event_sale_div = $('<div/>').attr('class', 'big_event_sale_img').html(big_event_sale_img)
		// item_wrapper.append(big_event_sale_div)

		suga.addClass('red')
		var red_text = $('<span/>').attr('class', 'red').html(ei_discounted_account+' 원')
		$('<span/>').attr('class', 'original-account').html(ei_original_account+' 원').appendTo(account);
		// account.html(account.html()+' '+ red_text[0].outerHTML)
		account.html(account.html()+' ').append(red_text)

	}else{
		$('<span/>').attr('class', 'original-account').html(ei_original_account+' 원').appendTo(account);
		account.html(account.html()+' '+ei_account+' 원');
	}

	var event_date = $('<div/>').attr('class', 'event-date');
	$('<span/>').attr('class',' end_time').html('(~'+end_time+')').appendTo(event_date);
	event_date.appendTo(price);


	var agentype = $('<div/>').attr('class', 'agentype');
	agentype.appendTo(text_wrapper);

	var age = $('<div/>').attr('class', 'type');
	age.html('<span> 추천연령 : </span>'+ei_age_text);
	age.appendTo(agentype);


	var type = $('<div/>').attr('class', 'age');
	type.html('<span> 검진테마 : </span>'+ei_theme_text);
	type.appendTo(agentype);

//	var figure = $('<figure/>');
//	$('<i/>').attr({
//			'class' : 'fa fa-map-marker',
//			'style' : 'color:red'
//	}).appendTo(figure);
//	figure.html(figure.html()+' '+address);
//
//	figure.appendTo(text_wrapper);
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

function onInitGotoEvent(){
	var list = $('#event-photo-list .item');
	$.each(list, function(i, e){
		$(e).find('.wrapper div').on('click', function(event){
			var href = $(e).find('.image a').attr('href');
			document.location.href=href;
		});
	});
}
</script>

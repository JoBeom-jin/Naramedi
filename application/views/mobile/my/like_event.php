<section class="container3" id="my-checked-event">
	<div class="">
		<!--Content-->
		<div class="">

		<header>
			<img src="/resource/images/mobile/arrow-icon.png" onclick="javascript:history.back()" alt="arrow-icon"style="width: 20px;float: left;margin-left: 15px;">
			<h1 class="page-title page-title2">찜한 이벤트</h1>
		</header>
		

		<!--Listing Grid-->
		<section class="block equal-height">
			<div class="row" id="photo-list" data-total="<?=$paging->totalPages?>" style="margin:0px;background: #f1f1f1; min-height:400px;">

				<?if(is_array($checked_list) && count($checked_list) > 0):?>
				<?foreach($checked_list as $k => $v):?>			
				<div class="col-md-6 col-sm-6" style="padding:0px;">
					<div style="background:#fff;float: left; width: 100%; margin-top:6px;">
						<div class="item" style="background:#fff;">
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

							<div class="wrapper" style="position:relative; float:left;">

								<figure>
									<?=$v['hi_open_name']?>
								</figure>


								<a href="/m/index.php/mobile/contents/event_hospital/viewEvent?seq=<?=$v['ei_seq']?>"><h3 style="font-size:18px;"><?=$v['ei_name']?></h3></a>


								<a href="<?=$contents_url?>/my_check?seq=<?=$v['ei_seq']?>" style="position:absolute; top:20px; right:20px; display:block; width:35px; height:35px;" target="formReceiver" id="eiseq_<?=$v['ei_seq']?>">
									<!-- <?if(in_array($v['ei_seq'], $like_list)):?>
									<i class="fa fa-heart fa-2x" style="color:red; "></i>
									<?else:?>
									<i class="fa fa-heart-o fa-2x" style="color:red; "></i>
									<?endif;?> -->
								</a>

								<div class="item-desc">
									추천대상 &nbsp;&nbsp;&nbsp;&nbsp; 30,40대 <br/>
									이벤트기간 &nbsp; <?=date('Y년 m월 d일', $v['ei_end'])?>까지 <br/>
								</div>


								<div class="price">
									<font style='font-size:60%; text-decoration:line-through'>660,000원</font>
									<?=number_format($v['ei_account'])?> 원
								</div>	
								<br/>

								<!-- <font size=2 color=#818181>(~<?=date('Y년 m월 d일', $v['ei_end']) ?>까지)</font> -->

								
							</div>
						</div>
					<!-- /.item-->
					</div>
				</div>
				<?endforeach;?>
				<?else:?>
						<div style="text-align:center;  background: #f1f1f1; border:none; line-height: 20px;">
						<img src="/resource/images/mobile/alert-icon.png" alt="alert-icon" style="width:42px;margin-top:20px; margin-bottom: 10px;"><br/>내역이 없습니다.<br/> OK검진에서 다양한 의료정보와 혜택을 찾아보세요.</td>
						</div>
						
				<?endif;?>


			</div>										
			<!--/.row-->
		</section>
		<!--end Listing Grid-->

		<!-- <div class="btn-area-center">
			<a href="#" id="more-btn" id="more-btn" class="btn btn-default" style="color:white; width:99%;" onclick="return false;">더보기</a>
		</div>
		 -->
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

<script type="text/javascript">
$(document).ready(function() {
    $('#adaptive').lightSlider({
        adaptiveHeight:true,
        item:1,
	    auto:true,
        loop:true,
        slideMargin:0,
    });

	$('#city').on('change', function(){		
		$('#search-form').submit();
	});

	$('#local').on('change', function(){		
		$('#search-form').submit();
	});

	$('#type').on('change', function(){		
		$('#search-form').submit();
	});


	$('ul.lSPager li a').each(function(){
		$(this).text('000000000');
	});
});	
</script>

<script>
var current_page = 1;
var exists_more = true;
var total_pages = 0;
var more_btn = false;
var ajax_url = '/m/index.php/mobile/contents/my_checked/jsonEventList?';

$(document).ready(function(){
	total_pages = parseInt($('#photo-list').data('total'));
	more_btn = $('#more-btn');
	if(current_page >= total_pages){	
		close_btn();		
	}

	more_btn.on('click', function(){		
		more_list();
	});
});


function more_list(){
	if(!exists_more){
		alert('마지막 페이지 입니다.');
		return false;
	}

	current_page++;
	if(current_page >= total_pages){	
		close_btn();		
	}

	$.ajax({
		url: ajax_url+'q_page='+current_page,
		type: "GET",
		dataType: "JSON",
		success: function (data) {			   
			if(data.list.length > 0){
				data.list.forEach(function(entry){
					var event_link = '<?=$contents_url?>/event_hospital/viewEvent?seq='+entry.ei_seq;
					makeItem(event_link, entry.banner_src, entry.ei_seq, entry.ei_name, entry.is_like, entry.is_closed, entry.ei_account, entry.ei_discounted_account, entry.end_time, entry.hi_open_name, entry.address);
				
				});
			}else{
				close_btn();
			}
		}
	});
			
}



var list_area = $('#photo-list');
var view_link_default = '<?=$contents_url?>/event_hospital/viewEvent';
var like_link_default = '<?=$contents_url?>/my_check';
function makeItem(event_list_href, banner_src, ei_seq, ei_name, is_like, is_close_mall, ei_account, ei_discounted_account, end_time, hi_open_name,   address){	
	//wrappers
	var list_wrapper = $('<div/>').attr('class', 'col-md-6 col-sm-6');
	list_wrapper.appendTo(list_area);

	var item_wrapper = $('<div/>').attr({
		'class':'item',
		'style' : 'height:380px; overflow:hidden;'
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
		'size' : '2',
		'color' : 'black'
	}).appendTo(figure);
	$('<b/>').html(hi_open_name+'&nbsp;&nbsp;').appendTo(name);

	$('<i/>').attr({
			'class' : 'fa fa-map-marker',
			'style' : 'color:red'
	}).appendTo(figure);
	figure.html(address);
	
	figure.appendTo(text_wrapper);	
}

function close_btn(){
	exists_more = false;
	more_btn.html('마지막 페이지입니다.');
}





fbq('track', 'ViewContent', {content_type : 'event list',  content_category:'pc : event list'});

fbq('track', 'Lead', {
	content_type: 'event list',
	content_category: 'pc : event list',
});	

$(document).ready(function(){
	var city = $('#city :selected').val();
	var local = $('#local :selected').val();
	var type = $('#type :selected').val();
	fbq('track', 'Search', { 
		search_string: city+local+type,
		content_category: 'pc : event list',	
	});
});
</script>
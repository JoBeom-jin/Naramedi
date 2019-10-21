<section class="hero-image height-400">
	<div class="background">
		<img src="/resource/images/medical/hot_deal_top.jpg" alt="핫딜 병원 메뉴 입니다.">
	</div>
</section>

<section class="container">
	<div class="">
		<!--Content-->
		<div class="">
			<header>
				<h1 class="page-title">핫딜 병원 <font color=#0096ff><?=$hospital_info['hi_open_name']?></font></h1>
			</header>


			<figure class="filter clearfix">
				<div class="pull-left">
					<aside class="sorting">
						<h2>
							<a href="<?=$menu_url?>/<?=$act?>?sort=new&amp;hi_seq=<?=$hi_seq?>">
								<?if($sort == 'new'):?>
								<i class="fa fa-check" style="color:red"></i>최신순
								<?else:?>
								<font style="color:#a3a3a3;">최신순</font>
								<?endif;?>								
							</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="<?=$menu_url?>/<?=$act?>?sort=like&amp;hi_seq=<?=$hi_seq?>">
								<?if($sort == 'like'):?>
								<i class="fa fa-check" style="color:red"></i>인기순
								<?else:?>
								<font style="color:#a3a3a3;">인기순</font>
								<?endif;?>								
							</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="<?=$menu_url?>/<?=$act?>?sort=up&amp;hi_seq=<?=$hi_seq?>">
								<?if($sort == 'up'):?>
								<i class="fa fa-check" style="color:red"></i>가격높은순
								<?else:?>
								<font style="color:#a3a3a3;">가격높은순</font>
								<?endif;?>								
							</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="<?=$menu_url?>/<?=$act?>?sort=down&amp;hi_seq=<?=$hi_seq?>">
								<?if($sort == 'down'):?>
								<i class="fa fa-check" style="color:red"></i>가격낮은순
								<?else:?>
								<font style="color:#a3a3a3;">가격낮은순</font>
								<?endif;?>								
							</a>
						</h2>
					<!-- /.form-group -->
					</aside>
				</div>
			</figure>


			<!--Listing Grid-->
			<section class="block equal-height" id="total-page" data-total="<?=$paging->totalPages?>">
				<div class="row" id="photo-list">
					<?if(is_array($list) && count($list) > 0):?>
					<?foreach($list as $k => $v):?>		
					<div class="col-md-6 col-sm-6">
						<div class="item">
							<div class="image">
								<a href="<?=$contents_url?>/event_hospital/viewEvent?seq=<?=$v['ei_seq']?>">
									<div class="overlay">
										<div class="inner">
										</div>
									</div>
									<?if($v['banner']):?>
									<img src="<?=$v['banner']?>" alt="<?=$v['ei_name']?>" style="width:555px; height:242px;">
									<?endif;?>
								</a>
							</div>

							<div class="wrapper" style="position:relative;">
								<a href="<?=$contents_url?>/event_hospital/viewEvent?seq=<?=$v['ei_seq']?>"><h3><?=$v['ei_name']?></h3></a>

								<a href="<?=$contents_url?>/my_check?seq=<?=$v['ei_seq']?>" style="position:absolute; top:20px; right:20px; display:block; width:35px; height:35px;" target="formReceiver" id="eiseq_<?=$v['ei_seq']?>">
								<?if(in_array($v['ei_seq'], $like_list)):?>
								<i class="fa fa-heart fa-2x" style="color:red;"></i>
								<?else:?>
								<i class="fa fa-heart-o fa-2x" style="color:red;"></i>
								<?endif;?>
								</a>

								<div class="price"><span class="suga">이벤트 수가</span> 
									<?if($is_closed && $v['ei_closed_discount'] > 0):?>
									<span class="not-price"><?=number_format($v['ei_account'])?> 원</span> <?=number_format($v['ei_account']-($v['ei_account'] * ( $v['ei_closed_discount'] / 100 )) )?> 원
									<?else:?>
									<?=number_format($v['ei_account'])?> 원
									<?endif;?>									
								</div>
								<font size=2 color=#818181>(~<?=date('Y년 m월 d일', $v['ei_end']) ?>까지)</font>
								<figure>
									<font size=2 color=black><b><?=$v['hi_open_name']?>&nbsp;&nbsp;</b></font><i class="fa fa-map-marker" style="color:red"></i><?=$v['ai_addr']?>
								</figure>
							</div>
						</div>
						<!-- /.item-->
					</div>
					<?endforeach;?>
					<?endif;?>
				</div>
				<!--/.row-->
			</section>
			<!--end Listing Grid-->

			<div class="btn-area-center">
				<a href="#" id="more-btn" id="more-btn" class="btn btn-default" style="color:white; width:99%;">더보기</a>
			</div>

		</div>

	</div>
</section>

<script>



var current_page = 1;
var exists_more = true;
var total_pages = 0;
var more_btn = false;
var ajax_url = '/index.php/medical/contents/hot_hospital/jsonEventList?sort=<?=$sort?>&hi_seq=<?=$hi_seq?>';

$(document).ready(function(){
	total_pages = parseInt($('#total-page').data('total'));
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
		url: ajax_url+'&q_page='+current_page,
		type: "GET",
		dataType: "JSON",
		success: function (data) {			   
			if(data.list.length > 0){
				data.list.forEach(function(entry){
					var event_link = '<?=$contents_url?>/event_hospital/viewEvent?seq='+entry.ei_seq;
					makeItem(event_link, entry.banner_src, entry.ei_seq, entry.ei_name, entry.is_like, entry.is_close_mall, entry.ei_account, entry.ei_discounted_account, entry.end_time, entry.hi_open_name, entry.address);
				
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

	var item_wrapper = $('<div/>').attr('class','item');
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


fbq('track', 'ViewContent', {content_type : 'hot event list',  content_category:'pc : hot event list'});

fbq('track', 'Lead', {
	content_type: 'hot event list',
	content_category: 'pc : hot event list',
});	
</script>	
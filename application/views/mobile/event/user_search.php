<?$add_url = "city={$select_city}&amp;local={$select_local}&amp;type={$select_type}&amp;hi_seq={$hi_seq}";?>
<div id="event-list">
	<!-- 슬라이더 시작-->
	<div id="wrapper2">
		<ul id="adaptive" class="cs-hidden">
			<?if(is_array($slider_images) && count($slider_images) > 0):?>
			<?foreach($slider_images as $img):?>
			<li class="item-e"> 
				<a href="/m/index.php/mobile/contents/event_hospital/viewEvent?seq=<?=$img['ei_seq']?>">
					<img src="<?=$img['url']?>" alt="<?=$img['name']?>">
				</a>
			 </li>
			<?endforeach;?>
			<?endif;?>
		</ul>	
	</div>
	<!-- END :: 슬라이더 -->

	<style type="text/css">
		div.event-search-group{clear:both; width:100%; height:auto; padding:0; min-height:30px;}
		div.event-search-group ul{clear:both; margin-bottom:5px;}
		div.event-search-group li{width:14%; float:left;}
		div.event-search-group li:first-child{margin-left:1%;}
		div.event-search-group li:first-child{margin-left:1%;}
		div.event-search-group li img{width:100%;}
	</style>
	<div class="event-search-group">
		<ul class="my-tab-menu1">
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=&amp;type=<?=$select_type?>&amp;hi_seq=<?=$hi_seq?>"><img src="/resource/images/mobile/event_tab/area_<?if(!$select_city):?>on<?else:?>off<?endif;?>_01.png" alt="전체지역"/></a>
			</li>
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=서울경기인천&amp;type=<?=$select_type?>&amp;hi_seq=<?=$hi_seq?>"><img src="/resource/images/mobile/event_tab/area_<?if($select_city=='서울경기인천'):?>on<?else:?>off<?endif;?>_02.png" alt="서울경기인천"/></a>
			</li>
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=충청도&amp;type=<?=$select_type?>&amp;hi_seq=<?=$hi_seq?>"><img src="/resource/images/mobile/event_tab/area_<?if($select_city=='충청도'):?>on<?else:?>off<?endif;?>_03.png" alt="충청"/></a>
			</li>
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=전라도&amp;type=<?=$select_type?>&amp;hi_seq=<?=$hi_seq?>"><img src="/resource/images/mobile/event_tab/area_<?if($select_city=='전라도'):?>on<?else:?>off<?endif;?>_04.png" alt="전라"/></a>
			</li>
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=경상도&amp;type=<?=$select_type?>&amp;hi_seq=<?=$hi_seq?>"><img src="/resource/images/mobile/event_tab/area_<?if($select_city=='경상도'):?>on<?else:?>off<?endif;?>_05.png" alt="경상"/></a>
			</li>
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=강원도&amp;type=<?=$select_type?>&amp;hi_seq=<?=$hi_seq?>"><img src="/resource/images/mobile/event_tab/area_<?if($select_city=='강원도'):?>on<?else:?>off<?endif;?>_06.png" alt="강원"/></a>
			</li>
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=제주도&amp;type=<?=$select_type?>&amp;hi_seq=<?=$hi_seq?>"><img src="/resource/images/mobile/event_tab/area_<?if($select_city=='제주도'):?>on<?else:?>off<?endif;?>_07.png" data-on="/resource/images/mobile/event_tab/area_on_07.png"  alt="제주"/></a>
			</li>
		</ul>

		<ul class="my-tab-menu2">
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=<?=$select_city?>&amp;type=&amp;hi_seq=<?=$hi_seq?>" class="my-tab-selected"><img src="/resource/images/mobile/event_tab/kind_<?if(!$select_type):?>on<?else:?>off<?endif;?>_01.png"  alt="전체유형"/></a>
			</li>
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=<?=$select_city?>&amp;type=TYP001&amp;hi_seq=<?=$hi_seq?>"><img src="/resource/images/mobile/event_tab/kind_<?if($select_type=='TYP001'):?>on<?else:?>off<?endif;?>_02.png" alt="2030검진"/></a>
			</li>
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=<?=$select_city?>&amp;type=TYP002&amp;hi_seq=<?=$hi_seq?>"><img src="/resource/images/mobile/event_tab/kind_<?if($select_type=='TYP002'):?>on<?else:?>off<?endif;?>_03.png" alt="3040검진"/></a>
			</li>
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=<?=$select_city?>&amp;type=TYP003&amp;hi_seq=<?=$hi_seq?>"><img src="/resource/images/mobile/event_tab/kind_<?if($select_type=='TYP003'):?>on<?else:?>off<?endif;?>_04.png" alt="5060검진"/></a>
			</li>
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=<?=$select_city?>&amp;type=TYP004&amp;hi_seq=<?=$hi_seq?>"><img src="/resource/images/mobile/event_tab/kind_<?if($select_type=='TYP004'):?>on<?else:?>off<?endif;?>_05.png" alt="예비부부검진"/></a>
			</li>
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=<?=$select_city?>&amp;type=TYP005&amp;hi_seq=<?=$hi_seq?>"><img src="/resource/images/mobile/event_tab/kind_<?if($select_type=='TYP005'):?>on<?else:?>off<?endif;?>_06.png" alt="여성정밀검진"/></a>
			</li>
			<li>
				<a href="<?=$menu_url?>/<?=$act?>?city=<?=$select_city?>&amp;type=TYP006&amp;hi_seq=<?=$hi_seq?>"><img src="/resource/images/mobile/event_tab/kind_<?if($select_type=='TYP006'):?>on<?else:?>off<?endif;?>_07.png" alt="숙박검진"/></a>
			</li>
		</ul>
	</div>
	<section class="container" style="clear:both;">
		<figure class="filter clearfix">
			<div class="pull-left">
				<aside class="sorting">
					<h2 style="color:#a3a3a3; margin-top:10px; ">
					<a href="<?=$menu_url?>/<?=$act?>?<?=$add_url?>&amp;sort=new#search-form">
						<?if($sort == 'new'):?>
						<i class="fa fa-check" style="color:red"></i>
						<span style="font-weight:bold;">최신순</span>
						<?else:?>
						최신순
						<?endif;?>					
					</a>
			
					&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="<?=$menu_url?>/<?=$act?>?<?=$add_url?>&amp;sort=like#search-form">
						<?if($sort == 'like'):?>
						<i class="fa fa-check" style="color:red"></i>
						<span style="font-weight:bold;">인기순</span>
						<?else:?>
						인기순
						<?endif;?>
					</a>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="<?=$menu_url?>/<?=$act?>?<?=$add_url?>&amp;sort=up#search-form">
						<?if($sort == 'up'):?>
						<i class="fa fa-check" style="color:red"></i>
						<span style="font-weight:bold;">가격높은순</span>
						<?else:?>
						가격높은순
						<?endif;?>				  
					</a>

					&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="<?=$menu_url?>/<?=$act?>?<?=$add_url?>&amp;sort=down#search-form">
						<?if($sort == 'down'):?>
						<i class="fa fa-check" style="color:red"></i>
						<span style="font-weight:bold;">가격낮은순</span>
						<?else:?>
						가격낮은순
						<?endif;?>					
					</a>
					</h2>
					<!-- /.form-group -->
				</aside>
			</div>
		</figure>


		<!--Listing Grid-->
		<section class="block equal-height" >
			<div class="row" id="photo-list" data-total="<?=$paging->totalPages?>">

				<?if(is_array($list) && count($list) > 0):?>
				<?foreach($list as $k => $v):?>			
				<div class="col-md-6 col-sm-6">
					<div class="item" style="height:auto; overflow:hidden;">
						<div class="image">						
							<div class="overlay">
								<div class="inner">
								</div>
							</div>

							<a href="<?=$menu_url?>/viewEvent?seq=<?=$v['ei_seq']?>">
								<?if($v['banner']):?>
								<img src="<?=$v['banner']?>" alt="<?=$v['ei_name']?>" style="width:100%;" >
								<?endif;?>
							</a>	
						</div>

						<div class="wrapper" style="position:relative;">

							<a href="<?=$menu_url?>/viewEvent?seq=<?=$v['ei_seq']?>"><h3><?=$v['ei_name']?></h3></a>

							
							<a href="<?=$contents_url?>/my_check?seq=<?=$v['ei_seq']?>" class="like-btn" target="formReceiver" id="eiseq_<?=$v['ei_seq']?>">
								<?if(in_array($v['ei_seq'], $like_list)):?>
								<i class="fa fa-heart fa-2x" style="color:red;"></i>
								<?else:?>
								<i class="fa fa-heart-o fa-2x" style="color:red;"></i>
								<?endif;?>
							</a>
							

							<div class="price">
								<span class="suga">이벤트 수가</span> 

								<?if($is_closed && $v['ei_closed_discount'] > 0):?>
								<span class="not-price"><?=number_format($v['ei_account'])?> 원</span> 
								<?=number_format($v['ei_account']-($v['ei_account'] * ( $v['ei_closed_discount'] / 100 )) )?> 원
								<?else:?>
								<?=number_format($v['ei_account'])?> 원
								<?endif;?>
							</div>	

							<div>
								<font size=2 color=#818181>(~<?=date('Y년 m월 d일', $v['ei_end']) ?>까지)</font>
							</div>

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

		<div class="btn-area-center btn-area-renew">
			<a href="#" id="more-btn" id="more-btn" class="btn btn-default" style="color:white; width:100%;" onclick="return false;">더보기</a>
		</div>

	</section>
</div>

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
var ajax_url = '/index.php/medical/contents/event_hospital/jsonEventList?sort=<?=$sort?>&<?=$add_url?>';

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

	var item_wrapper = $('<div/>').attr({
		'class':'item',
		'style' : 'height:auto; overflow:hidden;'
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
		'style' : 'width:100%;'
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
	}).html('<br/>(~'+end_time+'까지)').appendTo(text_wrapper);	

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
	figure.html(figure.html()+address);
	
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
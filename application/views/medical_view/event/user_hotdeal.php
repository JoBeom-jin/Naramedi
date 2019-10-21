<style>
#photo-list .item{height:400px !important;}
.item .image a img{
	height: 300px;
}
</style>
<!-- <section class="hero-image height-700">
	<div class="background" style="background:url(/resource/images/medical/hot_deal_top.jpg) center;">
		&nbsp;
	</div>
</section> -->
<!-- <section class="hero-image height-400">
	<div class="background">
		<img src="/resource/images/medical/hot_deal_top.jpg" alt="핫딜 병원 메뉴 입니다.">
	</div>
</section> -->
<section class="hero-image" style="height: 640px !important;">
	<div class="background" style="background:url(/resource/images/medical/hotdeal/hotdeal_top.png) center;">
	</div>
</section>
<!-- contents-container section -->
<section class="container">

<div>
	<div>
		<header style="border-bottom: 2px black solid; padding-bottom: 20px; margin-bottom: 30px;">
			<h1 class="page-title" style>제휴 병원 list</h1>
		</header>

		<figure class="filter clearfix">
			<div class="pull-left" style="display: none;">
				<font color="#e0534c" id="total-page" data-total="<?=$paging->totalPages?>"><b><?=$paging->totalRows?>개</b></font>의 핫딜 병원이 있습니다. 
			</div>
		</figure>

		<!--Listing Grid-->
		<section class="block equal-height">

			<!-- list block -->
			<div class="row" id="photo-list" style="padding: 1px;">		

				<?if(isArray_($list)):?>
				<?foreach($list as $k => $v):?>
				<div class="col-md-4 col-sm-4">
					<div class="item">
						<div class="image" style="">
							<a href="<?=$menu_url?>/eventList?hi_seq=<?=$v['hi_seq']?>">
								<div class="overlay">
									<div class="inner">
									</div>
								</div>
								<?if($v['path'] && is_file($v['path'])):?>
								<!-- 리눅스서버용 -->
								<img src="<?=path2url_($v['path'])?>" alt="<?=$v['hi_open_name']?>">
								<!-- 윈도우서버용 -->
								<!-- <img src="<?=$v['path']?>" alt="<?=$v['hi_open_name']?>"> -->
								<?else:?>
								<img src="/resource/images/medical/map_images/none_image.png" alt="<?=$v['hi_open_name']?>">
								<?endif;?>
							</a>
						</div>
						<div class="wrapper">
							<a href="<?=$menu_url?>/eventList?hi_seq=<?=$v['hi_seq']?>"><h3><?=$v['hi_open_name']?></h3></a>
							<figure style="font-size: 15px;"><i class="fa fa-map-marker" style="color:#195ab4"></i> <?=$v['ai_addr']?> </figure>
						</div>
					</div>
					<!-- /.item-->
				</div>
				<?endforeach;?>
				<?endif;?>

			</div>			
			<!-- END ::  list block -->

		</section>
		<!-- END :: Listing Grid-->


		<div class="btn-area-center">
			<a href="#" id="more-btn" id="more-btn" class="btn btn-default" style="color:white; width:99%;" onclick="return false;">더보기</a>
		</div>
		
	</div>
</div>	

</section>
<!-- END ::  contents-container -->

<script>
var current_page = 1;
var exists_more = true;
var total_pages = 0;
var more_btn = false;

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
		url: "<?=$menu_url?>/getListAjax?q_page="+current_page,
		type: "GET",
		dataType: "JSON",
		success: function (data) {			   
			if(data.list.length > 0){
				data.list.forEach(function(entry){
					var event_link = '<?=$menu_url?>/eventList?hi_seq='+entry.hi_seq;
					makeItem(event_link, entry.thum, entry.hi_open_name, entry.ai_addr);					
				});
			}else{
				close_btn();
			}
		}
	});

			
}

function close_btn(){
	exists_more = false;
	more_btn.html('마지막 페이지입니다.');
}

var list_area = $('#photo-list');
var thum_src_default = '/resource/images/medical/map_images/none_image.png';
function makeItem(event_list_href, thum_src, hi_open_name, address){	
	//wrappers
	var list_wrapper = $('<div/>').attr('class', 'col-md-3 col-sm-4');
	list_wrapper.appendTo(list_area);

	var item_wrapper = $('<div/>').attr({
		'class':'item',
		'style':'height: 270px'
	});
	item_wrapper.appendTo(list_wrapper);

	var image_wrapper = $('<div/>').attr('class', 'image');
	image_wrapper.appendTo(item_wrapper);

	var image_link = $('<a/>').attr('href',event_list_href);
	image_link.appendTo(image_wrapper);

	var text_wrapper = $('<div/>').attr('class', 'wrapper');
	text_wrapper.appendTo(item_wrapper);

	//elements add to image_link
	var overlay = $('<div/>').attr('class', 'overlay');
	$('<div/>').attr('class', 'inner').appendTo(overlay);

	var image_src = thum_src_default;
	if(thum_src && thum_src != '') image_src = thum_src;
	var image = $('<img/>').attr({
		'src':image_src,
		'alt':hi_open_name,
		'style':'height:300px !important'
	});
	overlay.appendTo(image_link);
	image.appendTo(image_link);
	//end : elements add to image_link

	//elements add to text_wapper
	var text_link = $('<a/>').attr('href', event_list_href);
	$('<h3/>').html(hi_open_name).appendTo(text_link);

	var figure = $('<figure/>');
	$('<i/>').attr({
			'class' : 'fa fa-map-marker',
			'style' : 'color:red'
	}).appendTo(figure);
	figure.html(figure.html()+' '+address);
	
	text_link.appendTo(text_wrapper);
	figure.appendTo(text_wrapper);	
}



fbq('track', 'ViewContent', {content_type : 'hot list',  content_category:'pc : hot list'});

fbq('track', 'Lead', {
	content_type: 'hot list',
	content_category: 'pc : hot list',
});	
</script>	
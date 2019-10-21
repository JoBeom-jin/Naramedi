<section class="block4" style="background-image:url(/resource/images/medical/main/main_bg_new.jpg);" >
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-8" style="padding:0px 3px 0px 0px;" >	
				<ul id="image-gallery" class="gallery list-unstyled cS-hidden">
					<?foreach($banner_list as $k => $v):?>
					<li data-thumb="<?=path2url_($v['eb_file_path'])?>"> 
						<?if($v['eb_link']):?>
						<a href="<?=$v['eb_link']?>">
							<img src="<?=path2url_($v['eb_file_path'])?>" width="100%" title="슬라이드 배너 이미지"  width="780px" height="460px"/>
						</a>
						<?else:?>
						<img src="<?=path2url_($v['eb_file_path'])?>" width="100%" title="슬라이드 배너 이미지"  width="780px" height="460px"/>
						<?endif;?>
					</li>
					<?endforeach;?>								
				</ul>
			</div>

			<div  id="recommend" class="main-photo-menu col-md-2 col-sm-2" style="padding:0px 3px 0px 0px; margin:0px 0px 0px 0px; width:195px;">
				 <section class="title block5" style="background:#3fb4ff;">
					<font color="white">MD추천 핫딜 병원 </font>
				</section>

				<?foreach($hot_hospital_list as $k => $hot):?>
				<a href="/index.php/medical/contents/hot_hospital/eventList?hi_seq=<?=$hot['hi_seq']?>" class="item-horizontal small">
					<div class="wrapper">
						<div class="image">
							<img src="<?=path2url_($hot['path'])?>" style="width:180px;">
						</div>
						<div class="info">
							<div class="type">
								<span><?=mb_substr($hot['hi_open_name'], 0, 13)?></span>
							</div>
						</div>
					</div>
				</a>
				<?endforeach;?>


			</div>

			<div id="board-notice-artilce" class="main-photo-menu col-md-2 col-sm-2" style="padding:0px 0px 0px 0px; margin:0px 0px 0px 0px; width:195px;"> 
                <section class="title block5" style="background:#0db952;">
					<font color="white">OK건강정보 </font>
				</section>

				<?if(isArray_($articles)):?>
				<?foreach($articles as $k => $v):?>
				<a href="/index.php/medical/contents/okmedi_healthboard?act=view&seq=<?=$v['bd_seq']?>" class="item-horizontal small">
				   <div class="wrapper">
						<div class="image">
							<?if(array_key_exists('thum', $v)):?>
							<img src="<?=$v['thum']?>" alt="<?=$v['bd_subject']?>">
							<?endif;?>
						</div>
						<div class="info">
							<div class="type">
								<span><?=mb_substr($v['bd_subject'], 0, 13)?></span>
							</div>						
						</div>
					</div>
				</a>
				<?endforeach;?>
				<?endif;?>
			</div>
			<div class="col-md-4 col-sm-4" style="padding:4px 0px 0px 0px; margin:0px 0px 0px 0px; "> 

				<form class="subscribe form-inline border-less-inputs" action="<?=$contents_url?>/search_hospital" method="get" role="form">
					<div class="input-group">
						<input type="text" name="ai_name" id="subscribe_email" placeholder="검진기관명을 입력하세요.">
						<span class="input-group-btn">
						<button type="submit" class="btn btn-default btn-large">찾기<i class="fa fa-angle-right"></i></button>
						</span>
					</div>
				</form>
			</div>


		</div>
	</div>		
</section>	


<section class="block4 background-color-grey-dark" style="clear:both;">
	<div class="container">

	<div class="row">

		<div class="col-md-4 col-sm-4"	>
			<i class="fa fa-heartbeat fa-2x" style="margin-left:165px;"></i>
			<h2 class="timer count-title count-number" data-to="<?=$total_agency?>" data-speed="1500"></h2>
			<p class="count-text ">검색 가능한 검진기관</p>
		</div>

		<div class="col-md-4 col-sm-4"	>
			<i class="fa fa-handshake-o fa-2x" style="margin-left:165px;"></i>
			<h2 class="timer count-title count-number" data-to="<?=$member_agency?>" data-speed="1500"></h2>
			<p class="count-text ">OK검진 제휴기관</p>
			</div>


		<div class="col-md-4 col-sm-4"	>
			<i class="fa fa-calendar-check-o fa-2x" style="margin-left:165px;"></i>
			<h2 class="timer count-title count-number" data-to="<?=$total_event?>" data-speed="1500"></h2>
			<p class="count-text ">진행중인 이벤트</p>
		</div>

		</div>

	</div>
	<!--/.container-->
</section>

<section class="block equal-height">
	<div class="container">
		<figure class="filter clearfix">
			<div class="pull-left">
			<font color="#e0534c"> </font>
			</div>
		</figure>

		<div class="row">

			<?foreach($event_list as $k => $v):?>
			<div class="col-md-3 col-sm-4">
				<div class="item">
					<div class="image" style="height:140px;">
						<a href="/index.php/medical/contents/event_hospital/viewEvent?seq=<?=$v['ei_seq']?>">
							<div class="overlay">
								<div class="inner">

								</div>
							</div>
							<img src="<?=path2url_($v['ei_img_banner'])?>" alt="<?=$v['hi_open_name']?>">
						</a>
					</div>

					<div class="wrapper">
						<a href=""><h3><?=$v['hi_open_name']?></h3></a>
						<figure><i class="fa fa-map-marker" style="color:red"></i><?=$v['ai_addr']?></figure>
					</div>
				</div>
			</div>
			<?endforeach;?>
		</div>
		
	</div>	
</section>










<!-- 상단슬라이더-->
<script>
 $(document).ready(function() {
	$("#content-slider").lightSlider({
		loop:true,
		keyPress:true
	});
	$('#image-gallery').lightSlider({
		gallery:true,
		item:1,
		thumbItem:7,
		slideMargin: 0,
		speed:1000,
		auto:true,
		loop:true,
		onSliderLoad: function() {
			$('#image-gallery').removeClass('cS-hidden');
		}  
	});
});
</script>

<!-- 메인카운터-->
<script>
(function ($) {
	$.fn.countTo = function (options) {
		options = options || {};
		
		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);
			
			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;
			
			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};
			
			$self.data('countTo', data);
			
			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);
			
			// initialize the element with the starting value
			render(value);
			
			function updateTimer() {
				value += increment;
				loopCount++;
				
				render(value);
				
				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}
				
				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;
					
					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}
			
			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};
	
	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};
	
	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
	formatter: function (value, options) {
	  return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
	}
  });
  
  // start all the timers
  $('.timer').each(count);  
  
  function count(options) {
	var $this = $(this);
	options = $.extend({}, options || {}, $this.data('countToOptions') || {});
	$this.countTo(options);
  }
});
</script>
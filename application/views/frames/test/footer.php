	<div id="top-btn">
		<a href="#page-top" class="to-top roll">
			<i class="fa fa-angle-up"></i>			
		</a>
	</div>	
</div> 
<!-- end body-contents -->
<!-- footer -->
<footer>
	<div class="container">
		<img src="<?=$_site_config['url']['images']?>/logo2.png">
		<ul class="icon-social">
			<li class="facebook"><a href="http://www.facebook.com/okaymedi"><i class="fa fa-facebook fa-lg"></i></a></li>
			<li class="kakao"><a href="http://plus.kakao.com/home/@OK검진"><i class="fa fa-comment fa-lg"></i></a></li>
			<li class="instagram"><a href="http://instagram.com/okmedi_"><i class="fa fa-instagram fa-lg"></i></a></li>
			<li class="blog"><a href="http://blog.naver.com/infinitycare"><i class="fa fa-rss fa-lg"></i></a></li>
		</ul>

		<div class="tel-fax-mail">
			<ul>
				<li><h4>㈜인피니티케어 | 서울시 서초구 잠원로 148 | 대표자:강숙현</h4></li>
				<li><h4>사업자등록번호:114-87-15991 | Tel:1588-9419</h4></li>
				<li><h4>ⓒINFINITYCARE All Rights Reserved</h4>
				<li>
					<a href="<?=$_site_config['url']['contents']?>/etc_terms" >
						<u style="text-decoration:none;">이용약관</u>
					</a>
					&nbsp;&nbsp;&nbsp;
					<a href="<?=$_site_config['url']['contents']?>/etc_personal">
						<u style="text-decoration:none;">개인정보처리방침 </u>
					</a>
				</li>
			</ul>
		</div>
	</div>
</footer>
<!-- end footer -->
</div>


<iframe id="formReceiver" name="formReceiver" title="프로그램용 - 내용없음"></iframe>

<!-- script -->
<!-- <script src="<?=$_site_config['url']['js']?>/jquery/jquery-1.12.3.min.js"></script> -->
<!-- <script src="<?=$_site_config['url']['js']?>/materialize.min.js"></script> -->
<!-- <script src="<?=$_site_config['url']['js']?>/slick.min.js"></script> -->
<!-- <script src="<?=$_site_config['url']['js']?>/owl.carousel.min.js"></script> -->

<script>
// 현재 스크롤바의 위치를 저장하는 변수 (px)
var currentScrollTop = 0;
     
// 비동기식 jQuery이므로 window load 후 jQuery를 실행해야 함
window.onload = function() {
    // 새로고침 했을 경우를 대비한 메소드 실행
    scrollController();
     
    // 스크롤을 하는 경우에만 실행됨
    $(window).on('scroll', function() {
        scrollController();
    });
}
     
// 메인 메뉴의 위치를 제어하는 함수
function scrollController() {
    currentScrollTop = $(window).scrollTop();
    if (currentScrollTop < 150) {
        $('#blog-header-container').css('top', -(currentScrollTop));
        $('#menu-container').css('top', 150-(currentScrollTop));
        if ($('#menu-container').hasClass('fixed')) {
            $('#menu-container').removeClass('fixed');
            $('#menu-container .menu-icon').removeClass('on');
        }
    } else {
        if (!$('#menu-container').hasClass('fixed')) {
            $('#blog-header-container').css('top', -150);
            $('#menu-container').css('top', 0);
            $('#menu-container').addClass('fixed');
            $('#menu-container .menu-icon').addClass('on');
        }
    }
}
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
<?if($_naver_msg):?>
alert('<?=$_naver_msg?>');
<?endif;?>
</script>



<script>

</script>

</body>
</html>
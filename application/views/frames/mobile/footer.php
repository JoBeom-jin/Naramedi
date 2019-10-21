	
</div> 
<!-- end body-contents -->
<!-- footer -->
<footer>
	<div class="container" style="position:relative; width:100%;">
		<!-- <div id="top-btn">
			<a href="#page-top" class="to-top scrollup">
				<i class="fa fa-angle-up"></i>			
			</a>
		</div> -->
		<ul class="icon-social" >
			<li class="kakao">
				<a target="_blank" href="https://pf.kakao.com/_xdKzWd">
					<img src="/resource/images/mobile/snsicon_01.png" alt="kakao">
				</a>
			</li>
			<li class="facebook">
				<a target="_blank" href="https://www.facebook.com/okaymedi/">
				<img src="/resource/images/mobile/snsicon_03.png" alt="facebook">
				</a>
			</li>
			<li class="blog">
				<a target="_blank" href="https://blog.naver.com/infinitycare">
				<img src="/resource/images/mobile/snsicon_02.png" alt="blog">
				</a>
			</li>
			<li class="instagram">
				<a target="_blank" href="https://www.instagram.com/okaymedi/">
				<img src="/resource/images/mobile/snsicon_04.png" alt="instagram">
				</a>
			</li>

		</ul>
		<!-- <img src="<?=$_site_config['url']['images']?>/logo2.png"> -->
		<ul class="icon-social2">
			<li class="info-menu-1" ><a href="<?=$_site_config['url']['contents']?>/etc_intro">오케이검진소개</a></li>
			<li>|</li>
			<li class="info-menu-2"><a href="<?=$_site_config['url']['contents']?>/etc_guide">제휴문의</a></li>
			<li>|</li>
			<li class="info-menu-3"><a href="<?=$_site_config['url']['contents']?>/etc_terms">이용약관</a></li>
			<li>|</li>
			<li class="info-menu-4"><a href="<?=$_site_config['url']['contents']?>/etc_personal">개인정보취급방침</a></li>
		</ul>

		

		<div class="tel-fax-mail">
			<ul>
				<li>서울시 서초구 강남대로97길 32,2층 | 대표자 강한승</li>
				<li>㈜인피니티케어 | 사업자등록번호:114-87-75991 | TEL 02-596-0721</li>
				<li>COPYRIGHTⓒ2019INFINITYCARE.ALL RIGHTS RESERVED
								<!-- <li>
					<a href="<?=$_site_config['url']['contents']?>/etc_terms" >
						<u style="text-decoration:none;">이용약관</u>
					</a>
					&nbsp;&nbsp;&nbsp;
					<a href="<?=$_site_config['url']['contents']?>/etc_personal">
						<u style="text-decoration:none;">개인정보처리방침 </u>
					</a>
				</li> -->
			</ul>
		</div>
	</div>
</footer>
<!-- end footer -->
</div>


<iframe id="formReceiver" name="formReceiver" title="프로그램용 - 내용없음"></iframe>

<!-- script -->
<!-- <script src="<?=$_site_config['url']['js']?>/jquery/jquery-1.12.3.min.js"></script> -->
<script src="<?=$_site_config['url']['js']?>/materialize.min.js"></script>
<script src="<?=$_site_config['url']['js']?>/slick.min.js"></script>
<script src="<?=$_site_config['url']['js']?>/owl.carousel.min.js"></script>

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
$('.scrollup').click(function () {    
	$("html, body").animate({
		scrollTop: 0
	}, 600);
	return false;    
});
</script>


<script src="//ajax.googleapis.com/ajax/libs/webfont/1.4.10/webfont.js"></script>
<script type="text/javascript">
  WebFont.load({
 
    // For early access or custom font
    custom: {
        families: ['Nanum Gothic'],
        urls: ['https://fonts.googleapis.com/earlyaccess/nanumgothic.css']
    } 
  });
</script>

</body>
</html>
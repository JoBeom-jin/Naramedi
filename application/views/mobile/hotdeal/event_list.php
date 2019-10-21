<div id="hot-deal-event-list">
	<section class="hero-image">
		<div class="background2">
			<img src="/resource/images/mobile/jaehu_main.png" alt="핫딜 병원 메뉴 입니다.">
		</div>
	</section>

<!-- 	<section class="container"> -->
		<div class="">
			<!--Content-->
			<div class="">
				<header>
					<h1 class="page-title" style="float:left;">
					<div style="background:#0096ff; min-height:26px; width:4px; margin-left:10px; float:left;"></div>	
					<font color=#0096ff style="margin-left:5px;float:left;"><?=$hospital_info['hi_open_name']?></font></h1>
				</header>


				<!-- 일반 검색 -->
				<form method="get" action="<?=$menu_url?>/<?=$act?>" id="search-form">
					<input type="hidden" name="hi_seq" value="<?=$hi_seq?>" />							
					<input type="hidden" name="sort" value="" />
				</form>

				<?=$sort_menu?>


				<!-- 이벤트 리스트 -->	
				<section class="block equal-height" >
					<div class="row" id="event-photo-list" data-total="" style="margin:0px;">
						
					</div>										
					<!--/.row-->
				</section>
				<!--end Listing Grid-->

				<div class="btn-area-center">
					<a href="#" id="more-btn" id="more-btn" class="btn btn-default" style="background:#393f4b; width:25%;">더보기</a>
				</div>

			</div>

		</div>
<!-- 	</section> -->
	
</div>

<?=$contents_footer?>
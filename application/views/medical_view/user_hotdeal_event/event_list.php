<style>
.item .wrapper figure{
	color: #0051d6;
}
.pull-left{
	padding-left: 15px;
}

</style>
<section class="hero-image" style="height: 640px !important;">
	<div class="background" style="background:url(/resource/images/medical/hotdeal/hotdeal_top.png) center;">
	</div>
</section>

<section class="container" id="user-event-list" style="padding-left: 0 !important; padding-right: 0 !important;">
	<div>
		<!--Content-->
		<div>
			<header style="padding-left: 15px;">
			<font style="font-weight:bold; color:#195ab4; float:left; font-size:32px">|</font>
				<h1 class="page-title">&nbsp;<font color=#195ab4><?=$hospital_info['hi_open_name']?></font></h1>
			</header>

			<!-- 일반 검색 -->
			<form method="get" action="<?=$menu_url?>/<?=$act?>" id="search-form">
				<input type="hidden" name="hi_seq" value="<?=$hi_seq?>" />							
				<input type="hidden" name="sort" value="" />
			</form>

			<?=$sort_menu?>

			<!-- 이벤트 리스트 -->	
			<section class="block equal-height" style="padding: 1px;">
				<div class="row" id="event-photo-list" data-total="">
					
				</div>										
				<!--/.row-->
			</section>
			<!--end Listing Grid-->

			<div class="btn-area-center">
				<a href="#" id="more-btn" id="more-btn" class="btn btn-default" style="color:white; width:99%;" onclick="return false;">더보기</a>
			</div>

		</div>
	</div>
</section>

<?=$contents_footer?>
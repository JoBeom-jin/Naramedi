<figure class="filter clearfix">
	<div class="pull-left">
		<aside class="sorting">
			<h2 style="color:#a3a3a3;">
			<a href="#" data-sort="new" class="sort-selector" onclick="return false">
				<?if($sort == 'new'):?>
				<!-- <i class="fa fa-check" style="color:red"></i> -->
				<span style="font-weight:bold;">최신순</span>
				<?else:?>
				<span style="color:#888;">최신순</span>
				<?endif;?>
			</a>

			&nbsp;|&nbsp;
			<a href="#" data-sort="like" class="sort-selector"  onclick="return false">
				<?if($sort == 'like'):?>
				<!-- <i class="fa fa-check" style="color:red"></i> -->
				<span style="font-weight:bold;">인기순</span>
				<?else:?>
				<span style="color:#888;">인기순</span>
				<?endif;?>
			</a>
			&nbsp;|&nbsp;
			<a href="#" data-sort="up" class="sort-selector"  onclick="return false">
				<?if($sort == 'up'):?>
				<!-- <i class="fa fa-check" style="color:red"></i> -->
				<span style="font-weight:bold;">가격높은순</span>
				<?else:?>
				<span style="color:#888;">가격높은순</span>
				<?endif;?>
			</a>

			&nbsp;|&nbsp;
			<a href="#" data-sort="down" class="sort-selector"  onclick="return false">
				<?if($sort == 'down'):?>
				<!-- <i class="fa fa-check" style="color:red"></i> -->
				<span style="font-weight:bold;">가격낮은순</span>
				<?else:?>
				<span style="color:#888;">가격낮은순</span>
				<?endif;?>
			</a>
			</h2>
			<!-- /.form-group -->
		</aside>
	</div><!-- 
	<div class="pull-right">
		<h2>하트표시(<font color='red'>♡</font>)는 찜하기 입니다.</h2>
	</div> -->
</figure>
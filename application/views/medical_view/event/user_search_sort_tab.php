<figure class="filter clearfix">
	<div class="pull-left">
		<aside class="sorting">
			<h2 style="color:#a3a3a3;">
			<a href="<?=$menu_url?>/<?=$act?>?kind_sort=new" data-sort="new" class="sort-selector">
				<?if($sort == 'new'):?>
				<i class="fa fa-check" style="color:red"></i>
				<span style="font-weight:bold;">최신순</span>
				<?else:?>
				<span style="color:#888;">최신순</span>
				<?endif;?>					
			</a>
	
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="<?=$menu_url?>/<?=$act?>?kind_sort=like" data-sort="like" class="sort-selector">
				<?if($sort == 'like'):?>
				<i class="fa fa-check" style="color:red"></i>
				<span style="font-weight:bold;">인기순</span>
				<?else:?>
				<span style="color:#888;">인기순</span>
				<?endif;?>
			</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="<?=$menu_url?>/<?=$act?>?kind_sort=up" data-sort="up" class="sort-selector">
				<?if($sort == 'up'):?>
				<i class="fa fa-check" style="color:red"></i>
				<span style="font-weight:bold;">가격높은순</span>
				<?else:?>
				<span style="color:#888;">가격높은순</span>
				<?endif;?>				  
			</a>

			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="<?=$menu_url?>/<?=$act?>?kind_sort=down" data-sort="down" class="sort-selector">
				<?if($sort == 'down'):?>
				<i class="fa fa-check" style="color:red"></i>
				<span style="font-weight:bold;">가격낮은순</span>
				<?else:?>
				<span style="color:#888;">가격낮은순</span>
				<?endif;?>					
			</a>
			</h2>
			<!-- /.form-group -->
		</aside>
	</div>
</figure>
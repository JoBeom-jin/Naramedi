<!-- container -->
<div>
	<img src="/resource/images/mobile/post/post_main_img2.png" alt="post메인이미지" style="width:100%;">
</div>
<div class="container3" id="board-health">
	<div class="row" style="margin:0px;">
		<ul class="tab-box">
			<li>
			<a class="link" href="<?=$menu_url?>/<?=$act?>?bdc_seq=1">
				<h4 class="blue">건강정보</h4>
			</a>
			</li>
			<li>
			<a class="link" href="<?=$menu_url?>/<?=$act?>?bdc_seq=4">
				<h4 class="orange">검진항목</h4>
			</a>
			</li>
			<li>
			<a class="link" href="<?=$menu_url?>/<?=$act?>?bdc_seq=3">
				<h4 class="gray">자주하는 질문</h4>
			</a>
			</li>
		</ul>
	</div>	
</div>
<!-- END :: container -->

<?php
	switch ($_GET['bdc_seq']) {
		case '1':
			echo '
			<script>
			$(".blue").addClass("blue2");
			</script>
			';
			break;
	
		case '4':
			echo '
			<script>
			$(".orange").addClass("blue2");
			</script>
			';
			break;
	
		case '3':
			echo '
			<script>
			$(".gray").addClass("blue2");
			</script>
			';
			break;
		
		default:
			# code...
			break;
	}
?>



<!-- section.container -->
<section class="container3" id="board-health-list">
	 <div class="">
		<!--Content-->
		<div class="">
			<!-- <header>
				<h1 class="page-title" style="padding:0; margin:15px 0;">
					<?if(isset($bdc_seq) && $bdc_seq):?>
					<?=$categories[$bdc_seq]['bdc_name']?>					
					<?else:?>
					전체목록					
					<?endif;?>
				</h1>
			</header> -->
			<figure class="filter clearfix" style=" margin:0; padding:0; height:74px; border-bottom: 1px solid #393f4b;">
				<div class="pull-right">
					<form method="get" action="<?=$menu_url?>/<?=$act?>">
						<input type="hidden" name="bdc_seq" value="<?=$bdc_seq?>" />
						<table class="search-form-table">
							<colgroup>
								<col width="100px" />
								<col width="" />
								<col width="50px" />
							</colgroup>
							<tr>
								<td style="border: none; position: relative;">
									<select name="sch_type" title="검색 종류 선택">
										<option value="subject" <?if($sch_type == 'subject'):?>selected="selected"<?endif;?>>제목</option>
										<option value="comment" <?if($sch_type == 'comment'):?>selected="selected"<?endif;?>>내용</option>
										
									</select>
									<i class="fa fa-angle-down" style="position: absolute; top: 21px; right: 20px;"></i>
								</td>
								<td class="fixed" style="padding: 5px 0px 5px 5px; border: none;">
									<input type="text" name="sch_text" value="<?=$sch_text?>" title="검색어 입력"  class="form-input" style="height:35px !important; padding: 8px;"/>
								</td>
								<td style="text-align:left; padding: 5px 0px; border: none;">
									<button type="submit"  class="btn btn-primary btn-default" style="height:35px; padding-top: 2px;">
									<i class="fa fa-search" ></i>
									</button>
									
								</td>
							</tr>
						</table>
					</form>
					<!-- <font color="#e0534c"><b><?=$paging->totalRows?>개</b></font>의 정보가 있습니다. -->
				</div>				
			</figure>
			
			<!--Listing Grid-->
			<section class="block equal-height" id="total-page" data-total="<?=$paging->totalPages?>">
				<?if(is_array($list) && count($list) > 0):?>	
				
				<div class="row" id="photo-list">			

					<?foreach($list as $k => $v):?>
					<div class="col-md-4 col-sm-4 ">
						<div class="item">
							<div class="image item_left" >
								<a href="<?=$menu_url?>?act=view&amp;seq=<?=$v['bd_seq']?>">
									<div class="overlay">
										<div class="inner">
										</div>
									</div>
									<!-- 해당 포스트에 맞는 썸네일 이미지 DB -->
									<?if(array_key_exists($v['bd_seq'], $thums) && $file_url = $thums[$v['bd_seq']]):?>
									<img src="<?=$file_url?>" alt="<?=$v['bd_subject']?>" style="width:100%; height:auto;">
									<?else:?>
									<?endif;?>									
								</a>
							</div>
							<div class="wrapper item_right" >
								<a href="<?=$menu_url?>?act=view&amp;seq=<?=$v['bd_seq']?>"><h4><?=mb_substr(strip_tags($v['bd_subject']),0, 18)?></h4></a>
								<figure class="item_right_content">
								<?=mb_substr(strip_tags($v['bd_content']),0, 60)?>...</figure>
							</div>
						</div>
					</div>
					<?endforeach;?>
				</div>
				
				<?endif;?>		
			</section>
			<!-- END :: Listing Grid-->

			<div class="btn-area-center btn-area-renew">
				<a href="#" id="more-btn" class="btn btn-default" style="color:white; width:100%;" onclick="return false;">더보기</a>
			</div>

		</div>		
	 </div>	
</section>
<!-- END :: section.container -->
<style>
	.select-wrapper input.select-dropdown{
		height:35px;
		line-height:1rem;
	}
</style>

<script type="text/javascript">

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
		url: "/m/index.php/mobile/contents/okmedi_healthboard?method=ajax&bdc_seq=<?=$bdc_seq?>&sch_type=<?=$sch_type?>&sch_text=<?=$sch_text?>&q_page="+current_page,
		type: "GET",
		dataType: "JSON",
		success: function (data) {			   
			if(data.list.length > 0){
				data.list.forEach(function(entry){
					setHtml(entry.bd_seq, entry.thums, entry.subject, entry.content);
				});
			}else{
				close_btn();
			}
		}
	});
			
}


var list_area = $('#photo-list');
function setHtml(bd_seq, thums, subject, content){	
	var area = $('<div/>').attr('class', 'col-md-4 col-sm-4 ');
	area.appendTo(list_area);

	var item = $('<div/>').attr('class', 'item');
	item.appendTo(area);

	var image = $('<div/>').attr('class', 'image item_left');
	image.appendTo(item);

	var a = $('<a/>').attr('href', '<?=$menu_url?>?act=view&seq='+bd_seq);
	var overlay = $('<div/>').attr('class', 'overlay');
	var inner = $('<div/>').attr('class', 'inner');
	inner.appendTo(overlay);
	overlay.appendTo(a);

	if(thums){
		$('<img/>').attr({
			'src':thums,
			'alt':subject,
			'style' : 'width:100%; height:auto;'
		}).appendTo(a);
	}

	a.appendTo(image);

	var wrapper = $('<div/>').attr('class', 'wrapper item_right');
	wrapper.appendTo(item);
	var a2 = $('<a/>').attr('href', '<?=$menu_url?>?act=view&amp;seq='+bd_seq);
	a2.appendTo(wrapper);
	$('<h4/>').html(subject).appendTo(a2);	
	var figure = $('<figure/>').attr('class', 'item_right_content');
	figure.html(content).appendTo(wrapper);
	
}

function close_btn(){
	exists_more = false;
	more_btn.html('마지막 페이지입니다.');
}
</script>

<style type="text/css">
#photo-list{}
#photo-list h4{font-weight:bold; font-size:97%; text-align:left; padding-top:16px;}
</style>
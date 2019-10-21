<div id="my_reserved_list">
	<section class="contents">		

		<header>
			<img src="/resource/images/mobile/arrow-icon.png" onclick="javascript:history.back()" alt="arrow-icon"style="width: 20px;float: left;margin-left: 15px;">
			<h1 class="page-title">예약현황</h1>
		</header>
		
		<table class="table table-list" summary="예약목록" >
			<caption class="hide">예약목록</caption>
			<!-- <thead>
				<tr>
					<th>검진정보</th>
					<th>현재상태</th>
				</tr>
			</thead> -->
			<tbody>
				<?if(isArray_($reserve_list)):?>
				<?foreach($reserve_list as $k => $v):?>
				<!-- <tr>
					<td>
						<?=$v['ai_name']?> 
						<hr/>
						<?=date('Y.m.d', $v['er_ctime']);?> <?=$_method[$v['er_method']]['name']?>접수
					</td>
					<td style="text-align:center; vertical-align:middle;">
						<?=$_status[$v['er_status']]['name']?>
					</td>
				</tr> -->
				<tr class="res">
					<td>
						<?=$v['ai_name']?> 
						
					</td>
					<td style="width: 32%;">
						<a href="/m/index.php/mobile/contents/event_hospital/viewEvent?seq=<?=$v['ei_seq']?>">
							이벤트보기<i class="fa fa-angle-right" style="margin-left:5px;"></i>
						</a>
					</td>
					
				</tr>
				<tr>
					<td>
						<p>예약방법 <span style="margin-left:30px; color:black; "><?=$_method[$v['er_method']]['name']?></span> </p>
						<p>예약신청일 <span style="margin-left:15px; color:black;"><?=date('Y.m.d', $v['er_ctime']);?></span>  </p>
						<p>현재상태  <span style="margin-left:30px; color:black;"><?=$_status[$v['er_status']]['name']?></span></p>
					</td>
					<td class="reserved_item">
					<br/>
					 <br/>
					
					</td>
				
				</tr>
				<?endforeach;?>
				<?else:?>
				<tr>
				<td colspan="5" style="text-align:center; line-height: 20px;"><img src="/resource/images/mobile/alert-icon.png" alt="alert-icon" style="width:42px;margin-bottom: 10px;"><br/>내역이 없습니다.<br/>  OK검진에서 다양한 의료정보와 혜택을 찾아보세요!</td>
				</tr>
				<?endif;?>

				
			</tbody>
		</table>						

	<section>
</div>
<style>
#page-top{
	display:none;
}
.res{
	border-top:6px solid #f1f1f1;
	
}
.res td:first-child{
	color:black;
	border-top: 1px solid #cdcdcd !important;
}
tbody td{
	padding: 10px !important;
}

.td:last-child{
	text-align:left !important;
}
.reserved_item{
	margin-right:30px;
	
}
</style>
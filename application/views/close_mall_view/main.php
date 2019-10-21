<style type="text/css">
#dashboard-manager{}
#dashboard-manager .stat{
	margin:15px;
	overflow:hidden;
	width:135px;
	height:80px;
	padding:20px;
	float:left;
	border:1px solid #555;
	border-radius:9px;
}
#dashboard-manager .dash-board .green{
	background-color:#D8E4BE;
}

#dashboard-manager .dash-board .red{
	background-color:#DA9695;
}

#dashboard-manager .dash-board .yellow{
	background-color:#FFC000;
}

#dashboard-manager .dash-board .white{
	background-color:#E6E0EC;
}

#dashboard-manager .detail{text-align:left; padding-top:15px; }
#dashboard-manager .detail *{color:black; font-weight:bold; font-size:26px; text-align:center;}
#dashboard-manager .detail .info{font-size:15px;}
#dashboard-manager .detail .two-line{line-height:110%; letter-spacing:-1px;}
#dashboard-manager .detail .number{color:red;}
</style>
<div id="dashboard-manager">
	<h2 class="title">오늘의 현황</h2>


	<div class="dash-board">
		<div class="stat green">
			<div class="detail">
				<div class="info two-line">
					<span class="number"><?=number_format($today_event_reserve)?></span> 명의<br/>
					이벤트 예약자가 있습니다.
				</div>
			</div>
		</div>
	</div>

	<!-- <div class="dash-board">
		<div class="stat red">
			<div class="detail">
				<div class="info two-line">
					<span class="number"><?=number_format($phone_not_count)?></span> 명의<br/>
					전화예약이<br/>미처리 상태입니다.
				</div>
			</div>
		</div>
	</div>


	<div class="dash-board">
		<div class="stat yellow">
			<div class="detail">
				<div class="info two-line">
					<span class="number"><?=number_format($phone_wait_count)?></span> 명이<br/>
					전화통화를 기다리고<br/>있습니다.
				</div>
			</div>
		</div>
	</div>

	<div class="dash-board">
		<div class="stat white">
			<div class="detail">
				<div class="info two-line">
					<span class="number"><?=number_format($phone_reserved_count)?></span> 명의<br/>
					예약자가 처리대기<br/>중입니다.
				</div>
			</div>
		</div>
	</div>

	<div class="list" style="clear:both;">
		<h3 class="title">예약 대기자 현황</h3>
		<table class="table table-list" summary="예약 대기자 현황" >
			<caption>예약대기자 현황</caption>
			<colgroup>
				<col width="8%" />
				<col width="auto" />
				<col width="15%" />

			</colgroup>
			<thead>
				<th>No</th>
				<th>제목</th>
				<th>등록일시</th>
			</thead>
			<tbody>
				<?if(is_array($article_list) && count($article_list) > 0):?>
				<?foreach($article_list as $k => $v):?>
				<tr>
					<td><?=$k+1?></td>
					<td>
						<a href="/index.php/rhksflwk/contents/notice_board"><?=$v['bd_subject']?></a>
					</td>
					<td>
						<?=date('Y.m.d H:i:s', $v['bd_ctime'])?>
					</td>
				</tr>
				<?endforeach;?>
				<?else:?>
				<tr>
					<td colspan="5">공지사항이 없습니다.</td>
				</tr>
				<?endif;?>
			</tbody>
		</table>
	</div> -->

</div>

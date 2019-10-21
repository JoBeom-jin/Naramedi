<style type="text/css">
#dashboard-manager{}
#dashboard-manager .stat{
	margin:15px;
	overflow:hidden;
	width:120px;
	height:80px;
	padding:20px;
	float:left;
	border:1px solid #555;
	border-radius:9px;
}
#dashboard-manager .dash-board .blue{
	background-color:#B9CDE5;
}

#dashboard-manager .dash-board .yellow{
	background-color:#D9E3BE;
}

#dashboard-manager .dash-board .bora{
	background-color:#CBC1DA;
}

#dashboard-manager .dash-board .sky{
	background-color:#B7DDE8;
}

#dashboard-manager .detail{text-align:left; padding-top:15px; }
#dashboard-manager .detail *{color:black; font-weight:bold; font-size:26px; text-align:center;}
#dashboard-manager .detail .strong{font-size:16px; margin-bottom:10px;}
#dashboard-manager .detail .two-line{line-height:100%;}
#dashboard-manager .detail .number{color:red;}
</style>
<div id="dashboard-manager">
	<h2 class="title">오늘의 현황</h2>


	<div class="dash-board">
		<div class="stat blue">
			<div class="detail">
				<div class="strong">
					<a href="/index.php/Manager/contents/reserv_normal" style="text-decoration:none;">일반예약</a>
				</div>
				<div class="number"><?=number_format($today_normal_reserve)?> 명</div>
			</div>			
		</div>		
	</div>

	<div class="dash-board">
		<div class="stat yellow">
			<div class="detail">
				<div class="strong"><a href="/index.php/Manager/contents/reserv_normal" style="text-decoration:none; letter-spacing:-3px;">이벤트예약</a></div>
				<div class="number"><?=number_format($today_event_reserve)?> 명</div>
			</div>			
		</div>		
	</div>


	<div class="dash-board">
		<div class="stat bora">
			<div class="detail">
				<a href="/index.php/Manager/contents/member_hosjoin" style="text-decoration:none;">
				<div class="strong two-line">
				병원회원<br/>승인대기
				</div>
				</a>
				<div class="number"><?=number_format($wait_members)?> 명</div>
			</div>			
		</div>		
	</div>

	<div class="dash-board">
		<div class="stat sky">
			<div class="detail">	
				<a href="/index.php/Manager/contents/event_stay" style="text-decoration:none;">
					<div class="strong two-line">이벤트<br/>승인대기</div>
				</a>
				<div class="number"><?=number_format($wait_event)?> 명</div>
			</div>			
		</div>		
	</div>

	<div class="dash-board">
		<div class="stat blue">
			<div class="detail">
				<div class="strong">
					<a href="/index.php/Manager/contents/member_userfaq" style="text-decoration:none; letter-spacing:-3px;">온라인상담</a>
				</div>
				<div class="number"><?=number_format($wait_qna_count)?> 명</div>
			</div>			
		</div>		
	</div>

	<div class="dash-board">
		<div class="stat bora">
			<div class="detail">
				<div class="strong">
					<a href="/index.php/Manager/contents/hos_question" style="text-decoration:none; letter-spacing:-3px;">제휴문의</a>
				</div>
				<div class="number"><?=number_format($today_join_question_count)?> 명</div>
			</div>			
		</div>		
	</div>

	<div class="list" style="clear:both;">
		<h3 class="title">예약 대기자 현황</h3>	
		<table class="table table-list" summary="예약 대기자 현황" >
			<caption>예약대기자 현황</caption>
			<thead>
				<th>No</th>
				<th>예약자 이름</th>
				<th>예약구분</th>
				<th>검진기관</th>
				<th>신청일시</th>
			</thead>
			<tbody>
				<?if(is_array($list) && count($list) > 0):?>
				<?foreach($list as $k => $v):?>
				<tr class="tcenter-all">
					<td><?=$k+1?></td>
					<td>
						<?=$v['er_name']?>
					</td>
					<td>
						<?=$rsv_codes[$v['er_status']]['name']?>
					</td>
					<td>
						<?=$v['ai_name']?>
					</td>
					<td>
						<?=date('Y.m.d H:i:s', $v['er_ctime'])?>
					</td>
				</tr>
				<?endforeach;?>
				<?else:?>
				<tr>
					<td colspan="5">오늘의 예약자가 없습니다.</td>
				</tr>
				<?endif;?>
			</tbody>			
		</table>
	</div>

</div>
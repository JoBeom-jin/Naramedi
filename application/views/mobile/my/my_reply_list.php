<section class="container3" id="my-reply-list">
	<div class="">
		<!--Content-->
		<div class="">

		<header>
			<img src="/resource/images/mobile/arrow-icon.png" onclick="javascript:history.back()" alt="arrow-icon"style="width: 20px;float: left;margin-left: 15px;">
			<h1 class="page-title page-title2">작성후기</h1>
		</header>

		<!--Listing Grid-->
		<section class="block equal-height" >
			<div class="row" style="margin:0px; background: #f1f1f1; min-height:400px;">

				<table class="table table-list" summary="내가 등록한 후기 보기" style="width:100%; margin:0px; ">
					<colgroup>
						<col width="30%"/>
						<col width="60%"/>
						
					</colgroup>
					<!-- <thead>
						<tr>
							<th colspan="4" class="tcenter">내가 남긴 후기</th>
						</tr>
						<tr>													
							<th rowspan="2" style="text-align:center; vertical-align:middle;">후기 내용</th>
							<th colspan="3" class="tcenter">만족도</th>
						</tr>
						<tr>
							<th>진료</th>
							<th>시설</th>
							<th>친절</th>
						</tr>
					</thead> -->
					<tbody>
						<?if(isArray_($reply_list)):?>
						<?foreach($reply_list as $k => $v):?>
						<tr class="res">
							<td>
							<div style="width:80px; height:80px; background:#f1f1f1; margin-left:20px;" ></div>
							</td>
							<td>
								<?=$v['ai_name']?> <br/> 
								<!-- <?=$v['ei_name']?> <br/> -->
								해당 병원 이름 데이터 <br/>
								<?=date('Y.m.d', $v['ac_ctime'])?>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<p >
									<a href="<?=$menu_url?>/modify?seq=<?=$v['ac_seq']?>">
										<?=strip_tags($v['ac_comment'])?>
									</a>
									
								</p>
								<br/>
							진료 
							<? for ($i=0; $i <5 ; $i++) { 
								echo '<i class="fa fa-star" style="color:#ffc000;"> </i>';
							}
							?>
							시설
							<? for ($i=0; $i <5 ; $i++) { 
								echo '<i class="fa fa-star" style="color:#ffc000;"> </i>';
							}
							?>  
							친절<? for ($i=0; $i <5 ; $i++) { 
								echo '<i class="fa fa-star" style="color:#ffc000;"> </i>';
							}
							?> 
							</td>
						</tr>
						
						<!-- <td class="tcenter"><?=number_format($v['ac_jin'])?></td>
							<td class="tcenter"><?=number_format($v['ac_obj'])?></td>
							<td style="text-align:center;"><?=number_format($v['ac_kind'])?></td> -->
						<?endforeach;?>
						<?else:?>
						<tr>
							<td colspan="2" style="text-align:center;  background: #f1f1f1; border:none;line-height: 20px; "><img src="/resource/images/mobile/alert-icon.png" alt="alert-icon" style="width:42px;margin-top:20px;margin-bottom: 10px;"><br/>작성된 후기가 없습니다.<br/> 신청한 이벤트에서 후기를 작성해주세요.</td>
						</tr>
						<?endif;?>
					</tbody>
				</table>


			</div>										
			<!--/.row-->
		</section>
		<!--end Listing Grid-->
		
</section>
<style>
#page-top{
	display:none;
}
td:last-child{
	text-align: left;
	padding:10px !important;
}
tr:first-child{
	height: 25px;
	margin-top:6px;
	padding:0px !important;
}
tbody{
	background:#fff;
	
}
.res{
	border-top: 6px solid #f1f1f1;
}

</style>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<!-- gallery list -->
<div class="gallery">
	<div class="image">
		<div class="owl-carousel gallery">
			<?foreach($images as $k => $v):?>
			<img src="<?=$v['url']?>" alt="<?=$agency['ai_name']?>" style="max-height:540px;">
			<?endforeach;?>
		</div>
	</div>
</div>		
<!-- END :: gallery list -->


<div class="card card-1">
	<h2><?=$agency['ai_name']?></h2>
	<h4><?=$agency['ai_addr']?></h4>

	<p style="text-align:center;">
		<?
			//출력할 아이콘 리스트
			$icon_list = array();
			if($map_url) {
				$icon_list[] = '<a href="'.$map_url.'" target="_blank"><img src="/resource/assets/img/i_road.png"></a>';
			}
			if($is_member) $icon_list[] = '<img src="/resource/assets/img/i_co.png">';
			if($has_event) $icon_list[] = '<a href="/index.php/medical/contents/event_hospital?hi_seq='.$is_member.'"><img src="/resource/assets/img/i_event.png"></a>';
			if($agency['ai_homepage']) $icon_list[] = '<a href="http://'.str_replace('http://', '', $agency['ai_homepage']).'" target="_blank" title="새창"><img src="/resource/assets/img/i_home.png"></a>';
			$icon_string = implode('<img src="/resource/assets/img/i_line.png">', $icon_list);
		?>
			<?=$icon_string?>
	</p>

</div>

<div class="tabbable-panel">
	<div class="tabbable-line" >
		<ul class="nav nav-tabs">
			<li style="float:left; width:250px;">
			&nbsp;
			</li>
			<li id="tab-1" class="active">
				<a href="#tab_default_1" data-toggle="tab"><font size=5>검진기관 기본정보 </font></a>
			</li>
			<li id="tab-2">
				<a href="#tab_default_2" data-toggle="tab" id="tab-reply"><font size=5>평점 및 후기 </font></a>
			</li>
		</ul>


		<!-- 기본정보 -->
		<div class="tab-content">
			
			<!-- 첫번째 판넬 -->
			<div class="tab-pane active" id="tab_default_1">
				<article class="block"  style="margin:10px 0px;">
					<header><h2><i class="fa fa-plus-square" style="color:#ec2020"></i>&nbsp; 검진 시간</h2></header>
					<dl class="lines"  style="margin:10px 30px 0px 30px;">
						<?if($agency['ap_jin_start']):?>
						<dt>월요일~금요일</dt>
						<dd>
							<?=$agency['ap_jin_start_time']?>시 <?=$agency['ap_jin_start_minuet']?>분 부터 <?=$agency['ap_jin_end_time']?>시 <?=$agency['ap_jin_end_minuet']?>분 까지
						</dd>
						<?endif;?>
						<?if($agency['ap_lun_start']):?>
						<dt>점심시간</dt>
						<dd>
							<?=$agency['ap_lun_start_time']?>시 <?=$agency['ap_lun_start_minuet']?>분 부터 <?=$agency['ap_lun_end_time']?>시 <?=$agency['ap_lun_end_minuet']?>분 까지
						</dd>
						<?endif;?>						

						<?if($agency['ap_sat_jin_start_time']):?>						
						<dt>토요일</dt>
						<dd>
							<?=$agency['ap_sat_jin_start_time']?>시 <?=$agency['ap_sat_jin_start_minuet']?>분 부터 <?=$agency['ap_sat_jin_end_time']?>시 <?=$agency['ap_sat_jin_end_minuet']?>분 까지
						</dd>
						<?endif;?>
					</dl>
				</article>

				<article class="block" style="margin:10px 0px">
					<header><h2><i class="fa fa-plus-square" style="color:#ec2020"></i>&nbsp; 검진항목</h2></header>
						<div  style="margin:10px 30px 0px 30px;">
							<?if($agency['ai_gren_cd']):?>
							<img src="/resource/images/medical/icons/icon_gen.png">
							<?endif;?>

							<?if($agency['ai_stmca_cd']):?>
							<img src="/resource/images/medical/icons/icon_we.png">
							<?endif;?>


							<?if($agency['ai_cc_cd']):?>
							<img src="/resource/images/medical/icons/icon_deajang.png">
							<?endif;?>


							<?if($agency['ai_lvca_cd']):?>
							<img src="/resource/images/medical/icons/icon_gan.png">
							<?endif;?>

							<?if($agency['ai_bc_cd']):?>
							<img src="/resource/images/medical/icons/icon_chest.png">
							<?endif;?>

							<?if($agency['ai_cvxca_cd']):?>
							<img src="/resource/images/medical/icons/icon_jagung.png">
							<?endif;?>


							<?if($agency['ai_mchk_cd']):?>
							<img src="/resource/images/medical/icons/icon_mouth.png">
							<?endif;?>					

						</div>
				</article>

				<article class="block"  style="margin:10px 0px">
						<header><h2><i class="fa fa-plus-square" style="color:#ec2020"></i>&nbsp; 교통 및 주차정보</h2></header>
						<dl class="lines" style="margin:10px 30px 0px 30px;">
							<dt>교통</dt>
							<?if($agency['at_inc_bus']):?>
							<dd>시내버스 : <?=$agency['at_inc_bus']?> / <?=$agency['at_inc_bus_goal']?> / <?=$agency['at_inc_bus_way']?>
							<?if(is_numeric($agency['at_inc_bus_dis'])):?> / <?=number_format($agency['at_inc_bus_dis'])?>미터<?endif;?>	   </dd>
							<?else:?>
							<dd>시내 버스 : 정보없음</dd>
							<?endif;?>

							<?if($agency['at_sbwy_route']):?>
							<dd> 지하철 : <?=$agency['at_sbwy_route']?> / <?=$agency['at_sbwy_goal']?> / <?=$agency['at_sbwy_way']?>
							<?if(is_numeric($agency['at_sbwy_dis'])):?> / <?=number_format($agency['at_sbwy_dis'])?>미터<?endif;?> </dd>
							<?else:?>
							<dd> 지하철 : 정보없음   </dd>
							<?endif;?>

							<dt>주차</dt>
							<?if($agency['ap_number']):?>
							<dd>
								가능대수 : 
								<?=$agency['ap_number']?>대, 
								<?if(is_numeric($agency['ap_pay_yn']) && $agency['ap_pay_yn'] == 0 ):?>
								무료
								<?elseif(is_numeric($agency['ap_pay_yn']) && $agency['ap_pay_yn'] == 1):?>
								유료
								<?endif;?>
								<?if($agency['ap_self_yn'] == 1):?>
								( 주차장 운영중 )
								<?endif;?>

								<?if($agency['ap_comment']):?>
								<br/>
								※ <?=$agency['ap_comment']?>
								<?endif?>
							</dd>
							<?else:?>
							<dd>
								정보 없음.
							</dd>
							<?endif;?>
						</dl>
				</article>

				<article class="block"  style="margin:10px 0px">
						<header><h2><i class="fa fa-plus-square" style="color:#ec2020"></i>&nbsp; 위치</h2></header>
				</article>
				<div id="map-simple-<?=$agency['ai_seq']?>" class="simple-map"></div>

				<hr style="margin-top:10px;" />
<!-- 				<section class="block" style="height:100px;"> -->
<!-- 					<div style="text-align:center;"> -->
<!-- 						<span style="font-weight:bold; font-size:17px; letter-spacing:-1px;">검진 예약 문의 : OK검진에서 보고 연락드린다고 하시면 많은 혜택이 기다립니다!</span> -->
<!-- 						<button class="button button-big2 happy"><i class="fa fa-phone"></i>050-443-2231</button> -->
<!-- 					</div>					 -->
<!-- 				</section> -->

			</div>
			<!-- END :: 첫번째 판넬 -->


			<!-- 두번째 판넬 -->
			<div class="tab-pane" id="tab_default_2">
				<!-- container4 -->
				<div class="container4">

					<!-- inner4 -->
					<div class="inner4">

						<!-- rating 4 -->
						<div class="rating4">
							<span class="rating-num"><?=$avg['total']?></span>

							<div class="rating-stars">
								<?for($i=0 ; $i < 5 ; $i++):?>
									<?if($avg['total'] >$i):?>
									<span><i class="active fa fa-star"></i></span>
									<?else:?>
									<span><i class="fa fa-star"></i></span>
									<?endif;?>
								<?endfor;?>	

								

							</div>
							<div class="rating-users">
								<i class="fa fa-user"></i> <?=number_format(count($comments))?>명이 참여하였습니다.
							</div>
						</div>
						<!-- END :: rating 4 -->
						
						<!-- histo -->
						<div class="histo">
							<div class="five histo-rate">
								<span class="histo-star">진료만족도<i class="active fa fa-star"></i> </span>
								<span class="bar-block">
									<span id="bar-five" class="bar4">
										<span><?=$avg['avg_jin']?></span>&nbsp;
									</span> 
								</span>
							</div>


							<div class="three histo-rate">
								<span class="histo-star">시설만족도<i class="active fa fa-star"></i>  </span>
								<span class="bar-block">
									<span id="bar-three" class="bar4">
										<span><?=$avg['avg_obj']?></span>&nbsp;
									</span> 
								</span>
							</div>



							<div class="one histo-rate">
								<span class="histo-star">친절만족도<i class="active fa fa-star"></i> </span>
								<span class="bar-block">
									<span id="bar-one" class="bar4">
										<span><?=$avg['avg_kind']?></span>&nbsp;
									</span> 
								</span>
							</div>
							
						</div>
						<!-- END :: histo -->						

					</div>
					<!-- END :: inner4 -->
					
				</div>	
				<!-- END :: container4 -->
				
				<!--- 후기 목록 작성 -->
				<section class="block" id="reviews">
					<header class="clearfix">
						<h2 class="pull-left">평점 및 후기</h2>
						<a href="#write-review" class="btn framed icon pull-right roll">후기 등록<i class="fa fa-pencil"></i></a>
					</header>

					<section class="reviews">
						<?if(isArray_($comments)):?>
						<?foreach($comments as $k => $v):?>
						<article class="review">
							<figure class="author">
								<img src="/resource/assets/img/default-avatar.png" alt="">
								<div class="date"><?=date('m.d.Y', $v['ac_ctime'])?></div>
							</figure>

							<!-- /.author-->
							<div class="wrapper">
								<h5><?=mb_substr($v['me_name'], 0, 1)?>**</h5>
								<?
									$avg = round(( intval($v['ac_jin'])+intval($v['ac_obj'])+intval($v['ac_kind']))/3, 0);
								?>
								<figure class="rating big color" data-rating="<?=$avg?>"></figure>
								<p style="width:840px;">
									<?=nl2br(strip_tags($v['ac_comment']));?>
								</p>
							</div>
							
						</article>
						<?endforeach;?>
						<?else:?>
						<article class="review">
						※ 등록된 후기가 없습니다. 첫 후기를 남겨주세요.
						</article>						
						<?endif;?>				
						
						
					</section>					
				</section>
				<!--- END 후기 목록 작성 -->

				<section id="write-review">
					<header>
						<h2>후기 등록</h2>
					</header>

					<?if($can_reply):?>
					<form id="form-review" role="form" method="post" action="/index.php/medical/contents/my_reply/replyOk" target="formReceiver" class="background-color-white">
						<input type="hidden" name="ac_aiseq" value="<?=$agency['ai_seq']?>" />
						<input type="hidden" name="ai_number" value="<?=$agency['ai_number']?>" />
						<div class="row">
							<div class="col-md-8">
								<!-- /.form-group -->
								<div class="form-group">
									<label for="form-review-message">내용</label>
									<textarea class="form-control" id="form-review-message" name="ac_comment"  rows="5" required=""></textarea>
								</div>
								<!-- /.form-group -->
								<div class="form-group">
									<button type="submit" class="btn btn-default">리뷰 등록하기</button>
								</div>
								<!-- /.form-group -->
							</div>


							<div class="col-md-4">
								<?if($can_star):?>
								<aside class="user-rating">
									<label>진료 만족도</label>
									<figure class="rating active" data-name="score1"></figure>
								</aside>
								<aside class="user-rating">
									<label>기관 친절도</label>
									<figure class="rating active" data-name="score2"></figure>
								</aside>
								<aside class="user-rating">
									<label>시설 만족도</label>
									<figure class="rating active" data-name="score3"></figure>
								</aside>
								<?endif;?>
							</div>
						</div>
					</form>
					<?else:?>
					<div class="row">
					※ 후기 등록은 로그인 후, 평점은 수검완료 후 등록 가능합니다.
					</div>
					<?endif;?>


				</section>			

			</div>
			<!-- END :: 두번째 판넬 -->			

		</div>
		<!-- END 기본정보 -->		
	</div>
</div>

<table id="service-btn-area">
	<?if($is_member):?>
	<colgroup>
		<col width="50%" />
		<col width="50%" />
	</colgroup>
	<tr>
		<td class="left-btn">
			<a href="/index.php/medical/contents/event_hospital?hi_seq=<?=$is_member?>">예약하기</a>
		</td>
		<td class="right-btn">
			<a href="#" class="cd-popup-trigger" data-popnum="<?=$agency['ai_seq']?>" onclick="_gaq.push(['_trackEvent','전화상담','상담하기']);">상담하기</a>
		</td>		
	</tr>
	<?else:?>
	<colgroup>
		<col width="100%" />
	</colgroup>
	<tr>
		<td class="right-btn">
			<a href="#" class="cd-popup-trigger" data-popnum="<?=$agency['ai_seq']?>" onclick="_gaq.push(['_trackEvent','전화상담','상담하기']);">상담하기</a>
		</td>
	</tr>
	<?endif;?>
</table>

<div class="cd-popup popnum<?=$agency['ai_seq']?>" role="alert" >
	<div class="cd-popup-container">
		<p class="popup-title">전화를 주시면 담당자가 친절히 상담해드립니다.</p>

		<span class="phone-number">
		<?if($phone_number):?>
			<i class="fa fa-phone fa-2x" style="color:#00cc6a; display:inline-block; margin-left:0; font-size:28px;"></i>
			<?=$phone_number?>
		<?else:?>
			등록된 전화번호가 없습니다.
		<?endif;?>
		</span>


		<a href="#0" class="cd-popup-close img-replace">Close</a>
	</div>
</div>


<script type="text/javascript" src="/resource/js/popup_require_jq.js"></script>

<script type="text/javascript">
<?if($agency['ai_x'] != 'nodata' && $agency['ai_y'] != 'nodata'):?>
createSimpleMap(<?=$agency['ai_x']?>, <?=$agency['ai_y']?>, "map-simple-<?=$agency['ai_seq']?>");
<?else:?>

<?endif;?>
</script>

<style type="text/css">
.simple-map{width:95%; margin:0 auto; height:400px; border:1px solid #e3e3e3;}
#service-btn-area{height:60px; position:fixed; bottom:0; left:50%; width:960px; z-index:19; background-color:#fff; border:none; margin: 0 0 0 -489px ;}
#service-btn-area *{vertical-align:middle;}
#service-btn-area .left-btn{height:100%; background-color:#f3564c; font-size:20px; color:#fff; font-weight:bold; text-align:center;}
#service-btn-area .left-btn a{color:#fff; display:inline-block; width:100%; line-height:40px;}
#service-btn-area .right-btn{height:100%; background-color:#3da6ff; font-size:20px; color:#fff; font-weight:bold; text-align:center;}
#service-btn-area .right-btn a{color:#fff;display:inline-block;  width:100%; line-height:40px;}


.cd-popup{z-index:900;}
.cd-popup-container{padding:40px 15px;}
.cd-popup-container .popup-title{font-size:16px; padding:20px 10px;}
.phone-number{font-size:30px; font-weight:bold; color:#dd3c3c}
</style>

<script>
fbq('track', 'ViewContent', {content_type : 'hospital infomation',  content_category:'pc : content'});

fbq('track', 'Lead', {
	content_type: 'hospital infomation',
	content_name: "<?=$agency['ai_name']?>",
	content_ids: ["<?=$agency['ai_seq']?>"], 
	content_category: 'pc : hospital info',
});
	
</script>	

</body>
</html>
<!-- section container -->
<section class="container">
	<!-- container bacground -->
	<div class="block2 bg-white" style="border:1px solid #cdcdcd;">
		
		<!-- row area -->
		<div class="row">
			<ul class="tablist" role="tablist">
				<li class="tab" role="tab">
					<a href="#panel1"><b>예약 현황</b></a>
				</li>
				<li class="tab" role="tab">
					<a href="#panel2"><b>최근 본 상품</b></a>
				</li>
				<li class="tab" role="tab">
					<a href="#panel3"><b>찜한 이벤트</b></a>
				</li>
				<li class="tab" role="tab">
					<a href="#panel4"><b>작성후기</b></a>
				</li>
				<li class="tab" role="tab">
					<a href="#panel5"><b>개인정보 변경</b></a>
				</li>
			</ul>			
		</div>		
		<!-- END:: row area -->


		<div class="tabpanel" id="panel1" role="tabpanel">
			<h1>예약현황</h1>


			<!--Content-->
			<div id="lastest-view">
				<!--Listing Grid-->
				<section class="block">
					<p class="row">
						<table class="table table-list" summary="예약목록" >
							<caption class="hide">예약목록</caption>
							<thead>
								<tr>
									<th>NO</th>
									<th>검진기관</th>
									<th>예약방법</th>
									<th>예약신청일</th>									
									<th>현재상태</th>
								</tr>
							</thead>
							<tbody>
								<?if(isArray_($reserve_list)):?>
								<?foreach($reserve_list as $k => $v):?>
								<tr>
									<td ><?=$paging->getPageNum($k);?></td>
									<td>
										<?=$v['ai_name']?>
									</td>
									<td>
										<?=$_method[$v['er_method']]['name']?>
									</td>
									<td>
										<?=date('Y.m.d', $v['er_ctime']);?>
									</td>
									<td style="text-align:center;">
										<?=$_status[$v['er_status']]['name']?>
									</td>
								</tr>
								<?endforeach;?>
								<?else:?>
								<tr>
									<td colspan="5" style="text-align:center;"> ※ 등록된 예약이 없습니다.</td>
								</tr>
								<?endif;?>
							</tbody>
						</table>						
					</p>
				<section>
				
			</div>
		</div>

		<div class="tabpanel" id="panel2" role="tabpanel">
			<h1>최근 본 상품</h1>

			<!--Content-->
			<div id="lastest-view">
				<!--Listing Grid-->
				<section class="block">
					<div class="row">

						<?if(is_array($list) && count($list) > 0):?>
						<?foreach($list as $k => $v):?>			
						<div class="col-md-6 col-sm-6">
							<div class="item">
								<div class="image">						
									<div class="overlay">
										<div class="inner">
										</div>
									</div>

									<a href="/index.php/medical/contents/event_hospital/viewEvent?seq=<?=$v['ei_seq']?>">
										<?if($v['banner']):?>
										<img src="<?=$v['banner']?>" alt="<?=$v['ei_name']?>" style="width:555px; height:242px;" >
										<?endif;?>
									</a>	
								</div>

								<div class="wrapper" style="position:relative;">

									<a href="/index.php/medical/contents/event_hospital/viewEvent?seq=<?=$v['ei_seq']?>"><h3><?=$v['ei_name']?></h3></a>


									<a href="<?=$contents_url?>/my_check?seq=<?=$v['ei_seq']?>" style="position:absolute; top:20px; right:20px; display:block; width:35px; height:35px;" target="formReceiver" id="eiseq_<?=$v['ei_seq']?>">
										<?if(in_array($v['ei_seq'], $like_list)):?>
										<i class="fa fa-heart fa-2x" style="color:red; "></i>
										<?else:?>
										<i class="fa fa-heart-o fa-2x" style="color:red; "></i>
										<?endif;?>
									</a>


									<div class="price">
										<?=number_format($v['ei_account'])?> 원
									</div>	

									<font size=2 color=#818181>(~<?=date('Y년 m월 d일', $v['ei_end']) ?>까지)</font>

									<figure>
										<font size=2 color=black><b><?=$v['hi_open_name']?>&nbsp;&nbsp;</b></font><i class="fa fa-map-marker" style="color:red"></i><?=$v['ai_addr']?>
									</figure>

								</div>
							</div>
							<!-- /.item-->
						</div>
						<?endforeach;?>
						<?endif;?>


					</div>					
				</section>
			</div>		
			

		</div>

		<div class="tabpanel" id="panel3" role="tabpanel">
			<h1>찜한 이벤트</h1>

			<!--Content-->
			<div id="lastest-view">
				<!--Listing Grid-->
				<section class="block">
					<div class="row">

						<?if(is_array($checked_list) && count($checked_list) > 0):?>
						<?foreach($checked_list as $k => $v):?>			
						<div class="col-md-6 col-sm-6">
							<div class="item">
								<div class="image">						
									<div class="overlay">
										<div class="inner">
										</div>
									</div>

									<a href="/index.php/medical/contents/event_hospital/viewEvent?seq=<?=$v['ei_seq']?>">
										<?if($v['banner']):?>
										<img src="<?=$v['banner']?>" alt="<?=$v['ei_name']?>" style="width:555px; height:242px;" >
										<?endif;?>
									</a>	
								</div>

								<div class="wrapper" style="position:relative;">

									<a href="/index.php/medical/contents/event_hospital/viewEvent?seq=<?=$v['ei_seq']?>"><h3><?=$v['ei_name']?></h3></a>


									<a href="<?=$contents_url?>/my_check/cancel?seq=<?=$v['ei_seq']?>" style="position:absolute; top:20px; right:20px; display:block; width:35px; height:35px;" target="formReceiver" id="eiseq_<?=$v['ei_seq']?>">
										<?if(in_array($v['ei_seq'], $like_list)):?>
										<i class="fa fa-heart fa-2x" style="color:red; "></i>
										<?else:?>
										<i class="fa fa-heart-o fa-2x" style="color:red; "></i>
										<?endif;?>
									</a>


									<div class="price">
										<?=number_format($v['ei_account'])?> 원
									</div>	

									<font size=2 color=#818181>(~<?=date('Y년 m월 d일', $v['ei_end']) ?>까지)</font>

									<figure>
										<font size=2 color=black><b><?=$v['hi_open_name']?>&nbsp;&nbsp;</b></font><i class="fa fa-map-marker" style="color:red"></i><?=$v['ai_addr']?>
									</figure>

								</div>
							</div>
							<!-- /.item-->
						</div>
						<?endforeach;?>
						<?endif;?>


					</div>						


				</section>
			</div>
		</div>

		<div class="tabpanel" id="panel4" role="tabpanel">
			<h1>작성후기</h1>
			<table class="table table-list" summary="내가 등록한 후기 보기">
				<caption>후기 목록</caption>
				<thead>
					<tr>						
						<th>기관</th>
						<th>후기 내용</th>
						<th>진료만족도</th>
						<th>시설만족도</th>
						<th>친절만족도</th>
						<th>등록일</th>
					</tr>
				</thead>
				<tbody>
					<?if(isArray_($reply_list)):?>
					<?foreach($reply_list as $k => $v):?>
					<tr>						
						<td><?=$v['ai_name']?></td>
						<td><?=strip_tags($v['ac_comment'])?></td>
						<td class="tcenter">
							<?=number_format($v['ac_jin'])?>
						</td>
						<td class="tcenter">
							<?=number_format($v['ac_kind'])?>
						</td>
						<td class="tcenter">
							<?=number_format($v['ac_obj'])?>
						</td>
						<td>
							<?=date('Y.m.d', $v['ac_ctime'])?>
						</td>
					</tr>
					<?endforeach;?>
					<?else:?>
					<tr>
						<td colspan="6">※ 등록된 후기 내용이 없습니다.</td>
					</tr>
					<?endif;?>
				</tbody>
			</table>
		</div>

		<div class="tabpanel" id="panel5" role="tabpanel">
			<div class="row">
				<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
					<header>
						<h1 class="page-title">개인정보변경</h1>
					</header>
					
					<?if($_Auth->isLogin()):?>
					<form role="form" id="form-sign-in-account" method="post" action="<?=$menu_url?>/changeOk" target="formReceiver">
						
						<input type="hidden" name="me_seq" value="<?=$member['me_seq']?>" />

						
						<div class="form-group">
							<input type="text" class="form-control" id="form-sign-in-password" name="me_name" placeholder="이름을 입력하세요." value="<?=$member['me_name']?>" required="required">
						</div><!-- /.form-group -->

						<div class="form-group">
							<input type="text" class="form-control" id="form-sign-in-email" name="md_phone" placeholder="휴대폰번호를 입력하세요.(-없이 입력)" value="<?=$detail['md_phone']?>" required="required">
						</div><!-- /.form-group -->

						<div class="form-group">							
							<div style="width:24%; float:left;">
								<select name="year" title="생년 입력">
									<option value="">생년</option>
									<?$years = range(date('Y'), 1900)?>
									<?foreach($years as $v):?>
									<option value="<?=$v?>" <?if($detail['year'] == $v):?>selected="selected"<?endif;?>><?=$v?>년</option>
									<?endforeach;?>
								</select>
							</div>

							<div style="width:24%; float:left;">
								<select name="month" title="월 입력">
								<option value="">월</option>
								<?$months = range(1, 12);?>
								<?foreach($months as $v):?>
								<option value="<?=$v?>" <?if($detail['month'] == $v):?>selected="selected"<?endif;?>><?=$v?>월</option>
								<?endforeach;?>
								</select>
							</div>
							
							<div style="width:24%; float:left;">
								<select name="day" title="일 입력">
								<option value="">일</option>
								<?$days = range(1, 31);?>
								<?foreach($days as $v):?>
								<option value="<?=$v?>" <?if($detail['day'] == $v):?>selected="selected"<?endif;?>><?=$v?>일</option>
								<?endforeach;?>
								</select>
							</div>


						</div><!-- /.form-group -->

						 <div class="form-group">
							<select class="framed" name="md_gender">
								<option value="">성별선택</option>
								<option value="MAN" <?if($detail['md_gender'] == 'MAN'):?>selected="selected"<?endif;?>>
								남성
								</option>
								<option value="WOMAN" <?if($detail['md_gender'] == 'WOMAN'):?>selected="selected"<?endif;?>>
								여성
								</option>
							</select>
						</div>

						<div class="form-group" style="color:red;">
							※ 비밀번호 변경시에만 입력해주세요.
						</div>
				
						<div class="form-group">
							<input type="password" class="form-control" id="form-sign-in-password" name="me_pass" placeholder="비밀번호를 입력하세요.">
						</div><!-- /.form-group -->

						 <div class="form-group">
							<input type="password" class="form-control" id="form-sign-in-email" name="pass_chk" placeholder="비밀번호 재입력.">
						</div><!-- /.form-group -->					



						 <div class="form-group">
							<button type="submit"  style="width: 100%;" class="btn framed icon">회원정보 변경<i class="fa fa-angle-right" style="color:#e8a5a5"></i></button>
						 </div>
						 <div>
							<p align=center><a href="#" title="새창" onclick=" window.open('/index.php/medical/contents/etc_joinout', 'join_out_form', 'width=810, height=700'); "><font color=blue>회원탈퇴</font><a>
						 </div>

					</form>	
					<?endif;?>
				</div>
			</div>			
		</div>
	
	</div>	
	<!-- END ::  container bacground -->
</section>
<!--END ::  section container -->

<script type="text/javascript">
(function() {
	var hash = window.location.hash;

	function activateTab() {

		if(activeTab) {
			resetTab.call(activeTab);
		}

		
		this.parentNode.className = 'tab tab-active';
		activeTab = this;
		activePanel = document.getElementById(activeTab.getAttribute('href').substring(1));
		activePanel.className = 'tabpanel show';
		activePanel.setAttribute('aria-expanded', true);
	}

	function main_activeTab(){

		if(activeTab) {
			resetTab.call(activeTab);
		}

		main_activeTab = this;
		var href = main_activeTab.getAttribute('href');
		var split_values = href.split('#');

		var tab_link = "li.tab a[href='#"+split_values[1]+"']";
		$(tab_link).parent().attr('class', 'tab tab-active');
		activeTab = $(tab_link).get(0);

		activePanel =  document.getElementById(split_values[1]);
		activePanel.className = 'tabpanel show';
		activePanel.setAttribute('aria-expanded', true);
	}

	function resetTab() {
		activeTab.parentNode.className = 'tab';
		if(activePanel) {
			activePanel.className = 'tabpanel hide';
			activePanel.setAttribute('aria-expanded', false);
		}
	}	


	var doc = document,
	tabs = doc.querySelectorAll('.tab a'),
	panels = doc.querySelectorAll('.tabpanel'),
	activeTab = tabs[0],
	activePanel;	

	for(var i = tabs.length - 1; i >= 0; i--) {
		tabs[i].addEventListener('click', activateTab, false);		
		if(hash && hash != '' && tabs[i].hash == hash) activeTab = tabs[i];
	}

	var main_tabs = doc.querySelectorAll('#my-menu-list a');
	for(var i = main_tabs.length - 1; i >= 0; i--) {
		main_tabs[i].addEventListener('click', main_activeTab, false);				
	}

	activateTab.call(activeTab);	
		
})();



$(document).ready(function(){
	$('li.tab').on('click', function(e){
	e.preventDefault();
	});

	$('#my-menu-list a').on('click', function(e){
		if($(this).attr('target') != 'formReceiver'){
			e.preventDefault();
		}
	});

});

$(window).ready(function(){
	var offset = $("#page-top").offset();
	$('html, body').animate({scrollTop : offset.top}, 1);

});



</script>
<section class="container" id="qna">
	<div class="row">
		<!--Content-->
		<div class="col-md-1"></div>

		<div class="col-md-10 bg-white" style="border:1px solid #cdcdcd;">

			<section>
				<div class="row">
					<img src="/resource/images/mobile/question_main.png">

					<div class="tabbable-panel">
						<div class="tabbable-line" >

							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab_default_1" data-toggle="tab"><font size=5>자주하시는 질문 </font></a>
								</li>
								<li>
									<a href="#tab_default_2" <?if($_Auth->isLogin()):?>data-toggle="tab"<?else:?>onclick="alert('1:1온라인 상담은 로그인 회원만 이용하실 수 있습니다.'); return false;"<?endif;?> ><font size=5>1:1 온라인 상담 </font></a>
								</li>
							</ul>

							<div class="tab-content">
								<div class="tab-pane active" id="tab_default_1">
									<article class="block"  style="margin:10px 0px;">

										<div class="faq-c">
											<div class="faq-q">
												<span class="faq-t">+</span>건강검진 받기 전 주의사항은 어떤게 있나요?
											</div>

											<div class="faq-a">
												<p>
													▷ 건강검진 전날 음주는 피해야 합니다.<br>
													▷ 검진 전날 저녁식사는 오후6~7시경에 하고 건강검진을 받을때 까지 아무것도 섭취하지 말아야 합니다.<br>
													▷ 당뇨병,고협압,심장병 환자는 검사원에 병을 알려 적절한 지도를 받는 것이 좋습니다.<br>
													▷ 협압, 심전도검사는 심리상태와 관계가 있으므로 편안한 상태를 유지해야 합니다.<br>
													▷ 건강검진 전 문진기록은 진단에 중요한 자료가 되므로 명확하고 간략하게 써야 합니다.<br>
													▷ 수면내시경 검사를 받는 경우는 자가운전은 삼가하도록 합니다.<br>
													▷ 여성 검진자 중 임신가능성이 있는 분은 임신여부 확인 후 검사를 받아야 하며(방사선검사 불가능)<br>
													▷ 생리기간에는 검진을 삼가하여 주시고 생리가 끝난 1주일 후 검진을 받는 것이 좋습니다.(자궁암검사)<br>
													<font color="red">※검사를 받으시는 항목에 따라 상이 하오니 예약 후 검진기관의 주의사항을 확인해보세요.</font>
												</p>
											</div>
										</div>

										<div class="faq-c">
											<div class="faq-q">
												<span class="faq-t">+</span>건강검진 소요시간은 얼마나 걸리나요
											</div>
											<div class="faq-a">
												<p>▷ 검진기관, 검진 프로그램에 따라 상이하나 평균적으로 1~4시간 정도 소요 됩니다. <br>정밀검진일 수록 시간소요가 많습니다.</p>
											</div>
										</div>

										<div class="faq-c">
											<div class="faq-q">
												<span class="faq-t">+</span>검진결과는 얼마나 걸리나요?
											</div>
											<div class="faq-a">
												<p>▷ 검진기관별 결과 처리는 상이 하나 일반적으로 2주가량 소요 됩니다. <br>자세한 사항은 검진받으신 검진기관에 문의 하여 보세요</p>
											</div>
										</div>

										<div class="faq-c">
											<div class="faq-q">
												<span class="faq-t">+</span>검진 비용은 어떻게 결제 하나요?
											</div>
											<div class="faq-a">
												<p>▷ 예약하신 검진기관에서 현장 결제 하시면 됩니다.</p>
											</div>
										</div>




										<div class="faq-c">

											<div class="faq-q">
												<span class="faq-t">+</span>건강항목에 따른 검진 주기는 어떻게 되나요?
											</div>
											<div class="faq-a">
												<p>
													▷ 대장암:대장내시경 검진 후 이상없을 경우(4~5년), 분변잠혈(1~2년)<br>
													▷ 간암: B형,C형 간염 바이러스보유자(6개월)<br>
													▷ 유방암:2년<br>
													▷ 자궁암:2~3년<br>
													▷ 폐암:30년 이상 흡연력이 있는 경우(1년)<br>
													<font color="red">※검진결과 이상이 발견되었거나, 가족력이 있는 경우는 검진주기가 다를 수 있습니다.</font>
												</p>
											</div>
										</div>
									</article>
								</div><!-- /.첫번째 탭 끝 -->


								<div class="tab-pane" id="tab_default_2">
									<?if($_Auth->isLogin()):?>
									
									<?if(is_array($list) && count($list) > 0):?>

									<section class="faq-form">
										<figure class="clearfix">
											<i class="fa fa-question"></i>

											<div class="wrapper">
												<div class="pull-left">
													<strong>궁금함이 풀리지 않으셨나요?</strong>
													<h3>온라인 QA를 이용하여 자세한 답변을 받아 보세요.</h3>
												</div>
												<a href="#form-faq" id="faq-btn" class="btn btn-default pull-right" data-toggle="collapse" aria-expanded="false" aria-controls="form-faq">온라인 1:1 상담하기</a>
											</div>
										</figure>


										<?if($detail):?>
										<div class="row articles" style="padding-top:50px;">
											<div class="col-md-1 col-sm-1"></div>

											<div class="col-md-10 col-sm-10 bg-white" style="border:1px solid #cdcdcd;">
												<section class="block" id="main-content">
													<div class="col-md-12 col-sm-12">

														<section>
															<!-- /.block -->
															<article class="block3">
																<header>
																	<h1><?=$detail['uq_subject']?></h1>
																	<font color="gray" size="4px"><?=date('Y. m. d.', $detail['uq_ctime'])?></font>
																</header>
																<hr>
															</article>
				
															<article class="block3">
																<font size="4px">
																	<?=nl2br($detail['uq_question'])?>
																</font>
															</article>
															<!-- /.block -->
														</section>

														<?if($detail['uq_answer']):?>
														<section>
														<!-- /.block -->

															<article class="block3" style="background-color: #e5dede; margin-bottom:50px; ">
																<font size="4px">
																	<?=nl2br($detail['uq_answer'])?></font>
															</article>
														<!-- /.block -->
														</section>
														<?endif;?>
													</div>
													<!-- /.col-md-12-->
												</section>
												<!-- /#main-content-->
											</div><!-- /.col-md-8-->
											<div class="col-md-1 col-sm-1"></div>
										</div>
										<?else:?>
										<table style="width:940px;" class="articles">
											<thead>
												<tr>
													<th colspan="3"><font size="5">OK건강검진 온라인 1:1 상담</font></th>
												</tr>
												<tr>
													<th>제목</th>
													<th>작성일</th>
													<th>&nbsp;</th>
												</tr>
											</thead>
											<tbody style="background-color: #fff;">
												<?foreach($list as $k => $v):?>
												<tr>
													<td>
														<a href="<?=$menu_url?>/<?=$act?>?seq=<?=$v['uq_seq']?>#questionOk"><?=$v['uq_subject']?></a>
													</td>
													<td><?=date('Y. m. d', $v['uq_ctime'])?></td>
													<td>
														<?if($v['uq_answer']):?>
														<img src="/resource/assets/img/blt_ans.gif">
														<?else:?>
														&nbsp;
														<?endif;?>
													</td>
												</tr>
												<?endforeach;?>
											</tbody>
										</table>	
										<?endif;?>
										


										<div class="collapse" id="form-faq">
											<div class="">
												<form role="form" action="<?=$menu_url?>/questionOk" method="post" target="formReceiver">

													<div class="form-group">
														<label for="faq-form-subject">제목</label>
														<input type="text" name="uq_subject" class="form-control" id="faq-form-subject" required="">
													</div>													
													<!-- /.form-group -->

													<div class="form-group">
														<label for="faq-form-question">문의 사항</label>
														<textarea class="form-control" id="faq-form-question" name="uq_question"  rows="3" required=""></textarea>
													</div>
													<!-- /.form-group -->

													<div class="form-group">
														<button type="submit" class="btn btn-default">질문 남기기</button>
													</div>
													<!-- /.form-group -->
												</form>
											<!-- /form-->
											</div>
										</div>
									</section>											

									<?else:?>
									<section class="faq-form">
										<figure class="clearfix">
											<i class="fa fa-question"></i>

											<div class="wrapper">
												<div class="pull-left">
													<strong>궁금함이 풀리지 않으셨나요?</strong>
													<h3>온라인 QA를 이용하여 자세한 답변을 받아 보세요.</h3>
												</div>
<!-- 												<a href="#form-faq" class="btn btn-default pull-right" data-toggle="collapse" aria-expanded="false" aria-controls="form-faq">온라인 1:1 상담하기</a> -->
											</div>
										</figure>

										
										<div class="collapse" id="form-faq" style="display:block;">
											<div class="">
												<form role="form" action="<?=$menu_url?>/questionOk" method="post" target="formReceiver">

													<div class="form-group">
														<label for="faq-form-subject">제목</label>
														<input type="text" name="uq_subject" class="form-control" id="faq-form-subject" required="">
													</div>													
													<!-- /.form-group -->

													<div class="form-group">
														<label for="faq-form-question">문의 사항</label>
														<textarea class="form-control" id="faq-form-question" name="uq_question"  rows="3" required=""></textarea>
													</div>
													<!-- /.form-group -->

													<div class="form-group">
														<button type="submit" class="btn btn-default">질문 남기기</button>
													</div>
													<!-- /.form-group -->
												</form>
											<!-- /form-->
											</div>
										</div>
									</section>
									<?endif;?>
									<?endif;?>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
	<!-- /.content-->
	</div>
<!-- /#form-faq-->
</section>






<div style="clear:both;">&nbsp;</div>
<script>
	$(document).ready(function(){
		console.log(window.location.hash);

		if(window.location.hash == '#questionOk' ) {
			$('.nav-tabs a[href="#tab_default_2"]').tab('show');
		}



		$('#faq-btn').on('click', function(){
			if($('.articles').css('display') == 'none'){
				$('.articles').show();
			}else{
				$('.articles').hide();
			}
		});
	});


 $(".faq-q").click( function () {
  var container = $(this).parents(".faq-c");
  var answer = container.find(".faq-a");
  var trigger = container.find(".faq-t");
  
  answer.slideToggle(200);
  
  if (trigger.hasClass("faq-o")) {
    trigger.removeClass("faq-o");
  }
  else {
    trigger.addClass("faq-o");
  }
});
</script>
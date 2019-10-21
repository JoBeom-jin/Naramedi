<style type="text/css">
	#complete-stay-list{}
	#complete-stay-list .left-dash-board{width:45%; float:left;}
	#complete-stay-list .right-dash-board{width:45%; float:right;}
	#complete-stay-list .dash-board .blue{
		background-color:#3598dc;
	}
	#complete-stay-list .dash-board .red{
		background-color:#e7505a;
	}

	#complete-stay-list .stat{
		margin:15px;
		overflow:hidden;
		width:200px;
		height:80px;
		padding:20px;
		float:right;
	}

	#complete-stay-list .detail{text-align:left; padding-top:15px; }
	#complete-stay-list .detail *{color:white; font-weight:bold; font-size:26px;}
	#complete-stay-list .detail .normal{font-size:15px;}

	#complete-stay-list .reserve-list{clear:both;}
	#complete-stay-list .reserve-list{border-top:3px solid #e3e3e3;}
	#complete-stay-list .reserve-list .list-item{padding:20px; margin:15px; border-bottom:1px dashed black; position:relative; background-color:#fff; border:1px solid #e3e3e3;}
	#complete-stay-list .reserve-list .list-item div{padding:5px 0;}
	#complete-stay-list .reserve-list .list-item .reserve-date{font-weight:bold; color:black;}
	#complete-stay-list .reserve-list .list-item .name{font-weight:bold; font-size:16px;}
	#complete-stay-list .reserve-list .list-item .ei-name{font-size:15px; letter-spacing:-1px;}
	#complete-stay-list .reserve-list .list-item .ei-type *{font-weight:bold; font-size:16px; vertical-align:middle;}
	#complete-stay-list .reserve-list .list-item .account{color:#7777ff;}
	#complete-stay-list .reserve-list .list-item .status{position:absolute; right:10px; top:20px; border:1px solid #e3e3e3; width:100px; padding:3px; text-align:center; 
	font-weight:bold;}
	#complete-stay-list .reserve-list .list-item .ei-memo{border:1px solid #e3e3e3; padding:15px 10px; width:100%;}
	#complete-stay-list .reserve-list .list-item .ei-memo .tdanger{font-weight:bold; color:#ff0000;}


			

</style>

<div id="complete-stay-list">
	<h2 class="title">대기자 현황</h2>

	<h3 class="title">전화 대기자 현황.</h3>

	<div class="dash-board left-dash-board">		

		<div class="stat blue">
			<div class="detail">
				<div class="number"><?=number_format(count($wait_list))?> <span class="normal">명의 예약자가 </span></div>
				<div class="normal">처리 대기중입니다.</div>
			</div>			
		</div>

		<div class="reserve-list">
			<?if(isArray_($wait_list)):?>
			<?foreach($wait_list as $k => $v):?>
			<div class="list-item">
				<div class="date"><?=date('Y.m.d H:i', $v['er_ctime'])?></div>
				<div class="name">
					<?if($v['er_name']):?>
					<?=$v['er_name']?>
					<?else:?>
					<span class="talert strong">무명</span>
					<?endif;?>
					<?=$v['er_phone']?>
					<?if(array_key_exists('er_time', $v)):?>
					<span class="btn btn-default"><?=$_times[$v['er_time']]['sub_name']?></span>
					<?endif;?>
				</div>
				<div class="ei-name">
					<?if($v['ei_name']):?>
					<?=$v['ei_name']?>
					<?else:?>
					<span class="talert strong">이벤트 선택안됨</span>
					<?endif;?>
				</div>
				<div class="ei-type">
					<span>
						<?
							if($v['er_mall_name']) $name = $v['er_mall_name'];
							else $name = $_malls[$v['er_mall']]['name'];
						?>
						<input type="button" value="<?=$name?>" class="btn btn-<?=$_malls[$v['er_mall']]['color']?>"/>
					</span> 
					<span class="account">&#8361;<?=number_format($v['er_account'])?></span>
				</div>
				<div class="ei-memo">
					<?if($v['er_memo']):?>
					<?=nl2br($v['er_memo'])?>
					<?else:?>
					<span class="tdanger">※ 남겨진 메모가 없습니다.</span>
					<?endif;?>
				</div>

				<div class="status" style="background-color:<?=$_status[$v['er_status']]['bg_color']?>;">
					<a href="<?=$menu_url?>/modify?seq=<?=$v['er_seq']?>" onclick="window.open(this.href, 'reserveForm', 'width=400, height=300'); return false;">
						<span><?=$_status[$v['er_status']]['name']?></span>
					</a>
				</div>
			
			</div>
			<?endforeach;?>
			<?endif;?>
			
		</div>



	</div>


	<div class="dash-board right-dash-board">		

		<div class="stat red">
			<div class="detail">
				<div class="number"><?=number_format(count($reserve_list))?> <span class="normal">명의 예약자 확정자가</span></div>
				<div class="normal">처리 대기중입니다.</div>
			</div>			
		</div>

		<div class="reserve-list">
			<?if(isArray_($reserve_list)):?>
			<?foreach($reserve_list as $k => $v):?>
			<div class="list-item">
				<div class="reserve-date">
					검진예약일 : <?=date('Y.m.d', $v['er_reserve_time'])?>
				</div>
				<div class="name">
					<?if($v['er_name']):?>
					<?=$v['er_name']?>
					<?else:?>
					<span class="talert strong">무명</span>
					<?endif;?>
					 <?=$v['er_phone']?>
				</div>
				<div class="ei-name">
					<?if($v['ei_name']):?>
					<?=$v['ei_name']?>
					<?else:?>
					<span class="talert strong">이벤트 선택안됨</span>
					<?endif;?>
				</div>
				<div class="ei-type">
					<span>
						<input type="button" value="<?=$_malls[$v['er_mall']]['name']?>" class="btn btn-<?=$_malls[$v['er_mall']]['color']?>"/>
					</span> <span class="account">&#8361;<?=number_format($v['er_account'])?></span>
				</div>

				<div class="ei-memo">
					<?if($v['er_memo']):?>
					<?=nl2br($v['er_memo'])?>
					<?else:?>
					<span class="tdanger">※ 남겨진 메모가 없습니다.</span>
					<?endif;?>
				</div>

				<?$over_time = false; if($_ctime > $v['er_reserve_time']){$over_time = true;}?>

				<?if($over_time):?>
				<div class="status" 
				style="background-color:red; font-weight:bold;">
					<a href="<?=$menu_url?>/modifyReserve?seq=<?=$v['er_seq']?>" onclick="window.open(this.href, 'reserveForm', 'width=400, height=300'); return false;">
						<span style="color:white; font-weight:bold;">처리시급</span>
					</a>
				</div>
				<?else:?>
				<div class="status" 
				style="background-color:<?=$_status[$v['er_status']]['bg_color']?>;">
					<a href="<?=$menu_url?>/modifyReserve?seq=<?=$v['er_seq']?>" onclick="window.open(this.href, 'reserveForm', 'width=400, height=300'); return false;">
						<span><?=$_status[$v['er_status']]['name']?></span>
					</a>
				</div>
				<?endif;?>

			</div>
			<?endforeach;?>
			<?endif;?>
			
		</div>



	</div>


	
</div>

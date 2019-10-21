<div id="reserve-list">
	<div class="btn-area-left">
		<a href="<?=$menu_url?>/<?=$act?>" class="btn btn-default">미처리 현황</a>
		<a href="<?=$menu_url?>/<?=$act?>?act=resultList" class="btn btn-primary">누적 현황</a>
	</div>


	<div class="reserved-list">
		<div class="btn-area-left">
			<form method="get" action="<?=$menu_url?>/<?=$act?>">
				<input type="hidden" name="act" value="<?=$bact?>">

				<table class="table table-form" summary="검색 폼">
					<caption>검색 폼</caption>
					<tbody>
						<tr>
							<td class="select-options">
								<select name="sch_mall" title="몰타입선택">
									<option value="">전체몰</option>
									<?foreach($_malls as $k => $v):?>
									<option value="<?=$k?>" <?if($k == $sch_mall):?>selected="selected"<?endif;?>><?=$v['name']?></option>
									<?endforeach;?>
								</select>

								<select name="sch_method" title="예약방식 선택">
									<option value="">예약방식 전체</option>
									<?foreach($_method as $k => $v):?>
									<option value="<?=$k?>" <?if($k == $sch_method):?>selected="selected"<?endif;?>><?=$v['name']?></option>
									<?endforeach;?>
								</select>

								<select name="sch_type" title="전체 구분 선택">
									<option value="">전체구분</option>				
									<option value="wait" <?if($sch_type == 'wait'):?>selected="selected"<?endif;?>>대기</option>				
									<option value="reserve" <?if($sch_type == 'reserve'):?>selected="selected"<?endif;?>>예약</option>
								</select>

								<select name="sch_status" title="상태 선택">
									<option value="">전체상태</option>
									<?foreach($_status as $k => $v):?>
									<option value="<?=$k?>" <?if($sch_status == $k):?>selected="selected"<?endif;?>><?=$v['name']?></option>
									<?endforeach;?>
								</select>

								<select name="sch_op" title="검색 옵션">
									<option value="er_name" <?if($sch_op == 'er_name'):?>selected="selected"<?endif;?> >신청자명</option>

									<option value="er_meid" <?if($sch_op == 'er_meid'):?>selected="selected"<?endif;?> >회원ID</option>

									<option value="ai_name" <?if($sch_op == 'ai_name'):?>selected="selected"<?endif;?>>검진기관명</option>
									<option value="ai_number" <?if($sch_op == 'ai_number'):?>selected="selected"<?endif;?>>검진기관번호</option>
<!-- 									<option value="cm_name" <?if($sch_op == 'cm_name'):?>selected="selected"<?endif;?>>폐쇄몰명</option> -->
								</select>

								<input type="text" name="sch_text" value="<?=$sch_text?>" title="검색어" style="width:200px;" />
								<input type="submit" value="검색" class="btn btn-default"/>
								<a href="<?=$menu_url?>/downExcelForResult" class="btn btn-primary" target="_blank">전체목록 엑셀다운로드</a>
							</td>
						</tr>
				</table>
			</form>
		</div>
		<h3 class="title">이벤트 예약 리스트</h3>
		<table class="table table-list">
			<caption>미처리 목록</caption>
			<colgroup>
			</colgroup>

			<thead>				
				<tr>
					<th>No</th>
					<th>몰</th>
					<th>예약방법</th>
					<th>신청자명</th>
					<th>전화번호</th>
					<th>아이디</th>
					<th>검진기관명</th>
					<th>검진기번호</th>
					<th>처리일시</th>
					<th>구분</th>
				</tr>
			</thead>
			<tbody class="tcenter-all">
				<?if(isArray_($list)):?>
					<?foreach($list as $k => $v):?>
				<tr>
					<td><?=$paging->getPageNum($k)?></td>
					<td>
						<input type="button" value="<?=$_malls[$v['er_mall']]['icon']?>" class="btn btn-<?=$_malls[$v['er_mall']]['color']?>"/>
					</td>
					<td>
						<?=$_method[$v['er_method']]['name']?>
					</td>						
					<td>
						<a href="<?=$menu_url?>/viewReserve?seq=<?=$v['er_seq']?>"><?=$v['er_name']?></a>
					</td>
					<td>
						<?=$v['er_phone']?>
					</td>
					<td>
						<?=$v['er_meid']?>
					</td>
					<td>
						<?if(isset($hospital_list[$v['er_ainum']])):?>
						<?=$hospital_list[$v['er_ainum']]['hi_open_name']?>						
						<?else:?>
						<?=$v['ai_name']?><span style="color:red;"> (삭제됨)</span>						
						<?endif;?>					
					</td>
					<td>
						<?=$v['er_ainum']?>
					</td>
					<td>
						<?if($v['er_check_time']):?>
						<?=date('Y.m.d H:i', $v['er_check_time'])?>
						<?else:?>
						<span style="color:red; font-weight:bold;">-</span>
						<?endif;?>
					</td>
					<td>
						<?=$v['status']?>
					</td>
				</tr>
					<?endforeach;?>
				<?else:?>
				<tr>
					<td colspan="9">※  검색된 예약 목록이 없습니다.</td>
				</tr>
				<?endif;?>
			</tbody>
		</table>

		<?if(count($paging->pages) > 0):?>

	<div id="paging">
		
		<ul class="pagination">
			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl(1)?>&amp;<?=$add_url?>&amp;act=resultList"><span>&lt;&lt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;<?=$add_url?>&amp;act=resultList" onclick="return false;"><span>&lt;&lt;</span></a></li>
			<?endif;?>


			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->prev)?>&amp;<?=$add_url?>&amp;act=resultList"><span>&lt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;<?=$add_url?>&amp;act=resultList" onclick="return false;"><span>&lt;</span></a></li>				
			<?endif;?>

			
			<?foreach($paging->pages as $k => $v):?>
			<li <?if($v == $paging->page):?>class="active"<?endif;?>>
				<a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($v)?>&amp;<?=$add_url?>&amp;act=resultList"><span><?=$v?></span></a>
			</li>
			<?endforeach;?>
			

			<?if($paging->next > 0):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->next)?>&amp;<?=$add_url?>&amp;act=resultList"><span>&gt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;<?=$add_url?>&amp;act=resultList" onclick="return false;"><span>&gt;</span></a></li>				
			<?endif;?>

			<?if($paging->page < $paging->totalPages):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->totalPages)?>&amp;<?=$add_url?>&amp;act=resultList"><span>&gt;&gt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;<?=$add_url?>&amp;act=resultList" onclick="return false;"><span>&gt;&gt;</span></a></li>				
			<?endif;?>

		</ul>

	</div>
	
	<?endif;?>
	</div>
</div>
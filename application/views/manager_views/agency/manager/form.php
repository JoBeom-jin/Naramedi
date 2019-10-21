<div id="agency_manager_view">
	<h2 class="title">검진기관 관리</h2>

	<h3 class="title">검진기관 정보</h3>

	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">
	<input type="hidden" name="seq" value="<?=$modify['ai_seq']?>" />

	<table class="table table-form" summary="검진기관 정보 확인">
		<caption>검진기관 정보</caption>
		<colgroup>
			<col width="15%" />
			<col width="35%" />
			<col width="15%" />
			<col width="35%" />
		</colgroup>

		<tbody>
			<tr>
				<th colspan="4">기본정보</th>
			</tr>
			<tr>
				<th>검진기관명</th>
				<td>
					<input type="text" name="ai_name" value="<?=$modify['ai_name']?>" title="검진기관명" />
				</td>
				<th>검진기관번호</th>
				<td>
					<input type="text" name="ai_number" value="<?=$modify['ai_number']?>" title="검진기관번호" />					
				</td>
			</tr>
			<tr>
				<th>시도</th>
				<td>
					<input type="text" name="ai_addr_text1" value="<?=$modify['ai_addr_text1']?>"  title="시도구분" />
				</td>
				<th>시군구</th>
				<td>
					<input type="text" name="ai_addr_text2" value="<?=$modify['ai_addr_text2']?>" title="시군구" />
				</td>
			</tr>
			<tr>
				<th>주소</th>
				<td colspan="3">					
					<input type="text" name="ai_addr" value="<?=$modify['ai_addr']?>" title="전체 주소" />
				</td>
			</tr>
			<tr>
				<th>전화번호</th>
				<td>
					<input type="text" name="ai_phone" value="<?=$modify['ai_phone']?>" title="전화번호" />					
				</td>
				<th>검진실 전화번호</th>
				<td>
					<input type="text" name="ai_ex_phone" value="<?=$modify['ai_ex_phone']?>" title="검진실 전화번호" />					
				</td>
			</tr>			
			<tr>
				<th>홈페이지</th>
				<td colspan="3">
					<input type="text" name="ai_homepage" value="<?=$modify['ai_homepage']?>" title="검진기관 홈페이지" />
				</td>
			</tr>
			
			<tr>
				<th>검진항목</th>
				<td colspan="3">
					<input type="checkbox" value="1" title="일반(생애 1, 2차)" name="ai_gren_cd" id="ai_gren_cd" <?if($modify['ai_gren_cd']):?>checked="checked"<?endif;?>/> <label for="ai_gren_cd">일반(생애 1, 2차)</label>
					&nbsp; / &nbsp;
					<input type="checkbox" value="1" title="유방암" name="ai_bc_cd" id="ai_bc_cd" <?if($modify['ai_gren_cd']):?>checked="checked"<?endif;?>/> <label for="ai_bc_cd">유방암</label>
					&nbsp; / &nbsp;
					<input type="checkbox" value="1" title="대장암" name="ai_cc_cd" id="ai_cc_cd" <?if($modify['ai_cc_cd']):?>checked="checked"<?endif;?>/> <label for="ai_cc_cd">대장암</label>
					&nbsp; / &nbsp;
					<input type="checkbox" value="1" title="자궁경부암" name="ai_cvxca_cd" id="ai_cvxca_cd" <?if($modify['ai_cvxca_cd']):?>checked="checked"<?endif;?>/> <label for="ai_cvxca_cd">자궁경부암</label>
					&nbsp; / &nbsp;
					<input type="checkbox" value="1" title="영유아" name="ai_ichk_cd" id="ai_ichk_cd" <?if($modify['ai_ichk_cd']):?>checked="checked"<?endif;?>/> <label for="ai_ichk_cd">영유아</label>
					&nbsp; / &nbsp;
					<input type="checkbox" value="1" title="간암" name="ai_lvca_cd" id="ai_lvca_cd" <?if($modify['ai_lvca_cd']):?>checked="checked"<?endif;?>/> <label for="ai_lvca_cd">간암</label>
					&nbsp; / &nbsp;
					<input type="checkbox" value="1" title="구강검진" name="ai_mchk_cd" id="ai_mchk_cd" <?if($modify['ai_mchk_cd']):?>checked="checked"<?endif;?>/> <label for="ai_mchk_cd">구강검진</label>
					&nbsp; / &nbsp;
					<input type="checkbox" value="1" title="위암" name="ai_stmca_cd" id="ai_stmca_cd" <?if($modify['ai_stmca_cd']):?>checked="checked"<?endif;?>/> <label for="ai_stmca_cd">위암</label>
				</td>
			</tr>

			

			<tr>
				<th>좌표</th>
				<td colspan="3">
					<table class="table table-form" summary="맵의 X좌표와 Y좌표를 수정한다">
						<caption>맵 좌표 입력 폼</caption>
						<tbody>
						<tr>
							<th class="mini">X좌표</th>
							<td>
								<input type="text" name="ai_x" title="x좌표" value="<?=$modify['ai_x']?>"  />
							</td>
						</tr>
						<tr>
							<th class="mini">Y좌표</th>
							<td>
								<input type="text" name="ai_y" title="y좌표" value="<?=$modify['ai_y']?>"  />
							</td>
						</tr>
						</tbody>
					</table>
				</td>
			</tr>

			<tr>
				<th colspan="4"> 교통, 위치, 주차, 점심시간</th>
			</tr>

			<tr>
				<th>교통정보</th>
				<td colspan="3">
					<table class="table talbe-list full" summary="각 교통 타입에 따른 교통정보 입력 폼" >
						<caption>교통정보 입력 폼</caption>
						<thead>
							<tr>
								<th>종류</th>
								<th>노선정보</th>
								<th>하차정류소</th>
								<th>하차후방향</th>
								<th>거리</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>버스</th>
								<td>
									<input type="text" name="at_inc_bus" value="<?=$modify['at_inc_bus']?>" title="버스 노선정보" />
								</td>
								<td>
									<input type="text" name="at_inc_bus_goal" value="<?=$modify['at_inc_bus_goal']?>" title="버스 하차할 정류소" />
								</td>
								<td>
									<input type="text" name="at_inc_bus_way" value="<?=$modify['at_inc_bus_way']?>" title="하차 후 이동해야할 방향" />
								</td>
								<td>
									<input type="text" name="at_inc_bus_dis" value="<?=$modify['at_inc_bus_dis']?>" title="하차 후 도보로 가야할 거리" placeholder="미터 단위의 숫자만 입력"/>
								</td>
							</tr>
							<tr>
								<th>지하철</th>
								<td>
									<input type="text" name="at_sbwy_route" value="<?=$modify['at_sbwy_route']?>" title="지하철 노선정보" />
								</td>
								<td>
									<input type="text" name="at_sbwy_goal" value="<?=$modify['at_sbwy_goal']?>" title="지하철 하차할 정류소" />
								</td>
								<td>
									<input type="text" name="at_sbwy_way" value="<?=$modify['at_sbwy_way']?>" title="하차 후 이동해야할 방향" />
								</td>
								<td>
									<input type="text" name="at_sbwy_dis" value="<?=$modify['at_sbwy_dis']?>" title="하차 후 도보로 가야할 거리" placeholder="미터 단위의 숫자만 입력"/>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<th>주차</th>
				<td colspan="3">
					<table class="table table-list full" summary="주차정보 입력 폼">
						<caption>주차정보 입력 폼</caption>
						<tbody>
							<thead>
								<tr>
									<th>유/무료</th>
									<th>주차가능대수</th>
									<th>운영주차장여부</th>
									<th>기타사항</th>
								</tr>
							</thead>
							<tbody>
								<tr class="tcenter-all">
									<td>
										<select name="ap_pay_yn" title="유/무료 선택">
											<option value="">정보없음</option>
											<option value="0" <?if($modify['ap_pay_yn'] === '0'):?>selected="selected"<?endif;?> >무료</option>
											<option value="1" <?if($modify['ap_pay_yn'] === '1'):?>selected="selected"<?endif;?>>유료</option>
										</select>
									</td>
									<td>
										<input type="text" name="ap_number" value="<?=$modify['ap_number']?>"	title="주차가능대수" placeholder="숫자만 입력하세요" />
									</td>
									<td>
										<select name="ap_self_yn" title="운영주차장 여부">
											<option value="">정보없음</option>
											<option value="0" <?if($modify['ap_self_yn'] === '0'):?>selected="selected"<?endif;?>>주차장 없음</option>
											<option value="1" <?if($modify['ap_self_yn'] === '1'):?>selected="selected"<?endif;?>>주차장 운영중</option>
										</select>
									</td>
									<td>
										<input type="text" name="ap_comment" value="<?=$modify['ap_comment']?>" title="기타사항 입력" placeholder="20자 내외로 입력" />
									</td>
								</tr>
							</tbody>
						</tbody>
					</table>					
				</td>
			</tr>
			<tr>
				<th>점심시간</th>
				<td colspan="3">					
					<select name="ap_lun_start_time" title="점심시간 시작 시간" style="width:150px;" >
						<option value="">설정되지 않음</option>
						<?foreach($times as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_lun_start_time']):?>selected="selected"<?endif;?> ><?=$v?>시</option>
						<?endforeach;?>
					</select>
					<select name="ap_lun_start_minuet" title="점심시간 시작 분" style="width:150px;">
						<option value="">설정되지 않음</option>
						<?foreach($minuets as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_lun_start_minuet']):?>selected="selected"<?endif;?> ><?=$v?>분</option>
						<?endforeach;?>						
					</select>
					부터
					<select name="ap_lun_end_time" title="점심시간 종료 시간" style="width:150px;">
						<option value="">설정되지 않음</option>
						<?foreach($times as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if(is_numeric($modify['ap_lun_end_time']) && $v == $modify['ap_lun_end_time']):?>selected="selected"<?endif;?> ><?=$v?>시</option>
						<?endforeach;?>
					</select>
					<select name="ap_lun_end_minuet" title="점심시간 종료 분" style="width:150px;" >	
						<option value="">설정되지 않음</option>
						<?foreach($minuets as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_lun_end_minuet']):?>selected="selected"<?endif;?> ><?=$v?>분</option>
						<?endforeach;?>	
					</select>
					까지
				</td>
			</tr>
			<tr>
				<th>평일진료시간</th>
				<td colspan="3">					
					<select name="ap_jin_start_time" title="점심시간 시작 시간" style="width:150px;" >
						<option value="">설정되지 않음</option>
						<?foreach($times as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_jin_start_time']):?>selected="selected"<?endif;?> ><?=$v?>시</option>
						<?endforeach;?>
					</select>
					<select name="ap_jin_start_minuet" title="점심시간 시작 분" style="width:150px;">
						<option value="">설정되지 않음</option>
						<?foreach($minuets as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_jin_start_minuet']):?>selected="selected"<?endif;?> ><?=$v?>분</option>
						<?endforeach;?>						
					</select>
					부터
					<select name="ap_jin_end_time" title="점심시간 종료 시간" style="width:150px;">
						<option value="">설정되지 않음</option>
						<?foreach($times as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if(is_numeric($modify['ap_jin_end_time']) && $v == $modify['ap_jin_end_time']):?>selected="selected"<?endif;?> ><?=$v?>시</option>
						<?endforeach;?>
					</select>
					<select name="ap_jin_end_minuet" title="점심시간 종료 분" style="width:150px;" >	
						<option value="">설정되지 않음</option>
						<?foreach($minuets as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_jin_end_minuet']):?>selected="selected"<?endif;?> ><?=$v?>분</option>
						<?endforeach;?>	
					</select>
					까지
				</td>
			</tr>
			<tr>
				<th>평일예약시간</th>
				<td colspan="3">					
					<select name="ap_rsv_start_time" title="점심시간 시작 시간" style="width:150px;" >
						<option value="">설정되지 않음</option>
						<?foreach($times as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_rsv_start_time']):?>selected="selected"<?endif;?> ><?=$v?>시</option>
						<?endforeach;?>
					</select>
					<select name="ap_rsv_start_minuet" title="점심시간 시작 분" style="width:150px;">
						<option value="">설정되지 않음</option>
						<?foreach($minuets as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_rsv_start_minuet']):?>selected="selected"<?endif;?> ><?=$v?>분</option>
						<?endforeach;?>						
					</select>
					부터
					<select name="ap_rsv_end_time" title="점심시간 종료 시간" style="width:150px;">
						<option value="">설정되지 않음</option>
						<?foreach($times as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if(is_numeric($modify['ap_rsv_end_time']) && $v == $modify['ap_rsv_end_time']):?>selected="selected"<?endif;?> ><?=$v?>시</option>
						<?endforeach;?>
					</select>
					<select name="ap_rsv_end_minuet" title="점심시간 종료 분" style="width:150px;" >	
						<option value="">설정되지 않음</option>
						<?foreach($minuets as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_rsv_end_minuet']):?>selected="selected"<?endif;?> ><?=$v?>분</option>
						<?endforeach;?>	
					</select>
					까지
				</td>
			</tr>
			<tr>
				<th>주말검진시간</th>
				<td colspan="3">					
					<select name="ap_sat_jin_start_time" title="점심시간 시작 시간" style="width:150px;" >
						<option value="">설정되지 않음</option>
						<?foreach($times as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_sat_jin_start_time']):?>selected="selected"<?endif;?> ><?=$v?>시</option>
						<?endforeach;?>
					</select>
					<select name="ap_sat_jin_start_minuet" title="점심시간 시작 분" style="width:150px;">
						<option value="">설정되지 않음</option>
						<?foreach($minuets as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_sat_jin_start_minuet']):?>selected="selected"<?endif;?> ><?=$v?>분</option>
						<?endforeach;?>						
					</select>
					부터
					<select name="ap_sat_jin_end_time" title="점심시간 종료 시간" style="width:150px;">
						<option value="">설정되지 않음</option>
						<?foreach($times as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if(is_numeric($modify['ap_sat_jin_end_time']) && $v == $modify['ap_sat_jin_end_time']):?>selected="selected"<?endif;?> ><?=$v?>시</option>
						<?endforeach;?>
					</select>
					<select name="ap_sat_jin_end_minuet" title="점심시간 종료 분" style="width:150px;" >	
						<option value="">설정되지 않음</option>
						<?foreach($minuets as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_sat_jin_end_minuet']):?>selected="selected"<?endif;?> ><?=$v?>분</option>
						<?endforeach;?>	
					</select>
					까지
				</td>
			</tr>
			<tr>
				<th>주말예약시간</th>
				<td colspan="3">					
					<select name="ap_sat_rsv_start_time" title="점심시간 시작 시간" style="width:150px;" >
						<option value="">설정되지 않음</option>
						<?foreach($times as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_sat_rsv_start_time']):?>selected="selected"<?endif;?> ><?=$v?>시</option>
						<?endforeach;?>
					</select>
					<select name="ap_sat_rsv_start_minuet" title="점심시간 시작 분" style="width:150px;">
						<option value="">설정되지 않음</option>
						<?foreach($minuets as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_sat_rsv_start_minuet']):?>selected="selected"<?endif;?> ><?=$v?>분</option>
						<?endforeach;?>						
					</select>
					부터
					<select name="ap_sat_rsv_end_time" title="점심시간 종료 시간" style="width:150px;">
						<option value="">설정되지 않음</option>
						<?foreach($times as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if(is_numeric($modify['ap_sat_rsv_end_time']) && $v == $modify['ap_sat_rsv_end_time']):?>selected="selected"<?endif;?> ><?=$v?>시</option>
						<?endforeach;?>
					</select>
					<select name="ap_sat_rsv_end_minuet" title="점심시간 종료 분" style="width:150px;" >	
						<option value="">설정되지 않음</option>
						<?foreach($minuets as $v):?>
						<option value="<?=str_pad($v, 2, '0', STR_PAD_LEFT)?>" <?if($v == $modify['ap_sat_rsv_end_minuet']):?>selected="selected"<?endif;?> ><?=$v?>분</option>
						<?endforeach;?>	
					</select>
					까지
				</td>
			</tr>
		</tbody>

	</table>

	<div class="btn-area-center">
		<input type="submit" value="완료" class="btn btn-primary"/>
		<a href="<?=urldecode($back_url)?>" class="btn btn-default">목록으로</a>
	</div>
	</form>

</div>
<div id="agency_manager_view">
	<h2 class="title">검진기관 관리</h2>

	<h3 class="title">검진기관 정보</h3>

	<table class="table table-form" summary="검진기관 정보 확인">
		<caption>검진기관 정보</caption>
		<colgroup>
			<col width="20%"/>
			<col width="80%"/>
		</colgroup>

		<tbody>
			<tr>
				<th colspan="2">기본정보</th>
			</tr>
			<tr>
				<th>검진기관명/검진기관번호</th>
				<td>
					<?=$view['ai_name']?> / <?=$view['ai_number']?>
				</td>
			</tr>
			<tr>
				<th>주소</th>
				<td>
					<?=$view['ai_addr']?>
				</td>
			</tr>
			<tr>
				<th>전화번호</th>
				<td>
					<?=$view['ai_phone']?> <?if(is_string($view['ai_ex_phone'])):?> / 검진실 : <?=$view['ai_ex_phone']?> <?endif;?>
				</td>
			</tr>
			<tr>
				<th>홈페이지</th>
				<td>
					<?=$view['ai_homepage']?>
				</td>
			</tr>
			
			<?if($view['works']):?>
			<tr>
				<th>검진항목</th>
				<td>
					<?=$view['works']?>
				</td>
			</tr>
			<?endif;?>

			<tr>
				<th colspan="2"> 교통, 위치, 주차, 점심시간</th>
			</tr>

			<tr>
				<th>좌표</th>
				<td>
					<?if($view['ai_x'] != 'nodata' && $view['ai_y'] != 'nodata'):?>
					<?=$view['ai_x']?>, <?=$view['ai_y']?>
					<?endif;?>
				</td>
			</tr>
			<tr>
				<th>교통정보</th>
				<td>
					<?if($view['bus']):?>
					<p><?=$view['bus']?></p>
					<?endif?>
					<?if($view['subway']):?>
					<p><?=$view['subway']?></p>
					<?endif?>
				</td>
			</tr>
			<tr>
				<th>주차</th>
				<td>
					<?=$view['park']?>&nbsp;
				</td>
			</tr>
			<tr>
				<th>점심시간</th>
				<td>
					<?if($view['lunch']):?>
					<?=$view['lunch']?>
					<?else:?>
					<span class="tdanger">설정되지 않음</span>
					<?endif;?>
				</td>
			</tr>
			<tr>
				<th>평일 진료시간</th>
				<td>
					<?if($view['jin']):?>
					<?=$view['jin']?>
					<?else:?>
					<span class="tdanger">설정되지 않음</span>
					<?endif;?>
				</td>
			</tr>
			<tr>
				<th>평일 예약시간</th>
				<td>
					<?if($view['rsv']):?>
					<?=$view['rsv']?>
					<?else:?>
					<span class="tdanger">설정되지 않음</span>
					<?endif;?>
				</td>
			</tr>
			<tr>
				<th>토요일 진료시간</th>
				<td>
					<?if($view['sat_jin']):?>
					<?=$view['sat_jin']?>
					<?else:?>
					<span class="tdanger">설정되지 않음</span>
					<?endif;?>
				</td>
			</tr>
			<tr>
				<th>토요일 예약시간</th>
				<td>
					<?if($view['sat_rsv']):?>
					<?=$view['sat_rsv']?>
					<?else:?>
					<span class="tdanger">설정되지 않음</span>
					<?endif;?>
				</td>
			</tr>
		</tbody>

	</table>

	<div class="btn-area-center">
		<a href="<?=$menu_url?>/modify/seq/<?=$view['ai_seq']?>?back_url=<?=$back_url?>" class="btn btn-primary">정보수정</a>
		<a href="<?=$menu_url?>/deleteAgency/seq/<?=$f['ai_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('삭제된 정보는 복구하실 수 없습니다.\n삭제하시겠습니까?');">삭제</a>
		<a href="<?=urldecode($menu_url)?>" class="btn btn-default">목록으로</a>
	</div>

	
	<h3 class="title">검증기관 이미지 편집</h3>
	<form method="post" action="<?=$menu_url?>/modifyFileOK" enctype="multipart/form-data" target="formReceiver">
		<input type="hidden" name="seq" value="<?=$view['ai_seq']?>" />
		
		<table class="table table-form" summary="등록된 사진을 삭제,수정,입력하는 폼">
			<caption>사진 등록 폼</caption>
			<colgroup>
				<col width="20%" />
				<col width="80%" />
			</colgroup>
			<tbody>
				<tr>
					<th rowspan="2">이미지 목록</th>
					<td>
						<?if(is_array($file_list)):?>
						<?foreach($file_list as $k => $f):?>
						<div class="image_list">
							<a href="<?=$menu_url?>/deleteImage/fseq/<?=$f['aim_seq']?>" target="formReceiver" onclick="return confirm('삭제된 이미지는 복구하실 수 없습니다.\n삭제하시겠습니까?');">
								<img src="<?=$f['url']?>" alt="<?=$f['aim_fname']?>" />
							</a>
						</div>
						<?endforeach;?>
						<?endif;?>
					</td>
				</tr>
				<tr>
					<td><span class="tdanger">※ 이미지 클릭시 해당 이미지를 삭제하실 수 있습니다.</span></td>
				</tr>
				<tr>
					<th>이미지등록</th>
					<td>
						<input type="file" value="" name="upload[]" multiple>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="btn-area-center">
			<input type="submit" value="이미지 등록" class="btn btn-default"/>
		</div>
	</form>

</div>
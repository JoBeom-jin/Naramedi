<div id="search-data">
	<h2 class="title">검진기관 찾기</h2>

	<form method="get" action="<?=$menu_url?>/<?=$act?>" >
		<table class="table table-form" summary="검진기관 찾기 폼">
			<caption>검진기관 찾기 폼</caption>
			<tbody>
				<tr>
					<td>
						<?if(isset($error_message)):?>
						<p class="tdanger">
						※ <?=$error_message?>
						</p>
						<?endif;?>

						<input type="text" name="sch_name" value="<?=$sch_name?>" title="검진기관 이름 입력" placeholder="검진기관 이름을 입력하세요" class="middle"/>
						<input type="submit" value="검색하기" class="btn btn-primary" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>

	<h3 class="title">검색된 기관 리스트</h3>
	<table class="table table-list" summary="검색결과 목록">
		<caption>검색된 기관 목록</caption>
		<colgroup>
			<col width="8%" />
			<col width="30%" />
			<col width="auto" />
			<col width="7%" />
		</colgroup>
		<thead>
			<tr>
				<th>No</th>
				<th>기관명</th>
				<th>주소</th>
				<th>관리</th>
			</tr>
		</thead>
		<tbody>
			<?if(isset($list) && is_array($list) && count($list) > 0):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td><?=$k+1?></td>
				<td>
					<?=$v['hmcNm']?>
				</td>
				<td>
					<?=$v['locAddr']?>
				</td>
				<td>
					<a href="<?=$menu_url?>/searchDataInsertDb?number=<?=$v['hmcNo']?>&amp;hmcNm=<?=$v['hmcNm']?>&amp;locAddr=<?=$v['locAddr']?>"  target="formReceiver" class="btn btn-default">DB입력</a>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="4">※ 선택가능한 기관이 없습니다.</td>				
			</tr>
			<?endif;?>
		</tbody>
	</table>
</div>
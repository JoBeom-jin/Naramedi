<h2 class="title">기관 정보</h2>
<div id="agency-find-list">
	<h3 class="title">기관 기본정보</h3>
	<table class="table table-form" summary="찾고 있는 기관의 기본정보">
		<caption>기관 기본정보</caption>
		<colgroup>
			<col width="15%" />
			<col width="35%" />
			<col width="15%" />
			<col width="35%" />
		</colgroup>

		<tbody>
			<tr>
				<th>기관명</th>
				<td>
					<?=$default_info['hd_name']?>
				</td>
				<th>종류</th>
				<td>
					<?=$default_info['hd_type_name']?>					
				</td>
			</tr>
			<tr>
				<th>도,시</th>
				<td>
					<?=$default_info['hd_addr1']?>
				</td>
				<th>지역구</th>
				<td>
					<?=$default_info['hd_addr2']?>
				</td>
			</tr>
			<tr>
				<th>주소</th>
				<td colspan="3">
					<?=$default_info['hd_addr']?>
				</td>
			</tr>
		</tbody>
	</table>

	<h3 class="title">선택가능한 목록</h3>
	<table class="table table-list" summary="선택가능한 목록">
		<caption>선택가능한 기관 목록</caption>
		<colgroup>
			<col width="10%" />
			<col width="20%" />
			<col width="auto" />
			<col width="13%" />
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
			<?if(is_array($list) && count($list) > 0):?>
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
					<a href="<?=$menu_url?>/insertFromFilnd?number=<?=$v['hmcNo']?>&amp;hmcNm=<?=$v['hmcNm']?>&amp;locAddr=<?=$v['locAddr']?>&amp;hd_seq=<?=$default_info['hd_seq']?>"  target="formReceiver" class="btn btn-default">DB입력</a>
				</td>
			</tr>
			<?endforeach;?>
			<?elseif($list == 'limited'):?>
			<tr>
				<td colspan="4">※ 검색할 수 없습니다.</td>				
			</tr>
			<?else:?>
			<tr>
				<td colspan="4">※ 선택가능한 기관이 없습니다.</td>				
			</tr>
			<?endif;?>
		</tbody>
	</table>
</div>
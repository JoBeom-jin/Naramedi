<div id="search-list">
	<h3 class="title">검진기관 검색</h3>

	<form method="post" action="/index.php/rhksflwk?bact=search" >
	<table class="table table-form" summary="이름으로 검진기관을 검색합니다.">
		<caption>검색 폼</caption>
		<tbody>
			<tr>
				<td>
					<input type="text" name="ai_name" value="<?=$ai_name?>" title="검진기관 명" placeholder="검색할 검진기관 명" class="middle"/>
					 &nbsp; 
					<input type="submit" value="검색" class="btn btn-primary" />
				</td>
			</tr>
		</tbody>
	</table>
	</form>


	<table class="table table-list" summary="이름으로 검색한 검색 결과 입니다. 이름과 주소 목록을 보여줍니다.">
		<caption>검색 결과</caption>
		<colgroup>
			<col width="60%" />
			<col width="30%" />
			<col width="10%" />
		</colgroup>
		<thead>
			<tr>
				<th>이름</th>
				<th>기관번호</th>
				<th>기능</th>
			</tr>
		</thead>
		<tbody class="tcenter-all">
			<?if(is_array($list) && count($list) > 0):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td>
					<?=$v['ai_name']?>
				</td>
				<td>
					<?=$v['ai_number']?>
				</td>
				<td>
					<input type="button" value="선택" class="btn btn-default" onclick="select_org(<?=$v['ai_number']?>, '<?=$v['ai_name']?>');"/>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="3">※ 검색된 검진 기관이 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>
	</table>	

	<div class="notice-area">
		<p class="strong">검진기관을 선택해주세요.</p>
		기관 검색이 되지 않을 경우</br>
		고객센터로 문의해 주시기 바랍니다.
	</div>
</div>

<script type="text/javascript">

function select_org(ai_number, ai_name){
	
	if(confirm('선택한 병원으로 적용하시겠습니까? ')){
		opener.document.getElementById('hi_org_number').value=ai_number;
		opener.document.getElementById('me_name').value=ai_name;
		self.close();
	}
}
</script>
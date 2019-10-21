<h2 class="title">이벤트 선택하기</h2>
<form method="post" action="<?=$menu_url?>/<?=$act?>" >
	<table class="table table-form" summary="검색 옵션 선택 폼">
		<caption>검색 옵션 선택 폼</caption>
		<tbody>
			<tr>
				<td>
					<select name="mall" title="오픈몰 여부" >
						<?foreach($_malls as $k => $v):?>
						<?if($mall == $k):?>
						<option value="<?=$k?>" <?if($mall == $k):?>selected="selected"<?endif;?>><?=$v['name']?></option>
						<?endif;?>
						<?endforeach;?>
					</select>					
					<select name="sch_op" title="검색 옵션">
						<option value="event_name" <?if($sch_op == 'event_name'):?>selected="selected"<?endif;?>>이벤트명</option>
						<option value="hospital_name" <?if($sch_op == 'hospital_name'):?>selected="selected"<?endif;?>>검진기관명</option>
					</select>
					<input type="text" name="sch_text" value="<?=$sch_text?>" title="검색어 입력" class="normal"/>
					<input type="submit" value="검색" class="btn btn-primary" />
				</td>
			</tr>
		</tbody>
	</table>

	<h3 class="title">검색결과</h3>

	<table class="table table-list" summary="검색어에 대한 검색 결과 입니다.">
		<caption>검색 결과 목록</caption>
		<colgroup>
			<col width=""/>
			<col width="15%"/>
			<col width="15%"/>
		</colgroup>
		<thead>
			<tr>
				<th>이벤트명</th>
				<th>가격</th>
				<th>선택</th>
			</tr>
		</thead>
		<tbody>
			<?if(isArray_($list)):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td><?=$v['ei_name']?></td>
				<td>
					<?=number_format($v['account']);?>원
				</td>
				<td>
					<input type="button" value="이벤트 선택" data-eiseq="<?=$v['ei_seq']?>" data-ainum="<?=$v['ai_number']?>" data-einame="<?=$v['ei_name']?>" data-account="<?=$v['account']?>" class="btn btn-default select-button" />
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="3">※ 검색 결과가 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>
	</table>
</form>

<script type="text/javascript">

$(document).ready(function(){

	$('.select-button').on('click', function(){
		var ei_seq = $(this).data('eiseq');
		var ai_num = $(this).data('ainum');
		var ei_name = $(this).data('einame');
		var ei_account = $(this).data('account');

		parent.opener.$('#er_eiseq').val(ei_seq);
		parent.opener.$('#er_ainum').val(ai_num);
		parent.opener.$('#er_account').val(ei_account);
		parent.opener.$('#selected_event').html(ei_name);
		
		
		parent.close();
	});

});
</script>
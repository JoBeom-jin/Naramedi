<h2 class="title">정보수정</h2>

<form method="post" action="<?=$menu_url?>/__act__" target="formReceiver" id="modifyForm">
	<input type="hidden" name="seq" value="<?=$modify['apd_seq']?>" />

	<table class="table table-form" summary="정보 수정" >
		<caption>정보수정</caption>
		<tbody>
			<tr>
				<th>기관이름</th>
				<td colspan="3">
					<?=$modify['apd_source']?>
				</td>
			</tr>
			<tr>
				<th>기관주소</th>
				<td colspan="3">
					<?=$modify['apd_addr']?>
				</td>
			</tr>
			<tr>
				<th>폴더이름</th>
				<td colspan="3">
					<?=$modify['apd_target']?>
				</td>
			</tr>
			<tr>
				<th>폴더정보</th>
				<td>					
					<input type="text" name="apd_target" value="<?=$modify['apd_target']?>" />
				</td>
				<td class="tcenter">
					폴더 <?if($modify['apd_dir_exists'] == 'N'):?><span class="tdanger">없음</span><?elseif($modify['apd_dir_exists'] == 'Y'):?>있음<?endif;?>					
				</td>
				<td class="tcenter">
					<input type="button" value="폴더수정"  class="btn btn-default" onclick="return modifyTarget();"/>
				</td>
			</tr>
			<tr>
				<th>매칭기관</th>
				<td colspan="3">
					<?if($modify['apd_ai_exists']=='Y'):?>
					<?=$modify['ai_name']?>
					<?else:?>
					<span class="tdanger">매칭된 기관정보 없음</span>
					<?endif?>
				</td>
			</tr>
			<tr>
				<th>기관검색</th>
				<td colspan="2">
					<input type="text" name="search_text" value="" placeholder="기관이름"/>					
				</td>
				<td>
					<input type="button" value="기관찾기" class="btn btn-default" onclick="return searchAgency();"/>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<div class="scrolls">
						<table class="table table-list">
							<thead>
								<tr>
									<th>기관명</th>
									<th>주소</th>
									<th>매칭</th>
								</tr>
							</thead>
							<tbody>
								<?if($agency_list && count($agency_list) > 0):?>
								<?foreach($agency_list as $agency):?>
								<tr>
									<td><?=$agency['ai_name']?></td>
									<td><?=$agency['ai_addr']?></td>
									<td>
										<a href="<?=$menu_url?>/matchAgency?aiseq=<?=$agency['ai_seq']?>&amp;apdseq=<?=$modify['apd_seq']?>" class="btn btn-default" target="formReceiver">매칭</a>
									</td>
								</tr>
								<?endforeach;?>
								<?else:?>
								<tr>
									<td colspan="3">검색 결과가 없습니다.</td>
								</tr>
								<?endif;?>
							</tbody>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</form>

<script type="text/javascript">
function modifyTarget(){
	var action = 'modifyTarget';
	var string = $('#modifyForm').attr('action');
	var res = string.replace('__act__', action);
	$('#modifyForm').attr('action', res);
	$('#modifyForm').attr('target', 'formReceiver');
	$('#modifyForm').submit();	
}

function searchAgency(){
	var action = '<?=$act?>';
	var string = $('#modifyForm').attr('action');
	var res = string.replace('__act__', action);
	$('#modifyForm').attr('action', res);
	$('#modifyForm').attr('target', '');
	$('#modifyForm').submit();	
}
</script>


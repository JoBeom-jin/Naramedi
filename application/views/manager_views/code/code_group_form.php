<div id="code-group">
	<h2 class="title">코드 그룹 및 코드 관리</h2>

	<h3 class="title">코드 그룹 등록폼</h3>

	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">
		<?if($act == 'modifyGroup'):?>
		<input type="hidden" name="cg_code" value="<?=$group_info['cg_code']?>" />
		<?endif;?>

		<table class="table table-form" summary="신규 코드 그룹을 등록합니다.">		
			<caption>신규 코드 그룹 폼</caption>
			<colgroup>
				<col width="15%" />
				<col width="35%" />
				<col width="15%" />
				<col width="35%" />
			</colgroup>
			<tbody>
				<tr>
					<th>그룹코드</th>
					<td>
						<?if($act == 'modifyGroup'):?>
						<?=$group_info['cg_code']?>
						<?else:?>
						<input type="text" name="cg_code" value="<?=$group_info['cg_code']?>" title="그룹코드" maxlength="3" />
						<?endif;?>
					</td>
					<th>그룹명</th>
					<td>	
						<input type="text" name="cg_name" value="<?=$group_info['cg_name']?>" title="그룹명"  maxlength="20" />
					</td>
				</tr>
				<tr>
					<th>추가값1 이름</th>
					<td colspan="3">
						<input type="text" name="cg_add1" value="<?=$group_info['cg_add1']?>" title="추가값1" maxlength="20"/>
					</td>															
				</tr>
				<tr>
					<th>추가값2 이름</th>
					<td>
						<input type="text" name="cg_add2" value="<?=$group_info['cg_add2']?>" title="추가값2" maxlength="20"/>
					</td>
					<th>추가값3 이름</th>
					<td>
						<input type="text" name="cg_add3" value="<?=$group_info['cg_add3']?>" title="추가값3" maxlength="20"/>
					</td>
				</tr>
				<tr>
					<th>추가값4 이름</th>
					<td>
						<input type="text" name="cg_add4" value="<?=$group_info['cg_add4']?>" title="추가값4" maxlength="20"/>
					</td>
					<th>추가값5 이름</th>
					<td>
						<input type="text" name="cg_add5" value="<?=$group_info['cg_add5']?>" title="추가값5" maxlength="20"/>
					</td>
				</tr>
			</tbody>
		</table>	
		<div class="btn-area btn-area-center">
			<?if($act == 'modifyGroup'):?>
			<input type="submit" value="수정완료" class="btn btn-primary"/>
			<?else:?>
			<input type="submit" value="신규등록" class="btn btn-primary"/>
			<?endif;?>
			<a href="<?=$menu_url?>" class="btn btn-default">목록으로</a>
		</div>
	</form>
</div>
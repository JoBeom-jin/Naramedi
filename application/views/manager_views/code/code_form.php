<div id="code-form">
	<h2 class="title">코드 관리</h2>

	<h3 class="title">코드 신규 입력 / 기존 코드 수정</h3>

	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">
	<input type="hidden" name="cg_code" value="<?=$group_info['cg_code']?>" />

	<?if($act == 'modifyCode'):?>
	<input type="hidden" name="cd_code" value="<?=$code_info['cd_code']?>" />
	<?endif;?>

	<table class="table table-form" summary="신규 코드 등록폼입니다.">
		<caption>신규 코드 등록 폼</caption>

		<colgroup>	
			<col width="15%" />
			<col width="auto" />
			<col width="15%" />
			<col width="auto" />
			<col width="15%" />
			<col width="auto" />
		</colgroup>
		<tbody>
			<tr>
				<th>그룹코드</th>
				<td class="tcenter">
					<?=$group_info['cg_code']?>
				</td>
				<th>코드</th>
				<td>
					<?if($act == 'modifyCode'):?>
					<?=$code_info['cd_code']?>
					<?else:?>
					<input type="text" name="cd_code" value="<?=$code_info['cd_code']?>" title="코드 입력"  maxlength="3"/>
					<?endif;?>					
				</td>
				<th>코드명</th>
				<td>
					<input type="text" name="cd_name" value="<?=$code_info['cd_name']?>" title="코드명"  maxlength="50"/>
				</td>				
			</tr>
			<tr>
				<?if($group_info['cg_add1']):?>
				<th><?=$group_info['cg_add1']?></th>
				<td>
					<input type="text" name="cd_add1" value="<?=$code_info['cd_add1']?>" title="<?=$group_info['cg_add1']?>" maxlength="50"/>	
				</td>
				<?else:?>
				<td colspan="2">
					※ 추가값 1 없음
				</td>
				<?endif;?>

				<?if($group_info['cg_add2']):?>
				<th><?=$group_info['cg_add2']?></th>
				<td>
					<input type="text" name="cd_add2" value="<?=$code_info['cd_add2']?>" title="<?=$group_info['cg_add2']?>" maxlength="50"/>					
				</td>
				<?else:?>
				<td colspan="2">
					※ 추가값 2 없음
				</td>
				<?endif;?>

				<?if($group_info['cg_add3']):?>
				<th><?=$group_info['cg_add3']?></th>
				<td>
					<input type="text" name="cd_add3" value="<?=$code_info['cd_add3']?>" title="<?=$group_info['cg_add3']?>" maxlength="50"/>					
				</td>
				<?else:?>
				<td colspan="4">
					※ 추가값 3 없음
				</td>
				<?endif;?>
			</tr>
			<tr>
				<?if($group_info['cg_add4']):?>
				<th><?=$group_info['cg_add4']?></th>
				<td>
					<input type="text" name="cd_add4" value="<?=$code_info['cd_add4']?>" title="<?=$group_info['cg_add4']?>" maxlength="50"/>					
				</td>
				<?else:?>
				<td colspan="2">
					※ 추가값 4 없음
				</td>
				<?endif;?>

				<?if($group_info['cg_add5']):?>
				<th><?=$group_info['cg_add5']?></th>
				<td>
					<input type="text" name="cd_add5" value="<?=$code_info['cd_add5']?>" title="<?=$group_info['cg_add5']?>" maxlength="50"/>					
				</td>
				<?else:?>
				<td colspan="2">
					※ 추가값 5 없음
				</td>
				<?endif;?>

				<td colspan="2">
				&nbsp;
				</td>
			</tr>
			
		</tbody>
		
	</table>

	<div class="btn-area btn-area-center">

		<?if($act == 'modifyCode'):?>
		<input type="submit" value="코드수정 완료" class="btn btn-primary"/>
		<?else:?>
		<input type="submit" value="신규 등록" class="btn btn-primary"/>
		<?endif;?>

		<input type="button" value="창닫기" onclick="self.close();" class="btn btn-default"/>
	</div>
	
	</form>
</div>
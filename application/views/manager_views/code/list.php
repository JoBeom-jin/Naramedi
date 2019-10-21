<h2 class="title">코드 그룹 및 코드 관리</h2>

<div id="codegroup-form">
	<?if($cg_code):?>
	<div class="code-list">
		<div class="btn-area btn-area-left">
			<a href="<?=$menu_url?>/insertCode?cg_code=<?=$cg_code?>" class="btn btn-default" onclick="window.open(this.href, 'code_insert_form', 'width=600, height=700'); return false;" >코드등록</a>
		</div>

		<table class="table table-list table-list-red" summary="선택된 코드 그룹에 등록된 코드 목록입니다.">
			<caption>코드 목록 [ 코드그룹 : <?=$group_info['cg_code']?> ]</caption>
			<colgroup>
				<col width="13%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="27%" />
			</colgroup>
			<thead>
				<tr>
					<th>코드</th>
					<th>코드명</th>
					<th>
						<?if($group_info['cg_add1']):?>
							<?=$group_info['cg_add1']?>
						<?else:?>
							추가값1
						<?endif;?>
					</th>
					<th>
						<?if($group_info['cg_add2']):?>
							<?=$group_info['cg_add2']?>
						<?else:?>
							추가값2
						<?endif;?>
					</th>
					<th>
						<?if($group_info['cg_add3']):?>
							<?=$group_info['cg_add3']?>
						<?else:?>
							추가값3
						<?endif;?>
					</th>
					<th>
						<?if($group_info['cg_add4']):?>
							<?=$group_info['cg_add4']?>
						<?else:?>
							추가값3
						<?endif;?>
					</th>
					<th>
						<?if($group_info['cg_add5']):?>
							<?=$group_info['cg_add5']?>
						<?else:?>
							추가값3
						<?endif;?>
					</th>
					<th>
						기능
					</th>
				</tr>
			</thead>


			<tbody  class="tcenter-all">
				<?if(!is_array($code_list) || count($code_list) < 1):?>
				<tr>
					<td colspan="8">※ 등록된 코드가 없습니다. 코드를 등록해주세요.</td>
				</tr>
				<?else:?>				
				<?foreach($code_list as $k => $row):?>
				<tr>
					<td>
						<?=$row['cd_code']?>
					</td>
					<td>
						<?=$row['cd_name']?>
					</td>
					<td>						
						<?=$row['cd_add1']?>&nbsp;
					</td>
					<td>
						<?=$row['cd_add2']?>&nbsp;
					</td>
					<td>
						<?=$row['cd_add3']?>&nbsp;
					</td>
					<td>
						<?=$row['cd_add4']?>&nbsp;
					</td>
					<td>
						<?=$row['cd_add5']?>&nbsp;
					</td>
					<td>
						<a href="<?=$menu_url?>/modifyCode?code=<?=$row['cd_code']?>" class="btn btn-primary" onclick="window.open(this.href, 'code_insert_form', 'width=600, height=700'); return false;">수정</a>
						<a href="<?=$menu_url?>/deleteCode?code=<?=$row['cd_code']?>" class="btn btn-danger" onclick="return confirm('코드를 삭제할 경우 시스템에 오류가 발생할 수 있으며 복구하실 수 없습니다.\n정말로 삭제하시겠습니까?');" target="formReceiver">삭제</a>
						<a href="<?=$menu_url?>/upCode?code=<?=$row['cd_code']?>" class="btn btn-default" target="formReceiver">위</a>
						<a href="<?=$menu_url?>/downCode?code=<?=$row['cd_code']?>" class="btn btn-default" target="formReceiver">아래</a>
					</td>
				</tr>				
				<?endforeach;?>
				<?endif;?>	
			</tbody>
		</table>		
		
	</div>
	<?endif;?>

	<div class="code_group_list">
		<div class="btn-area btn-area-left">
			<a href="<?=$menu_url?>/insertGroup" class="btn btn-default" >코드그룹등록</a>
		</div>

		<table class="table table-list" summary="코드그룹 목록입니다. 코드명, 제목 등의 정보를 보여줍니다.">
			<caption>코드그룹 목록</caption>
			<colgroup>
				<col width="12%" />
				<col width="auto" />
				<col width="auto" />
				<col width="auto" />
				<col width="auto" />
				<col width="auto" />
				<col width="20%" />
			</colgroup>
			<thead>
				<tr class="ta_c_all">
					<th>그룹코드</th>
					<th>그룹명</th>
					<th>추가값1</th>
					<th>추가값2</th>
					<th>추가값3</th>
					<th>추가값4</th>
					<th>추가값5</th>
					<th>옵션</th>
				</tr>
			</thead>
			<tbody>
				<?if(!is_array($group_list) || count($group_list) < 1):?>
				<tr>
					<td colspan="6">※ 등록된 코드 그룹이 없습니다.</td>
				</tr>
				<?else:?>
				<?foreach($group_list as $k => $row):?>
				<tr class="tcenter-all">
					<td>
						<a href="<?=$menu_url?>?cg_code=<?=$row['cg_code']?>" class="btn btn-default" title="코드 보기">
							<?=$row['cg_code']?>
						</a>
					</td>
					<td><?=$row['cg_name']?></td>
					<td><?=$row['cg_add1']?></td>
					<td><?=$row['cg_add2']?></td>
					<td><?=$row['cg_add3']?></td>
					<td><?=$row['cg_add4']?></td>
					<td><?=$row['cg_add5']?></td>
					<td>
						<a href="<?=$menu_url?>/modifyGroup?cg_code=<?=$row['cg_code']?>" class="btn btn-default">수정</a>
						<a href="<?=$menu_url?>/deleteGroup?cg_code=<?=$row['cg_code']?>" class="btn btn-danger" onclick="return confirm('코드를 삭제할 경우 시스템에 오류가 발생할 수 있으며 복구하실 수 없습니다.\n정말로 삭제하시겠습니까?');" target="formReceiver">삭제</a>
					</td>
				</tr>
				<?endforeach;?>
				<?endif;?>
			</tbody>
		</table>
	</div>


	
</div>
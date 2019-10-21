<div id="reply-form">
	<h2 class="title">카테고리</h2>

	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok"  target="formReceiver" >
	<input type="hidden" name="seq" value="<?=$reply['ecs_idx']?>" />

	<table class="table table-form" summary="후기 수정 폼">
		<caption>수정 폼</caption>
		<tbody>
			<tr>
			<tr>
				<th>카테고리</th>
				<td>
					<?
					// print_r($reply);
					// print_r($category_list);
					?>
					<select class="" name="ecs_eca_idx">
						<option value="">선택</option>
						<?foreach($category_list as $tk=>$tv):?>
						<?
							if($tv['eca_idx'] == $reply['ecs_eca_idx'] ) $eca_seleted = 'selected';
							else $eca_seleted = '';
						?>
						<option value="<?=$tv['eca_idx']?>" <?=$eca_seleted?>><?=$tv['eca_name']?></option>
						<?endforeach?>
					</select>
				</td>
			</tr>
			<tr>
				<th>순서</th>
				<td>
					<input type="text" name="ecs_order" value="<?=$reply['ecs_order']?>" required="required"/>
				</td>
			</tr>
			<tr>
				<th>이름</th>
				<td>
					<input type="text" name="ecs_name" value="<?=$reply['ecs_name']?>" required="required"/>
				</td>
			</tr>
			<tr>
				<th>메뉴오픈</th>
				<td>
					<select name="ecs_open_menu">
						<option value="Y" <?if($reply['ecs_open_menu'] == 'Y'):?>selected="selected"<?endif;?>>Y</option>
						<option value="N" <?if($reply['ecs_open_menu'] == 'N'):?>selected="selected"<?endif;?>>N</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>


	<div class="btn-area-center">
		<input type="submit" value="저장" class="btn btn-primary" />
		<input type="button" value="창닫기" class="btn btn-default" onclick="self.close();"/>
	</div>
</div>

</form>

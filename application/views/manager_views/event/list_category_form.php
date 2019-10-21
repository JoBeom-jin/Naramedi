<div id="reply-form">
	<h2 class="title">카테고리</h2>

	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok"  target="formReceiver" >
	<input type="hidden" name="seq" value="<?=$reply['eca_idx']?>" />

	<table class="table table-form" summary="후기 수정 폼">
		<caption>수정 폼</caption>
		<tbody>
			<tr>
			<tr>
				<th>순서</th>
				<td>
					<input type="text" name="eca_order" value="<?=$reply['eca_order']?>" required="required"/>
				</td>
			</tr>
			<tr>
				<th>이름</th>
				<td>
					<input type="text" name="eca_name" value="<?=$reply['eca_name']?>" required="required"/>
				</td>
			</tr>
			<tr>
				<th>메뉴오픈</th>
				<td>
					<select name="eca_open_menu">
						<option value="N" <?if($reply['eca_open_menu'] == 'N'):?>selected="selected"<?endif;?>>N</option>
						<option value="Y" <?if($reply['eca_open_menu'] == 'Y'):?>selected="selected"<?endif;?>>Y</option>
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

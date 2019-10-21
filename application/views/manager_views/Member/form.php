<div id="member_insert">	
	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver" id="member_form">
		<?if($act == 'updateMember'):?>
		<input type="hidden" name="me_seq" value="<?=$member['me_seq']?>" />
		<?endif;?>

		<h2 class="title">회원 등록</h2>
		<table summary="회원등록 폼" class="table table-form">
			<caption>회원등록 폼</caption>

			<colgroup>
				<col width="40%" />
				<col width="60%" />
			</colgroup>

			<tbody>
				<tr>
					<th>아이디</th>
					<td>
						<input type="text" value="<?=$member['me_id']?>" name="me_id" title="아이디" <?if($act == 'updateMember'):?>readonly="readonly"<?endif;?>/>
					</td>
				</tr>
				<tr>
					<th>이름</th>
					<td><input type="text" value="<?=$member['me_name']?>" name="me_name" title="이름" /></td>
				</tr>				
				<tr>
					<th>비밀번호</th>
					<td>
						<input type="password" value="" name="me_pass" title="비밀번호" placeholder="<?if($act == 'updateMember'):?>비밀번호 변경시에만 입력하세요.<?endif;?>"/>
					</td>
				</tr>
				<tr>
					<th>비밀번호확인</th>
					<td>
						<input type="password" value="" name="me_pass_check" title="비밀번호" />
					</td>
				</tr>
				<tr>
					<th>지정할 수 있는 그룹</th>
					<th>지정된 그룹</th>
				</tr>
				<tr>
					<td>
						
						<select size="5" id="availableGroupList" class="dklist">
						<?foreach($group_list as $k => $group):?>
							<?if(!in_array($group['gr_id'], $ingroup_list)):?>
							<option value="<?=$group['gr_id']?>"><?=$group['gr_name']?></option>						
							<?endif;?>							
						<?endforeach;?>
						</select>
					</td>
					<td>						
						<select size="5" id="memberGroupList"  class="dklist">
						<?foreach($group_list as $k => $group):?>
							<?if(in_array($group['gr_id'], $ingroup_list)):?>
							<option value="<?=$group['gr_id']?>"><?=$group['gr_name']?></option>	
							<?endif;?>
						<?endforeach;?>
						</select>
					</td>
				</tr>
				<tr>					
					<td colspan="2" class="tcenter">
						<input type="submit" <?if($act == 'updateMember'):?> value="정보수정" <?else:?> value="정보등록" <?endif;?> class="btn btn-primary"/> &nbsp;<input type="button" value="닫기" onclick="self.close();" class="btn btn-danger"/>
					</td>
				</tr>				
			</tbody>
		</table>	
	</form>	
</div>
<script type="text/javascript">
	$(document).ready(function(){
		new movingselect($('#availableGroupList'),$('#memberGroupList'), $('#member_form'), 'groups' );			
	});
</script>
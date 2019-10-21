<div id="user-detail-form">
	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver" id="member_form">
		<?if($act == 'updateMember'):?>
		<input type="hidden" name="me_seq" value="<?=$member['me_seq']?>" />
		<?endif?>
		<h2 class="title">일반회원 등록</h2>

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
					<th>전화번호</th>
					<td>
						<input type="text" value="<?=$member_detail['md_phone']?>" name="md_phone" placeholder="숫자만 입력해주세요." title="전화번호" />
					</td>
				</tr>
				<tr>
					<th>생년월일</th>
					<td>
						<select name="year" title="생년 입력">
						<?$years = range(date('Y'), 1900)?>
						<?foreach($years as $v):?>
						<option value="<?=$v?>" <?if($v == $member_detail['year']):?>selected="selected"<?endif;?> ><?=$v?>년</option>
						<?endforeach;?>
						</select>

						<select name="month" title="월 입력">
						<?$months = range(1, 12);?>
						<?foreach($months as $v):?>
						<option value="<?=$v?>" <?if($v == $member_detail['month']):?>selected="selected"<?endif;?>><?=$v?>월</option>
						<?endforeach;?>
						</select>
						
						<select name="day" title="일 입력">
						<?$days = range(1, 31);?>
						<?foreach($days as $v):?>
						<option value="<?=$v?>" <?if($v == $member_detail['day']):?>selected="selected"<?endif;?>><?=$v?>일</option>
						<?endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<th>성별</th>
					<td>					
						<select name="md_gender" title="성별 선택">
						<?foreach($gender as $code => $v):?>						
						<option value="<?=$code?>" <?if($code == $member_detail['md_gender']):?>selected="selected"<?endif;?>><?=$v?></option>
						<?endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<th>예약건수</th>
					<td>
						<span style="color:red;">준비중입니다.</span>
					</td>
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
					<td colspan="2" class="tcenter">
						<input type="submit" <?if($act == 'updateMember'):?> value="정보수정" <?else:?> value="정보등록" <?endif;?> class="btn btn-primary"/> 

						<?if($act == 'updateMember'):?>
						&nbsp;<a href="<?=$menu_url?>/deleteMember/me_seq/<?=$member['me_seq']?>" target="formReceiver" onclick="return confirm('회원정보를 삭제하시겠습니까?\n삭제된 회원정보는 복구되지 않습니다.');" class="btn btn-danger">회원 삭제</a>
						<?endif?>

						&nbsp;<input type="button" value="닫기" onclick="self.close();" class="btn btn-default"/>
					</td>
				</tr>
			</tbody>
		</table>

	</form>
</div>

<?if($act == 'updateMember'):?>
<script type="text/javascript">
	var is_empty_pass = true;
	$('input[name="me_pass"]').on('input', function(){		
		if(is_empty_pass){
			if(!confirm('비밀번호를 변경하시겠습니까?')){
				$(this).val('');
			}
		}

		if($(this).val().length > 0) is_empty_pass = false;
		else is_empty_pass = true;
	});
</script>
<?endif?>
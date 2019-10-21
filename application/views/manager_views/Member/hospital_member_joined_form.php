<div id="hospital-form">
	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver" id="member_form" enctype="multipart/form-data">
		<?if($act == 'modify'):?>
		<input type="hidden" name="hi_seq" value="<?=$member['hi_seq']?>" />
		<?endif?>

		<?if($act == 'insertMember'):?>
		<h2 class="title">병원회원 등록</h2>
		<?else:?>
		<h2 class="title">병원회원 승인 폼</h2>
		<?endif;?>
		<input type="hidden" name="first_flag" id="first_flag" value="N" />

		<table summary="병원회원 등록 폼" class="table table-form">
			<caption>병원회원 등록 폼</caption>

			<colgroup>
				<col width="30%" />
				<col width="70%" />
			</colgroup>

			<tbody>
				<tr>
					<th>관리자아이디</th>
					<td>
						
						<input type="text" value="<?=$member['me_id']?>" name="me_id" title="아이디" <?if($act == 'insertMember'):?> required="required" <?else:?> disabled="disabled" class="disabled"<?endif;?>/>
					</td>				
				</tr>
				<tr>
					<th>검진기관명</th>
					<td>
						<input type="text" value="<?=$member['me_name']?>" name="me_name" title="검진기관명" <?if($act == 'insertMember'):?> required="required" <?else:?> disabled="disabled" class="disabled"<?endif;?>/>
					</td>
				</tr>			
				<tr>
					<th>검진기관번호</th>
					<td>
						<input type="text" value="<?=$member['hi_org_number']?>" name="hi_org_number"  title="검진기관번호" <?if($act == 'insertMember'):?> required="required" <?else:?> disabled="disabled" class="disabled"<?endif;?>/>
					</td>
				</tr>
				<tr>
					<th>검진기관명(오픈용)</th>
					<td>
						<input type="text" value="<?=$member['hi_open_name']?>" name="hi_open_name"  title="검진기관명(오픈용)" required="required"/>
					</td>
				</tr>
				<tr>
					<th>사업자번호</th>
					<td>
						<input type="text" value="<?=$member['hi_biz_number']?>" name="hi_biz_number"  title="사업자번호" required="required"/>
					</td>
				</tr>
				<tr>
					<th>담당자명</th>
					<td>
						<input type="text" value="<?=$member['hi_mng_name']?>" name="hi_mng_name"  title="담당자명" required="required"/>
					</td>
				</tr>
				<tr>
					<th>담당자전화번호</th>
					<td>
						<input type="text" value="<?=$member['hi_mng_phone']?>" name="hi_mng_phone"  title="담당자전화번호" required="required"/>
					</td>
				</tr>
				<tr>
					<th>담당자이메일</th>
					<td>
						<input type="text" value="<?=$member['hi_mng_email']?>" name="hi_mng_email"  title="담당자이메일" required="required"/>
					</td>
				</tr>
				<tr>
					<th>예약담당자 전화번호</th>
					<td>
						<input type="text" value="<?=$member['hi_revmng_phone']?>" name="hi_revmng_phone"  title="예약담당자 전화번호" required="required"/>
					</td>
				</tr>
				<tr>
					<th>사업자 등록증</th>
					<td>
						<?if($act == 'modify' && $member['image']):?>
						<a href="<?=$member['image']['url']?>?seq=<?=$member['hi_seq']?>" target="_blank"><?=$member['image']['hf_name']?></a>
						<?else:?>
						<input type="file" name="business_file" title="사업자 등록증 등록" />						
						<?endif;?>
					</td>
				</tr>

				<?if($act == 'insertMember'):?>
				<tr>
					<th>비밀번호</th>
					<td>
						<input type="password" value="" name="me_pass" title="비밀번호" />
					</td>
				</tr>
				<tr>
					<th>비밀번호 확인</th>
					<td>
						<input type="password" value="" name="me_pass_check" title="비밀번호 확인"/>
					</td>
				</tr>
				<?else:?>
				<tr>
					<th>병원구분</th>
					<td>
						<select title="병원구분 선택" name="hi_type">
							<?foreach($hi_types as $code => $v):?>
							<option value="<?=$code?>" <?if($code == $member['hi_type']):?>selected="selected" <?endif;?>><?=$v['cd_name']?></option>
							<?endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<th>할당전화번호</th>
					<td>						
						<input type="text" value="<?=$member['hi_system_phone']?>" name="hi_system_phone" title="할당전화번호" id="hi_system_phone" style="width:200px;" readonly="readonly"/>

						<?if($member['hi_system_phone']):?>
						<a href="<?=$menu_url?>/cancelPhone?seq=<?=$member['hi_seq']?>" class="btn btn-danger" target="formReceiver"/>전화번호 할당취소</a>
						<?else:?>
						<a href="<?=$menu_url?>/insertPhone?seq=<?=$member['hi_seq']?>" class="btn btn-default" target="formReceiver"/>전화번호 할당</a>
						<?endif;?>						
<!-- 						<?if($member['hi_system_phone']):?> -->
<!-- 						<input type="button" value="전화번호 할당취소" class="btn btn-danger" onclick="removePhonNumber(this.form);" /> -->
<!-- 						<?else:?> -->
<!-- 						<input type="button" value="전화번호 할당" class="btn btn-default" onclick="getPhoneNumber(this.form);"/> -->
<!-- 						<?endif;?>						 -->
					</td>
				</tr>

				<?endif;?>

				<tr>					
					<td colspan="4" class="tcenter">
						<?if($act == 'insertMember'):?>
						<input type="submit" value="등록" class="btn btn-primary"/> 
						<?else:?>
						<input type="submit" value="확인" class="btn btn-primary"/> 						
						<?endif;?>						
						&nbsp;<input type="button" value="창닫기" onclick="self.close();" class="btn btn-default"/>
					</td>
				</tr>
				
			</tbody>
		</table>	

	</form>

</div>

<?if($bizcall && !$member['hi_system_phone']):?>
<form method="post" action="?" id="bizcall">
	<input type="hidden" name="iid" value="<?=$bizcall['iid']?>" />
	<input type="hidden" name="rn" value="<?=$bizcall['rn']?>" />
	<input type="hidden" name="memo" value="<?=$member['hi_seq']?>" />
	<input type="hidden" name="auth" value="<?=$bizcall['auth']?>" />
</form>


<script type="text/javascript">
//비즈콜 호출 함수
function getPhoneNumber(frm){
	var target_url = "<?=$bizcall['json_url']?>";	
	var phone_ = $('#hi_system_phone');


	$.post(target_url, $('#bizcall').serialize() )
		.done(function(result){
			if(result.rt == 0){
				phone_.val(result.vn);
				frm.submit();				
			}else{
				alert('Run time error : [ code :  ' +result.rt+' ]'+ result.rs);
			}
	});
}
</script>
<?endif;?>

<?if($bizcall && $member['hi_system_phone']):?>
<form method="post" action="?" id="bizcall">
	<input type="hidden" name="iid" value="<?=$bizcall['iid']?>" />
	<input type="hidden" name="vn" value="<?=$bizcall['rn']?>" />
	<input type="hidden" name="rn" value=" " />
	<input type="hidden" name="auth" value="<?=$bizcall['auth']?>" />
</form>
<script type="text/javascript">
//비즈콜 호출 함수
function removePhonNumber(frm){
	var target_url = "<?=$bizcall['json_url']?>";	
	var phone_ = $('#hi_system_phone');
	var first_flag = $('#first_flag');

	$.post(target_url, $('#bizcall').serialize() )
		.done(function(result){
			if(result.rt == 0){
				phone_.val('');
				first_flag.val('Y');
				if(frm) frm.submit();				
			}else{
				alert('Run time error : [ code :  ' +result.rt+' ]'+ result.rs);
			}
	});
}
</script>

<?endif;?>
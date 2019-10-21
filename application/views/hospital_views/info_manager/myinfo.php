<div id="hospital-form">
	<form method="post" action="<?=$menu_url?>/modifyOk" target="formReceiver" id="member_form" enctype="multipart/form-data">
		<h2 class="title">병원정보 확인 폼</h2>

		<table summary="병원회원 확인 폼" class="table table-form">
			<caption>병원회원 확인 폼</caption>

			<colgroup>
				<col width="30%" />
				<col width="70%" />
			</colgroup>

			<tbody>
				<tr>
					<th>관리자아이디</th>
					<td>						
						<input type="text" value="<?=$myid?>" name="me_id" title="아이디" disabled="disabled" class="disabled" />
					</td>				
				</tr>
				<tr>
					<th>검진기관명</th>
					<td>
						<input type="text" value="<?=$myname?>" name="me_name" title="검진기관명" disabled="disabled" class="disabled" />
					</td>
				</tr>			
				<tr>
					<th>검진기관번호</th>
					<td>
						<input type="text" value="<?=$member['hi_org_number']?>" name="hi_org_number"  title="검진기관번호" disabled="disabled" class="disabled" />
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
						<?if( $member['image']['url'] ):?>
						<a href="<?=$member['image']['url']?>" target="_blank"><?=$member['image']['hf_name']?></a>
						<a href="<?=$menu_url?>/deleteFile" class="btn btn-danger" onclick="return confirm('등록된 사업자 등록증이 삭제됩니다. 다시 복구하실 수 없습니다.\n삭제하시겠습니까?');" target="formReceiver">사업자등록증 삭제</a>
						<?else:?>
						<input type="file" name="upload" value="" title="사업자 등록증" />
						<?endif;?>
					</td>
				</tr>

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
				

				<tr>					
					<td colspan="4" class="tcenter">
						<input type="submit" value="확인" class="btn btn-primary"/> 								&nbsp;<input type="button" value="창닫기" onclick="self.close();" class="btn btn-default"/>
					</td>
				</tr>
				
			</tbody>
		</table>	

	</form>

</div>
<div id="join_form">
	<form method="post" action="<?=$menu_url?>/insertOk" target="formReceiver" id="member_form" enctype="multipart/form-data">
		
		<h2 class="title">병원회원 등록</h2>		

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
						<input type="text" value="" name="me_id" title="아이디"/>
					</td>				
				</tr>
				<tr>
					<th>검진기관명</th>
					<td>
						<input type="text" value="" name="me_name" title="검진기관명"/>
					</td>
				</tr>			
				<tr>
					<th>검진기관번호</th>
					<td>
						<input type="text" value="" name="hi_org_number"  title="검진기관번호"/>
					</td>
				</tr>
				<tr>
					<th>검진기관명(오픈용)</th>
					<td>
						<input type="text" value="" name="hi_open_name"  title="검진기관명(오픈용)"/>
					</td>
				</tr>
				<tr>
					<th>사업자번호</th>
					<td>
						<input type="text" value="" name="hi_biz_number"  title="사업자번호"/>
					</td>
				</tr>
				<tr>
					<th>담당자명</th>
					<td>
						<input type="text" value="" name="hi_mng_name"  title="담당자명"/>
					</td>
				</tr>
				<tr>
					<th>담당자전화번호</th>
					<td>
						<input type="text" value="" name="hi_mng_phone"  title="담당자전화번호"/>
					</td>
				</tr>
				<tr>
					<th>담당자이메일</th>
					<td>
						<input type="text" value="" name="hi_mng_email"  title="담당자이메일"/>
					</td>
				</tr>
				<tr>
					<th>예약담당자 전화번호</th>
					<td>
						<input type="text" value="" name="hi_revmng_phone"  title="예약담당자 전화번호"/>
					</td>
				</tr>
				<tr>
					<th>사업자 등록증</th>
					<td>
						<input type="file" name="business_file" title="사업자 등록증 등록" />						
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
						<input type="submit" value="등록" class="btn btn-primary"/> 
					</td>
				</tr>
				
			</tbody>
		</table>	

	</form>
</div>
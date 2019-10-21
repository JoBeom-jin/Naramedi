<div id="hospital-form">
	
		<h2 class="title">병원회원 정보</h2>	

		<table summary="병원회원 정보 확인 폼" class="table table-form">
			<caption>병원회원 정보 확인 폼</caption>

			<colgroup>
				<col width="30%" />
				<col width="70%" />
			</colgroup>

			<tbody>
				<tr>
					<th>관리자아이디</th>
					<td>						
						<?=$member['me_id']?>
					</td>				
				</tr>
				<tr>
					<th>검진기관명</th>
					<td>
						<?=$member['me_name']?>
					</td>
				</tr>			
				<tr>
					<th>검진기관번호</th>
					<td>
						<?=$member['hi_org_number']?>
					</td>
				</tr>
				<tr>
					<th>검진기관명(오픈용)</th>
					<td>
						<?=$member['hi_open_name']?>
					</td>
				</tr>
				<tr>
					<th>사업자번호</th>
					<td>
						<?=$member['hi_biz_number']?>
					</td>
				</tr>
				<tr>
					<th>담당자명</th>
					<td>
						<?=$member['hi_mng_name']?>
					</td>
				</tr>
				<tr>
					<th>담당자전화번호</th>
					<td>
						<?=$member['hi_mng_phone']?>
					</td>
				</tr>
				<tr>
					<th>담당자이메일</th>
					<td>
						<?=$member['hi_mng_email']?>
					</td>
				</tr>
				<tr>
					<th>예약담당자 전화번호</th>
					<td>
						<?=$member['hi_revmng_phone']?>
					</td>
				</tr>
				<tr>
					<th>사업자 등록증</th>
					<td>						
						<a href="<?=$member['image']['url']?>" target="_blank"><?=$member['image']['hf_name']?></a>						
					</td>
				</tr>
				
				<tr>
					<th>병원구분</th>
					<td>
						<?=$hi_types[$member['hi_type']]['cd_name']?>
					</td>
				</tr>
				<tr>
					<th>할당전화번호</th>
					<td>
						<?=$member['hi_system_phone']?>
					</td>
				</tr>

				<tr>					
					<td colspan="4" class="tcenter">
						<a href="<?=$menu_url?>/modify/seq/<?=$member['me_seq']?>" class="btn btn-primary">수정하기</a>
						&nbsp;<a href="<?=$menu_url?>/deleteOk/seq/<?=$member['me_seq']?>" class="btn btn-danger" target="formReceiver" onclick="return confirm('가입신청을 삭제하시겠습니까?\n계정과 연동된 협력병원정보도 모두 삭제됩니다.');">회원 삭제</a>
						&nbsp;<input type="button" value="창닫기" onclick="self.close();" class="btn btn-default"/>
					</td>
				</tr>
				
			</tbody>
		</table>	

	</form>

</div>
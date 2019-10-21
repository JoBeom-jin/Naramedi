<div id="hopital-list">	
	<h2 class="title">병원 회원</h2>

	<h3 class="title">등록된 병원 목록</h3>
	
	<table class="table table-list " summary="가입된 회원 정보를 목록형태로 보여줍니다." >
		<caption>회원 목록</caption>

		<colgroup>
			<col width="5%" />
			<col width="20%" />
			<col width="30%" />
			<col width="15%" />
			<col width="15%" />
			<col width="15%" />
		</colgroup>

		<thead>			
			<tr>
				<th>No</th>
				<th>아이디</th>
				<th>검진기관명</th>
				<th>검진기관번호</th>
				<th>담당자전화</th>
				<th>담당자이메일</th>
			</tr>
		</thead>
		<tbody>
			<?if(is_array($member_list) && count($member_list) > 0):?>
			<?foreach($member_list as $k => $member):?>
			<tr class="tcenter-all">
				<td>
					<?=$k+1?>
				</td>
				<td>
					<?=$member['me_id']?>
				</td>
				<td>
					<a href="<?=$menu_url?>/view/seq/<?=$member['me_seq']?>" onclick="window.open(this.href,'inertMember','width=650,height=820'); return false;"><?=$member['me_name']?></a>
				</td>
				<td><?=$member['hi_org_number']?></td>
				<td><?=$member['hi_mng_phone']?></td>
				<td><?=$member['hi_mng_email']?></td>							
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="6">※ 대기중인 병원회원이 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>
	</table>


	
</div>
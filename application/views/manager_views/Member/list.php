<h2 class="title">사용자 등록 및 관리</h2>
<div id="memberList">
	<div class="btn-area-left">
		<a href="<?=$menu_url?>/insertMember" onclick="window.open(this.href,'inertMember','width=500,height=550'); return false;" class="btn btn-primary">회원등록</a>
	</div>

	<h3 class="title">등록된 사용자 목록</h3>
	<table class="table table-list " summary="가입된 회원 정보를 목록형태로 보여줍니다." >
		<caption>회원 목록</caption>

		<colgroup>
			<col width="5%" />
			<col width="20%" />
			<col width="20%" />
			<col width="10%" />
			<col width="10%" />
			<col width="10%" />
			<col width="45%" />			
		</colgroup>

		<thead>			
			<tr>
				<th>#</th>
				<th>아이디</th>
				<th>이름</th>
				<th>별칭</th>
				<th>나이</th>
				<th>성별</th>
				<th>관리</th>
			</tr>
		</thead>
		<tbody>
			<?if(is_array($member_list) && count($member_list) > 0):?>
			<?foreach($member_list as $k => $member):?>
			<tr class="tcenter-all">
				<td><?=$k+1?></td>
				<td><?=$member['me_id']?></td>
				<td><?=$member['me_name']?></td>
				<td>-</td>
				<td>-</td>
				<td>-</td>				
				<td>
					<a href="<?=$menu_url?>/updateMember/me_seq/<?=$member['me_seq']?>" onclick="window.open(this.href,'inertMember','width=500,height=600'); return false;" class="btn btn-info">수정</a>
					<a href="<?=$menu_url?>/deleteMember/me_seq/<?=$member['me_seq']?>" onclick="return confirm('삭제된 회원 정보는 복구하실 수 없습니다. 정말로 삭제하시겠습니까?');" target="formReceiver" class="btn btn-danger">삭제</a>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
			</tr>
			<?endif;?>
		</tbody>
	</table>

</div>

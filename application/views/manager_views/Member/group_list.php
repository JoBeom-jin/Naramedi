<h2 class="title">사용자 그룹 추가 및 목록 확인</h2>
<div id="group-list">
	<form method="POST" action="<?=$menu_url?>/insertGroup" target="formReceiver" >
		<h3 class="title">그룹추가</h3>
		<table class="table table-small-form" style="width:800px;" summary="새로운 사용자 그룹을 추가합니다.">
			<caption>사용자 그룹 추가 폼</caption>
			<colgroup>
				<col width="15%" />
				<col width="20%" />
				<col width="15%" />
				<col width="20%" />
				<col width="30%" />
			</colgroup>
			<tbody>
				<tr>
					<th><label for="gr_id" >그룹 아이디</label></th>
					<td><input type="text" name="gr_id" value="" id="g_id"/></td>
					<th><label for="gr_name" >그룹 이름</label></th>
					<td><input type="text" name="gr_name" value="" id="g_name"/></td>
					<td>
						<input type="submit" value="그룹등록" class="btn btn-primary"/>
					</td>
				</tr>
			</tbody>
		</table>
	</form>


	<h3 class="title">그룹목록</h3>
	<table class="table table-list" summary="사용자 그룹의 이름, 코드 등을 리스트 형태로 보여줍니다.">
		<caption>사용자 그룹 목록</caption>
		<colgroup>
			<col width="10%" />
			<col width="35%" />
			<col width="35%" />
			<col width="20%" />
		</colgroup>
		<thead>
			<tr>
				<th>#NO</th>
				<th>그룹아이디</th>
				<th>그룹이름</th>
				<th>관리</th>
			</tr>
		</thead>
		<tbody>
			<?foreach($group_list as $k => $v):?>
			<tr>
				<td class="tcenter"><?=$k+1?></td>
				<td><?=$v['gr_id']?></td>
				<td><?=$v['gr_name']?></td>
				<td class="tcenter">
					<a href="<?=$menu_url?>/deleteGroup/id/<?=$v['gr_id']?>" target="formReceiver" onclick="return confirm('그룹 삭제시 시스템에 문제가 생길 수 있습니다. 정말로 삭제하시겠습니까?');" class="btn btn-danger">삭제</a>
				</td>
			</tr>
			<?endforeach;?>
		</tbody>
	</table>
</div>

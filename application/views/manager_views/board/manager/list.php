<div id="board_manager_list">
	<h2 class="title">게시판 관리</h2>

	<h3 class="title">신규 게시판 등록</h3>

	<form method="post" action="<?=$menu_url?>/createBoard" target="formReceiver">
		<table class="table table-form middle" summary="신규 게시판 등록 폼. 아이디와 이름을 입력하여 신규 게시판을 생성한다.">
			<caption>신규 게시판 등록 및 수정 폼</caption>
			<colgroup>
				<col width="18%" />
				<col width="auto" />
				<col width="17%" />
				<col width="auto" />
				<col width="10%" />
			</colgroup>
			<tbody>
				<th>게시판 아이디</th>
				<td>
					<input type="text" name="bc_id" value="" title="게시판 아이디" placeholder="영문, 숫자만 입력 가능합니다."/>
				</td>
				<th>
					게시판 이름
				</th>
				<td>
					<input type="text" name="bc_name" value="" title="게시판 이름" placeholder="게시판 이름은 심플하게......"/>
				</td>		
				<td>
					<input type="submit" value="게시판등록" class="btn btn-primary"/>
				</td>
			</tbody>
		</table>
	</form>
	
	<h3 class="title">등록된 게시판 목록</h3>

	<table class="table table-list" summary="등록된 게시판 목록을 보여주며, 추가/삭제 등의 기능 또한 제공합니다.">
		<caption>게시판 목록</caption>

		<colgroup>
			<col width="7%" />
			<col width="23%" />
			<col width="23%" />
			<col width="23%" />
			<col width="auto" />
		</colgroup>

		
		<thead>
			<tr>
				<th>순번</th>
				<th>게시판 아이디</th>
				<th>게시판명</th>
				<th>적용스킨</th>
				<th>기능</th>
			</tr>
		</thead>
		<tbody class="tcenter-all">
			<?if(count($list) > 0):?>
			<?foreach($list as $k => $b):?>
			<tr>
				<td><?=$k+1?></td>
				<td><?=$b['bc_id']?></td>
				<td><?=$b['bc_name']?></td>
				<td><?=$b['bc_skin1']?></td>
				<td>
					<a href="<?=$menu_url?>/modifyBoardConfig/id/<?=$b['bc_id']?>" onclick="window.open(this.href,'modify_<?=$b['bc_id']?>','width=750,height=800'); return false;" target="_blank" class="btn btn-primary">설정</a>
					<a href="<?=$menu_url?>/createBoardCategory/id/<?=$b['bc_id']?>"  class="btn btn-default" onclick="window.open(this.href,'category_<?=$b['bc_id']?>','width=750,height=800'); return false;" target="_blank" >카테고리설정</a>
				</td>
			</tr>			
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="5">※ 생성된 게시판이 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>
	</table>
</div>
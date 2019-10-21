<div id="board-form">
	<form method="post" action="<?=$menu_url?>?act=view" enctype="multipart/form-data">		
		<input type="hidden" name="seq" value="<?=$bd_seq?>" />
		<table class="table table-form" summary="패스워드 입력 폼 입니다.">
			<caption>게시판 글쓰기</caption>
			<colgroup>
				<col width="25%" />
				<col width="75%" />
			</colgroup>		
			<tbody>
				<tr>
					<td colspan="2" class="tcenter">
						<?if($wrong_password):?>						
						<span class="tdanger">※ 비밀번호가 올바르지 않습니다. 다시 시도해주세요.</span>
						<?else:?>
						※ 게시글 작성시 작성한 비밀번호를 입력해주세요.
						<?endif;?>
					</td>
				</tr>
				<tr>
					<th>비밀번호</th>
					<td>
						<input type="password" name="bd_pass" value="" title="패스워드 입력폼" />
					</td>
				</tr>
			</tbody>
		</table>

		<div class="btn-area-center">
			<input type="submit" value="완료" class="btn btn-primary" />
			<a href="<?=$menu_url?>" class="btn btn-default">목록으로</a>
		</div>
	</form>
</div>

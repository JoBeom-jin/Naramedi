<div id="reply-form">
	<h2 class="title">후기 수정</h2>

	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok"  target="formReceiver" >
	<input type="hidden" name="seq" value="<?=$reply['ac_seq']?>" />

	<table class="table table-form" summary="후기 수정 폼">
		<caption>후기 수정 폼</caption>
		<tbody>
			<tr>
				<th>기관이름</th>
				<td>
					<?=$reply['ai_name']?>
				</td>
			</tr>
			<tr>
				<th>작성자</th>
				<td>
					<?=$reply['me_name']?>
				</td>
			</tr>
			<tr>
				<th>내용</th>
				<td>
					<input type="text" name="ac_comment" value="<?=$reply['ac_comment']?>" title="후기내용" required="required"/>
				</td>
			</tr>
			<tr>
				<th>진료만족도</th>
				<td>
					<input type="text" name="ac_jin" value="<?=number_format($reply['ac_jin'])?>" title="진료만족도" style="width:100px;"/>
				</td>
			</tr>
			<tr>
				<th>시설만족도</th>
				<td>
					<input type="text" name="ac_kind" value="<?=number_format($reply['ac_kind'])?>" title="시설만족도" style="width:100px;" />
				</td>
			</tr>
			<tr>
				<th>친절만족도</th>
				<td>
					<input type="text" name="ac_obj" value="<?=number_format($reply['ac_obj'])?>" title="친절만족도" style="width:100px;"/>
				</td>
			</tr>
		</tbody>
	</table>

	<div class="btn-area-center">
		<input type="submit" value="수정" class="btn btn-primary" />
		<input type="button" value="창닫기" class="btn btn-default" onclick="self.close();"/>
	</div>
</div>
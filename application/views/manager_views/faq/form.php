<h2 class="title">사용자 질문에 답변하기</h2>

<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">
	<input type="hidden" name="uq_seq" value="<?=$question['uq_seq']?>" />

	<table class="table table-form" summary="답변하기 폼">
		<caption>답변하기 폼</caption>
		<colgroup>
			<col width="25%" />
			<col width="75%" />
		</colgroup>
		<tbody>
			<tr>
				<th>등록자ID</th>
				<td><?=$question['uq_meid']?></td>
			</tr>
			<tr>
				<th>등록일</th>
				<td><?=date('Y. m. d H:i', $question['uq_ctime'])?></td>
			</tr>
			<tr>
				<th>질문제목</th>
				<td>
					<?=$question['uq_subject']?>
				</td>
			</tr>
			<tr>
				<th>질문내용</th>
				<td>
					<?=nl2br($question['uq_question'])?>
				</td>
			</tr>
			<tr>
				<th>답변내용</th>
				<td>
					<textarea name="uq_answer" rows="6" style="height:100px;"><?=$question['uq_answer']?></textarea>
				</td>
			</tr>
			<tr>
				<th>답변시각</th>
				<td>
					<?if($question['uq_an_ctime']):?>
					<?=date('Y. m. d H:i', $question['uq_an_ctime'])?>
					<?else:?>
					<span class="tdanger">답변없음</span>
					<?endif;?>
				</td>
			</tr>
			<tr>
				<th>답변자ID</th>
				<td>
					<?if($question['uq_an_meid']):?>
					<?=$question['uq_an_meid']?>
					<?else:?>
					<span class="tdanger">답변없음</span>
					<?endif;?>
				</td>
			</tr>
		</tbody>
	</table>

	<div class="btn-area-center">
		<input type="submit" value="답변등록" class="btn btn-primary" />
		<input type="button" value="창닫기" class="btn btn-default" onclick="self.close();" />
	</div>
</form>
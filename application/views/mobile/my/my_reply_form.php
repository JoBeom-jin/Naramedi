<section class="container" id="my-reply-form">
	<div class="">
		<header>
			<h1 class="page-title">후기 내용 수정</h1>
		</header>

		<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">
		<input type="hidden" name="seq" value="<?=$reply['ac_seq']?>" />

		<table class="table table-form" summary="작성후기 내용 변경">
			<caption class="hide">작성후기 내용 변경</caption>
			<tbody>
				<tr>
					<th>기관</th>
					<td>
						<?=$reply['ai_name']?>
					</td>
				</tr>
				<tr>
					<th>후기내용</th>
					<td>
						<input type="text" name="ac_comment" value="<?=$reply['ac_comment']?>" title="후기내용" required="required"/>
					</td>
				</tr>
				<tr>
					<th>진료만족도</th>
					<td>
						<input type="text" name="ac_jin" value="<?=number_format($reply['ac_jin'])?>" title="진료만족도" style="width:100px;" <?if(!$can_star):?>readonly="readonly"<?endif;?>/>
					</td>
				</tr>
				<tr>
					<th>시설만족도</th>
					<td>
						<input type="text" name="ac_kind" value="<?=number_format($reply['ac_kind'])?>" title="시설만족도" style="width:100px;" <?if(!$can_star):?>readonly="readonly"<?endif;?>/>
					</td>
				</tr>
				<tr>
					<th>친절만족도</th>
					<td>
						<input type="text" name="ac_obj" value="<?=number_format($reply['ac_obj'])?>" title="친절만족도" style="width:100px;" <?if(!$can_star):?>readonly="readonly"<?endif;?>/>
					</td>
				</tr>
			</tbody>
		</table>
		<div style="margin:10px 0; text-align:center;">
			<input type="submit" value="수정" class="btn btn-default" style="background-color: #e3e3e3; color:black;"/>
			<a href="<?=$menu_url?>/deleteOk?seq=<?=$reply['ac_seq']?>" target="formReceiver" class="btn btn-default" onclick="return confirm('삭제된 데이터는 복구하실 수 없습니다. 삭제하시겠습니까?');">삭제</a>
		</div>
	</form>
	</div>
</section>
<div class="btn-area-right">
	
	<?if($_auth_modify):?>
	<a href="<?=$menu_url?>?act=modify&amp;seq=<?=$article['bd_seq']?>" class="btn btn-primary">수정하기</a>
	<?endif;?>

	<?if($_auth_delete):?>
	<a href="<?=$menu_url?>?act=delete&amp;seq=<?=$article['bd_seq']?>" class="btn btn-danger" onclick="return confirm('삭제된 데이터는 복구하실 수 없습니다. 삭제하시겠습니까?');"  >삭제하기</a>		
	<?endif;?>

	<a href="<?=$menu_url?>" class="btn btn-default">목록으로</a>
</div>
<div id="board-view">
	<table class="table table-form" summary="게시판 글쓰기 폼입니다.">
		<caption>게시판 글쓰기</caption>

		<colgroup>
			<col width="25%" />
			<col width="75%" />
		</colgroup>

		<tbody>				
			<tr>	
				<th>
					제목
				</th>
				<td>
					<?=$article['bd_subject']?>
				</td>
			</tr>

			<?if($article['bd_notice_flag'] == 'Y'):?>
			<tr>
				<th>공지사항</th>
				<td>이 글은 공지사항으로 목록 상단에 표시됩니다.</td>
			</tr>
			<?endif;?>

			<?if($article['bd_lock_flag'] == 'Y'):?>
			<tr>
				<th>비밀글</th>
				<td>이 글은 관리자와 글쓴이 자신만 확인할 수 있습니다.</td>
			</tr>
			<?endif;?>		
			

			<?if(count($categories) > 0):?>
			<tr>
				<th>
					분류
				</th>
				<td>
					<?if(array_key_exists($article['bd_bdcseq'], $categories)):?>
					<?=$categories[$article['bd_bdcseq']]['bdc_name']?>
					<?endif;?>
				</td>
			</tr>
			<?endif;?>
			<tr>
				<th>
					작성자
				</th>
				<td>
					<?=$article['bd_name']?>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<?$img_max_width = 1024;?>
					<?if(count($article['files']) > 0):?>										
					<?for($i=0, $j=count($article['files']) ; $i < $j ; $i++):?>
						<?$file = $article['files'][$i];?>

						<?if(in_array(strtolower($file['bf_ext']), array('jpg', 'gif', 'png', 'jpeg'))):?>
						<div class="image-list">
							<img src="<?=$file['url']?>" alt="" <?if($file['bf_width'] > $img_max_width):?>style="width:100%;"<?endif;?>/>
						</div>
						<?endif;?>
					<?endfor;?>						
					<?endif;?>

					<?=$article['bd_content']?>
				</td>
			</tr>

			<?if(count($article['files']) > 0):?>	
			<?for($i=0, $j=count($article['files']) ; $i < $j ; $i++):?>
			<tr>
				<th>첨부파일</th>
				<td>
					
					<?$file = $article['files'][$i];?>
					<?=$file['bf_name']?> &nbsp; <a href="<?=$menu_url?>?act=downFile&amp;seq=<?=$file['bf_serial']?>&amp;bd_seq=<?=$article['bd_seq']?>" target="formReceiver" class="btn btn-default">다운로드</a>					
				</td>
			</tr>
			<?endfor;?>
			<?endif;?>


			<?if(count($article['links']) > 0):?>	
			<?for($i=0, $j=count($article['links']) ; $i < $j ; $i++):?>
			<tr>
				<th>첨부링크</th>
				<td>
					
					<?$link = $article['links'][$i];?>
					http://<a href="http://<?=$link['bl_url']?>" target="_blank"><?=$link['bl_url']?></a>
				</td>
			</tr>
			<?endfor;?>
			<?endif;?>
		</tbody>
	</table>

	<?if($_config['bc_reply_flag'] == 'Y'):?>
	<form method="post" action="<?=$menu_url?>/<?=$act?>?act=insertReply" target="formReceiver" id="reply-form">
		<input type="hidden" name="pseq" value="" />
		<table class="table table-list" summary="댓글 입력 폼 입니다.">
			<caption>댓글 입력 폼</caption>
			<?if(is_array($reply_list) && count($reply_list) > 0):?>
			<tbody>	
				<?foreach($reply_list as $k => $v):?>
				<?$left_padding = (strlen($v['br_depth'])-1)*30;?>
				<tr>						
					<td colspan="2" style="padding-left:<?=$left_padding?>px">
						<div>
							<span class="strong"><?=$v['br_cname']?></span> &nbsp; <span><?=date('Y.m.d', $v['br_ctime'])?></span>
							<span><a href="#reply-form" onclick="return rereply(<?=$v['br_seq']?>);">[댓글]</a></span>
						</div>
						<p class="reply-area"><?=nl2br($v['br_comment'])?></p>
					</td>
				</tr>
				<?endforeach;?>
			</tbody>
			<?endif;?>

			<tfoot>
				<tr>
					<th class="strong tcenter">
						댓글
					</th>
					<td>
						<textarea class="reply-textarea" name="br_comment" value="" title="댓글을 입력합니다." maxlength="200"></textarea>
						<input type="submit" value="댓글쓰기" class="btn btn-default submit-btn" />
					</td>
				</tr>
			</tfoot>
		</table>
	</form>	
	<?endif;?>
</div>

<script type="text/javascript">
	function rereply(br_seq){
		$('input[name="pseq"]').val(br_seq);
		$('textarea[name="br_comment"]').attr('placeholder','대댓글이 입력됩니다. 댓글 메너를 지켜주세요.');
	}
</script>
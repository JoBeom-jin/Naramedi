<div id="board-form">
	<form method="post" action="<?=$menu_url?>?act=<?=$bact?>Ok" enctype="multipart/form-data" target="formReceiver">
		<input type="hidden" name="bd_bcid" value="<?=$bcid?>" />
		<input type="hidden" name="bd_html_flag" value="<?=$bd_html_flag?>" />

		<?if($bact == 'modify'):?>
		<input type="hidden" name="bd_seq" value="<?=$article['bd_seq']?>" />
		<?endif;?>

		<?if($_config['bc_lock_flag'] == 'A'):?>
		<input type="hidden" name="bd_lock_flag" value="Y" />
		<?elseif($_config['bc_lock_flag'] == 'N'):?>		
		<input type="hidden" name="bd_lock_flag" value="N" />
		<?endif;?>
		
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
						<input type="text" name="bd_subject" value="<?=$article['bd_subject']?>" placeholder="제목을 입력해주세요." />
					</td>
				</tr>
				<?if($_config['bc_notice_flag'] == 'Y'):?>
				<tr>
					<th>공지사항</th>
					<td>
						<input type="checkbox" name="bd_notice_flag" value="Y" title="공지사항 체크" id="notice_flag" <?if($article['bd_notice_flag'] == 'Y'):?>checked="checked"<?endif;?> />
						<label for="notice_flag">체크시 공지사항으로 등록합니다.</label>
					</td>
				</tr>
				<?endif;?>

				
				<?if($_config['bc_lock_flag'] == 'Y'):?>
				<tr>
					<th>비밀글</th>
					<td>
						<input type="checkbox" name="bd_lock_flag" value="Y" id="bd_lock_flag" <?if($article['bd_lock_flag'] == 'Y'):?>checked="checked"<?endif;?>/>
						<label for="bd_lock_flag">체크시 관리자와 자신만 확인할 수 있습니다.</label> 
					</td>
				</tr>				
				<?endif;?>

				<?if(count($categories) > 0):?>
				<tr>
					<th>
						카테고리
					</th>
					<td>
						<select name="bd_bdcseq" title="카테고리를 선택">
						<?foreach($categories as $k => $v):?>
						<option value="<?=$v['bdc_seq']?>" <?if($article['bd_bdcseq'] == $v['bdc_seq']):?>selected="selected"<?endif;?>><?=$v['bdc_name']?></option>
						<?endforeach;?>
						</select>
					</td>
				</tr>
				<?endif;?>
				<tr>
					<th>
						작성자
					</th>
					<td>
						<input type="text" name="bd_name" value="<?=$article['bd_name']?>" title="작성자 이름을 등록합니다." />
					</td>
				</tr>

				<tr>
					<td colspan="2">						
						<textarea name="bd_content" style="width:99%; margin:0 auto; height:600px;" id="bd_content"><?=$article['bd_content']?></textarea>
					</td>
				</tr>	
				

				<?$file_num = count($files);?>
				<?if($file_num > 0):?>
				<?foreach($files as $k => $f):?>
				<tr>
					<th>첨부파일</th>
					<td>					
						<?=$f['bf_name']?> &nbsp; <a href="<?=$menu_url?>?act=deleteFile&amp;seq=<?=$f['bf_serial']?>&amp;bd_seq=<?=$article['bd_seq']?>" target="formReceiver" onclick="return confirm('삭제된 파일은 복구하실 수 없습니다. 삭제하시겠습니까?');" class="btn btn-danger">삭제</a>
					</td>
				</tr>
				<?endforeach;?>				
				<?endif;?>
				<?for($i = 0, $j = $_config['bc_file_cnt']-$file_num; $i < $j ; $i++):?>
				<tr>
					<th>첨부파일</th>
					<td>
						<input type="file" name="upload_file_<?=$i?>" title="첨부파일 등록" />						
					</td>
				</tr>
				<?endfor;?>



				<?$link_num = count($links);?>
				<?if($link_num > 0):?>
				<?foreach($links as $k => $v):?>
				<tr>
					<th>첨부링크</th>
					<td>
						http://<?=$v['bl_url']?>
						&nbsp; <a href="<?=$menu_url?>?act=deleteLink&amp;seq=<?=$v['bl_seq']?>&amp;bd_seq=<?=$article['bd_seq']?>" target="formReceiver" class="btn btn-danger" onclick="return confirm('삭제된 데이터는 복구할 수 없습니다. 삭제하시겠습니까?');">삭제</a>
					</td>
				</tr>
				<?endforeach;?>
				<?endif;?>

				<?for($i = 0, $j = $_config['bc_link_cnt']-$link_num; $i < $j ; $i++):?>
				<tr>
					<th>첨부링크</th>
					<td>
						<input type="text" name="bd_links[]" title="링크 등록" />						
					</td>
				</tr>
				<?endfor;?>

			</tbody>
		</table>

		<div class="btn-area-center">
			<input type="submit" value="완료" class="btn btn-primary" />

			<?if($bact == 'modify'):?>
			<a href="<?=$menu_url?>?act=view&amp;seq=<?=$article['bd_seq']?>" class="btn btn-default">돌아가기</a>
			<?else:?>
			<a href="<?=$menu_url?>" class="btn btn-default">돌아가기</a>
			<?endif;?>			
		</div>
	</form>
</div>

<?if($use_editor == 'Y'):?>
<script type="text/javascript" src="/resource/plugin/ckeditor/ckeditor.js" ></script>
<script type="text/javascript" src="/resource/plugin/ckeditor/config.js" ></script>
<script type="text/javascript">	
	CKEDITOR.replace('bd_content');	
</script>
<?endif;?>

<div id="banner-form">
	<h3 class="title">배너 등록 폼</h3>
	
	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver"  enctype="multipart/form-data">
		<?if($act=='updateBanner'):?>
		<input type="hidden" name="eb_seq" value="<?=$eb_seq?>" />
		<?endif;?>
		<table class="table table-form" summary="배너 등록 폼 입니다.">
			<caption>배너 등록폼</caption>
			<tbody>
				<tr>
					<th>제목</th>
					<td>
						<input type="text" name="eb_subject" value="<?=$banner['eb_subject']?>" title="배너 제목"  />
					</td>
				</tr>
				<tr>
					<th>이미지</th>
					<td>
						<?if(is_file($banner['eb_file_path'])):?>
						<img src="<?=path2url_($banner['eb_file_path'])?>" alt="배너 이미지" style="width:150px;" />
						<a href="<?=$menu_url?>/deleteImage?seq=<?=$banner['eb_seq']?>" style="color:red;" target="formReceiver">[이미지 삭제]</a>
						<?else:?>
						<input type="file" name="upload" title="배너 이미지" />
						<?endif;?>
					</td>
				</tr>
				<tr>
					<th>정렬순서</th>
					<td>
						<input type="text" name="eb_sort" value="<?=$banner['eb_sort']?>" title="정렬순서" maxlength="5" class="tiny"/>
						<span class="tdanger">※ 숫자가 높을 수록 먼저 표시됩니다.</span>
					</td>
				</tr>
				<tr>
					<th>사용여부</th>
					<td>
						<select name="eb_use_flag" title="사용여부 선택">
							<option value="Y" <?if($banner['eb_use_flag'] == 'Y'):?>selected="selected"<?endif;?> >사용함</option>
							<option value="N" <?if($banner['eb_use_flag'] == 'N'):?>selected="selected"<?endif;?> >사용안함</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>링크</th>
					<td>
						<input type="text" name="eb_link" value="<?=$banner['eb_link']?>" title="링크입력" />
					</td>
				</tr>
			</tbody>
		</table>
		<div class="btn-area-center">
			<input type="submit" <?if($act=='updateBanner'):?>value="수정완료"<?else:?>value="배너등록"<?endif;?> class="btn btn-primary" />
			<input type="button" value="창닫기" onclick="self.close();" class="btn btn-default"/>
		</div>
	</form>
</div>
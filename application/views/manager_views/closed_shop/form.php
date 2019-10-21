<div id="close-shop-form">
	<h3 class="title">폐쇄몰 등록 및 수정 폼</h3>

	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver" enctype="multipart/form-data"  id="close_mall_form">
		<?if($act == 'updateShop'):?>
		<input type="hidden" name="cs_seq" value="<?=$shop['cs_seq']?>" />
		<?endif;?>
		<table class="table table-form" summary="폐쇄몰 등록 및 수정 폼">
			<caption>폐쇄몰 폼</caption>
			<tbody>
				<tr>
					<th>업체명</th>
					<td>
						<input type="text" name="cs_name" value="<?=$shop['cs_name']?>" title="업체명" />
					</td>
				</tr>
				<tr>
					<th>업체로고</th>
					<td>
						<?if(is_file($shop['cs_file_path'])):?>
						<img src="<?=path2url_($shop['cs_file_path']);?>" alt="로고 이미지" style="width:100px;" />
						<a href="<?=$menu_url?>/deleteImage?seq=<?=$shop['cs_seq']?>" style="color:red;" target="formReceiver">[이미지삭제]</a>
						<?else:?>
						<input type="file" name="upload" title="업체로고 이미지 등록" />
						<?endif;?>
					</td>
				</tr>
				<tr>
					<th>관리자 전체 목록</th>
					<th>관리자 지정 목록</th>
				</tr>
				<tr>
					<td>
						<select size="5" id="closeMallMangerList" class="dklist">
						<?foreach($CMManagerList as $tk => $tv):?>
							<?if(!in_array($tk, $inCMManagerList)):?>
							<option value="<?=$tk?>"><?=$tv?></option>
							<?endif;?>
						<?endforeach;?>
						</select>
					</td>
					<td>
						<select size="5" id="thisManagerList"  class="dklist">
							<?foreach($CMManagerList as $tk => $tv):?>
								<?if(in_array($tk, $inCMManagerList)):?>
								<option value="<?=$tk?>"><?=$tv?></option>
								<?endif;?>
							<?endforeach;?>
						</select>
					</td>
				</tr>

			</tbody>
		</table>
		<div class="btn-area-center">
			<input type="submit" value="등록하기" class="btn btn-primary"/>
			<input type="button" value="창닫기" onclick="self.close();" class="btn btn-default"/>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		new movingselect($('#closeMallMangerList'),$('#thisManagerList'), $('#close_mall_form'), 'groups' );
	});
</script>

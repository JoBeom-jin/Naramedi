<h2 class="title">카테고리 추가/수정/삭제</h2>

<?if(!$modify):?>
<h3 class="title">신규 카테고리 추가</h3>
<?else:?>
<h3 class="title">기존 카테고리 수정</h3>
<?endif;?>

<form method="post" action="<?=$menu_url?>/updateBoardCategory" target="formReceiver">
	
	<input type="hidden" name="bdc_bcid" value="<?=$bc_id?>" />
	<?if($modify):?>
	<input type="hidden" name="bdc_seq" value="<?=$modify['bdc_seq']?>" />
	<?endif;?>

	<table class="table table-form" summary="신규 카테고리 등록 혹은 기존 카테고리 수정 폼">
		<caption>카테고리 등록/수정</caption>
		
		<colgroup>			
		</colgroup>		
		<tbody>
			<tr class="tcenter-all">							
				<td>
					<input type="text" name="bdc_name" value="<?if($modify):?><?=$modify['bdc_name']?><?endif;?>" placeholder="카테고리 이름을 입력하세요."/>
				</td>
				<td>
					<?if(!$modify):?>
					<input type="submit" value="등록" class="btn btn-primary"/>
					<?else:?>
					<input type="submit" value="수정" class="btn btn-primary"/>
					<a href="<?=$menu_url?>/<?=$act?>/id/<?=$bc_id?>" class="btn btn-default">취소</a>
					<?endif;?>
				</td>
			</tr>
		</tbody>
	</table>
</form>


<h3 class="title">카테고리 목록</h3>
<div id="category-form">
	<table class="table table-list" summary="게시판에서 사용하는 카테고리 목록입니다.">
		<caption>카테고리 목록</caption>

		<colgroup>
			<col width="5%" />
			<col width="55%" />
			<col width="40%" />
		</colgroup>
		<thead>
			<tr>
				<th>NO</th>
				<th>이름</th>
				<th>관리</th>
			</tr>
		</thead>
		<tbody>
			<?if(is_array($list) && count($list) > 0):?>
			<?foreach($list as $k => $c):?>
			<tr>
				<td class="tcenter"><?=$c['bdc_seq']?></td>
				<td>
					<?=$c['bdc_name']?>
				</td>
				<td class="tcenter">
					<a href="<?=$menu_url?>/<?=$act?>/id/<?=$bc_id?>?bdc_seq=<?=$c['bdc_seq']?>" class="btn btn-primary">수정</a>
					<a href="<?=$menu_url?>/reSorting/id/<?=$bc_id?>?bdc_seq=<?=$c['bdc_seq']?>&amp;op=up" target="formReceiver" class="btn btn-default">위로</a>
					<a href="<?=$menu_url?>/reSorting/id/<?=$bc_id?>?bdc_seq=<?=$c['bdc_seq']?>&amp;op=down" target="formReceiver" class="btn btn-default">아래로</a>
					<a href="<?=$menu_url?>/deleteCategory?bdc_seq=<?=$c['bdc_seq']?>" target="formReceiver" class="btn btn-danger">삭제</a>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="5">※ 등록된 카테고리 정보가 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>
	</table>
</div>
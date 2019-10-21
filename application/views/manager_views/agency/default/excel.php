<h2 class="title">등록된 엑셀 리스트</h2>

<div id="excel-list">
	<h3 class="title">엑셀 파일 리스트</h3>
	
	<table class="table table-list " summary="엑셀 파일 목록 입니다." >
		<caption>회원 목록</caption>

		<colgroup>
			<col width="5%" />
			<col width="AUTO" />
			<col width="10%" />			
		</colgroup>

		<thead>			
			<tr>
				<th>NO</th>
				<th>파일명</th>
				<th>관리</th>
			</tr>
		</thead>

		<tbody>
			<?foreach($filelist as $k => $file_name):?>
			<tr>
				<td class="tcenter"><?=$k+1?></td>
				<td><?=$file_name?></td>
				<td class="tcenter">
					<a href="<?=$menu_url?>/<?=$act?>Ok?file=<?=basename($file_name)?>" class="btn btn-default" target="formReceiver">DB로전달</a>
				</td>
			</tr>
			<?endforeach;?>
		</tbody>
	</table>	
</div>
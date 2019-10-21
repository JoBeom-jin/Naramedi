<? include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'_tab.php'?>

<h3 class="title">검색할 로그 테이블을 선택합니다.</h3>
<form method="get" action="<?=$menu_url?>/<?=$act?>" >
	<table class="table table-form" summary="검색할 로그 테이블 선택">
		<caption>검색 로그 테이블</caption>
		<colgroup>
			<col width="20%" />
			<col width="" />
		</colgroup>
		<tbody>
			<tr>
				<td class="tcenter">검색할 테이블 선택(Msg_Log_년월)</td>
				<td>
					<select name="select" title="검색할 테이블 선택">
						<?foreach($tables as $k => $v):?>
						<option value="<?=$v?>" <?if($v == $select):?>selected="selected"<?endif;?> ><?=$v?></option>
						<?endforeach;?>
					</select>
					<input type="submit" value="로그검색" class="btn btn-default" />
				</td>
			</tr>
		</tbody>
	</table>
</form>

<h3 class="title">로그 목록</h3>
<table class="table table-list tcenter-all" summary="선택된 테이블의 로그 목록입니다.">
	<caption>로그 목록</caption>
	<colgroup>
		
	</colgroup>
	<thead>
		<tr>
			<th>ID</th>
			<th>착신번호</th>
			<th>발신번호</th>
			<th>상태</th>
			<th>Type</th>
			<th>발신시간</th>
			<th>제목</th>
			<th style="width:450px;">메세지</th>
			<th>KKO 프로필키 / KKO 탬플릿</th>
			<th>첨부파일수</th>
			<th>발송아이디</th>
			<th>결과</th>
			<th>착신시간</th>
		</tr>
	</thead>
	<tbody>
		<?if(is_array($list) && count($list) > 0):?>
		<?foreach($list as $k => $v):?>
		<tr>
			<td><?=$v['Msg_Id']?></td>
			<td><?=$v['Phone_No']?></td>
			<td><?=$v['Callback_No']?></td>
			<td><?=$v['Status']?></td>
			<td><?=$v['Msg_Type']?></td>
			<td><?=$v['Send_Time']?></td>
			<td><?=$v['Subject']?></td>
			<td><?=$v['Message']?></td>
			<td>
				<?if($v['Kakao_Sender_Key']):?>
				<span class="btn btn-default"><?=$v['Kakao_Sender_Key']?></span><br/>
				<?endif;?>
				<?if($v['Kakao_Template_Code']):?>
				<span class="btn btn-primary"><?=$v['Kakao_Template_Code']?></span>
				<?endif;?>
			</td>
			<td><?=$v['File_Count']?></td>
			<td><?=$v['Tran_Id']?></td>
			<td>
				<?if($v['Result'] = 0):?>
				<?=$v['Result']?>
				<?else:?>
				<span class="tdanger"><?=$v['Error_Msg']?></span>
				<?endif;?>
			</td>
			<td><?=$v['Result_Time']?></td>
		</tr>
		<?endforeach;?>
		<?else:?>
		<tr>
			<td>※ 로그가 없습니다.</td>
		</tr>
		<?endif;?>
	</tbody>
</table>
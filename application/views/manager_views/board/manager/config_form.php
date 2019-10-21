<div id="board-config-form">
	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">
	<input type="hidden" name="bc_id" value="<?=$view['bc_id']?>" >


	<table class="table table-form" summary="게시판 설정 관리 폼 - 게시판 정보 중 아이디를 제외한 설정을 변경하는 폼">
		<caption>게시판 설정 관리 폼</caption>
		<colgroup>
			<col width="15%" />
			<col width="35%" />
			<col width="15%" />
			<col width="35%" />
		</colgroup>

		<tbody>
			<tr>
				<th>게시판 아이디</th>
				<td>
					<?=$view['bc_id']?>
				</td>
				<th>게시판 이름</th>
				<td>
					<input type="text" name="bc_name" value="<?=$view['bc_name']?>" title="게시판 이름 입력" />
				</td>
			</tr>
			<tr>
				<th>기본스킨</th>
				<td>
					<select name="bc_skin1" title="스킨 선택">
						<option value="">선택안함</option>
						<option value="default" <?if($view['bc_skin1'] == 'default'):?>selected="selected"<?endif;?>>기본 스킨</option>
						<option value="health" <?if($view['bc_skin1'] == 'health'):?>selected="selected"<?endif;?>>건강정보 스킨</option>
					</select>
				</td>
				<th>예비스킨</th>
				<td>
					<select name="bc_skin2" title="스킨 선택">
						<option value="">선택안함</option>
						<option value="default" <?if($view['bc_skin2'] == 'default'):?>selected="selected"<?endif;?>>기본 스킨</option>
						<option value="default" <?if($view['bc_skin1'] == 'default'):?>selected="selected"<?endif;?>>기본 스킨</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>첨부파일수</th>
				<td>
					<input type="text" name="bc_file_cnt" value="<?=number_format($view['bc_file_cnt'])?>" title="등록가능한 첨부파일 수 입력" class="mini"/>
				</td>
				<th>링크갯수</th>
				<td>
					<input type="text" name="bc_link_cnt" value="<?=number_format($view['bc_link_cnt'])?>" title="등록가능한 링크 수" class="mini"/>
				</td>
			</tr>
			<tr>
				<th>비밀글 사용여부</th>
				<td>
					<select name="bc_lock_flag" title="비밀글 사용여부 선택">
						<?foreach($lock_flags as $k => $v):?>
						<option value="<?=$k?>" <?if($view['bc_lock_flag'] == $k):?>selected="selected"<?endif;?> >
						<?=$v?>
						</option>
						<?endforeach;?>
					</select>
				</td>
				<th>에디터 사용</th>
				<td>
					<select name="bc_editor_flag" title="에디터 사용여부">
						<?foreach($editor_flags as $k => $v):?>
						<option value="<?=$k?>" <?if($view['bc_editor_flag'] == $k):?>selected="selected"<?endif;?> >
						<?=$v?>
						</option>
						<?endforeach;?>
					</select>
				</td>
			</tr>
			<tr>
				<th>공지기능사용</th>
				<td>
					<select name="bc_notice_flag" title="공지기능 사용 여부">
						<option value="N">사용하지 않음</option>
						<option value="Y" <?if($view['bc_notice_flag'] == 'Y'):?>selected="selected"<?endif;?>>사용함</option>
					</select>
				</td>

				<th>댓글기능사용</th>
				<td>
					<select name="bc_reply_flag" title="댓글기능사용">
						<option value="N">사용하지 않음</option>
						<option value="Y" <?if($view['bc_reply_flag'] == 'Y'):?>selected="selected"<?endif;?>>사용함</option>
					</select>						
				</td>
			</tr>
			<tr>
				<th>목록보기<br/>권한그룹</th>
				<td colspan="3">
					<?if(is_array($auth_groups) && count($auth_groups) > 0):?>
					<?foreach($auth_groups as $k => $v):?>
					<input type="checkbox" name="bc_access_list[]" value="<?=$v['gr_id']?>" id="access_list_<?=$v['gr_id']?>" <?if(in_array($v['gr_id'], $view['bc_access_list'])):?>checked="checked"<?endif;?>>
					<label for="access_list_<?=$v['gr_id']?>"><?=$v['gr_name']?></label>
					<?endforeach;?>
					<?endif;?>
				</td>
			</tr>			
			<tr>
				<th>상세보기<br/>권한그룹</th>
				<td colspan="3">
					<?if(is_array($auth_groups) && count($auth_groups) > 0):?>
					<?foreach($auth_groups as $k => $v):?>
					<input type="checkbox" name="bc_access_view[]" value="<?=$v['gr_id']?>" id="access_view_<?=$v['gr_id']?>" 
					<?if(in_array($v['gr_id'], $view['bc_access_view'])):?>checked="checked"<?endif;?>>
					<label for="access_view_<?=$v['gr_id']?>"><?=$v['gr_name']?></label>
					<?endforeach;?>
					<?endif;?>
				</td>
			</tr>
			<tr>
				<th>글쓰기<br/>권한그룹</th>
				<td colspan="3">
					<?if(is_array($auth_groups) && count($auth_groups) > 0):?>
					<?foreach($auth_groups as $k => $v):?>
					<input type="checkbox" name="bc_access_insert[]" value="<?=$v['gr_id']?>" id="access_insert_<?=$v['gr_id']?>" <?if(in_array($v['gr_id'], $view['bc_access_insert'])):?>checked="checked"<?endif;?>>
					<label for="access_insert_<?=$v['gr_id']?>"><?=$v['gr_name']?></label>
					<?endforeach;?>
					<?endif;?>
				</td>
			</tr>
			<tr>
				<th>글수정<br/>권한그룹</th>
				<td colspan="3">
					<?if(is_array($auth_groups) && count($auth_groups) > 0):?>
					<?foreach($auth_groups as $k => $v):?>
					<input type="checkbox" name="bc_access_modify[]" value="<?=$v['gr_id']?>" id="access_modify_<?=$v['gr_id']?>" <?if(in_array($v['gr_id'], $view['bc_access_modify'])):?>checked="checked"<?endif;?>>
					<label for="access_modify_<?=$v['gr_id']?>"><?=$v['gr_name']?></label>
					<?endforeach;?>
					<?endif;?>
				</td>
			</tr>
			<tr>
				<th>글삭제<br/>권한그룹</th>
				<td colspan="3">
					<?if(is_array($auth_groups) && count($auth_groups) > 0):?>
					<?foreach($auth_groups as $k => $v):?>
					<input type="checkbox" name="bc_access_delete[]" value="<?=$v['gr_id']?>" id="access_delete_<?=$v['gr_id']?>" <?if(in_array($v['gr_id'], $view['bc_access_delete'])):?>checked="checked"<?endif;?>>
					<label for="access_delete_<?=$v['gr_id']?>"><?=$v['gr_name']?></label>
					<?endforeach;?>
					<?endif;?>
				</td>
			</tr>
			<tr>
				<th>댓글입력<br/>권한그룹</th>
				<td colspan="3">
					<?if(is_array($auth_groups) && count($auth_groups) > 0):?>
					<?foreach($auth_groups as $k => $v):?>
					<input type="checkbox" name="bc_access_comment[]" value="<?=$v['gr_id']?>" id="access_comment_<?=$v['gr_id']?>" <?if(in_array($v['gr_id'], $view['bc_access_comment'])):?>checked="checked"<?endif;?>>
					<label for="access_comment_<?=$v['gr_id']?>"><?=$v['gr_name']?></label>
					<?endforeach;?>
					<?endif;?>
				</td>
			</tr>			
		</tbody>
	</table>

	<div class="btn-area-center">
		<input type="submit" value="설정적용" class="btn btn-primary" />
		<input type="button" value="창닫기" class="btn btn-default" onclick="self.close();"/>
	</div>
		
	</form>
</div>
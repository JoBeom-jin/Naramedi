<h2 class="title">사용자 등록 및 관리</h2>
<div id="memberList">

	<div class="btn-area-left">
		<a href="<?=$menu_url?>/insertMember" onclick="window.open(this.href,'inertMember','width=500,height=550'); return false;" class="btn btn-primary">일반회원등록</a>
	</div>

	<h3 class="title">등록된 사용자 목록. 누적회원 : <span class="tdanger"><?=number_format($member_total)?></span>명</h3>

	<table class="table table-list " summary="가입된 회원 정보를 목록형태로 보여줍니다." >
		<caption>회원 목록</caption>

		<colgroup>
			<col width="5%" />
			<col width="15%" />
			<col width="20%" />
			<col width="20%" />
			<col width="20%" />
			<col width="10%" />
			<col width="10%" />
		</colgroup>

		<thead>			
			<tr>
				<th>#</th>
				<th>아이디</th>
				<th>이름</th>
				<th>전화번호</th>
				<th>생년월일</th>
				<th>성별</th>
				<th>예약건수</th>
			</tr>
		</thead>
		<tbody>
			<?if(is_array($member_list) && count($member_list) > 0):?>
			<?foreach($member_list as $k => $member):?>
			<tr class="tcenter-all">
				<td><?=$paging->getPageNum($k)?></td>
				<td><a href="<?=$menu_url?>/updateMember/me_seq/<?=$member['me_seq']?>" onclick="window.open(this.href,'inertMember','width=500,height=600'); return false;"><?=$member['me_id']?></a></td>
				<td><?=$member['me_name']?></td>
				<td><?=$member['md_phone']?></td>
				<td><?=date('Y년 m월 d일', $member['md_birth'])?></td>
				<td>
					<?=$gender[$member['md_gender']]?>
				</td>				
				<td>0</td>				
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="8">※ 등록된 회원이 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>
	</table>

	<div class="box box-small box-r">
		<form method="get" action="<?=$menu_url?>" title="검색어선택" >
			<select name="sch_op" title="검색옵션 선택">
				<?foreach($sch_options as $k => $op):?>
				<option value="<?=$k?>" <?if($sch_op == $k):?>selected="selected"<?endif;?> ><?=$op?></option>		
				<?endforeach;?>
			</select>
			<input type="text" name="sch_text" value="<?=$sch_text?>" placeholder="검색어 입력" title="검색어 입력" />
			<input type="submit" value="검색" class="btn btn-default" />
		</form>
	</div>

	<?if(count($paging->pages) > 0):?>

	<div id="paging">
		
		<ul class="pagination">
			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl(1)?>"><span>&lt;&lt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>" onclick="return false;"><span>&lt;&lt;</span></a></li>
			<?endif;?>


			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->prev)?>"><span>&lt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>" onclick="return false;"><span>&lt;</span></a></li>				
			<?endif;?>

			
			<?foreach($paging->pages as $k => $v):?>
			<li <?if($v == $paging->page):?>class="active"<?endif;?>>
				<a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($v)?>"><span><?=$v?></span></a>
			</li>
			<?endforeach;?>
			

			<?if($paging->next > 0):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->next)?>"><span>&gt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>" onclick="return false;"><span>&gt;</span></a></li>				
			<?endif;?>

			<?if($paging->page < $paging->totalPages):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->totalPages)?>"><span>&gt;&gt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>" onclick="return false;"><span>&gt;&gt;</span></a></li>				
			<?endif;?>

		</ul>

	</div>
	
	<?endif;?>

</div>

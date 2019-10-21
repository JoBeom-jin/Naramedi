<h2 class="title">검진기관 기본 목록</h2>

<div id="agency-list">
	<div class="btn-area-left">
<!-- 		<a href="<?=$menu_url?>/excel" class="btn btn-default">액셀데이터 등록</a> -->
<!-- 		<a href="<?=$menu_url?>/autoInsertCode" class="btn btn-danger" onclick="return confirm('최초 등록 기능입니다.\n이 기능에대해 숙지되지 않았다면 사용하지 마세요.');" target="formReceiver">코드자동등록</a>		 -->
		<a href="<?=$menu_url?>/autoInsertCodeLest" class="btn btn-danger" onclick="return confirm('최초 등록 기능입니다.\n이 기능에대해 숙지되지 않았다면 사용하지 마세요.');" target="formReceiver">코드자동등록(추가)</a>
		<a href="<?=$menu_url?>/insertAddr" class="btn btn-default" target="formReceiver">주소</a>
<!-- 		&nbsp;&nbsp; | &nbsp;&nbsp; -->
<!-- 		<a href="<?=$menu_url?>/addExcelOk?option=first" class="btn btn-danger" onclick="return confirm('최초 등록 기능입니다.\n이 기능에대해 숙지되지 않았다면 사용하지 마세요.');" target="formReceiver">액셀추가 등록(1~10번 문서)</a> -->
<!-- 		<a href="<?=$menu_url?>/addExcelOk?option=last" class="btn btn-danger" onclick="return confirm('최초 등록 기능입니다.\n이 기능에대해 숙지되지 않았다면 사용하지 마세요.');" target="formReceiver">액셀추가 등록(10번 이후 문서)</a> -->
<!-- 		<a href="<?=$menu_url?>/insertAddData" class="btn btn-primary" target="formReceiver">추가정보 자동등록</a> -->
<!-- 		<a href="<?=$menu_url?>/insertAddData" class="btn btn-primary" target="formReceiver">추가정보 자동등록</a> -->
			&nbsp;&nbsp; | &nbsp;&nbsp;		
			<a href="<?=$menu_url?>/searchData" class="btn btn-primary" onclick="window.open(this.href, 'search-form', 'width=600, height=800'); return false;">검진기관 개별입력</a>
	</div>

	<div class="btn-area-left">
		<form method="get" action="<?=$menu_url?>/<?=$act?>">
			<table class="table table-form" summary="검진기관 검색 폼">
				<caption>검색 폼</caption>
				<tbody>
					<input type="text" name="sch_text" value="<?=$sch_text?>" title="검색어" placeholder="검진기관 명을 입력하세요." style="width:200px;"/>
					&nbsp; <input type="submit" value="검색" class="btn btn-default" />
				</tbody>
			</table>
		</form>
	</div>

	<h3 class="title">정보를 찾지 못한 검진기관 목록 (총 : <?=number_format($total)?>)</h3>	
	<h3 class="title">추가정보(검진시간, 예약시간, 점심시간 등의 정보)가 진행되지 않은 검진기관 수 : <span style="font-weight:bold; color:red; font-size:16px;"><?=$total_time?></span></h3>
	<table class="table table-list " summary="검진기관 목록을 보여줍니다." >
		<caption>검진기관 목록</caption>

		<colgroup>
			<col width="5%" />
			<col width="15%" />
			<col width="5%" />
			<col width="10%" />
			<col width="10%" />
			<col width="35%" />
			<col width="10%" />
			<col width="10%" />
		</colgroup>

		<thead>			
			<tr>
				<th>NO</th>
				<th>기관명</th>
				<th>종류</th>
				<th>주소1</th>
				<th>주소2</th>
				<th>주소</th>
				<th>코드</th>
				<th>관리</th>
			</tr>
		</thead>
		
		<tbody>
			<?foreach($list as $k => $v):?>
			<tr>
				<td class="tcenter"><?=$paging->getPageNum($k)?></td>
				<td class="tcenter"><?=$v['hd_name']?></td>
				<td class="tcenter"><?=$v['hd_type_name']?></td>
				<td class="tcenter"><?=$v['hd_addr1']?></td>
				<td class="tcenter"><?=$v['hd_addr2']?></td>
				<td><?=$v['hd_addr']?></td>
				<td>
					<?if(!$v['hd_code']):?>	
					<span class="alert-success">실행전</span>
					<?elseif($v['hd_code'] == 'not found'):?>
					<span class="alert-danger">없음</span>
					<?else:?>
					<?=$v['hd_code']?>
					<?endif;?>
				</td>
				<td class="tcenter">
					<a href="<?=$menu_url?>/find?seq=<?=$v['hd_seq']?>" onclick="window.open(this.href,'','width=700, height=750'); return false;" class="btn btn-primary">검색</a>
					<a href="<?=$menu_url?>/complete?seq=<?=$v['hd_seq']?>" target="formReceiver" class="btn btn-danger" onclick="return confirm('목록에서 제외됩니다.\n기관정보를 직접 입력한 경우 목록에서 제외하는 기능입니다.');">목록에서제외</a>					
				</td>
			</tr>
			<?endforeach;?>
		</tbody>


		
	</table>


	<?if(count($paging->pages) > 0):?>

	<div id="paging">
		
		<ul class="pagination">
			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl(1)?>&amp;sch_text=<?=$sch_text?>"><span>&lt;&lt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;sch_text=<?=$sch_text?>" onclick="return false;"><span>&lt;&lt;</span></a></li>
			<?endif;?>


			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->prev)?>&amp;sch_text=<?=$sch_text?>"><span>&lt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;sch_text=<?=$sch_text?>" onclick="return false;"><span>&lt;</span></a></li>				
			<?endif;?>

			
			<?foreach($paging->pages as $k => $v):?>
			<li <?if($v == $paging->page):?>class="active"<?endif;?>>
				<a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($v)?>&amp;sch_text=<?=$sch_text?>"><span><?=$v?></span></a>
			</li>
			<?endforeach;?>
			

			<?if($paging->next > 0):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->next)?>&amp;sch_text=<?=$sch_text?>"><span>&gt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;sch_text=<?=$sch_text?>" onclick="return false;"><span>&gt;</span></a></li>				
			<?endif;?>

			<?if($paging->page < $paging->totalPages):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->totalPages)?>&amp;sch_text=<?=$sch_text?>"><span>&gt;&gt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;sch_text=<?=$sch_text?>" onclick="return false;"><span>&gt;&gt;</span></a></li>				
			<?endif;?>

		</ul>

	</div>
	
	<?endif;?>

	


</div>
<div class="btn-area-left">
<!-- 	<a href="<?=$menu_url?>/excel" class="btn btn-danger" target="formReceiver">엑셀 to DB</a> -->
<!-- 	<a href="<?=$menu_url?>/addrSearch" class="btn btn-primary" target="blank">DB매칭</a> -->
<!-- 	<a href="<?=$menu_url?>/copyPhoto"class="btn btn-primary" target="formReceiver">사진등록</a> -->
</div>

<div>
	
	<table class="table table-list" summary="기능 및 기능 설명 테이블">
		<caption>기능 및 기능 설명 테이블</caption>
		<colgroup>
			<col width="15%">
			<col width="auto">
		</colgroup>
		<tbody>
			<tr>
				<th>
					<a href="<?=$menu_url?>/excel" onclick="return confirm('기존 데이터가 존재할 경우 실행하지 마십시요. 실행하시겠습니까?');" target="formReceiver" class="btn btn-danger">
						엑셀 데이터 DB 이전
					</a>
				</th>
				<td>
					<p style="font-weight:bold;">사진 관리 DB Talbe을 초기화 하고, excel 파일에서 신규 데이터를 입력합니다.</p>					
					<p class="tdanger">※ 초기 작업으로 한 번만 실행하기를 권장합니다.</p>
				</td>
			</tr>
			<tr>
				<th>
					<a href="<?=$menu_url?>/existsData" target="formReceiver" class="btn btn-default">
						데이터 매칭
					</a>
				</th>
				<td>
					<p style="font-weight:bold;">기관정보와 Excel Data의 매칭을 시도합니다. 이미 매칭된 데이터는 보존됩니다.</p>
					<p>
					Excel Data : 총 <span class="tdanger"><?=number_format($total)?></span>개, 매칭 된 기관 : <span class="tdanger"><?=number_format($mapping_total)?></span>개
					</p>
					<p>※ 매칭은 병원주소를 통해 이루어집니다. 매칭되지 않은 기관은 병원 주소가 서로 다르기 때문이거나 실제 존재하지 않기 때문입니다.</p>
				</td>
			</tr>
			<tr>
				<th>
					<a href="<?=$menu_url?>/movePhoto" target="_blank" class="btn btn-default">
						사진이전
					</a>
				</th>
				<td>
					<p style="font-weight:bold;">매칭이 완료된 Data에 대해 사진 이전 작업을 시작합니다.</p>
					<p>
					Excel Data : 총 <span class="tdanger"><?=number_format($total)?></span>개, 매칭 된 기관 : <span class="tdanger"><?=number_format($mapping_total)?></span>개,  사진 폴더가 존재하는 정보 : <span class="tdanger"><?=number_format($exist_dir_total)?></span>개, 이전 완료된 정보 : <span class="tdanger"><?=number_format($complete_total)?></span>개, 이전 가능한 정보 : <span class="tdanger"><?=number_format($lest_total)?></span>개
					</p>
					<p>※ 이전은 기관정보가 있고, 이전할 사진 데이터가 존재하는 정보에만 수행됩니다. <span class="tdanger">기존 사진 데이터 및 사진 파일은 삭제됩니다.</span></p>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div class="btn-area-left">
	<a href="<?=$menu_url?>/<?=$act?>?type=" class="btn <?if(!$type):?>btn-primary<?else:?>btn-default<?endif;?>">전체</a>
	<a href="<?=$menu_url?>/<?=$act?>?type=no_agency" class="btn <?if($type =='no_agency'):?>btn-primary<?else:?>btn-default<?endif;?>">기관정보없음</a>
	<a href="<?=$menu_url?>/<?=$act?>?type=no_dir" class="btn <?if($type =='no_dir'):?>btn-primary<?else:?>btn-default<?endif;?>">사진폴더없음</a>
</div>

<div id="photo-list">
	<div class="btn-area-left">
<!-- 		<a href="" class="btn btn-primary"</a>		 -->
	</div>
	<h3 class="title">등록해야할 사진 목록</h3>	
	<table class="table table-list tcenter-all" >
		<caption>사진 목록</caption>
		<thead>
			<tr>
				<th>No</th>
				<th>병원이름</th>
				<th>폴더이름</th>
				<th>등록여부</th>				
				<th>사진폴더유무</th>
				<th>기관정보유무</th>				
			</tr>
		</thead>
		<tbody>
			<?foreach($list as $k => $v):?>
			<tr>
				<td><?=$paging->getPageNum($k)?></td>
				<td>
					<a href="<?=$menu_url?>/modify?seq=<?=$v['apd_seq']?>" onclick="window.open(this.href, 'modifyForm', 'width=600, height=800'); return false;"><?=$v['apd_source']?></a>
				</td>
				<td>
					<?if($v['apd_source_add']):?>
					<?=$v['apd_source_add']?>
					<?else:?>
					<span class="tdanger">사진 폴더를 찾을 수 없습니다</span>					
					<?endif;?>					
				</td>
				<td>
					<?if($v['apd_add_flag'] == 'Y'):?>
					등록완료
					<?else:?>
					<span class="tdanger">미등록</span>
					<?endif;?>
				</td>
				<td>
					<?if($v['apd_dir_exists'] == 'Y'):?>
					사진있음
					<?else:?>
					<span class="tdanger">무</span>
					<?endif;?>					
				</td>
				<td>
					<?if($v['apd_ai_exists'] == 'Y'):?>
					유
					<?else:?>
					<span class="tdanger">기관정보없음</span>
					<?endif;?>								
				</td>				
			</tr>
			<?endforeach;?>
		</tbody>
	</table>

	<?if(count($paging->pages) > 0):?>

	<div id="paging">
		
		<ul class="pagination">
			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl(1)?>&amp;type=<?=$type?>"><span>&lt;&lt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;type=<?=$type?>" onclick="return false;"><span>&lt;&lt;</span></a></li>
			<?endif;?>


			<?if($paging->page > 1):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->prev)?>&amp;type=<?=$type?>"><span>&lt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;type=<?=$type?>" onclick="return false;"><span>&lt;</span></a></li>				
			<?endif;?>

			
			<?foreach($paging->pages as $k => $v):?>
			<li <?if($v == $paging->page):?>class="active"<?endif;?>>
				<a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($v)?>&amp;type=<?=$type?>"><span><?=$v?></span></a>
			</li>
			<?endforeach;?>
			

			<?if($paging->next > 0):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->next)?>&amp;type=<?=$type?>"><span>&gt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;type=<?=$type?>" onclick="return false;"><span>&gt;</span></a></li>				
			<?endif;?>

			<?if($paging->page < $paging->totalPages):?>
			<li><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->totalPages)?>&amp;type=<?=$type?>"><span>&gt;&gt;</span></a></li>
			<?else:?>
			<li class="disabled"><a href="<?=$menu_url?>/<?=$act?>?<?=$paging->getUrl($paging->page)?>&amp;type=<?=$type?>" onclick="return false;"><span>&gt;&gt;</span></a></li>				
			<?endif;?>

		</ul>

	</div>
	
	<?endif;?>

</div>
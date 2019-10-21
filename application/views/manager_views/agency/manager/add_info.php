<div id="agency-manager-list">
	<h2 class="title">검진기관 관리 - 추가정보 관리</h2>

	<?=$html_taps?>

	<h3 class="title">추가정보 관리 메뉴</h3>
	<table class="table table-list" summary="실행할 기능과 그에 대한 설명 입니다.">
		<caption>사용가능한 메뉴</caption>
		<colgroup>
			<col width="20%"/>
			<col width=""/>
		</colgroup>
		<thead>
			<tr>
				<th>메뉴명</th>
				<th>설명</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="tcenter">
					<a href="<?=$menu_url?>/addInfoModifyAll?ignore_flag=true" target="_blank" class="btn btn-danger">전체 수정 - 기존 정보 삭제</a>
				</td>
				<td>
					모든 검진기관의 추가정보(검진시간, 교통 정보 등)를 수정합니다. <br/>
					API에 정보가 존재할 경우, DB의 기존 정보는 삭제처리 되어 갱신됩니다.<br/>
					<span class="tdanger">등록된 모든 검진기관을 검사하므로 10분 이상의 시간이 소요될 수 있습니다. 정상적인 완료 메세지가 나올때까지 브라우저를 끄지 마세요.</span>
				</td>
			</tr>
			<tr>
				<td class="tcenter">
					<a href="<?=$menu_url?>/addInfoModifyAll?ignore_flag=false" target="_blank" class="btn btn-primary">전체 수정 - 기존 정보 유지</a>
				</td>
				<td>
					모든 검진기관의 추가정보(검진시간, 교통 정보 등)를 수정합니다. <br/>
					DB에 정보가 존재할 경우 API의 정보는 무시되어 기존 정보를 유지합니다.<br/>
					<span class="tdanger">등록된 모든 검진기관을 검사하므로 10분 이상의 시간이 소요될 수 있습니다. 정상적인 완료 메세지가 나올때까지 브라우저를 끄지 마세요.</span>
				</td>
			</tr>
			<tr>
				<td class="tcenter">
					<a href="<?=$menu_url?>/individual" class="btn btn-default">개별 수정 - 기존정보 삭제</a>
				</td>
				<td>
					개별 검진기관의 추가정보(검진시간, 교통 정보 등)를 수정합니다. <br/>
					하단의 목록에서 추가정보입력 버튼을 클릭하면 추가정보가 갱신됩니다.<br/>
					<span class="tdanger">API에 정보가 존재할 경우, DB의 기존 정보는 삭제처리 되므로 사용에 유의하세요.</span>
				</td>
			</tr>
<!-- 			<tr> -->
<!-- 				<td class="tcenter"> -->
<!-- 					<a href="<?=$menu_url?>/resortData" target="_blank" class="btn btn-danger">중복 추가정보 삭제</a> -->
<!-- 				</td> -->
<!-- 				<td> -->
<!-- 					중복으로 입력된 데이터를 삭제합니다. -->
<!-- 				</td> -->
<!-- 			</tr> -->


<!-- 			<tr> -->
<!-- 				<td class="tcenter"> -->
<!-- 					<a href="<?=$menu_url?>/addAddr" target="_blank" class="btn btn-default">주소지 입력 - 기존정보 유지</a> -->
<!-- 				</td> -->
<!-- 				<td> -->
<!-- 					시도명, 시군구명이 비어있는 데이터에 한하여 API에서 제공하는 정보를 입력 -->
<!-- 				</td> -->
<!-- 			</tr> -->
		</tbody>
	</table>


	<?if(isset($list)):?>
	<h3 class="title">개별수정 목록</h3>

	<div class="bnt-area-left">
		<form method="get" action="<?=$menu_url?>/<?=$act?>" id="sch-form">
			<table class="table table-form" summary="검색 옵션을 선택하여 목록을 변경한다.">
				<caption>검색 옵션 선택 폼</caption>
				<tbody>
					<tr>
						<td>
							<input type="text" name="ai_name" value="<?=$ai_name?>" title="검진기관 명 검색" placeholder="검진기관명" class="normal"/>
							<select name="" title="제휴여부 선택">
								<option value="">제휴여부</option>
								<option value="">비제휴(준비중)</option>
								<option value="">제휴(준비중)</option>
							</select>
							<select name="ai_addr_text1" title="시도 선택">
								<option value="">시도</option>
								<?foreach($sido as $v):?>
								<option value="<?=urlencode($v['ai_addr_text1'])?>" <?if($v['ai_addr_text1'] == $ai_addr_text1):?>selected="selected"<?endif;?> > <?=$v['ai_addr_text1']?> </option>
								<?endforeach;?>
							</select>

							<?if($ai_addr_text1):?>
							<select name="ai_addr_text2" title="시군구">
								<option value="">시군구</option>
								<?foreach($sigungu as $v):?>
								<option value="<?=urlencode($v['ai_addr_text2'])?>" <?if($v['ai_addr_text2'] == $ai_addr_text2):?>selected="selected"<?endif;?> > <?=$v['ai_addr_text2']?> </option>
								<?endforeach;?>
							</select>
							<?endif;?>							
							<input type="submit" value="검색" class="btn btn-default" />

							<a href="<?=$menu_url?>/<?=$act?>" class="btn btn-primary">검색초기화</a>
							<a href="<?=$menu_url?>/insert?back_url=<?=$back_url?>" class="btn btn-default">검진기관 직접입력</a>							
						</td>
					</tr>
				</tbody>
			</table>			
		</form>
	</div>

	<table class="table table-list" summary="개별 수정 가능한 목록" >
		<thead>
			<tr>				
				<th>검진기관명</th>
				<th>검진기관번호</th>
				<th>시도명</th>
				<th>시군구명</th>
				<th>교통정보</th>
				<th>주차정보</th>
				<th>점심시간</th>
				<th>진료시간</th>				
				<th>정보갱신일</th>
				<th>추가정보입력</th>
			</tr>
		</thead>

		<tbody>
			<?if(is_array($list) && count($list) > 0):?>
			<?foreach($list as $k => $v):?>
			<tr>			
				<td>
					<a href="<?=$menu_url?>/view/seq/<?=$v['ai_seq']?>?back_url=<?=$back_url?>">
						<?=$v['ai_name']?>
					</a>
				</td>
				<td class="tcenter"><?=$v['ai_number']?></td>
				<td class="tcenter"><?=$v['ai_addr_text1']?></td>
				<td class="tcenter"><?=$v['ai_addr_text2']?></td>
				<td>
					<?if($v['bus']):?>
					<p><?=$v['bus']?></p>
					<?endif?>
					<?if($v['subway']):?>
					<p><?=$v['subway']?></p>
					<?endif?>
				</td>
				<td>
					<?=$v['park']?>
				</td>
				<td>
					<?if($v['lunch']):?>
					<?=$v['lunch']?>
					<?else:?>
					<span class="tdanger">정보없음</span>
					<?endif;?>
				</td>
				<td>
					<p>	
						평일 : 
						<?if($v['jin']):?>
						<?=$v['jin']?>
						<?else:?>
						<span class="tdanger">정보없음</span>
						<?endif;?>
					</p>
					<p>	
						토요일 : 
						<?if($v['sat_jin']):?>
						<?=$v['sat_jin']?>
						<?else:?>
						<span class="tdanger">정보없음</span>
						<?endif;?>
					</p>
				</td>				
				
				<td class="tcenter">
					<?if($v['ai_adddata_utime']):?>
					<?=date('Y.m.d H:i:s', $v['ai_adddata_utime'])?>
					<?else:?>
					<span class="tdanger">갱신전</span>
					<?endif;?>
					<?=$v['ai_addr_text2']?>
				</td>
				<td>
					<a href="<?=$menu_url?>/individualAdd?seq=<?=$v['ai_seq']?>" target="_blank" class="btn btn-primary">추가정보입력</a>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="7">※ 검색된 검진기관이 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>		
	</table>

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
	<?endif;?>

</div>
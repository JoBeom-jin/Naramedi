<div id="agency-manager-list">
	<h2 class="title">검진기관 관리</h2>

	<?=$html_taps?>

	<h3 class="title">검진기관 목록</h3>
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
							<button type="button" class="del_btn btn btn-primary text-white">선택된 목록 삭제</button>						
						</td>
					</tr>
				</tbody>
			</table>			
		</form>
	</div>
	<table class="table table-list" summary="관리되고 있는 검진기관 목록을 보여줍니다.">
		<caption>검진기관 목록</caption>
		
		<colgroup>
		</colgroup>

		<thead>
			<tr>
				<th><input type="checkbox" name="check_del" class="check_del"></th>
				<th>No</th>
				<th>검진기관명</th>
				<th>검진기관번호</th>
				<th>시도명</th>
				<th>시군구명</th>
				<th>사진등록여부</th>
				<th>제휴여부</th>
			</tr>
		</thead>

		<tbody>
			<?if(is_array($list) && count($list) > 0):?>
			<?foreach($list as $k => $v):?>
			<tr>
				<td class="tcenter"><input type="checkbox" name="check_del" class="ab"></td>
				<td class="tcenter"><?=$paging->getPageNum($k)?></td>
				<td>
					<a href="<?=$menu_url?>/view/seq/<?=$v['ai_seq']?>?back_url=<?=$back_url?>">
						<?=$v['ai_name']?>
					</a>
				</td>
				<td class="tcenter"><?=$v['ai_number']?></td>
				<td class="tcenter"><?=$v['ai_addr_text1']?></td>
				<td class="tcenter"><?=$v['ai_addr_text2']?></td>
				<td class="tcenter">
					<?if(array_key_exists($v['ai_seq'], $photoes) && $photoes[$v['ai_seq']]['cnt'] > 0 ):?>
					등록됨(<?=$photoes[$v['ai_seq']]['cnt']?>장)
					<?else:?>
					<span class="tdanger">등록되지 않음</span>
					<?endif;?>
				</td>
				<td class="tcenter">
					<?if($v['ai_number'] && in_array($v['ai_number'], $accept_list)):?>
					제휴병원
					<?else:?>
					&nbsp;
					<?endif;?>
					<?if($delete_flag):?>
					<a href="<?=$menu_url?>/deleteOk?seq=<?=$v['ai_seq']?>" class="btn btn-danger" onclick="return confirm('삭제된 데이터는 복구하실 수 없습니다.');" target="formRecever">삭제</a>
					<?endif;?>
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


	
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('select[name="ai_addr_text1"]').on('change', function(){
			$('select[name="ai_addr_text2"] option:selected').removeAttr('selected');
			$('#sch-form').submit();
		});

		$('select[name="ai_addr_text2"]').on('change', function(){
			$('#sch-form').submit();
		});

		$( '.check_del' ).click( function() {
          $( '.ab' ).prop( 'checked', this.checked );
        } );
	});

</script>
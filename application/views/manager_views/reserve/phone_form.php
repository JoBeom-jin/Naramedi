<h3 class="title">전화예약 상세</h3>
<div id="phone-reserve-form">
	<form method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">
		<input type="hidden" name="ei_seq" value="<?=$view['er_eiseq']?>" id="er_eiseq"/>
		<input type="hidden" name="ai_number" value="<?=$view['er_ainum']?>"  id="er_ainum"/>
		<?if($act == 'modify'):?>
		<input type="hidden" name="er_seq" value="<?=$view['er_seq']?>" />
		<?endif;?>
		<table class="table table-form" summary="전화예약 신규 등록 및 수정 폼">
			<caption>전화예약 폼</caption>
			<colgroup>
				<col width="20%" />
				<col width="" />
			</colgroup>
			<tbody>
				<tr>
					<th>등록일</th>
					<td>
						<?=date('Y.m.d')?>
					</td>
				</tr>
				<tr>
					<th>mall 구분</th>
					<td>
						<select name="er_mall" title="mall">
							<?// print_r($_malls); ?>
							<?foreach($_malls as $k => $v):?>
							<option value="<?=$k?>" <?if($view['er_mall'] == $k):?>selected="selected"<?endif;?>><?=$v['name']?></option>
							<?endforeach;?>
						</select>
						<select name="er_mall_name" title="폐쇄몰 상세" <?if( $act != 'modify' || ( isset($view['er_mall']) && $view['er_mall'] != 'MLL002' ) ):?>class="hide" <?endif;?>>
							<option value="">폐쇄몰 상세</option>
							<?foreach($closed_mall_list as $k => $v):?>
							<option value="<?=$v['cs_name']?>"  <?if( isset($view['er_mall']) && $view['er_mall'] == 'MLL002' &&  ( $view['er_mall_name'] == $v['cs_name'] ) ):?>selected="selected"<?endif;?>><?=$v['cs_name']?></option>
							<?endforeach;?>							
						</select>
					</td>
				</tr>
				<tr>
					<th>예약자이름</th>
					<td>
						<input type="text" name="er_name" value="<?=$view['er_name']?>" title="예약자 이름" class="normal"/>
					</td>
				</tr>
				<tr>
					<th>예약자전화번호</th>
					<td>
						<input type="text" name="er_phone" value="<?=$view['er_phone']?>" title="전화번호"  class="normal"/>
					</td>
				</tr>
				<tr>
					<th>통화가능시간</th>
					<td>
						<select name="er_time" title="통화가능시간">
							<?foreach($_times as $k => $v):?>
							<option value="<?=$k?>" <?if($view['er_time'] == $k):?>selected="selected"<?endif;?>><?=$v['sub_name']?></option>
							<?endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<th>예약내용</th>
					<td>
						<span id="selected_event"><?=$event['ei_name']?></span>
						<a href="<?=$menu_url?>/search" onclick="openEventWin(this.href); return false;" id="select-event" class="btn btn-default">이벤트 선택하기</a>
					</td>
				</tr>
				<tr>
					<th>가격</th>
					<td>
						<input type="text" name="er_account" value="<?=$view['er_account']?>" title="가격"  class="normal" id="er_account"/>
					</td>
				</tr>
				<tr>
					<th>남기실말</th>
					<td>
						<input type="text" name="er_memo" value="<?=$view['er_memo']?>" title="남기실말"/>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="btn-area-center">
			<?if($act == 'modify'):?>
			<input type="submit" value="수정완료" class="btn btn-primary">
			<?else:?>
			<input type="submit" value="등록하기" class="btn btn-primary">
			<?endif;?>
			<a href="<?=$back_url?>" class="btn btn-default">돌아가기</a>
		</div>
	</form>
</div>


<script>
$(document).ready(function(){
	//폐쇄몰 선택시 폐쇄몰 상세 출력
	$('select[name="er_mall"]').on('change', function(){
		var selected = $(this).find(':selected').val();		
		if(selected == 'MLL002'){			
			$('select[name="er_mall_name"]').removeClass('hide');
		}else{
			$('select[name="er_mall_name"]').addClass('hide');
			$('select[name="er_mall_name"] option:first').attr('selected', 'selected');
		}

		clearEvent();
	});

	$('select[name="er_mall_name"]').on('change', function(){
		clearEvent();
	});
});


function openEventWin(href){
	var mall = false;
	var open_href = false;

	mall = $('select[name="er_mall"]').find(':selected').val();
	open_href = href+'?mall='+mall;	
	window.open(open_href, 'search-form', 'width=600, height=700' );
}

//선택된 이벤트 제거
function clearEvent(){
	$('#selected_event').html('');
	$('#ai_number').val('');
	$('input[name="ei_seq"]').val('');
	$('input[name="er_account"]').val('');
}
</script>
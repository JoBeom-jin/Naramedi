<div id="event_part_search_form" class="contents">
	<div class="row" style="margin:0px; ">
		<form method="get" action="<?=$menu_url?>/<?=$act?>" id="search-form-modal">
			<input type="hidden" name="group" value="<?=$group_value?>" />
			<input type="hidden" name="sort" value="<?=$sort_value?>" />
			<input type="hidden" name="goto_page" value="<?=$page_value?>" />

			<div class="col-xs-12 part-search" style="padding:0px;">
				
				<div class="row" style="margin-right:0px; margin-left:0px;">

					<div class="body-image">
						<!-- <h3>&nbsp;</h3>					 -->
				
						<div class="stage-ibx">
							<div class="stage-ibx__stage" style="width:190px; height:400px; margin: 0 auto;" >
								<!-- Image -->
								<img src="/resource/images/common/body.png" class="stage-ibx__stage-img img-responsive" alt="" title="" style="width:190px; height:400px;" />
								<!--/ Image -->

								<!-- Stage point 1 -->
<!-- 								<span style="top: 40px; left: 50px; opacity: 1;" class="__point kl-ib-point-1" data-title="전신"></span> -->
								<!--/ Stage point 1 -->
		
								<!-- Stage point 2 -->
								<span style="top: 14px; left: 98px; opacity: 1;" class="stage-ibx__point kl-ib-point-2 <?if(urldecode($group_value) == '머리'):?>selected<?endif;?>" data-title="머리"></span>
								<!--/ Stage point 2 -->
		
								<!-- Stage point 3 -->
								<span style="top: 62px; left: 98px; opacity: 1;" class="stage-ibx__point kl-ib-point-3 <?if(urldecode($group_value) == '목'):?>selected<?endif;?>" data-title="목"></span>
								<!--/ Stage point 3 -->
		
								<!-- Stage point 4 -->
								<span style="top: 110px; left: 90px; opacity: 1;" class="stage-ibx__point kl-ib-point-4 <?if(urldecode($group_value) == '가슴'):?>selected<?endif;?>" data-title="가슴"></span>
								<!--/ Stage point 4 -->
		
								 <!-- Stage point 5 -->
								<span style="top: 110px; left: 115px; opacity: 1;" class="stage-ibx__point kl-ib-point-5 <?if(urldecode($group_value) == '유방'):?>selected<?endif;?>" data-title="유방(여성)" ></span>
								<!--/ Stage point 5 -->
		
								<!-- Stage point 6 -->
								<span style="top: 160px; left: 70px; opacity: 1;" class="stage-ibx__point kl-ib-point-6 <?if(urldecode($group_value) == '허리'):?>selected<?endif;?>" data-title="허리"></span>
								<!--/ Stage point 6 -->
		
								<!-- Stage point 7 -->
								<span style="top: 160px; left: 98px; opacity: 1;" class="stage-ibx__point kl-ib-point-7 <?if(urldecode($group_value) == '상복부'):?>selected<?endif;?>" data-title="상복부"></span>
								<!--/ Stage point 7 -->
		
								 <!-- Stage point 8 -->
								<span style="top: 205px; left: 98px; opacity: 1;" class="stage-ibx__point kl-ib-point-8 <?if(urldecode($group_value) == '하복부'):?>selected<?endif;?>" data-title="하복부"></span>
								<!--/ Stage point 8 -->
		
								<!-- Stage point 9 -->
								<span style="top: 300px; left: 195px; opacity: 1;" class="stage-ibx__point kl-ib-point-9 <?if(urldecode($group_value) == '기타'):?>selected<?endif;?>" data-title="기타"></span>
								<!--/ Stage point 9 -->

							</div>
							<!-- /.__stage -->

							<div class="clearfix"></div>
							<div style="margin:0 auto; width:90vw;"><img src="/resource/assets/img/part-title.png" alt="part-title"></div>
						</div>
						
					</div>	

					<div class="part-win">
						<div class="win-table">
							<!-- <h3>상세항목을 선택해주세요</h3> -->
							<table class="type03" summary="부위별 검색 코드 선택" >
								<caption>부위별 검색어 선택</caption>
								<!-- <thead>
									<tr>
										<td>
											<input type="button" value="전체선택" class="btn btn-default btn-allcheck"/>
										</td>
									</tr>
								</thead> -->
								<tbody>	
									<?if(is_array($group_array) && count($group_array) > 0):?>
									<?foreach($group_array as $k => $v):?>
									<tr class="col-xs-6">
										<td >
										<input type="checkbox" name="codes[]" value="<?=$v['cd_code']?>" id="<?=$v['cd_code']?>" <?if(is_array($codes_array) && in_array($v['cd_code'], $codes_array)):?>checked="checked"<?endif;?> class="runway"> <label for="<?=$v['cd_code']?>"><?=$v['cd_name']?></label>
										</td>
									</tr>
									<?endforeach;?>
									<?endif;?>
								</tbody>								
							</table>						
						</div>
					</div>
				</div>
				<div class="row" style="margin:0px;">
					<div class=" btn-area-center btn-area-renew" >
						<input type="button" class="btn btn-reset  btn-allcheck btn-bottom" value="선택 초기화" onclick="onCheckreset();"/>
						<input type="button" class="btn btn-primary btn-bottom" value="선택한 부위로 검색" onclick="onSubmit();"/>
					</div>
				</div>
			</div>
		</form>	
	</div>	
</div>

<script>
var search_form = false;
var click_els_table = new Array();
var click_els_image = new Array();
var win_area = false;
var target_el = false;
var part_json_url = '<?=$menu_url?>/jsonBodyParts?part=';

$(document).ready(function(){
	win_area = $('.win-table');
	target_el = $('.part-win table tbody');
	search_form = $('#search-form-modal');	
	click_els_image = $('.stage-ibx span');

	click_els_image.on('click', function(e){
		var text = $(this).data('title');
		if(text == '유방(여성)') text = '유방';
		openWin(text);
//		text = encodeURI(text);
		$('input[name="group"]').val(text);
	});	

});

/* send form */
function onSubmit(){
	var inputs = $('#search-form-modal input');	
	var selects  = $('#search-form-modal select');
	var target = $('#search-form');

	var send_data = new Array();	
	var send_idx = 0;

	$.each(inputs, function(idx, item){		
		send_data[send_idx] = new Array();
		if($(item).attr('name')){

			if($(item).attr('type') == 'text' || $(item).attr('type') == 'hidden'){
				if($(item).attr('name') == 'account'){
					var account = $(item).val().split(',');
					send_data[send_idx]['name'] = 'max_account';
					send_data[send_idx]['value'] = parseInt(account[1])*10000;					
					send_idx++;

					send_data[send_idx] = new Array();
					send_data[send_idx]['name'] = 'min_account';
					send_data[send_idx]['value'] = parseInt(account[0])*10000;
					send_idx++;
				}else{
					send_data[send_idx]['name'] = $(item).attr('name');
					send_data[send_idx]['value'] = $(item).val();				
					send_idx++;
				}

			}else if($(item).attr('type') == 'checkbox' && $(item).prop('checked') == true){
				send_data[send_idx]['name'] = $(item).attr('name');
				send_data[send_idx]['value'] = $(item).val();				
				send_idx++;
			}
		}
	});

	$.each(selects, function(idx, item){
		send_data[send_idx] = new Array();
		send_data[send_idx]['name'] = $(item).attr('name');
		send_data[send_idx]['value'] = $(item).find(':selected').val();
		send_idx++;
	});	

	if(send_idx < 1){
		alert('상세항목을 선택한 후 검색해 주세요.');
		return false;
	}

	target.find('input[type="hidden"]').remove();	
	$.each(send_data, function(idx, item){
		var item = $('<input/>').attr({
			'type' : 'hidden',
			'name' : item.name,
			'value' : item.value
		});
		
		item.appendTo(target);		
	});	
	
	clear_area();
	more_list();
	
	$('.modal-window').addClass('fade_out');
	setTimeout(function() {
		$('.modal-window').remove();
	}, 300);

	return false;
}

function openWin(text){
	clearTable();
	if(!text || text == '') return false;	
	var target_url = part_json_url+encodeURI(text);

	$.ajax({
		url: target_url,
		type: "GET",
		dataType: "JSON",
		success: function (data) {				
			if(data.list.length > 0){
				$.each(data.list, function(i, item){
					setItemToTable(item.cd_code, item.cd_name);					
				});
				activeElenet(text);
				$('.btn-allcheck').show();
				$('.btn-allcheck').on('click', function(e){onCheckAll()});
				toggleWin();				
			}else{
				alert('선택할 수 없는 영역입니다.');
			}
		}
	});			
}

function activeElenet(text){

	click_els_image.removeClass('selected');
	$.each(click_els_image, function(i, item){
		if(text == '유방') text = '유방(여성)';
		if($(item).data('title') == text){									
			$(item).addClass('selected');
		}
	});
	
}

function closeWin(){
	win_area.find('tbody').html('');
	win_area.hide();
}

function clearTable(){
	win_area.find('tbody').html('');
}

function setItemToTable(code, name){
	var tr = $('<tr/>');
	tr.appendTo(target_el);

	var td = $('<td/>');
	td.appendTo(tr);

	var label = $('<label>').attr('for', code);			
	$('<input/>').attr({
		'type' : 'checkbox',
		'name' : 'codes[]',
		'value' : code,
		'id' : code,
		'class' : 'runway'
	}).appendTo(td);
	
	label.html(' '+name);
	label.appendTo(td);
}

function toggleWin(){	
	if(!win_area.is(":visible")){
		win_area.find('.cls-btn').on('click', function(){
			closeWin();
		});
		win_area.show();
	}
}

function onCheckAll(){
	search_form.find('input[type="checkbox"]').prop('checked', false);
}


</script>
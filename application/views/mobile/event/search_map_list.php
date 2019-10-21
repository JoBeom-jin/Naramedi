<div id="map-list-area">
		<div class="search-bar horizontal">

			<form class="search-form" role="form" method="GET" action="<?=$menu_url?>/<?=$act?>">
				<div class="form-group" style="margin-top:8px;">
					<div class="input-group location" style="width:100%; text-align:center;">
							
						<input type="text" id="ai-name" name="ai_name" value="<?=$ai_name?>" class="form-control" placeholder="병원명을 검색해주세요.">
						<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
												
					</div>
				</div>
				<!-- /.input-row -->
			</form>
			<!-- /.sub-search -->
		</div>
		
	<h3 class="pull-left" style="padding:0px 20px; "><span id="row-total" style="color:#1e67c6;"data-total="<?if($paging):?><?=$paging->totalPages?><?endif;?>" ><?if($total):?><?=$total?><?else:?>0<?endif;?></span> 건의 결과가 있습니다. </h3>

	<ul id="main-left-list" class="results list">
		<?if(isArray_($list)):?>					
		<?foreach($list as $k => $v):?>					
		
		<li>
		<!-- 지도 검색후 해당병원에 맞는 이미지 DB -->
			<div class="item" id="<?=$k+1?>" data-seq="<?=$v['ai_seq']?>">
				<a href="/m/index.php/mobile/contents/search_hospital/doView?seq=<?=$v['ai_seq']?>" class="image loaded">
					<div class="inner">
						<div class="item-specific"></div>
						<?if(array_key_exists($v['ai_seq'], $thums)):?>
						<img src="<?=$thums[$v['ai_seq']]['url']?>" alt="">
						<?else:?>
						<img src="/resource/images/medical/map_images/none_image.png" alt="">
						<?endif;?>
					</div>
				</a>
				
				<div class="wrapper2">
					<a href="/m/index.php/mobile/contents/search_hospital/doView?seq=<?=$v['ai_seq']?>" id="<?=$k+1?>"><h3><?=$v['ai_name']?></h3></a>
					<figure>
						<?=$v['ai_addr']?>
					</figure>
					
					
					<div class="price">
					<?if($v['has_event']):?>
						<img src="/resource/images/medical/icons/icon_event.png" alt="이벤트 중" />
					<?endif;?>
					<?if($v['is_alied']):?>
						<img src="/resource/images/medical/icons/icon_alied.png" alt="제휴 중" />
					<?endif;?>								
					</div>
					

					<div class="info">
						<div class="rating" data-rating="5">
							<span class="stars">
							</span>
						</div>
					</div>
				</div>
			</div>						
		</li>
		<?endforeach;?>
		<?endif;?>
	</ul>
	<div class="btn-area-center" style="margin:0px;">
		<?if($ai_name):?>
		<input type="button" value="더보기" id="more-btn" class="btn btn-default" style="width:100%;" onclick="nextPageByName()"/>
		<?else:?>
		<input type="button" value="더보기" id="more-btn" class="btn btn-default" style="width:100%;" onclick="nextPage()"/>
		<?endif;?>
	</div>
	

</div>


<script type="text/javascript">
$(document).ready(function(){
	setSideFrame('<?=$ne?>','<?=$sw?>');
});
//functions
var side_data_list = [];
var list_number = 0;
var visibleItemsArray = [];
var current_page = 0;

function setSideFrame(ne, sw){	
	var search_text = $('#ai-name').val();	
	if(search_text) return false;
	clearData();
	var json_url = '/m/index.php/mobile/contents/search_hospital/searchLat';					
	//json 부분
	var target_json_url = json_url+'?ne='+ne+'&sw='+sw+'&page=1';
	
	var json_obj = $.getJSON(target_json_url)
	.done(function(json) {	
		for(var i = 0; i < json.data.length ; i++){
			addData(json.data[i], i);									
		}				
	}); //json 종료

	json_obj.complete(function(){	
		$('#row-total').html(side_data_list.length);
		$('#more-btn').val('더보기');	
		nextPage();	
	});
}

function clearData(){
	current_page = 0;
	side_data_list = [];
	$('#map-list-area .results').html('');
	visibleItemsArray = [];
	list_number = 0;
}

function addData(data, i){
	side_data_list[list_number] = data;
	list_number++;
}




var print_area = false;
var c_page = 1;
var ai_name = '<?=$ai_name?>';
var total_page = 0;
var default_json_url = '/m/index.php/mobile/contents/search_hospital/doListToJson';
var no_more = false;
$(document).ready(function(){
	print_area = $('#main-left-list');
	total_page = $('#row-total').data('total');	
	checkLast();
	if(no_more) setBtnLast();
});

function nextPageByName(){
	if(no_more){
		alert('마지막 페이지 입니다.');
		return false;
	}
	c_page++;	
	checkLast();
	if(no_more){
		setBtnLast();		
	}

	var json_url = default_json_url+'?q_page='+c_page+'&ai_name='+ai_name;

	var json_obj = $.getJSON(json_url)
	.done(function(json) {	
		for(var i = 0; i < json.data.length ; i++){	
			setHtml(json.data[i]);
		}				
	}); //json 종료
}

function setHtml(data){
	var itemPrice;
	var add_string = '';
	if(data.rating && data.rating > 0){
		add_string = '<div class="rating" data-rating="' + data.rating + '"></div>';				
	}

	var html = '<li>' +
			'<div class="item" id="' +data.id + '"  data-seq="'+data.ai_seq+'" >' +
				'<a href="<?=$menu_url?>/doView?seq='+data.ai_seq+'" class="image">' +
					'<div class="inner">' +
						'<div class="item-specific">' +                            
						'</div>' +
						'<img src="' + data.gallery[0] + '" alt="">' +
					'</div>' +
				'</a>' +
				'<div class="wrapper2">' +
					'<a href="<?=$menu_url?>/doView?seq='+data.ai_seq+'" id="' + data.id + '"><h3>' +data.title + '</h3></a>' +
					'<figure>' + data.location + '</figure>' +
					'<div class="price">' +
					data.type +
					data.price +
					'</div>'+
					'<div class="info">' +                       
						add_string+
					'</div>' +
				'</div>' +
			'</div>' +
		'</li>';

	print_area.html(print_area.html()+html);
}

function checkLast(){
	if(total_page <= c_page) no_more = true;
}

function setBtnLast(){
	$('#more-btn').val('마지막 페이지입니다.');
}








function nextPage(){
	var page_per_row = 10;
	current_page++;
	var start_pointer = (current_page-1) * page_per_row;
	var last_pointer = start_pointer+page_per_row;	

	var pointer = 0;
	$.each(side_data_list, function(a) {
		if( pointer >= start_pointer && pointer < last_pointer){

			if(side_data_list[a]){
				pushItemsToArray2(side_data_list[a], visibleItemsArray);
				$('#map-list-area .results').html( visibleItemsArray );
				rating('.results .item');
			}

			pointer++;
		}else if(pointer < start_pointer){
			pointer++;
			return true;
		}else if(pointer >= last_pointer) return false;
		
	});
	
	//hover
	var $singleItem = $('.results .item');
	$singleItem.hover(
		function(){
			var seq = $(this).data('seq');
			var el_id = '#icon-'+seq;
			if($(el_id).length > 0){
				$(el_id).attr('class', 'marker-active marker-loaded');
			}

		},
		function() {
			var seq = $(this).data('seq');
			var el_id = '#icon-'+seq;
			if($(el_id).length > 0){
				$(el_id).attr('class', 'marker-loaded');				
			}
		}
	);



	if(pointer >= side_data_list.length){
		$('#more-btn').val('마지막 페이지 입니다.');	
	}

}



function pushItemsToArray2(data, visibleItemsArray){
    var itemPrice;

	var add_string = '';

	if(data.rating && data.rating > 0){
		add_string = '<div class="rating" data-rating="' + data.rating + '"></div>';				
	}

    visibleItemsArray.push(
        '<li>' +
            '<div class="item" id="' +data.id + '"  data-seq="'+data.ai_seq+'" >' +
                '<a href="<?=$menu_url?>/doView?seq='+data.ai_seq+'" class="image">' +
                    '<div class="inner">' +
                        '<div class="item-specific">' +                            
                        '</div>' +
                        '<img src="' + data.gallery[0] + '" alt="">' +
                    '</div>' +
                '</a>' +
                '<div class="wrapper2">' +
                    '<a href="<?=$menu_url?>/doView?seq='+data.ai_seq+'"><h3>' +data.title + '</h3></a>' +
                    '<figure>' + data.location + '</figure>' +
                    '<div class="price">' +
					data.type +
					data.price +
					'</div>'+
                    '<div class="info">' +                       
                        add_string+
                    '</div>' +
                '</div>' +
            '</div>' +
        '</li>'
    );

    function drawPrice(price){
        if( price ){
            itemPrice = '<div class="price">' + price +  '</div>';
            return itemPrice;
        }
        else {
            return '';
        }
    }
}
</script>
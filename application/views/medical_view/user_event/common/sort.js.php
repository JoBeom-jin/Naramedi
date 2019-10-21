<script>
$(document).ready(function(){
  var sort_value = $('input[name="sort"]').val();
  if(sort_value){
	  $('.sort-selector').find('span').attr('style', 'color:#888;');
	  $('.sort-selector').find('i').remove();	  

	  var selected = $('.sorting').find('.sort-selector[data-sort="'+sort_value+'"]');
	  // $('<i/>').attr({'class':'fa fa-check', 'style':'color:red;'}).prependTo(selected);
	  selected.find('span').attr('style', '');	
  }
});


//sort selector
$('.sort-selector').on('click', function(e){	
	e.preventDefault();
	var sort_value = $(this).data('sort');	
	$('input[name="sort"]').val(sort_value);
	
	$('.sort-selector').find('span').attr('style', 'color:#888;');
	$('.sort-selector').find('i').remove();

	// $('<i/>').attr({'class':'fa fa-check', 'style':'color:red;'}).prependTo($(this));
	$(this).find('span').attr('style', '');	
	list_sorting();
});

function list_sorting(){	
	//sort selector	
	clear_area();
	more_list();	
}
</script>
function check_event(seq){	
	var el_id = '#eiseq_'+seq+' i';
	
	$(el_id).removeClass('fa-heart-o');
	$(el_id).addClass('fa-heart');
}

function cancel_event(seq){
	var el_id = '#eiseq_'+seq+' i';
	
	$(el_id).removeClass('fa-heart');
	$(el_id).addClass('fa-heart-o');
}
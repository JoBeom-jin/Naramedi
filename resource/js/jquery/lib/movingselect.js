/*
* new movingselect($('#availableGroupList'),$('#memberGroupList'), $('#member_form'), 'groups' );
*/
function movingselect(source, target, form, result_name){
	this.source_ = source;
	this.target_ = target;
	this.form_ = form;
	this.result_ = result_name;	
	this.set();
	this.result();
}

movingselect.prototype.set = function(){	
	
	var source = this.source_;
	var target = this.target_;

	this.source_.dblclick(function(){		
		var option = $('<option/>');
		option.attr({'value' : source.find('option:selected').val() }).text(source.find('option:selected').text());		
		target.append(option);
		source.find('option:selected').remove();
	});

	this.target_.dblclick(function(){
		var option = $('<option/>');
		option.attr({'value' : target.find('option:selected').val() }).text(target.find('option:selected').text());
		source.append(option);
		target.find('option:selected').remove();				
	});
}

movingselect.prototype.makeResult = function(){
	$('#member option').each(function(){
		$('<input>').attr({
			'type':'hidden',
			'name':'groups[]',
			'value':$(this).val()
		}).appendTo('#member_form');
	});
}

movingselect.prototype.result = function(){
	var target = this.target_;
	var result_name = this.result_+'[]';
	var form = this.form_;
	this.form_.submit(function(event){
		target.find('option').each(function(){
			$('<input>').attr({
				'type':'hidden',
				'name':result_name,
				'value':$(this).val()
			}).appendTo(form);			
		});	
	});	
}
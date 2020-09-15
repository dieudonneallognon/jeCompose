$(function() {
	
	$('article').addClass('panel panel-default');
	
	$('article div:nth-child(1)').addClass('panel-heading');
	$('article div:nth-child(2)').addClass('panel-body');
	$('article div:nth-child(3)').addClass('panel-footer');
	
	$('h3').addClass('panel-title');
	
	$('label input').attr('type', 'radio');
	$('article li:nth-child(1) label input').attr('value', 'a');
	$('article li:nth-child(2) label input').attr('value', 'b');
	$('article li:nth-child(3) label input').attr('value', 'c');
	
	for($i=1, $l=$('article').length; $i<=$l ; $i++){
		$('article:nth-child('+$i+') input').attr('name', 'q'+$i);
	}
});

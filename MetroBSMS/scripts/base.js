$(document).ready(function() {
	$('.prepopulate').each(function(){
  $(this).val( $(this).attr('rel') );
});
 
$('.prepopulate').focus( function(){
  if( $(this).val() == $(this).attr('rel') ){
	$(this).val('').addClass('not-empty'); 
  }
});   

$('.prepopulate').blur(function(){
  if( $(this).val() =='' ){
	$(this).val( $(this).attr('rel') ).removeClass('not-empty');
  }

});	
});
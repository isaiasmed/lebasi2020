$(document).ready(function(){
	// no gracias se esconde el modal
	$('body').on('submit','.inscribete',function(){
		$this=$(this);
		$(this).find('.bg-warning').remove();
		$(this).find('button').hide().after('<i class="fa fa-cog fa-spin"></i>');
		$.post(ajaxurl,$(this).serialize(),function(response){
			console.log(response);
			if(!response.error){
				location.href=response.url;
			}else{
				$this.find('button').show().after('<p class="bg-warning text-white p-3 mt-3">'+ response.msg +'</p>');
				$this.find('i').remove();
			}
		});
		return false;
	});
});
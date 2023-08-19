$(document).ready(function(){
	// no gracias se esconde el modal
	$('body').on('submit','#promo',function(){
		$this=$(this);
		$(this).find('.bg-warning').remove();
		$(this).find('button').hide().after('<i class="fa fa-cog fa-spin"></i>');
		$.post(ajaxurl,$(this).serialize(),function(response){
			console.log(response);
			if(!response.error){
				$this.find('button').show().after('<p class="bg-success text-white p-3 mt-3">Muchas gracias por tu pregunta en breve recibiras una respuesta.</p>');
				$this.find('i').remove();
			}else{
				$this.find('button').show().after('<p class="bg-warning text-white p-3 mt-3">'+ response.msg +'</p>');
				$this.find('i').remove();
			}
		});
		return false;
	});
});
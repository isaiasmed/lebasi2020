$(document).ready(function(){
	// no gracias se esconde el modal
	$('body').on('click','#giftnothanks',function(){
		$('.modalregalos').fadeOut('slow');
		return false;
	}).on('click','.giftleb',function(){
		numgiftsallowed=$('.regalos').data('gifts');
		if(!$(this).hasClass('disabled')){
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$('.i-'+$(this).data('id')).remove();
			}else{
				$('#gifsearch').append('<input class="searchgiftinput i-'+$(this).data('id')+'" type="hidden" name="search[]" value="'+$(this).data('id')+'">');
				//console.log($(this))
				
				$(this).addClass('active');
			}
		}
		var conteo= $('.searchgiftinput').length;
		if(conteo==numgiftsallowed){
			
			$.each($('.giftleb'),function(a,b){
				if(!$(b).hasClass('active')){
					$(b).addClass('disabled');
				}
			});
			$('.giftbtn').prop('disabled',false);
		}else{
			$.each($('.giftleb'),function(a,b){
				$(b).removeClass('disabled');
			});
			$('.giftbtn').prop('disabled',true);
		}
	}).on('click','.giftbtn',function(){
		var data=$('#gifsearch :input').serialize();
		console.log(data);
		$.post(ajaxurl,data,function(response){
			location.reload(); 
		});
		return false;
	});
});
var mouseX = 0;
var mouseY = 0;
var popupCounter = 0;

document.addEventListener("mousemove", function(e) {
    mouseX = e.clientX;
    mouseY = e.clientY;
});

$(document).mouseleave(function () {
    if (mouseY < 30) {
        if (popupCounter < 1) {
          // $('.notevayas').fadeIn();
        }
        popupCounter ++;
    }
});


$(function(){
	var xhr;
	//alert(screen.height);
	//alert(screen.width);
	
	window.mobileAndTabletcheck = function() {
		var check = false;
		(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
		  return check;
	};
	
	$('.close_notevayas').on('click',function(){
		$('.notevayas').animate({"right": '-=200%'});
		return false;
	});

	//Error tap menu
	$('li.mder a').click(function(){
		$('.overgral').fadeIn('slow');
	});
	var check=window.mobileAndTabletcheck();
	if(check){
		$( '#menux >li:has(li)' ).click(function(){
			return false;
		});
		$('li.mder a').click(function(){
			alert('Prueba');
			$('.overgral').fadeIn('slow');
			window.location.href = $(this).attr('href');
		});
		$('.whatsapp').fadeIn();
	}
	//$('.whatsapp').fadeIn();
	
	/*Accordion*/
	$('#accordion').find('.accordion-toggle').click(function(){

      //Expand or collapse this panel
      $(this).next().slideToggle('fast');

      //Hide the other panels
      $(".accordion-content").not($(this).next()).slideUp('fast');

    });	
	
	
	
	
	/*Woocommerce*/
	$('.payment_method_ppec_paypal img').prop('src','https://lebasi.com.mx/lebasiweb/wp-content/uploads/2018/05/PayPal_negro.png');

	$('body:not(.menu_barra)').click(function(){
		$('.menu_barra').addClass('oculto');
		$('.menu_barra').removeClass('visible');
	});
	
	//alert(window.screen.width);
	
	$('.menupal a.mena').click(function(){
		if($('.menu_barra').hasClass('oculto')){
			$('.menu_barra').addClass('visible');
			$('.menu_barra').removeClass('oculto');
		}else{
			$('.menu_barra').addClass('oculto');
			$('.menu_barra').removeClass('visible');
		}
		return false;
	});
	

	
	
	var waypoint = new Waypoint({
	  element: $('.menu_fijo'),
	  offset: '2vh',
	  handler: function(direction) {
		if($('.home').length>0){
			if(direction=='down'){  
				this.element.addClass('fijado');
			}else{
				this.element.removeClass('fijado');
			}
		}
	  }
	});
	
	$('.clicksecc').click(function(){
		var secc = $(this).data('sec');
		console.log($('.'+secc));
		$('body').scrollTo($('.'+secc),1500,{offset:-50});
		return false;
	});
	// Form contacto

	$('.contacto').submit(function(){
		$('.hover').fadeIn();
		boton=$(this);
		texto = boton.find('button').html();
		boton.find('button').html('<i class="fas fa-sync fa-spin"></i> Enviando...');
		if(xhr!=null){xhr.abort();}
		xhr=$.post(ajaxurl,$(this).serialize(),function(response){
			console.log(response);
			$('.contacto').html('<div style="margin:0 auto;" class="success"><i class="fas fa-check"></i> Tu mensaje se ha enviado, gracias por ponerte en contacto con Lebasi.</div>');
			$('.hover').fadeOut(1000);
		});
		return false;
	});
	
	$('.insc').submit(function(){
		$('.error').remove();
		boton=$(this);
		texto = boton.find('button').html();
		boton.find('button').html('<i class="fas fa-sync fa-spin"></i> Enviando...');
		if(xhr!=null){xhr.abort();}
		$('.hover').fadeIn();
		xhr=$.post(ajaxurl,$(this).serialize(),function(response){
			console.log(response);
			if(!response.error){
				window.location.href = siteurl + '/tienda';
			}else{
				$('.insc').append('<div class="error"><i class="fas fa-ban"></i> '+ response.msg+'</div>');
				boton.find('button').html(texto);
				$('.hover').fadeOut();
			}
		});
		return false;
	});
	
	$('.distLebasi').click(function(){
		$( ".woocommerce-Button[name='register']" ).hide();
		$('.distributors').fadeIn();
		return false;
	});
	var xhr;
	$('.check').click(function(){
		$('.error').remove();
		boton=$(this);
		texto=boton.html();
		boton.html('<i class="fa-spin fas fa-cog"></i> Verificando...');
		if(xhr!=null){xhr.abort();}
		xhr=$.post(ajaxurl,{'action':'getDatosEmpresario','numEmpresario':$('#numEmpresario').val(),'rfcEmpresario':$('#rfcEmpresario').val()},function(response){
			if(response.error){
				$('.distributors').append('<div class="error">'+response.msg+'</div>');
				boton.html(texto);
			}else{
				$('#EmpresarioHidden').val($('#numEmpresario').val());
				$('#numEmpresario').attr('disabled',true);
				$('#rfcEmpresario').attr('disabled',true);
				$('.distributors').append('<div class="success"><i class="far fa-check-circle"></i> Empresario Verificado</div>');
				boton.remove();
				$('.cancel').remove();
				$( ".woocommerce-Button[name='register']" ).fadeIn();
			}
		});
		return false;
	});
	
	$('.cancel').click(function(){
		$('#numEmpresario').val('');
		$('#rfcEmpresario').val('');
		$('#EmpresarioHidden').val('');
		$('.distributors').fadeOut();
		return false;
	});
	
	
	$('body').on('click','.patrocinado',function(){
		console.log($('.patrocina').val());
		$('#mensajePatrocina').fadeIn('slow');
		$('#mensajePatrocina').html('<i class="fas fa-sync fa-spin"></i> Consultando datos espere...');
		xhr=$.post(ajaxurl,{'action':'checarEmpresario','NumEmpresario':$('.patrocina').val()},function(response){
			console.log(response);
			$('#mensajePatrocina').html('');
			if(response.Error){
				$('#mensajePatrocina').html(response.msj+ ' Se asignará por defecto 00000 | Lebasi México S.A. de C.v.');
				$('#hiddenPatrocina').val('00000');
			}else{
				$('#mensajePatrocina').html('<i style="color:#50b400; font-size:18px;" class="fas fa-check-circle"></i> '+response.NumEmpresario+' | '+response.Nombre+'. Se te asignara este empresario como patrocinador');
				$('#hiddenPatrocina').val(response.NumEmpresario);
			}
		});
		return false;
	});
	
	if($('#dZUpload').length>0){
		Dropzone.autoDiscover = false;
		var url=$('#dZUpload').data('url');
		console.log(url)
		var hidden=$($('#dZUpload').data('hidden'));
		$("#dZUpload").dropzone({
			url: url,
			addRemoveLinks: true,
			maxFiles: 1,
			uploadMultiple: false,
			dictDefaultMessage:'Arrastra los archivos aqui',
			dictCancelUpload:'Cancelar',
			dictRemoveFile:'Quitar Archivo',
			success: function (file, response) {
				var imgName = response;
				file.previewElement.classList.add("dz-success");
				//console.log("Successfully uploaded :" + imgName);
				hidden.val(response);
			},
			error: function (file, response) {
				alert(response);
				hidden.val('');
			}
		});
	}
	if($('#dZUpload2').length>0){
		Dropzone.autoDiscover = false;
		var url=$('#dZUpload2').data('url');
		var hidden=$($('#dZUpload2').data('hidden'));
		$("#dZUpload2").dropzone({
			url: url,
			addRemoveLinks: true,
			maxFiles: 1,
			uploadMultiple: false,
			dictDefaultMessage:'Arrastra los archivos aqui',
			dictCancelUpload:'Cancelar',
			dictRemoveFile:'Quitar Archivo',
			success: function (file, response) {
				var imgName = response;
				file.previewElement.classList.add("dz-success");
				//console.log("Successfully uploaded :" + imgName);
				hidden.val(response);
			},
			error: function (file, response) {
				alert(response);
				hidden.val('');
			}
		});
	}
	if($('#tabs').length>0){
		$("#tabs").steps({
			// Disables the finish button (required if pagination is enabled)
			enableFinishButton: false, 
			// Disables the next and previous buttons (optional)
			enablePagination: false, 
			// Enables all steps from the begining
			enableAllSteps: true,
			// Removes the number from the title
			titleTemplate: "#title#",
			headerTag:'h1',
			transitionEffect:'slideLeft'
		});
	}
	
	$('.over:not(a)').click(function(){
		$('.over').fadeOut('slow');
	});
	
	$(".compra_dist").click(function(){
		$('html, body').animate({
			scrollTop: ($("#tiendadist").offset().top)-80
		}, 2000);
		return false;
	});
	
	
	
	//$( ".woocommerce-Button[name='register']" ).hide();

});  
 //FontAwesomeConfig = { searchPseudoElements: true };
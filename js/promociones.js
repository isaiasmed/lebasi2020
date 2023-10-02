$(function(){
	//alert(navigator.userAgent);
	
	var pathArray = window.location.hash.split('#')[1];
	window.onhashchange = function() {
	  console.log( window.location.href);
	  if(window.location.href=="https://lebasi.com.mx/promociones/"){
		$('.element3').show();
		$('#galeria').show();
		$('#element').hide();
		$('#element2').hide();
	  }
	}
	
	$('.btn-premios').on('click',function(){
		$('#promo23pub').show();
		$('#promo23').hide();
		if($(this).data('tipo')=="empresario"){
			$('#promo23pub').hide();
			$('#promo23').show();
		}
		$('.texto').fadeOut();
		$('.forms').fadeIn();
		$('#imgsrc').val($(this).data('src'));
		$('#tipo').val($(this).data('tipo'));
		
		console.log($(this).data('src'));
		juego();
		return false;
	});

	$("#2show").on('click', function() {
		$("#element2").show();
		$("#element").hide();
		$("#galeria").hide();
		$(".element3").attr('style','display:none !important');
		$('html, body').animate({
			scrollTop: $("#element2").offset().top - 100
		}, 500);
		state={ 'page_id': 1}
		history.pushState(state, 'Con Lebasi Todos Ganan', window.location.hash.split('#')[0]+'#registro')
		return false;
	});
	$("#show").on('click', function() {
		$("#element").show();
		$("#element2").hide();
		$("#galeria").hide();
		$(".element3").attr('style','display:none !important');
		$('html, body').animate({
			scrollTop: $("#element").offset().top - 100
		}, 500);
		state={ 'page_id': 1}
		history.pushState(state, 'Con Lebasi Todos Ganan', window.location.hash.split('#')[0]+'#consulta')
		return false;
	});
	if(pathArray=='consulta'){
		$("#show").trigger('click');
		console.log(pathArray);
	}
	if(pathArray=='registro'){
		$("#2show").trigger('click');
		console.log(pathArray);
	}
	$("#flotante").on('click', function() {
		$('.element3').show();
		$('#galeria').show();
		$('#element').hide();
		$('#element2').hide();
		return false; 
	});
	
	$('.cerrarimgini').on('click',function(){
		$(".element3").attr('style','display:none !important');
		return false;
	});
	

	$("#concursar").on('click', function() {
		$('html, body').animate({
			scrollTop: $("#destino2").offset().top - 100
		}, 500);
		return false;
	});
	
	$("#alertgaleria").on('click', function() {
		$('html, body').animate({
			scrollTop: $("#galeria").offset().top - 100
		}, 500);
		return false;
	});
	
	$("#subirfotobtn").on('click', function() {
		$('html, body').animate({
			scrollTop: $("#subirfoto").offset().top-100
		}, 500);
		return false;
	}); 
	
	
	
	
	
	$('#search').html('Enviar').prop('disabled',true);
		
	$('#fechacita').on('change',function(){
		$('.msjcitas').remove();
		$('#horaselect').closest('table').after('<small class"msjcitas"><i class="fa fa-spin fa-refresh"></i> Consultando citas...</small>')
		console.log($(this).val());
		var maxcitas=1;
		$(this).prop('disabled',true);
		$('#horaselect').prop('disabled',true);
		$.post(ajaxurl,{'action':'consultarfechacita','fecha':$(this).val()},function(response){
			if(response.weekend){
				alert('Lo sentimos, no podemos agendar citas en fin de semana');
				$('#horaselect').val('').prop('disabled',true);
			}else{
				if(response.citas){
					$.each($('#horaselect').find("option"),function(a,b){
						if(response.citas[b.value]){
							if(response.citas[b.value].length>=maxcitas){
								$(b).prop('disabled',true);
							}else{
								$(b).prop('disabled',false);
							}
						}else{
							$(b).prop('disabled',false);
						}
					});
				}
				$('#horaselect').val('').prop('disabled',false);
			}
			$('#fechacita').prop('disabled',false);
			
		});	
		$('.msjcitas').remove();
	});
	
	
	$('#promo23').submit(function(){
		btn=$(this).find('button');
		btn.html('<i class="fa fa-spin fa-refresh"></i> Revisando información...').prop('disabled',true);
		$.post(ajaxurl,{'action':'revisarem','remision':$('#remision').val(),'nombre':$('#nombre').val()},function(response){
			if(response.mensajes==""){
				$('#promo23').hide(1000);
				$('.forms').hide();
				$('#concurso').show(1000);
				$('#game-container').show(1000);
			}else{ 
				alert(response.mensajes);
				btn.html('Enviar').prop('disabled',false);
			}
		});
		return false;
	});
	$('#promo23pub').submit(function(){
		btn=$(this).find('button');
		btn.html('<i class="fa fa-spin fa-refresh"></i> Revisando información...').prop('disabled',true);
		$.post(ajaxurl,{'action':'revisarem2','lote':$('#lote').val(),'caja':$('#caja').val(),'bote':$('#bote').val()},function(response){
			if(response.mensajes==""){
				$('#promo23pub').hide(1000);
				$('.forms').hide();
				$('#concurso').show(1000);
				$('#game-container').show(1000);
			}else{ 
				alert(response.mensajes);
				btn.html('Enviar').prop('disabled',false);
			}
		});
		return false;
	});
	
	$('#registropromo').on('submit',function(){
		var numbote = $('#numbote').val();
		if(numbote<25){
			var formdata= $('#registropromo').serialize();
			var textor=$('#search').html();
			console.log(textor);
			$('#search').html('<i class="fa fa-cog fa-spin"></i> Enviando...').prop('disabled',false);
			$.post(ajaxurl,formdata,function(response){
				var validacion=response.validacajas;
				console.log(validacion);
				if(validacion===true){
						$.each(response,function(a,b){
							$('#guardarconsulta').find(('input[name="'+a+'"]')).val(b);
						});
						$('#search').remove();
						$("#registropromo").data('link',response.link);
						myFunction();
					}else{
						alert('No podemos validar el bote, si cuentas con el bote y aun no lo has registrado comunícate con nosotros para resolver la situación');
						$('#search').html(textor);
					}
				
			});
		}else{
			alert('No podemos validar el bote, si cuentas con el bote y aun no lo has registrado comunícate con nosotros para resolver la situación');
		}
		return false;
	});
	
	$('#guardarconsulta').on('submit',function(){
		var formdata= $('#guardarconsulta').serialize();
		var textor=$('#alertcita').html();
		$('#alertcita').html('<i class="fa fa-cog fa-spin"></i> Enviando...').prop('disabled',true);
		$.post(ajaxurl,formdata,function(response){
			$.each(response,function(a,b){
				$('#registropromo').find(('input[name="'+a+'"]')).val(b);
			});
			myFunction2();
			$('#guardarconsulta').find('#alertcita').hide();
		}).fail(function(){
			$('#guardarconsulta').find('#alertcita').show().html(textor).prop('disabled',false);
		});
		
		return false;
	});
	
	$("#concursar2").on('click', function() {
		$('html, body').animate({
			scrollTop: $("#destino").offset().top - 100
		}, 500);
		return false;
	});
	
	$("#alertgaleria2").on('click', function() {
		$('html, body').animate({
			scrollTop: $("#galeria").offset().top - 100
		}, 500);
		return false;
	});
	
	
	$('#login2').on('click',function(){
		FB.login(function(response) {
		   statusChangeCallback(response);
		   console.log(response);
		},{scope: 'email'});
	})
	
	
	if($('#dZPromocion').length>0){
		Dropzone.autoDiscover = false;
		var url=$(dZPromocion).data('url');
		console.log(url)
		var hidden=$($('#dZPromocion').data('hidden'));
		var hidden2=$($('#dZPromocion').data('hidden2'));
		promoupload = $("#dZPromocion").dropzone({
			url: url,
			addRemoveLinks: true,
			maxFiles: 1,
			uploadMultiple: false,
			dictDefaultMessage:'Arrastra los archivos aqui',
			dictCancelUpload:'Cancelar',
			dictRemoveFile:'Quitar Archivo',
			paramName: "file", // The name that will be used to transfer the file
			init: function() {
				this.on("thumbnail", function(file) {
					if (file.width >3000 || file.height > 3000) {
						file.rejectDimensions();
					}else {
						if(file.size < 1024*1024*10/*3MB*/)
						{
							file.acceptDimensions();
						}else{
							file.rejectsize();
						}
					}
				})
			},
			accept: function(file, done) {
				file.rejectDimensions = function() { 
					done("La imagen debe tener una altura minima de 3000px y un ancho minimo de 3000px"); 
					file.previewElement.remove();
					$('.dz-default').show();
				};
				file.rejectsize = function() { 
					done("La imagen no debe pesar mas de 10 MB");
					file.previewElement.remove();
					$('.dz-default').show();
				}
				file.acceptDimensions = done;
				$('.dz-default').hide();
			},
			success: function (file, response) {
				var imgName = response;
				file.previewElement.classList.add("dz-success");
				//console.log("Successfully uploaded :" + imgName);
				hidden.val(response.guid);
				hidden2.val(response.post_id);
				$('#search').prop('disabled',false);
			},
			error: function (file, response) {
				alert(response);
				hidden.val('');
				$('#search').prop('disabled',true);
			}
		});
	}
	
	$('#divcodigo').slideUp(0);
	$('body').on('click','.votabtn',function(){
		var idfoto=$(this).data('foto');
		var source=$(this).data('source');
		var email=$(this).data('mail');
		var nombre=$(this).data('nombre');
		var apellido=$(this).data('apellido');
		$.post(ajaxurl,{'action':'emitevoto','foto':idfoto,'source':source,'email':email,'nombre':nombre,'apellido':apellido},function(response){
			console.log(response);
			if(response.voto){
				$('.votabtn').remove();
				$('.countvotos').html(($('.countvotos').html()*1)+1); 
				alert('Gracias por tu voto, puedes seguir apoyando fotos en nuestra galeria');
			}else{
				alert(response.mensaje);
			}
		}).fail(function(){
			alert('Ocurrio un error con tu voto, intentalo mas tarde');
		});
		console.log($(this));
	}).on('click','#btnCodigo',function(){
		$('#divcodigo').slideDown('slow');
		$('#validarInput').val(1);
		$('#btnCodigo').remove(); 
		return false;
	}).on('submit','#promocionM',function(){
		//recaptcha
		recaptcha();
		
		
		
		return false;
	});
	
	function recaptcha(){
		grecaptcha.ready(function () {
			grecaptcha.execute('6LcHWi0fAAAAAJGxohxFdMMwrUHmkuy_cef2wBOF', { action: 'submit' }).then(function (token) {
				var recaptchaResponse = document.getElementById('recaptchaResponse');
				console.log(token);
				recaptchaResponse.value = token;
				if($('#validarInput').val() == 1){
					if($('#codigo').val()==''){
					alert('No haz introducido ningún código');
					}else{
						var formdata= $(this).serialize();
					//console.log(formdata);
					//alert(codigos);
					$('#formPromo2022').hide().after('<p class="mensaje"><i class="fa fa-cog fa-spin"></i> Guardando tu información, espere por favor...</p>');
					xhr=$.post(ajaxurl,formdata,function(response){
						//alert(response);
						console.log(response);
						if(response.codigo==0){ 
							alert('Este código no existe, favor de colocar un código válido.');
							$('#codigo').val('');
							$('#formPromo2022').show();
							$('.mensaje').remove();
						}else if(response.correo==1){
							alert('Este correo ya ha sido registrado, favor de colocar otro correo.');
							$('#correo').val('');
							$('#formPromo2022').show();
							$('.mensaje').remove();
						}else if(response.correo==1){
							alert('Verifica que eres humano');
							//$('#correo').val('');
							$('#formPromo2022').show();
							$('.mensaje').remove();
						}else{
							$('#registradoPromo').html(response);
							$('.mensaje').remove();
							alert("Se ha registrado tu información, ¡Gracias!");
						}
					});	
					}
				}else{
					var formdata= $('#promocionM').serialize();
					//console.log(formdata);
					//alert(codigos);
					$('#formPromo2022').hide().after('<p class="mensaje" style="font-size:20px; text-align:center;"><i class="fa fa-cog fa-spin"></i> Guardando tu información, espere por favor...</p>');
					xhr=$.post(ajaxurl,formdata,function(response){
						console.log(response);
						/*if(correo==0){
							$('#registradoPromo').html(response);
							$('.mensaje').remove();
							alert("Se ha registrado tu información, ¡Gracias por participar!");
						}else if (correo>0){
							alert('Este correo ya ha sido registrado, favor de colocar otro correo.');
							$('#correo').val('');
							$('#formPromo2022').show();
							$('.mensaje').remove();
						}*/
						if(response.correo>0){
							alert('Este correo ya ha sido registrado, favor de colocar otro correo.');
							$('#correo').val('');
							$('#formPromo2022').show();
							$('.mensaje').remove();
						}else{
							$('#registradoPromo').html(response);
							$('.mensaje').remove();
							alert("Se ha registrado tu información, ¡Gracias por participar!");
						}
						//alert("Se ha registrado tu información, ¡Gracias!");
					});	
				}
			});
		});
	}
	
	$( window ).on( "load", function() {
		// add event listener on the login button
		$("#login").click(function(){
			facebookLogin();   
		});

		// add event listener on the logout button
		$("#logout").click(function(){
		   $("#logout").hide();
		   $("#login").show();
		   $("#status").empty();
		   facebookLogout();
		});
		
		$('.grid').masonry({
		  // options
		  itemSelector: '.grid-item',
		  columnWidth: 120
		});
	});
	
	function facebookLogin(){
	   FB.getLoginStatus(function(response) {
		   statusChangeCallback(response);
		   console.log(response);
	   });
	}

	function statusChangeCallback(response){
		console.log(response);
		if(response.status === "connected"){
			var idfoto=$('.votocontaimer').data('id');
			$("#login").hide();
			$("#login2").hide();
			$('#g_id_onload').hide();
			$('.g_id_signin').hide();
			//$("#logout").show();
			//console.log(response);
			
			fetchUserProfile();
		}else{
			// Logging the user to Facebook by a Dialog Window
			facebookLoginByDialog();
			$('#login2').trigger('click');
		}
	}

	function fetchUserProfile(){
	   var idfoto=$('.votocontaimer').data('id');
	   FB.api('/me?fields=id,name,email,last_name,first_name', function(response){
		   console.log(response);
			$('#login').after('<button class="btn votabtn" data-apellido="'+response.last_name+'" data-nombre="'+response.first_name+'" data-source="facebook" data-foto="'+idfoto+'" data-mail="'+response.email+'"><i class="fa fa-heart-o"></i> Votar por esta fotografía</button>').hide();	
		    $('.votabtn').data('mail',response.email);
			$("#login").hide();
			$("#login2").hide();
			$('#g_id_onload').hide();
			$('.g_id_signin').hide();
		});
	}

	function facebookLoginByDialog(){
		
	}

	// logging out the user from Facebook
	function facebookLogout(){
		FB.logout(function(response) {
		   statusChangeCallback(response);
		});
	}
}); 

function myFunction2() {
	Swal.fire({
		title: 'Te registraste correctamente!',
		html: 'Descarga tu   <a  href="https://lebasi.com.mx/promociones/descargas/dieta/" target="_blank">DIETA DETOX</a> <br><br> No olvides participar en nuestro <b>Concurso de Fotografía en donde podrás ganar hasta $20,000 pesos. Da click aquí para concursar: <a id="concursar" href="#"  onClick="trigger();">Concursar</a>',
		imageUrl: '../wp-content/themes/lebasi2020/images/Dinero2.jpg',
		imageWidth: 400,
		imageHeight: 300,
		imageAlt: 'Custom image',
		confirmButtonText: ' <button id="alertgaleria" class="btn btn-primary"  " onclick="muestragaleria();">Ver Fotos de Concurso</button>',
	});
}
function trigger(){
	$('#2show').trigger('click');
	Swal.close();
}


function CopyMe(TextToCopy) {
  var TempText = document.createElement("input");
  TempText.value = TextToCopy;
  document.body.appendChild(TempText);
  TempText.select();  
  document.execCommand("copy");
  document.body.removeChild(TempText);
  
  alert("El enlace: " + TempText.value + " se ha copiado al portapapeles.");
}

function myFunction() {
	Swal.fire({
		title: 'Te registraste correctamente!',
		 html: ' No olvides de Agendar la cita gratuita con uno de nuestros nutriólogos solo sigue el siguiente vinculo <a id="concursar2" href="#"  onClick="trigger2();">Agendar cita</a><br><button id="alertgaleria2" class="btn btn-primary"  " onclick="muestragaleria();">Ver Fotos de Concurso</button>',
		imageUrl: '../wp-content/themes/lebasi2020/images/landing1.jpg',
		imageWidth: 400,
		imageHeight: 300,
		imageAlt: 'Cita',
		confirmButtonText: '<button id="" class="btn btn-primary"  " onclick="irafoto();">Ver mi foto</button>',
	}).then(function() {
		
	});
}

function trigger2(){
	$('#show').trigger('click');
	Swal.close();
}
function muestragaleria(){
	$('#element').hide();
	$('#element2').hide();
	
	
	$.post(ajaxurl,{'action':'galeriafotos'},function(response){
		$('#galeria').html(response).fadeIn('slow');
		$('html, body').animate({
		scrollTop: $("#galeriainicio").offset().top - 100
	}, 500);
	});
	Swal.close(); 
	
	
	
	return false;

}


function irafoto(){
	var link =$('#registropromo').data('link');
	window.location.href=link;
}
function consolefunction(response) {
	var datas=parseJwt(response.credential);
	console.log(datas);
	var idfoto=$('.votocontaimer').data('id');
	//alert('Hola '+datas.name+', Bienvenido a Lebasi, tu correo es '+datas.email);
	$("#login").hide();
	$("#login2").hide();
	$('.g_id_signin').after('<button class="btn votabtn" data-apellido="'+datas.family_name+'" data-nombre="'+datas.given_name+'" data-source="google" data-foto="'+idfoto+'" data-mail="'+datas.email+'"><i class="fa fa-heart-o"></i> Votar por esta fotografía</button>').hide();	
}
	  
function parseJwt (token) {
	var base64Url = token.split('.')[1];
	var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
	var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
		return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
	}).join(''));
		
	return JSON.parse(jsonPayload);
};	
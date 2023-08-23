function compra(stateWrapper, ready) {
	$('#name').val("ISAIAS MEDINA RAMIREZ");
	alert('VAMOS A COMPRAR');
	console.log($('#name').val());
	console.log($('#name'));
	ready();
}


function tipopago(convState,ready){
	
	convState.current.next.next = convState.newState({
		type: 'select',
		name: 'tipopago',
		questions: ['¿Como deseas pagar?'],
		answers: [
			{text: 'Pago en Oxxo', value: 'oxxo'},
			{text: 'Enlace de Pago', value: 'enlace'},
		]
	});
	ready();
}




function ticket(stateWrapper, ready) {
	alert('TICKET');
	ready();
}
$(document).ready(function(){
	/*Chat Box*/
	$('.chat_icon').click(function() {
		$('.chat_box').toggleClass('active');
	});

	
	var convForm = $('.my-conv-form-wrapper').convform({
		selectInputStyle:'show',
		buttonClassStyle:'compras',
		eventList:{
			onInputSubmit: function(convState, ready) {
				if(convState.current.input.name=="numempresario"){
					$.post(ajaxurl,{'action':'getEmpresarioExiste','emp':convState.current.answer.value},function(response){
						console.log(response);
						convState.current.next = convState.newState({
							type: 'select',
							noAnswer: true,
							name: 'Empresarioinfo',
							questions: ['Hola '+response.data.Nombre+'! <br> Vamos a comenzar a cargar tu orden de compra<br>'],
						});
						
						var prod=[];
						
						$.each(response.data.Productos,function(a,b){
							var data={text:b.descripcion,value:b.clave};
							prod.push(data);
						});
						
						convState.current.next.next = convState.newState({
							type: 'select',
							name: 'productos',
							questions: ['¿Qué producto deseas?'],
							answers: prod,
							buttonClassStyle: 'largos'
						});
						
						ready();
						//tipopago(convState,ready);
					}).fail(function(error){
						convState.current.next = convState.newState({
							type: 'select',
							noAnswer: true,
							name: 'Empresarioerror',
							questions: ['Lo siento ha habido un error <p>Hola</p>'],
						});
						//ready();
					});
				}else if(convState.current.input.name=="productos"){
					convState.current.next = convState.newState({
						type: 'select',
						noAnswer: true,
						name: 'productosinfo',
						questions: ['Ok realizare una orden de compra para: <br>' + convState.current.answer.value],
					});
					
					convState.current.next.next = convState.newState({
						type: 'select',
						name: 'tipopago',
						questions: ['¿Como deseas pagar?'],
						answers: [
							{text: 'Pago en Oxxo', value: 'oxxo'},
							{text: 'Enlace de Pago', value: 'enlace'},
						]
					});					
					ready();
					
					
				}else if(convState.current.answer.value=="distribuidor"){
					convState.current.next = convState.newState({
						type: 'select',
						noAnswer: true,
						name: 'Empresario',
						questions: ['Estamos validando tu información...'],
					});					
					
					
					convState.current.next.next = convState.newState({
						name: 'numempresario',
						noAnswer: false,
						required: true,
						questions: ['Proporcioname tu número de empresario'],
						type: 'text',
						multiple: false,
						selected: "",
						answers: []
					});
					
					ready();
				}else if(convState.current.answer.value=="oxxo"){
					convState.current.next = convState.newState({
						type: 'select',
						noAnswer: true,
						name: 'oxxoinfo',
						questions: ['Gracias estamos generando tu referencia para pago...'],
					});	
					
					$.post(ajaxurl,convState.form.serialize() + '&action=preorden',function(response){
						console.log(response);
						convState.current.next.next = convState.newState({
							type: 'select',
							name: 'confirm',
							questions: ['<p>Esta es tu orden:</p><p>'+response.orden+'</<p><h4>¿Confirmas los datos?</h4>'],
							answers: [
								{text: 'Confirmar', value: 'yes'},
								{text: 'Cancelar', value: 'no'},
							]
						});
						
						convState.current.next.next.net = convState.newState({
							type: 'text',
							name: 'exit',
							questions: ['Ha sido un placer atenderte'],
						});
						ready();
						
					});
					
					
				}else if(convState.current.answer.value=="enlace"){
					convState.current.next = convState.newState({
						type: 'select',
						noAnswer: true,
						name: 'enlaceinfo',
						questions: ['Gracias estamos generando tu enlace para pagar, esto lo puedes hacer desde tu dispositivo movil'],
					});	
					ready();
				}else{
					convState.current.next = convState.newState({
						type: 'select',
						name: 'tipopago',
						questions: ['Disculpa no estoy capacitado para esa pregunta<br>¿Te puedo ayudar en algo?'],
						answers: [
							{text: 'Compra', value: 'compra'},
							{text: 'Preguntas', value: 'pregunta'},
						]
					});
					ready();
				}
				
			}
		},
		placeHolder:"Escribe aquí"
	});
	
	
	//Buscador
	var xhr;
	$('body').on('input','.buscador',function(event){
		var buscar=$(this).val();
		//console.log(buscar);
		$('.resultados-buscafloat').fadeIn().html('<i class="fa fa-refresh fa-spin"></i> Buscando...');
		if (xhr != null){ xhr.abort();}
		xhr=$.post(ajaxurl,{'action':'buscarnota','search':buscar},function(response){
			//console.log(response);
			$('.resultados-buscafloat').fadeIn().html(response);
	    });
	}).on('click','.buscando',function(){
		$('.buscadorfloat').animate({width: 'toggle'});
		$('.buscadorfloat input').focus();
		return false;
	}).on('click','.bot',function(){
		$('.resultados-buscafloat').fadeOut();
		$('.buscadorfloat').animate({width: 'toggle'});
		return false;
	});
	$(document).keypress(
	  function(event){
		if (event.which == '13') {
		  event.preventDefault();
		}
	});
	
		
	
	$('#paisc').on('change',function(){
		$(this).closest('form').trigger('submit');
	});
	$('.closepopup').on('click',function(){
		$('.overlaygral').hide();
		return false;
	});

	
	
	
	if($('.lebasishop').length > 0 && $('.overlayshop').length > 0){
		$.post(ajaxurl,{'action':'getAsignacion'},function(response){
			var vht='<div id="micrositio" class="clearfix"><img src="'+response.foto+'" width="70"><div class="datosmicro"><span class="d-block w-100">Distribuidor</span><span class="d-block w-100">DIST</span><a href="#" onclick="gtag(\'event\', \'clic\', { \'event_category\': \'micrositio\', \'event_label\': \'Dist-\', \'value\': \'xx\'});">Ver micrositio</a></div></div>';
			$('.lebasishop').before(vht);
			$('.overlayshop').fadeOut();
		});
	}
	
	$('.woocommerce-input-wrapper').addClass('col-12 col-md-8 pl-2 pr-0');
	
	$('#facturalebasiPE').on('change',function(){
		var label='DNI <abbr class="required" title="obligatorio">*</abbr>';
		if($(this).val()=='Factura'){
			label='RUC <abbr class="required" title="obligatorio">*</abbr>';
		}
		$('#DNIlebasiPE_field').find('label').html(label)
	});
	
	//Asignamos distribuidor
	if($('.resmicro').length >0){
		$.post(ajaxurl,{'action':'getAsignacion'},function(response){
			console.log(response);
			$('.row').removeClass('op-1');
			var vht='<div id="micrositio" class="clearfix"><img src="'+response.Foto+'" width="70"><div class="datosmicro"><span class="d-block w-100">Distribuidor</span><span class="d-block w-100">'+ response.numEmpresario+ ' | '+ response.PaisEmpresario+'</span><a href="'+response.link+'" onclick="gtag(\'event\', \'clic\', { \'event_category\': \'micrositio\', \'event_label\': \'Dist-\', \'value\': \'xx\'});">Ver micrositio</a></div></div>';
			$('.micros').html(vht);
		});
	}else{
		$('.row').removeClass('op-1');
	}

	AOS.init();
	
	$('.slick').fadeIn().slick({
		autoplay: true,
		dots: false,
		infinite: true,
		arrows: false,
	});
	
	$('.slick2').fadeIn().slick({
		autoplay: true,
		dots: false,
		infinite: true,
		arrows: false,
	});
	
	$('.regemp').click(function(){
		$('.registroemp').show();
		return false;
	});
	$('.registroemp').hide();
	$('#validabtn').click(function(){
		$(this).html('<i class="fa-refresh fa fa-spin"></i> Validando...').prop('disabled',true);
		xhr=$.post(ajaxurl,{'action':'validaemp','numempresario':$('#reg_numempresario').val(),'rfc':$('#reg_rfc').val()},function(response){
			console.log(response);
			if(response.validarfc=='Ok'){
				$('#reg_valida').val('SI');
				
				$('.registroemp').after('<div class="alert alert-success mt-2" role="alert">Se ha validado el empresario, al registrarte se habilitará tu backoffice</div>').hide();
			}else{
				$('#reg_valida').val('');
				$('.registroemp').after('<div class="alert alert-danger mt-2" role="alert">No se ha podido validar al empresario, favor de revisar los datos, si continuas teniendo problemas puedes enviar un correo a <a href="mailto:sistema@lebasigroup.com" target="_blank">sistema@lebasigroup.com</a></div>').show();
				$('#validabtn').attr('disabled',false).html('Validar Empresario');
				
			}
		});
		return false;
	});
	
	/************************************************************************/
	/*-------------------------------   FACTURAS     -----------------------*/
	$('body').on('submit','#remisionf',function(){
		$('.datosrem').remove();
		$('#facturaresults').html('<i class="fa fa-refres fa-spin"></i> Se esta consultando la nota de venta, espera por favor...');
		if(xhr!=null){xhr.abort();}
		xhr=$.post(ajaxurl,$(this).serialize(),function(response){
			if(!response.error){
				$items=`
					<table id="rem" class="table table-condensed table-striped">
						<tr>
							<th>CveSat</th>
							<th>SatUnidad</th>
							<th>Sku</th>
							<th>Cantidad</th>
							<th>Producto</th>
							<th>Prcio Unitario</th>
							<th>Descuento</th>
							<th>Importe</th>
						</tr>
				`;
				$.each(response.items,function(a,b){
					$items+=`
						<tr>
							<td>`+b.ClaveSat+`</td>
							<td>`+b.ClaveUnidad+`</td>
							<td>`+b.ClaveProducto+`</td>
							<td>`+b.Cantidad+`</td>
							<td>`+b.DescrProd+`</td>
							<td>`+b.Precio+`</td>
							<td>`+b.Descuento+`</td>
							<td>`+b.ClaveProducto+`</td>
						</tr>
					`
				});
				$items+='</table>';
				$('#facturasol').prepend(`
					<div class="datosrem">
						<table id="rem" class="table table-bordered table-condensed">
							<thead>
								<tr>
									<th>Almacen</th>
									<th>Remision</th>
									<th>Empresario</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>`+response.datas.ClaveSucursal+`</td>
									<td>`+response.datas.NumRemision+`</td>
									<td>`+response.datas.Razon+`</td>
								</tr>
								<tr>
									<th colspan="3">Nota</th>
								</tr>
								<tr>
									<td colspan="3">`+ $items+` </td>
								</tr>
							</tbody>
						</table>
					</div>
				`);
				$('#razon').val(response.datas.Razon);
				$('#rfc').val(response.datas.RFC);
				$('#cp').val(response.datas.CodPostal);
				$('#estado').val(response.datas.Estado);
				$('#municipio').val(response.datas.Municipio);
				$('#email').val(response.datas.Email);
				
				$('#remisionf').fadeOut();
				$('#facturasol').fadeIn();
				$('#facturaresults').html('');
			}else{
				$('#facturaresults').html('<i class="fa fa-exclamation" aria-hidden="true"></i> No se han podido validar los datos de la nota, revisa los datos por favor');
			}
		});
		return false;
	}).on('submit','#facturasol',function(){
		if(xhr!=null){xhr.abort();}
		xhr=$.post(ajaxurl,$(this).serialize(),function(response){
			console.log(response);
		});
		return false;
	});
	/************************************************************************/
	
	
	$('#WAButton').floatingWhatsApp({
		message: $('#WAButton').data('msg'),
		phone: $('#WAButton').data('phone'),
		headerTitle: 'WhatsApp Lebasi - México', //Popup Title
		popupMessage: 'Hola como podemos ayudarte?', //Popup Message
		showPopup: false, //Enables popup display
		buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" />', //Button Image
		headerColor: '#f00', //Custom header color
		backgroundColor: '#25d366', //Custom background button color
		position: "left",
		size:"60px"
	});
	
		if($('.fb-customerchat').length>0){
			window.fbAsyncInit = function() {
			  FB.init({
				xfbml            : true,
				version          : 'v7.0'
			  });
			};

			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		}
});
<?php 
//wp_die('No hay promociones activas');
get_header('lebasi');
 ?>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
<!--[if !mso]><!-->
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet" type="text/css"/>
<!--<![endif]-->
<style>
		body {
			margin: 0;
			padding: 0;
		}

		p, h3 {
			color:black;
			text-shadow: 0 0 1px white;
			font-size:20px;
		}
		.btn.btn-premios {
			background: #004195;
			color: #fff;
			text-align: center;
			font-weight: normal;
			border-radius: 10px;
			margin: 0 20px;
			padding: 5px 40px;
			font-size: 25px;
		}
		#presentacion{
			min-height: 68vh;
			display: flex;
			flex-direction: row;
			align-items: center;
			justify-content: center;
		}
		#imagen1{
			width: 100%;
			max-width: 500px;
			position: absolute;
			top: 175px;
		}
		#imagen2{
			width: 100%;
			max-width: 650px;
		}
		#imagen3 {
			margin: 30px auto 0;
		}
		.texto-inicio{
			font-size: 45px;
			max-width: 100%;
			text-align: center;
			color: #004195;
			font-weight: bold;
			line-height: 50px;
			font-family: Verdana,'Raleway';
		}
		.texto {
			padding: 25px;
			width: 100%;
			margin-top:50px;
		}
		.forms {
			padding: 5px;
			margin-right: 50px;
			min-width:50%;
		}
		#promo23,#promo23pub {
			background: #004195;
			padding: 15px;
			color: #fff;
			border-radius: 20px;
		}
		#promoenvio {
			background: #f1e736;
			color: #004195;
			font-size: 25px;
			font-weight: bold;
			border: none;
		}
		@media (max-width: 480px) {
			#presentacion {
				flex-direction: column;
			}
			#imagen1 {
				ymax-width: inherit;
				position: absolute;
				top: 15%;
				width: 100%;
			}
			.forms {
				margin-right: 1px;
			}
			.texto {
				padding: 15px;
				width: 100%;
				margin-top:10px;
			}
			.btn.btn-premios {
				margin: 0 0px;
				padding: 5px 15px;
				width: 160px;
			}
		}		
		
</style>
</head>

<body>

<div id="presentacion">
	<div class="imagen" style="display:flex;flex-flow: column;justify-content: center;align-items: center;min-width: 40%;">
		<img id="imagen1" src="<?php echo get_template_directory_uri().'/images/promotext.png';?>" width="350">
		<img id="imagen2" src="<?php echo get_template_directory_uri().'/images/premios_102023.png';?>" width="350">
		<input type="hidden" id="imgsrc" value="">
		<input type="hidden" id="tipo" value="">
	</div>
	<div class="texto">
		<h2 class="texto-inicio">Por favor elige la sección correcta</h2>
		<div style="display:flex;flex-flow: row;align-items: center;justify-content: center; margin-top:50px;">
			<!--<a href="#" class="btn btn-premios" data-tipo="empresario" data-src="<?php echo site_url();?>/wp-content/themes/lebasi2020/images/wheel-emp.png">Empresario</a>-->
			<a href="#" class="btn btn-premios" data-tipo="publico" data-src="<?php echo site_url();?>/wp-content/themes/lebasi2020/images/wheel-pub.png">Público</a>
		</div>
	</div>
	<div class="forms" style="display:none;">
		<form id="promo23">
			<h5>Empresario</h5>
			<div class="form-group row">
				<label class="col-12 col-md-2">Nombre Completo: </label> 
				<div class="col-12 col-md-10">
				  <div class="input-group">
					<div class="input-group-prepend">
					  <div class="input-group-text">
						<i class="fa fa-address-card"></i>
					  </div>
					</div> 
					<input id="nombre" name="nombre" type="text" class="form-control" required placeholder="Introduce tu nombre completo">
				  </div>
				</div>
			</div>
		
			<div class="form-group row">
				<label class="col-12 col-md-2">Correo Electrónico: </label> 
				<div class="col-12 col-md-10">
				  <div class="input-group">
					<div class="input-group-prepend">
					  <div class="input-group-text">
						<i class="fa fa-envelope-o"></i>
					  </div>
					</div> 
					<input id="correo" name="correo" type="email" class="form-control" required placeholder="Introduce un correo electrónico">
				  </div>
				</div>
			</div>
			<div class="form-group row">
				<label for="text2" class="col-12 col-md-2 col-form-label">Celular:* </label> 
				<div class="col-12 col-md-10">
				  <div class="input-group">
					<div class="input-group-prepend">
					  <div class="input-group-text">
						<i class="fa fa-phone"></i>
					  </div>
					</div> 
					<input id="telefono" name="telefono" pattern="[0-9]{10}" type="txt" class="form-control" required placeholder="Introduce tu telefono o celular">
				  </div>
				</div>
			</div>
			<div class="form-group row">
				<label for="text2" class="col-12 col-md-2 col-form-label">Remisión:* </label> 
				<div class="col-12 col-md-10">
				  <div class="input-group">
					<div class="input-group-prepend">
					  <div class="input-group-text">
						<i class="fa fa-list-ol"></i>
					  </div>
					</div> 
					<input id="remision" name="remision" pattern="[A-Za-z0-9]{3}-\d{3c,9}" type="text" class="form-control" required placeholder="Ingresa el número de remisión">
				  </div>
				</div>
			</div>
			<div class="form-group row">
				<div class="offset-md-4 col-8">
					<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
					<input type="hidden" name="action" value="premioindi">
					<input type="hidden" name="tipo" value="empresario">
					<button id="promoenvio" name="submit" type="submit" class="btn btn-secondary">Enviar</button>
				</div>
				
			</div>
		</form>
		<form id="promo23pub">
			<h5>Público</h5>
			<div class="form-group row">
				<label class="col-12 col-md-2">Nombre Completo: </label> 
				<div class="col-12 col-md-10">
				  <div class="input-group">
					<div class="input-group-prepend">
					  <div class="input-group-text">
						<i class="fa fa-address-card"></i>
					  </div>
					</div> 
					<input id="nombre" name="nombre" type="text" class="form-control" required placeholder="Introduce tu nombre completo">
				  </div>
				</div>
			</div>
		
			<div class="form-group row">
				<label class="col-12 col-md-2">Correo Electrónico: </label> 
				<div class="col-12 col-md-10">
				  <div class="input-group">
					<div class="input-group-prepend">
					  <div class="input-group-text">
						<i class="fa fa-envelope-o"></i>
					  </div>
					</div> 
					<input id="correo" name="correo" type="email" class="form-control" required placeholder="Introduce un correo electrónico">
				  </div>
				</div>
			</div>
			<div class="form-group row">
				<label for="text2" class="col-12 col-md-2 col-form-label">Celular:* </label> 
				<div class="col-12 col-md-10">
				  <div class="input-group">
					<div class="input-group-prepend">
					  <div class="input-group-text">
						<i class="fa fa-phone"></i>
					  </div>
					</div> 
					<input id="telefono" name="telefono" pattern="[0-9]{10}" type="txt" class="form-control" required placeholder="Introduce tu telefono o celular">
				  </div>
				</div>
			</div>
			<div class="form-group row">
				<label for="text2" class="col-12 col-md-2 col-form-label">Lote:* </label> 
				<div class="col-12 col-md-10">
				  <div class="input-group">
					<div class="input-group-prepend">
					  <div class="input-group-text">
						<i class="fa fa-list-ol"></i>
					  </div>
					</div> 
					<input id="lote" name="lote" type="text" class="form-control" required placeholder="Ingresa el número de Lote">
				  </div>
				</div>
			</div>
			<div class="form-group row">
				<label for="text2" class="col-12 col-md-2 col-form-label">Caja:* </label> 
				<div class="col-12 col-md-10">
				  <div class="input-group">
					<div class="input-group-prepend">
					  <div class="input-group-text">
						<i class="fa fa-list-ol"></i>
					  </div>
					</div> 
					<input id="caja" name="caja" type="text" class="form-control" required placeholder="Ingresa el número de caja">
				  </div>
				</div>
			</div>
			<div class="form-group row">
				<label for="text2" class="col-12 col-md-2 col-form-label">Bote:* </label> 
				<div class="col-12 col-md-10">
				  <div class="input-group">
					<div class="input-group-prepend">
					  <div class="input-group-text">
						<i class="fa fa-list-ol"></i>
					  </div>
					</div> 
					<input id="bote" name="bote" type="text" class="form-control" required placeholder="Ingresa el número de bote">
				  </div>
				</div>
			</div>
			<div class="form-group row">
				<div class="w-100" style="display: block;text-align: center;margin-bottom: 7px;">
					<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
					<input type="hidden" name="action" value="premioindica2">
					<input type="hidden" name="tipo" value="publico">
					<button id="promoenvio" name="submit" type="submit" class="btn btn-secondary">Enviar</button>
				</div>
				<p style="color:#f1e736;font-weight:bold; font-size:11px; width:100%;text-align:center;">Podrás encontrar los datos en la parte inferior de tu bote.</p>
				<img id="imagen3" src="<?php echo get_template_directory_uri().'/images/lotes.png';?>" width="150">
			</div>
		</form>
	</div>
	<div id="concurso" style="display:none;">
		<div id="game-container" style="background: rgba(0, 0, 0,0); min-height: 600px !important; margin: 85px auto 0px; width: 100%;">
			<h3 id="msgpromo">Da click en el centro de la ruleta</h3>
		</div>
		<!--<div class="container">
			<div class="row">
				<div class="col col-12 col-md-6">
					<div id="registradoPromo"></div>
					<div id="formPromo2022">
						<div id="game-container" style="min-height: 600px !important;margin: 0 auto;background: #fff;width: 100%; display:none; margin-top:50px;">
							<h3 id="msgpromo">Da click en el centro de la ruleta</h3>
						</div>
					</div>
				</div>
				<div class="col col-12 col-md-6">
					<h3 style="color: black; text-shadow: 0 0 2px black;">Bases Julio 2023</h3>
					<p>1.- Ingresa el número de remisión y completa el formulario con tus datos.</p>
					<p>2.- Da click en la ruleta para conocer tu premio.</p>
					<p>3.- Y listo, nos pondremos en comunicación para acordar la entrega de tu premio.</p>
				</div>
			</div>
		</div>-->
	</div>
</div>
	
</div>

<script async src="https://www.google.com/recaptcha/api.js?render=6LcHWi0fAAAAAJGxohxFdMMwrUHmkuy_cef2wBOF"></script>
<script src="<?php echo get_template_directory_uri();?>/js/phaser.min.js"></script>
<script>

var game;
var wheel; 
var canSpin;
var slices;
var prize;
var prizeText;
var playGame;
var slicePrizes=[];
window.onload = function() {	
	
}


var playGame = function(game){};
playGame.prototype = {
	preload: function(){
		game.load.image("wheel", $('#imgsrc').val());
		game.load.image("pin", "<?php echo site_url();?>/wp-content/themes/lebasi2020/images/lebasipin.png");
		game.stage.backgroundColor = "rgba(255, 255, 255, 0.5)";
	},
	create: function(){
		wheel = game.add.sprite(game.width / 2, game.width / 2, "wheel");
		wheel.anchor.set(0.5);
		console.log(wheel);
		var pin = game.add.sprite((game.width / 2)+19, game.width / 2, "pin");
		pin.anchor.set(0.5);
		prizeText = game.add.text(game.world.centerX, 580, "");
		prizeText.anchor.set(0.5);
		prizeText.align = "center";
		canSpin = true;
		game.input.onDown.add(this.spin, this);		
		
	},
	spin(){
		if(canSpin){  
			prizeText.text = "";
			var rounds = game.rnd.between(2, 9);
			var degrees = 0;
			var $this=this;
			canSpin = false;
			$('#msgpromo').html('Preparando el juego... <i class="fa fa-spín fa-refresh"></i>');
			formse=$('#promo23pub');
			if($('#tipo').val()=='empresario'){
				formse=$('#promo23');
			}
			
			$.post(ajaxurl,formse.serialize(),function(response){
				console.log(response);
				$('#msgpromo').html('En juego... <i class="fa fa-spín fa-cog"></i>');
				degrees=response.grados*1;
				console.log(degrees);
				prize = slices - 1 - Math.floor(degrees / (360 / slices));		
				
				var spinTween = game.add.tween(wheel).to({
					angle: 360 * rounds + degrees
				}, 3000, Phaser.Easing.Quadratic.Out, true);
				console.log($this);
				spinTween.onComplete.add($this.winPrize, $this);
				canSpin = false;
			});
			canSpin = false;
			
		}
	},
	winPrize(){
		canSpin = false;
		prizeText.text = slicePrizes[prize];
		console.log(slicePrizes[prize]);
		$('#msgpromo').html('').hide();
		$('#game-container').prepend('<h2 style="text-align: center;background: #23597e;color: #fff;padding: 30px;font-weight: bold;">FELICIDADES has ganado '+ slicePrizes[prize] +'</h2>');
		$('#game-container canvas').fadeOut(8000);
	}
}

function juego(){
	var gameContainer = document.getElementById('gamecontainer');
	game = new Phaser.Game({
		width                   : 450,
		height                  : 650,
		parent                  : document.getElementById("game-container"),
		type                    : Phaser.AUTO,
		transparent			    : true,
		autoResize    			: true,
	});
	
	$.post(ajaxurl,{'action':'consultapremios','tipo':$('#tipo').val()},function(response){
		$.each(response,function(a,b){
			slicePrizes.push(b.premio);
		});
		slices = Object.keys(slicePrizes).length;
		console.log(slices);
		game.state.add("PlayGame",playGame);
		game.state.start("PlayGame");
		console.log('********************************************');
		console.log(slicePrizes);
	});
	
}
</script>
</body>
</html>
<?php get_footer('lebasi');
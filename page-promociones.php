<?php wp_die('No hay promociones activas');
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
		
		
</style>
</head>

<body>
<h2 class="titulo">Regístrate y Gana</h2>

<div class="container">
	<div class="row">
		<div class="col col-12 col-md-6">
			<h3 style="color: black; text-shadow: 0 0 2px black;">Bases Julio 2023</h3>
			<p>1.- Ingresa el número de remisión y completa el formulario con tus datos.</p>
			<p>2.- Da click en la ruleta para conocer tu premio.</p>
			<p>3.- Y listo, nos pondremos en comunicación para acordar la entrega de tu premio.</p>
		</div>
		
		<div class="col col-12 col-md-6">
			<div id="registradoPromo"></div>
			<div id="formPromo2022">
				<form id="promo23">

					<div class="form-group row">
						<label style="color: #393939;" class="col-12 col-md-2">Nombre Completo: </label> 
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
						<label style="color: #393939;" class="col-12 col-md-2">Correo Electrónico: </label> 
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
						<label style="color: #393939;" for="text2" class="col-12 col-md-2 col-form-label">Celular:* </label> 
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
						<label style="color: #393939;" for="text2" class="col-12 col-md-2 col-form-label">Remisión:* </label> 
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
						<div class="offset-4 col-8">
							<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
							<input type="hidden" name="action" value="premioindi">
							<button id="promoenvio" name="submit" type="submit" class="btn btn-secondary">Enviar</button>
						</div>
						
					</div>
				</form>
				<div id="game-container" style="min-height: 600px !important;margin: 0 auto;background: #fff;width: 100%; display:none; margin-top:50px;">
					<h3 id="msgpromo">Da click en el centro de la ruleta</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<script async src="https://www.google.com/recaptcha/api.js?render=6LcHWi0fAAAAAJGxohxFdMMwrUHmkuy_cef2wBOF"></script>
<script src="<?php echo get_template_directory_uri();?>/js/phaser.min.js"></script>
<script>
var slicePrizes=[];
$.post(ajaxurl,{'action':'consultapremios'},function(response){
	$.each(response,function(a,b){
		slicePrizes.push(b.premio);
	});
	//console.log(slicePrizes);
})
// the game itself
var game;
// the spinning wheel
var wheel; 
// can the wheel spin?
var canSpin;
// slices (prizes) placed in the wheel
var slices = 14;
// prize names, starting from 12 o'clock going clockwise
//var slicePrizes = ["PREMIO1","PREMIO2","PREMIO3","PREMIO4","PREMIO5","PREMIO6","PREMIO7","PREMIO8","PREMIO9","PREMIO10","PREMIO11","PREMIO12"];
// the prize you are about to win
var prize;
// text field where to show the prize
var prizeText;

window.onload = function() {	
	var gameContainer = document.getElementById('gamecontainer');
	// creation of a 458x488 game
	game = new Phaser.Game(520, 520, Phaser.AUTO, 'game-container');
	// adding "PlayGame" state
	game.state.add("PlayGame",playGame);
	// launching "PlayGame" state
	game.state.start("PlayGame");
	console.log(slicePrizes);
}
	// PLAYGAME STATE
	var playGame = function(game){};
	playGame.prototype = {
	// function to be executed once the state preloads
	preload: function(){
		// preloading graphic assets
		game.load.image("wheel", "https://lebasi.com.mx/wp-content/themes/lebasi2020/images/wheel480x480.png");
		game.load.image("pin", "https://lebasi.com.mx/wp-content/themes/lebasi2020/images/pin109_164.png");
	},
	// funtion to be executed when the state is created
  	create: function(){
		// giving some color to background
  		game.stage.backgroundColor = "#ffffff";
		// adding the wheel in the middle of the canvas
  		wheel = game.add.sprite(game.width / 2, game.width / 2, "wheel");
		// setting wheel registration point in its center
		wheel.anchor.set(0.5);
		// adding the pin in the middle of the canvas
		var pin = game.add.sprite(game.width / 2, game.width / 2, "pin");
		// setting pin registration point in its center
		pin.anchor.set(0.5);
		// adding the text field
		prizeText = game.add.text(game.world.centerX, 580, "");
		// setting text field registration point in its center
		prizeText.anchor.set(0.5);
		// aligning the text to center
		prizeText.align = "center";
		// the game has just started = we can spin the wheel
		canSpin = true;
		// waiting for your input, then calling "spin" function
		game.input.onDown.add(this.spin, this);		
	},
	// function to spin the wheel
	spin(){
		// can we spin the wheel?
		if(canSpin){  
			// resetting text field
			prizeText.text = "";
			// the wheel will spin round from 2 to 4 times. This is just coreography
			var rounds = game.rnd.between(2, 9);
			// then will rotate by a random number from 0 to 360 degrees. This is the actual spin
			//var degrees = game.rnd.between(0, 360);
			var degrees = 0;
			var $this=this;
			canSpin = false;
			$('#msgpromo').html('Preparando el juego... <i class="fa fa-spín fa-refresh"></i>');
			$.post(ajaxurl,$('#promo23').serialize(),function(response){
				console.log(response);
				$('#msgpromo').html('En juego... <i class="fa fa-spín fa-cog"></i>');
				degrees=response.grados*1;
				//degrees = (((360/14)*2)+12);
				console.log(degrees);
				// before the wheel ends spinning, we already know the prize according to "degrees" rotation and the number of slices
				prize = slices - 1 - Math.floor(degrees / (360 / slices));		
				// now the wheel cannot spin because it's already spinning
				// animation tweeen for the spin: duration 3s, will rotate by (360 * rounds + degrees) degrees
				// the quadratic easing will simulate friction
				var spinTween = game.add.tween(wheel).to({
					angle: 360 * rounds + degrees
				}, 3000, Phaser.Easing.Quadratic.Out, true);
				// once the tween is completed, call winPrize function
				console.log($this);
				spinTween.onComplete.add($this.winPrize, $this);
				canSpin = false;
				
			});
			canSpin = false;
			
		}
	},
	// function to assign the prize
	winPrize(){
		// now we can spin the wheel again
		canSpin = false;
		// writing the prize you just won
		prizeText.text = slicePrizes[prize];
		console.log(slicePrizes[prize]);
		$('#msgpromo').html('').hide();
		$('#game-container').prepend(`<h2 style="text-align: center;background: #23597e;color: #fff;padding: 30px;font-weight: bold;">FELICIDADES has ganado `+ slicePrizes[prize] +`</h2>`);
		$('#game-container canvas').fadeOut(8000);
	}
}

</script>
</body>
</html>
<?php get_footer('lebasi');
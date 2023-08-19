<?php 
	function mensajepromo($link,$idreg){
		ob_start();?>
		
		<section class="py-5">
        <div class="container correoestilo">

            <div class="row">
                <div class="col-lg-6 mx-auto">

               
                      
                        <center>
                            <img src="https://lebasi.com.mx/wp-content/themes/lebasi2020/images/Dinero2.jpg" alt="..." >
                        </center>


                        <h1 class="centrado">Estimado Consumidor:<br> Lebasi tiene el agrado de saludarte.<br> Nos comunicamos contigo para agradecerte tu participación en nuestra promoción.</h1><br>




                        <p class="font-italic">Te confirmamos que tu Fotografía Participante quedo registrada correctamente y ya está participando y disponible para recibir votos. </p><br>
						<p>  Puedes compartir tu Fotografía <a href="<?php echo $link;?>" >AQUÍ</a> para obtener mayor número de votos y tener más posibilidades de ganar.  </p>
                        <h2>¡Recuerda que debes de tener tu bote en todo momento!</h2>

                        <p class="textoganador">En caso de resultar ganador de nuestro concurso de fotografía la forma en la que podrás reclamar tu premio será mostrando que eres el dueño del bote que registraste
                            <!--<br> Tu bote de Registrado para el concurso es:-->
						</p>

						<h2 class="centrado">No olvides registrarte y obtener una Consulta Nutricional y una Dieta détox, completamente gratis. <a href="https://lebasi.com.mx/promociones/descargas/dieta/" class="text-info">Da click aquí </a></h2>

                        <p style="font-size:7px;">La información contenida en este mensaje de datos puede ser de carácter confidencial y/o privilegiado. Este correo electrónico está destinado para el uso exclusivo de la persona física o moral a la cual se dirige. Si por cualquier situación el lector no es el destinatario o su representante, se le advierte que las leyes de aplicación prohíben las actividades de difusión, publicidad o copia de la información contenida, bien sea de manera total o parcial. Para el uso de la información deberá contar en todo caso con la autorización previa y por escrito del emisor original. En caso que por error Usted reciba este mensaje, favor de informarlo de manera inmediata al remitente y hacer favor de borrar el mensaje de datos de su sistema.</p>
                        <br>
                        <p style="font-size:7px;">The content of this email is confidential and intended for the recipient specified in message only. It is strictly forbidden to share any part of this message with any third party, without a written consent of the sender. If you received this message by mistake, please reply to this message and follow with its deletion, so that we can ensure such a mistake does not occur in the future.</p>


                        <footer class="blockquote-footer pt-4 mt-4 border-top">Atentamente:
                            <br> <b>Lebasi México S.A de C.V.<b>
                            <br>


                           
                        </footer>
                </div>
            </div>
        </div>
    </section>

    <style>

        .blockquote-custom {
            position: relative;
            font-size: 1.1rem;
        }
        
        .blockquote-custom-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: -25px;
            left: 50px;
        }
        
        .centrado{
            text-align: center;
            color: black;
            
            
        }
        
        .terminos{
            text-align: justify-all;
            font-size: 7px;
            color: gray;
            
        }
        .textoganador{
            font-size: 20px;
            color: black;
            text-align: justify;
        }

        
        .correoestilo{
            margin: 10px;
            padding: 22px;
            
            
        }
        
        
    </style>
	
		
		<?php
		$html=ob_get_contents();
		ob_end_clean();
		return $html;
	}
	
	
	function mensajepromo2(){
		ob_start();?>
		
		<section class="py-5">
        <div class="container correoestilo">

            <div class="row">
                <div class="col-lg-6 mx-auto">
					<center>
						<img src="https://lebasi.com.mx/wp-content/themes/lebasi2020/images/consulta01.jpg" alt="..." >
					</center>
                    <h1 class="centrado">Gracias por tu preferencia y participación  en nuestra promoción,<br> ¡CON LEBASI TODOS GANAN!</h1><br>




                        <p class="font-italic">Tú Consulta Nutricional quedo agendada. </p><br>
						<p>  Próximamente te contactaremos para confirmar tu cita presencial o virtual. 

						<h2 class="centrado">Puedes descargar tu Dieta Détox  <a href="https://lebasi.com.mx/promociones/descargas/dieta/" class="text-info">Da click aquí </a></h2>
						
						<h2 class="centrado">No te olvides de participar en nuestro Concurso Fotográfico LEBASI, donde podrás ganar hasta $20,000. Solo  <a href="https://lebasi.com.mx/promociones/" class="text-info">Da Click Aquí </a></h2>
						
                        <b><p style="font-size:7px">La información contenida en este mensaje de datos puede ser de carácter confidencial y/o privilegiado. Este correo electrónico está destinado para el uso exclusivo de la persona física o moral a la cual se dirige. Si por cualquier situación el lector no es el destinatario o su representante, se le advierte que las leyes de aplicación prohíben las actividades de difusión, publicidad o copia de la información contenida, bien sea de manera total o parcial. Para el uso de la información deberá contar en todo caso con la autorización previa y por escrito del emisor original. En caso que por error Usted reciba este mensaje, favor de informarlo de manera inmediata al remitente y hacer favor de borrar el mensaje de datos de su sistema.</p>
                        </b>
                        <b><p style="font-size:7px">The content of this email is confidential and intended for the recipient specified in message only. It is strictly forbidden to share any part of this message with any third party, without a written consent of the sender. If you received this message by mistake, please reply to this message and follow with its deletion, so that we can ensure such a mistake does not occur in the future.</p></b>

                        <footer class="blockquote-footer pt-4 mt-4 border-top">
							Atentamente:
                            <br> <b>Lebasi México S.A de C.V.<b>
                            <br>                           
                        </footer>
                </div>
            </div>
        </div>
    </section>

    <style>

        .blockquote-custom {
            position: relative;
            font-size: 1.1rem;
        }
        
        .blockquote-custom-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: -25px;
            left: 50px;
        }
        
        .centrado{
            text-align: center;
            color: black;
            
            
        }
        
        .terminos{
            text-align: justify-all;
            font-size: 7px;
            color: gray;
            
        }
        .textoganador{
            font-size: 20px;
            color: black;
            text-align: justify;
        }

        
        .correoestilo{
            margin: 10px;
            padding: 22px;
            
            
        }
        
        
    </style>
	
		<?php
		$html=ob_get_contents();
		ob_end_clean();
		return $html;
		
	}
	
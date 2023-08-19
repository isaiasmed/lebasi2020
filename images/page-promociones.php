<?php get_header('lebasi'); ?>
	<?php
	if(isset($wp_query->query_vars['foto'])):
		if (has_post_thumbnail( $wp_query->query_vars['foto']  ) ):
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $wp_query->query_vars['foto'] ), 'single-post-thumbnail' );?>
			<section class="page-section clearfix">
				<div class="container-fluid mx-auto">
					<h3 class="text-white">Foto</h3>
					<div class="row">
						<div class="col-12">
							<img src="<?php echo $image[0];?>" class="img-fluid mx-auto d-block" alt="Lebasi 2021">
						</div>
					</div>
				</div>
			</section><?php		
		endif;
	else:?>
	
	
	
	
	
	<a href="consulta.html"> <img style="width:650px; height:650px;" class="img-fluid" src="assets/img/img2/landing1_650px.png" /></a>
    >
    <a href="dinero.html"> <img style="width:650px; height:650px;" class="img-fluid" src="assets/img/img2/landing2_650px.png" /></a>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


<!--CONSULTA-->
    
    <!-- Navigation-->

    <section class="page-section clearfix">
        <div class="container-fluid">
            <div class="intro">
                <center>
                    <img src="assets/img/consulta01.png" alt="" class="img-fluid">
                    <div class="intro-text left bg-faded p-5 m-0 rounded">
                        <h1 class="section-heading mb-4">
                        <span class="section-heading-upper"> Felicidades   ¡Ya ganaste con Lebasi! </span>
                            <span class="section-heading-lower"> </span>
                        </h1>
                        <br>

                        <p align="center">En lebasi estamos muy agradecidos por tu compra y por tu preferencia. Como parte de nuestro compromiso con tu salud, te regalamos una consulta nutricional, con uno de nuestros profesionales certificados</p>
                        <br>


                        <p align="center">Proporciónanos tus datos para agendar tu cita</p>



                        <div class="container" id="advanced-search-form">
                            <h2>Formulario de registro</h2>
                            <br>
                            <h7 class="obligatorio">Campos obligatorios marcados con *</h7>
                            <br>


                            <style>
                                h7 {
                                    color: red;
                                }
                                
                                h10 {
                                    font-size: 12px;
                                    color: red;
                                }
                                
                                b {
                                    color: black;
                                }
                                
                                body {
                                    font-family: 'impact-regular', sans-serif;
                                }

                            </style>

                            <form>
                                <div class="form-group">
                                    <br>
                                    <label for="first-name">Nombre</label>
                                    <input type="text" class="form-control" placeholder="Nombre*" id="first-name" required>
                                </div>
                                <div class="form-group">
                                    <label for="last-name">Primer Apellido</label>
                                    <input type="text" class="form-control" placeholder="Primer Apellido *" id="last-name" required>
                                </div>
                                <div class="form-group">
                                    <label for="country">Segundo Apellido </label>
                                    <input type="text" class="form-control" placeholder="Segundo Apellido *" id="country" required>
                                    <br>
                                </div>

                                <div class="form-group">
                                    <label for="start">Fecha de nacimiento*</label>


                                    <input type="date" id="start" name="trip-start" value="2003-01-01" min="1918-01-01" max="2003-01-01" required>

                                    <div class="form-group">
                                        <br>
                                        <label for="number">Código Postal</label>
                                        <input type="text" class="form-control" placeholder="Código Postal*" id="number" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="email">Celular</label>
                                    <input type="email" class="form-control" placeholder="Celular*" id="email" required>
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="number">Correo Electrónico</label>
                                    <input type="text" class="form-control" placeholder="Correro Electrónico*" id="number" required>
                                </div>


                                <br>
                                <div class="form-group">
                                    <label>Género*</label>
                                    <div class="radio">
                                        <label class="radio-inline">
                                            <input type="radio" name="optradio">Hombre</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optradio">Mujer</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optradio">Prefiero no decirlo</label>
                                    </div>

                                </div>
                                <br>
                                <h3>Agenda tu cita:</h3>
                                <br>

                                <div class="form-group">
                                    <table>
                                        <tr>
                                            <th>Fecha &nbsp; &nbsp; &nbsp; </th>

                                            <th>Hora&nbsp; &nbsp; &nbsp; </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="date" id="start" name="trip-start" value="2021-09-01" min="2021-09-01" max="2021-09-30" required>
                                            </td>
                                            <td>
                                                <input type="time" name="hora" min="18:00" max="21:00" step="3600" />
                                            </td>

                                        </tr>

                                    </table>
                                    <br>

                                </div>


                                <div class="alert alert-success" role="alert">

                                    <h4 class="alert-heading">Termine su registro</h4>
                                    <p>Después de que envie su formulario nos pondremos en contacto con USTED a la brevedad, para agendar su cita según la disponibilidad </p>
                                    <hr>
                                    <p class="mb-0">La asiganción de citas dependerá de la disponibilidad de nuestros nutriologos(as)</p>
                                </div>




                                <br>
                                <br>
                                <div class="checkboxy">
                                    <input name="cecky" id="checky" value="1" type="checkbox" required/>
                                    <label class="terms">Acepto los <a href=""><b>TÉRMINOS Y CONDICIONES</b></a></label>
                                </div>
                                <br>
                                <div class="clearfix"></div>
                                <button onclick="myFunction()" type="submit" class="btn btn-info btn-lg btn-responsive" id="search"> <span class="glyphicon glyphicon-search"></span> Enviar Formulario</button>


                            </form>
                        </div>

                        <script>
                            function myFunction() {
                                Swal.fire({
                                    title: 'Te registraste correctamente!',
                                    text: 'No olvides participar en nuestro Concurso de Fotografía y podrás ganar un viaje  alguno de los increíbles premios que tenemos para ti. Solo sigue el siguiente vinculo: www.lebasi.com.mx/promociones',
                                    imageUrl: '../assets/img/img2/Dinero2.png',
                                    imageWidth: 400,
                                    imageHeight: 200,
                                    imageAlt: 'Custom image',
                                })

                            }

                        </script>


                    </div>
                </center>
            </div>

        </div>
    </section>
    
    <!--FIN CONSULTA-->
    
    
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    
    
    
    
    <!--Dinero-->
    <!-- Navigation-->

    <section class="page-section clearfix">
        <div class="container-fluid">
            <div class="intro">
                <center>


                    <section class="page-section clearfix">
                        <div class="container-fluid">
                            <div class="intro">
                                <center>
                                    <img class="intro-img img-fluid mb-3 mb-lg-5 rounded" src="assets/img/img2/Dinero2.png" alt="..." />
                                    <div class="intro-text left bg-faded p-5 m-0 rounded">
                                        <h2 class="section-heading mb-4">
                            <span class="section-heading-upper">Concurso Lebasi</span>
                            <span class="section-heading-lower">Requisitos del concurso </span>
                        </h2>

                                        <h4> Concurso de fotos  <i class="fas fa-camera"></i> <br> Con LEBASI <i class="fas fa-prescription-bottle-alt"></i> Todos Ganan!</h4>

                                        <br>

                                        <h4>  Sube tu foto y gana hasta 20 MIL PESOS         <i class="fas fa-dollar-sign"></i> <i class="fas fa-money-bill-wave-alt"></i> </h4>
                                        <br>
                                        <h3> <i class="far fa-check-circle"></i> Para participar sigue estos pasos: <br></h3>
                                        <h4> <i class="far fa-edit"></i> Registrate mediante nuestro formulario</h4>
                                        <h4> <i class="fas fa-camera"></i> Sube la foto con la que deseas participar </h4>
                                        <h4> <i class="far fa-share-square"></i> Compartela con tus amigos </h4>
                                        <h4> <i class="fas fa-download"></i> Descarga tu dieta y agenda tu consulta</h4>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <h7>Promoción válida del 01 de Octubre al 30 de Noviembre del 2021</h7>
                                        <br>
                                        <br>
                                        <button class="boton">SUBE UNA FOTO</button>
                                        <br>
                                        <br>
                                        <br>
                                        <button class="boton">GALERIA DE FOTOS</button>
                                        <style>
                                            .boton {
                                                text-decoration: none;
                                                padding: 10px;
                                                font-weight: 600;
                                                font-size: 20px;
                                                color: #ffffff;
                                                background-color: #1883ba;
                                                border-radius: 6px;
                                                border: 2px solid #0016b0;
                                            }

                                        </style>


                                    </div>
                                </center>
                            </div>

                        </div>
                    </section>

                </center>
            </div>

        </div>
    </section>



    <!--INICIO DEL FORMULARIO DE LA FOTO-->



    <section class="page-section clearfix">
        <div class="container-fluid">
            <div class="intro">
                <center>


                    <section class="page-section clearfix">
                        <div class="container-fluid">
                            <div class="intro">
                                <center>
                                    <img class="intro-img img-fluid mb-3 mb-lg-5 rounded" src="assets/img/img2/Dinero2.png" alt="..." />
                                    <div class="intro-text left bg-faded p-5 m-0 rounded">
                                        <h2 class="section-heading mb-4">
                            <span class="section-heading-upper">Concurso Lebasi</span>
                            <span class="section-heading-lower">Requisitos del concurso </span>
                        </h2>




                                        <span class="section-heading-upper">Fromulario de registro <i class="fas fa-user-edit"></i> </span>
                                        <span class="section-heading-lower">Rellena todos los campos del formulario para completar tu registro </span>
                                        <br>

                                        <br>

                                        <buttton></buttton>



                                        <div class="container" id="advanced-search-form">

                                            <h7 class="obligatorio">Campos obligatorios marcados con *</h7>
                                            <br>


                                            <style>
                                                h7 {
                                                    color: red;
                                                }
                                                
                                                h10 {
                                                    font-size: 12px;
                                                    color: red;
                                                }
                                                
                                                b {
                                                    color: black;
                                                }
                                                
                                                body {
                                                    font-family: 'impact-regular', sans-serif;
                                                }

                                            </style>

                                            <form>
                                                <div class="form-group">
                                                    <br>
                                                    <label for="first-name">Nombre</label>
                                                    <input type="text" class="form-control" placeholder="Nombre*" id="first-name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="last-name">Primer Apellido</label>
                                                    <input type="text" class="form-control" placeholder="Primer Apellido *" id="last-name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="country">Segundo Apellido </label>
                                                    <input type="text" class="form-control" placeholder="Segundo Apellido *" id="country" required>

                                                </div>

                                                <div class="form-group">

                                                    <label for="number">Correo Electrónico</label>
                                                    <input type="text" class="form-control" placeholder="Correro Electrónico*" id="number" required>
                                                </div>

                                                <div class="form-group">

                                                    <label for="email">Teléfono</label>
                                                    <input type="email" class="form-control" placeholder="Teléfono*" id="email" required>
                                                    <br>
                                                </div>

                                                <div class="form-group">
                                                    <label for="start">Fecha de nacimiento*</label>
                                                    <input type="date" id="start" name="trip-start" value="2003-01-01" min="1918-01-01" max="2003-01-01" required>
                                                </div>



                                                <div class="form-group">
                                                    <br>
                                                    <label for="number">Número De lote del bote* (Se encuentra debajo del mismo)</label>
                                                    <input type="text" class="form-control" placeholder="Num. de bote* " id="number" required>
                                                </div>


                                                <div class="form-group">
                                                    <br>
                                                    <h4>¿Por qué tomas lebasi?</h4>

                                                    <p>Selecciona la opción :
                                                        <select name="color">
                                                            <option>Nutrición</option>
                                                            <option>Tratamiento</option>
                                                            <option>Bienestar</option>
                                                            <option>Deporte</option>
                                                            <option>Recomendación</option>

                                                        </select>
                                                        <h7 class="obligatorio">Campo obligatorio*</h7>
                                                    </p>


                                                </div>




                                                <div class="form-group">

                                                    <label for="number">Título de la foto</label>
                                                    <input type="text" class="form-control" placeholder="Título de la foto " id="number" required>
                                                </div>


                                                <div class="form-group">
                                                    <br>
                                                    <label for="number">Descripción de la foto</label>
                                                    <input type="text" class="form-control" placeholder="Descripción " id="number" required>
                                                    <br>
                                                </div>


                                                <div class="alert alert-success" role="alert">

                                                    <!--<h4 class="alert-heading">Termine su registro</h4> -->

                                                    <p id="parrafo1">La empresa responsable del tratamiento de tus datos es Lebasi Swiss Group, con domicilio en Av. las Americas 1604-1 Jardines de Santa Elena Aguascalientes, Aguascalientes, México. Los datos introducidos en el concurso no se cederán a ninguna tercera empresa. Podrás ejercer, en cualquier momento, tus derechos de acceso, rectificación, supresión, oposición, limitación, portabilidad u olvido al tratamiento de tus datos enviando un correo electrónico a la siguiente dirección: operaciones1@lebasigroup.com. Más información en la política de privacidad.
                                                    </p>


                                                </div>

                                                <style>
                                                    #parrafo1 {
                                                        font-size: 12px;
                                                    }
                                                    
                                                    #parrafo2 {
                                                        font-size: 12px;
                                                    }

                                                </style>


                                                <br>
                                                <div class="checkboxy">
                                                    <input name="cecky" id="checky" value="1" type="checkbox" required/>
                                                    <label class="terms">He leído y acepto las <a href=""><b>Terminos y condiciones</b></a></label>
                                                </div>
                                                <br>
                                                <div class="checkboxy">
                                                    <input name="cecky" id="checky" value="1" type="checkbox" required/>
                                                    <label class="terms">He leído y acepto los <a href=""><b>Politica de privacidad</b></a></label>
                                                </div>
                                                <br>
                                                <div class="checkboxy">
                                                    <input name="cecky" id="checky" value="1" type="checkbox" />
                                                    <label class="terms"> <a href=""><b id="parrafo2">Quiero recibir información y promociones futuras de Lebasi México</b></a></label>
                                                </div>
                                                <br>
                                                <div class="clearfix"></div>
                                                <button onclick="myFunction()" type="submit" class="btn btn-info btn-lg btn-responsive" id="search"> <span class="glyphicon glyphicon-search"></span> Enviar Formulario</button>


                                            </form>
                                        </div>

                                        <script>
                                            function myFunction() {
                                                Swal.fire({
                                                    title: 'Te registraste correctamente!',
                                                    text: 'No olvides de Agendar la cita gratuita son uno de nuestros nutriólogos solo sigue el siguiente vinculo: www.lebasi.com.mx/promociones ' ,
                                                    imageUrl: '../assets/img/img2/Alerta.png',
                                                    imageWidth: 400,
                                                    imageHeight: 200,
                                                    imageAlt: 'Custom image',
                                                })

                                            }

                                        </script>





                                    </div>
                                </center>
                            </div>

                        </div>
                    </section>

                </center>
            </div>

        </div>
    </section>

    <!--FIN DEL FORMULARIO DE LA FOTO-->



<!--  FIN Dinero-->






    <footer class="footer text-faded text-center py-5">
        <div class="container">
            <p class="m-0 small">Copyright &copy; LEBASI </p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!--Alerta bonita-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	
	
	
	
		
		<div id="dZPromocion" class="dropzone img <?php echo ($close1)?'hide':''; ?>"  data-hidden="#imagenProducto2" data-empresario="<?php echo $_POST['pais'].$_POST['empresario']?>" data-url="<?php echo get_bloginfo('template_directory');?>/functions/uploadpromoimg.php">
			<div class="dz-default dz-message"><i class="fa fa-picture-o"></i></div>
			<input type="hidden" name="DocAuth" id="imagenProducto2" value="">
		</div><?php
	endif;?>
<?php get_footer('lebasi');
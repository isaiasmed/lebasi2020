<?php get_header();
	global $post;
	$thumbID = get_post_thumbnail_id( $post->ID );
	$imgDestacada = wp_get_attachment_url( $thumbID );?>
	<div class="parallax-window bannerpagina2" data-parallax="scroll" data-position="top center" data-image-src="<?php echo $imgDestacada;?>">
	</div><?php
	while ( have_posts() ) : the_post();?>
		<div class="title-pagina">
			<?php the_title();?>
		</div>
		<div class="parallax-window contenidopagina clearfix" data-parallax="scroll" data-image-src="<?php echo $imgDestacada;?>">
			<div class="paginapago">
				<div class="contenido pagina">
					<div class="wrap" style="min-height:100vh;">
						<div class="hover"></div>
						<!--<div class="promosinscripciones">
							<img src="<?php echo bloginfo('template_directory').'/images/promoinscripcion.jpg'; ?>">
						</div>-->
						<form class="form-row insc"><?php
							$url= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$end = array_slice(explode('/', rtrim($url, '/')), -1)[0];
							if(is_numeric($end)){
								//echo $end;
								$empObj = getDatoEmpresario($end);
								//echo '<pre>'.print_r($empObj,1).'</pre>';
							}													
							?>
							<h4>Formulario de Inscripción para distribuidores Lebasi México</h4>
							<div>
								<h5>Empresario Patrocinador</h5>
								<p class="clearfix">
									<label>Patrocinador <abbr class="required" title="obligatorio">*</abbr></label><?php
								if($empObj->status=='ok'){?>
										<input class="patrocina yaemp" type="text"  value="<?php echo $end.' | '.$empObj->data->Empresario;?>" disabled>
										<input id="hiddenPatrocina" type="hidden" name="datos[patrocinador]" value="<?php echo $end;?>">
									</p><?php
								}else{?>
									<input class="patrocina" type="text"  value="" >
									</p>								
									<p class="clearfix">
										<button class="patrocinado"><i class="fab fa-searchengin"></i> BUSCAR EMPRESARIO</button>
										<div id="mensajePatrocina"></div>
										<input id="hiddenPatrocina" type="hidden" name="datos[patrocinador]" value="00000">
									</p><?php
								} ?>
							</div>
							<div>
								<h5>Datos Personales</h5>
							</div>
							<!--<p class="clearfix">
								<label>Patrocinador <abbr class="required" title="obligatorio">*</abbr></label>
								<input type="text" name="APaterno" value="" required>
							</p>-->
							<p class="clearfix">
								<label>Apellido Paterno <abbr class="required" title="obligatorio">*</abbr></label>
								<input type="text" name="APaterno" value="" required>
							</p>
							<p class="clearfix">
								<label>Apellido Materno <abbr class="required" title="obligatorio">*</abbr></label>
								<input type="text" name="AMaterno" value="" required>
							</p>
							<p class="clearfix">
								<label>Nombre <abbr class="required" title="obligatorio">*</abbr></label>
								<input type="text" name="Nombre" value="" required>
							</p>
							<p class="clearfix">
								<label>Fecha de Nacimiento <abbr class="required" title="obligatorio">*</abbr></label>
								<input type="text" name="FechaNacimiento" value="" required>
							</p>
							<p class="clearfix">
								<label>Lugar de Nacimiento <abbr class="required" title="obligatorio">*</abbr></label>
								<input type="text" name="LugarNacimiento" value="" required>
							</p>
							<p class="clearfix">
								<label>RFC</label>
								<input type="text" name="RFC" value="">
							</p>
							<p class="clearfix">
								<label>CURP</label>
								<input type="text" name="CURP" value="">
							</p>
							<p class="clearfix">
								<label>¿A qué te dedicas? <abbr class="required" title="obligatorio">*</abbr></label>
								<input type="text" name="Profesion" value="" required>
							</p>
							<p class="clearfix">
								<label>Estado Civil <abbr class="required" title="obligatorio">*</abbr></label>
								<input type="text" name="EdoCivil" value="" required>
							</p>
							<div>
								<h5>Dirección</h5>
							</div>
							<p class="clearfix">
								<label>Calle <abbr class="required" title="obligatorio">*</abbr></label>
								<input type="text" name="Calle" value="" required>
							</p>
							<p class="clearfix">
								<label>No. Exterior <abbr class="required" title="obligatorio">*</abbr></label>
								<input type="text" name="Ext" value="" required>
							</p>
							<p class="clearfix">
								<label>No. Interior </label>
								<input type="text" name="Int" value="" required>
							</p>
							<p class="clearfix">
								<label>CP </label>
								<input type="text" name="CP" value="" required>
							</p>
							<p class="clearfix">
								<label>Colonia </label>
								<input type="text" name="Colonia" value="" required>
							</p>
							<p class="clearfix">
								<label>Municipio /Poblacion </label>
								<input type="text" name="Municipio" value="" required>
							</p>
							<p class="clearfix">
								<label>Estado </label>
								<input type="text" name="Estado" value="" required>
							</p>
							<p class="clearfix">
								<label>Teléfono </label>
								<input type="text" name="Telefono" value="" required>
							</p>
							<div class="clearfix">
								<label>Credencial de Elector </label>
								<span id="dZUpload" class="dropzone img"  data-hidden="#imagen1" data-url="<?php echo admin_url( 'admin-ajax.php?action=handle_dropped_media');?>">
									  <div class="dz-default dz-message"><i class="far fa-address-card"></i></div>
								</span>
								<input type="hidden" name="Identificacion" id="imagen1" required>
							</div>
							<div class="clearfix">
								<label>Comprobante de Domicilio</label>
								<span id="dZUpload2" class="dropzone img"  data-hidden="#imagen2" data-url="<?php echo admin_url( 'admin-ajax.php?action=handle_dropped_media');?>">
									  <div class="dz-default dz-message"><i class="fas fa-file-invoice"></i></div>
								</span>
								<input type="hidden" name="Comprobante" id="imagen2" required>
							</div>
							<div class="sesion">
								<div>
									<h5>Tu cuenta en lebasi.com.mx</h5>
								</div>
								<p class="clearfix">
									<label>Correo Electrónico </label>
									<input type="email" name="user[mail]" value="" required>
								</p>
								<p class="clearfix">
									<label>Contraseña </label>
									<input type="password" name="user[password]" value="" required>
								</p>
							</div>
							<div class="notif">
								* Deberás enviar tu identificación y comprobante de domicilio
							</div>
							<input type="hidden" name="action" value="inscripcion">
							<p>
								<button class="sendInsc" type="submit"><i class="fas fa-sign-in-alt"></i> Enviar Formulario</button>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div><?php
	endwhile; ?>
	</div>
	
<?php get_footer(); ?>
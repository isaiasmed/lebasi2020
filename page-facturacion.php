<?php get_header('lebasi');?>
	<style>
		body{
			#f6f6f6;
		}
		#facturasol {
			background: #fff;
			padding: 30px;
			border-radius: 15px;
		}
		#rem td{
			font-size:12px;
		}
		.error_fact {
			background: #e8d1d1;
			color: #ca1c1c;
			padding: 20px;
			border: 1px dashed;
			border-radius: 8px;
		}
	</style>
	<div class="container">
		<div class="row mt-5 principal">
			<div>
				<h2>Bienvenido a la página de facturación de Lebasi en México</h2>
				Servicio ofrecido por Swiss Group EGC  <a href="#" class="btn btn-lnk ml-1" onclick="window.location.reload(true); return false;"> Regresar a otra remisión</a><?php
				$estados=array(
					'AG' => 'AGUASCALIENTES',
					'BN' => 'BAJA CALIFORNIA NORTE',
					'BS' => 'BAJA CALIFORNIA SUR',
					'CH' => 'COAHUILA',
					'CI' => 'CHIHUAHUA',
					'CL' => 'COLIMA',
					'CP' => 'CAMPECHE',
					'CS' => 'CHIAPAS',
					'DF' => 'DISTRITO FEDERAL',
					'DG' => 'DURANGO',
					'GE' => 'GUERRERO',
					'GJ' => 'GUANAJUATO',
					'HD' => 'HIDALGO',
					'JA' => 'JALISCO',
					'MC' => 'MICHOACAN',
					'MR' => 'MORELOS',
					'MX' => 'MEXICO',
					'NA' => 'NAYARIT',
					'NL' => 'NUEVO LEON',
					'OA' => 'OAXACA',
					'PU' => 'PUEBLA',
					'QE' => 'QUERETARO',
					'QI' => 'QUINTANA ROO',
					'SI' => 'SINALOA',
					'SL' => 'SAN LUIS POTOSI',
					'SO' => 'SONORA',
					'TA' => 'TAMAULIPAS',
					'TB' => 'TABASCO',
					'TL' => 'TLAXCALA',
					'VC' => 'VERACRUZ',
					'YU' => 'YUCATAN',
					'ZA' => 'ZACATECAS',
				);
		
				$razon=''; //regresar los datos del sistema
				$rfc='';
				$estado='';
				$ciudad='';
				$gasto='';
				$email='';
				$cp='';
				$conektaa='';
				$resconekta='';
				$tipopago='';
				$metodo='';
				$uid='';?>
				<form id="remisionf">
					<div class="row">
						<div class="col-2">
							Almacen:
						</div>
						<div class="col-3">
							Número de Remisión
						</div>
						<div class="col-7">
							Clave de Facturación
						</div>
					</div>
					<div class="row">
						<div class="col-2">
							<input type="text" class="form-control" name="sucursal" required>
						</div>
						<div class="col-3">
							<input type="text" class="form-control" name="NumRemision" required>
						</div>
						<div class="col-7">
							<input type="text" class="form-control" name="Clave" required>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-12">
							<input type="hidden" name="action" value="getremisionf">
							<button class="btn btn-primary" type="submit"><i class="fa fa-file-text-o" aria-hidden="true"></i> Consultar</button>
						</div>
					</div>
				</form>
				<form id="facturasol" style="display:none;">
					<h2>Datos para facturar</h2><?php
					if($uid!=''){
						echo '<div class="alert">Este pedido ya se encuentra facturado</div><br>';
							echo '<div class="form" ><input style="min-width: 380px;padding: 10px;border: 1px solid #e5e5e5;color: #f00;display: block;margin: 0 auto;text-align: center;max-width: 480px;" type="mail" class="mailnew" value="" placeholder="Correo para reenvio de factura"></div><br>';
						echo '<a style="margin: 10px auto;display: block;text-align: center;max-width: 480px;" id="reenviofactura" href="#" data-uid="'.$uid.'" class="button">Reenviar Factura</a>';
					}else{ ?>
						<table class="table table-bordered">
							<tr>
								<th width="40%" style="line-height: 13px;">Nombre ó Razon Social <br><span style="color:#f00;font-size: 11px;line-height: 10px;font-weight: normal;">Deben capturarse en mayúsculas y sin acentos, sin el régimen capital o societario, si se trata de una persona moral, tal cual aparece en la Constancia de Situación Fiscal.</span></th>
								<td><input class="form-control" id="razon" style="width: 100%;line-height: 30px;" name="razon" type="text" value="<?php echo $razon;?>" required></td>
							</tr>
							<tr>
								<th>RFC</th>
								<td><input id="rfc" name="rfc" type="text" value="<?php echo $rfc;?>" required class="form-control"></td>
							</tr>
							<tr>
								<th>Regimen Fiscal</th>
								<td>
									<?php $options=get_regimen_fiscal()?>
									<select class="form-control" name="regimen" required><?php
										foreach($options as $oo){?>
											<option value="<?php echo $oo['key'];?>"><?php echo $oo['name'];?></option><?php				
										}?>					
									</select>
								</td>
							</tr>
							<tr>
								<th style="line-height: 13px;">Código Postal del Domicilio Fiscal <br><span style="color:#f00;font-size: 11px;line-height: 10px;font-weight: normal;">El Código Postal debe coincidir exactamente, tal cual aparece en la Constancia de Situación Fiscal</span></th>
								<td><input id="cp" name="cp" type="text" value="<?php echo $cp;?>" class="form-control" required></td>
							</tr>
							<tr>
								<th>Ciudad</th>
								<td><input id="municipio" name="ciudad" type="text" value="<?php echo $ciudad;?>" class="form-control" required></td>
							</tr>
							<tr>
								<th>Estado</th>
								<td>
									<select id="estado" name="estado" class="form-control" required>
										<option value="">Selecciona el Estado</option><?php
									foreach($estados as $ee){?>
										<option value="<?php echo $ee;?>"><?php echo $ee;?></option><?php
									} ?>
									</select>
									<!--<input name="estado" type="text" value="<?php echo $estados[$estado];?>">-->
								</td>
							</tr>
							<tr>
								<th style="line-height: 13px;">Uso de CFDI<br><span style="color:#f00;font-size: 11px;line-height: 10px;font-weight: normal;">Se valida de acuerdo al regimen fiscal</span></th>
								<td>
									<?php $optionsgasto=get_tipo_gasto();?>
									<select class="form-control" name="tipogasto" required>
										<option value="">Selecciona Tipo de Gasto</option><?php
										foreach($optionsgasto as $oo){?>
											<option rel="<?php echo implode(",",$oo["regimenes"]);?>" value="<?php echo $oo['key'];?>"><?php echo $oo['name'];?></option><?php				
										}?>					
									</select>
								</td>
							</tr>
							<tr>
								<th>Enviar a:</th>
								<td><input id="email" name="email" type="email" value="<?php echo $email;?>" class="form-control" required></td>
							</tr>
							<tr>
								<th>Forma de pago:</th>
								
								<td>
									<select id="formadepago" class="form-control" name="formadepago" required>
										<option value="">Selecciona forma de pago</option>
										<option <?php if($tipopago=='oxxo'){ echo " selected "; }?> value="01">Efectivo</option>
										<option <?php if($tipopago=='credit'){ echo " selected "; }?> value="04">Tarjeta de Crédito</option>
										<option <?php if($tipopago=='debit'){ echo " selected "; }?> value="28">Tarjeta de Débito</option>
										<option value="03" <?php if($metodo=='conektaspei' || $tipopago=='spei'){ echo " selected "; }?>>Transferencia electrónica de fondos</option>
									</select>
								</td>
							</tr>
						</table><?php
					} ?>
					<input type="hidden" name="action" value="ajaxgetfactura">
					<input id="order" type="hidden" name="order" value=""><?php
					//if($data['status']=='processing' || $data['status']=='completed'){?>
						<button class="btn btn-primary btn-xl">Facturar</button><?php
					//}?>
				</form>
				<div id="facturaresults">
				
				</div>				
			</div>
		</div>
	</div>
<?php get_footer('lebasi'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Trazabilidad</title>
		<meta charset="UTF-8">
		<style type="text/css">
			.centro{
				text-align: center;
			}

			.derecha{
				text-align: right;
			}

			.active{
				font-weight: bold;
				color:#0B6121;
			}

			.desactive{
				font-weight: bold;
				color:#8A0808;
			}

		</style>
	</head>

	<body style="background: #ffffff;">
				<div class="contenedor-form" style="width:100%;">
			
	  		<div class="modal-header">
	    		<h3 class="modal-title">
	    			<img class="img-header" src="img/productor.png"> Información detallada del productor
	    		</h3>
	  		</div>

	  	</div>
		<br>

		<div style="width:90%; margin:0px auto; " >
				<div class="div-contenedor-form">
			      		<div>
			      			<?php
			      				include('../../mod/conexion.php');
			      				$id_productor = $_POST['id'];
			      				$consulta = "select id_productor, nombre_productor, apellido_productor, ".
								"telefono_productor, direccion_productor, ubicacion_huerta_productor, ".
								" rfc_productor, id_usuario_fk, id_usuario_que_registro, estado from empresa_productores where id_productor = ".$id_productor;
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      			?>
					      	<div>
					      		<div style="float:left; width:45%; margin-left:5%; background: #ffffff">
						      		<p class="alert alert-info">DATOS DEL PRODUCTOR</p>
						      		<table class="table">
						      			<tbody>
						      				<tr>
						      					<td width="200"><strong>Nombre:</strong></td>
						      					<td><?php echo $row['nombre_productor']." ".$row['apellido_productor']; ?></td>
						      				</tr>
						       				<tr>
						      					<td><strong>RFC:</strong></td>
						      					<td><?php echo $row['rfc_productor']; ?> </td>
						      				</tr>
						      				<tr>
						      					<td><strong>Dirección del productor:</strong></td>
						      					<td><?php echo $row['direccion_productor']; ?> </td>
						      				</tr>
						      				<tr>
						      					<td><strong>Ubicación huerta:</strong></td>
						      					<td><?php echo $row['ubicacion_huerta_productor']; ?> </td>
						      				</tr>
						      				<tr>
						      					<td><strong>Teléfono:</strong></td>
						      					<td><?php echo $row['telefono_productor']; ?> </td>
						      				</tr>
						      				<tr>
						      					<td><strong>Estado:</strong></td>
						      					<?php 
						      						if($row['estado'] == 1) {
						      							echo '<td> <p class="active"> Activo </p> </td>';
						      						}else{
						      							echo '<td> <p class="desactive"> Inactivo </p> </td>';
						      						}
						      					?>
						      				</tr>
						      			</tbody>
						      		</table>
						      		<center>
						      			<a href="index.php?op=bus_productor">
						      				<button class="btn btn-primary">
						      				Regresar
						      			</button>
						      			</a>
						      		</center>
						      		<p>&nbsp;</p>
					      		</div>
								<div style="float:left; width:45%; margin-left:5%;background: #ffffff">
									<p class="alert alert-info">DATOS DE LOS PRODUCTOS</p>
		  								<div style="width:500px; margin:0px auto;" id="e" class="alert alert-danger centro hidden" role="alert">		
		  									<strong>Ya existe ese producto en el Productor</strong>
			   	 						</div>
									<center>
										<button data-toggle="modal" data-target="#modalProducto" class="btn btn-primary">
		  									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar producto
		  								</button>
									</center>

									<?php 

										$consulta = "select id_productos_productores, nombre_producto, variedad_producto, descripcion_detalles_pp from productos join productos_productores on productos_productores.id_producto_fk = productos.id_producto where productos_productores.id_productor_fk =".$id_productor;

										//echo $consulta;
				      					$resultado = mysql_query($consulta);
				      					$i=1;
									 ?>
						      		<table class="table">
						      			<thead>
						      				<tr>
							       				<th> <strong>#</strong></th>
							      				<th> <strong>Nombre</strong></th>
							      				<th> <strong>Descripción</strong></th>
							      				<th></th>
							      				<th></th>
						      				</tr>

						      			</thead>
						      			<tbody id="productosDetalles">
						      				<?php 
						      				// if($nose = mysql_num_rows($resultado) > 0){
						      					$nose = 0; 
						      					while($row = mysql_fetch_array($resultado)){
											?>
													<tr>
														<td> <?php echo $i; ?> </td>
														<td> <?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?> </td>
														<td> 
															<?php 
																$descrip = $row['descripcion_detalles_pp']; 
																if(strlen($descrip) > 20){
																	$descrip = substr($descrip,0,20);
																	$descrip .= "...";
																}
																echo $descrip; 
															?> 
														</td>
														<td> <button class="btn btn-link" onclick="modificarDescripcion(<?php echo $row['id_productos_productores']; ?>, '<?php echo $row['descripcion_detalles_pp']; ?>', <?php echo $id_productor; ?>)"> Cambiar Descripción</button> </td>
														<td style="float:right;"> <span onclick="eliminarProducto(<?php echo $row['id_productos_productores']; ?>, <?php echo $id_productor; ?>)" data-toggle="tooltip" data-placement="top" title="Eliminar" style="cursor:pointer; color:#931111;" class="eliminar glyphicon glyphicon-remove" aria-hidden="true"></span></td>

													</tr>
											<?php


						      						$i++;
						      						$nose++;
						      					}

						      					?><br>
										    	 	<div style="width:500px; margin:0px auto;" id="a" class="alert alert-danger centro" role="alert"> 
										    	 		<strong>No se encontraron Productos en el productor.</strong>
										    	 	</div>
										    	<?php

										    	if($nose != 0){ ?>
										    		<script type="text/javascript">
										    			$('#a').hide();
										    		</script>
										    	<?php }
						      				 ?>
						      				
						      			</tbody>
						      		</table>
					      		</div>
				
					      	</div>
					    </div>
					<?php
						mysql_close();
					?>
				</div>
		</div>

		 	<div class="modal fade bs-example-modal-lg" id="modalDescripcion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<span id="titulo-detalles">Descripción del producto</span>
						</h3>
					</div>
					<div class="modal-body" style="background:#FFFFFF;">
						<textarea id="descripcion" class="form-control" rows="5" style="resize:none;">

						</textarea>
						<input type="hidden" id="id_producto_productor" name="id_producto_productor">
						<input type="hidden" id="id_productor" name="id_productor">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button onclick="cambiarDescripcion()" type="button" class="btn btn-primary" data-dismiss="modal">Cambiar descripción</button>
					</div>
				</div>
			</div>
		</div>



	  	<div class="modal fade bs-example-modal-lg" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<span id="titulo-detalles">Buscar Producto</span>
						</h3>
					</div>
					<div class="modal-body" style="background:#FFFFFF;">
						<div class="form-inline">
							<center>
								<input type="text" class="form-control" name="inputBuscarProducto" id="inputBuscarProducto"  onkeyup="if(event.keyCode == 13) buscarProductos('<?php echo $id_productor; ?>');" style="width: 80%;">
								<button type="button" class="btn btn-primary" onclick="buscarProductos('<?php echo $id_productor; ?>')"><i class="glyphicon glyphicon-search"></i> Buscar</button>
							</center>
						</div>
						<div id="contenedor-productos">
							<table class="table">
								<thead>
									<th class="centro">#</th>
									<th>Nombre del Producto</th>
									<th></th>
								</thead>
								<tbody>
									<?php 
										include('../../mod/conexion.php');

										$cont = 1;
									    $consulta = "SELECT * FROM productos ORDER BY RAND() LIMIT 10";
										$resultado = mysql_query($consulta);
										while($row = mysql_fetch_array($resultado)){ 
									?>
											<tr>
												<td class="centro"><?php echo $cont; ?></td>
								          		<td><?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?></td>
								          		<td class="derecha">
									        		<button class="btn btn-success" onClick="agregarProductoProductores(<?php echo $row['id_producto']; ?>, '<?php echo $id_productor; ?>');"><i class="glyphicon glyphicon-ok"></i> Agregar</button>
									        	</td>
									        	<?php $cont++; ?>
								    	    </tr>
										<?php }
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</div>
		</div>

		<!--<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>-->
		<script type="text/javascript">
			$('.eliminar').tooltip();

			function modificarDescripcion(idProductoProductor, descripcion, idProductor){
					//alert("idProductoProductor: "+idProductoProductor+" -- descripcion: "+descripcion+" -- idProducto: "+idProductor);
					$('#descripcion').val(descripcion);
					$('#id_producto_productor').val(idProductoProductor);
					$('#id_productor').val(idProductor);
					$('#modalDescripcion').modal('show');
			}

			function cambiarDescripcion(){
				var params = {'idProProductor': $('#id_producto_productor').val(), 'idPro': $('#id_productor').val(), 'descripcion':$('#descripcion').val()};

				$.ajax({
					type: 'POST',
					url: 'busquedas/editarDescripcionProductos.php',
					data: params,

					success: function(data){
						$('#e').addClass('hidden');

						$('#productosDetalles').html(data);
					}
				});

			}

			function eliminarProducto(idProductoProductor, idProductor){
				var params = {'idProProductor':idProductoProductor, 'idPro':idProductor};
					//alert(idProductoProductor +" "+idProductor);
					$.ajax({
						type: 'POST',
						url: 'busquedas/eliminarProductoProductor.php',
						data: params,

						success: function(data){
							if(data == "e"){
								$('#a').show();
								$('#e').addClass('hidden');
								$('#productosDetalles').html('');
							}else{
								$('#e').addClass('hidden');
								$('#productosDetalles').html(data);
							}
							//alert("ok");
						}
					});
			}

			function buscarProductos(idProductor){
				var productoBuscar = $('#inputBuscarProducto').val();
				if(productoBuscar != ''){
					var params = {'producto':productoBuscar, 'productor': idProductor};

					$.ajax({
						type: 'POST',
						url: 'busquedas/buscar_producto.php',
						data: params,

						success: function(data){
							$('#contenedor-productos').html(data);
							$('#inputBuscarProducto').select();
						}
					});
				}
			}

			function agregarProductoProductores(idProducto, idProductor){
				//alert("producto: "+idProducto+" --  productor: "+idProductor);
    			var params = {'idProducto':idProducto, 'idProductor':idProductor};
    			$.ajax({
					type: 'POST',
					url: 'busquedas/agregarProductoProductor.php',
					data: params,

					success: function(data){
						if(data == "e"){
							$('#e').removeClass('hidden');
							$('#modalProducto').modal('hide');
						}else{
							$('#a').hide();
							$('#e').addClass('hidden');
							$('#productosDetalles').html(data);
							$('#modalProducto').modal('hide');
						}
					}
				});
			}
		</script>
	</body>
</html>
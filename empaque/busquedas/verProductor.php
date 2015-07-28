<!DOCTYPE html>
<html>
	<head>
		<title>Trazabilidad</title>
		<meta charset="UTF-8">
		<link rel='stylesheet' type='text/css' href='../lib/pagination/css.css'/>
		<script type="text/javascript" src="../lib/pagination/jquery-simple-pagination-plugin.js"></script>
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
								"telefono_productor, direccion_productor, fecha_registro_prod, fecha_modificacion_prod, ".
								" rfc_productor, id_usuario_fk, nombre_usuario, id_usuario_que_registro, estado_p from empresa_productores, usuarios where id_usuario_fk = id_usuario AND id_productor = ".$id_productor;
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      			?>
					      	<div>
					      		<div style="float:left; width:45%; margin-left:5%; background: #ffffff">
						      		<p class="alert alert-info">DATOS DEL PRODUCTOR</p>

						      		<button data-toggle="tooltip" title="Descargar reporte" style="float: right; margin-top: -15px; margin-bottom: 5px; margin-right: 10px;" class="btn btn-primary"><span class="glyphicon glyphicon-save-file"> </span></button>
						      		
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
						      					<td><strong>Usuario:</strong></td>
						      					<td><?php echo $row['nombre_usuario']; ?> </td>
						      				</tr>
						      				<tr>
						      					<td><strong>Dirección del productor:</strong></td>
						      					<td><?php echo $row['direccion_productor']; ?> </td>
						      				</tr>
						      				
						      				<tr>
						      					<td><strong>Teléfono:</strong></td>
						      					<td><?php echo $row['telefono_productor']; ?> </td>
						      				</tr>
						      				<tr>
						      					<td><strong>Fecha de registro:</strong></td>
						      					<td><?php echo $row['fecha_registro_prod']; ?> </td>
						      				</tr>
						      				<tr>
						      					<td><strong>Última modificación:</strong></td>
						      					<td><?php echo $row['fecha_modificacion_prod']; ?> </td>
						      				</tr>
						      				<tr>
						      					<td><strong>Estado:</strong></td>
						      					<?php 
						      						if($row['estado_p'] == 1) { ?>
						      							<td> <p class="label label-success"> Activo </p> </td>
						      						<?php }else{ ?>
						      							echo <td> <p class="label label-danger"> Inactivo </p> </td>
						      						<?php }
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
		  									<strong>Ya existe ese producto asignado al productor</strong>
			   	 						</div>
									<center>
										<button data-toggle="modal" data-target="#modalProducto" class="btn btn-primary">
		  									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar producto
		  								</button>
									</center>

									<?php 

										$consulta = "select id_productos_productores, ubicacion_huerta, hectareas, nombre_producto, variedad_producto, descripcion_detalles_pp from productos join productos_productores on productos_productores.id_producto_fk = productos.id_producto where productos_productores.id_productor_fk =".$id_productor;

										//echo $consulta;
				      					$resultado = mysql_query($consulta);
				      					$i=1;
									 ?>
						      		<table class="table">
						      			<thead>
						      				<tr>
							       				<th> <strong>#</strong> </th>
							      				<th> <strong>Nombre</strong> </th>
							      				<th> <strong>Huerta</strong> </th>
							      				<th> <strong>Ha.</strong> </th>
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
														<td> <?php echo $row['ubicacion_huerta'] ?></td>
														<td> <?php echo $row['hectareas'] ?></td>
														<td style="float:right;"> 
															<span style="cursor:hand; margin-right:10px" class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Modificar" class="btn btn-link" onclick="modificar(<?php echo $row['id_productos_productores']; ?>, '<?php echo $row['ubicacion_huerta']; ?>','<?php echo $row['hectareas']; ?>', <?php echo $id_productor; ?>)"></span>
															<span onclick="eliminarProducto(<?php echo $row['id_productos_productores']; ?>, <?php echo $id_productor; ?>)" data-toggle="tooltip" data-placement="top" title="Eliminar" style="cursor:pointer; color:#931111;" class="eliminar glyphicon glyphicon-remove" aria-hidden="true"></span></td>

													</tr>
											<?php
						      						$i++;
						      						$nose++;
						      					}

						      					?><br>
										    	 	<div style="width:80%; margin:0px auto;" id="a" class="alert alert-danger centro" role="alert"> 
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
		<div style="clear:both"></div>
		<p>&nbsp;</p>
		 	<div class="modal fade bs-example-modal-lg" id="modalDescripcion" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<span id="titulo-detalles">Detalles del producto</span>
						</h3>
					</div>
					<div class="modal-body" style="background:#FFFFFF;">
						<label>Ubicación de la huerta: </label><input id="huerta" name="huerta" type="text" class="form-control">
						<label>Hectáreas: </label><input id="ha" name="hectareas" type="number" min="1" class="form-control">
						<input type="hidden" id="id_producto_productor" name="id_producto_productor">
						<input type="hidden" id="id_productor" name="id_productor">
					</div>
					<div class="modal-footer">
						<button style="width:100px;" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<button style="width:100px;" onclick="cambiar()" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
					</div>
				</div>
			</div>
		</div>



	  <div class="modal fade bs-example-modal-md" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header" style="margin:0">
							<img class="img-header" src="img/buscar.png">
							<span id="titulo-detalles">Buscar Producto</span>
						</h3>
					</div>
					<div class="modal-body" style="background:#FFFFFF;">
						<div class="form-inline">
								<label class="col-sm-2 control-label">Buscar</label>
								<input style="width:60%" placeholder="Buscar nombre del producto" type="text" class="form-control" name="inputBuscarProducto" id="inputBuscarProducto"  onkeyup="if(event.keyCode == 13) buscarProductos(<?php print $id_productor ?>);" style="width: 80%;">
								<button type="button" class="btn btn-primary" onclick="buscarProductos(<?php print $id_productor ?>)"><i class="glyphicon glyphicon-search"></i> Buscar</button>

						</div>
						
					<div style="clear:both"></div>
					<p>&nbsp;</p>
						<div id="contenedor-productos">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</div>
		</div>

		<!--<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>-->
		<script type="text/javascript">
			$('.eliminar').tooltip();
			$('[data-toggle="tooltip"]').tooltip()

			function modificar(idProductoProductor, huerta, ha, idProductor){
					//alert("idProductoProductor: "+idProductoProductor+" -- descripcion: "+descripcion+" -- idProducto: "+idProductor);
					$('#huerta').val(huerta);
					$('#ha').val(ha);
					$('#id_producto_productor').val(idProductoProductor);
					$('#id_productor').val(idProductor);
					$('#modalDescripcion').modal('show');
			}

			function cambiar(){
				var params = {'idProProductor': $('#id_producto_productor').val(), 'idPro': $('#id_productor').val(), 'huerta':$('#huerta').val(), 'hectareas':$('#ha').val()};

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
					var params = {'producto':productoBuscar, 'productor': idProductor};

					$.ajax({
						type: 'POST',
						url: 'buscar/buscar_productos.php',
						data: params,

						success: function(data){
							$('#contenedor-productos').html(data);
							$('#inputBuscarProducto').select();
						}
					});
			}

			buscarProductos(<?php print $id_productor ?>);

			function agregarProductoProductores(idProducto, idProductor){
				//alert("producto: "+idProducto+" --  productor: "+idProductor);
    			var params = {'idProducto':idProducto, 'idProductor':idProductor};
    			$.ajax({
					type: 'POST',
					url: 'busquedas/agregarProductoProductor.php',
					data: params,

					success: function(data){
							
							$('#a').hide();
							$('#e').addClass('hidden');
							$('#productosDetalles').html(data);
							$('#modalProducto').modal('hide');
						
					}
				});
			}


			$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			});
		</script>
	</body>
</html>
<?php
	@session_start();

	if(!isset($_SESSION['tipo_socio'])){
		header('Location: ../');
	}
	else{
		switch($_SESSION['tipo_socio']) {
			case 1: header('Location: ../../productor/');
					break;
			case 2: header('Location: ../../empaque/');
					break;
			case 4: header('Location: ../../puntoVenta/');
					break;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Trazabilidad</title>
		<meta charset="UTF-8">

		<link rel="stylesheet" type="text/css" href="../../lib/bootstrap-3.3.5/css/bootstrap.min.css">
		<link rel='stylesheet' type='text/css' href='../../lib/pagination/css.css'/>
		<link rel="stylesheet" type="text/css" href="../../css/estilos.css">
	</head>

	<body>
		<?php 
			include('../mod/navbar.php');
		?>
		<div class="contenido-general">
			<div class="modal-header">
				<h3 class="titulo-header">
					<h3 class="titulo-contenido">
						<img class="img-header" src="../../img/historial_envios.png"> Historial de Pedidos Enviados
					</h3>
				</h3>
			</div>
			<div class="contenido-general-2">
				<br>
				<?php if(isset($_REQUEST['e'])){ ?>
			  		<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> Error al registrar envío.
					</div>
			  	<?php } ?>
				<div id="paginacion-resultados">
					<table class="table">
						<thead>
							<tr>
								<th class="centro">Ped</th>
								<th>Punto de Venta</th>
								<th class="centro">Fecha Envio</th>
								<th class="centro">Fecha Entrega</th>
								<th class="centro">Estado</th>
								<th></th>
							</tr>
						</thead>

						<tbody>
							<?php
								include('../../mod/conexion.php');

								$consulta = "SELECT id_distribuidor_fk FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
								$resultado = mysql_query($consulta);
								$row = mysql_fetch_array($resultado);
								$id_distribuidor_fk = $row['id_distribuidor_fk'];

								$cont = 0;
								$cancelar = 1;
							    $consulta = "SELECT envdis.id_envio, envdis.id_orden_dist_fk, mpsapv.nombre_punto_venta, envdis.fecha_envio, envdis.hora_envio, envdis.fecha_entrega_envio, envdis.estado_envio FROM ordenes_punto_venta AS ordspv, empresa_punto_venta AS mpsapv, envios_distribuidor AS envdis WHERE envdis.id_orden_dist_fk = ordspv.id_orden AND envdis.id_punto_venta_fk = mpsapv.id_punto_venta AND ordspv.id_distribuidor_fk = $id_distribuidor_fk ORDER BY envdis.id_envio DESC";
								$resultado = mysql_query($consulta);
								while($row = mysql_fetch_array($resultado)){ ?>
									<tr>
						          		<td class="centro"><?php echo $row['id_orden_dist_fk']; ?></td>
						          		<td><?php echo $row['nombre_punto_venta']; ?></td>
						          		<td class="centro"><?php echo $row['fecha_envio']; ?></td>
						          		<td class="centro"><?php echo $row['fecha_entrega_envio']; ?></td>
						          		<?php
					          				$estado = $row['estado_envio'];

					          				switch($estado) {
					          					case '1': echo "<td class='centro pendiente'>PENDIENTE</td>"; break;
					          					case '2': echo "<td class='centro rechazado'>RECHAZADO</td>"; break;
					          					case '3': echo "<td class='centro enviado'>ENVIADO</td>"; break;
					          					// case '3': echo "<td class='centro enviado'><span class='link-estado' onclick='mostrarModalEstado(".$row['id_envio'].", ".$row['id_orden_dist_fk'].")'>ENVIADO</span></td>"; break;
					          					case '4': echo "<td class='centro concretado'>CONCRETADO</td>"; break;
					          					case '5': echo "<td class='centro cancelado'>CANCELADO</td>"; $cancelar = 0; break;
					          					case '6': echo "<td class='centro aprobado'>APROBADO</td>"; break;
					          				}
					          			?>
						          		<td class="derecha">
						          			<button class="btn btn-info" id="btn-epcs" onClick="mostrarDetallesEPCs(<?php echo $row['id_orden_dist_fk']; ?>)" data-toggle="tooltip" title="Ver detalles epcs"><i class="glyphicon glyphicon-tags"></i></button>
						          			<?php if($cancelar == 1) {?>
						          				<button class="btn btn-danger" id="btn-cancelar" onClick="cancelarOrden(<?php echo $row['id_envio']; ?>)" data-toggle="tooltip" title="Cancelar órden"><i class="glyphicon glyphicon-remove"></i></button>
						          			<?php } ?>
							        		<!-- <button class="btn btn-primary" onClick="mostrarDetalles(<?php echo $row['id_orden_dist_fk']; ?>)">Detalles</button> -->
							        	</td>
						    	    </tr>
								<?php $cont++; 
								}
							?>
						</tbody>
					</table>

					<?php if($cont > 0){ ?>
						<div class="my-navigation" style="margin: 0px auto;">
							<div class="simple-pagination-page-numbers"></div>
							<br><br><br>
						</div>
					<?php } else{ ?>
						<div class="alert alert-info" role="alert" style="text-align: center;">
							<strong>Sin resultados...</strong> No hay pedidos enviados registrados.
						</div>
					<?php } ?>

					<?php 
						mysql_close();
					?>
				</div>
			</div>
		</div>

		<!-- <div class="modal fade bs-example-modal-lg" id="modalEstado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<img class="img-header" src="../../img/cambiar_estado.png"> <span id="titulo-estado">Cambiar Estado del Pedido</span>
						</h3>
					</div>
					<div class="modal-body">
						<label>Estado:</label>
						<input type="hidden" name="inputIdEnvio" id="inputIdEnvio">
						<select class="form-control" name="inputEstado" id="selectEstado">
							<option value="5">CANCELADO</option>
						</select>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
						<button type="button" class="btn btn-primary" onclick="cambiarEstado()"><i class="glyphicon glyphicon-floppy-disk"></i> Cambiar Estado</button>
					</div>
				</div>
			</div>
		</div> -->

		<div class="modal fade bs-example-modal-lg" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<img class="img-header" src="../../img/detalles_orden.png"> <span id="titulo-detalles">Detalles de la Órden</span>
						</h3>
					</div>
					<div class="modal-body">
						<div class="contenedor-detalles-orden" id="contenedor-detalles-orden">

						</div>
					</div>
					<div class="modal-footer">
						 <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../../lib/pagination/jquery-simple-pagination-plugin.js"></script>

		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
			$('#btn-epcs').tooltip();
			$('#btn-cancelar').tooltip();

			function mostrarDetallesEPCs(orden){
				$.ajax({
					type: 'POST',
					url: '../mod/buscar_epcs_pedido.php',
					data: {'orden':orden},

					success: function(data){
						$('#contenedor-detalles-orden').html(data);
						$('#titulo-detalles').text('Detalles de la Órden ' + orden + ' - Enviados y Recibidos');
						$('#modalDetalles').modal('show');
					}
				});
			}

			function cancelarOrden(envio){
				// var envio = $('#inputIdEnvio').val();

				var respuesta = confirm("¿Desea cancelar el envío " + envio + "?");
			    if(respuesta){
					$.ajax({
						type: 'POST',
						url: '../mod/cambiar_estado_envio.php',
						data: {'envio':envio},

						success: function(data){
							$(location).attr('href', '../enviosPedidos/');
						}
					});
				}
			}

			// function mostrarModalEstado(envio, pedido){
			// 	$('#inputIdEnvio').val(envio);
			// 	$('#titulo-estado').text('Cambiar Estado del Envío del Pedido ' + pedido);
			// 	$('#modalEstado').modal('show');
			// }

			// function cambiarEstado(){
			// 	var envio = $('#inputIdEnvio').val();

			// 	var respuesta = confirm("¿Desea cancelar el envío " + envio + "?");
			//     if(respuesta){
			// 		$.ajax({
			// 			type: 'POST',
			// 			url: '../mod/cambiar_estado_envio.php',
			// 			data: {'envio':envio},

			// 			success: function(data){
			// 				$(location).attr('href', '../enviosPedidos/');
			// 			}
			// 		});
			// 	}
			// }

			// function mostrarDetalles(orden){
			// 	$.ajax({
			// 		type: 'POST',
			// 		url: '../mod/buscar_detalles_orden_pv.php',
			// 		data: {'orden':orden},

			// 		success: function(data){
			// 			$('#contenedor-detalles-orden').html(data);
			// 			$('#titulo-detalles').text('Detalles de la Órden ' + orden);
			// 			$('#modalDetalles').modal('show');
			// 		}
			// 	});
			// }
		</script>
	</body>
</html>
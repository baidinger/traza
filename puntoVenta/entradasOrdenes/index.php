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
			case 3: header('Location: ../../distribuidor/');
					break;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Trazabilidad</title>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=0.5">
		<link rel="shortcut icon" href="../../img/logo_trazabilidad.png" type='image/png'>

		<link rel="stylesheet" type="text/css" href="../../lib/bootstrap-3.3.5/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" type="text/css" href="../../lib/bootstrap-3.3.5/css/bootstrap-responsive.min.css" rel="stylesheet"> -->
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
						<img class="img-header" src="../../img/historial_entradas.png"> &nbsp;Entrada de Órdenes
					</h3>
				</h3>
			</div>
			<br>
			<div class="div-buscar">
				<div class="form-inline">
					<input type="text" class="form-control" style="width: 40%;" name="inputBuscar" id="inputBuscar" placeholder="Buscar por nombre del distribuidor..." onkeyup="if(event.keyCode == 13) buscarOrdenes();" autofocus>
					<button class="btn btn-primary" id="btnBuscar" onclick="buscarOrdenes();"><i class="glyphicon glyphicon-search"></i> Buscar</button>
					<button class="btn btn-success" style="float: right;" id="btnBuscar" onclick="busquedaAvanzada();"><i class="glyphicon glyphicon-search"></i> Búsqueda Avanzada</button>
					<a href="../entradasOrdenes/" class="btn btn-info" id="btn-mostrar-todos" style="float: right; margin-right: 10px; display: none;" id="btnBuscar"><i class="glyphicon glyphicon-th-list"></i> Mostrar Todos</a>
				</div>
			</div>
			<div class="contenido-general-2">
				<br>
				<div id="paginacion-resultados">
					<table class="table">
						<thead>
							<tr>
								<th class="centro">ID</th>
								<th>Distribuidor</th>
								<th class="centro">Fecha</th>
								<th class="derecha">Costo</th>
								<th class="centro">Env / Rec</th>
								<th class="centro">Estado</th>
								<th></th>
							</tr>
						</thead>

						<tbody>
							<?php
								include('../../mod/conexion.php');

								$consulta = "SELECT id_punto_venta_fk FROM usuario_punto_venta WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
								$resultado = mysql_query($consulta);
								$row = mysql_fetch_array($resultado);
								$idUsuarioPvFK = $row['id_punto_venta_fk'];

								$cont = 0;
							    $consulta = "SELECT ords.id_orden, epqs.id_distribuidor, epqs.nombre_distribuidor, ords.fecha_entrega_orden, ords.costo_orden, ords.estado_orden FROM ordenes_punto_venta AS ords, empresa_distribuidores AS epqs WHERE ords.id_distribuidor_fk = epqs.id_distribuidor AND ords.id_usuario_punto_venta_fk = $idUsuarioPvFK";
								$resultado = mysql_query($consulta);
								while($row = mysql_fetch_array($resultado)){ 

									$consulta4 = "SELECT id_envio FROM envios_distribuidor WHERE id_orden_dist_fk = ".$row['id_orden']." LIMIT 1";
									$resultado4 = mysql_query($consulta4);
									while($row4 = mysql_fetch_array($resultado4)){
										$idEnvioFk = $row4['id_envio'];	

										$consulta2 = "SELECT epc_caja FROM punto_venta_cajas_envio WHERE recibido_dce = 1 AND id_envio_fk = $idEnvioFk LIMIT 1";
										$resultado2 = mysql_query($consulta2);
										while($row2 = mysql_fetch_array($resultado2)){ 

											$consulta3 = "SELECT COUNT(epc_caja) AS total_enviados FROM punto_venta_cajas_envio WHERE enviado_dce = 1 AND id_envio_fk = $idEnvioFk";
											$resultado3 = mysql_query($consulta3);
											$row3 = mysql_fetch_array($resultado3);
											$totalEnviados = $row3['total_enviados'];

											$consulta3 = "SELECT COUNT(epc_caja) AS total_recibidos FROM punto_venta_cajas_envio WHERE recibido_dce = 1 AND id_envio_fk = $idEnvioFk";
											$resultado3 = mysql_query($consulta3);
											$row3 = mysql_fetch_array($resultado3);
											$totalRecibidos = $row3['total_recibidos']; ?>

											<tr>
												<td class="centro"><?php echo $row['id_orden']; ?></td>
								          		<td>
								          			<?php 
								          				$idDistribuidor = $row['id_distribuidor'];

								          				$consulta2 = "SELECT * FROM empresa_distribuidores WHERE id_distribuidor = $idDistribuidor";
								          				$resultado2 = mysql_query($consulta2);
								          				$row2 = mysql_fetch_array($resultado2);
								          			?>
								          			<a href="#" class="popover-distribuidor" 
								          				tabindex="0"
								          				data-toggle="popover"
								          				data-placement="right"
								          				data-trigger="focus"
								          				data-container="body"
								          				data-html="true"
								          				title="<center><strong><?php echo $row2['nombre_distribuidor']; ?></strong></center>"
								          				data-content="<table class='table'>
								          								<tr>
								          									<td><strong>RFC: </strong></td>
								          									<td><?php echo $row2['rfc_distribuidor']; ?></td>
								          								</tr>
								          								<tr>
								          									<td><strong>Ciudad: </strong></td>
								          									<td><?php echo $row2['ciudad_distribuidor']; ?></td>
								          								</tr>
								          								<tr>
								          									<td><strong>Dirección: </strong></td>
								          									<td><?php echo $row2['direccion_distribuidor']; ?></td>
								          								</tr>
								          								<tr>
								          									<td><strong>Teléfono(s): </strong></td>
								          									<td><?php echo $row2['tel1_distribuidor'].' / '.$row2['tel2_distribuidor']; ?></td>
								          								</tr>
								          								<tr>
								          									<td><strong>Email: </strong></td>
								          									<td><?php echo $row2['email_distribuidor']; ?></td>
								          								</tr>
								          							  <table>">
								          				<?php echo $row['nombre_distribuidor']; ?>
								          			</a>
								          		</td>
								          		<td class="centro"><?php echo $row['fecha_entrega_orden']; ?></td>
								          		<td class="derecha"><?php echo "$ ".number_format($row['costo_orden'], 2, '.', ','); ?></td>
								          		<td class="centro"><?php echo $totalEnviados." / ".$totalRecibidos; ?></td>

								          		<?php
							          				$estado = $row['estado_orden'];

							          				switch($estado) {
							          					case '1': echo "<td class='centro pendiente'>PENDIENTE</td>"; break;
							          					case '2': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR EMPAQUE'>RECHAZADO</span></td>"; break;
							          					case '3': echo "<td class='centro enviado'><span class='link-estado' onclick='cambiarEstadoOrden(".$row['id_orden'].")'>ENVIADO</span></td>"; break;
							          					case '4': echo "<td class='centro concretado'>CONCRETADO</td>"; break;
							          					case '5': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR EMPAQUE'>CANCELADO</span></td>"; break;
							          					case '6': echo "<td class='centro aprobado'>APROBADO</td>"; break;
							          					case '7': echo "<td class='centro pendiente'>PRE-ENVIO</td>"; break;
							          					case '8': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR DISTRIBUIDOR'>CANCELADO</span></td>"; break;
							          					case '9': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR DISTRIBUIDOR'>RECHAZADO</span></td>"; break;
							          					case '10': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR PUNTO DE VENTA'>CANCELADO</span></td>"; break;
							          					case '11': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR PUNTO DE VENTA'>RECHAZADO</span></td>"; break;
							          				}
							          			?>
								          		
								          		<td class="derecha">
								          			<button class="btn btn-info" id="btn-detalles" onClick="mostrarDetalles(<?php echo $row['id_orden']; ?>, <?php echo $idEnvioFk; ?>)" data-toggle="tooltip" title="Ver detalles epcs"><i class="glyphicon glyphicon-tags"></i></button>
									        	</td>
								    	    </tr>
										<?php 
											$cont++; 
										}
									}
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
							<strong>Sin resultados...</strong> No hay entradas registradas.
						</div>
					<?php } ?>

					<?php 
						mysql_close();
					?>
				</div>
			</div>
		</div>

		<div class="modal fade bs-example-modal-lg" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<img class="img-header" src="../../img/detalles_orden.png"> <span id="titulo-detalles">Detalles de la Órden - Enviados y Recibidos</span>
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

		<div class="modal fade bs-example-modal-lg" id="modalEstado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form method="post" action="../mod/rechazar_orden.php">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h3 class="titulo-header">
								<img class="img-header" src="../../img/cambiar_estado.png"> <span id="titulo-estado">Cambiar Estado de la Órden</span>
							</h3>
						</div>
						<div class="modal-body">
							<p><label>Estado:</label></p>
							<p>
								<select class="form-control" name="inputEstado" id="selectEstado">
									<option value="11">RECHAZAR</option>
								</select>
							</p>
							<br>
							<p><label>Motivo de Rechazo:</label></p>
							<p>
								<input type="hidden" name="inputIdOrden" id="inputIdOrden">
								<textarea class="form-control" rows="4" name="inputMotivoRechazo" id="inputMotivoRechazo" placeholder="Motivo de cancelación..." required></textarea>
							</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
							<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Cambiar Estado</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../../lib/pagination/jquery-simple-pagination-plugin.js"></script>

		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
			$('.popover-distribuidor').popover();
			$('.popover-estado').popover();
			$('#btn-detalles').tooltip();

			function buscarOrdenes(){
				var distribuidorBuscar = $('#inputBuscar').val();

				if(distribuidorBuscar != ''){
					$.ajax({
						type: 'POST',
						url: '../mod/buscar_ordenes_entradas.php',
						data: {'distribuidor':distribuidorBuscar},

						beforeSend: function(){
							$('.contenido-general-2').html("<br><center><img id='img-cargando' src='../../img/cargando.gif'></center>");
						},

						success: function(data){
							$('.img-header').attr('src', '../../img/buscar.png');
							$('#lbl-titulo').text('Resultado de la búsqueda "' + distribuidorBuscar + '"');
							$('#inputBuscar').select();
							$('#btn-mostrar-todos').css('display', 'block');
							$('.contenido-general-2').html(data);
						}
					});
				}
			}

			function busquedaAvanzada(){
				alert('Búsqueda avanzada');
			}

			function mostrarDetalles(orden, envio){
				$.ajax({
					type: 'POST',
					url: '../mod/buscar_epcs_orden.php',
					data: {'envio':envio},

					success: function(data){
						$('#contenedor-detalles-orden').html(data);
						$('#titulo-detalles').text('Detalles de la Orden ' + orden + ' - Enviados y Recibidos');
						$('#modalDetalles').modal('show');
					}
				});
			}

			function cambiarEstadoOrden(orden){
				$('#inputIdOrden').val(orden);
				$('#titulo-estado').text('Cambiar Estado de la Órden ' + orden);
				$('#modalEstado').modal('show');
			}
		</script>
	</body>
</html>
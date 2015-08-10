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

			if($privEnvios == 0)
				header('Location: ../');
		?>
		<div class="contenido-general">
			<div class="modal-header">
				<h3 class="titulo-header">
					<h3 class="titulo-contenido">
						<img class="img-header" src="../../img/historial_envios.png"> <span id="lbl-titulo">Historial de Envíos</span>
						<!-- <button class="btn btn-default" id="btnReportes" onclick="generacionReportes();" data-toggle="tooltip" title="Generación e impresión de reportes"><i class="glyphicon glyphicon-print"></i> </button> -->
					</h3>
				</h3>
			</div>
			<br>
			<div class="div-buscar">
				<div class="form-inline">
					<input type="text" class="form-control" name="inputBuscar" id="inputBuscar" placeholder="Buscar por nombre del punto de venta..." onkeyup="if(event.keyCode == 13) buscarEnvios();" autofocus>
					<button class="btn btn-primary" id="btnBuscar" onclick="buscarEnvios();"><i class="glyphicon glyphicon-search"></i> Buscar</button>
					<button class="btn btn-success" id="btnAvanzada" data-toggle="modal" data-target="#modalBusquedaAvanzada"><i class="glyphicon glyphicon-search"></i> Búsqueda Avanzada</button>
					<a href="../envios/" class="btn btn-info" id="btnMostrarTodos"><i class="glyphicon glyphicon-th-list"></i> Mostrar Todos</a>
				</div>
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
								<th class="centro">Env</th>
								<th class="centro">Ped</th>
								<th>Punto de Venta</th>
								<th class="centro">Fecha Envio</th>
								<th class="centro">Fecha Entrega</th>
								<!-- <th class="centro">Camión</th> -->
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
							    $consulta = "SELECT envdis.id_envio, envdis.id_orden_dist_fk, mpsapv.id_punto_venta, mpsapv.nombre_punto_venta, envdis.fecha_envio, envdis.hora_envio, envdis.fecha_entrega_envio, envdis.id_camion_fk, envdis.estado_envio FROM ordenes_punto_venta AS ordspv, empresa_punto_venta AS mpsapv, envios_distribuidor AS envdis WHERE envdis.id_orden_dist_fk = ordspv.id_orden AND envdis.id_punto_venta_fk = mpsapv.id_punto_venta AND ordspv.id_distribuidor_fk = $id_distribuidor_fk ORDER BY envdis.id_envio DESC";
								$resultado = mysql_query($consulta);
								while($row = mysql_fetch_array($resultado)){ ?>
									<tr>
										<td class="centro"><?php echo $row['id_envio']; ?></td>
						          		<td class="centro"><?php echo $row['id_orden_dist_fk']; ?></td>
						          		<td>
						          			<?php 
						          				$idPuntoVenta = $row['id_punto_venta'];

						          				$consulta2 = "SELECT * FROM empresa_punto_venta WHERE id_punto_venta = $idPuntoVenta";
						          				$resultado2 = mysql_query($consulta2);
						          				$row2 = mysql_fetch_array($resultado2);
						          			?>
						          			<a href="#" class="popover-punto-venta" 
						          				tabindex="0"
						          				data-toggle="popover"
						          				data-placement="right"
						          				data-trigger="focus"
						          				data-container="body"
						          				data-html="true"
						          				title="<center><strong><?php echo $row2['nombre_punto_venta']; ?></strong></center>"
						          				data-content="<table class='table'>
						          								<tr>
						          									<td><strong>RFC: </strong></td>
						          									<td><?php echo $row2['rfc_punto_venta']; ?></td>
						          								</tr>
						          								<tr>
						          									<td><strong>Ciudad: </strong></td>
						          									<td><?php echo $row2['ciudad_punto_venta']; ?></td>
						          								</tr>
						          								<tr>
						          									<td><strong>Dirección: </strong></td>
						          									<td><?php echo $row2['direccion_punto_venta']; ?></td>
						          								</tr>
						          								<tr>
						          									<td><strong>Teléfono: </strong></td>
						          									<td><?php echo $row2['telefono_punto_venta']; ?></td>
						          								</tr>
						          								<tr>
						          									<td><strong>Email: </strong></td>
						          									<td><?php echo $row2['email_punto_venta']; ?></td>
						          								</tr>
						          							  <table>">
						          				<?php echo $row['nombre_punto_venta']; ?>
						          			</a>
						          		</td>
						          		<td class="centro"><?php echo date('d/m/Y', strtotime($row['fecha_envio'])); ?></td>
						          		<td class="centro"><?php echo date('d/m/Y', strtotime($row['fecha_entrega_envio'])); ?></td>
						          		<!-- <td class="centro"><a href="../camiones/"><?php echo $row['id_camion_fk']; ?></a></td> -->
						          		<?php
					          				$estado = $row['estado_envio'];

					          				switch($estado) {
					          					case '1': echo "<td class='centro pendiente'><span class='link-estado' onclick='cancelarOrden(".$row['id_envio'].")'>PENDIENTE</span></td>"; break;
					          					case '2': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR EMPAQUE'>RECHAZADO</span></td>"; break;
					          					case '3': echo "<td class='centro enviado'><span class='link-estado' onclick='cancelarOrden(".$row['id_envio'].")'>ENVIADO</span></td>"; break;
					          					case '4': echo "<td class='centro concretado'>CONCRETADO</td>"; break;
					          					case '5': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR EMPAQUE'>CANCELADO</span></td>"; break;
					          					case '6': echo "<td class='centro aprobado'><span class='link-estado' onclick='cancelarOrden(".$row['id_envio'].")'>APROBADO</span></td>"; break;
					          					case '7': echo "<td class='centro pendiente'>PRE-ENVIO</td>"; break;
					          					case '8': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR DISTRIBUIDOR'>CANCELADO</span></td>"; break;
					          					case '9': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR DISTRIBUIDOR'>RECHAZADO</span></td>"; break;
					          					case '10': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR PUNTO DE VENTA'>CANCELADO</span></td>"; break;
					          					case '11': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR PUNTO DE VENTA'>RECHAZADO</span></td>"; break;
					          				}
					          			?>
						          		<td class="derecha">
						          			<button class="btn btn-info" id="btn-epcs" onClick="mostrarDetallesEPCs(<?php echo $row['id_orden_dist_fk']; ?>, <?php echo $row['id_envio']; ?>)" data-toggle="tooltip" title="Ver detalles epcs"><i class="glyphicon glyphicon-tags"></i></button>
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

		<div class="modal fade bs-example-modal-lg" id="modalBusquedaAvanzada" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<img class="img-header" src="../../img/buscar.png"> <span id="titulo-estado">Búsqueda Avanzada</span>
						</h3>
					</div>
					<div class="modal-body">
						<div class="form-horizontal">
							<div class="form-group">
						    	<label class="col-sm-2 control-label">Punto de Venta: </label>
						    	<div class="col-sm-10">
						    		<td style="border-color: #F8F8F8;"><input type="text" class="form-control" name="inputPuntoVenta" id="inputPuntoVenta" placeholder="Nombre del punto de venta..."></td>
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label class="col-sm-2 control-label">Estado: </label>
						    	<div class="col-sm-10">
						    		<select class="form-control" name="inputEstado" id="inputEstado">
										<option value="0">TODOS</option>
										<option value="1">PENDIENTE</option>
										<option value="6">APROBADO</option>
										<option value="7">PRE-ENVIO</option>
										<option value="3">ENVIADO</option>
										<option value="8">CANCELADO POR DISTRIBUIDOR</option>
										<option value="10">CANCELADO POR PUNTO DE VENTA</option>
										<option value="9">RECHAZADO POR DISTRIBUIDOR</option>
										<option value="11">RECHAZADO POR PUNTO DE VENTA</option>
										<option value="4">CONCRETADO</option>
									</select>
						    	</div>
						  	</div>
						</div>
						<br>
						<table class="table">
							<tr>
								<td style="border-color: #F8F8F8;"><label class="lbl-nueva-orden">De:</label></td>
								<td style="border-color: #F8F8F8;"><input type="date" class="form-control" name="inputFecha1" id="inputFecha1" placeholder="Seleccionar fecha..."></td>
								<td style="border-color: #F8F8F8;"><label class="lbl-nueva-orden">A:</label></td>
								<td style="border-color: #F8F8F8;"><input type="date" class="form-control" name="inputFecha2" id="inputFecha2" placeholder="Seleccionar fecha..."></td>
							</tr>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
						<button type="button" class="btn btn-primary" onclick="busquedaAvanzada()"><i class="glyphicon glyphicon-search"></i> Buscar</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade bs-example-modal-lg" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<img class="img-header" src="../../img/detalles_orden.png"> <span id="titulo-detalles">Detalles de la Órden</span>
							<input type="hidden" name="idPedidoDetalles" id="idPedidoDetalles">
							<input type="hidden" name="idEnvioDetalles" id="idEnvioDetalles">
							<button class="btn btn-default" id="btnReportes" onclick="generacionReportes();" data-toggle="tooltip" title="Generación e impresión de reportes"><i class="glyphicon glyphicon-print"></i> </button>
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
					<form method="post" action="../mod/cambiar_estado_envio.php">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h3 class="titulo-header">
								<img class="img-header" src="../../img/cambiar_estado.png"> <span id="titulo-estado">Cambiar Estado del Envío</span>
							</h3>
						</div>
						<div class="modal-body">
							<p><label>Estado:</label></p>
							<p>
								<select class="form-control" name="inputEstado" id="selectEstado">
									<option value='8'>CANCELADO</option>
								</select>
							</p>
							<br>
							<p><label>Motivo de Cancelación:</label></p>
							<p>
								<input type="hidden" name="inputIdEnvio" id="inputIdEnvio">
								<textarea class="form-control" rows="4" name="inputMotivoCancelar" id="inputMotivoCancelar" placeholder="Motivo de cancelación..." required></textarea>
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
			$('.popover-punto-venta').popover();
			$('.popover-estado').popover();
			$('#btnReportes').tooltip();
			$('#btn-epcs').tooltip();

			function buscarEnvios(){
				var pvBuscar = $('#inputBuscar').val();

				if(pvBuscar != ''){
					$.ajax({
						type: 'POST',
						url: '../mod/buscar_envios.php',
						data: {'puntoventa':pvBuscar},

						beforeSend: function(){
							$('.contenido-general-2').html("<br><center><img id='img-cargando' src='../../img/cargando.gif'></center>");
						},

						success: function(data){
							$('.img-header').attr('src', '../../img/buscar.png');
							$('#lbl-titulo').text('Resultado de la búsqueda "' + pvBuscar + '"');
							$('#inputBuscar').select();
							$('#btnMostrarTodos').css('display', 'block');
							$('.contenido-general-2').html(data);
						}
					});
				}
			}

			function busquedaAvanzada(){
				var params = {'puntoventa':$('#inputPuntoVenta').val(), 'estado':$('#inputEstado').val(), 'fecha1':$('#inputFecha1').val(), 'fecha2':$('#inputFecha2').val()};

				$.ajax({
					type: 'POST',
					url: '../mod/busqueda_avanzada_envios.php',
					data: params,

					beforeSend: function(){
						$('#modalBusquedaAvanzada').modal('toggle');
						$('.contenido-general-2').html("<br><center><img id='img-cargando' src='../../img/cargando.gif'></center>");
					},

					success: function(data){
						$('.img-header').attr('src', '../../img/buscar.png');
						$('#lbl-titulo').text('Resultado de la Búsqueda Avanzada');
						$('#inputBuscar').select();
						$('#btnMostrarTodos').css('display', 'block');
						$('.contenido-general-2').html(data);
					}
				});
			}

			function generacionReportes(){
				var pedido = $('#idPedidoDetalles').val();
				var envio = $('#idEnvioDetalles').val();
				var params = {'orden':pedido, 'envio':envio, 'tipo':1};

				$.ajax({
					type: 'POST',
					url: '../../genReps/generarRecepcionPuntoVentaDistribuidor.php',
					data: params,

					beforeSend: function(){
						$('#contenedor-detalles-orden').html("<br><center><img id='img-cargando' src='../../img/cargando.gif'></center>");
					},

					success: function(data){
						var urlPDF = "../../docs/recepciondeordendecomprapv" + pedido + ".pdf";
						$('#contenedor-detalles-orden').html("");
						$('#modalDetalles').modal('toggle');
						setTimeout(window.open(urlPDF), 1000);
					}
				});
			}

			function mostrarDetallesEPCs(pedido, envio){
				$('#idPedidoDetalles').val(pedido);
				$('#idEnvioDetalles').val(envio);

				$.ajax({
					type: 'POST',
					url: '../mod/buscar_epcs_pedido.php',
					data: {'envio':envio},

					success: function(data){
						$('#contenedor-detalles-orden').html(data);
						$('#titulo-detalles').text('Detalles del Envío ' + envio + ' - Enviados y Recibidos');
						$('#modalDetalles').modal('show');
					}
				});
			}

			function cancelarOrden(envio){
				$('#inputIdEnvio').val(envio);
				$('#titulo-estado').text('Cambiar Estado del Envío ' + envio);
				$('#modalEstado').modal('show');
			}
		</script>
	</body>
</html>
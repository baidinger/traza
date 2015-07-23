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
		<meta charset="UTF-8">

		<link rel="stylesheet" type="text/css" href="../../lib/bootstrap-3.3.5/css/bootstrap.min.css">
		<link rel='stylesheet' type='text/css' href='../../lib/pagination/css.css'/>
		<link rel="stylesheet" type="text/css" href="../../css/estilos.css">
	</head>

	<body>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		  	<div class="navbar-header">
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
		      		<span class="sr-only">Toggle navigation</span>
		    	</button>
		    	<a class="navbar-brand">PUNTO DE VENTA</a>
		  	</div>
		  	<div class="collapse navbar-collapse" id="navbar-collapse-01">
		  		<ul class="nav navbar-nav">
					<li class="dropdown active">
  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;Órdenes <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
    						<li><a href="../nuevaOrden/">Nueva órden</a></li>
				            <li class="divider"></li>
				            <li><a href="../">Historial de órdenes</a></li>
							<li class="active"><a href="#">Entrada de órdenes</a></li>
  						</ul>
					</li>
					<?php 
						if($_SESSION['nivel_socio'] == 1){ ?>
							<li class="dropdown">
		  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> &nbsp;Usuarios <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
		    						<li><a href="../nuevoUsuario/">Nuevo usuario</a></li>
		    						<li class="divider"></li>
						            <li><a href="../usuarios/">Administrar usuarios</a></li>
		  						</ul>
							</li>
						<?php }
					?>
		    	</ul>

		    	<ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fui-user"></span> &nbsp;<?php echo $_SESSION['nombre_usuario']; ?> <span class="caret"></span></a>
		          		<ul class="dropdown-menu" role="menu">
		            		<li><a href="../contrasena/"><span class="fui-new"></span> &nbsp;Cambiar contraseña</a></li>
		            		<li><a href="../datosGenerales/"><span class="fui-gear"></span> &nbsp;Datos generales</a></li>
		            		<li class="divider"></li>
		            		<li><a href="../../mod/logout.php"><span class="fui-power"></span> &nbsp;Cerrar sesión</a></li>
		          		</ul>
			        </li>
			    </ul>
		  	</div>
		</nav>
		<div class="contenido-general">
			<div class="modal-header">
				<h3 class="titulo-header">
					<h3 class="titulo-contenido">Entrada de Órdenes</h3>
				</h3>
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

								$consulta = "SELECT id_usuario_pv FROM usuario_punto_venta WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
								$resultado = mysql_query($consulta);
								$row = mysql_fetch_array($resultado);
								$idUsuarioPvFK = $row['id_usuario_pv'];

								$cont = 0;
							    $consulta = "SELECT ords.id_orden, epqs.nombre_distribuidor, ords.fecha_entrega_orden, ords.costo_orden, ords.estado_orden FROM ordenes_punto_venta AS ords, empresa_distribuidores AS epqs WHERE ords.id_distribuidor_fk = epqs.id_distribuidor AND ords.id_usuario_punto_venta_fk = $idUsuarioPvFK";
								$resultado = mysql_query($consulta);
								while($row = mysql_fetch_array($resultado)){ 

									$consulta2 = "SELECT epc_caja FROM punto_venta_cajas_envio WHERE recibido_dce = 1 AND id_orden_fk = ".$row['id_orden']." LIMIT 1";
									$resultado2 = mysql_query($consulta2);
									while($row2 = mysql_fetch_array($resultado2)){ 

										$consulta3 = "SELECT COUNT(epc_caja) AS total_enviados FROM punto_venta_cajas_envio WHERE enviado_dce = 1 AND id_orden_fk = ".$row['id_orden'];
										$resultado3 = mysql_query($consulta3);
										$row3 = mysql_fetch_array($resultado3);
										$totalEnviados = $row3['total_enviados'];

										$consulta3 = "SELECT COUNT(epc_caja) AS total_recibidos FROM punto_venta_cajas_envio WHERE recibido_dce = 1 AND id_orden_fk = ".$row['id_orden'];
										$resultado3 = mysql_query($consulta3);
										$row3 = mysql_fetch_array($resultado3);
										$totalRecibidos = $row3['total_recibidos']; ?>

										<tr>
											<td class="centro"><?php echo $row['id_orden']; ?></td>
							          		<td><?php echo $row['nombre_distribuidor']; ?></td>
							          		<td class="centro"><?php echo $row['fecha_entrega_orden']; ?></td>
							          		<td class="derecha"><?php echo "$ ".number_format($row['costo_orden'], 2, '.', ','); ?></td>
							          		<td class="centro"><?php echo $totalEnviados." / ".$totalRecibidos; ?></td>

							          		<?php
						          				$estado = $row['estado_orden'];

						          				switch($estado) {
						          					case '1': echo "<td class='centro pendiente'>PENDIENTE</td>"; 	$verAcciones = 0; break;
						          					case '2': echo "<td class='centro rechazado'>RECHAZADO</td>"; 	$verAcciones = 0; break;
						          					case '3': echo "<td class='centro enviado'>ENVIADO</td>"; 		$verAcciones = 1; break;
						          					case '4': echo "<td class='centro concretado'>CONCRETADO</td>"; $verAcciones = 0; break;
						          					case '5': echo "<td class='centro cancelado'>CANCELADO</td>";	$verAcciones = 0; break;
						          					case '6': echo "<td class='centro aprobado'>APROBADO</td>"; 	$verAcciones = 0; break;
						          				}
						          			?>
							          		
							          		<td class="derecha">
							          			<button class="btn btn-info" id="btn-detalles" onClick="mostrarDetalles(<?php echo $row['id_orden']; ?>)" data-toggle="tooltip" title="Ver detalles epcs"><i class="glyphicon glyphicon-tags"></i></button>
							          			<?php
							          				if($verAcciones == 1){ ?>
							          					<button class="btn btn-danger" id="btn-cancelar" onClick="cambiarEstadoOrden('rechazar', 5, <?php echo $row['id_orden']; ?>)" data-toggle="tooltip" title="Rechazar órden"><i class="glyphicon glyphicon-remove"></i></button>
								        				<button class="btn btn-success" id="btn-concretar" onClick="cambiarEstadoOrden('concretar', 4, <?php echo $row['id_orden']; ?>)" data-toggle="tooltip" title="Concretar órden"><i class="glyphicon glyphicon-ok"></i></button>
							          				<?php }
							          			?>
								        	</td>
							    	    </tr>
								<?php 
										$cont++; 
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

		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../../lib/pagination/jquery-simple-pagination-plugin.js"></script>

		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
			$('#btn-detalles').tooltip();
			$('#btn-concretar').tooltip();
			$('#btn-cancelar').tooltip();

			function mostrarDetalles(orden){
				$.ajax({
					type: 'POST',
					url: '../mod/buscar_epcs_orden.php',
					data: {'orden':orden},

					success: function(data){
						$('#contenedor-detalles-orden').html(data);
						$('#titulo-detalles').text('Detalles de la Órden ' + orden + ' - Enviados y Recibidos');
						$('#modalDetalles').modal('show');
					}
				});
			}

			function cambiarEstadoOrden(texto, edo, orden){
				var respuesta = confirm("¿Desea " + texto + " la orden " + orden + "?");
			    if(respuesta){
					$.post('../mod/rechazar_concretar_orden.php', {'edo': edo, 'orden': orden},
						function(data){
							$(location).attr('href', '../entradasOrdenes/');
						}
					);
			    }
			}
		</script>
	</body>
</html>
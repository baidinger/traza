<?php
	@session_start();

	if(!isset($_SESSION['tipo_socio'])){
		header('Location: ../');
	}
	else{
		switch($_SESSION['tipo_socio']) {
			case 1: header('Location: ../productor/');
					break;
			case 2: header('Location: ../empaque/');
					break;
			case 3: header('Location: ../distribuidor/');
					break;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Trazabilidad</title>
		<meta charset="UTF-8">

		<link rel="stylesheet" type="text/css" href="../lib/bootstrap-3.3.5/css/bootstrap.min.css">
		<link rel='stylesheet' type='text/css' href='../lib/pagination/css.css'/>
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
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
    						<li><a href="nuevaOrden/">Nueva órden</a></li>
    						<li class="divider"></li>
				            <li class="active"><a href="#">Historial de órdenes</a></li>
							<li><a href="entradasOrdenes/">Entrada de órdenes</a></li>
  						</ul>
					</li>
					<?php
						if($_SESSION['nivel_socio'] == 1){ ?>
							<li class="dropdown">
		  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> &nbsp;Usuarios <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
		    						<li><a href="nuevoUsuario/">Nuevo usuario</a></li>
		    						<li class="divider"></li>
						            <li><a href="usuarios/">Administrar usuarios</a></li>
		  						</ul>
							</li>
						<?php }
					?>
		    	</ul>

		    	<ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fui-user"></span> &nbsp;<?php echo $_SESSION['nombre_usuario']; ?> <span class="caret"></span></a>
		          		<ul class="dropdown-menu" role="menu">
		            		<li><a href="contrasena/"><span class="fui-new"></span> &nbsp;Cambiar contraseña</a></li>
		            		<li><a href="datosGenerales/"><span class="fui-gear"></span> &nbsp;Datos generales</a></li>
		            		<li class="divider"></li>
		            		<li><a href="../mod/logout.php"><span class="fui-power"></span> &nbsp;Cerrar sesión</a></li>
		          		</ul>
			        </li>
			    </ul>
		  	</div>
		</nav>
		<div class="contenido-general">
			<div class="modal-header">
				<h3 class="titulo-header">
					<h3 class="titulo-contenido">Historial de Órdenes</h3>
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
								<th class="centro">Estado</th>
								<th></th>
							</tr>
						</thead>

						<tbody>
							<?php
								include('../mod/conexion.php');

								$consulta = "SELECT id_usuario_pv FROM usuario_punto_venta WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
								$resultado = mysql_query($consulta);
								$row = mysql_fetch_array($resultado);
								$idUsuarioPvFK = $row['id_usuario_pv'];

								$cont = 0;
							    $consulta = "SELECT ords.id_orden, epqs.nombre_distribuidor, ords.fecha_entrega_orden, ords.costo_orden, ords.estado_orden FROM ordenes_punto_venta AS ords, empresa_distribuidores AS epqs WHERE ords.id_distribuidor_fk = epqs.id_distribuidor AND ords.id_usuario_punto_venta_fk = $idUsuarioPvFK ORDER BY ords.id_orden DESC";
								$resultado = mysql_query($consulta);
								while($row = mysql_fetch_array($resultado)){ ?>
									<tr>
						          		<td class="centro"><?php echo $row['id_orden']; ?></td>
						          		<td><?php echo $row['nombre_distribuidor']; ?></td>
						          		<td class="centro"><?php echo $row['fecha_entrega_orden']; ?></td>
						          		<td class="derecha"><?php echo "$ ".number_format($row['costo_orden'], 2, '.', ',')	; ?></td>
					          			<?php
					          				$estado = $row['estado_orden'];

					          				switch($estado) {
					          					case '1': echo "<td class='centro pendiente'><span class='link-estado' onclick='mostrarModalEstado(".$row['id_orden'].")'>PENDIENTE</span></td>"; break;
					          					case '2': echo "<td class='centro rechazado'>RECHAZADO</td>"; break;
					          					case '3': echo "<td class='centro enviado'>ENVIADO</td>"; break;
					          					case '4': echo "<td class='centro concretado'>CONCRETADO</td>"; break;
					          					case '5': echo "<td class='centro cancelado'>CANCELADO</td>"; break;
					          					case '6': echo "<td class='centro aprobado'>APROBADO</td>"; break;
					          				}
					          			?>
						          		<td class="derecha">
							        		<button class="btn btn-primary" onClick="mostrarDetalles(<?php echo $row['id_orden']; ?>)">Detalles</button>
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
							<strong>Sin resultados...</strong> No hay órdenes registrados.
						</div>
					<?php } ?>

					<?php 
						mysql_close();
					?>
				</div>
			</div>
		</div>

		<div class="modal fade bs-example-modal-lg" id="modalEstado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<img class="img-header" src="../img/cambiar_estado.png"> <span id="titulo-estado">Cambiar Estado de la Órden</span>
						</h3>
					</div>
					<div class="modal-body">
						<label>Estado:</label>
						<input type="hidden" name="inputIdOrden" id="inputIdOrden">
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
		</div>

		<div class="modal fade bs-example-modal-lg" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<img class="img-header" src="../img/detalles_orden.png"> <span id="titulo-detalles">Detalles de la Órden</span>
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

		<script type="text/javascript" src="../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../lib/pagination/jquery-simple-pagination-plugin.js"></script>

		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();

			function mostrarModalEstado(orden){
				$('#inputIdOrden').val(orden);
				$('#titulo-estado').text('Cambiar Estado de la Órden ' + orden);
				$('#modalEstado').modal('show');
			}

			function cambiarEstado(){
				var orden = $('#inputIdOrden').val();

				var respuesta = confirm("¿Desea cancelar la órden " + orden + "?");
			    if(respuesta){
					$.ajax({
						type: 'POST',
						url: 'mod/cambiar_estado_orden.php',
						data: {'orden':orden},

						success: function(data){
							$(location).attr('href', '../puntoVenta/');
						}
					});
				}
			}

			function mostrarDetalles(orden){
				$.ajax({
					type: 'POST',
					url: 'mod/buscar_detalles_orden.php',
					data: {'orden':orden},

					success: function(data){
						$('#contenedor-detalles-orden').html(data);
						$('#titulo-detalles').text('Detalles de la Órden ' + orden);
						$('#modalDetalles').modal('show');
					}
				});
			}
		</script>
	</body>
</html>
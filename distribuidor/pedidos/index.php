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
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		  	<div class="navbar-header">
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
		      		<span class="sr-only">Toggle navigation</span>
		    	</button>
		    	<a class="navbar-brand">DISTRIBUIDOR</a>
		  	</div>
		  	<div class="collapse navbar-collapse" id="navbar-collapse-01">
		  		<ul class="nav navbar-nav">
					<li class="dropdown">
  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;Órdenes <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
    						<li><a href="../nuevaOrden/">Nueva órden</a></li>
				            <li class="divider"></li>
				            <li><a href="../">Historial de órdenes</a></li>
							<li><a href="../entradasOrdenes/">Entrada de órdenes</a></li>
  						</ul>
					</li>
					<li class="dropdown active">
  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;Pedidos <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
    						<li><a href="../nuevoEnvio/">Registrar envío</a></li>
    						<li class="divider"></li>
				            <li class="active"><a href="#">Historial de pedidos</a></li>
							<li><a href="../enviosPedidos/">Envío de pedidos</a></li>
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
					<h3 class="titulo-contenido">Historial de Pedidos</h3>
				</h3>
			</div>
			<div class="contenido-general-2">
				<br>
				<div id="paginacion-resultados">
					<table class="table">
						<thead>
							<tr>
								<th class="centro">ID</th>
								<th>Punto de Venta</th>
								<th class="centro">Fecha Entrega</th>
								<th class="derecha">Total</th>
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
							    $consulta = "SELECT ordspv.id_orden, mpsapv.nombre_punto_venta, ordspv.fecha_entrega_orden, ordspv.costo_orden, ordspv.estado_orden FROM ordenes_punto_venta AS ordspv, usuario_punto_venta AS ususpv, empresa_punto_venta AS mpsapv WHERE ordspv.id_usuario_punto_venta_fk = ususpv.id_usuario_pv AND ususpv.id_usuario_punto_venta = mpsapv.id_punto_venta AND ordspv.id_distribuidor_fk = $id_distribuidor_fk ORDER BY ordspv.id_orden DESC";
								$resultado = mysql_query($consulta);
								while($row = mysql_fetch_array($resultado)){ ?>
									<tr>
						          		<td class="centro"><?php echo $row['id_orden']; ?></td>
						          		<td><?php echo $row['nombre_punto_venta']; ?></td>
						          		<td class="centro"><?php echo $row['fecha_entrega_orden']; ?></td>
						          		<?php 
						          			$estado = $row['estado_orden'];

						          			if($estado == 1)
						          				echo "<td class='derecha'>$ ".number_format($row['costo_orden'], 2, '.', ',')."&nbsp;&nbsp;<a href='#' onclick='mostrarModalPrecio(".$row['id_orden'].")'>Cambiar</a></td>";
						          			else
						          				echo "<td class='derecha'>$ ".number_format($row['costo_orden'], 2, '.', ',')."</td>";
						          		?>
						          		<?php
					          				switch($estado) {
					          					case '1': echo "<td class='centro pendiente'><span class='link-estado' onclick='mostrarModalEstado(".$row['id_orden'].", 1, 1)'>PENDIENTE</span></td>"; break;
					          					case '2': echo "<td class='centro rechazado'>RECHAZADO</td>"; break;
					          					case '3': echo "<td class='centro enviado'><span class='link-estado' onclick='mostrarModalEstado(".$row['id_orden'].", 2, 3)'>ENVIADO</span></td>"; break;
					          					case '4': echo "<td class='centro concretado'>CONCRETADO</td>"; break;
					          					case '5': echo "<td class='centro cancelado'>CANCELADO</td>"; break;
					          					case '6': echo "<td class='centro aprobado'><span class='link-estado' onclick='mostrarModalEstado(".$row['id_orden'].", 2, 6)'>APROBADO</span></td>"; break;
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
							<strong>Sin resultados...</strong> No hay entradas registradas.
						</div>
					<?php } ?>

					<?php 
						mysql_close();
					?>
				</div>
			</div>
		</div>

		<div class="modal fade bs-example-modal-lg" id="modalPrecio" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<img class="img-header" src="../../img/cambiar_estado.png"> <span id="titulo-precio">Cambiar Precio del Pedido</span>
						</h3>
					</div>
					<div class="modal-body">
						<label>Precio:</label>
						<input type="hidden" name="inputIdPedidoPrecio" id="inputIdPedidoPrecio">
						<input type="number" min="0" step="any" class="form-control" name="inputPrecio" id="inputPrecio" value="0.0">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
						<button type="button" class="btn btn-primary" onclick="cambiarPrecio()"><i class="glyphicon glyphicon-floppy-disk"></i> Cambiar Precio</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade bs-example-modal-lg" id="modalEstado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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
						<input type="hidden" name="inputIdPedido" id="inputIdPedido">
						<input type="hidden" name="inputEstadoOriginal" id="inputEstadoOriginal">
						<select class="form-control" name="inputEstado" id="selectEstado">
							
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
							<img class="img-header" src="../../img/detalles_orden.png"> <span id="titulo-detalles">Detalles del Pedido</span>
						</h3>
					</div>
					<div class="modal-body">
						<div class="contenedor-detalles-pedido" id="contenedor-detalles-pedido">

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

			function mostrarModalPrecio(pedido){
				$('#inputIdPedidoPrecio').val(pedido);
				$('#titulo-precio').text('Cambiar Precio del Pedido ' + pedido);
				$('#modalPrecio').modal('show');
			}

			function cambiarPrecio(){
				var pedido = $('#inputIdPedidoPrecio').val();
				var precio = $('#inputPrecio').val();

				var respuesta = confirm("¿Desea cambiar el precio del pedido " + pedido + "?");
			    if(respuesta){
					$.ajax({
						type: 'POST',
						url: '../mod/cambiar_precio_pedido.php',
						data: {'pedido':pedido, 'precio':precio},

						success: function(data){
							$(location).attr('href', '../pedidos/');
						}
					});
				}
			}

			function mostrarModalEstado(pedido, estados, original){
				if(estados == 1){
					$('#selectEstado').html('');
					$('#selectEstado').append("<option value='6'>APROBADO</option>");
					$('#selectEstado').append("<option value='2'>RECHAZADO</option>");
				}
				else{
					$('#selectEstado').html('');
					$('#selectEstado').append("<option value='5'>CANCELADO</option>");
				}

				$('#inputIdPedido').val(pedido);
				$('#inputEstadoOriginal').val(original);
				$('#titulo-estado').text('Cambiar Estado del Pedido ' + pedido);
				$('#modalEstado').modal('show');
			}

			function cambiarEstado(){
				var pedido = $('#inputIdPedido').val();
				var estado = $('#selectEstado').val();
				var original = $('#inputEstadoOriginal').val();

				var respuesta = confirm("¿Desea cambiar el estado del pedido " + pedido + "?");
			    if(respuesta){
					$.ajax({
						type: 'POST',
						url: '../mod/cambiar_estado_pedido.php',
						data: {'pedido':pedido, 'estado':estado, 'original':original},

						success: function(data){
							$(location).attr('href', '../pedidos/');
						}
					});
				}
			}

			function mostrarDetalles(pedido){
				$.ajax({
					type: 'POST',
					url: '../mod/buscar_detalles_orden_pv.php',
					data: {'orden':pedido},

					success: function(data){
						$('#contenedor-detalles-pedido').html(data);
						$('#titulo-detalles').text('Detalles del Pedido ' + pedido);
						$('#modalDetalles').modal('show');
					}
				});
			}
		</script>
	</body>
</html>
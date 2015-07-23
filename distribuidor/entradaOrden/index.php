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
					<li class="dropdown active">
  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-th-large"></span> &nbsp;Órdenes <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<?php 
								if($_SESSION['nivel_socio'] == 1){ ?>
									<li><a href="../nuevaOrden/">Nueva órden</a></li>
								<?php }
							?>
    						<!-- <li><a href="../nuevaOrden/">Nueva órden</a></li> -->
				            <li><a href="../">Historial</a></li>
				            <li class="divider"></li>
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
		      		<!-- <li class="dropdown">
  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> &nbsp;Usuarios <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
    						<li><a href="../nuevoUsuario/">Nuevo usuario</a></li>
    						<li class="divider"></li>
				            <li><a href="../usuarios/">Administrar usuarios</a></li>
  						</ul>
					</li> -->
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
					<h3 class="titulo-contenido">Historial de Órdenes Concretadas</h3>
				</h3>
			</div>
			<div class="contenido-general-2">
				<br>
				<div id="paginacion-resultados">
					<table class="table">
						<thead>
							<tr>
								<th class="centro">ID</th>
								<th>Empaque</th>
								<th class="centro">Fecha</th>
								<th class="derecha">Costo</th>
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
							    $consulta = "SELECT ords.id_orden, epqs.nombre_empaque, ords.fecha_entrega_orden, ords.costo_orden, ords.estatus_orden FROM ordenes_distribuidor AS ords, empresa_empaques AS epqs WHERE ords.id_empaque_fk = epqs.id_empaque AND ords.id_usuario_distribuidor_fk = $id_distribuidor_fk AND ords.estatus_orden = 4";
								$resultado = mysql_query($consulta);
								while($row = mysql_fetch_array($resultado)){ ?>
									<tr>
						          		<td class="centro"><?php echo $row['id_orden']; ?></td>
						          		<td><?php echo $row['nombre_empaque']; ?></td>
						          		<td class="centro"><?php echo $row['fecha_entrega_orden']; ?></td>
						          		<td class="derecha"><?php echo "$ ".number_format($row['costo_orden'], 2, '.', ',')	; ?></td>
						          		<td class="centro">
						          			<?php
						          				$estado = $row['estatus_orden'];

						          				switch($estado) {
						          					case '1': echo "PENDIENTE"; break;
						          					case '2': echo "RECHAZADO"; break;
						          					case '3': echo "ENVIADO"; break;
						          					case '4': echo "CONCRETADO"; break;
						          					case '5': echo "CANCELADO"; break;
						          				}
						          			?>
						          		</td>
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

			function mostrarDetalles(orden){
				$.ajax({
					type: 'POST',
					url: '../mod/buscar_detalles_orden.php',
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
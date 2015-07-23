<?php
	@session_start();

	if(!isset($_SESSION['tipo_socio'])){
		header('Location: ../');
	}
	else{
		switch($_SESSION['tipo_socio']) {
			case 2: header('Location: ../empaque/');
					break;
			case 3: header('Location: ../distribuidor/');
					break;
			case 4: header('Location: ../puntoVenta/');
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
		    	<a class="navbar-brand">PRODUCTOR</a>
		  	</div>
		  	<div class="collapse navbar-collapse" id="navbar-collapse-01">
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
					<h3 class="titulo-contenido">Historial de Lotes Vendidos</h3>
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
								<th>Producto</th>
								<th class="centro">Cajas</th>
								<th class="centro">KG</th>
								<th class="centro">Fecha</th>
								<th class="derecha">Costo</th>
								<!-- <th></th> -->
							</tr>
						</thead>

						<tbody>
							<?php
								include('../mod/conexion.php');

								$cont = 0;
							    $consulta = "SELECT lts.id_lote, empqs.nombre_empaque, prods.nombre_producto, prods.variedad_producto, lts.cant_cajas_lote, lts.cant_kilos_lote, lts.fecha_recibo_lote, lts.costo_lote FROM productos AS prods, lotes AS lts, empresa_empaques AS empqs, empresa_productores WHERE lts.id_producto_fk = prods.id_producto AND empresa_productores.id_usuario_fk = ".$_SESSION['id_usuario']." AND lts.id_productor_fk = empresa_productores.id_productor AND lts.id_empaque_fk = empqs.id_empaque ORDER BY lts.id_lote DESC";
								$resultado = mysql_query($consulta);
								while($row = mysql_fetch_array($resultado)){ ?>
									<tr>
						          		<td class="centro"><?php echo $row['id_lote']; ?></td>
						          		<td><?php echo $row['nombre_empaque']; ?></td>
						          		<td><?php echo $row['nombre_producto'] . " - " . $row['variedad_producto']; ?></td>
						          		<td class="centro"><?php echo $row['cant_cajas_lote']; ?></td>
						          		<td class="centro"><?php echo $row['cant_kilos_lote']; ?></td>
						          		<td class="centro"><?php echo $row['fecha_recibo_lote']; ?></td>
						          		<td class="derecha"><?php echo "$ ".number_format($row['costo_lote'], 2, '.', ',')	; ?></td>
						          		<!-- <td class="derecha">
							        		<button class="btn btn-primary" onclick="mostrarDetalles(<?php echo $row['id_lote']; ?>)">Detalles</button>
							        	</td> -->
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
							<strong>Sin resultados...</strong> No hay lotes registrados.
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../lib/pagination/jquery-simple-pagination-plugin.js"></script>
	</body>
</html>
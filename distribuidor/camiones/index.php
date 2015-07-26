<?php
	@session_start();

	if(!isset($_SESSION['tipo_socio']) || $_SESSION['nivel_socio'] != 1){
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
		?>
		<div class="contenido-general">
			<div class="modal-header">
				<h3 class="titulo-header">
					<h3 class="titulo-contenido">
						<img class="img-header" src="../../img/nuevo_envio.png"> <span id="lbl-titulo">Lista de Camiones</span>
					</h3>
				</h3>
			</div>
			<br>
			<div class="div-buscar">
				<div class="form-inline">
					<input type="text" class="form-control" style="width: 40%;" name="inputBuscar" id="inputBuscar" placeholder="Buscar por nombre del chofer, placas, marca, modelo..." onkeyup="if(event.keyCode == 13) buscarProductos();" autofocus>
					<button class="btn btn-primary" id="btnBuscar" onclick="buscarProductos();"><i class="glyphicon glyphicon-search"></i> Buscar</button>
					<a href="../nuevoCamion/" class="btn btn-success" style="float: right;" id="btnAgregarCamion"><i class="glyphicon glyphicon-plus"></i> Agregar Camion</a>
					<a href="../camiones/" class="btn btn-info" id="btn-mostrar-todos" style="float: right; margin-right: 10px; display: none;" id="btnBuscar"><i class="glyphicon glyphicon-th-list"></i> Mostrar Todos</a>
				</div>
			</div>
			<div class="contenido-general-2">
				<br>
				<div id="msj-agregar">
				  	
				</div>
				<div id="paginacion-resultados">
					<table class="table">
						<thead>
							<tr>
								<th class="centro">#</th>
								<th>Nombre del Producto</th>
								<th>Variedad</th>
								<th class="derecha">$ de Venta</th>
								<th></th>
							</tr>
						</thead>

						<tbody>
							<?php
								include('../../mod/conexion.php');

								$consulta = "SELECT id_distribuidor_fk FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      				$idDistribuidorFK = $row['id_distribuidor_fk'];

								$cont = 1;
								$consulta = "SELECT pdist.id_productos_distribuidor, prods.nombre_producto, prods.variedad_producto, pdist.precio_venta FROM productos AS prods, productos_distribuidores AS pdist WHERE prods.id_producto = pdist.id_producto_fk AND pdist.id_distribuidor_fk = $idDistribuidorFK ORDER BY prods.nombre_producto ASC";
								$resultado = mysql_query($consulta);
								while($row = mysql_fetch_array($resultado)){ ?>
									<tr>
						          		<td class="centro"><?php echo $cont; ?></td>
						          		<td><?php echo $nombreProd = $row['nombre_producto']; ?></td>
						          		<td><?php echo $variedadProd = $row['variedad_producto']; ?></td>
						          		<td class="derecha"><?php echo "$ ".number_format($row['precio_venta'], 2, '.', ','); ?></td>
						          		<td class="derecha">
						          			<?php 
						          				$idProductoDist = $row['id_productos_distribuidor']; 
						          				$precioProd =  $row['precio_venta']; 
						          			?>
						          			<button class="btn btn-primary btn-editar" data-toggle="tooltip" data-placement="top" title="Editar precio" onClick="mostrarModalPrecio(<?php echo $idProductoDist; ?>, '<?php echo $nombreProd; ?>', '<?php echo $variedadProd; ?>', <?php echo $precioProd; ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
						          			<button class="btn btn-success btn-alta" data-toggle="tooltip" data-placement="top" title="Dar de alta" onClick="mostrarModalPrecio(<?php echo $idProductoDist; ?>, '<?php echo $nombreProd; ?>', '<?php echo $variedadProd; ?>', <?php echo $precioProd; ?>)"><i class="glyphicon glyphicon-ok"></i></button>
						          			<button class="btn btn-danger btn-baja" data-toggle="tooltip" data-placement="top" title="Dar de baja" onClick="borrarProducto(<?php echo $idProductoDist; ?>, '<?php echo $nombreProd; ?>', '<?php echo $variedadProd; ?>')"><i class="glyphicon glyphicon-remove"></i></button>
							        	</td>
							        	<!-- <td class="derecha">
						          			<?php 
						          				$idUsuarioFk = $row['id_usuario'];
						          				$estadoUsuario = $row['estado_usuario'];
						          			?>
						          			<button class="btn btn-primary btn-editar" data-toggle="tooltip" data-placement="top" title="Editar usuario" onClick="editarUsuario(<?php echo $row['id_usuario_distribuidor']; ?>, '<?php echo $idUsuarioFk; ?>', '<?php echo $nombreUsuario; ?>')"><i class="glyphicon glyphicon-pencil"></i></button>
							        		<?php 
							        			if($row['id_usuario'] != $_SESSION['id_usuario']){
							        				if($estadoUsuario == 0){ ?>
								        				<button class="btn btn-success btn-baja" data-toggle="tooltip" data-placement="top" title="Dar de alta" onClick="altaUsuario('<?php echo $idUsuarioFk; ?>', '<?php echo $nombreUsuario; ?>')"><i class="glyphicon glyphicon-ok"></i></button>
							          				<?php } else{ ?>
							          					<button class="btn btn-danger btn-alta" data-toggle="tooltip" data-placement="top" title="Dar de baja" onClick="bajaUsuario('<?php echo $idUsuarioFk; ?>', '<?php echo $nombreUsuario; ?>')"><i class="glyphicon glyphicon-remove"></i></button>
							          				<?php }
							        			}
							        		?>
							        	</td> -->
						    	    </tr>
								<?php $cont++; 
								}
							?>
						</tbody>
					</table>

					<?php if($cont > 1){ ?>
						<div class="my-navigation" style="margin: 0px auto;">
							<div class="simple-pagination-page-numbers"></div>
							<br><br><br>
						</div>
					<?php } else{ ?>
						<div class="alert alert-info" role="alert" style="text-align: center;">
							<strong>Sin resultados...</strong> No hay productos registrados.
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<?php 
			mysql_close();
		?>

		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../../lib/pagination/jquery-simple-pagination-plugin.js"></script>

		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
			$('.btn-editar').tooltip();
			$('.btn-alta').tooltip();
			$('.btn-baja').tooltip();

			function buscarProductos(){
				// var productoBuscar = $('#inputBuscar').val();

				// if(productoBuscar != ''){
				// 	$.ajax({
				// 		type: 'POST',
				// 		url: '../mod/buscar_productos.php',
				// 		data: {'producto':productoBuscar},

				// 		beforeSend: function(){
				// 			$('.contenido-general-2').html("<br><center><img id='img-cargando' src='../../img/cargando.gif'></center>");
				// 		},

				// 		success: function(data){
				// 			$('.img-header').attr('src', '../../img/buscar.png');
				// 			$('#lbl-titulo').text('Resultado de la búsqueda "' + productoBuscar + '"');
				// 			$('#inputBuscar').select();
				// 			$('#btn-mostrar-todos').css('display', 'block');
				// 			$('.contenido-general-2').html(data);
				// 		}
				// 	});
				// }
			}

			function borrarProducto(productoFk, nombre, variedad){
				// var respuesta = confirm("¿Desea borrar al producto " + nombre + " " + variedad + "?");
			 //    if(respuesta){
				// 	$.post('../mod/borrar_producto.php', {'producto': productoFk},
				// 		function(data){
				// 			$(location).attr('href', '../productos/');
				// 		}
				// 	);
			 //    }
			}
		</script>
	</body>
</html>
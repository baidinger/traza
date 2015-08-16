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
						<img class="img-header" src="../../img/productos.png"> <span id="lbl-titulo">Lista de Productos</span>
						<button class="btn btn-default" id="btnReportes" onclick="generacionReportes();" data-toggle="tooltip" title="Generación e impresión de reportes"><i class="glyphicon glyphicon-print"></i> </button>
					</h3>
				</h3>
			</div>
			<br>
			<div class="div-buscar">
				<div class="form-inline">
					<input type="text" class="form-control" name="inputBuscar" id="inputBuscar" placeholder="Buscar por nombre del producto o variedad..." onkeyup="if(event.keyCode == 13) buscarProductos();" autofocus>
					<button class="btn btn-primary" id="btnBuscar" onclick="buscarProductos();"><i class="glyphicon glyphicon-search"></i> Buscar</button>
					<button class="btn btn-success" id="btnAgregarProducto" data-toggle="modal" data-target="#modalAgregarProducto"><i class="glyphicon glyphicon-plus"></i> Agregar Producto</button>
					<a href="../productos/" class="btn btn-info" id="btnMostrarTodos"><i class="glyphicon glyphicon-th-list"></i> Mostrar Todos</a>
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
						          			<button class="btn btn-danger btn-borrar" data-toggle="tooltip" data-placement="top" title="Eliminar producto" onClick="borrarProducto(<?php echo $idProductoDist; ?>, '<?php echo $nombreProd; ?>', '<?php echo $variedadProd; ?>')"><i class="glyphicon glyphicon-remove"></i></button>
							        	</td>
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

		<div class="modal fade bs-example-modal-lg" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<img class="img-header" src="../../img/productos.png"> &nbsp; Agregar Productos
						</h3>
					</div>
					<div class="modal-body">
						<p>
							<input type="text" class="form-control" name="inpuBuscarAgregarProducto" id="inpuBuscarAgregarProducto" onkeyup="if(event.keyCode == 13) buscarAgregarProductos();" placeholder="Buscar producto..." style="text-align: center;">
						</p>
						<br>
						<div id="resultado-busqueda-agregar">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre del Producto</th>
										<th>Variedad</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$cont = 1;
										$consulta = "SELECT * FROM productos ORDER BY RAND() LIMIT 5";
										$resultado = mysql_query($consulta);
										while($row = mysql_fetch_array($resultado)){ ?>
											<tr>
								          		<td class="centro"><?php echo $cont; ?></td>
								          		<td><?php echo $row['nombre_producto']; ?></td>
								          		<td><?php echo $row['variedad_producto']; ?></td>
								          		<td class="derecha">
								          			<button class="btn btn-success btn-agregar" onClick="agregarProducto(<?php echo $row['id_producto']; ?>)"><i class="glyphicon glyphicon-ok"></i> Agregar</button>
									        	</td>
								    	    </tr>
											<?php $cont++; 
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade bs-example-modal-lg" id="modalPrecio" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="post" action="../mod/cambiar_precio_producto.php">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h3 class="titulo-header">
								<img class="img-header" src="../../img/cambiar_estado.png"> <span id="titulo-precio">Cambiar Precio del Producto</span>
							</h3>
						</div>
						<div class="modal-body">
							<p><label>Nuevo Precio:</label></p>
							<p>
								<input type="hidden" name="inputIdProducto" id="inputIdProducto">
								<input type="number" step="any" min="0" class="form-control" name="inputPrecio" id="inputPrecio" style="text-align: center;" required>
							</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
							<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Cambiar Precio</button>
						</div>
					</form>
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
			$('#btnReportes').tooltip();
			$('.btn-editar').tooltip();
			$('.btn-borrar').tooltip();

			$('#modalAgregarProducto').on('shown.bs.modal', function () {
				$('#inpuBuscarAgregarProducto').focus()
			});

			$('#modalPrecio').on('shown.bs.modal', function () {
				$('#inputPrecio').focus()
			});

			function buscarProductos(){
				var productoBuscar = $('#inputBuscar').val();

				if(productoBuscar != ''){
					$.ajax({
						type: 'POST',
						url: '../mod/buscar_productos.php',
						data: {'producto':productoBuscar},

						beforeSend: function(){
							$('.contenido-general-2').html("<br><center><img id='img-cargando' src='../../img/cargando.gif'></center>");
						},

						success: function(data){
							$('.img-header').attr('src', '../../img/buscar.png');
							$('#lbl-titulo').text('Resultado de la búsqueda "' + productoBuscar + '"');
							$('#inputBuscar').select();
							$('#btnMostrarTodos').css('display', 'block');
							$('.contenido-general-2').html(data);
						}
					});
				}
			}

			function generacionReportes(){
				var dist = "<?php echo $idDistribuidorFK; ?>";
				var params = {'dist': dist};

				$.ajax({
					type: 'POST',
					url: '../../genReps/generarRelacionProductosDistribuidor.php',
					data: params,

					beforeSend: function(){
						$('#msj-agregar').html("<br><center><img id='img-cargando' src='../../img/cargando.gif'></center>");
					},

					success: function(data){
						var urlPDF = "../../docs/productosdistribuidor" + dist + ".pdf";
						$('#msj-agregar').html("");
						setTimeout(window.open(urlPDF), 1000);
					}
				});
			}

			function buscarAgregarProductos(){
				var productoBuscar = $('#inpuBuscarAgregarProducto').val();

				$.ajax({
					type: 'POST',
					url: '../mod/buscar_productos_agregar.php',
					data: {'producto':productoBuscar},

					success: function(data){
						$('#inpuBuscarAgregarProducto').select();
						$('#resultado-busqueda-agregar').html(data);
					}
				});
			}

			function agregarProducto(producto){
				$.ajax({
					type: 'POST',
					url: '../mod/registrar_producto.php',
					data: {'producto':producto},

					success: function(data){
						if(data == ''){
							$(location).attr('href', '../productos/');
						}
						else{
							$('#msj-agregar').html("<div class='alert alert-danger alert-dismissible' role='alert' style='text-align: center;'> " + 
				  										"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> " +
														"<strong>Error...</strong> El producto seleccionado ya existe en la lista de productos. " +
													"</div>");
							$('#modalAgregarProducto').modal('toggle');
						}
					}
				});
			}

			function mostrarModalPrecio(productoFk, nombre, variedad, precio){
				$('#inputIdProducto').val(productoFk);
				$('#inputPrecio').val(precio);
				$('#titulo-precio').text('Cambiar Precio de ' + nombre + ' ' + variedad);
				$('#modalPrecio').modal('show');
			}

			function borrarProducto(productoFk, nombre, variedad){
				var respuesta = confirm("¿Desea borrar al producto " + nombre + " " + variedad + "?");
			    if(respuesta){
					$.post('../mod/borrar_producto.php', {'producto': productoFk},
						function(data){
							$(location).attr('href', '../productos/');
						}
					);
			    }
			}
		</script>
	</body>
</html>
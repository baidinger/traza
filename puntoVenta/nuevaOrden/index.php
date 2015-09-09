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
						<img class="img-header" src="../../img/nueva_orden.png"> &nbsp;Nueva Orden a Distribuidor
					</h3>
				</h3>
			</div>
			<div class="contenido-general-2">
				<?php if(isset($_REQUEST['e'])){ ?>
			  		<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> Error al registrar orden.
					</div>
			  	<?php } ?>
			  	<br>
			  	<?php
			  		date_default_timezone_set("America/Mexico_City");
					$fechaActual = date("Y-m-d");
	 			?>
				<form method="post" action="../mod/registrar_orden.php">
					<div class="form-inline">
						<table class="table">
							<tr>
								<td><label class="lbl-nueva-orden">Distribuidor: </label></td>
								<td>
									<input type="hidden" name="inputIdDistribuidor" id="inputIdDistribuidor">
									<input type="text" class="form-control" name="inputNombreDistribuidor" id="inputNombreDistribuidor" placeholder="Distribuidor..." readonly required>
								</td>
								<td>
									<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalDistribuidor"><i class="glyphicon glyphicon-search"></i> Buscar Distribuidor</a>
								</td>
								<td class="derecha"><label class="lbl-nueva-orden">Fecha de Entrega Deseada: </label></td>
								<td class="derecha">
									<input type="date" class="form-control" min="<?php echo $fechaActual; ?>" name="inputFechaEntrega" id="inputFechaEntrega" required>
								</td>
							</tr>
						</table>
					</div>
					<br>
					<div id="contenedor-productos-dist"> </div>
					<div id="tabla-detalles-orden" style="display: none;">
						<table class="table" id="tablaOrden">
							<thead>
								<tr>
									<th class="centro">Cant</th>
									<th class="centro">Unidad</th>
									<th>Producto</th>
									<th class="derecha">$ Unitario</th>
									<th class="derecha">Importe</th>
									<th class="derecha"></th>
								</tr>
							</thead>
							<tbody id="detalles-orden-empaque">

							</tbody>
						</table>
						<center>
							<textarea class="form-control" rows="5" name="inputDescripcion" id="inputDescripcion" placeholder="Agregar descripción..."></textarea><br>
							<button class="btn btn-primary"><i class="glyphicon glyphicon-chevron-right"></i> Continuar Orden</button><br><br>
						</center>
					</div>
				</form>
			</div>
		</div>

		<div class="modal fade bs-example-modal-lg" id="modalDistribuidor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<img class="img-header" src="../../img/buscar.png"> <span id="titulo-detalles">Buscar Distribuidor</span>
						</h3>
					</div>
					<div class="modal-body">
						<div class="form-inline">
							<center>
								<input type="text" class="form-control" name="inputBuscarDistribuidor" id="inputBuscarDistribuidor"  onkeyup="if(event.keyCode == 13) buscarDistribuidores();" style="width: 80%;">
								<button type="button" class="btn btn-primary" onclick="buscarDistribuidores()"><i class="glyphicon glyphicon-search"></i> Buscar</button>
							</center>
						</div>
						<div class="contenedor-distribuidores" id="contenedor-distribuidores">
							<table class="table">
								<thead>
									<th class="centro">#</th>
									<th>Nombre del Distribuidor</th>
									<th class="derecha"></th>
								</thead>
								<tbody>
									<?php 
										include('../../mod/conexion.php');

										$cont = 1;
									    $consulta = "SELECT * FROM empresa_distribuidores WHERE estado_d = 1 ORDER BY RAND() LIMIT 10";
										$resultado = mysql_query($consulta);
										while($row = mysql_fetch_array($resultado)){ ?>
											<tr>
												<td class="centro"><?php echo $cont; ?></td>
								          		<td><?php echo $row['nombre_distribuidor']; ?></td>
									        	<td class="derecha">
									        		<button class="btn btn-success" onClick="seleccionarDistribuidor(<?php echo $row['id_distribuidor']; ?>, '<?php echo $row['nombre_distribuidor']; ?>');"><i class="glyphicon glyphicon-ok"></i> Seleccionar</button>
									        	</td>
									        	<?php $cont++; ?>
								    	    </tr>
										<?php }
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</div>
		</div>

		<?php mysql_close(); ?>

		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>

		<script type="text/javascript">
			$('#modalDistribuidor').on('shown.bs.modal', function () {
				$('#inputBuscarDistribuidor').focus()
			});

			function buscarDistribuidores(){
				var distribuidorBuscar = $('#inputBuscarDistribuidor').val();

				// if(distribuidorBuscar != ''){
					var params = {'distribuidor':distribuidorBuscar};

					$.ajax({
						type: 'POST',
						url: '../mod/buscar_distribuidores.php',
						data: params,

						success: function(data){
							$('#contenedor-distribuidores').html(data);
							$('#inputBuscarDistribuidor').select();
						}
					});
				// }
			}

			function seleccionarDistribuidor(idDistribuidor, nombreDistribuidor){
				$('#inputIdDistribuidor').val(idDistribuidor);
				$('#inputNombreDistribuidor').val(nombreDistribuidor);
				$('#modalDistribuidor').modal('toggle');

				$.ajax({
					type: 'POST',
					url: '../mod/buscar_productos_dist.php',
					data: {'idDistribuidor':idDistribuidor},

					success: function(data){
						$('#contenedor-productos-dist').html(data);

						$("#tablaOrden tr:gt(0)").remove();
						$('#tabla-detalles-orden').css('display', 'none');
					}
				});
			}

			function agregarProducto(){
				var cantProducto = parseInt($('#inputCantidad').val());
				var unidProducto = $('#selectUnidad').val();
				var idProducto = $('#selectProducto').val();

				if(!isNaN(cantProducto)){
	        		if(cantProducto %1 == 0){
	        			var params = {'idProducto':idProducto, 'cantProducto':cantProducto, 'unidProducto':unidProducto};

	        			$.ajax({
							type: 'POST',
							url: '../mod/agregar_producto_orden.php',
							data: params,

							success: function(data){
								$('#detalles-orden-empaque').append(data);
								$('#tabla-detalles-orden').css('display', 'block');
								$('#inputCantidad').val(1);
							}
						});
	        		}
	        		else{
	        			alert("Cantidad incorrecta.");
	        		}
	        	}
	        	else{
	    			alert("Cantidad incorrecta.");
			    }
			}			
		</script>
	</body>
</html>
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
						<img class="img-header" src="../../img/nueva_orden.png"> Nueva Órden a Empaque
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
								<td><label class="lbl-nueva-orden">Empaque: </label></td>
								<td>
									<input type="hidden" name="inputIdEmpaque" id="inputIdEmpaque">
									<input type="text" class="form-control" name="inputNombreEmpaque" id="inputNombreEmpaque" placeholder="Empaque..." readonly required>
								</td>
								<td>
									<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalEmpaque"><i class="glyphicon glyphicon-search"></i> Buscar Empaque</a>
								</td>
								<td class="derecha"><label class="lbl-nueva-orden">Fecha de Entrega Deseada: </label></td>
								<td class="derecha">
									<input type="date" class="form-control" min="<?php echo $fechaActual; ?>" name="inputFechaEntrega" id="inputFechaEntrega" required>
								</td>
							</tr>
						</table>
					</div>
					<br>
					<div id="contenedor-productos-empaque"> </div>
					<div id="tabla-detalles-orden">
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

		<div class="modal fade bs-example-modal-lg" id="modalEmpaque" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<img class="img-header" src="../../img/buscar.png"> <span id="titulo-detalles">Buscar Empaque</span>
						</h3>
					</div>
					<div class="modal-body">
						<div class="form-inline">
							<center>
								<input type="text" class="form-control" name="inputBuscarEmpaque" id="inputBuscarEmpaque"  onkeyup="if(event.keyCode == 13) buscarEmpaques();" style="width: 80%;">
								<button type="button" class="btn btn-primary" onclick="buscarEmpaques()"><i class="glyphicon glyphicon-search"></i> Buscar</button>
							</center>
						</div>
						<div class="contenedor-empaques" id="contenedor-empaques">
							<table class="table">
								<thead>
									<th class="centro">#</th>
									<th>Nombre del Empaque</th>
									<th class="derecha"></th>
								</thead>
								<tbody>
									<?php 
										include('../../mod/conexion.php');

										$cont = 1;
									    $consulta = "SELECT * FROM empresa_empaques WHERE estado = 1 ORDER BY RAND() LIMIT 10";
										$resultado = mysql_query($consulta);
										while($row = mysql_fetch_array($resultado)){ ?>
											<tr>
												<td class="centro"><?php echo $cont; ?></td>
								          		<td><?php echo $row['nombre_empaque']; ?></td>
									        	<td class="derecha">
									        		<button class="btn btn-success" onClick="seleccionarEmapque(<?php echo $row['id_empaque']; ?>, '<?php echo $row['nombre_empaque']; ?>');"><i class="glyphicon glyphicon-ok"></i> Seleccionar</button>
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
			$('#tabla-detalles-orden').hide();

			$('#modalEmpaque').on('shown.bs.modal', function () {
				$('#inputBuscarEmpaque').focus()
			});

			function buscarEmpaques(){
				var empaqueBuscar = $('#inputBuscarEmpaque').val();

				// if(empaqueBuscar != ''){
					var params = {'empaque':empaqueBuscar};

					$.ajax({
						type: 'POST',
						url: '../mod/buscar_empaques.php',
						data: params,

						success: function(data){
							$('#contenedor-empaques').html(data);
							$('#inputBuscarEmpaque').select();
						}
					});
				// }
			}

			function seleccionarEmapque(idEmpaque, nombreEmpaque){
				$('#inputIdEmpaque').val(idEmpaque);
				$('#inputNombreEmpaque').val(nombreEmpaque);
				$('#modalEmpaque').modal('toggle');

				$.ajax({
					type: 'POST',
					url: '../mod/buscar_productos_empaque.php',
					data: {'idEmpaque':idEmpaque},

					success: function(data){
						$('#contenedor-productos-empaque').html(data);

						$("#tablaOrden tr:gt(0)").remove();
						$('#tabla-detalles-orden').hide();
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
								$('#tabla-detalles-orden').show();
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
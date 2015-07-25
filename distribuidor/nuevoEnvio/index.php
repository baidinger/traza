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
						<img class="img-header" src="../../img/nuevo_envio.png"> Registrar Envío
					</h3>
				</h3>
			</div>
			<div class="contenido-general-2">
				<div class="div-contenedor-form">
					<form class="form-horizontal" role="form" method="post" action="../mod/registrar_envio.php">
			      		<div>
			      			<?php 
			      				include('../../mod/conexion.php');

			      				$consulta = "SELECT id_distribuidor_fk FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      				$idDistribuidorFK = $row['id_distribuidor_fk'];
			      			?>
					      	<div class="modal-body">
					      		<div class="form-group">
							    	<label class="col-sm-2 control-label">Pedido: </label>
							    	<div class="col-sm-10">
							    		<select class="form-control" name="inputIdPedido" id="inputIdPedido">
							    			<option value="0">Seleccionar ID del Pedido...</option>
							    			<?php 
							    				$consulta = "SELECT id_orden FROM ordenes_punto_venta WHERE id_distribuidor_fk = $idDistribuidorFK AND estado_orden = 6";
							      				$resultado = mysql_query($consulta);
							      				while($row = mysql_fetch_array($resultado)){ ?>
							      					<option value="<?php echo $row['id_orden']; ?>"><?php echo $row['id_orden']; ?></option>
							      				<?php }
							    			?>
							    		</select>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">P. Venta: </label>
							    	<div class="col-sm-10">
							    		<input type="hidden" name="inputIdPuntoVenta" id="inputIdPuntoVenta">
							    		<input type="text" class="form-control input" name="inputNombrePuntoVenta" id="inputNombrePuntoVenta" placeholder="Punto de Venta..." readonly required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Entrega: </label>
							    	<div class="col-sm-10">
							    		<input type="date" class="form-control input" name="inputFechaEntrega" id="inputFechaEntrega" required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Descripción: </label>
							    	<div class="col-sm-10">
							    		<textarea class="form-control" rows="5" name="inputDescripcion" id="inputDescripcion" placeholder="Descripción del envío..."></textarea>
							    	</div>
							  	</div>
							  	<hr>
							  	<center>
					      			<button type="submit" class="btn btn-primary" id="btn-registrar-envio" disabled><i  class="glyphicon glyphicon-ok"></i> Registrar</button>
					      		</center>
					      	</div>
					    </div>
			      	</form>
					<?php
						mysql_close();
					?>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>

		<script type="text/javascript">
			$('#inputIdPedido').change(function(){
				var pedido = $(this).val();
				
				if(pedido != 0)
					cargarNombrePV(pedido);
				else
					$('#btn-registrar-envio').attr('disabled', 'disabled');
			});

			function cargarNombrePV(pedido){
				var params = {'pedido':pedido};

				$.ajax({
					type: 'POST',
					url: '../mod/buscar_nombre_pv.php',
					data: params,

					success: function(data){
						var arreglo = data.split('%#%');

						$('#inputIdPuntoVenta').val(arreglo[0]);
						$('#inputNombrePuntoVenta').val(arreglo[1]);
						$('#btn-registrar-envio').removeAttr('disabled');
					}
				});
			}
		</script>
	</body>
</html>
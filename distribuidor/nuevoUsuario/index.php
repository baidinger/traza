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
		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>

	</head>

	<body>
		<?php 
			include('../mod/navbar.php');
		?>
		<div class="contenido-general">
			<div class="modal-header">
        		<h3 class="titulo-header">
        			<img class="img-header" src="../../img/login.png"> Nuevo Usuario
        		</h3>
      		</div>
			<div class="contenido-general-2">
				<div class="div-contenedor-form">
					<form class="form-horizontal" role="form" method="post" action="../mod/registrar_usuario.php">
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
							    	<label class="col-sm-2 control-label">Nombre: </label>
							    	<div class="col-sm-10">
							    		<input type="text" class="form-control input" name="inputNombre" id="inputNombre" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" placeholder="Nombre del usuario..." autofocus required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Apellidos: </label>
							    	<div class="col-sm-10">
							    		<input type="text" class="form-control input" name="inputApellidos" id="inputApellidos" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" placeholder="Apellidos del usuario..." autofocus required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Dirección: </label>
							    	<div class="col-sm-10">
							    		<input type="text" class="form-control input" name="inputDireccion" id="inputDireccion" placeholder="Dirección del usuario..." autofocus required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Teléfono: </label>
							    	<div class="col-sm-10" style="width: 50%;">
							    		<input type="text" class="form-control input" name="inputTelefono" id="inputTelefono" pattern="[0-9]{10}|[0-9]{11}|[0-9]{12}|[0-9]{13}" title="Ingresa 10, 11, 12 y 13 dígitos" placeholder="Teléfono del usuario..." autofocus required>
							    	</div>
							  	</div>
							  	<hr>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Usuario: </label>
							    	<div class="col-sm-10" style="width: 50%;">
							    		<input type="text" class="form-control input" name="inputUsuario" id="inputUsuario" pattern="([A-Za-z0-9])+" title="El usuario sólo puede contener letras y números" placeholder="Nombre de usuario..." autofocus required>
							    		<div id="disponible"></div>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Contraseña: </label>
							    	<div class="col-sm-10" style="width: 50%;">
							    		<input type="text" class="form-control input" name="inputContrasena" id="inputContrasena" pattern="([A-Za-z0-9])+" title = "La contraseña sólo puede contener letras y números" placeholder="Contraseña..." required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Privilegios: </label>
							    	<div class="col-sm-10">
							    		<table width="100%">
							    			<tr>
							    				<td>
							    					<div class="checkbox">
														<label>
															<input type="checkbox" name="inputEntradas" id="inputEntradas" value="1"> Entradas
														</label>
													</div>
							    				</td>
							    				<td>
							    					<div class="checkbox">
														<label>
															<input type="checkbox" name="inputPedidos" id="inputPedidos" value="1"> Pedidos
														</label>
													</div>
							    				</td>
							    				<td>
							    					<div class="checkbox">
														<label>
															<input type="checkbox" name="inputEnvios" id="inputEnvios" value="1"> Envios
														</label>
													</div>
							    				</td>
							    			</tr>
							    		</table>
							    	</div>
							  	</div>
							  	<input type="hidden" name="inputDistribuidor" value="<?php echo $idDistribuidorFK; ?>">
							  	<hr>
							  	<center>
					      			<button id="enviar" type="submit" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Registrar</button>
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

		
		<script type="text/javascript">
			$('#inputUsuario').change(function(){
				var usuario = $('#inputUsuario').val();
				var params = {'usuario':usuario};
				$.ajax({
					type: 'POST',
					url: '../mod/validar_usuario.php',
					data: params,

					success: function(data){
						$('#disponible').html(data);
					},
					
					beforeSend: function(data ) {
				    	$("#disponible").html("<span class=\"label label-info\">cargando...</span>");
				  }
				});
			});
	</script>
	</body>
</html>
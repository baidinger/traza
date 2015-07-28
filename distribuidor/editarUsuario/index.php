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
        			<img class="img-header" src="../../img/editar_usuario.png"> Editar Usuario
        		</h3>
      		</div>
			<div class="contenido-general-2">
				<div class="div-contenedor-form">
					<form class="form-horizontal" role="form" method="post" action="../mod/editar_usuario.php">
			      		<div>
			      			<?php
			      				$idUsuarioDist = $_POST['usuario_dist'];
			      				$idUsuarioFK = $_POST['usuario_fk'];

			      				if(empty($idUsuarioFK))
			      					header('Location: ../usuarios/');

			      				include('../../mod/conexion.php');

			      				$consulta = "SELECT * FROM usuario_distribuidor WHERE id_usuario_distribuidor = $idUsuarioDist";
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);

			      				$consulta2 = "SELECT * FROM usuarios WHERE id_usuario = ".$row['id_usuario_fk'];
			      				$resultado2 = mysql_query($consulta2);
			      				$row2 = mysql_fetch_array($resultado2);
			      			?>
					      	<div class="modal-body">
					      		<div class="form-group">
							    	<label class="col-sm-2 control-label">Nombre: </label>
							    	<div class="col-sm-10">
							    		<input type="text" class="form-control input" name="inputNombre" id="inputNombre" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" placeholder="Nombre del usuario..." value="<?php echo $row['nombre_usuario_distribuidor']; ?>" autofocus required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Apellidos: </label>
							    	<div class="col-sm-10">
							    		<input type="text" class="form-control input" name="inputApellidos" id="inputApellidos" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" placeholder="Apellidos del usuario..." value="<?php echo $row['apellido_usuario_distribuidor']; ?>" required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Dirección: </label>
							    	<div class="col-sm-10">
							    		<input type="text" class="form-control input" name="inputDireccion" id="inputDireccion" placeholder="Dirección del usuario..." value="<?php echo $row['direccion_usuario_distribuidor']; ?>" required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Teléfono: </label>
							    	<div class="col-sm-10" style="width: 50%;">
							    		<input type="text" class="form-control input" name="inputTelefono" id="inputTelefono" pattern="[0-9]{10}|[0-9]{11}|[0-9]{12}|[0-9]{13}" title="Ingresa 10, 11, 12 y 13 dígitos" placeholder="Teléfono del usuario..." value="<?php echo $row['telefono_usuario_distribuidor']; ?>" required>
							    	</div>
							  	</div>
							  	<hr>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Usuario: </label>
							    	<div class="col-sm-10" style="width: 50%;">
							    		<input type="text" class="form-control input" name="inputUsuario" id="inputUsuario" pattern="([A-Za-z0-9])+" title="El usuario sólo puede contener letras y números" placeholder="Nombre de usuario..." value="<?php echo $row2['nombre_usuario']; ?>" disabled>
							    		<div id="disponible"></div>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Contraseña: </label>
							    	<div class="col-sm-10" style="width: 50%;">
							    		<input type="password" class="form-control input" name="inputContrasena" id="inputContrasena" pattern="([A-Za-z0-9])+" title = "La contraseña sólo puede contener letras y números" placeholder="Contraseña..." value="<?php echo $row2['contrasena_usuario']; ?>" required>
							    		<input type="hidden" name="inputContrasenaOriginal" value="<?php echo $row2['contrasena_usuario']; ?>">
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
															<?php if($row['entradas'] == 1){ ?>
																<input type="checkbox" name="inputEntradas" id="inputEntradas" value="1" checked> Entradas
															<?php } else{ ?>
																<input type="checkbox" name="inputEntradas" id="inputEntradas" value="1"> Entradas
															<?php } ?>
														</label>
													</div>
							    				</td>
							    				<td>
							    					<div class="checkbox">
														<label>
															<?php if($row['pedidos'] == 1){ ?>
																<input type="checkbox" name="inputPedidos" id="inputPedidos" value="1" checked> Pedidos
															<?php } else{ ?>
																<input type="checkbox" name="inputPedidos" id="inputPedidos" value="1"> Pedidos
															<?php } ?>
														</label>
													</div>
							    				</td>
							    				<td>
							    					<div class="checkbox">
														<label>
															<?php if($row['envios'] == 1){ ?>
																<input type="checkbox" name="inputEnvios" id="inputEnvios" value="1" checked> Envios
															<?php } else{ ?>
																<input type="checkbox" name="inputEnvios" id="inputEnvios" value="1"> Envios
															<?php } ?>
														</label>
													</div>
							    				</td>
							    			</tr>
							    		</table>
							    	</div>
							  	</div>
							  	<input type="hidden" name="inputUsuarioDist" value="<?php echo $idUsuarioDist; ?>">
							  	<input type="hidden" name="inputUsuarioFK" value="<?php echo $idUsuarioFK; ?>">
							  	<hr>
							  	<center>
							  		<a href="../usuarios/" class="btn btn-danger"><i  class="glyphicon glyphicon-remove"></i> Cancelar</a>
					      			<button type="submit" class="btn btn-primary"><i  class="glyphicon glyphicon-floppy-disk"></i> Guardar Cambios</button>
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
	</body>
</html>
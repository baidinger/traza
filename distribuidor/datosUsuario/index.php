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
        			<img class="img-header" src="../../img/login.png"> Datos del Usuario
        		</h3>
      		</div>
			<div class="contenido-general-2">
				<div class="div-contenedor-form">
		      		<div>
		      			<?php
		      				include('../../mod/conexion.php');

		      				$consulta = "SELECT usudist.nombre_usuario_distribuidor, usudist.apellido_usuario_distribuidor, usus.nivel_autorizacion_usuario, usus.fecha_creacion_usuario, usus.fecha_modificacion_usuario, usudist.direccion_usuario_distribuidor, usudist.telefono_usuario_distribuidor FROM usuarios AS usus, usuario_distribuidor AS usudist WHERE usudist.id_usuario_fk = usus.id_usuario AND usus.id_usuario = ".$_SESSION['id_usuario'];
		      				$resultado = mysql_query($consulta);
		      				$row = mysql_fetch_array($resultado);
		      			?>
				      	<div class="modal-body">
				      		<table class="table">
				      			<tbody>
				      				<tr>
				      					<td><strong>Tipo de Socio:</strong></td>
				      					<td>DISTRIBUIDOR</td>
				      				</tr>
				      				<tr>
				      					<td><strong>Nivel de Usuario:</strong></td>
				      					<td>
				      						<?php 
				      							if($row['nivel_autorizacion_usuario'] == 1)
				      								echo "USUARIO ADMINISTRADOR";
				      							else
				      								echo "USUARIO NORMAL";
				      						?>
				      					</td>
				      				</tr>
				      				<tr>
				      					<td><strong>Usuario:</strong></td>
				      					<td><?php echo $_SESSION['nombre_usuario']; ?> </td>
				      				</tr>
				      				<tr>
				      					<td><strong>Contraseña:</strong></td>
				      					<td><a href="../contrasena/">*****************************</a></td>
				      				</tr>
				      				<tr>
				      					<td><strong>Nombre:</strong></td>
				      					<td><?php echo $row['nombre_usuario_distribuidor']." ".$row['apellido_usuario_distribuidor']; ?></td>
				      				</tr>
				      				<tr>
				      					<td><strong>Teléfono:</strong></td>
				      					<td><?php echo $row['telefono_usuario_distribuidor']; ?></td>
				      				</tr>
				      				<tr>
				      					<td><strong>Dirección:</strong></td>
				      					<td><?php echo $row['direccion_usuario_distribuidor']; ?></td>
				      				</tr>
				      				<tr>
				      					<td><strong>Fecha de Registro:</strong></td>
				      					<td><?php echo $row['fecha_creacion_usuario']; ?></td>
				      				</tr>
				      				<tr>
				      					<td><strong>Fecha de Modificación:</strong></td>
				      					<td><?php echo $row['fecha_modificacion_usuario']; ?></td>
				      				</tr>
				      			</tbody>
				      		</table>
				      		<center>
				      			<a href="../" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Regresar</a>
				      		</center>
				      	</div>
				    </div>
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
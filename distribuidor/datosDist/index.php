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

		<script type="text/javascript" src="../mod/paises.js"></script>
	</head>

	<body>
		<?php 
			include('../mod/navbar.php');
		?>
		<div class="contenido-general">
			<div class="modal-header">
        		<h3 class="titulo-header">
        			<img class="img-header" src="../../img/distribuidor.png"> Datos del Distribuidor
        		</h3>
      		</div>
			<div class="contenido-general-2">
				<div class="div-contenedor-form">
					<form class="form-horizontal" role="form" method="post" action="../mod/editar_usuario.php">
			      		<div>
			      			<?php
			      				include('../../mod/conexion.php');

			      				$consulta = "SELECT id_distribuidor_fk FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
								$resultado = mysql_query($consulta);
								$row = mysql_fetch_array($resultado);
								$id_distribuidor_fk = $row['id_distribuidor_fk'];

			      				$consulta = "SELECT * FROM empresa_distribuidores WHERE id_distribuidor = $id_distribuidor_fk";
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      			?>
					      	<div class="modal-body">
					      		<table class="table">
					      			<tbody>
					      				<tr>
					      					<td><strong>Distribuidor:</strong></td>
					      					<td><?php echo $row['nombre_distribuidor']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>RFC:</strong></td>
					      					<td><?php echo $row['rfc_distribuidor']; ?> </td>
					      				</tr>
					      				<tr>
					      					<td><strong>Ubicación:</strong></td>
					      					<td>
					      						<script type="text/javascript">
					      							document.write(obtenerEstado(<?php echo $row['pais_distribuidor']; ?>, <?php echo $row['estado_distribuidor']; ?>) + ", " + obtenerPais(<?php echo $row['pais_distribuidor']; ?>));
												</script>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td><strong>Ciudad:</strong></td>
					      					<td><?php echo $row['ciudad_distribuidor']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Dirección:</strong></td>
					      					<td><?php echo $row['direccion_distribuidor']." C.P. ".$row['cp_distribuidor']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Teléfono(s):</strong></td>
					      					<td><?php echo $row['tel1_distribuidor']." & ".$row['tel2_distribuidor']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Email:</strong></td>
					      					<td><?php echo $row['email_distribuidor']; ?></td>
					      				</tr>
					      			</tbody>
					      		</table>
					      		<center>
					      			<a href="../" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Regresar</a>
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
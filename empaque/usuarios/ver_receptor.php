<!DOCTYPE html>
<html>
	<head>
		<title>Trazabilidad</title>
		<meta charset="UTF-8">
		<style type="text/css">
			.centro{
				text-align: center;
			}

			.derecha{
				text-align: right;
			}
		</style>
	</head>

	<body style="background: #ffffff">

		<div >
				<div class="div-contenedor-form">
			      		<div>
			      			<?php
			      				include('../../mod/conexion.php');
			      				$id_receptor = $_POST['id'];
			      				$consulta = "select * from usuarios, usuario_empaque where usuario_empaque.id_receptor = $id_receptor AND usuarios.id_usuario = usuario_empaque.id_usuario_fk";
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      			?>
					      	<div>
					      		<p class="alert alert-info">DATOS PERSONALES</p>
					      		<table class="table">
					      			<tbody>
					      				<tr>
					      					<td width="200"><strong>Nombre:</strong></td>
					      					<td><?php echo $row['nombre_receptor']." ".$row['apellido_receptor']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Teléfono:</strong></td>
					      					<td><?php echo $row['telefono_receptor']; ?> </td>
					      				</tr>
					      				<tr>
					      					<td><strong>Dirección:</strong></td>
					      					<td><?php echo $row['direccion_receptor']; ?> </td>
					      				</tr>
					      				<tr>
					      					<td><strong>PRIVILEGIOS:</strong></td>
					      					<td><?php echo ($row['pedidos'] == 1) ? "-PEDIDOS<br>" : "" ?> 
					      						<?php echo ($row['envios'] == 1) ? "-ENVIOS<br>" : "" ?>
					      						<?php echo ($row['lotes'] == 1) ? "-LOTES<br>" : "" ?></td>
					      				</tr>
					      			</tbody>
					      		</table>
								
								<p class="alert alert-info">DATOS DE USUARIO</p>
					      		<table class="table">
					      			<tbody>
					      				<tr>
					      					<td width="200"><strong>Usuario:</strong></td>
					      					<td><?php echo $row['nombre_usuario']; ?> </td>
					      				</tr>
					      				<tr>
					      					<td width="200"><strong>Nivel de autorización:</strong></td>
					      					<td><?php echo ($row['nivel_autorizacion_usuario'] == 1) ? "-ADMINISTRADOR<br>" : "NORMAL" ?> </td>
					      				</tr>
					      				<tr>
					      					<td><strong>Fecha de creación:</strong></td>
					      					<td><?php echo $row['fecha_creacion_usuario']; ?> </td>
					      				</tr>
					      				<tr>
					      					<td><strong>Fecha de moficación:</strong></td>
					      					<td><?php echo $row['fecha_modificacion_usuario']; ?></td>
					      				</tr>
					      				
					      			</tbody>
					      		</table>
					      		<hr>
					      		<center>
					      			<a style="width: 150px" href="#" data-dismiss="modal" class="btn btn-primary">
					      				Cerrar</a>
					      		</center>
					      	</div>
					    </div>
					<?php
						mysql_close();
					?>
				</div>
		</div>

		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>
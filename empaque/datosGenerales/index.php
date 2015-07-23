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

		<div style="width:100%;">	
	  		<div class="modal-header">
	    		<h3 class="modal-title">
	    			<img class="img-header" src="img/datos.png"> Datos generales
	    		</h3>
	  		</div>
	  	</div>
		<div style="width:800px; margin:0px auto;background:#ffffff">
				<div class="div-contenedor-form">
			      		<div>
			      			<?php
			      				include('../../mod/conexion.php');

			      				$consulta = "SELECT usudist.nombre_receptor, usudist.apellido_receptor, usus.nivel_autorizacion_usuario, usus.fecha_creacion_usuario, usus.fecha_modificacion_usuario, usudist.direccion_receptor, usudist.telefono_receptor FROM usuarios AS usus, usuario_empaque AS usudist WHERE usudist.id_usuario_fk = usus.id_usuario AND usus.id_usuario = ".$_SESSION['id_usuario'];
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      			?>
					      	<div>
					      		<table class="table">
					      			<tbody>
					      				<tr>
					      					<td><strong>NOMBRE EMPAQUE:</strong></td>
					      					<td><?php echo $_SESSION['nombre_empaque'] ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Nombre:</strong></td>
					      					<td><?php echo $row['nombre_receptor']." ".$row['apellido_receptor']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Usuario:</strong></td>
					      					<td><?php echo $_SESSION['nombre_usuario']; ?> </td>
					      				</tr>
					      				<tr>
					      					<td><strong>Contraseña:</strong></td>
					      					<td><a href="index.php?op=contrasena">*****************************</a></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Tipo Socio:</strong></td>
					      					<td>EMPAQUE</td>
					      				</tr>
					      				<tr>
					      					<td><strong>Nivel Usuario:</strong></td>
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
					      					<td><strong>Fecha Creación:</strong></td>
					      					<td><?php echo $row['fecha_creacion_usuario']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Fecha Modificación:</strong></td>
					      					<td><?php echo $row['fecha_modificacion_usuario']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Dirección:</strong></td>
					      					<td><?php echo $row['direccion_receptor']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Teléfono:</strong></td>
					      					<td><?php echo $row['telefono_receptor']; ?></td>
					      				</tr>
					      			</tbody>
					      		</table>
					      		<center>
					      			<a href="../" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Regresar</a>
					      		</center>
					      	</div>
					    </div>
					<?php
						mysql_close($conexion);
					?>
				</div>
		</div>

		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>
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
	    			<img class="img-header" src="img/datos.png"> Datos de usuario
	    		</h3>
	  		</div>
	  	</div>
	  				      			<?php
			      				include('../../mod/conexion.php');
			      				$id = $_POST['id'];

			      				$consulta = "SELECT usudist.id_receptor, usudist.id_empaque_fk, usudist.nombre_receptor, usudist.pedidos, usudist.lotes, usudist.envios, usus.nombre_usuario, usus.estado_usuario, usudist.apellido_receptor, usus.nivel_autorizacion_usuario, usus.fecha_creacion_usuario, usus.fecha_modificacion_usuario, usudist.direccion_receptor, usudist.telefono_receptor FROM usuarios AS usus, usuario_empaque AS usudist WHERE usudist.id_usuario_fk = usus.id_usuario AND usudist.id_receptor = ".$id;
			      				$resultado = mysql_query($consulta);
			      				if(mysql_num_rows($resultado) == 0) {  ?>
			      				<div class="alert alert-danger" style="width : 500px; margin: 50px auto">
			      					No se encontró un empaque con ese ID
			      				</div>
			      		<?php	return; }
			      				$row = mysql_fetch_array($resultado);
			      			?>
		<div style="width:800px; margin:50px auto;background:#ffffff; border-radius: 5px; padding: 30px">
				<div class="div-contenedor-form">
			      		<div>

					      	<div>
					      		<table class="table" style="font-size: 14px">
					      			<tbody>
					      				<tr>
					      					<td><strong>ID usuario</strong></td>
					      					<td><?php print str_pad($row['id_receptor'], 7,"0",STR_PAD_LEFT); ?></td>
					      					<td width="160"><strong>Usuario:</strong></td>
					      					<td><?php echo $row['nombre_usuario']; ?> </td>
					      				</tr>
					      				<tr>
					      					
					      					<td><strong>Tipo Socio:</strong></td>
					      					<td>EMPAQUE</td>
					      					<td><strong>ID empaque:</strong></td>
					      					<td><a href="index.php?empaque=<?php print $row['id_empaque_fk'] ?>"><?php echo str_pad($row['id_empaque_fk'], 7,"0",STR_PAD_LEFT); ?></a></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Creado:</strong></td>
					      					<td><?php echo $row['fecha_creacion_usuario']; ?></td>
					      					<td><strong>Modificado:</strong></td>
					      					<td><?php echo $row['fecha_modificacion_usuario']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Dirección:</strong></td>
					      					<td><?php echo $row['direccion_receptor']; ?></td>
					      					<td><strong>Teléfono:</strong></td>
					      					<td><?php echo $row['telefono_receptor']; ?></td>
					      				</tr>

					      				<tr>
					      					<td width="160"><strong>Nombre:</strong></td>
					      					<td><?php echo $row['nombre_receptor']." ".$row['apellido_receptor']; ?></td>
					      					
					      					<td><strong>Privilegios:</strong></td>
					      					<td><?php echo ($row['pedidos'] == '1')  ? "pedidos" : ""; echo ($row['lotes'] == '1')  ? ",lotes" : ""; echo ($row['envios'] == '1')  ? ",envios" : "";  ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Nivel:</strong></td>
					      					<td>
					      						<span class="label label-info"><?php echo ($row['nivel_autorizacion_usuario'] == 1) ? "ADMINISTRADOR" : "NORMAL" ?></span>
					      					</td>
					      					<td><strong>Estado:</strong></td>
					      					<td><?php if( $row['estado_usuario'] == 1){ ?>
					      						<span class="label label-success"> Activo </span> 
					      			<?php 	} else {  ?>
					      						<span class="label label-danger"> Inactivo </span> 

					      	<?php 	}?></td>
					      				</tr>
					      			</tbody>
					      		</table>
					      		<center>
					      			<a style="cursor: hand"onclick="goBack()" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Regresar</a>
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
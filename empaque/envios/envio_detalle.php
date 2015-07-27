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
		<div style=" margin:0px auto;background:#ffffff">
				<div class="div-contenedor-form">
			      		<div>
			      			<?php
			      				$id_envio = $_POST['id'];
			      				$id_orden = $_POST['orden'];
			      				include('../../mod/conexion.php');
			      				$cadena = "SELECT * FROM productos, ordenes_distribuidor_detalles WHERE id_producto = id_producto_fk AND id_orden_fk = $id_orden";

								$productos = mysql_query($cadena);
								

			      				$cadena = "SELECT * FROM ordenes_distribuidor, envios_empaque, usuario_empaque, empresa_distribuidores where ordenes_distribuidor.id_orden = envios_empaque.id_orden_fk AND usuario_empaque.id_empaque_fk = ordenes_distribuidor.id_empaque_fk AND usuario_empaque.id_usuario_fk = ".$_SESSION['id_usuario']." AND ordenes_distribuidor.id_orden=$id_orden" ;
			      				$resultado = mysql_query($cadena);
			      				$row = mysql_fetch_array($resultado);
			      			?>
					      	<div>
					      		<div class="alert alert-info">En la siguiente tabla podrá visualizarse la información referente al ::envío::</div>
					      		<table class="table">
					      			<tbody>
					      				<tr>
					      					<td><strong>Distribuidor:</strong></td>
					      					<td><?php echo $row['nombre_distribuidor'] ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>RFC:</strong></td>
					      					<td><?php echo $row['rfc_distribuidor']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Productos:</strong></td>
					      					<td><?php 
					      					if(mysql_num_rows($productos) > 0){
												while($row1 = mysql_fetch_array($productos)) {
													print $row1['nombre_producto'] . " " . $row1['variedad_producto']."<br>";
												}
											}
											 ?> </td>
					      				</tr>
					      				<tr>
					      					<td><strong>Fecha de envío</strong></td>
					      					<td><?php echo $row['fecha_envio'] . " a las " . $row['hora_envio'] ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Id orden:</strong></td>
					      					<td><?php echo $row['id_orden']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>fecha de orden:</strong></td>
					      					<td>
					      						<?php echo $row['fecha_orden']; ?>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td><strong>Costo de la orden:</strong></td>
					      					<td><?php echo $row['costo_orden']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Estado:</strong></td>
					      					<td><?php 
					      					 switch($row['estado_envio']){
					      					 	case 1: echo "<span class='label label-warning'>Pendiente</span>"; break;
					      					 	case 2: echo "<span class='label label-danger'>Rechazado</span>"; break;
					      					 	case 3: echo "<span class='label label-primary'>Enviado</span>"; break;
					      					 	case 4: echo "<span class='label label-success'>Concretado</span>"; break;
					      					 	case 5: echo "<span class='label label-danger'>Cancel. por emp.</span>"; break;
					      					 	case 6: echo "<span class='label label-success'>Aprobado</span>"; break;
					      					 	case 7: echo "<span class='label label-warning'>Pre-envío</span>"; break;
					      					 	case 8: echo "<span class='label label-danger'>Cancel. por dist.</span>"; break;
										 } ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Dirección:</strong></td>
					      					<td><?php echo $row['direccion_receptor']; ?></td>
					      				</tr>
					      			</tbody>
					      		</table>
					      		<center>
					      			<a href="#" data-dismiss="modal" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Regresar</a>
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
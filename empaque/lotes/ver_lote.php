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
			      				$id_lote = $_POST['id'];
			      				$consulta = "SELECT * FROM lotes, productos_productores, empresa_productores, productos WHERE id_productos_productores = id_productos_productores_fk AND id_producto = id_producto_fk AND id_productor = id_productor_fk AND id_lote = $id_lote";
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      			?>
					      	<div>
					      		<p class="alert alert-info">DATOS DEL PRODUCTOR</p>
					      		<table class="table" style="font-size: 14px">
					      			<tbody>
					      				<tr>
					      					<td width="200"><strong>Nombre:</strong></td>
					      					<td><?php echo $row['nombre_productor']." ".$row['apellido_productor']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>RFC:</strong></td>
					      					<td><?php echo $row['rfc_productor']; ?> </td>
					      				</tr>
					      				<!--<tr>
					      					<td><strong>Ubicación huerta:</strong></td>
					      					<td><?php echo $row['ubicacion_huerta_productor']; ?> </td>
					      				</tr>-->
					      				<tr>
					      					<td><strong>Teléfono:</strong></td>
					      					<td><?php echo $row['telefono_productor']; ?> </td>
					      				</tr>
					      			</tbody>
					      		</table>
								
								<p class="alert alert-info">DATOS DE LA COMPRA</p>
					      		<table class="table" style="font-size: 14px">
					      			<tbody>
					      				<tr>
					      					<td width="200"><strong>Remitente:</strong></td>
					      					<td><?php echo $row['remitente_lote']; ?> </td>
					      				</tr>
					      				<tr>
					      					<td width="200"><strong>Producto:</strong></td>
					      					<td><?php echo $row['nombre_producto']; ?> </td>
					      				</tr>
					      				<tr>
					      					<td><strong>Variedad:</strong></td>
					      					<td><?php echo $row['variedad_producto']; ?> </td>
					      				</tr>
					      				<tr>
					      					<td><strong>Cant. cajas / rend. cajas:</strong></td>
					      					<td><?php echo $row['cant_cajas_lote']." / ".($row['cajas_chicas'] + $row['cajas_medianas'] + $row['cajas_grandes']); ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Cant. kilos / rend. kilos:</strong></td>
					      					<td><?php echo $row['cant_kilos_lote']." / ".$row['rendimiento_kg']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Fecha de compra:</strong></td>
					      					<td>
					      						<?php echo $row['fecha_recibo_lote'] . " a las " . $row['hora_recibo_lote'] ?>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td><strong>Costo:</strong></td>
					      					<td>$ <?php echo $row['costo_lote']; ?></td>
					      				</tr>
					      				<!--<tr>
					      					<td><strong>Rango:</strong></td>
					      					<td>
					      						<?php if( strcmp($row['rango_inicial'],"") != 0) {  
					      					  echo $row['rango_inicial'] ." - ". $row['rango_final']; } else { ?>
					      					  <div class="label label-danger">No asignado</div>
					      					  <?php } ?>
					      					</td>
					      				</tr>-->
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
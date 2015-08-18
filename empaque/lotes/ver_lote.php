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

	<body>
<?php
		include('../mod/conexion.php');
		$id_lote = $id;
		$consulta = "SELECT * FROM lotes, productos_productores, empresa_productores, productos WHERE id_productos_productores = id_productos_productores_fk AND id_producto = id_producto_fk AND id_productor = id_productor_fk AND id_lote = $id_lote";
		$resultado = mysql_query($consulta);
		$row = mysql_fetch_array($resultado);
	?>
		<div style="width:800px; margin:50px auto;background:#ffffff; padding: 20px; border-radius: 5px">
				<div class="div-contenedor-form">
			      		<div>
			      			
					      	<div>
					      		<table class="table" style="font-size: 14px">
					      			<tbody>
					      				<tr>
					      					<td width="160"><strong>Núm. lote:</strong></td>
					      					<td><a href="index.php?lote=<?php print $row['id_lote'] ?>"><?php echo str_pad($row['id_lote'], 3,"0",STR_PAD_LEFT); ?></a></td>
					      					<td width="160"><strong>Nombre del productor:</strong></td>
					      					<td><a href="index.php?productor=<?php print $row['id_productor'] ?>"><?php echo $row['nombre_productor']. " ".$row['apellido_productor'] ?></a></td>
					      				</tr>
					      				<tr>
					      					<td><strong>PRODUCTO / VARIEDAD:</strong></td>
					      					<td><?php echo $row['nombre_producto']. " " . $row['variedad_producto']; ?></td>
					      					<td><strong>Remitente:</strong></td>
					      					<td><?php echo $row['remitente_lote']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Cant. cajas:</strong></td>
					      					<td><?php echo $row['cant_cajas_lote'] ?></td>
					      					<td><strong>Cant. kilos recibidos:</strong></td>
					      					<td><?php echo $row['cant_kilos_lote']?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Rendimiento de cajas:</strong></td>
					      					<td><?php echo "CH: ".$row['cajas_chicas']."<br>MD: ".$row['cajas_medianas']."<br>GD: ".$row['cajas_grandes']."<br>TOTAL: ".($row['cajas_medianas'] + $row['cajas_grandes'] + $row['cajas_chicas']); ?></td>
					      					<td><strong>Rendimiento de kilos:</strong></td>
					      					<td><?php echo $row['rendimiento_kg']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Fecha de compra:</strong></td>
					      					<td><?php print $row['fecha_recibo_lote'] . " a las ".$row['hora_recibo_lote'] ?> </td>
					      					<td><strong>Costo del lote:</strong></td>
					      					<td><?php echo "$ ".$row['costo_lote']; ?></td>
					      				</tr>
					      				<tr>
					      					 <td><strong>EPCs.</strong></td>
					      					 <td><a href="index.php?op=epcgenerados&lote=<?php print $row['id_lote'] ?>">ver EPCs</a></td>
					      					 <td><strong></strong></td>
					      					 <td></td>
					      				</tr>

					      			</tbody>
					      		</table>
					      		<center>
					      			<a style="cursor: hand" onclick="goBack()" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Regresar</a>
					      		</center>
					      	</div>
					    </div>

				</div>
		</div>





		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>
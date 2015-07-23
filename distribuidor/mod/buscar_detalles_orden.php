<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<table class="table">
			<thead>
				<tr>
					<th class="centro">#</th>
					<th>Producto</th>
					<th class="centro">Cantidad</th>
					<!-- <th class="derecha">Costo</th> -->
				</tr>
			</thead>

			<tbody>
				<?php 
					$idOrden = $_POST['orden'];

					include('../../mod/conexion.php');

					$cont = 1;
					$consulta = "SELECT dets.cantidad_producto_od, dets.unidad_producto_od, prods.nombre_producto, prods.variedad_producto, dets.costo_producto_od FROM ordenes_distribuidor_detalles AS dets, productos AS prods WHERE id_orden_fk = $idOrden AND dets.id_producto_fk = prods.id_producto";
					$resultado = mysql_query($consulta);
					while($row = mysql_fetch_array($resultado)) { ?>
						<tr>
							<td class="centro"><?php echo $cont; ?></td>
							<td><?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?></td>
							<td class="centro"><?php echo $row['cantidad_producto_od']." ".$row['unidad_producto_od']; ?></td>
							<!-- <td class="derecha"><?php echo "$ " . number_format($row['costo_producto_od'], 2, '.', ','); ?></td> -->
						</tr>
					<?php 
						$cont++;
					}

					mysql_close();
				?>
			</tbody>
		</table>
	</body>
</html>
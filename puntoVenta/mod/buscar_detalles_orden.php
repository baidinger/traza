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
					$consulta = "SELECT dets.cant_producto_odd, dets.unidad_producto_odd, prods.nombre_producto, prods.variedad_producto, dets.costo_producto_odd FROM ordenes_punto_venta_detalles AS dets, productos AS prods WHERE id_orden_dist_fk = $idOrden AND dets.id_producto_fk = prods.id_producto";
					$resultado = mysql_query($consulta);
					while($row = mysql_fetch_array($resultado)) { ?>
						<tr>
							<td class="centro"><?php echo $cont; ?></td>
							<td><?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?></td>
							<td class="centro"><?php echo $row['cant_producto_odd']." ".$row['unidad_producto_odd']; ?></td>
							<!-- <td class="derecha"><?php echo "$ " . number_format($row['costo_producto_odd'], 2, '.', ','); ?></td> -->
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
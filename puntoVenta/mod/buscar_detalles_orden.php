<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<?php 
			$idOrden = $_POST['orden'];

			include('../../mod/conexion.php');

			$consulta = "SELECT descripcion_orden, descripcion_cancelacion, descripcion_rechazo, fecha_entrega_orden FROM ordenes_punto_venta WHERE id_orden = $idOrden";
			$resultado = mysql_query($consulta);
			$row = mysql_fetch_array($resultado);

			$descripcionOrden = $row['descripcion_orden'];
			$descripcionCancelacion = $row['descripcion_cancelacion'];
			$descripcionRechazo = $row['descripcion_rechazo'];
			$fechaEntregaOrden = $row['fecha_entrega_orden'];
		?>
		<div class="form-inline">
			<center>
				<label>Fecha de entrega:</label>
				<input type="date" class="form-control" value="<?php echo $fechaEntregaOrden; ?>" readonly>
			</center>
		</div>
		<br><br>
		<table class="table">
			<thead>
				<tr>
					<th class="centro">#</th>
					<th>Producto</th>
					<th class="centro">Cantidad</th>
					<th class="derecha">$ Unitario</th>
					<th class="derecha">Costo Total</th>
				</tr>
			</thead>

			<tbody>
				<?php
					$cont = 1;
					$costoTotalOrden = 0;
					$consulta = "SELECT dets.cant_producto_odd, dets.unidad_producto_odd, prods.nombre_producto, prods.variedad_producto, dets.costo_unitario_odd, dets.costo_producto_odd FROM ordenes_punto_venta_detalles AS dets, productos AS prods WHERE id_orden_dist_fk = $idOrden AND dets.id_producto_fk = prods.id_producto";
					$resultado = mysql_query($consulta);
					while($row = mysql_fetch_array($resultado)) { ?>
						<tr>
							<td class="centro"><?php echo $cont; ?></td>
							<td><?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?></td>
							<td class="centro"><?php echo $row['cant_producto_odd']." ".$row['unidad_producto_odd']; ?></td>
							<td class="derecha"><?php echo "$ " . number_format($row['costo_unitario_odd'], 2, '.', ','); ?></td>
							<?php 
								$costoItem = $row['costo_producto_odd'];
								$costoTotalOrden += $costoItem;
							?>
							<td class="derecha"><?php echo "$ " . number_format($costoItem, 2, '.', ','); ?></td>
						</tr>
					<?php 
						$cont++;
					} ?>
				<tr>
					<td colspan="4" class="derecha"><strong>Total:</strong></td>
					<td class="derecha"><?php echo "$ " . number_format($costoTotalOrden, 2, '.', ','); ?></td>
				</tr>
			</tbody>
		</table>
		
		<?php if(!empty($descripcionOrden)){ ?>
			<p><label>Descripción de la Orden:</label></p>
			<p><textarea class="form-control" rows="3" readonly><?php echo $descripcionOrden; ?></textarea></p>
		<?php }
		
		if(!empty($descripcionCancelacion)){ ?>
			<p><label>Motivo de Cancelación:</label></p>
			<p><textarea class="form-control" rows="3" readonly><?php echo $descripcionCancelacion; ?></textarea></p>
		<?php }

		if(!empty($descripcionRechazo)){ ?>
			<p><label>Motivo de Rechazo:</label></p>
			<p><textarea class="form-control" rows="3" readonly><?php echo $descripcionRechazo; ?></textarea></p>
		<?php } ?>
		
		<?php
			mysql_close();
		?>
	</body>
</html>
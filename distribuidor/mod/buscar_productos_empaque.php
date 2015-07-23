<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<table class="table">
			<tr>
				<td>
					<label>Producto: </label>
					<select class="form-control" name="inputProducto" id="selectProducto">
						<?php 
							$idEmpaque = $_POST['idEmpaque'];

							include('../../mod/conexion.php');

							$numProds = 0;
						    $consulta = "SELECT prds.id_producto, prds.nombre_producto, prds.variedad_producto FROM productos AS prds, productos_empaques AS prdsepqs WHERE prds.id_producto = prdsepqs.id_producto_fk AND prdsepqs.id_empaque_fk = $idEmpaque";
							$resultado = mysql_query($consulta);
							while($row = mysql_fetch_array($resultado)){ ?>
								<option value="<?php echo $row['id_producto']; ?>"><?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?></option>
							<?php $numProds++; }
						?>
					</select>
				</td>
				<td>
					<label>Cantidad: </label>
					<input type="number" min="1" class="form-control" name="inputCantidad" id="inputCantidad" value="1" placeholder="Cantidad..." required>
				</td>
				<td>
					<label>Unidad: </label>
					<select class="form-control" name="inputUnidad" id="selectUnidad">
						<!-- <option value="CAJAS">CAJAS</option> -->
						<option value="KILOS">KILOS</option>
					</select>
				</td>
				<td class="derecha">
					<label> &nbsp; </label><br>
					<?php if($numProds != 0){ ?>
						<a href="#" class="btn btn-success" onclick="agregarProducto();"><i class="glyphicon glyphicon-ok"></i> Agregar</a>
					<?php } else { ?>
						<a href="#" class="btn btn-danger"><i class="glyphicon glyphicon-ok"></i> Agregar</a>
					<?php } ?>
				</td>
			</tr>
		</table>
	</body>
</html>
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

						    $consulta = "SELECT * FROM productos ORDER BY nombre_producto";
							$resultado = mysql_query($consulta);
							while($row = mysql_fetch_array($resultado)){ ?>
								<option value="<?php echo $row['id_producto']; ?>"><?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?></option>
							<?php }
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
					<a href="#" class="btn btn-success" onclick="agregarProducto();"><i class="glyphicon glyphicon-ok"></i> Agregar</a>
				</td>
			</tr>
		</table>
	</body>
</html>
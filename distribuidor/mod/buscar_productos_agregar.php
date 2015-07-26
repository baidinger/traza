<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Nombre del Producto</th>
			<th>Variedad</th>
			<th></th>
		</tr>
	</thead>

	<tbody>
		<?php 
			$producto = $_POST['producto'];

			include('../../mod/conexion.php');

			$cont = 1;
			$consulta = "SELECT * FROM productos WHERE nombre_producto LIKE '%$producto%' OR variedad_producto LIKE '%$producto%' ORDER BY nombre_producto ASC";
			$resultado = mysql_query($consulta);
			while($row = mysql_fetch_array($resultado)){ ?>
				<tr>
					<td class="centro"><?php echo $cont; ?></td>
					<td><?php echo $row['nombre_producto']; ?></td>
					<td><?php echo $row['variedad_producto']; ?></td>
					<td class="derecha">
						<button class="btn btn-success btn-agregar" onClick="agregarProducto(<?php echo $row['id_producto']; ?>)"><i class="glyphicon glyphicon-ok"></i> Agregar</button>
					</td>
				</tr>
				<?php $cont++; 
			}
		?>
	</tbody>
</table>

<?php if($cont == 1){ ?>
	<div class="alert alert-info" role="alert" style="text-align: center;">
		<strong>Sin resultados...</strong> No hay hay coincidencias para "<?php echo $producto; ?>".
	</div>
<?php } ?>
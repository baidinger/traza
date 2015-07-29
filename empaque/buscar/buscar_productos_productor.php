<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<?php 
				$idProductor = $_POST['idProductor'];

				include('../../mod/conexion.php');

			    $consulta = "SELECT prds.id_producto, prds.id_productos_productores, prdsepqs.ubicacion_huerta, prds.nombre_producto, prds.variedad_producto FROM productos AS prds, productos_productores AS prdsepqs WHERE prds.id_producto = prdsepqs.id_producto_fk AND prdsepqs.id_productor_fk = $idProductor";
				$resultado = mysql_query($consulta);

				if(mysql_num_rows($resultado ) > 0){
				?>
		<select style="float:right" class="col-sm-9 form-control" name="id_productos_productores" id="selectProducto">
			<?php 

				while($row = mysql_fetch_array($resultado)){ ?>
					<option value="<?php echo $row['id_productos_productores']; ?>"><?php echo $row['nombre_producto']." ".$row['variedad_producto']." - ".$row['ubicacion_huerta']; ?></option>
				<?php }
			?>
		</select>
		
		<script type="text/javascript">
			if($('#selectProducto').length > 0){
				$("#guardar").removeAttr("disabled");
		}
		</script>
		
		<?php } else {?>
		<div class="alert alert-danger" role="alert"><p>No hay productos asignados a este productor</p></div>
		<?php } ?>

		
	</body>
</html>
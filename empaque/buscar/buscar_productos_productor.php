<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<?php 
				$idProductor = $_POST['idProductor'];

				include('../../mod/conexion.php');

			    $consulta = "SELECT prds.id_producto, prdsepqs.id_productos_productores, prdsepqs.ubicacion_huerta, prds.nombre_producto, prds.variedad_producto FROM productos AS prds, productos_productores AS prdsepqs, productos_empaques WHERE productos_empaques.id_producto_fk = id_producto AND id_empaque_fk = $_SESSION[id_empaque] AND prds.id_producto = prdsepqs.id_producto_fk AND prdsepqs.id_productor_fk = $idProductor";
				$resultado = mysql_query($consulta);

				if(mysql_num_rows($resultado ) > 0){
				?>
		<select onchange="obtenerPrecio()" style="float:right" class="col-sm-9 form-control" name="id_productos_productores" id="selectProducto">
			<?php 

				while($row = mysql_fetch_array($resultado)){ ?>
					<option value="<?php echo $row['id_productos_productores']; ?>"><?php echo $row['nombre_producto']." ".$row['variedad_producto']." - ".$row['ubicacion_huerta']; ?></option>
				<?php }
			?>
		</select>
		
		<script type="text/javascript">
			if($('#selectProducto').length > 0){
				$("#guardar").removeAttr("disabled");

				obtenerPrecio();
			}
		</script>
		
		<?php } else {?>
		<select class="form-control">
			<option>No hay productos disponibles en este productor</option>
		</select>
		<!--<div class="alert alert-danger" role="alert"><p>No hay productos asignados a este productor</p></div>-->
		<script type="text/javascript">
			$("#precio").val("0.00");
			calcularP();
		</script>
		<?php } ?>

		
	</body>
</html>
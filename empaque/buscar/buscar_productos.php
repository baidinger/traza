<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<div id="paginacion">
		<table class="table">
			<thead>
				<th class="centro">#</th>
				<th class="centro">ID</th>
				<th>Nombre del Producto</th>
				<th></th>
			</thead>
			<tbody>
				<?php 
				if(isset($_POST['productor']))
					$id_productor = $_POST['productor'];
					$producto = $_POST['producto'];
					include('../../mod/conexion.php');

					$cont = 1;
				    $consulta = "SELECT * FROM productos WHERE nombre_producto LIKE '%$producto%' OR variedad_producto LIKE '%$producto%' OR id_producto = '$producto' ORDER BY nombre_producto ASC, variedad_producto ASC";
					$resultado = mysql_query($consulta);
					while($row = mysql_fetch_array($resultado)){ 
				?>
						<tr>
							<td class="centro"><?php echo $cont; ?></td>
							<td class="centro"><?php echo str_pad($row['id_producto'],5,"0",STR_PAD_LEFT); ?> </td>
			          		<td><?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?></td>
			          		<td class="derecha">
			          			<?php if(isset($_POST['productor'])) { ?>
			          			<button class="btn btn-success" onClick="agregarProductoProductores(<?php echo $row['id_producto']; ?>, <?php echo $id_productor; ?>);"><i class="glyphicon glyphicon-ok"></i> Agregar</button>
			          			<?php }else{ ?>
				        		<button class="btn btn-success" onClick="agregarProducto(<?php echo $row['id_producto']; ?>, '<?php echo $_SESSION['id_empaque']; ?>');"><i class="glyphicon glyphicon-ok"></i> Agregar</button>
				        		<?php } ?>

				        	</td>
				        	<?php $cont++; ?>
			    	    </tr>
					<?php }
				?>
			</tbody>
		</table>
		<?php if($cont> 1){ ?>
			<div class="my-navigation" style="margin: 0px auto;">
			<div class="simple-pagination-page-numbers"></div>
			<br><br><br>
			</div>
		<?php } ?>
	</div>
	<script type="text/javascript">
		$('#paginacion').simplePagination({
			items_per_page: 5
		});
		</script>
	</body>
</html>
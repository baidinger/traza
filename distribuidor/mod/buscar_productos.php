<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<br>
		<div id="paginacion-resultados">
			<table class="table">
				<thead>
					<tr>
						<th class="centro">#</th>
						<th>Nombre del Producto</th>
						<th>Variedad</th>
						<th class="derecha">$ de Venta</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$producto = $_POST['producto'];

						include('../../mod/conexion.php');

						$consulta = "SELECT id_distribuidor_fk FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
	      				$resultado = mysql_query($consulta);
	      				$row = mysql_fetch_array($resultado);
	      				$idDistribuidorFK = $row['id_distribuidor_fk'];

						$cont = 1;
						$consulta = "SELECT pdist.id_productos_distribuidor, prods.nombre_producto, prods.variedad_producto, pdist.precio_venta FROM productos AS prods, productos_distribuidores AS pdist WHERE prods.id_producto = pdist.id_producto_fk AND pdist.id_distribuidor_fk = $idDistribuidorFK AND(prods.nombre_producto LIKE '%$producto%' OR prods.variedad_producto LIKE '%$producto%') ORDER BY prods.nombre_producto ASC";
						$resultado = mysql_query($consulta);
						while($row = mysql_fetch_array($resultado)){ ?>
							<tr>
				          		<td class="centro"><?php echo $cont; ?></td>
				          		<td><?php echo $nombreProd = $row['nombre_producto']; ?></td>
				          		<td><?php echo $variedadProd = $row['variedad_producto']; ?></td>
				          		<td class="derecha"><?php echo "$ ".number_format($row['precio_venta'], 2, '.', ','); ?></td>
				          		<td class="derecha">
				          			<?php 
				          				$idProductoDist = $row['id_productos_distribuidor']; 
				          				$precioProd =  $row['precio_venta']; 
				          			?>
				          			<button class="btn btn-primary btn-editar" data-toggle="tooltip" data-placement="top" title="Editar precio" onClick="mostrarModalPrecio(<?php echo $idProductoDist; ?>, '<?php echo $nombreProd; ?>', '<?php echo $variedadProd; ?>', <?php echo $precioProd; ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
				          			<button class="btn btn-danger btn-borrar" data-toggle="tooltip" data-placement="top" title="Eliminar producto" onClick="borrarProducto(<?php echo $idProductoDist; ?>, '<?php echo $nombreProd; ?>', '<?php echo $variedadProd; ?>')"><i class="glyphicon glyphicon-remove"></i></button>
					        	</td>
				    	    </tr>
						<?php $cont++; 
						}
					?>
				</tbody>
			</table>

			<?php if($cont > 1){ ?>
				<div class="my-navigation" style="margin: 0px auto;">
					<div class="simple-pagination-page-numbers"></div>
					<br><br><br>
				</div>
			<?php } else{ ?>
				<div class="alert alert-info" role="alert" style="text-align: center;">
					<strong>Sin resultados...</strong> No se encontraron coincidencias para "<?php echo $usuario; ?>".
				</div>
			<?php } ?>

			<?php 
				mysql_close();
			?>
		</div>
		
		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
			$('.btn-editar').tooltip();
			$('.btn-borrar').tooltip();
		</script>
	</body>
</html>
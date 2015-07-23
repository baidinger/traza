c<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<table class="table">
			<thead>
				<th class="centro">#</th>
				<th>Nombre del producto</th>
				<th class="derecha"></th>
			</thead>
			<tbody>
				<?php 
					$producto = $_POST['producto'];
					$id_productor = $_POST['productor'];

					include('../../mod/conexion.php');

					$result = mysql_query("select id_empaque_fk from usuario_empaque where id_usuario_fk = ".$_SESSION['id_usuario']);
					
	  				if(mysql_num_rows($result) > 0){
	  					while($row = mysql_fetch_array($result)){
	  						$id_empaque = $row['id_empaque_fk'];
	  					}
	  				}

					$cont = 1;
				    $consulta = "SELECT * FROM productos WHERE nombre_producto LIKE '%$producto%' OR variedad_producto LIKE '%$producto%' ORDER BY variedad_producto ASC";
					$resultado = mysql_query($consulta);
					while($row = mysql_fetch_array($resultado)){ ?>
						<tr>
							<td class="centro"><?php echo $cont; ?></td>
			          		<td><?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?></td>
				        	<td class="derecha">
				        		<button class="btn btn-success" onClick="agregarProductoProductores(<?php echo $row['id_producto']; ?>, '<?php echo $id_productor; ?>');"><i class="glyphicon glyphicon-ok"></i> Agregar</button>
				        	</td>
				        	<?php $cont++; ?>
			    	    </tr>
					<?php }
				?>
			</tbody>
		</table>
	</body>
</html>
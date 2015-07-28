<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<table class="table">
			<thead>
				<th class="centro">#</th>
				<th>Nombre del Distribuidor</th>
				<th class="derecha"></th>
			</thead>
			<tbody>
				<?php 
					$distribuidor = $_POST['distribuidor'];

					include('../../mod/conexion.php');

					$cont = 1;
				    $consulta = "SELECT * FROM empresa_distribuidores WHERE estado_d = 1 AND nombre_distribuidor LIKE '%$distribuidor%' ORDER BY nombre_distribuidor ASC";
					$resultado = mysql_query($consulta);
					while($row = mysql_fetch_array($resultado)){ ?>
						<tr>
							<td class="centro"><?php echo $cont; ?></td>
			          		<td><?php echo $row['nombre_distribuidor']; ?></td>
				        	<td class="derecha">
				        		<button class="btn btn-success" onClick="seleccionarDistribuidor(<?php echo $row['id_distribuidor']; ?>, '<?php echo $row['nombre_distribuidor']; ?>');"><i class="glyphicon glyphicon-ok"></i> Seleccionar</button>
				        	</td>
				        	<?php $cont++; ?>
			    	    </tr>
					<?php }
				?>
			</tbody>
		</table>
	</body>
</html>
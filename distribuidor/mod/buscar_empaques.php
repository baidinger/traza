<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<table class="table">
			<thead>
				<th class="centro">#</th>
				<th>Nombre del Empaque</th>
				<th class="derecha"></th>
			</thead>
			<tbody>
				<?php 
					$empaque = $_POST['empaque'];

					include('../../mod/conexion.php');

					$cont = 1;
				    $consulta = "SELECT * FROM empresa_empaques WHERE estado_e = 1 AND nombre_empaque LIKE '%$empaque%' ORDER BY nombre_empaque ASC";
					$resultado = mysql_query($consulta);
					while($row = mysql_fetch_array($resultado)){ ?>
						<tr>
							<td class="centro"><?php echo $cont; ?></td>
			          		<td><?php echo $row['nombre_empaque']; ?></td>
				        	<td class="derecha">
				        		<button class="btn btn-success" onClick="seleccionarEmapque(<?php echo $row['id_empaque']; ?>, '<?php echo $row['nombre_empaque']; ?>');"><i class="glyphicon glyphicon-ok"></i> Seleccionar</button>
				        	</td>
				        	<?php $cont++; ?>
			    	    </tr>
					<?php }
				?>
			</tbody>
		</table>
	</body>
</html>
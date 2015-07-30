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
						<th class="centro">ID</th>
						<th>Nombre del Chofer</th>
						<th class="centro">Placas</th>
						<th class="centro">Marca</th>
						<th class="centro">Modelo</th>
						<th>Descripción</th>
						<th class="centro">Disponibilidad</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$camion = $_POST['camion'];

						include('../../mod/conexion.php');

						$consulta = "SELECT id_distribuidor_fk FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
	      				$resultado = mysql_query($consulta);
	      				$row = mysql_fetch_array($resultado);
	      				$idDistribuidorFK = $row['id_distribuidor_fk'];

						$cont = 1;
						$consulta = "SELECT * FROM camiones_distribuidor WHERE id_distribuidor_fk = $idDistribuidorFK AND (nombre_chofer_camion_distribuidor LIKE '%$camion%' OR placas_camion_distribuidor LIKE '%$camion%' OR marca_camion_distribuidor LIKE '%$camion%' OR modelo_camion_distribuidor LIKE '%$camion%') ORDER BY nombre_chofer_camion_distribuidor ASC";
						$resultado = mysql_query($consulta);
						while($row = mysql_fetch_array($resultado)){ ?>
							<tr>
				          		<td class="centro"><?php echo $cont; ?></td>
				          		<td class="centro"><?php echo $placas = $row['id_camion_distribuidor']; ?></td>
				          		<td><?php echo $row['nombre_chofer_camion_distribuidor']; ?></td>
				          		<td class="centro"><?php echo $placas = $row['placas_camion_distribuidor']; ?></td>
				          		<td class="centro"><?php echo $row['marca_camion_distribuidor']; ?></td>
				          		<td class="centro"><?php echo $row['modelo_camion_distribuidor']; ?></td>
				          		<td>
				          			<?php 
				          				$descripcion = $row['descripcion_camion_distribuidor'];
				          				if(strlen($descripcion) > 20)
				          					echo substr($descripcion, 0, 20)."...";
				          				else
				          					echo $descripcion;
				          			?>
				          		</td>
				          		<?php 
				          			$estadoCamion = $row['estado_camion_distribuidor'];
				          			if($estadoCamion == 1){
				          				if($row['disponibilidad_camion_distribuidor'] == 0)
				          					echo "<td class='centro concretado'>DISPONIBLE</td>";
				          				else
				          					echo "<td class='centro cancelado'>OCUPADO</td>";
				          			}
			          				else
			          					echo "<td class='centro cancelado'>DADO DE BAJA</td>";
			          			?>
				          		<td class="derecha">
				          			<?php 
				          				$idCamionDist = $row['id_camion_distribuidor'];
				          			?>
				          			<button class="btn btn-primary btn-editar" data-toggle="tooltip" data-placement="top" title="Editar camion" onClick="editarCamion(<?php echo $idCamionDist; ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
					        		<?php 
				        				if($estadoCamion == 0){ ?>
					        				<button class="btn btn-success btn-alta" data-toggle="tooltip" data-placement="top" title="Dar de alta" onClick="altaCamion(<?php echo $idCamionDist; ?>, '<?php echo $placas; ?>')"><i class="glyphicon glyphicon-ok"></i></button>
				          				<?php } else{ ?>
				          					<button class="btn btn-danger btn-baja" data-toggle="tooltip" data-placement="top" title="Dar de baja" onClick="bajaCamion(<?php echo $idCamionDist; ?>, '<?php echo $placas; ?>')"><i class="glyphicon glyphicon-remove"></i></button>
				          				<?php }
					        		?>
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
					<strong>Sin resultados...</strong> No se encontraron coincidencias para "<?php echo $camion; ?>".
				</div>
			<?php } ?>

			<?php 
				mysql_close();
			?>
		</div>
		
		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
			$('.btn-editar').tooltip();
			$('.btn-alta').tooltip();
			$('.btn-baja').tooltip();
		</script>
	</body>
</html>
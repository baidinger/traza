<div class="contenedor-form">		
	<div class="modal-header">
		<h3 class="modal-title">
			<img class="img-header" src="img/distribuidor.png"> Información del camión
		</h3>
	</div>

<?php
			include('../mod/conexion.php');
			$consulta = "SELECT * from camiones_distribuidor, empresa_distribuidores where id_distribuidor = id_distribuidor_fk AND id_camion_distribuidor = $id ORDER BY id_camion_distribuidor ASC";
			//$consulta = "SELECT * FROM empresa_distribuidores, usuario_empaque WHERE id_receptor = id_usuario_que_registro AND id_distribuidor = ".$id;
			$resultado = mysql_query($consulta);
			if(mysql_num_rows($resultado) == 0) {  ?>
			<div class="alert alert-danger" style="width : 500px; margin: 50px auto">
				No se encontró un camión de distribuidor con ese ID
			</div>
	<?php	return; }
			$row = mysql_fetch_array($resultado);
		?>
	<div style="width:800px; margin:50px auto;background:#ffffff; padding: 20px; border-radius: 5px">
				<div class="div-contenedor-form">
			      		<div>
			      			
					      	<div>
					      		<table class="table" style="font-size: 14px">
					      			<tbody>
					      				<tr>
					      					<td width="160"><strong>Núm camión:</strong></td>
					      					<td><a href="index.php?camiondist=<?php print $row['id_camion_distribuidor'] ?>"><?php echo str_pad($row['id_camion_distribuidor'], 7,"0",STR_PAD_LEFT); ?></a></td>
					      					<td width="160"><strong>Nombre del chofer:</strong></td>
					      					<td><a href="index.php?camiondist=<?php print $row['id_camion_distribuidor'] ?>"><?php echo $row['nombre_chofer_camion_distribuidor'] ?></a></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Placas:</strong></td>
					      					<td><?php echo $row['placas_camion_distribuidor']; ?></td>
					      					<td><strong>Modelo:</strong></td>
					      					<td><?php echo $row['modelo_camion_distribuidor']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Marca:</strong></td>
					      					<td><?php echo $row['marca_camion_distribuidor']; ?></td>
					      					<td><strong>Descripción:</strong></td>
					      					<td><?php echo $row['descripcion_camion_distribuidor']; ?></td>
					      				</tr>		      				
					      				<tr>
					      					<td><strong>Disponibilidad:</strong></td>
					      					<td><?php echo ($row['disponibilidad_camion_distribuidor'] == 0) ? "<span class='label label-success'>Dispnible</span>" : "<span class='label label-danger'>No disponible</span>" ?></td>
					      					<td><strong>Estado:</strong></td>
					      					<td><?php echo ($row['estado_camion_distribuidor'] == 0) ? "<span class='label label-danger'>No activo</span>" : "<span class='label label-success'>Activo</span>" ?></td>
					      				</tr>
					      				<tr>
					      					<td width="160"><strong>Nombre del distribuidor:</strong></td>
					      					<td><a href="index.php?distribuidor=<?php print $row['id_distribuidor'] ?>"><?php echo $row['nombre_distribuidor'] ?></a></td>					      					
					      				</tr>

					      			</tbody>
					      		</table>
					      		<center>
					      			<a style="cursor: hand" onclick="goBack()" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Regresar</a>
					      		</center>
					      	</div>
					    </div>
					<?php
						mysql_close();
					?>
				</div>
		</div>

	
</div>
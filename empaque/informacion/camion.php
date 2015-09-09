<div class="contenedor-form">		
	<div class="modal-header">
		<h3 class="modal-title">
			<img class="img-header" src="img/camion.png"> Información del camión
		</h3>
	</div>

<?php
			include('../mod/conexion.php');
			$consulta = "SELECT * from camiones_empaque where id_camion = $id and id_empaque_fk = ".$_SESSION['id_empaque'] ." ORDER BY id_camion ASC";
			//$consulta = "SELECT * FROM empresa_distribuidores, usuario_empaque WHERE id_receptor = id_usuario_que_registro AND id_distribuidor = ".$id;
			$resultado = mysql_query($consulta);
			if(mysql_num_rows($resultado) == 0) {  ?>
			<div class="alert alert-danger" style="width : 500px; margin: 50px auto">
				No se encontró un camión del empaque con ese ID
			</div>
	<?php	return; }
			$row = mysql_fetch_array($resultado);
		?>
	<div style="width:800px; margin:50px auto;background:#ffffff; padding: 20px; border-radius: 5px">
				<div class="div-contenedor-form">
			      		<div>
			      			
					      	<div>
					      		<table class="table table-hover" style="font-size: 14px">
					      			<tbody>
					      				<tr>
					      					<td width="160"><strong>Núm camión:</strong></td>
					      					<td><a href="index.php?camion=<?php print $row['id_camion'] ?>"><?php echo str_pad($row['id_camion'], 7,"0",STR_PAD_LEFT); ?></a></td>
					      					<td width="160"><strong>Nombre del chofer:</strong></td>
					      					<td><a href="index.php?camion=<?php print $row['id_camion'] ?>"><?php echo $row['nombre_chofer'] ?></a></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Placas:</strong></td>
					      					<td><?php echo $row['placas']; ?></td>
					      					<td><strong>Modelo:</strong></td>
					      					<td><?php echo $row['modelo']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Marca:</strong></td>
					      					<td><?php echo $row['marca']; ?></td>
					      					<td><strong>Descripción:</strong></td>
					      					<td><?php echo $row['descripcion_camion']; ?></td>
					      				</tr>		      				
					      				<tr>
					      					<td><strong>Disponibilidad:</strong></td>
					      					<td><?php echo ($row['disponibilidad_ce'] == 0) ? "<span class='label label-success'>Dispnible</span>" : "<span class='label label-danger'>No disponible</span>" ?></td>
					      					<td><strong>Estado:</strong></td>
					      					<td><?php echo ($row['estado_ce'] == 0) ? "<span class='label label-danger'>No activo</span>" : "<span class='label label-success'>Activo</span>" ?></td>
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
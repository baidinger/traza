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
						<th class="centro">ID</th>
						<th>Empaque</th>
						<th class="centro">Fecha</th>
						<th class="derecha">Costo</th>
						<th class="centro">Env / Rec</th>
						<th class="centro">Estado</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$empaque = $_POST['empaque'];

						include('../../mod/conexion.php');

						$consulta = "SELECT id_distribuidor_fk, id_usuario_distribuidor FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
						$resultado = mysql_query($consulta);
						$row = mysql_fetch_array($resultado);
						$id_distribuidor_fk = $row['id_usuario_distribuidor'];

						$cont = 0;
						$verAcciones = 0;
					    $consulta = "SELECT ords.id_orden, epqs.id_empaque, epqs.nombre_empaque, ords.fecha_entrega_orden, ords.costo_orden, ords.estado_orden FROM ordenes_distribuidor AS ords, empresa_empaques AS epqs WHERE ords.id_empaque_fk = epqs.id_empaque AND ords.id_usuario_distribuidor_fk = $id_distribuidor_fk AND epqs.nombre_empaque LIKE '%$empaque%' ORDER BY ords.id_orden DESC";
						$resultado = mysql_query($consulta);
						while($row = mysql_fetch_array($resultado)){ 

							$consulta4 = "SELECT id_envio FROM envios_empaque WHERE id_orden_fk = ".$row['id_orden']." LIMIT 1";
							$resultado4 = mysql_query($consulta4);
							while($row4 = mysql_fetch_array($resultado4)){
								$idEnvioFk = $row4['id_envio'];	

								$consulta2 = "SELECT epc_caja FROM distribuidor_cajas_envio WHERE recibido_dce = 1 AND id_envio_fk = $idEnvioFk LIMIT 1";
								$resultado2 = mysql_query($consulta2);
								while($row2 = mysql_fetch_array($resultado2)){ 

									$consulta3 = "SELECT COUNT(epc_caja) AS total_enviados FROM distribuidor_cajas_envio WHERE enviado_dce = 1 AND id_envio_fk = $idEnvioFk";
									$resultado3 = mysql_query($consulta3);
									$row3 = mysql_fetch_array($resultado3);
									$totalEnviados = $row3['total_enviados'];

									$consulta3 = "SELECT COUNT(epc_caja) AS total_recibidos FROM distribuidor_cajas_envio WHERE recibido_dce = 1 AND id_envio_fk = $idEnvioFk";
									$resultado3 = mysql_query($consulta3);
									$row3 = mysql_fetch_array($resultado3);
									$totalRecibidos = $row3['total_recibidos']; ?>

									<tr>
						          		<td class="centro"><?php echo $row['id_orden']; ?></td>
						          		<td>
						          			<?php 
						          				$idEmpaque = $row['id_empaque'];

						          				$consulta2 = "SELECT * FROM empresa_empaques WHERE id_empaque = $idEmpaque";
						          				$resultado2 = mysql_query($consulta2);
						          				$row2 = mysql_fetch_array($resultado2);
						          			?>
						          			<a href="#" class="popover-empaque" 
						          				tabindex="0"
						          				data-toggle="popover"
						          				data-placement="right"
						          				data-trigger="focus"
						          				data-container="body"
						          				data-html="true"
						          				title="<center><strong><?php echo $row2['nombre_empaque']; ?></strong></center>"
						          				data-content="<table class='table'>
						          								<tr>
						          									<td><strong>RFC: </strong></td>
						          									<td><?php echo $row2['rfc_empaque']; ?></td>
						          								</tr>
						          								<tr>
						          									<td><strong>Ciudad: </strong></td>
						          									<td><?php echo $row2['ciudad_empaque']; ?></td>
						          								</tr>
						          								<tr>
						          									<td><strong>Dirección: </strong></td>
						          									<td><?php echo $row2['direccion_empaque']; ?></td>
						          								</tr>
						          								<tr>
						          									<td><strong>Teléfono: </strong></td>
						          									<td><?php echo $row2['telefono1_empaque']; ?></td>
						          								</tr>
						          								<tr>
						          									<td><strong>Email: </strong></td>
						          									<td><?php echo $row2['email_empaque']; ?></td>
						          								</tr>
						          							  <table>">
						          				<?php echo $row['nombre_empaque']; ?>
						          			</a>
						          		</td>
						          		<td class="centro"><?php echo $row['fecha_entrega_orden']; ?></td>
						          		<td class="derecha"><?php echo "$ ".number_format($row['costo_orden'], 2, '.', ','); ?></td>
						          		<td class="centro"><?php echo $totalEnviados." / ".$totalRecibidos; ?></td>
						          		<?php
					          				$estado = $row['estado_orden'];

					          				switch($estado) {
					          					case '1': echo "<td class='centro pendiente'>PENDIENTE</td>"; 	$verAcciones = 0; break;
					          					case '2': echo "<td class='centro rechazado'>RECHAZADO</td>"; 	$verAcciones = 0; break;
					          					case '3': echo "<td class='centro enviado'>ENVIADO</td>"; 		$verAcciones = 1; break;
					          					case '4': echo "<td class='centro concretado'>CONCRETADO</td>"; $verAcciones = 0; break;
					          					case '5': echo "<td class='centro cancelado'>CANCELADO</td>";	$verAcciones = 0; break;
					          					case '6': echo "<td class='centro aprobado'>APROBADO</td>"; 	$verAcciones = 0; break;
					          				}
					          			?>
						          		<td class="derecha">
						          			<!-- <button class="btn btn-info" id="btn-detalles" onClick="mostrarDetalles(<?php echo $row['id_orden']; ?>)" data-toggle="tooltip" title="Ver detalles epcs"><i class="glyphicon glyphicon-tags"></i></button> -->
						          			<button class="btn btn-info" id="btn-detalles" onClick="mostrarDetalles(<?php echo $idEnvioFk; ?>)" data-toggle="tooltip" title="Ver detalles epcs"><i class="glyphicon glyphicon-tags"></i></button>
						          			<?php
						          				if($verAcciones == 1){ ?>
						          					<button class="btn btn-danger" id="btn-cancelar" onClick="cambiarEstadoOrden('rechazar', 5, <?php echo $row['id_orden']; ?>)" data-toggle="tooltip" title="Rechazar orden"><i class="glyphicon glyphicon-remove"></i></button>
							        				<!-- <button class="btn btn-success" id="btn-concretar" onClick="cambiarEstadoOrden('concretar', 4, <?php echo $row['id_orden']; ?>)" data-toggle="tooltip" title="Concretar orden"><i class="glyphicon glyphicon-ok"></i></button> -->
						          				<?php }
						          			?>
							        	</td>
						    	    </tr>
							<?php 
									$cont++; 
								}
							}
						}
					?>
				</tbody>
			</table>

			<?php if($cont > 0){ ?>
				<div class="my-navigation" style="margin: 0px auto;">
					<div class="simple-pagination-page-numbers"></div>
					<br><br><br>
				</div>
			<?php } else{ ?>
				<div class="alert alert-info" role="alert" style="text-align: center;">
					<strong>Sin resultados...</strong> No se encontraron coincidencias para "<?php echo $empaque; ?>".
				</div>
			<?php } ?>

			<?php 
				mysql_close();
			?>
		</div>
		
		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
			$('.popover-empaque').popover();
			$('#btn-detalles').tooltip();
			// $('#btn-concretar').tooltip();
			$('#btn-cancelar').tooltip();
		</script>
	</body>
</html>
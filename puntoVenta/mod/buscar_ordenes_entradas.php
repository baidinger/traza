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
						<th>Distribuidor</th>
						<th class="centro">Fecha</th>
						<th class="derecha">Costo</th>
						<th class="centro">Env / Rec</th>
						<th class="centro">Estado</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$distribuidor = $_POST['distribuidor'];

						include('../../mod/conexion.php');

						// $consulta = "SELECT id_usuario_pv FROM usuario_punto_venta WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
						// $resultado = mysql_query($consulta);
						// $row = mysql_fetch_array($resultado);
						// $idUsuarioPvFK = $row['id_usuario_pv'];

						$consulta = "SELECT id_punto_venta_fk FROM usuario_punto_venta WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
						$resultado = mysql_query($consulta);
						$row = mysql_fetch_array($resultado);
						$idUsuarioPvFK = $row['id_punto_venta_fk'];

						$cont = 0;
					    $consulta = "SELECT ords.id_orden, epqs.id_distribuidor, epqs.nombre_distribuidor, ords.fecha_entrega_orden, ords.costo_orden, ords.estado_orden FROM ordenes_punto_venta AS ords, empresa_distribuidores AS epqs WHERE ords.id_distribuidor_fk = epqs.id_distribuidor AND ords.id_usuario_punto_venta_fk = $idUsuarioPvFK AND epqs.nombre_distribuidor LIKE '%$distribuidor%'";
						$resultado = mysql_query($consulta);
						while($row = mysql_fetch_array($resultado)){ 

							$consulta4 = "SELECT id_envio FROM envios_distribuidor WHERE id_orden_dist_fk = ".$row['id_orden']." LIMIT 1";
							$resultado4 = mysql_query($consulta4);
							while($row4 = mysql_fetch_array($resultado4)){
								$idEnvioFk = $row4['id_envio'];	

								$consulta2 = "SELECT epc_caja FROM punto_venta_cajas_envio WHERE recibido_dce = 1 AND id_envio_fk = $idEnvioFk LIMIT 1";
								$resultado2 = mysql_query($consulta2);
								while($row2 = mysql_fetch_array($resultado2)){ 

									$consulta3 = "SELECT COUNT(epc_caja) AS total_enviados FROM punto_venta_cajas_envio WHERE enviado_dce = 1 AND id_envio_fk = $idEnvioFk";
									$resultado3 = mysql_query($consulta3);
									$row3 = mysql_fetch_array($resultado3);
									$totalEnviados = $row3['total_enviados'];

									$consulta3 = "SELECT COUNT(epc_caja) AS total_recibidos FROM punto_venta_cajas_envio WHERE recibido_dce = 1 AND id_envio_fk = $idEnvioFk";
									$resultado3 = mysql_query($consulta3);
									$row3 = mysql_fetch_array($resultado3);
									$totalRecibidos = $row3['total_recibidos']; ?>

									<tr>
										<td class="centro"><?php echo $row['id_orden']; ?></td>
						          		<td>
						          			<?php 
						          				$idDistribuidor = $row['id_distribuidor'];

						          				$consulta2 = "SELECT * FROM empresa_distribuidores WHERE id_distribuidor = $idDistribuidor";
						          				$resultado2 = mysql_query($consulta2);
						          				$row2 = mysql_fetch_array($resultado2);
						          			?>
						          			<a href="#" class="popover-distribuidor" 
						          				tabindex="0"
						          				data-toggle="popover"
						          				data-placement="right"
						          				data-trigger="focus"
						          				data-container="body"
						          				data-html="true"
						          				title="<center><strong><?php echo $row2['nombre_distribuidor']; ?></strong></center>"
						          				data-content="<table class='table'>
						          								<tr>
						          									<td><strong>RFC: </strong></td>
						          									<td><?php echo $row2['rfc_distribuidor']; ?></td>
						          								</tr>
						          								<tr>
						          									<td><strong>Ciudad: </strong></td>
						          									<td><?php echo $row2['ciudad_distribuidor']; ?></td>
						          								</tr>
						          								<tr>
						          									<td><strong>Dirección: </strong></td>
						          									<td><?php echo $row2['direccion_distribuidor']; ?></td>
						          								</tr>
						          								<tr>
						          									<td><strong>Teléfono(s): </strong></td>
						          									<td><?php echo $row2['tel1_distribuidor'].' / '.$row2['tel2_distribuidor']; ?></td>
						          								</tr>
						          								<tr>
						          									<td><strong>Email: </strong></td>
						          									<td><?php echo $row2['email_distribuidor']; ?></td>
						          								</tr>
						          							  <table>">
						          				<?php echo $row['nombre_distribuidor']; ?>
						          			</a>
						          		</td>
						          		<td class="centro"><?php echo $row['fecha_entrega_orden']; ?></td>
						          		<td class="derecha"><?php echo "$ ".number_format($row['costo_orden'], 2, '.', ','); ?></td>
						          		<td class="centro"><?php echo $totalEnviados." / ".$totalRecibidos; ?></td>

						          		<?php
					          				$estado = $row['estado_orden'];

					          				switch($estado) {
					          					case '1': echo "<td class='centro pendiente'>PENDIENTE</td>"; break;
					          					case '2': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR EMPAQUE'>RECHAZADO</span></td>"; break;
					          					case '3': echo "<td class='centro enviado'><span class='link-estado' onclick='cambiarEstadoOrden(".$row['id_orden'].")'>ENVIADO</span></td>"; break;
					          					case '4': echo "<td class='centro concretado'>CONCRETADO</td>"; break;
					          					case '5': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR EMPAQUE'>CANCELADO</span></td>"; break;
					          					case '6': echo "<td class='centro aprobado'>APROBADO</td>"; break;
					          					case '7': echo "<td class='centro pendiente'>PRE-ENVIO</td>"; break;
					          					case '8': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR DISTRIBUIDOR'>CANCELADO</span></td>"; break;
					          					case '9': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR DISTRIBUIDOR'>RECHAZADO</span></td>"; break;
					          					case '10': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR PUNTO DE VENTA'>CANCELADO</span></td>"; break;
					          					case '11': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR PUNTO DE VENTA'>RECHAZADO</span></td>"; break;
					          				}
					          			?>
						          		
						          		<td class="derecha">
						          			<button class="btn btn-info" id="btn-detalles" onClick="mostrarDetalles(<?php echo $idEnvioFk; ?>)" data-toggle="tooltip" title="Ver detalles epcs"><i class="glyphicon glyphicon-tags"></i></button>
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
					<strong>Sin resultados...</strong> No se encontraron coincidencias para "<?php echo $distribuidor; ?>".
				</div>
			<?php } ?>

			<?php 
				mysql_close();
			?>
		</div>
		
		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
			$('.popover-distribuidor').popover();
			$('.popover-estado').popover();
		</script>
	</body>
</html>
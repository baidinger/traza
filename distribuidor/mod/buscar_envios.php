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
						<th class="centro">Env</th>
						<th class="centro">Ped</th>
						<th>Punto de Venta</th>
						<th class="centro">Fecha Envio</th>
						<th class="centro">Fecha Entrega</th>
						<!-- <th class="centro">Camión</th> -->
						<th class="centro">Estado</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$puntoVenta = $_POST['puntoventa'];

						include('../../mod/conexion.php');

						$consulta = "SELECT id_distribuidor_fk FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
						$resultado = mysql_query($consulta);
						$row = mysql_fetch_array($resultado);
						$id_distribuidor_fk = $row['id_distribuidor_fk'];

						$cont = 0;
						$cancelar = 1;
					    $consulta = "SELECT envdis.id_envio, envdis.id_orden_dist_fk, mpsapv.id_punto_venta, mpsapv.nombre_punto_venta, envdis.fecha_envio, envdis.hora_envio, envdis.fecha_entrega_envio, envdis.id_camion_fk, envdis.estado_envio FROM ordenes_punto_venta AS ordspv, empresa_punto_venta AS mpsapv, envios_distribuidor AS envdis WHERE envdis.id_orden_dist_fk = ordspv.id_orden AND envdis.id_punto_venta_fk = mpsapv.id_punto_venta AND ordspv.id_distribuidor_fk = $id_distribuidor_fk AND mpsapv.nombre_punto_venta LIKE '%$puntoVenta%' ORDER BY envdis.id_envio DESC";
						$resultado = mysql_query($consulta);
						while($row = mysql_fetch_array($resultado)){ ?>
							<tr>
								<td class="centro"><?php echo $row['id_envio']; ?></td>
				          		<td class="centro"><?php echo $row['id_orden_dist_fk']; ?></td>
				          		<td>
				          			<?php 
				          				$idPuntoVenta = $row['id_punto_venta'];

				          				$consulta2 = "SELECT * FROM empresa_punto_venta WHERE id_punto_venta = $idPuntoVenta";
				          				$resultado2 = mysql_query($consulta2);
				          				$row2 = mysql_fetch_array($resultado2);
				          			?>
				          			<a href="#" class="popover-punto-venta" 
				          				tabindex="0"
				          				data-toggle="popover"
				          				data-placement="right"
				          				data-trigger="focus"
				          				data-container="body"
				          				data-html="true"
				          				title="<center><strong><?php echo $row2['nombre_punto_venta']; ?></strong></center>"
				          				data-content="<table class='table'>
				          								<tr>
				          									<td><strong>RFC: </strong></td>
				          									<td><?php echo $row2['rfc_punto_venta']; ?></td>
				          								</tr>
				          								<tr>
				          									<td><strong>Ciudad: </strong></td>
				          									<td><?php echo $row2['ciudad_punto_venta']; ?></td>
				          								</tr>
				          								<tr>
				          									<td><strong>Dirección: </strong></td>
				          									<td><?php echo $row2['direccion_punto_venta']; ?></td>
				          								</tr>
				          								<tr>
				          									<td><strong>Teléfono: </strong></td>
				          									<td><?php echo $row2['telefono_punto_venta']; ?></td>
				          								</tr>
				          								<tr>
				          									<td><strong>Email: </strong></td>
				          									<td><?php echo $row2['email_punto_venta']; ?></td>
				          								</tr>
				          							  <table>">
				          				<?php echo $row['nombre_punto_venta']; ?>
				          			</a>
				          		</td>
				          		<td class="centro"><?php echo date('d/m/Y', strtotime($row['fecha_envio'])); ?></td>
				          		<td class="centro"><?php echo date('d/m/Y', strtotime($row['fecha_entrega_envio'])); ?></td>
				          		<!-- <td class="centro"><a href="../camiones/"><?php echo $row['id_camion_fk']; ?></a></td> -->
				          		<?php
			          				$estado = $row['estado_envio'];

			          				switch($estado) {
			          					case '1': echo "<td class='centro pendiente'><span class='link-estado' onclick='cancelarOrden(".$row['id_envio'].")'>PENDIENTE</span></td>"; break;
			          					case '2': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR EMPAQUE'>RECHAZADO</span></td>"; break;
			          					case '3': echo "<td class='centro enviado'><span class='link-estado' onclick='cancelarOrden(".$row['id_envio'].")'>ENVIADO</span></td>"; break;
			          					case '4': echo "<td class='centro concretado'>CONCRETADO</td>"; break;
			          					case '5': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR EMPAQUE'>CANCELADO</span></td>"; break;
			          					case '6': echo "<td class='centro aprobado'><span class='link-estado' onclick='cancelarOrden(".$row['id_envio'].")'>APROBADO</span></td>"; break;
			          					case '7': echo "<td class='centro pendiente'>PRE-ENVIO</td>"; break;
			          					case '8': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR DISTRIBUIDOR'>CANCELADO</span></td>"; break;
			          					case '9': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR DISTRIBUIDOR'>RECHAZADO</span></td>"; break;
			          					case '10': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR PUNTO DE VENTA'>CANCELADO</span></td>"; break;
			          					case '11': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR PUNTO DE VENTA'>RECHAZADO</span></td>"; break;
			          				}
			          			?>
				          		<td class="derecha">
				          			<button class="btn btn-info" id="btn-epcs" onClick="mostrarDetallesEPCs(<?php echo $row['id_envio']; ?>)" data-toggle="tooltip" title="Ver detalles epcs"><i class="glyphicon glyphicon-tags"></i></button>
					        	</td>
				    	    </tr>
						<?php $cont++; 
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
					<strong>Sin resultados...</strong> No se encontraron coincidencias para "<?php echo $puntoVenta; ?>".
				</div>
			<?php } ?>

			<?php 
				mysql_close();
			?>
		</div>
		
		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
			$('.popover-punto-venta').popover();
			$('.popover-estado').popover();
		</script>
	</body>
</html>
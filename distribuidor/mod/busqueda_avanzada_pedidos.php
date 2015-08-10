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
						<th>Punto de Venta</th>
						<th class="centro">Fecha Orden</th>
						<th class="centro">Fecha Entrega</th>
						<th class="derecha">Total</th>
						<th class="centro">Estado</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$puntoVenta = $_POST['puntoventa'];
						$estado  = $_POST['estado'];
						$fecha1  = $_POST['fecha1'];
						$fecha2  = $_POST['fecha2'];
						$costo1  = $_POST['costo1'];
						$costo2  = $_POST['costo2'];

						include('../../mod/conexion.php');

						$consulta = "SELECT id_distribuidor_fk FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
						$resultado = mysql_query($consulta);
						$row = mysql_fetch_array($resultado);
						$id_distribuidor_fk = $row['id_distribuidor_fk'];

						$consulta = "SELECT ordspv.id_orden, mpsapv.id_punto_venta, mpsapv.nombre_punto_venta, ordspv.fecha_orden, ordspv.fecha_entrega_orden, ordspv.costo_orden, ordspv.estado_orden FROM ordenes_punto_venta AS ordspv, usuario_punto_venta AS ususpv, empresa_punto_venta AS mpsapv WHERE ordspv.id_usuario_punto_venta_fk = ususpv.id_usuario_pv AND ususpv.id_usuario_pv = mpsapv.id_punto_venta AND ordspv.id_distribuidor_fk = $id_distribuidor_fk";

						if(!empty($puntoVenta))
							$consulta.= " AND mpsapv.nombre_punto_venta LIKE '%$puntoVenta%'";

						if($estado != 0)
							$consulta.= " AND ordspv.estado_orden = $estado";

						if(!empty($fecha1) && !empty($fecha2))
							$consulta.= " AND ordspv.fecha_orden BETWEEN '$fecha1' AND '$fecha2'";

						if(strlen($costo1) != 0 && strlen($costo2) != 0)
							$consulta.= " AND ordspv.costo_orden BETWEEN '$costo1' AND '$costo2'";

						$consulta.=" ORDER BY ordspv.id_orden DESC";

						$cont = 0;
					    // $consulta = "SELECT ordspv.id_orden, mpsapv.id_punto_venta, mpsapv.nombre_punto_venta, ordspv.fecha_orden, ordspv.fecha_entrega_orden, ordspv.costo_orden, ordspv.estado_orden FROM ordenes_punto_venta AS ordspv, usuario_punto_venta AS ususpv, empresa_punto_venta AS mpsapv WHERE ordspv.id_usuario_punto_venta_fk = ususpv.id_usuario_pv AND ususpv.id_usuario_pv = mpsapv.id_punto_venta AND ordspv.id_distribuidor_fk = $id_distribuidor_fk AND mpsapv.nombre_punto_venta LIKE '%$puntoVenta%' ORDER BY ordspv.id_orden DESC";
						$resultado = mysql_query($consulta);
						while($row = mysql_fetch_array($resultado)){ ?>
							<tr>
				          		<td class="centro"><?php echo $row['id_orden']; ?></td>
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
				          		<!-- <td><?php echo $row['nombre_punto_venta']; ?></td> -->
				          		<td class="centro"><?php echo date('d/m/Y', strtotime($row['fecha_orden'])); ?></td>
				          		<td class="centro"><?php echo date('d/m/Y', strtotime($row['fecha_entrega_orden'])); ?></td>
				          		<td class="derecha"><?php echo "$ ".number_format($row['costo_orden'], 2, '.', ','); ?></td>
				          		<?php 
				          			$estado = $row['estado_orden'];
				          		?>
				          		<?php
			          				switch($estado) {
			          					case '1': echo "<td class='centro pendiente'><span class='link-estado' onclick='mostrarModalEstado(".$row['id_orden'].", 1, 1)'>PENDIENTE</span></td>"; break;
			          					case '2': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR EMPAQUE'>RECHAZADO</span></td>"; break;
			          					case '3': echo "<td class='centro enviado'><span class='link-estado' onclick='mostrarModalEstado(".$row['id_orden'].", 2, 3)'>ENVIADO</span></td>"; break;
			          					case '4': echo "<td class='centro concretado'>CONCRETADO</td>"; break;
			          					case '5': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR EMPAQUE'>CANCELADO</span></td>"; break;
			          					case '6': echo "<td class='centro aprobado'><span class='link-estado' onclick='mostrarModalEstado(".$row['id_orden'].", 2, 6)'>APROBADO</span></td>"; break;
			          					case '7': echo "<td class='centro pendiente'>PRE-ENVIO</td>"; break;
			          					case '8': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR DISTRIBUIDOR'>CANCELADO</span></td>"; break;
			          					case '9': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR DISTRIBUIDOR'>RECHAZADO</span></td>"; break;
			          					case '10': echo "<td class='centro cancelado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='CANCELADO POR PUNTO DE VENTA'>CANCELADO</span></td>"; break;
			          					case '11': echo "<td class='centro rechazado'><span class='popover-estado link-estado' tabindex='0' data-toggle='popover' data-placement='top' data-trigger='focus' data-container='body' data-content='RECHAZADO POR PUNTO DE VENTA'>RECHAZADO</span></td>"; break;
			          				}
			          			?>
				          		<td class="derecha">
					        		<button class="btn btn-primary" onClick="mostrarDetalles(<?php echo $row['id_orden']; ?>)">Detalles</button>
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
					<strong>Sin resultados...</strong> No se encontraron coincidencias.
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
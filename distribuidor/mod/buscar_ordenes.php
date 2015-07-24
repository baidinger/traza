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
					    $consulta = "SELECT ords.id_orden, epqs.nombre_empaque, ords.fecha_entrega_orden, ords.costo_orden, ords.estatus_orden FROM ordenes_distribuidor AS ords, empresa_empaques AS epqs WHERE ords.id_empaque_fk = epqs.id_empaque AND ords.id_usuario_distribuidor_fk = $id_distribuidor_fk AND epqs.nombre_empaque LIKE '%$empaque%' ORDER BY ords.id_orden DESC";
						$resultado = mysql_query($consulta);
						while($row = mysql_fetch_array($resultado)){ ?>
							<tr>
				          		<td class="centro"><?php echo $row['id_orden']; ?></td>
				          		<td><?php echo $row['nombre_empaque']; ?></td>
				          		<td class="centro"><?php echo $row['fecha_entrega_orden']; ?></td>
				          		<td class="derecha"><?php echo "$ ".number_format($row['costo_orden'], 2, '.', ',')	; ?></td>
			          			<?php
			          				$estado = $row['estatus_orden'];

			          				switch($estado) {
			          					case '1': echo "<td class='centro pendiente'><span class='link-estado' onclick='mostrarModalEstado(".$row['id_orden'].")'>PENDIENTE</span></td>"; break;
			          					case '2': echo "<td class='centro rechazado'>RECHAZADO</td>"; break;
			          					case '3': echo "<td class='centro enviado'>ENVIADO</td>"; break;
			          					case '4': echo "<td class='centro concretado'>CONCRETADO</td>"; break;
			          					case '5': echo "<td class='centro cancelado'>CANCELADO</td>"; break;
			          					case '6': echo "<td class='centro aprobado'>APROBADO</td>"; break;
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
					<strong>Sin resultados...</strong> No coincidencias para "<?php echo $empaque; ?>".
				</div>
			<?php } ?>

			<?php 
				mysql_close();
			?>
		</div>
		
		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
		</script>
	</body>
</html>
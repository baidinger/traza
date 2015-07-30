<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<div id="paginacion-resultados-epcs">
			<?php 
				$idOrdenFk = $_POST['orden'];
				$idEnvioFk = $_POST['envio'];

				include('../../mod/conexion.php');

				$consulta = "SELECT envepq.id_camion_fk, entdist.fecha_entrada, entdist.hora_entrada FROM envios_empaque AS envepq, entrada_distribuidor AS entdist WHERE envepq.id_envio = $idEnvioFk AND envepq.id_orden_fk = $idOrdenFk AND envepq.id_orden_fk = entdist.id_orden_fk";
				$resultado = mysql_query($consulta);
				$row = mysql_fetch_array($resultado);

				$idCamionFk = $row['id_camion_fk'];
				$fechaEntrada = $row['fecha_entrada'];
				$horaEntrada = $row['hora_entrada'];
			?>
			<table class="table">
				<tr>
					<td><label class="lbl-nueva-orden">Camión:</label></td>
					<td><label class="lbl-nueva-orden"><a href="../camiones/" class="lbl-nueva-orden"><?php echo $idCamionFk; ?></a></label></td>
					<td class="derecha"><label class="lbl-nueva-orden">Fecha:</label></td>
					<td><input type="date" class="form-control" value="<?php echo $fechaEntrada; ?>" readonly></td>
					<td class="derecha"><label class="lbl-nueva-orden">Hora:</label></td>
					<td><input type="time" class="form-control" value="<?php echo $horaEntrada; ?>" readonly></td>
				</tr>
			</table>
			<table class="table">
				<thead>
					<tr>
						<th class="centro">#</th>
						<th class="centro">Pallet</th>
						<th class="centro">Caja</th>
						<th class="centro">Enviado</th>
						<th class="centro">Recibido</th>
					</tr>
				</thead>

				<tbody>
					<?php
						$cont = 1;
						// $consulta = "SELECT * FROM distribuidor_cajas_envio WHERE id_orden_fk = $idOrden ORDER BY epc_tarima ASC, epc_caja ASC";
						$consulta = "SELECT * FROM distribuidor_cajas_envio WHERE id_envio_fk = $idEnvioFk ORDER BY epc_tarima ASC, epc_caja ASC";
						$resultado = mysql_query($consulta);
						while($row = mysql_fetch_array($resultado)) { ?>
							<tr>
								<td class="centro"><?php echo $cont; ?></td>
								<td class="centro"><?php echo $row['epc_tarima']; ?></td>
								<!-- <td class="centro"><?php echo $row['epc_caja']; ?></td> -->
								<td class="centro"><a href="../trazabilidadCajas/?epc_caja=<?php echo $row['epc_caja']; ?>" class="btn btn-link"><?php echo $row['epc_caja']; ?></a> </td>
								<?php 
									$enviado = $row['enviado_dce'];
									$recibido = $row['recibido_dce'];

									if($enviado == 1)
										echo "<td class='centro'><i class='glyphicon glyphicon-ok'></i></td>";
									else
										echo "<td class='centro alert alert-danger'><i class='glyphicon glyphicon-remove'></i></td>";

									if($recibido == 1)
										echo "<td class='centro'><i class='glyphicon glyphicon-ok'></i></td>";
									else
										echo "<td class='centro alert alert-danger'><i class='glyphicon glyphicon-remove'></i></td>";
								?>
							</tr>
						<?php 
							$cont++;
						}

						mysql_close();
					?>
				</tbody>
			</table>
			<div class="my-navigation" style="margin: 0px auto;">
				<div class="simple-pagination-page-numbers"></div>
				<br><br>
			</div>
		</div>

		<script type="text/javascript">
			$('#paginacion-resultados-epcs').simplePagination();
		</script>
	</body>
</html>
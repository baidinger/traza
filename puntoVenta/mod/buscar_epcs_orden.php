<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<?php 
			$idEnvio = $_POST['envio'];

			include('../../mod/conexion.php');
			
			$consulta = "SELECT envdist.id_camion_fk, entpv.fecha_entrada_punto_venta, entpv.hora_entrada_punto_venta FROM envios_distribuidor AS envdist, entrada_punto_venta AS entpv WHERE envdist.id_envio = $idEnvio AND envdist.id_envio = entpv.id_envio_fk";
			$resultado = mysql_query($consulta);
			$row = mysql_fetch_array($resultado);

			$idCamionFk = $row['id_camion_fk'];
			$fechaEntrada = $row['fecha_entrada_punto_venta'];
			$horaEntrada = $row['hora_entrada_punto_venta'];
		?>
		<table class="table">
			<tr>
				<td><label class="lbl-nueva-orden">Camión:</label></td>
				<td><label class="lbl-nueva-orden"><a href="#" class="lbl-nueva-orden"><?php echo $idCamionFk; ?></a></label></td>
				<td class="derecha"><label class="lbl-nueva-orden">Fecha:</label></td>
				<td><input type="date" class="form-control" value="<?php echo $fechaEntrada; ?>" readonly></td>
				<td class="derecha"><label class="lbl-nueva-orden">Hora:</label></td>
				<td><input type="time" class="form-control" value="<?php echo $horaEntrada; ?>" readonly></td>
			</tr>
		</table>
		<div id="paginacion-resultados-epcs">
			<table class="table">
				<thead>
					<tr>
						<th class="centro">#</th>
						<!-- <th class="centro">Camión</th> -->
						<th class="centro">Caja</th>
						<th class="centro">Enviado</th>
						<th class="centro">Recibido</th>
					</tr>
				</thead>

				<tbody>
					<?php 
						$cont = 1;
						$consulta = "SELECT * FROM punto_venta_cajas_envio WHERE id_envio_fk = $idEnvio ORDER BY id_camion_distribuidor_fk ASC, epc_caja ASC";
						$resultado = mysql_query($consulta);
						while($row = mysql_fetch_array($resultado)) { ?>
							<tr>
								<td class="centro"><?php echo $cont; ?></td>
								<!-- <td class="centro"><?php echo $row['id_camion_distribuidor_fk']; ?></td> -->
								<!-- <td class="centro"><?php echo $row['epc_caja']; ?></td> -->
								<td class="centro"><a href="../trazaEPC/?epc=<?php echo $row['epc_caja']; ?>"><?php echo $row['epc_caja']; ?></a> </td>
								<?php 
									$enviado = $row['enviado_dce'];
									$recibido = $row['recibido_dce'];

									if($enviado == 1)
										echo "<td class='centro alert alert-success'><i class='glyphicon glyphicon-ok'></i></td>";
									else
										echo "<td class='centro alert alert-danger'><i class='glyphicon glyphicon-remove'></i></td>";

									if($recibido == 1)
										echo "<td class='centro alert alert-success'><i class='glyphicon glyphicon-ok'></i></td>";
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
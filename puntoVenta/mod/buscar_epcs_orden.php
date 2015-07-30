<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<div id="paginacion-resultados-epcs">
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
						$idEnvio = $_POST['orden'];

						include('../../mod/conexion.php');

						$cont = 1;
						$consulta = "SELECT * FROM punto_venta_cajas_envio WHERE id_envio_fk = $idEnvio ORDER BY epc_tarima ASC, epc_caja ASC";
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
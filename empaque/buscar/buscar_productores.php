<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<div id="paginacion">
			<table class="table">
				<thead>
					<th class="centro">#</th>
					<th>RFC</th>
					<th>Nombre del Productor</th>
					<th class="derecha"></th>
				</thead>
				<tbody>
					<?php 
						$productor = $_POST['productor'];

						include('../../mod/conexion.php');

						$cont = 1;
					    $consulta = "SELECT * FROM empresa_productores WHERE estado_p = 1 AND (nombre_productor LIKE '%$productor%' OR rfc_productor LIKE '%$productor%') ORDER BY nombre_productor ASC";
						$resultado = mysql_query($consulta);
						while($row = mysql_fetch_array($resultado)){ ?>
							<tr>
								<td class="centro"><?php echo $cont; ?></td>
								<td><?php echo $row['rfc_productor']; ?></td>
				          		<td><?php echo $row['nombre_productor'] . " " . $row['apellido_productor']; ?></td>
					        	<td class="derecha">
					        		<button class="btn btn-success" data-dismiss="modal" onClick="seleccionarProductor(<?php echo $row['id_productor']; ?>, '<?php echo $row['rfc_productor'] .' - '. $row['nombre_productor'] .' '. $row['apellido_productor']; ?>');"><i class="glyphicon glyphicon-ok"></i></button>
					        	</td>
					        	<?php $cont++; ?>
				    	    </tr>
						<?php }
					?>
				</tbody>
			</table>
			 <?php if($cont > 1){ ?>
					<div class="my-navigation" style="margin: 0px auto;">
					<div class="simple-pagination-page-numbers"></div>
					<br><br><br>
					</div>
				<?php }  ?>
		</div>
		<script type="text/javascript">
		$('#paginacion').simplePagination({
			items_per_page: 5
		});
		</script>
	</body>
</html>
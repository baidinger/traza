<div id="paginacion-resultados" style="width:95%; margin: 0 auto">
		    <table class="table table-hover" style="font-size: 14px">
		    	<thead>
			        <tr>
			          <th>#</th>
			          <th>Núm. Lote</th>
			          <th>Nombre de productor</th>
			          <th>Producto</th>
			          <th>Cant. cajas</th>
			          <th>Cant. kilos</th>
			          <th>Fecha de recibo</th>
			          <th>Costo lote</th>
			         <!-- <th>Rango</th>-->
			          <th>Acción</th>
			        </tr>
	      		</thead>
	      		<tbody>
				<?php
				$buscar = $_POST['buscar'];
				$filtro = $_POST['filtro'];

				include('../../mod/conexion.php');
				$consulta = "select id_lote, id_productor_fk, id_producto_fk, cant_cajas_lote, 
					cant_kilos_lote, remitente_lote, fecha_recibo_lote, hora_recibo_lote, 
					costo_lote, id_empaque_fk, nombre_productor, apellido_productor, 
					nombre_producto, variedad_producto from lotes, productos_productores ,empresa_productores, 
					productos where productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND id_empaque_fk = $_SESSION[id_empaque] AND 
					productos_productores.id_producto_fk = productos.id_producto AND productos_productores.id_productor_fk = empresa_productores.id_productor 
					AND (nombre_productor like '%".$buscar."%' OR apellido_productor like '%".$buscar."%' OR id_lote = '$buscar') $filtro ORDER BY id_lote DESC";
				$result_receptores = mysql_query($consulta);
				$i=1;
				//$result_receptores = mysql_query("select id_receptor, id_usuario, nombre_receptor, apellido_receptor, telefono_receptor, direccion_receptor, nombre_usuario, estado_usuario, nivel_autorizacion_usuario from usuario_empaque, usuarios where usuario_empaque.id_usuario_fk = usuarios.id_usuario AND usuario_empaque.id_empaque_fk = ".$id_empaque." order by nombre_receptor ASC, apellido_receptor ASC" );
				$count  = mysql_num_rows($result_receptores);
				if( $count > 0 ){
					print "<p>Se encontraron " .  $count . " resultados.</p>";
					 while($row = mysql_fetch_array($result_receptores)) {
					 	
					 	?>
					 	<tr>
			        		<td><?php echo $i; ?></td>
			        		<td class="centro"> 
			        			<a  href="index.php?lote=<?php print $row['id_lote'] ?>">
			        				<?php echo str_pad($row['id_lote'],3,"0", STR_PAD_LEFT) ?>
			        			</a>
			        		</td>
				          	<td><a href="index.php?productor=<?php print $row['id_productor_fk'] ?>"> <?php echo $row['nombre_productor'] ." ". $row['apellido_productor']; ?></a></td>
				          	<td><?php echo $row['nombre_producto'] . " - ". $row['variedad_producto']; ?></td>
				          	<td><?php echo $row['cant_cajas_lote']; ?></td>
				          	<td><?php echo $row['cant_kilos_lote']; ?></td>
				          	<td><?php echo $row['fecha_recibo_lote']." a las ".$row['hora_recibo_lote']; ?></td>
				          	<td>$ <?php echo $row['costo_lote']; ?></td>
				          	<!--<td>
				          	  	<?php if( strcmp($row['rango_inicial'],"") != 0) {  ?> <span class="label label-success">Asignado</span> <?php  }  ?>
				          	</td>-->
				          	<td>
				          		
				          		<a onclick="editar(<?php echo $row['id_lote'] ?>,<?php echo $row['id_productor_fk'] ?>)" data-toggle="modal" data-target="#mimodal"  href="#">
				          		<span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
				          		
				          		<a href="index.php?lote=<?php print $row['id_lote'] ?>">
				          		<span class="glyphicon glyphicon-eye-open"></span></a> 
				          	</td>
			        	</tr>
			        <?php  
			        $i=$i+1;
					 }
				}

				  ?>
	          	</tbody>
	        </table>


	        <?php if($i > 1){ ?>
				<div class="my-navigation" style="margin: 0px auto;">
					<div class="simple-pagination-page-numbers"></div>
					<br><br><br>
				</div>
			<?php } else{ ?>
				<div class="alert alert-info" role="alert" style="text-align: center;">
					<strong>Sin resultados...</strong> No hay lotes registrados.
				</div>
			<?php } ?>

	</div>

       
		<script type="text/javascript" src="../lib/pagination/jquery-simple-pagination-plugin.js"></script>

		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
			$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			});
		</script>
		
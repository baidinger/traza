<?php session_start(); if($_SESSION['envios'] != 1) return; 
	include("../../mod/conexion.php");

	$buscar = $_POST['buscar'];

	//PRINT $cadena = "SELECT * FROM ordenes_distribuidor, envios_empaque, usuario_empaque where ordenes_distribuidor.id_orden = envios_empaque.id_orden_fk AND usuario_empaque.id_empaque_fk = ordenes_distribuidor.id_empaque_fk AND usuario_empaque.id_usuario_fk = 51";
	$cadena = "select * from envios_empaque, empresa_distribuidores, ordenes_distribuidor where (nombre_distribuidor like '%$buscar%' or id_orden = '$buscar' or id_envio = '$buscar') AND id_distribuidor = id_distribuidor_fk AND id_orden = id_orden_fk AND id_empaque_fk = ".$_SESSION['id_empaque']." ORDER BY id_envio DESC";
	$result_productores = mysql_query($cadena);
	if(mysql_num_rows($result_productores) > 0){

 ?>

<div id="paginacion-resultados" style="width:95%; margin:0px auto;">
	    <table class="table table-hover">
	    	<thead>
		        <tr>
		          <th class="centro">#</th>
		          <th class="centro">Núm. envío</th>
		          <th class="centro">Núm. camión</th>
		          <th class="centro">Núm. orden</th>
		          <th>Distribuidor</th>
		          <!--<th class="centro">Producto</th>-->
		          
		          <th class="centro">Fecha de envío</th>
		          <th class="centro">Acción</th>
		          <th class="centro">Estado</th>
		          <th></th>
		        </tr>
      		</thead>
      		<tbody>
			<?php
			
				$i=1;
				 while($row = mysql_fetch_array($result_productores)) {
				 	?>
				 	<tr>
		        		<td class="centro"><?php echo $i; ?></td>
		        		<td class="centro"> <?php echo $row['id_envio']; ?> </td>
		        		<td class="centro"><?php print $row['id_camion_fk'] ?></td>
		        		<td class="centro"> <?php echo $row['id_orden_fk']; ?> </td>
			          	<td><?php echo $row['nombre_distribuidor']; ?></td>
			        	<!--<td><?php 
/*
			        	$cadena = "SELECT * FROM productos, ordenes_distribuidor_detalles WHERE id_producto = id_producto_fk AND id_orden_fk = ".$row['id_orden_fk'];
						$result = mysql_query($cadena);
						if(mysql_num_rows($result) > 0){
							while($row1 = mysql_fetch_array($result)) {
			        			echo $row1['nombre_producto']. " ".$row1['variedad_producto']."<br>"; 
			        		}
			        	}*/
			        	?>
			        	</td>-->
			        	
			          	<td class="centro"><?php echo $row['fecha_envio']." a las ".$row['hora_envio']; ?></td>
			          	<td class="centro">
				          	<?php if($_SESSION['nivel_socio'] == 1) if($row['estado_envio'] == 3){ ?>
					    	<a data-toggle="modal" data-target="#myModal" href="#" onclick = "cancelar('<?php print $row['id_envio'] ?>','<?php print $row['id_orden_fk'] ?>')"> 
	          					<span data-toggle="tooltip" data-placement="top" title="Cancelar envío" class="glyphicon glyphicon-remove"></span>
	          				</a>&nbsp;&nbsp;
	          				
	          				<?php } else { ?>
	          					---
	          				<?php } ?>
          				</td>
			          	<td class="centro">
			          		<?php 
	      					 switch($row['estado_envio']){
	      					 	case 1: echo "<span class='label label-warning'>Pendiente</span>"; break;
	      					 	case 2: echo "<span class='label label-danger'>Rechazado por emp.</span>"; break;
	      					 	case 3: echo "<span class='label label-primary'>Enviado</span>"; break;
	      					 	case 4: echo "<span class='label label-success'>Concretado</span>"; break;
	      					 	case 5: echo "<span class='label label-danger'>Cancel. por emp.</span>"; break;
	      					 	case 6: echo "<span class='label label-success'>Aprobado</span>"; break;
	      					 	case 7: echo "<span class='label label-warning'>Pre-envío</span>"; break;
	      					 	case 8: echo "<span class='label label-danger'>Cancel. por dist.</span>"; break;
	      					 	case 9: echo "<span class='label label-danger'>Rechazado por dist.</span>"; break;
	      					 } ?>
			          	</td>
			          	
			           <td align="center"> 
			           	<a style="float: right" onclick="detalles(<?php echo $row['id_envio'] ?>,<?php echo $row['id_orden_fk'] ?>)" data-toggle="modal" data-target="#myModal"  href="#">
				        	<span data-toggle="tooltip" title ="Detalles de envío" class="glyphicon glyphicon-eye-open"></span>
				    	</a>
				    	<div style="width:10px; height:10px; float:right;"></div> 
			           	<a style="float: right" href="#" onclick = "mostrarCajasTarimas(<?php echo $row['id_envio']; ?>)" data-toggle="modal" data-target="#myModal">
				        	<span title="Mostrar cajas" data-toggle="tooltip" class="glyphicon glyphicon-tags"></span>
				    	</a>
			           	<div style="width:10px; height:10px; float:right;"></div> 
			           	<a style="float:right; cursor:hand" onclick="generacionReportes(<?php echo $row['id_orden'] ?>)">
			           		<span data-toggle="tooltip" title="Generar reporte" class="glyphicon glyphicon-print"></span>
			           	</a>
				    	
			           	</td>
		        	</tr>
		        <?php  
		        $i=$i+1;
				 }
			
			  ?>
          	</tbody>
        </table>

        		<?php if($i > 1){ ?>
					<div class="my-navigation" style="margin: 0px auto;">
					<div class="simple-pagination-page-numbers"></div>
					<br><br><br>
					</div>
				<?php } 
			?>

		</div>

        <?php 
		    }else{
		    	 ?>
		    	 <br><br>
		    	 <br>
		    	 	<div style="width:500px; margin:0px auto;" class="alert alert-info centro" role="alert"> 
		    	 		<strong>No hay envío</strong>
		    	 	</div>
		    	 	<br><br>
		    	<?php
		    }
		?>
			<!-- Modal-->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document"  style="width:800px;">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h3 class="modal-title" id="mititulo">Registrar envío</h3>
			      </div>
			      <div class="modal-body fondo-blanco">
			      	<div id="data-child1" style="margin:0px auto; ">
			        	
					</div>
			      </div>
			    </div>
			  </div>
			</div>

		<script type="text/javascript" src="../lib/pagination/jquery-simple-pagination-plugin.js"></script>
		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
			$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			  $('[data-toggle="popover"]').popover();
			});
		</script>

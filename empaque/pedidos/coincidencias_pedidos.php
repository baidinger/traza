<?php 
	include("../../mod/conexion.php");
	$buscar = $_POST['buscar'];
	$filtro = $_POST['filtro'];


	$consulta = "select id_orden,id_distribuidor, nombre_distribuidor, rfc_distribuidor, id_usuario_distribuidor_fk, ciudad_distribuidor, tel1_distribuidor, email_distribuidor, direccion_distribuidor, fecha_orden,fecha_entrega_orden,estado_orden, costo_orden, descripcion_orden, descripcion_cancelacion, descripcion_rechazo from ordenes_distribuidor as od, empresa_distribuidores ed, usuario_distribuidor as ud where od.id_usuario_distribuidor_fk = ud.id_usuario_distribuidor AND ud.id_distribuidor_fk = ed.id_distribuidor AND od.id_empaque_fk = $_SESSION[id_empaque] AND (nombre_distribuidor like '%$buscar%' OR id_orden  = '$buscar' ) ".$filtro." ORDER BY id_orden DESC";
	$result_ordenes = mysql_query($consulta);
	if(mysql_num_rows($result_ordenes) > 0){

 ?>

<div id="paginacion-resultados" style="width:95%; margin:0px auto;">
	    <table class="table table-hover" style="font-size: 14px">
	    	<thead>
		        <tr>
		        	<th>#</th>
		          <th class="centro">Núm. orden</th>
		          <th class="izquierda">Distribuidor</th>
		          <th class="centro">Fecha de la orden</th>
		        <!-- < <th class="centro">Fecha de entrega deseada</th>-->
		          <th class="centro">Costo</th>
		         <!-- <th></th>-->
		          <th class="centro">Operaciones</th>
		          <th class="centro">Estado</th>
		          <th></th>
		        </tr>
      		</thead>
      		<tbody>
			<?php
			
				$i=1;
				 while($row = mysql_fetch_array($result_ordenes)) {
				 	?>
				 	<tr>
		        		<td class="centro"><?php echo $i; ?></td>
		        		<td class="centro"> 
		        			<a style="cursor:hand" onclick="mostrarModalOrdenes(<?php echo $row['id_orden'] ?>, '<?php echo $row['descripcion_orden']; ?>','<?php print $row['costo_orden'] ?>','<?php print $row['fecha_entrega_orden'] ?>','<?php print $row['id_usuario_distribuidor_fk'] ?>')">
		        				<?php echo str_pad($row['id_orden'], 10,"0",STR_PAD_LEFT); ?> </td>
		        			</a>
		        		<td class="izquierda"> 
		        			<a href="index.php?distribuidor=<?php print $row['id_distribuidor'] ?>">
		          				<?php echo $row['nombre_distribuidor']; ?> 
		          			</a>
		        		</td>
			          	<td class="centro"><?php echo $row['fecha_orden']; ?></td>
			          
			          	<?php 
			          		if($row['estado_orden'] == 1){ 
			          	?>
			          			<td class="centro">
			          				<label>$ <?php echo $row['costo_orden']; ?></label>
			          			</td>
			          			<td class="centro">
			          				<div style="width:60px; margin:0px auto;">
				          				<a onClick="infoModalShow(<?php echo $row['id_orden']; ?>, 6)" style="float:left; cursor:pointer;" data-toggle="tooltip" title="Aprobar"> 
				          					<span data-toggle="modal" data-target="#"  data-placement="top" class="aprobarOrden glyphicon glyphicon-ok" aria-hidden="true"></span>
				          				</a>
				          				<div style="width:20px; height:10px; float:left;"></div> 
				          				<a onClick="infoModalShow(<?php echo $row['id_orden']; ?>, 2)" style="float:left; cursor:pointer;"> 
				          					<span style="color:#931111;" data-toggle="tooltip" data-placement="top" title="Rechazar" class="rechazarOrden glyphicon glyphicon-remove" aria-hidden="true"></span>
				          				</a>
			          				</div>
			          			</td>
			          			<td class="centro"> <span class="label label-warning">Pendiente</span> </td>
			          <?php 
							}else if($row['estado_orden'] == 2){
						?>
								<td class="centro">
									<label>$ <?php echo $row['costo_orden']; ?></label>
								</td>
								<!--<td></td>-->
			          			<td class="centro">
			          				<!--
			          				<?php if ($_SESSION['nivel_socio'] == 1) { ?>
			          				<a onClick="infoModalShow(<?php echo $row['id_orden']; ?>, 1)" style="cursor:pointer;" data-toggle="tooltip" title="Revalorar"> 
			          					<span data-toggle="modal" data-target="#"  data-placement="top" class="aprobarOrden glyphicon glyphicon-repeat" aria-hidden="true"></span>
			          				</a>
			          				<?php }else { ?>
			          				- -
			          				<?php } ?>
									-->
									---
			          			</td>
								<td class="centro"> 
								<a  style="cursor:hand" 
			          				tabindex="0"		          				
			          				data-placement="top"
			          				data-trigger="focus"
			          				data-container="body"
			          				data-html="true"
			          				data-toggle="popover"
			          				rol="button"
			          				title="<center><strong><span style='color:#000'>ORDEN RECHAZADA</strong></center>"
			          				data-content="<div class='alert alert-danger'><?php print $row['descripcion_rechazo'] ?></div>">
									<span class="label label-danger">Rechazado por emp.</span> 
								</a>
								</td>

						<?php
							}else if($row['estado_orden'] == 3){

							$consulta = "select * FROM envios_empaque, usuario_empaque where id_receptor_fk = id_receptor AND id_orden_fk=$row[id_orden]";
							$result_envios = mysql_query($consulta);
							if(mysql_num_rows($result_envios) > 0)
								$row2 = mysql_fetch_array($result_envios);

						?>
								<td class="centro">
									<label>$ <?php echo $row['costo_orden']; ?></label>
								</td>
								<td class="centro">---</td>
								<td class="centro">

							<a href="#"  
		          				tabindex="0"		          				
		          				data-placement="top"
		          				data-trigger="focus"
		          				data-container="body"
		          				data-html="true"
		          				data-toggle="popover"
		          				rol="button"
		          				title="<center><strong><span style='color:#000'>PRODUCTO ENVIADO</strong></center>"
		          				data-content="<table style='font-size:12px' class='table'>
		          								<tr>
		          									<td><strong>ID ENVÍO: </strong></td>
		          									<td><?php echo $row2['id_envio']; ?></td>
		          								</tr>
		          								<tr>
		          									<td><strong>FECHA ENVÍO: </strong></td>
		          									<td><?php echo $row2['fecha_envio']." a las ".$row2['hora_envio'] ?></td>
		          								</tr>
		          								<tr>
		          									<td><strong>ID CARRO: </strong></td>
		          									<td><?php echo $row2['id_camion_fk']; ?></td>
		          								</tr>
		          								<tr>
		          									<td><strong>(ID) USUARIO QUE ENVIÓ: </strong></td>
		          									<td><?php echo '('.$row2['id_receptor_fk'].') '. $row2['nombre_receptor'].' '. $row2['apellido_receptor']; ?></td>
		          								</tr>
		          							  <table>">
								<span class="label label-primary">
									Enviado</span> 
							</a>
									
										
								</td>
						<?php
							}
							else if($row['estado_orden'] == 4){
						?>
								<td class="centro">
									<label>$ <?php echo $row['costo_orden']; ?></label>
								</td>
								<!--<td></td>-->
			          			<td class="centro">---</td>
								<td class="centro"> <span class="label label-success">Concretado</span> </td>

						<?php
							}else if($row['estado_orden'] == 5){
						?>
								<td class="centro">
									<label>$ <?php echo $row['costo_orden']; ?></label>
								</td>
								<!--<td></td>-->
			          			<td class="centro">
			          			<!--	<?php if ($_SESSION['nivel_socio'] == 1) { ?>
			          				<a onClick="infoModalShow(<?php echo $row['id_orden']; ?>, 1)" style="cursor:pointer;" data-toggle="tooltip" title="Revalorar"> 
			          					<span data-toggle="modal" data-target="#"  data-placement="top" class="aprobarOrden glyphicon glyphicon-repeat" aria-hidden="true"></span>
			          				</a>
			          				<?php }else { ?>
			          				- -
			          				<?php } ?>-->
			          				---
			          			</td>
								<td class="centro">
									<a href="#"  
		          				tabindex="0"		          				
		          				data-placement="top"
		          				data-trigger="focus"
		          				data-container="body"
		          				data-html="true"
		          				data-toggle="popover"
		          				rol="button"
		          				title="<center><strong><span style='color:#000'>ORDEN CANCELADA</strong></center>"
		          				data-content="<div class='alert alert-danger'><?php print $row['descripcion_cancelacion'] ?></div>">
									<span class="label label-danger">Cancel. por emp.</span> 
								</a>
								</td>


						<?php
							}else if($row['estado_orden'] == 8){
						?>
								<td class="centro">
									<label>$ <?php echo $row['costo_orden']; ?></label>
								</td>
								<!--<td></td>-->
			          			<td class="centro">
			          				<!--<?php if ($_SESSION['nivel_socio'] == 1) { ?>
			          				<a onClick="infoModalShow(<?php echo $row['id_orden']; ?>, 1)" style="cursor:pointer;" data-toggle="tooltip" title="Revalorar"> 
			          					<span data-toggle="modal" data-target="#"  data-placement="top" class="aprobarOrden glyphicon glyphicon-repeat" aria-hidden="true"></span>
			          				</a>
			          				<?php }else { ?>
			          				- -
			          				<?php } ?>-->
			          			</td>
								<td class="centro">
									<a href="#"  
		          				tabindex="0"		          				
		          				data-placement="top"
		          				data-trigger="focus"
		          				data-container="body"
		          				data-html="true"
		          				data-toggle="popover"
		          				rol="button"
		          				title="<center><strong><span style='color:#000'>ORDEN CANCELADA</strong></center>"
		          				data-content="<div class='alert alert-danger'><?php print $row['descripcion_cancelacion'] ?></div>">
									<span class="label label-danger">Cancel. por dist.</span> 
								</a>
								</td>


						<?php
							} else if($row['estado_orden'] == 6){
						?>
								<td class="centro">
									<label>$ <?php echo $row['costo_orden']; ?></label>
								</td>
			          			<td class="centro">
				          			<a onClick="infoModalShow(<?php echo $row['id_orden']; ?>, 5)" style="cursor:pointer;"> 
				          				<span style="color:#931111;" data-toggle="tooltip" data-placement="top" title="Cancelar" class="cancelarOrden glyphicon glyphicon-remove" aria-hidden="true"></span>
				          			</a>
			          				</div>
			          			</td>
								<td class="centro"><span class="label label-primary">Aprobado</span> </td>

						<?php
							} else if($row['estado_orden'] == 9){
						?>
								<td class="centro">
									<label>$ <?php echo $row['costo_orden']; ?></label>
								</td>
								<!--<td></td>-->
			          			<td class="centro">
			          				<!--<?php if ($_SESSION['nivel_socio'] == 1) { ?>
			          				<a onClick="infoModalShow(<?php echo $row['id_orden']; ?>, 1)" style="cursor:pointer;" data-toggle="tooltip" title="Revalorar"> 
			          					<span data-toggle="modal" data-target="#"  data-placement="top" class="aprobarOrden glyphicon glyphicon-repeat" aria-hidden="true"></span>
			          				</a>
			          				<?php }else { ?>
			          				- -
			          				<?php } ?>-->
			          				---
			          			</td>
								<td class="centro"> 
								<a  style="cursor:hand" 
			          				tabindex="0"		          				
			          				data-placement="top"
			          				data-trigger="focus"
			          				data-container="body"
			          				data-html="true"
			          				data-toggle="popover"
			          				rol="button"
			          				title="<center><strong><span style='color:#000'>ORDEN RECHAZADA</strong></center>"
			          				data-content="<div class='alert alert-danger'><?php print $row['descripcion_rechazo'] ?></div>">
									<span class="label label-danger">Rechazado por dist.</span> 
								</a>
								</td>

						<?php
							}
			           ?>
			           <td > 
			           	<a style="float:right; cursor:hand" onclick="mostrarModalOrdenes(<?php echo $row['id_orden'] ?>, '<?php echo $row['descripcion_orden']; ?>','<?php print $row['costo_orden'] ?>','<?php print $row['fecha_entrega_orden'] ?>','<?php print $row['id_usuario_distribuidor_fk'] ?>')">
			           		<span class="glyphicon glyphicon-eye-open"></span>&nbsp;
			           	</a>
			           	<div style="width:10px; height:10px; float:right;"></div> 
			           	<a style="float:right; cursor:hand" onclick="generacionReportes(<?php echo $row['id_orden'] ?>)">
			           		<span class="glyphicon glyphicon-print"></span>&nbsp;
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
		    	 		<strong>No se encontraron pedidos</strong>
		    	 	</div>
		    	 	<br><br>
		    	<?php
		    }
		?>
			<!-- Modal ORDEN-->
			<div class="modal fade" id="myModalOrden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h3 class="modal-title" id="myModalLabel"><img class="img-header" src="../img/detalles_orden.png"> Detalles de la orden</h3>
			      </div>
			      <div class="modal-body fondo-blanco">
			      	<div id="detallesOrden">
			        	
					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	
			      </div>
			    </div>
			  </div>
			</div>

			

			<!-- Modal -->
			<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			    	<form method="POST" action="pedidos/modificarPedidos.php">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h3 class="modal-title" id="myModalLabel"><div id="titulo_orden">¡Aprobar orden!</div></h3>
				      </div>
				      <div class="modal-body fondo-blanco">
				        <div id="info_modal">
				        	

				        </div>
				        <input type="hidden" name="id" id="id">
				      	<input type="hidden" name="estado" id="estado">
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">regresar</button>
				        <button type="submit" class="btn btn-primary">Continuar</button>
				      </div>
				    </form>
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

		function generacionReportes(orden){
				var params = {'orden':orden};

				$.ajax({
					type: 'POST',
					url: '../genReps/generarOrdenDistribuidorEmpaque.php',
					data: params,

					success: function(data){
						var urlPDF = "../docs/ordendecompradist" + orden + ".pdf";
						setTimeout(window.open(urlPDF), 1000);
					}
				});
			}
	</script>


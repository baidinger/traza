<?php 
	include("../../mod/conexion.php");
	$buscar = $_POST['buscar'];
	
/*$consulta = "select id_orden, fecha_orden, fecha_entrega_orden, ".
				"costo_orden, descripcion_orden, id_usuario_distribuidor_fk, id_empaque_fk, ".
				"estatus_orden, id_empaque, nombre_empaque, nombre_distribuidor from ordenes_distribuidor join empresa_empaques ".
				"ON empresa_empaques.id_empaque = ordenes_distribuidor.id_empaque_fk join usuario_distribuidor ".
				"ON usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk ".
				"join empresa_distribuidores ON empresa_distribuidores.id_distribuidor = usuario_distribuidor.id_distribuidor_fk ".
				"where empresa_empaques.id_usuario_que_registro = ".$_SESSION['id_usuario'];*/
	$c = "SELECT * FROM empresa_empaques as ee, usuario_empaque as ue where ee.id_empaque = ue.id_empaque_fk AND ue.id_usuario_fk = ".$_SESSION['id_usuario'];
	$r = mysql_query($c);
	$id_empaque = "";
	if($r)
		if(mysql_num_rows($r) > 0)
		{
			$row = mysql_fetch_array($r);
			$id_empaque = $row['id_empaque'];
		}
		else
			return;
			


	$consulta = "select id_orden,nombre_distribuidor, rfc_distribuidor, id_usuario_distribuidor_fk, ciudad_distribuidor, tel1_distribuidor, email_distribuidor, direccion_distribuidor, fecha_orden,fecha_entrega_orden,estado_orden, costo_orden, descripcion_orden, descripcion_cancelacion, descripcion_rechazo from ordenes_distribuidor as od, empresa_distribuidores ed, usuario_distribuidor as ud where od.id_usuario_distribuidor_fk = ud.id_usuario_distribuidor AND ud.id_distribuidor_fk = ed.id_distribuidor AND od.id_empaque_fk = $id_empaque AND (nombre_distribuidor like '%$buscar%' OR id_orden  like '%$buscar%')";
	$result_productores = mysql_query($consulta);
	if(mysql_num_rows($result_productores) > 0){

 ?>

<div id="paginacion-resultados" style="width:95%; margin:0px auto;">
	    <table class="table table-hover">
	    	<thead>
		        <tr>
		        	<th>#</th>
		          <th class="centro">N. orden</th>
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
				 while($row = mysql_fetch_array($result_productores)) {
				 	?>
				 	<tr>
		        		<td class="centro"><?php echo $i; ?></td>
		        		<td class="centro"> <?php echo $row['id_orden']; ?> </td>
		        		<td class="izquierda"> 
		          				<?php echo $row['nombre_distribuidor']; ?> 
		        		</td>
			          	<td class="centro"><?php echo $row['fecha_orden']; ?></td>
			          	<!--<td class="centro"><?php echo $row['fecha_entrega_orden']; ?></td>-->
			          	<!--<td class="centro"><?php echo $row['costo_orden']; ?></td>-->
			          	<!--<td class="centro"><?php //echo $row['descripcion_orden']; ?></td>-->

			          	<?php 
			          		if($row['estado_orden'] == 1){ 
			          	?>
			          			<td class="centro">
			          				<label>$ <?php echo $row['costo_orden']; ?></label>
			          			</td>
			          			<!--<td>
			          				<button class="btn btn-link" onClick="modalCostoShow(<?php echo $row['id_orden']; ?>, <?php echo $row['costo_orden']; ?>)">Introduce precio</button>
			          			</td>-->
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
			          				<?php if ($_SESSION['nivel_socio'] == 1) { ?>
			          				<a onClick="infoModalShow(<?php echo $row['id_orden']; ?>, 1)" style="cursor:pointer;" data-toggle="tooltip" title="Revalorar"> 
			          					<span data-toggle="modal" data-target="#"  data-placement="top" class="aprobarOrden glyphicon glyphicon-repeat" aria-hidden="true"></span>
			          				</a>
			          				<?php }else { ?>
			          				--
			          				<?php } ?>

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
									<span class="label label-danger">Rechazado</span> 
								</a>
								</td>

						<?php
							}else if($row['estado_orden'] == 3){

							$consulta = "select * FROM envios_empaque where id_orden_fk=$row[id_orden]";
							$result_productores = mysql_query($consulta);
							if(mysql_num_rows($result_productores) > 0)
								$row2 = mysql_fetch_array($result_productores);

						?>
								<td class="centro">
									<label>$ <?php echo $row['costo_orden']; ?></label>
								</td>
								<!--<td></td>-->
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
		          									<td><strong>ID USUARIO: </strong></td>
		          									<td><?php echo $row2['id_receptor_fk']; ?></td>
		          								</tr>
		          							  <table>">
								<span class="label label-info">
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
			          				<?php if ($_SESSION['nivel_socio'] == 1) { ?>
			          				<a onClick="infoModalShow(<?php echo $row['id_orden']; ?>, 1)" style="cursor:pointer;" data-toggle="tooltip" title="Revalorar"> 
			          					<span data-toggle="modal" data-target="#"  data-placement="top" class="aprobarOrden glyphicon glyphicon-repeat" aria-hidden="true"></span>
			          				</a>
			          				<?php }else { ?>
			          				--
			          				<?php } ?>
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
									<span class="label label-danger">Cancelado</span> 
								</a>
								</td>


						<?php
							}else if($row['estado_orden'] == 6){
						?>
								<td class="centro">
									<label>$ <?php echo $row['costo_orden']; ?></label>
								</td>
								<!--<td></td>-->
			          			<td class="centro">
				          			<a onClick="infoModalShow(<?php echo $row['id_orden']; ?>, 5)" style="cursor:pointer;"> 
				          				<span style="color:#931111;" data-toggle="tooltip" data-placement="top" title="Cancelar" class="cancelarOrden glyphicon glyphicon-remove" aria-hidden="true"></span>
				          			</a>
			          				</div>
			          			</td>
								<td class="centro"><span class="label label-primary">Aprobado</span> </td>

						<?php
							}
			           ?>
			           <td > 
			           	<button style="float:right" onclick="mostrarModalOrdenes(<?php echo $row['id_orden'] ?>, '<?php echo $row['descripcion_orden']; ?>','<?php print $row['costo_orden'] ?>','<?php print $row['fecha_entrega_orden'] ?>','<?php print $row['id_usuario_distribuidor_fk'] ?>')" class="btn btn-primary">
			           		<span class="glyphicon glyphicon-eye-open"></span>&nbsp;
			           	</button>
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
			<!-- Modal -
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h3 class="modal-title" id="myModalLabel">$$ Cambiar Precio $$</h3>
			      </div>
			      <div class="modal-body fondo-blanco">
			      	<div style="margin:0px auto; width:400px; height:50px;">
			        	<form class="form-inline" method="post" action="javascript:modificarCosto()">
						  <div class="form-group">
						    <label class="sr-only" for="exampleInputAmount">Cantidad (in dollars)</label>
						    <div class="input-group">
						      <div class="input-group-addon">$</div>
						      	<input type="number" step="0.01" class="form-control" min="1" id="cantidad_costo" name="cantidad_costo" placeholder="Cantidad">
						    	<input type="hidden" name="id_orden" id="id_orden">
						    	<input type="hidden" name="tipo_edicion" id="tipo_edicion">
						    </div>
						  </div>
						  <button onclick="" class="btn btn-primary">Aceptar</button>
						  <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
						</form>
					</div>
			      </div>
			    </div>
			  </div>
			</div>
			-->
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
	</script>
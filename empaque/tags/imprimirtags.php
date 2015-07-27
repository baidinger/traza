<div class="contenedor-form">
		
     		<div class="modal-header">
	       		<h3 class="modal-title">
	       			<img class="img-header" src="img/RFID.png"> Impresión de etiquetas
	       		</h3>
    		</div>

    		<div style="width:50%; margin: 30px auto">
    		<form id="formulario" class="form-horizontal" role="form" method="post" action="lotes/registro_nuevo_lote_admin.php">

	      	<div class="modal-body" style="width:100%; float: left">
	      		<div class="alert alert-info">DETALLES DEL LOTE</div>
	      		
	      		   <div class="form-group">
			    	<label class="col-sm-3 control-label">Número del lote: </label>
			    	<div class="col-sm-9">
			    		<select class="form-control">
			    		<?php 
			    			include('../../mod/conexion.php');
							$consulta = "select id_lote, fecha_recibo_lote from lotes where id_empaque_fk = $_SESSION[id_empaque]";
							$result = mysql_query($consulta);
							if(mysql_num_rows($result) > 0 ){
								 while($row = mysql_fetch_array($result)) {
								 	?>
			    		
			    					<option><?php print $row['id_lote'] ?></option>

						    		<?php } }else{ ?>
						    		<option>No se encuentran lotes</option>

						    		<?php } ?>
			    		</select>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-3 control-label">Rend. cajas: </label>
			    	<div class="col-sm-9">
			    		<input type="number" class="form-control input" 
			    		name="cantidad_cajas" 
			    		placeholder="Rendimiento de cajas" required min ="0">
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-3 control-label">Rend. de kilos: </label>
			    	<div class="col-sm-9">
			    		<input type="number" class="form-control input" 
			    		name="cantidad_kilos" 
			    		placeholder="Rendimiento de kilos" min="0" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-3 control-label">Número de etiquetas: </label>
			    	<div class="col-sm-9">
			    		<input  type="text" pattern="[A-Za-zñÑ ]*" class="form-control input" 
			    		name="nombre_remitente" id="" 
			    		placeholder="No. etiquetas" required>
		         	</div>
				  </div>
				 <!-- <div class="form-group">
			    	<label class="col-sm-3 control-label">Costo lote: </label>
			    	<div class="col-sm-9">
			    		<input type="number" min="0" class="form-control input" 
			    		name="costo_lote" 
			    		placeholder="Costo del lote" required>
		         	</div>
				  </div>-->
				  
		     
			  	<hr>
			  	<center>
		     			<button id="guardar" class="btn btn-primary" disabled><i  class="glyphicon glyphicon-ok"></i> Registrar e imprimir</button>
		     			<input type="hidden" name="url" value="../index.php?op=admon_lotes">
		     	</center>
		     		</div>
		    </form>	
	    </div>
	
	 </div>

	 <div class="modal fade bs-example-modal-lg" id="modalProductor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header">
							<img class="img-header" src="img/buscar.png"> <span id="titulo-detalles">Buscar productor</span>
						</h3>
					</div>
					<div class="modal-body">
						<div class="alert alert-info"><p>En la siguiente tabla se muestran los productores activos en el sistema</p></div>
						<div class="form-inline">
							<center>
								<input type="text" class="form-control" name="inputBuscarProductor" id="inputBuscarProductor"  onkeyup="if(event.keyCode == 13) buscarProductores();" style="width: 80%;">
								<button type="button" class="btn btn-primary" onclick="buscarProductores()"><i class="glyphicon glyphicon-search"></i> Buscar</button>
							</center>
						</div>

						<div class="contenedor-productores" id="contenedor-productores">
							<table class="table">
								<thead>
									<th class="centro">#</th>
									<th>RFC</th>
									<th>Nombre del Productor</th>
									<th class="derecha"></th>
								</thead>
								<tbody>
									<?php 
										include('../../mod/conexion.php');

										$cont = 1;
									    $consulta = "SELECT * FROM empresa_productores WHERE estado_p = 1 ORDER BY nombre_productor LIMIT 10 ";
										$resultado = mysql_query($consulta);
										while($row = mysql_fetch_array($resultado)){ ?>
											<tr>
												<td class="centro"><?php echo $cont; ?></td>
												<td><?php echo $row['rfc_productor']; ?></td>
								          		<td><?php echo $row['nombre_productor'] . " " . $row['apellido_productor']; ?></td>
									        	<td class="derecha">
									        		<button class="btn btn-success" data-dismiss="modal" onClick="seleccionarProductor(<?php echo $row['id_productor']; ?>, '<?php echo $row['rfc_productor'] .' - '. $row['nombre_productor'] .' '. $row['apellido_productor']; ?>');"><i class="glyphicon glyphicon-ok"></i> Seleccionar</button>
									        	</td>
									        	<?php $cont++; ?>
								    	    </tr>
										<?php }
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</div>
		</div>

		<?php mysql_close(); ?>
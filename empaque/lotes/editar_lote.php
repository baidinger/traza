<!DOCTYPE html>
<html>
	<body>

		<?php
			include('../mod/conexion.php');
			$id_lote = $id;
			$consulta = "SELECT id_lote, id_productor_fk, fecha_recoleccion, hora_recoleccion, fecha_caducidad, rendimiento_kg, cajas_chicas, cajas_medianas, cajas_grandes, resaga, merma1, merma2, numero_peones, placas, marca, modelo, cajas_chicas, cajas_medianas, cajas_grandes, rendimiento_kg, telefono_productor, rfc_productor, cant_cajas_lote, cant_kilos_lote, remitente_lote, fecha_recibo_lote, hora_recibo_lote, costo_lote, id_empaque_fk, nombre_productor, apellido_productor, nombre_producto, variedad_producto FROM lotes, empresa_productores, productos, productos_productores WHERE productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND productos_productores.id_producto_fk = productos.id_producto AND productos_productores.id_productor_fk = empresa_productores.id_productor AND id_lote = $id_lote";
			$resultado = mysql_query($consulta);
			$row = mysql_fetch_array($resultado);
		?>
	
	<div class="contenedor-form">
		<div class="modal-header">
			<h3 class="modal-title">
				<img class="img-header" src="img/lotes.png"> Editar lote: <?php print str_pad($id_lote,3,"0",STR_PAD_LEFT); ?>
			</h3>
		</div>
		<form class="form-horizontal" role="form" method="post" action="lotes/editar_lote_admin.php">
			<div class="modal-body" style="width:85%; margin: 30px auto; border-radius: 5px">
				<div class="alert alert-warning">¡ATENCIÓN! La modificación de estos datos puede alterar significativamente la integridad del sistema. Si se generaron etiquetas para este lote, estas etiquetas conservan en el EPC datos como la fruta, calibre y lote.</div>
				<p class="label label-primary">Datos generales</p>
				<hr>
	      		<div class="form-group">
			    	<label class="col-sm-2 control-label">RFC - Nombre del productor: </label>
			    	<div class="col-sm-4">
			    		<input type="text" class="form-control input" 
			    		name="nombre_producto" readonly value="<?php print $row['rfc_productor']." - ".$row['nombre_productor']." ".$row['apellido_productor'] ?>">
			    		<input type="hidden" value="<?php print $id_lote ?>" name="id_lote">
			    	</div>
			    	<label class="col-sm-2 control-label">Fruta / variedad: </label>
			    	
			    	<div id="contenedor-productos-productor" class="col-sm-4">
			    		<?php 
							$idProductor = $row['id_productor_fk'];


						    $consulta = "SELECT prds.id_producto,  id_productos_productores, ubicacion_huerta, prds.nombre_producto, prds.variedad_producto FROM productos AS prds, productos_productores AS prdsepqs WHERE prds.id_producto = prdsepqs.id_producto_fk AND prdsepqs.id_productor_fk = $idProductor";
							$resultado = mysql_query($consulta);

							if(mysql_num_rows($resultado ) > 0){
							?>
							<select <?php if($_SESSION['nivel_socio'] == 2) print "disabled" ?> class="form-control" name="id_productos_productores" id="selectProducto">
								<?php 

									while($row1 = mysql_fetch_array($resultado)){ ?>
										<option value="<?php echo $row1['id_productos_productores']; ?>"><?php echo $row1['nombre_producto']." ".$row1['variedad_producto']." - ".$row1['ubicacion_huerta']; ?></option>
									<?php }
								?>
							</select>
						<?php } else {?>
							<!--<div class="alert alert-danger" role="alert"><p>No hay productos asignados a este productor</p></div>-->
							<select class="form-control">
								<option>No existen frutas para este productor</option>
							</select>
						<?php } ?>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Cajas recibidas: </label>
			    	<div class="col-sm-2">
			    		<input type="number" value="<?php print $row['cant_cajas_lote'] ?>" class="form-control input" 
			    		name="cantidad_cajas" 
			    		placeholder="Cantidad de cajas" required min ="0">
		         	</div>
			    	<label class="col-sm-2 control-label">Kilos recibidos: </label>
			    	<div class="col-sm-2">
			    		<input onblur="calcularP()" type="number" class="form-control input" 
			    		name="cantidad_kilos" value="<?php print $row['cant_kilos_lote'] ?>"
			    		placeholder="Número de kilos" min="0" required>
		         	</div>
			    	
		         	<label class="col-sm-2 control-label">Costo lote: </label>
			    	<div class="col-sm-2">
			    		<input type="text"  min="0" class="form-control input" 
			    		name="costo_lote" value="<?php print $row['costo_lote'] ?>"
			    		placeholder="Costo del lote" required>
		         	</div>
				  </div>
				  <p>&nbsp;</p>
				  <p class="label label-primary">Datos del transporte</p>
				  <hr>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Nombre del remitente: </label>
			    	<div class="col-sm-4">
			    		<input  type="text" pattern="[A-Za-zñÑ ]*" class="form-control input" 
			    		name="nombre_remitente" value="<?php print $row['remitente_lote'] ?>"
			    		placeholder="Nombre del remitente" required>
		         	</div>
				  </div>

				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Marca: </label>
			    	<div class="col-sm-3">
			    		<input type="text" value="<?php print $row['marca'] ?>"
			    		 class="form-control input" 
			    		name="marca" 
			    		placeholder="Marca del carro" required >
		         	</div>
			    	<label class="col-sm-1 control-label">Modelo: </label>
			    	<div class="col-sm-2">
			    		<input type="number" value="<?php print $row['modelo'] ?>" class="form-control input" 
			    		name="modelo"
			    		placeholder="Modelo del carro" min="0" required>
		         	</div>
		         	<label class="col-sm-1 control-label">Placas: </label>
			    	<div class="col-sm-3">
			    		<input type="text" value="<?php print $row['placas'] ?>" class="form-control input" 
			    		name="placas"
			    		placeholder="Placas" required>
		         	</div>
				  </div>
				  <p>&nbsp;</p>
				  <p class="label label-primary">Datos de recolección</p>
				  <hr>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Fecha de recolección: </label>
			    	<div class="col-sm-2">
			    		<input type="date" value="<?php print $row['fecha_recoleccion'] ?>" class="form-control input" 
			    		name="fecha_recoleccion" >
		         	</div>
			    	<label class="col-sm-2 control-label">Hora de recolección: </label>
			    	<div class="col-sm-2">
			    		<input type="text" value="<?php print $row['fecha_recoleccion'] ?>" class="form-control input" 
			    		name="hora_recoleccion" >
		         	</div>
			    	<label class="col-sm-2 control-label">Fecha de caducidad: </label>
			    	<div class="col-sm-2">
			    		<input type="date" value="<?php print $row['fecha_caducidad'] ?>" class="form-control input" 
			    		name="fecha_caducidad" >
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Número de peones: </label>
			    	<div class="col-sm-2">
			    		<input type="number" value="<?php print $row['numero_peones'] ?>" min="1" class="form-control input" 
			    		name="numero_peones" >
		         	</div>
				  </div>
				  <p>&nbsp;</p>
				  <p class="label label-primary">Rendimiento</p>
				  <hr>
				   <div class="form-group">
			    	<label class="col-sm-2 control-label">Cajas chicas: </label>
			    	<div class="col-sm-2">
			    		<input type="number" value="<?php print $row['cajas_chicas'] ?>" class="form-control input" 
			    		name="cajas_chicas" id="cajas_chicas" 
			    		placeholder="Rend." required min ="0">
		         	</div>
		         	<label class="col-sm-2 control-label">Cajas medianas: </label>
			    	<div class="col-sm-2">
			    		<input type="number" value="<?php print $row['cajas_medianas'] ?>" class="form-control input" 
			    		name="cajas_medianas" id="cajas_medianas" 
			    		placeholder="Rend." required min ="0">
		         	</div>
		         	<label class="col-sm-2 control-label">Cajas grandes: </label>
			    	<div class="col-sm-2">
			    		<input type="number" value="<?php print $row['cajas_grandes'] ?>" class="form-control input" 
			    		name="cajas_grandes" id="cajas_grandes"
			    		placeholder="Rend." required min ="0">
		         	</div>
		         </div>
				 <div class="form-group">
			    	<label class="col-sm-2 control-label">Rend. kilos: </label>
			    	<div class="col-sm-2">
			    		<input type="number" value="<?php print $row['rendimiento_kg'] ?>" class="form-control input" 
			    		name="rendimiento" 
			    		placeholder="Rend." min="0" required>
		         	</div>
		         	<label class="col-sm-2 control-label">Resaga (kilos): </label>
			    	<div class="col-sm-2">
			    		<input type="number" value="<?php print $row['resaga'] ?>" class="form-control input" 
			    		name="resaga" 
			    		placeholder="Resaga" min="0" required>
		         	</div> 
			    	<label class="col-sm-2 control-label">Merma 1 (kilos): </label>
			    	<div class="col-sm-2">
			    		<input type="number" value="<?php print $row['merma1'] ?>" class="form-control input" 
			    		name="merma1" 
			    		placeholder="merma 1" min="0" required>
		         	</div>
		         </div>
				 <div class="form-group">
		         	<label class="col-sm-2 control-label">Merma 2 (kilos): </label>
			    	<div class="col-sm-2">
			    		<input type="number" value="<?php print $row['merma2'] ?>" class="form-control input" 
			    		name="merma2" 
			    		placeholder="merma 2" min="0" required>
		         	</div>
				 </div>
				 <div style="clear:both"></div>
			  	 <hr>
			  	 <center>		     			
		  	 		<div onclick="goBack()" style="width: 150px" class="btn btn-default">Regresar</div>
	     			<button type="submit" style="width: 150px" id="guardar" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Actualizar</button>
	     			<input type="hidden" name="url" value="../index.php?op=admon_lotes">
		     	 </center>
		     	</div>
		     	
		     	</div>
	    </div>
	     </form>	
	 </div>

	 
	</body>




</html>
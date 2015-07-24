
		<form class="form-horizontal" role="form" method="post" action="busquedas/editar_productor.php">
	    		<div>
		      	<div class="modal-body">
		      		<!--<div class="form-group">
				    	<label class="col-sm-2 control-label">Usuario: </label>
				    	<div class="col-sm-10">
				    		<input type="text" id="usuario" value="<?php echo $row['nombre_usuario']; ?>" class="form-control input" name="usuario" placeholder="Usuario" required>
				    		<div id="disponible"></div>
			         	</div>
					  </div>
					  <div class="form-group">
				    	<label class="col-sm-2 control-label">Contraseña: </label>
				    	<div class="col-sm-10">
				    		<input type="password" value="<?php echo $row['contrasena_usuario']; ?>" class="form-control input" name="contrasena" id="" placeholder="Contraseña" required>
			         	</div>
					  </div>
					  <hr>-->
					  <div class="form-group">
				    	<label class="col-sm-2 control-label">Nombre: </label>
				    	<div class="col-sm-10">
				    		<input type="text" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" value="<?php echo $row['nombre_productor']; ?>" class="form-control input" name="nombre_productor" placeholder="Nombre del productor" required>
			         	</div>
					  </div>
					  <div class="form-group">
				    	<label class="col-sm-2 control-label">Apellidos: </label>
				    	<div class="col-sm-10">
				    		<input type="text" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" value="<?php echo $row['apellido_productor']; ?>" class="form-control input" name="apellido_productor" id="" placeholder="Apellidos del productor" required>
			         	</div>
					  </div>
					   <div class="form-group">
				    	<label class="col-sm-2 control-label">RFC: </label>
				    	<div class="col-sm-10">
				    		<input type="text" pattern="[A-Za-z]{4}[0-9]{6}[A-Za-z0-9]{3}" title="El RFC debe contener 4 letras, seguido de 6 números y tres caracteres de la homoclave" value="<?php echo $row['rfc_productor']; ?>" class="form-control input" name="rfc_productor" id="" placeholder="RFC del productor" required>

			         	</div>
					  </div>
					  <div class="form-group">
				    	<label class="col-sm-2 control-label">Teléfono: </label>
				    	<div class="col-sm-10">
				    		<input type="text" pattern="[0-9]{10}|[0-9]{11}|[0-9]{12}|[0-9]{13}" title="Ingresa 10, 11, 12 y 13 dígitos" value="<?php echo $row['telefono_productor']; ?>" class="form-control input" name="telefono_productor" id="" placeholder="Telefono del productor" required>
			         	</div>
					  </div>
					  <div class="form-group">
				    	<label class="col-sm-2 control-label">Dirección: </label>
				    	<div class="col-sm-10">
				    		<input type="text" value="<?php echo $row['direccion_productor']; ?>" class="form-control input" name="direccion_productor" id="" placeholder="Dirección del productor" required>
			         	</div>
					  </div>
				  	<center>
			     		<input type="hidden" name="id_productor" value="<?php echo $row['id_productor']; ?>">
			     	</center>

			     	<hr>
			     	<center>
			     		<button style="width:150px" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			     		<button id="enviar" style="width:150px" type="submit" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Guardar cambios</button>

			     	</center>
			     	
			    </div>
		    </div>
		</form>	

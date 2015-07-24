
	<form class="form-horizontal" role="form" method="post" action="registros/registro_productor.php">
     		<div class="modal-header">
       		<h3 class="modal-title">
       			<img class="img-header" src="img/productor.png"> Registro productor
       		</h3>
    		</div>
    		<div>
	      	<div class="modal-body contenedor-form" style="width: 600px">
	      		<table class="table" style="width:600px">
		      			<tr>
		      				<td>
		      					<label class="col-sm-2 control-label">Usuario: </label><br><br>
		      					<input style="width:200px" pattern="([A-Za-z0-9])+" title="El usuario sólo puede contener letras y números" id="usuario" type="text" class="form-control input" name="usuario_productor"placeholder="Usuario del productor" autofocus required>
				    			<span id="disponible"></span>
		      				</td>
		      				<td>
		      					<label class="col-sm-2 control-label">Contraseña: </label><br><br>
		      					<input style="width:200px;" type="password" pattern="([A-Za-z0-9])+" title = "La contraseña sólo puede contener letras y números" class="form-control input" name="contrasena_usuario" id="" placeholder="Contraseña" required>
		      				</td>
		      			</tr>
		      		</table>

				  <hr>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Nombre: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" class="form-control input" name="nombre_productor" id="" placeholder="Nombre del productor" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Apellidos: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" class="form-control input" name="apellido_productor" id="" placeholder="Apellidos del productor" required>
		         	</div>
				  </div>
				  	<div class="form-group">
			    	<label class="col-sm-2 control-label">RFC: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[A-Za-z]{4}[0-9]{6}[A-Za-z0-9]{3}" title="El RFC debe contener 4 letras, seguido de 6 números y tres caracteres de la homoclave" class="form-control input" name="rfc_productor" id="" placeholder="RFC del productor" required>

		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Teléfono: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[0-9]{10}|[0-9]{11}|[0-9]{12}|[0-9]{13}" title="Ingresa 10, 11, 12 y 13 dígitos" class="form-control input" name="telefono_productor" id="" placeholder="Teléfono del productor" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Dirección: </label>
			    	<div class="col-sm-10">
			    		<textarea type="text" class="form-control input" name="direccion_productor" id="" placeholder="Dirección del productor" required></textarea>
		         	</div>
				  </div>

			  	<hr>
			  	<!--<span>Nota: Todos los campos son obligatorios</span>-->
			  	<center>

		     			<button id="enviar" type="submit" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Registrar</button>
		     			<input type="hidden" name="socio" value="bus_productor">
		     		</center>
		     	</div>
	    </div>
	     </form>	
	
	<script type="text/javascript">
		$('#usuario').change(function(){
			var usuario = $('#usuario').val();
			var params = {'usuario':usuario};
			$.ajax({
				type: 'POST',
				url: 'validar/validar_usuario.php',
				data: params,

				success: function(data){
					$('#disponible').html(data);
				},
				beforeSend: function(data ) {
			    $("#disponible").html("<span class=\"label label-info\">cargando...</span>");
			  }
			});
		});
	</script>
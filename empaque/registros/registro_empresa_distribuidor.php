<!DOCTYPE html>
<html>
	<head lang="ES">
		<title>Registro - Distribuidor</title>
		<meta charset="UTF-8">

		<!--<link rel="stylesheet" type="text/css" href="lib/bootstrap-3.3.5/css/bootstrap.min.css">-->
		<!--<link rel="stylesheet" type="text/css" href="css/estilos.css">-->
		<?php include("../script/paises.js"); ?>
	</head>

	<body>
<div>
	<form  name="formulario" class="form-horizontal" role="form" method="post" action="registros/registro_empresa_distribuidor_admin.php">
     		<div class="modal-header">
       		<h3 class="modal-title">
       			<img class="img-header" src="img/distribuidor.png"> Registro distribuidor
       		</h3>
    		</div>
    		<div>
	      	<div class="modal-body contenedor-form" style="width: 70%; min-width:500px">

	      		<div class="form-group">
			    	<label class="col-sm-2 control-label">Usuario: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="([A-Za-z0-9])+" title="El usuario sólo puede contener letras y números"	title="El usuario solo puede contener letras y números"  class="form-control input" name="usuario_distribuidor" id="usuario" placeholder="Usuario administrador del distribuidor" autofocus required>
			    		<div id="disponible"></div>
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="col-sm-2 control-label">Contraseña: </label>
			    	<div class="col-sm-10">
			    		<input type="password" pattern="([A-Za-z0-9])+" title = "La contraseña sólo puede contener letras y números" class="form-control input" name="contrasena_distribuidor" id="" placeholder="Contraseña" required>
		         	</div>
				  </div>
				  <HR>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Nombre: </label>
			    	<div class="col-sm-10">
			    		<input type="text"pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" class="form-control input" name="nombre_distribuidor" id="" placeholder="Nombre del distribuidor" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">RFC: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[A-Za-z]{4}[0-9]{6}[A-Za-z0-9]{3}" title="El RFC debe contener 4 letras, seguido de 6 números y tres caracteres de la homoclave" class="form-control input" name="rfc_distribuidor" id="" placeholder="RFC del distribuidor" required>
		         	</div>
				  </div>

				  <div class="form-group">
			    	<label class="col-sm-2 control-label">País: </label>
				    <div class="col-sm-10">
				      	<select class="form-control select select-primary" name="pais" id="select1" onchange="cambiar()">
							<option value="0">MÉXICO</option>
							<option value="1">EEUU</option>
							<option value="2">CANADA</option>
							<option value="3">JAPÓN</option>
							<option value="4">AUSTRALIA</option>
						</select>
				    </div>
			  	</div>
				
				<!-- Estado -->
		 	  	<div class="form-group">
			    	<label class="col-sm-2 control-label">Estado: </label>
				    <div class="col-sm-10">
				       <select class="form-control select select-primary" name="estado" id="select2">
						</select>
				    </div>
			  	</div>
				
		 	  	<div class="form-group">
			    	<label class="col-sm-2 control-label">Ciudad: </label>
				    <div class="col-sm-10">
				      	<input type="text" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" class="form-control input" name="ciudad_distribuidor" id="select1" placeholder="Ciudad del distribuidor" required>
					</div>
			  	</div>
				
				<div class="form-group">
			    	<label class="col-sm-2 control-label">Dirección: </label>
			    	<div class="col-sm-10">
			    		<textarea class="form-control input" name="direccion_distribuidor" id="" placeholder="Dirección del distribuidor" required></textarea>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">C.P: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[0-9]{5}|[0-9]{6}|[0-9]{7}" title="Ingresa 5, 6 o 7 dígitos" class="form-control input" name="cp_distribuidor" id="" placeholder="Código postal" required>
		         	</div>
				  </div>
					
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">E-mail: </label>
			    	<div class="col-sm-10">
			    		<input type="email" class="form-control input" name="email_distribuidor" id="" placeholder="Correo electrónico" required>
		         	</div>
				  </div>

				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Teléfono: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[0-9]{10}|[0-9]{11}|[0-9]{12}|[0-9]{13}" title="Ingresa 10, 11, 12 y 13 dígitos" class="form-control input" name="telefono1_distribuidor" id="" placeholder="Teléfono" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Teléfono 2: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[0-9]{10}|[0-9]{11}|[0-9]{12}|[0-9]{13}" title="Ingresa 10, 11, 12 y 13 dígitos" class="form-control input" name="telefono2_distribuidor"  placeholder="Teléfono alternativo">
		         	</div>
				  </div>

			  	<hr>
			  	<center>
			  			<input type="hidden" name="socio" value="bus_distribuidor">
		     			<button type="submit" class="btn btn-primary" id="enviar"><i  class="glyphicon glyphicon-ok"></i> Registrar</button>
		     		</center>
		     	</div>
	    </div>
	     </form>	
	 </div>
	</body>

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

</html>
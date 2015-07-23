<!DOCTYPE html>
<html>
	<head lang="ES">
		<title>Registro - Productor</title>
		<meta charset="UTF-8">
	</head>

	<body>
<div>
	<form class="form-horizontal" role="form" method="post" action="usuarios/registro_nuevo_usuario_admin.php">
     		<div class="modal-header">
       		<h3 class="modal-title">
       			<img class="img-header" src="img/imagen.png"> Registro de usuarios (Empaque)
       		</h3>
    		</div>

	      	<div class="modal-body contenedor-form" style="width: 70%; min-width:500px">
	      		<div class="form-group">
			    	<label class="col-sm-2 control-label">Usuario: </label>
			    	<div class="col-sm-10">
			    		<input type="text" class="form-control input" name="usuario" id="usuario" placeholder="Usuario normal del empaque" autofocus required>
			    		<div id="disponible"></div>
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="col-sm-2 control-label">Contraseña: </label>
			    	<div class="col-sm-10">
			    		<input type="password" class="form-control input" name="contrasena_usuario" id="" placeholder="Contraseña" required>
		         	</div>
				  </div>
				  <hr>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Nombre: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[A-Za-z ÑñáéíóúÁÉÍÓÚ]*" class="form-control input" name="nombre_usuario_empaque" id="" placeholder="Nombre del usuario del empaque" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Apellidos: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[A-Za-z ÑñáéíóúÁÉÍÓÚ]*" class="form-control input" name="apellido_usuario_empaque" id="" placeholder="Apellidos del usuario del empaque" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Teléfono: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[0-9][0-9][0-9][0-9][0-9][0-9][0-9]*" class="form-control input" name="telefono_usuario_empaque" id="" placeholder="Teléfono del usuario del empaque" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Dirección: </label>
			    	<div class="col-sm-10">
			    		<input type="text" class="form-control input" name="direccion_usuario_empaque" id="" placeholder="Dirección del usuario del empaque" required>
		         	</div>
				  </div>
			  	<hr>
			  	<div class="form-group alert alert-info">
			    	<label class="col-sm-2 control-label">Privilegios: </label>
			    	<div class="col-sm-10">
			    		<input name="pedidos" value="1" type="checkbox"> Pedidos &nbsp;&nbsp;&nbsp;
			    		<input name="lotes" value="1" type="checkbox"> Lotes &nbsp;&nbsp;&nbsp;
			    		<input name="envios" value="1" type="checkbox"> Envíos &nbsp;&nbsp;&nbsp;
		         	</div>
				  </div>
			  	<hr>
			  	<center>
		     			<button type="submit" class="btn btn-primary" id="enviar"><i  class="glyphicon glyphicon-ok"></i> Registrar</button>
		     			<input type="hidden" name="url" value="../index.php?op=admon_users">
		     		</center>
		     	</div>
	     </form>	
	 </div>
	</body>

	<!--<script type="text/javascript" src="script/jquery-2.1.3.min.js"></script>-->
	<!--<script type="text/javascript" src="script/bootstrap.min.js"></script>-->
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
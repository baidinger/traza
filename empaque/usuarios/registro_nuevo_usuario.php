<!DOCTYPE html>
<html>
	<head lang="ES">
		<title>Registro - Productor</title>
		<meta charset="UTF-8">
	</head>

	<body>
	<div class="modal-header">
   		<h3 class="modal-title">
   			<img class="img-header" src="img/imagen.png"> Registro de usuarios (Empaque)
   		</h3>
    </div>
    <div style="width:80%; margin: 30px auto">
		<form class="form-horizontal" role="form" method="post" action="usuarios/registro_nuevo_usuario_admin.php">
	      	<div class="modal-body" style="width:50%; float: left">
	  		<div class="alert alert-info">DATOS DEL USUARIO</div>
	      		<div class="form-group">
			    	<label class="col-sm-3 control-label">Usuario: </label>
			    	<div class="col-sm-8">
			    		<input type="text" class="form-control input" name="usuario" id="usuario" placeholder="Usuario normal del empaque" autofocus required>
			    		<div id="disponible"></div>
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label class="col-sm-3 control-label">Contraseña: </label>
			    	<div class="col-sm-8">
			    		<input type="password" class="form-control input" name="contrasena_usuario" id="" placeholder="Contraseña" required>
		         	</div>
				  </div>
				  <hr>
				  <div class="form-group">
			    	<label class="col-sm-3 control-label">Nombre: </label>
			    	<div class="col-sm-8">
			    		<input type="text" pattern="[A-Za-z ÑñáéíóúÁÉÍÓÚ]*" class="form-control input" name="nombre_usuario_empaque" id="" placeholder="Nombre del usuario del empaque" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-3 control-label">Apellidos: </label>
			    	<div class="col-sm-8">
			    		<input type="text" pattern="[A-Za-z ÑñáéíóúÁÉÍÓÚ]*" class="form-control input" name="apellido_usuario_empaque" id="" placeholder="Apellidos del usuario del empaque" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-3 control-label">Teléfono: </label>
			    	<div class="col-sm-8">
			    		<input type="text" pattern="[0-9][0-9][0-9][0-9][0-9][0-9][0-9]*" class="form-control input" name="telefono_usuario_empaque" id="" placeholder="Teléfono del usuario del empaque" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-3 control-label">Dirección: </label>
			    	<div class="col-sm-8">
			    		<input type="text" class="form-control input" name="direccion_usuario_empaque" id="" placeholder="Dirección del usuario del empaque" required>
		         	</div>
				  </div>
			  	</div>
			  	<div class="modal-body" style="width:40%; float: right">
     		    <div class="alert alert-info">PRIVILEGIOS</div>
     		    
			  	<div class="form-group alert alert-warning">
			    	<div class="col-sm-10">
			    		<label><input name="pedidos" value="1" type="checkbox"> Pedidos &nbsp;&nbsp;&nbsp;</label>
			    		<label><input name="lotes" value="1" type="checkbox"> Lotes &nbsp;&nbsp;&nbsp;</label>
			    		<label><input name="envios" value="1" type="checkbox"> Envíos &nbsp;&nbsp;&nbsp;</label>
		         	</div>
				  </div>
			  	<hr>
			  	<center>
			  			<a href="index.php?op=admon_users" class="btn btn-default" data-dismiss="modal" style="width:150px">Atrás</a>
		     			<button style="width: 150px" type="submit" class="btn btn-primary" id="enviar"><i  class="glyphicon glyphicon-ok"></i> Registrar</button>
		     			<input type="hidden" name="url" value="../index.php?op=admon_users">
		     		</center>
		     	</div>
		     </div>
	     </form>	
		<div style="clear:both"></div>
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
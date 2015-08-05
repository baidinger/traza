<?php @session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Trazabilidad</title>
		<meta charset="UTF-8">
		<!--<link rel="stylesheet" type="text/css" href="../css/estilos.css">-->
	</head>
	<body>		
		<div class="contenido-general" style="width: 600px; margin: 100px auto">
			<div class="contenido-general-2">
				<div class="div-contenedor-form">
					<form class="form-horizontal" role="form" method="post" action="../mod/cambiar_contrasena.php">
			      		<div class="modal-header">
			        		<h3 class="titulo-header">
			        			<img class="img-header" src="../img/contrasena.png"> Cambiar Contraseña
			        		</h3>
			      		</div>
			      		<div>
					      	<div class="modal-body">
					      		<div class="form-group">
							    	<label class="col-sm-2 control-label">Actual: </label>
							    	<div class="col-sm-10">
							    		<input type="password" class="form-control input" name="inputActual" id="inputActual" placeholder="Contraseña actual..." autofocus required>
							    		<div id="disponible"></div>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Nueva: </label>
							    	<div class="col-sm-10">
							    		<input type="password" class="form-control input" name="inputNueva" id="inputNueva" placeholder="Contraseña nueva..." onkeyup="compararContrasena();" required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Repetir: </label>
							    	<div class="col-sm-10">
							    		<input type="password" class="form-control input" name="inputRepetir" id="inputRepetir" placeholder="Repetir contraseña..." onkeyup="compararContrasena();" required>
							    	</div>
							  	</div>
							  	<div id="respuesta">
							  		<?php if(isset($_REQUEST['e'])){ ?>
								  		<div class="alert alert-danger alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<strong>Error!</strong> La contraseña actual es incorrecta.
										</div>
								  	<?php } ?>
							  	</div>
							  	<hr>
							  	<center>
							  		<a href="../" class="btn btn-danger"><i  class="glyphicon glyphicon-remove"></i> Cancelar</a>
					      			<button type="submit" class="btn btn-primary" id="btn-cambiar" disabled="disabled"><i  class="glyphicon glyphicon-floppy-disk"></i> Guardar Cambios</button>
					      		</center>
					      	</div>
					    </div>
					    <input type="hidden" name="url" value="../empaque/index.php?op=contrasena"> 
			      	</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>

		<script type="text/javascript">
			function compararContrasena(){
				var contrasena1 = $('#inputNueva').val();
				var contrasena2 = $('#inputRepetir').val();

				if(contrasena1 == contrasena2){
					$('#respuesta').html('');
					$('#btn-cambiar').removeAttr('disabled');
				}
				else{
					$('#respuesta').html("<div class='alert alert-danger alert-dismissible' role='alert'>" +
											"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
											"<strong>Advertencia!</strong> Las contraseñas no coinciden." +
										"</div>");
					$('#btn-cambiar').attr('disabled', 'disabled');
				}
			}

			$('#inputActual').change(function(){
			var contra = $('#inputActual').val();
			var params = {'usuario':<?php print $_SESSION['id_usuario'] ?>, 'contra':contra};
			$.ajax({
				type: 'POST',
				url: 'validar/validar_contrasena.php',
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
	</body>
</html>
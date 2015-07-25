<?php
	@session_start();

	if(!isset($_SESSION['tipo_socio'])){
		header('Location: ../');
	}
	else{
		switch($_SESSION['tipo_socio']) {
			case 1: header('Location: ../../productor/');
					break;
			case 2: header('Location: ../../empaque/');
					break;
			case 4: header('Location: ../../puntoVenta/');
					break;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Trazabilidad</title>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=0.5">
		<link rel="shortcut icon" href="../../img/logo_trazabilidad.png" type='image/png'>

		<link rel="stylesheet" type="text/css" href="../../lib/bootstrap-3.3.5/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" type="text/css" href="../../lib/bootstrap-3.3.5/css/bootstrap-responsive.min.css" rel="stylesheet"> -->
		<link rel="stylesheet" type="text/css" href="../../css/estilos.css">
	</head>

	<body>
		<?php 
			include('../mod/navbar.php');
		?>
		<div class="contenido-general">
			<div class="modal-header">
        		<h3 class="titulo-header">
        			<img class="img-header" src="../../img/contrasena.png"> Cambiar Contraseña
        		</h3>
      		</div>
			<div class="contenido-general-2">
				<div class="div-contenedor-form">
					<form class="form-horizontal" role="form" method="post" action="../../mod/cambiar_contrasena.php">
			      		<div>
					      	<div class="modal-body">
					      		<div class="form-group">
							    	<label class="col-sm-2 control-label">Actual: </label>
							    	<div class="col-sm-10">
							    		<input type="password" class="form-control input" name="inputActual" id="inputActual" placeholder="Contraseña actual..." autofocus required>
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
					    <input type="hidden" name="url" value="../distribuidor/contrasena/index.php">
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
		</script>
	</body>
</html>
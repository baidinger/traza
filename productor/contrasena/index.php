<?php
	@session_start();

	if(!isset($_SESSION['tipo_socio'])){
		header('Location: ../');
	}
	else{
		switch($_SESSION['tipo_socio']) {
			case 2: header('Location: ../empaque/');
					break;
			case 3: header('Location: ../distribuidor/');
					break;
			case 4: header('Location: ../puntoVenta/');
					break;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Trazabilidad</title>
		<meta charset="UTF-8">

		<link rel="stylesheet" type="text/css" href="../../lib/bootstrap-3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../../css/estilos.css">
	</head>

	<body>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		  	<div class="navbar-header">
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
		      		<span class="sr-only">Toggle navigation</span>
		    	</button>
		    	<a class="navbar-brand">PRODUCTOR</a>
		  	</div>
		  	<div class="collapse navbar-collapse" id="navbar-collapse-01">
		    	<ul class="nav navbar-nav navbar-right">
			        <li class="dropdown active">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fui-user"></span> &nbsp;<?php echo $_SESSION['nombre_usuario']; ?> <span class="caret"></span></a>
		          		<ul class="dropdown-menu" role="menu">
		            		<li class="active"><a href="#"><span class="fui-new"></span> &nbsp;Cambiar contraseña</a></li>
		            		<li><a href="../datosGenerales/"><span class="fui-gear"></span> &nbsp;Datos generales</a></li>
		            		<li class="divider"></li>
		            		<li><a href="../../mod/logout.php"><span class="fui-power"></span> &nbsp;Cerrar sesión</a></li>
		          		</ul>
			        </li>
			    </ul>
		  	</div>
		</nav>
		<div class="contenido-general">
			<div class="modal-header">
	    		<h3 class="titulo-header">
	    			<img class="img-header" src="../../img/contrasena.png"> Cambiar Contraseña
	    		</h3>
	  		</div>
			<div class="contenido-general-2">
				<div class="div-contenedor-form">
					<form class="form-horizontal" role="form" method="post" action="../mod/cambiar_contrasena.php">
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
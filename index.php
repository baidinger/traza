<?php
	@session_start();

	if(isset($_SESSION['tipo_socio'])){
		switch($_SESSION['tipo_socio']) {
			case 1: header('Location: productor/');
					break;
			case 2: header('Location: empaque/');
					break;
			case 3: header('Location: distribuidor/');
					break;
			case 4: header('Location: puntoVenta/');
					break;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Trazabilidad</title>
		<meta charset="UTF-8">

		<link rel="stylesheet" type="text/css" href="lib/bootstrap-3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
	</head>

	<body>
		<div class="pagina">
			<div class="contenedor-logeo">
				<div class="login-form">
					<form class="form-horizontal" role="form" method="post" action="mod/login.php">
			      		<div class="modal-header">
			        		<h3 class="titulo-header">
			        			<img class="img-header" src="img/login.png"> Iniciar Sesión
			        		</h3>
			      		</div>
			      		<div>
					      	<div class="modal-body">
					      		<div class="form-group">
							    	<label class="col-sm-2 control-label">Usuario: </label>
							    	<div class="col-sm-10">
							    		<input type="text" class="form-control input" name="inputUsuario" id="inputUsuario" placeholder="Nombre de usuario..." autofocus required>
							    	</div>
							  	</div>
							  	<br>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Contraseña: </label>
							    	<div class="col-sm-10">
							    		<input type="password" class="form-control input" name="inputContrasena" id="inputContrasena" placeholder="Contraseña..." required>
							    	</div>
							  	</div>
							  	<?php if(isset($_REQUEST['e'])){ ?>
							  		<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<strong>Error!</strong> Usuario y/o contraseña incorrecto(s).
									</div>
							  	<?php } ?>
							  	<hr>
							  	<center>
					      			<button type="submit" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Aceptar</button>
					      		</center>
					      	</div>
					    </div>
			      	</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>
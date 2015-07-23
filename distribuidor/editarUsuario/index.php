<?php
	@session_start();

	if(!isset($_SESSION['tipo_socio']) || $_SESSION['nivel_socio'] != 1){
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
		    	<a class="navbar-brand">DISTRIBUIDOR</a>
		  	</div>
		  	<div class="collapse navbar-collapse" id="navbar-collapse-01">
		  		<ul class="nav navbar-nav">
					<li class="dropdown">
  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;Órdenes <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
    						<li><a href="../nuevaOrden/">Nueva órden</a></li>
				            <li class="divider"></li>
				            <li><a href="../">Historial de órdenes</a></li>
							<li><a href="../entradasOrdenes/">Entrada de órdenes</a></li>
  						</ul>
					</li>
					<li class="dropdown">
  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;Pedidos <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
    						<li><a href="../nuevoEnvio/">Registrar envío</a></li>
    						<li class="divider"></li>
				            <li><a href="../pedidos/">Historial de pedidos</a></li>
							<li><a href="../enviosPedidos/">Envío de pedidos</a></li>
  						</ul>
					</li>
		      		<li class="dropdown">
  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> &nbsp;Usuarios <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
    						<li><a href="../nuevoUsuario/">Nuevo usuario</a></li>
    						<li class="divider"></li>
				            <li><a href="../usuarios/">Administrar usuarios</a></li>
  						</ul>
					</li>
		    	</ul>

		    	<ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fui-user"></span> &nbsp;<?php echo $_SESSION['nombre_usuario']; ?> <span class="caret"></span></a>
		          		<ul class="dropdown-menu" role="menu">
		            		<li><a href="../contrasena/"><span class="fui-new"></span> &nbsp;Cambiar contraseña</a></li>
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
        			<img class="img-header" src="../../img/editar_usuario.png"> Editar Usuario
        		</h3>
      		</div>
			<div class="contenido-general-2">
				<div class="div-contenedor-form">
					<form class="form-horizontal" role="form" method="post" action="../mod/editar_usuario.php">
			      		<div>
			      			<?php
			      				$idUsuarioDist = $_POST['usuario_dist'];
			      				$idUsuarioFK = $_POST['usuario_fk'];

			      				include('../../mod/conexion.php');

			      				$consulta = "SELECT * FROM usuario_distribuidor WHERE id_usuario_distribuidor = $idUsuarioDist";
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      			?>
					      	<div class="modal-body">
					      		<div class="form-group">
							    	<label class="col-sm-2 control-label">Nombre: </label>
							    	<div class="col-sm-10">
							    		<input type="text" class="form-control input" name="inputNombre" id="inputNombre" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" placeholder="Nombre del usuario..." value="<?php echo $row['nombre_usuario_distribuidor']; ?>" autofocus required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Apellidos: </label>
							    	<div class="col-sm-10">
							    		<input type="text" class="form-control input" name="inputApellidos" id="inputApellidos" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" placeholder="Apellidos del usuario..." value="<?php echo $row['apellido_usuario_distribuidor']; ?>" required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Dirección: </label>
							    	<div class="col-sm-10">
							    		<input type="text" class="form-control input" name="inputDireccion" id="inputDireccion" placeholder="Dirección del usuario..." value="<?php echo $row['direccion_usuario_distribuidor']; ?>" required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Teléfono: </label>
							    	<div class="col-sm-10">
							    		<input type="text" class="form-control input" name="inputTelefono" id="inputTelefono" pattern="[0-9]{10}|[0-9]{11}|[0-9]{12}|[0-9]{13}" title="Ingresa 10, 11, 12 y 13 dígitos" placeholder="Teléfono del usuario..." value="<?php echo $row['telefono_usuario_distribuidor']; ?>" required>
							    	</div>
							  	</div>
							  	<input type="hidden" name="inputUsuarioDist" value="<?php echo $idUsuarioDist; ?>">
							  	<input type="hidden" name="inputUsuarioFK" value="<?php echo $idUsuarioFK; ?>">
							  	<hr>
							  	<center>
							  		<a href="../usuarios/" class="btn btn-danger"><i  class="glyphicon glyphicon-remove"></i> Cancelar</a>
					      			<button type="submit" class="btn btn-primary"><i  class="glyphicon glyphicon-floppy-disk"></i> Guardar Cambios</button>
					      		</center>
					      	</div>
					    </div>
			      	</form>
					<?php
						mysql_close();
					?>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>
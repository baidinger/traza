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
					<?php 
						if($_SESSION['nivel_socio'] == 1){ ?>
							<li class="dropdown">
		  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> &nbsp;Usuarios <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
		    						<li><a href="../nuevoUsuario/">Nuevo usuario</a></li>
		    						<li class="divider"></li>
						            <li><a href="../usuarios/">Administrar usuarios</a></li>
		  						</ul>
							</li>
						<?php }
					?>
		    	</ul>

		    	<ul class="nav navbar-nav navbar-right">
			        <li class="dropdown active">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fui-user"></span> &nbsp;<?php echo $_SESSION['nombre_usuario']; ?> <span class="caret"></span></a>
		          		<ul class="dropdown-menu" role="menu">
		            		<li><a href="../contrasena/"><span class="fui-new"></span> &nbsp;Cambiar contraseña</a></li>
		            		<li class="active"><a href="#"><span class="fui-gear"></span> &nbsp;Datos generales</a></li>
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
        			<img class="img-header" src="../../img/login.png"> Datos Generales
        		</h3>
      		</div>
			<div class="contenido-general-2">
				<div class="div-contenedor-form">
					<form class="form-horizontal" role="form" method="post" action="../mod/editar_usuario.php">
			      		<div>
			      			<?php
			      				include('../../mod/conexion.php');

			      				$consulta = "SELECT usudist.nombre_usuario_distribuidor, usudist.apellido_usuario_distribuidor, usus.nivel_autorizacion_usuario, usus.fecha_creacion_usuario, usus.fecha_modificacion_usuario, usudist.direccion_usuario_distribuidor, usudist.telefono_usuario_distribuidor FROM usuarios AS usus, usuario_distribuidor AS usudist WHERE usudist.id_usuario_fk = usus.id_usuario AND usus.id_usuario = ".$_SESSION['id_usuario'];
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      			?>
					      	<div class="modal-body">
					      		<table class="table">
					      			<tbody>
					      				<tr>
					      					<td><strong>Nombre:</strong></td>
					      					<td><?php echo $row['nombre_usuario_distribuidor']." ".$row['apellido_usuario_distribuidor']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Usuario:</strong></td>
					      					<td><?php echo $_SESSION['nombre_usuario']; ?> </td>
					      				</tr>
					      				<tr>
					      					<td><strong>Contraseña:</strong></td>
					      					<td><a href="../contrasena/">*****************************</a></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Tipo de Socio:</strong></td>
					      					<td>DISTRIBUIDOR</td>
					      				</tr>
					      				<tr>
					      					<td><strong>Nivel de Usuario:</strong></td>
					      					<td>
					      						<?php 
					      							if($row['nivel_autorizacion_usuario'] == 1)
					      								echo "USUARIO ADMINISTRADOR";
					      							else
					      								echo "USUARIO NORMAL";
					      						?>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td><strong>Fecha de Creación:</strong></td>
					      					<td><?php echo $row['fecha_creacion_usuario']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Fecha de Modificación:</strong></td>
					      					<td><?php echo $row['fecha_modificacion_usuario']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Dirección:</strong></td>
					      					<td><?php echo $row['direccion_usuario_distribuidor']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Teléfono:</strong></td>
					      					<td><?php echo $row['telefono_usuario_distribuidor']; ?></td>
					      				</tr>
					      			</tbody>
					      		</table>
					      		<center>
					      			<a href="../" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Regresar</a>
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
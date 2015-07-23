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

			      	 			$consulta = "SELECT prdtes.id_productor, prdtes.nombre_productor, prdtes.apellido_productor, usus.nivel_autorizacion_usuario, usus.fecha_creacion_usuario, usus.fecha_modificacion_usuario, prdtes.direccion_productor, prdtes.telefono_productor FROM usuarios AS usus, empresa_productores AS prdtes WHERE prdtes.id_usuario_fk = usus.id_usuario AND usus.id_usuario = ".$_SESSION['id_usuario'];
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      				$idProductor = $row['id_productor'];
			      			?>
					      	<div class="modal-body">
					      		<table class="table">
					      			<tbody>
					      				<tr>
					      					<td><strong>Nombre:</strong></td>
					      					<td><?php echo $row['nombre_productor']." ".$row['apellido_productor']; ?></td>
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
					      					<td>PRODUCTOR</td>
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
					      					<td><?php echo $row['direccion_productor']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Teléfono:</strong></td>
					      					<td><?php echo $row['telefono_productor']; ?></td>
					      				</tr>
					      			</tbody>
					      		</table>

					      		<table class="table">
					      			<thead>
					      				<tr>
					      					<th colspan="3">Productos que Ofrece</th>
					      				</tr>
					      			</thead>
					      			<tbody>
					      				<?php 
					      					$cont = 1;
							      			$consulta = "SELECT prds.nombre_producto, prds.variedad_producto, prdsprdtes.descripcion_detalles_pp FROM productos AS prds, productos_productores AS prdsprdtes WHERE prdsprdtes.id_producto_fk = prds.id_producto AND prdsprdtes.id_productor_fk = $idProductor";
						      				$resultado = mysql_query($consulta);
						      				while($row = mysql_fetch_array($resultado)){ ?>
						      					<tr>
						      						<td><?php echo $cont; ?></td>
						      						<td><?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?></td>
						      						<td><?php echo $row['descripcion_detalles_pp']; ?></td>
						      					</tr>
						      				<?php $cont++;
						      				}
							      		?>
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
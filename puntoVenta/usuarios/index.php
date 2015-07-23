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
			case 3: header('Location: ../../distribuidor/');
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
		<link rel='stylesheet' type='text/css' href='../../lib/pagination/css.css'/>
		<link rel="stylesheet" type="text/css" href="../../css/estilos.css">
	</head>

	<body>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		  	<div class="navbar-header">
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
		      		<span class="sr-only">Toggle navigation</span>
		    	</button>
		    	<a class="navbar-brand">PUNTO DE VENTA</a>
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
					<?php 
						if($_SESSION['nivel_socio'] == 1){ ?>
							<li class="dropdown active">
		  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> &nbsp;Usuarios <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
		    						<li><a href="../nuevoUsuario/">Nuevo usuario</a></li>
		    						<li class="divider"></li>
						            <li class="active"><a href="#">Administrar usuarios</a></li>
		  						</ul>
							</li>
						<?php }
					?>
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
					<h3 class="titulo-contenido">Administración de Usuarios</h3>
				</h3>
			</div>
			<div class="contenido-general-2">
				<br>
				<div id="mensaje">
				<?php if(isset($_REQUEST['e'])){ ?>
			  		<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> Ha ocurrido un error al insertar los datos.
					</div>
			  	<?php } ?>
			  	</div>
				<div id="paginacion-resultados">
					<table class="table">
						<thead>
							<tr>
								<th class="centro">#</th>
								<th>Nombre del Usuario</th>
								<th>Usuario</th>
								<th class="centro">Tipo</th>
								<th>Dirección</th>
								<th class="centro">Teléfono</th>
								<th></th>
							</tr>
						</thead>

						<tbody>
							<?php
								include('../../mod/conexion.php');

								$consulta = "SELECT id_usuario_punto_venta FROM usuario_punto_venta WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      				$idPuntoVentaFK = $row['id_usuario_punto_venta'];

								$cont = 1;
								$consulta = "SELECT usus.id_usuario, usudist.id_usuario_pv, usudist.nombre_usuario_pv, usudist.apellidos_usuario_pv, usus.nombre_usuario, usus.nivel_autorizacion_usuario, usudist.direccion_usuario_pv, usudist.telefono_usuario_pv, usus.estado_usuario FROM usuario_punto_venta AS usudist, usuarios AS usus WHERE usudist.id_usuario_punto_venta = $idPuntoVentaFK AND usudist.id_usuario_fk = usus.id_usuario";
								$resultado = mysql_query($consulta);
								while($row = mysql_fetch_array($resultado)){ ?>
									<tr>
						          		<td class="centro"><?php echo $cont; ?></td>
						          		<td><?php echo $nombreUsuario = $row['nombre_usuario_pv']." ".$row['apellidos_usuario_pv']; ?></td>
						          		<td><?php echo $row['nombre_usuario']; ?></td>
						          		<td class="centro">
						          			<?php
						          				$estado = $row['nivel_autorizacion_usuario'];

						          				switch($estado) {
						          					case '1': echo "ADMINISTRADOR"; break;
						          					case '2': echo "USUARIO NORMAL"; break;
						          				}
						          			?>
						          		</td>
						          		<td>
						          			<?php
						          				$direccion = $row['direccion_usuario_pv'];
						          				if(strlen($direccion) > 20){
							      					$direccion = substr($direccion, 0, 20);
													$direccion = $direccion."...";
							      				}

							      				echo $direccion;
						          			?>
						          		</td>
						          		<td class="centro"><?php echo $row['telefono_usuario_pv']; ?></td>
						          		<td class="derecha">
						          			<?php 
						          				$idUsuarioFk = $row['id_usuario'];
						          				$estadoUsuario = $row['estado_usuario'];
						          			?>
						          			<button class="btn btn-primary btn-editar" data-toggle="tooltip" data-placement="top" title="Editar usuario" onClick="editarUsuario(<?php echo $row['id_usuario_pv']; ?>, '<?php echo $idUsuarioFk; ?>', '<?php echo $nombreUsuario; ?>')"><i class="glyphicon glyphicon-pencil"></i></button>
							        		<?php 
							        			if($estadoUsuario == 0){ ?>
							        				<button class="btn btn-success btn-baja" data-toggle="tooltip" data-placement="top" title="Dar de alta" onClick="altaUsuario('<?php echo $idUsuarioFk; ?>', '<?php echo $nombreUsuario; ?>')"><i class="glyphicon glyphicon-ok"></i></button>
						          				<?php } else{ ?>
						          					<button class="btn btn-danger btn-alta" data-toggle="tooltip" data-placement="top" title="Dar de baja" onClick="bajaUsuario('<?php echo $idUsuarioFk; ?>', '<?php echo $nombreUsuario; ?>')"><i class="glyphicon glyphicon-remove"></i></button>
						          				<?php }
							        		?>
							        	</td>
						    	    </tr>
								<?php $cont++; 
								}
							?>
						</tbody>
					</table>

					<?php if($cont > 1){ ?>
						<div class="my-navigation" style="margin: 0px auto;">
							<div class="simple-pagination-page-numbers"></div>
							<br><br><br>
						</div>
					<?php } else{ ?>
						<div class="alert alert-info" role="alert" style="text-align: center;">
							<strong>Sin resultados...</strong> No hay usuarios registrados.
						</div>
					<?php } ?>

					<?php 
						mysql_close();
					?>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../../lib/pagination/jquery-simple-pagination-plugin.js"></script>

		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
			$('.btn-editar').tooltip();
			$('.btn-baja').tooltip();
			$('.btn-alta').tooltip();

			function editarUsuario(usuario, usuariofk, nombre){
				var parametros = {'usuario_dist': usuario, 'usuario_fk': usuariofk};

				var body = document.body;
				form = document.createElement('form'); 
				form.method = 'POST'; 
				form.action = '../editarUsuario/';

				for (index in parametros) {
					var input = document.createElement('input');
					input.type = 'hidden';
					input.name = index;
					input.id = index;
					input.value = parametros[index];
					form.appendChild(input);
				}
				
				body.appendChild(form);
				form.submit();
			}

			function bajaUsuario(usuariofk, nombre){
				var respuesta = confirm("¿Desea dar de baja al usuario " + nombre + "?");
			    if(respuesta){
					$.post('../mod/baja_usuario.php', {'usuario_fk': usuariofk},
						function(data){
							if(data == 'ERROR'){
								$('#mensaje').html("<div class='alert alert-danger' role='alert' style='text-align: center;'> " +
														"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> " +
														"<strong>Error!</strong> No se puede eliminar al usuario porque es la sesión actual. " +
													"</div>");
							}else{
								$(location).attr('href', '../usuarios/');
							}
						}
					);
			    }
			}

			function altaUsuario(usuariofk, nombre){
				var respuesta = confirm("¿Desea dar de alta al usuario " + nombre + "?");
			    if(respuesta){
					$.post('../mod/alta_usuario.php', {'usuario_fk': usuariofk},
						function(data){
							$(location).attr('href', '../usuarios/');
						}
					);
			    }
			}
		</script>
	</body>
</html>
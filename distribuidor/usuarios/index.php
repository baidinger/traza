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
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=0.5">
		<link rel="shortcut icon" href="../../img/logo_trazabilidad.png" type='image/png'>

		<link rel="stylesheet" type="text/css" href="../../lib/bootstrap-3.3.5/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" type="text/css" href="../../lib/bootstrap-3.3.5/css/bootstrap-responsive.min.css" rel="stylesheet"> -->
		<link rel='stylesheet' type='text/css' href='../../lib/pagination/css.css'/>
		<link rel="stylesheet" type="text/css" href="../../css/estilos.css">
	</head>

	<body>
		<?php 
			include('../mod/navbar.php');
		?>
		<div class="contenido-general">
			<div class="modal-header">
				<h3 class="titulo-header">
					<h3 class="titulo-contenido">
						<img class="img-header" src="../../img/login.png"> <span id="lbl-titulo">Administración de Usuarios</span>
					</h3>
				</h3>
			</div>
			<br>
			<div class="div-buscar">
				<div class="form-inline">
					<input type="text" class="form-control" style="width: 40%;" name="inputBuscar" id="inputBuscar" placeholder="Buscar por nombre del usuario..." onkeyup="if(event.keyCode == 13) buscarUsuarios();" autofocus>
					<button class="btn btn-primary" id="btnBuscar" onclick="buscarUsuarios();"><i class="glyphicon glyphicon-search"></i> Buscar</button>
					<a href="../usuarios/" class="btn btn-info" id="btn-mostrar-todos" style="float: right; display: none;" id="btnBuscar"><i class="glyphicon glyphicon-th-list"></i> Mostrar Todos</a>
				</div>
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

								$consulta = "SELECT id_distribuidor_fk FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      				$idDistribuidorFK = $row['id_distribuidor_fk'];

								$cont = 1;
								$consulta = "SELECT usus.id_usuario, usudist.id_usuario_distribuidor, usudist.nombre_usuario_distribuidor, usudist.apellido_usuario_distribuidor, usus.nombre_usuario, usus.nivel_autorizacion_usuario, usudist.direccion_usuario_distribuidor, usudist.telefono_usuario_distribuidor, usus.estado_usuario FROM usuario_distribuidor AS usudist, usuarios AS usus WHERE usudist.id_distribuidor_fk = $idDistribuidorFK AND usudist.id_usuario_fk = usus.id_usuario";
								$resultado = mysql_query($consulta);
								while($row = mysql_fetch_array($resultado)){ ?>
									<tr>
						          		<td class="centro"><?php echo $cont; ?></td>
						          		<td><?php echo $nombreUsuario = $row['nombre_usuario_distribuidor']." ".$row['apellido_usuario_distribuidor']; ?></td>
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
						          				$direccion = $row['direccion_usuario_distribuidor'];
						          				if(strlen($direccion) > 20){
							      					$direccion = substr($direccion, 0, 20);
													$direccion = $direccion."...";
							      				}

							      				echo $direccion;
						          			?>
						          		</td>
						          		<td class="centro"><?php echo $row['telefono_usuario_distribuidor']; ?></td>
						          		<td class="derecha">
						          			<?php 
						          				$idUsuarioFk = $row['id_usuario'];
						          				$estadoUsuario = $row['estado_usuario'];
						          			?>
						          			<button class="btn btn-primary btn-editar" data-toggle="tooltip" data-placement="top" title="Editar usuario" onClick="editarUsuario(<?php echo $row['id_usuario_distribuidor']; ?>, '<?php echo $idUsuarioFk; ?>', '<?php echo $nombreUsuario; ?>')"><i class="glyphicon glyphicon-pencil"></i></button>
							        		<?php 
							        			if($row['id_usuario'] != $_SESSION['id_usuario']){
							        				if($estadoUsuario == 0){ ?>
								        				<button class="btn btn-success btn-baja" data-toggle="tooltip" data-placement="top" title="Dar de alta" onClick="altaUsuario('<?php echo $idUsuarioFk; ?>', '<?php echo $nombreUsuario; ?>')"><i class="glyphicon glyphicon-ok"></i></button>
							          				<?php } else{ ?>
							          					<button class="btn btn-danger btn-alta" data-toggle="tooltip" data-placement="top" title="Dar de baja" onClick="bajaUsuario('<?php echo $idUsuarioFk; ?>', '<?php echo $nombreUsuario; ?>')"><i class="glyphicon glyphicon-remove"></i></button>
							          				<?php }
							        			}
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

			function buscarUsuarios(){
				var usuarioBuscar = $('#inputBuscar').val();

				if(usuarioBuscar != ''){
					$.ajax({
						type: 'POST',
						url: '../mod/buscar_usuarios.php',
						data: {'usuario':usuarioBuscar},

						beforeSend: function(){
							$('.contenido-general-2').html("<br><center><img id='img-cargando' src='../../img/cargando.gif'></center>");
						},

						success: function(data){
							$('.img-header').attr('src', '../../img/buscar.png');
							$('#lbl-titulo').text('Resultado de la búsqueda "' + usuarioBuscar + '"');
							$('#inputBuscar').select();
							$('#btn-mostrar-todos').css('display', 'block');
							$('.contenido-general-2').html(data);
						}
					});
				}
			}

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
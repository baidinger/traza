<!DOCTYPE html>
<html>
	<head>

	</head>

	<body>
		<br>
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
						$usuario = $_POST['usuario'];

						include('../../mod/conexion.php');

						$consulta = "SELECT id_distribuidor_fk FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
	      				$resultado = mysql_query($consulta);
	      				$row = mysql_fetch_array($resultado);
	      				$idDistribuidorFK = $row['id_distribuidor_fk'];

						$cont = 1;
						$consulta = "SELECT usus.id_usuario, usudist.id_usuario_distribuidor, usudist.nombre_usuario_distribuidor, usudist.apellido_usuario_distribuidor, usus.nombre_usuario, usus.nivel_autorizacion_usuario, usudist.direccion_usuario_distribuidor, usudist.telefono_usuario_distribuidor, usus.estado_usuario FROM usuario_distribuidor AS usudist, usuarios AS usus WHERE usudist.id_distribuidor_fk = $idDistribuidorFK AND usudist.id_usuario_fk = usus.id_usuario AND (usudist.nombre_usuario_distribuidor LIKE '%$usuario%' OR usudist.apellido_usuario_distribuidor LIKE '%$usuario%')";
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
					<strong>Sin resultados...</strong> No coincidencias para "<?php echo $usuario; ?>".
				</div>
			<?php } ?>

			<?php 
				mysql_close();
			?>
		</div>
		
		<script type="text/javascript">
			$('#paginacion-resultados').simplePagination();
			$('.btn-editar').tooltip();
			$('.btn-baja').tooltip();
			$('.btn-alta').tooltip();
		</script>
	</body>
</html>
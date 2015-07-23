<?php 
				$id_receptor = $_POST['id_receptor'];
				$id_empaque = $_POST['id_empaque'];
				$id_usuario = $_POST['id_usuario'];
				

				include('../../mod/conexion.php');
				$consulta = "select * from usuario_empaque, usuarios where usuarios.id_usuario = ".$id_usuario." AND usuario_empaque.id_empaque_fk = $id_empaque AND usuario_empaque.id_receptor = $id_receptor";
				$result_receptores = mysql_query($consulta);
				$i=1;
				if($result_receptores){
					$row = mysql_fetch_array($result_receptores);
				?>
		<form class="form-horizontal" role="form" method="post" action="usuarios/editar_usuario_empaque_admin.php">
	    		<div>
		      	<div class="modal-body">
		      		<div class="form-group">
				    	<label class="col-sm-2 control-label">Usuario: </label>
				    	<div class="col-sm-10">
				    		<input type="text" id="usuario" value="<?php echo $row['nombre_usuario']; ?>" class="form-control input" name="nombre_usuario" placeholder="Nombre de usuario" required>
				    		<div id="disponible"></div>
			         	</div>
					  </div>
					  <div class="form-group">
				    	<label class="col-sm-2 control-label">Contraseña: </label>
				    	<div class="col-sm-10">
				    		<input type="password" value="<?php echo $row['contrasena_usuario']; ?>" class="form-control input" name="contrasena_usuario" id="" placeholder="Contraseña usuario" required>

			         	</div>
					  </div>
					  <hr>
					  <div class="form-group">
				    	<label class="col-sm-2 control-label">Nombre: </label>
				    	<div class="col-sm-10">
				    		<input type="text" pattern="[A-Za-z ÑñáéíóúÁÉÍÓÚ]*" value="<?php echo $row['nombre_receptor']; ?>" class="form-control input" name="nombre_receptor" placeholder="Nombre del receptor" required>
			         	</div>
					  </div>
					  <div class="form-group">
				    	<label class="col-sm-2 control-label">Apellidos: </label>
				    	<div class="col-sm-10">
				    		<input type="text" pattern="[A-Za-z ÑñáéíóúÁÉÍÓÚ]*" value="<?php echo $row['apellido_receptor']; ?>" class="form-control input" name="apellido_receptor" id="" placeholder="Apellidos del receptor" required>
			         	</div>
					  </div>
					  <div class="form-group">
				    	<label class="col-sm-2 control-label">Teléfono: </label>
				    	<div class="col-sm-10">
				    		<input type="text" pattern="[0-9]*" value="<?php echo $row['telefono_receptor']; ?>" class="form-control input" name="telefono_receptor" id="" placeholder="Telefono del receptor" required>
			         	</div>
					  </div>
					  <div class="form-group">
				    	<label class="col-sm-2 control-label">Dirección: </label>
				    	<div class="col-sm-10">
				    		<input type="text" value="<?php echo $row['direccion_receptor']; ?>" class="form-control input" name="direccion_receptor" id="" placeholder="Dirección del receptor" required>
			         	</div>
					  </div>
					  
					  <?php  if($row['nivel_autorizacion_usuario'] == '2') { ?>
					  <hr>
					  <div class="form-group">
				    	<label class="col-sm-2 control-label">Privilegios: </label>
				    	<div class="col-sm-10">
				    		<input <?php echo ($row['pedidos'] == '1') ? 'checked' : '' ?> name="pedidos" value="1" type="checkbox"> Pedidos &nbsp;&nbsp;&nbsp;
				    		<input <?php echo ($row['lotes'] == '1') ? 'checked' : '' ?> name="lotes" value="1" type="checkbox"> Lotes &nbsp;&nbsp;&nbsp;
				    		<input <?php echo ($row['envios'] == '1') ? 'checked' : '' ?> name="envios" value="1" type="checkbox"> Envíos &nbsp;&nbsp;&nbsp;
			         	</div>
					  </div>
					  <?php } ?>
				  <hr>
				  	<center>
			     		<input type="hidden" name="id_receptor" value="<?php echo $row['id_receptor']; ?>">
			     		<input type="hidden" name="id_usuario" value="<?php echo $row['id_usuario']; ?>">
			     		<input type="hidden" name="contra" value="<?php echo $row['contrasena_usuario']; ?>">
			     	</center>

			     	<hr>
			     	<center>
			     	<button type="button" style="width: 150px" class="btn btn-wrong" data-dismiss="modal">Cerrar</button>
			     	<button id="enviar" type="submit" style="width: 150px" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Guardar cambios</button>
			     </center>
			    </div>
		    </div>
		</form>	
		<?php } ?>

	<script type="text/javascript">
		$('#usuario').change(function(){
			var usuario = $('#usuario').val();
			var params = {'usuario':usuario};
			$.ajax({
				type: 'POST',
				url: 'validar/validar_usuario.php',
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
<?php 
			$id_empaque = $_POST['id'];
			include("../../mod/conexion.php");
			$consulta = "select id_empaque, nombre_empaque, rfc_empaque, ".
				"pais_empaque, estado_empaque, ciudad_empaque, direccion_empaque, cp_empaque, ".
				" email_empaque, telefono1_empaque, telefono2_empaque, estado from empresa_empaques 
				where id_empaque = $id_empaque";

			$result = mysql_query($consulta);

			$row = mysql_fetch_array($result);  
			mysql_close($conexion);
?>

<form name="formulario" class="form-horizontal" role="form" method="post" action="busquedas/editar_empaque.php">
     		
    		<div>
	      	<div class="modal-body">

				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Nombre: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" value="<?php echo $row['nombre_empaque']; ?>" class="form-control input" name="nombre_empaque" id="" placeholder="Nombre del empaque" required>
		         	</div>
				  </div>
	 			  <div class="form-group">
			    	<label class="col-sm-2 control-label">RFC: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[A-Za-z]{4}[0-9]{6}[A-Za-z0-9]{3}" title="El RFC debe contener 4 letras, seguido de 6 números y tres caracteres de la homoclave" value="<?php echo $row['rfc_empaque']; ?>" class="form-control input" name="rfc_empaque" id="" placeholder="RFC del empaque" required>
		         	</div>

				  </div>

		 	  	 <div class="form-group">
			    	<label class="col-sm-2 control-label">País: </label>
				    <div class="col-sm-10">
				      	<select class="form-control select select-primary" name="pais" id="select1" onchange="cambiar()">
							<option value="0">MÉXICO</option>
							<option value="1">EEUU</option>
							<option value="2">CANADA</option>
							<option value="3">JAPÓN</option>
							<option value="4">AUSTRALIA</option>
						</select>
				    </div>
			  	</div>
				
				<!-- Estado -->
		 	  	<div class="form-group">
			    	<label class="col-sm-2 control-label">Estado: </label>
				    <div class="col-sm-10">
				       <select class="form-control select select-primary" name="estado" id="select2">
						</select>
				    </div>
			  	</div>
				
		 	  	<div class="form-group">
			    	<label class="col-sm-2 control-label">Ciudad: </label>
				    <div class="col-sm-10">
				      <input type="text" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" value="<?php echo $row['ciudad_empaque'] ?>" class="form-control input"  name="ciudad_empaque" placeholder="Ciudad del empaque" required>
				    </div>
			  	</div>

				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Dirección: </label>
			    	<div class="col-sm-10">
			    		<input type="text"  value="<?php echo $row['direccion_empaque']; ?>" class="form-control input" name="direccion_empaque" placeholder="Dirección del empaque" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">C.P: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[0-9]{5}|[0-9]{6}|[0-9]{7}" title="Ingresa 5, 6 o 7 dígitos" value="<?php echo $row['cp_empaque']; ?>" class="form-control input" name="cp_empaque" id="" placeholder="Código postal" required>
		         	</div>
				  </div>
					
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">E-mail: </label>
			    	<div class="col-sm-10">
			    		<input type="email"value="<?php echo $row['email_empaque']; ?>" class="form-control input" name="email_empaque"  placeholder="Correo electrónico" required>
		         	</div>
				  </div>

				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Teléfono: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[0-9]{10}|[0-9]{11}|[0-9]{12}|[0-9]{13}" title="Ingresa 10, 11, 12 y 13 dígitos" value="<?php echo $row['telefono1_empaque']; ?>" class="form-control input" name="telefono1_empaque"  placeholder="Teléfono" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Teléfono 2: </label>
			    	<div class="col-sm-10">
			    		<input type="text" pattern="[0-9]{10}|[0-9]{11}|[0-9]{12}|[0-9]{13}" title="Ingresa 10, 11, 12 y 13 dígitos" value="<?php echo $row['telefono2_empaque']; ?>" class="form-control input" name="telefono2_empaque"  placeholder="Teléfono alternativo" >
		         	</div>
				  </div>

			  	<hr>
			  	<center>
			  			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		     			<button type="submit" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Registrar</button>
		     			<input type="hidden" name="id_empaque" value="<?php echo $row['id_empaque']; ?>">
		     		</center>
		     	</div>
	    </div>
	     </form>	

	     <?php include("../script/paises.js"); ?>
	     <script type="text/javascript">
	seleccionar(<?php print $row['pais_empaque'] .",". $row['estado_empaque']?>);
</script> 
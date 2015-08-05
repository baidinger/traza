<?php session_start(); if($_SESSION['nivel_socio'] != 1) return;
	$id = $_POST['id'];
	include("../../mod/conexion.php");
	$result_productores = mysql_query("select * from camiones_empaque where id_camion = $id AND id_empaque_fk = ".$_SESSION['id_empaque']);

			$row = mysql_fetch_array($result_productores);  
?>

<form name="formulario" class="form-horizontal" role="form" method="post" action="busquedas/editar_camion.php">
	<div>
  	<div class="modal-body">
	<div class="form-group">
    	<label class="col-sm-4 control-label">Número del camión: </label>
    	<div class="col-sm-6">
    		<input type="text" pattern="[09]*" title="Ingresa solo números" class="form-control input" value="<?php echo $row['id_camion']; ?>" placeholder="Número del camíon" required readOnly>
     	</div>
	</div>
	<div class="form-group">
    	<label class="col-sm-4 control-label">Chofer: </label>
    	<div class="col-sm-6">
    		<input type="text" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Solo letras y sin espacios extras" class="form-control input" value="<?php echo $row['nombre_chofer']; ?>" name="chofer" placeholder="Chofer" required>
     	</div>
  	</div>
	
	<div class="form-group">
    	<label class="col-sm-4 control-label">Placas: </label>
	    <div class="col-sm-6">
	      	<input type="text" pattern="[A-Z0-9-]*" title="Sólo números y letras" class="form-control input" value="<?php echo $row['placas']; ?>" name="placas" required placeholder="Placas">
	    </div>
  	</div>
	
	<div class="form-group">
    	<label class="col-sm-4 control-label">Marca: </label>
    	<div class="col-sm-6">
    		<input type="text" value="<?php echo $row['marca']; ?>" class="form-control input" name="marca" placeholder="marca" required>
     	</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4 control-label">Modelo: </label>
		<div class="col-sm-6">
			<input type="text" pattern="[0-9]*" title="Modelo" value="<?php echo $row['modelo']; ?>" class="form-control input" name="modelo" placeholder="modelo" required>
		</div>
	</div>
	<div class="form-group">
			<label class="col-sm-4 control-label">Descripción: </label>
			<div class="col-sm-6">
				<textarea title="Descripción" class="form-control input" name="descripcion" placeholder="Descripción" required><?php print $row['descripcion_camion'] ?></textarea>
			</div>
		</div>	
			
	<div class="form-group">
		<label class="col-sm-4 control-label">Disponibilidad: </label>
		<div class="col-sm-6">
			<select name="disponibilidad" class="form-control">
				<option <?php if($row['disponibilidad_ce'] == 0) print "selected"?> value="0">Disponible</option>
				<option <?php if($row['disponibilidad_ce'] == 1) print "selected"?> value="1">No disponible</option>
			</select>
	 	</div>
	</div>

	<hr>
	  	<center>
	  		<button type="button" style="width:150px" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	  		<input type="hidden" name="id_camion" value="<?php echo $row['id_camion']; ?>">
	 		<button type="submit" style="width:150px" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Guardar cambios</button>
	 	</center>
    </div>
	</div>
</form>	
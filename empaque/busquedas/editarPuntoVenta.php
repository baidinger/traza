<?php

$id = $_POST['id'];
	include("../../mod/conexion.php");

$result_productores = mysql_query("select id_punto_venta, nombre_punto_venta, rfc_punto_venta, ".
				"pais_punto_venta, estado_punto_venta, ciudad_punto_venta, direccion_punto_venta, ".
				" estado from empresa_punto_venta where 
				id_punto_venta = $id AND id_usuario_que_registro = ".$_SESSION['id_usuario']);
        	
			$row = mysql_fetch_array($result_productores);
?>			   

<form name="formulario" class="form-horizontal" role="form" method="post" action="busquedas/editar_punto_venta.php">
<div>
	<div class="modal-body">

	  <div class="form-group">
    	<label class="col-sm-2 control-label">Nombre: </label>
    	<div class="col-sm-10">
    		<input type="text" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" value="<?php echo $row['nombre_punto_venta']; ?>" class="form-control input" name="nombre_punto_venta" id="" placeholder="Nombre del punto de venta" required>
     	</div>
	  </div>
	  <div class="form-group">
    	<label class="col-sm-2 control-label">RFC: </label>
    	<div class="col-sm-10">
    		<input type="text" pattern="[A-Za-z]{4}[0-9]{6}[A-Za-z0-9]{3}" title="El RFC debe contener 4 letras, seguido de 6 números y tres caracteres de la homoclave" value="<?php echo $row['rfc_punto_venta']; ?>"  class="form-control input" name="rfc_punto_venta" id="" placeholder="RFC del punto de venta" required>
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
	      	<input type="text" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" class="form-control input" value="<?php echo $row['ciudad_punto_venta']?>" name="ciudad_punto_venta" placeholder="Ciudad del punto de venta" required> 
				
	    </div>
  	</div>
	
	<div class="form-group">
    	<label class="col-sm-2 control-label">Dirección: </label>
    	<div class="col-sm-10">
    		<textarea type="text" value="<?php echo $row['direccion_punto_venta']; ?>"  class="form-control input" name="direccion_punto_venta" id="" placeholder="Dirección del punto de venta" required></textarea>
     	</div>
	 </div>
	 

  	<hr>
  	<center>
  			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
  			<input type="hidden" name="id_punto_venta" value="<?php echo $row['id_punto_venta']; ?>">
 			<button type="submit" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Registrar</button>
 		</center>
 	</div>
</div>
</form>	

<?php include("../script/paises.js"); ?>
<script type="text/javascript">
	seleccionar(<?php print $row['pais_punto_venta'] .",". $row['estado_punto_venta']?>);
</script> 
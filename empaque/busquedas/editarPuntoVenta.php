<?php session_start(); if($_SESSION['nivel_socio'] != 1) return; 

$id = $_POST['id'];
	include("../../mod/conexion.php");

$result_productores = mysql_query("select id_punto_venta, nombre_punto_venta, rfc_punto_venta, ".
				"pais_punto_venta, estado_punto_venta, ciudad_punto_venta,cp_punto_venta, telefono_punto_venta, email_punto_venta ,direccion_punto_venta, ".
				" estado_pv from empresa_punto_venta where 
				id_punto_venta = $id AND id_usuario_que_registro = ".$_SESSION['id_usuario']);
        	
			$row = mysql_fetch_array($result_productores);
?>			   
<div class="modal-header">
	<h3 class="modal-title">
		<img class="img-header" src="img/pv.png"> Editar Punto de Venta
	</h3>
</div>
<div style="width:80%; margin: 30px auto">
<form name="formulario" class="form-horizontal" role="form" method="post" action="busquedas/editar_punto_venta.php">
	<div class="modal-body" style="width:50%; float: left">
	  	<div class="alert alert-info">DATOS DEL DISTRIBUIDOR</div>

	  <div class="form-group">
    	<label class="col-sm-3 control-label">Nombre: </label>
    	<div class="col-sm-8">
    		<input type="text" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" value="<?php echo $row['nombre_punto_venta']; ?>" class="form-control input" name="nombre_punto_venta" id="" placeholder="Nombre del punto de venta" required>
     	</div>
	  </div>
	  <div class="form-group">
    	<label class="col-sm-3 control-label">RFC: </label>
    	<div class="col-sm-8">
    		<input type="text" pattern="[A-Za-z]{4}[0-9]{6}[A-Za-z0-9]{3}" title="El RFC debe contener 4 letras, seguido de 6 números y tres caracteres de la homoclave" value="<?php echo $row['rfc_punto_venta']; ?>"  class="form-control input" name="rfc_punto_venta" id="" placeholder="RFC del punto de venta" required>
     	</div>
	  </div>
		
	  <div class="form-group">
    	<label class="col-sm-3 control-label">E-mail: </label>
    	<div class="col-sm-8">
    		<input type="email" class="form-control input" name="email_pv" value="<?php echo $row['email_punto_venta']?>" placeholder="Correo electrónico" required>
     	</div>
	  </div>

	  <div class="form-group">
    	<label class="col-sm-3 control-label">Teléfono: </label>
    	<div class="col-sm-8">
    		<input type="text" pattern="[0-9]{10}|[0-9]{11}|[0-9]{12}|[0-9]{13}" title="Ingresa 10, 11, 12 y 13 dígitos" class="form-control input" value="<?php echo $row['telefono_punto_venta']?>" name="telefono_pv" placeholder="Teléfono" required>
     	</div>
	  </div>

	
	</div>
	  <div class="modal-body" style="width:40%; float: right">
		<div class="alert alert-info">UBICACIÓN DEL PUNTO DE VENTA</div>

		 <div class="form-group">
	    	<label class="col-sm-3 control-label">País: </label>
		    <div class="col-sm-8">
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
	    	<label class="col-sm-3 control-label">Estado: </label>
		    <div class="col-sm-8">
		       <select class="form-control select select-primary" name="estado" id="select2">
				</select>
		    </div>
	  	</div>
	
	  	<div class="form-group">
    	<label class="col-sm-3 control-label">Ciudad: </label>
	    <div class="col-sm-8">
	      	<input type="text" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" class="form-control input" value="<?php echo $row['ciudad_punto_venta']?>" name="ciudad_punto_venta" placeholder="Ciudad del punto de venta" required> 
				
	    </div>
  	</div>
	 <div class="form-group">
    	<label class="col-sm-3 control-label">C.P: </label>
    	<div class="col-sm-8">
    		<input type="text" pattern="[0-9]{5}|[0-9]{6}|[0-9]{7}" title="Ingresa 5, 6 o 7 dígitos" class="form-control input" value="<?php echo $row['cp_punto_venta']?>" name="cp_pv"  placeholder="Código postal" required>
     	</div>
	  </div>

		<div class="form-group">
    	<label class="col-sm-3 control-label">Dirección: </label>
    	<div class="col-sm-8">
    		<textarea type="text" class="form-control input" name="direccion_punto_venta" id="" placeholder="Dirección del punto de venta" required><?php echo $row['direccion_punto_venta']; ?></textarea>
     	</div>
	 </div>

	  	<hr>
	  	<center>
  			<a href="index.php?op=bus_pv" style="width: 150px" type="button" class="btn btn-default" data-dismiss="modal">Regresar</a>
  			<input type="hidden" name="id_punto_venta" value="<?php echo $row['id_punto_venta']; ?>">
 			<button type="submit" style="width: 150px" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Guardar cambios</button>
 		</center>
 	</div>
</form>	
<div style="clear: both"></div>
<p>&nbsp;</p>
</div>

<?php include("../script/paises.js"); ?>
<script type="text/javascript">
	seleccionar(<?php print $row['pais_punto_venta'] .",". $row['estado_punto_venta']?>);
</script> 
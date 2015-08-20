<div class="contenedor-form">		
	<div class="modal-header">
		<h3 class="modal-title">
			<img class="img-header" src="img/RFID.png"> Impresión de etiquetas
		</h3>
	</div>

	<div style="width:50%; margin: 30px auto">
		<form id="formulario" class="form-horizontal" role="form" method="post" action="index.php?paletsgenerados">

      	<div class="modal-body" style="width:100%; float: left">
      		<img src="img/epc_palet.png" width="100%">
      		<p class="label label-primary">Datos del palet</p>
      		<!--<div class="alert alert-info">GENERAR PALETS </div>-->
			  <div class="form-group">
		    	<label class="col-sm-3 control-label">Número de etiquetas (RFID): </label>
		    	<div class="col-sm-9">
		    		<input  type="number" min="0" max="50" class="form-control input" 
		    		name="num" 
		    		placeholder="No. etiquetas" required>
	         	</div>
			  </div>
			  <div class="form-group">
		    	<label class="col-sm-3 control-label">Fruta / Variedad: </label>
		    	<?php 
		    	include("../mod/conexion.php");
		    	$consulta = "SELECT * from productos_empaques, productos WHERE id_producto = id_producto_fk AND id_empaque_fk = $_SESSION[id_empaque]";
		    	$resultado = mysql_query($consulta);
		    	?>
		    	<div class="col-sm-9">
		    		<select name="id_producto" class="form-control">
		    			<?php
		    				if(mysql_num_rows($resultado) > 0)
		    				{		?>
		    					<!--<option class="form-control" value="0">Selecciona una fruta</option>-->
		    	<?php 			while($row = mysql_fetch_array($resultado)){
		    			?>
				    			<option value="<?php print $row['id_producto'] ?>">
				    				<?php print $row['nombre_producto']." ".$row['variedad_producto'] ?>
				    			</option>
				    <?php 		}
				    		}
				    		else
				    		{ 	?>
				    			<option class="form-control">No se encontraron resultados</option>
				   <?php 	}
				    	?>
		    		</select>
	         	</div>
			  </div>
			  <div class="form-group">
		    	<label class="col-sm-3 control-label">Tamaño del palet / núm. cajas: </label>
		    	<div class="col-sm-9">
		    		<input class="form-control" name="tam" required type="number" min="0" max="999">
	         	</div>
			  </div>
		  	<hr>
		  	<center>
	     			<button id="guardar" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Generar etiquetas</button>
	     	</center>
	     		</div>
	    </form>	
	    <div style="clear: both"></div>
	    <p>&nbsp;</p>
    </div>
	
</div>
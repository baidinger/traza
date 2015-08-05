<div class="contenedor-form">		
	<div class="modal-header">
		<h3 class="modal-title">
			<img class="img-header" src="img/RFID.png"> Impresión de etiquetas
		</h3>
	</div>

	<div style="width:50%; margin: 30px auto">
		<form id="formulario" class="form-horizontal" role="form" method="post" action="tags/generarTags.php">

      	<div class="modal-body" style="width:100%; float: left">
      		<div class="alert alert-info">DETALLES DEL LOTE</div>
  		
      		   <div class="form-group">
		    	<label class="col-sm-3 control-label">Número del lote: </label>
		    	<div class="col-sm-9">
		    		<select class="form-control" name="id_lote">
		    		<?php 
		    			include('../../mod/conexion.php');
						$consulta = "SELECT * from lotes where id_empaque_fk = $_SESSION[id_empaque] ORDER BY id_lote DESC";
						$result = mysql_query($consulta);
						if(mysql_num_rows($result) > 0 ){
							 while($row = mysql_fetch_array($result)) {
							 	?>
		    					<option value="<?php print $row['id_lote'] ?>"><?php print $row['id_lote'] . " -- " .$row['fecha_recibo_lote'] ?></option>
					    		<?php } }else{ ?>
					    		<option>No se encuentran lotes</option>

					    		<?php } ?>
		    		</select>
	         	</div>
			  </div>
			  <div class="form-group">
		    	<label class="col-sm-3 control-label">Rend. cajas: </label>
		    	<div class="col-sm-9">
		    		<input type="number" class="form-control input" 
		    		name="cantidad_cajas" 
		    		placeholder="Rendimiento de cajas" required min ="0">
	         	</div>
			  </div>
			  <div class="form-group">
		    	<label class="col-sm-3 control-label">Rend. kilos: </label>
		    	<div class="col-sm-9">
		    		<input type="number" class="form-control input" 
		    		name="cantidad_kilos" 
		    		placeholder="Rendimiento de kilos" min="0" required>
	         	</div>
			  </div>
			  <div class="form-group">
		    	<label class="col-sm-3 control-label">Número de etiquetas (RFID): </label>
		    	<div class="col-sm-9">
		    		<input  type="number" min="0" class="form-control input" 
		    		name="numero_etiquetas" 
		    		placeholder="No. etiquetas" required>
	         	</div>
			  </div>
		  	<hr>
		  	<center>
	     			<button id="guardar" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Generar etiquetas</button>
	     			<input type="hidden" name="url" value="../index.php?op=admon_lotes">
	     	</center>
	     		</div>
	    </form>	
    </div>
	
	 </div>

		<?php mysql_close(); ?>
<div class="contenedor-form">		
	<div class="modal-header">
		<h3 class="modal-title">
			<img class="img-header" src="img/RFID.png"> Impresión de etiquetas
		</h3>
	</div>

	<div style="width:50%; margin: 30px auto">
		<form id="formulario" class="form-horizontal" role="form" method="post" action="tags/generartagspalets.php">

      	<div class="modal-body" style="width:100%; float: left">
      		<div class="alert alert-info">GENERAR PALETS </div>
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
	     	</center>
	     		</div>
	    </form>	
    </div>
	
</div>
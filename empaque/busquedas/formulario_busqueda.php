<div class="contenedor-form">
			
	  		<div class="modal-header">
	    		<h3 class="modal-title">
	    			<img class="img-header" src="img/<?php print $imagen; ?>"> <?php print $titulo ?>
	    		</h3>
	  		</div>

	  	</div>

	  	<!-- buscar -->
	<div  class="busqueda-form">
		<div class="form-group">
	    	<label for="inputBuscar" style="margin-top:5px;margin-right:10px" class="col-sm-1 control-label">Buscar</label>
	    	<div class="col-sm-10">
	      		<input onkeyup="if(event.keyCode == 13) buscar();" type="text" class="form-control" id="inputBuscar" placeholder="<?php print $placeholder ?>">
	    	</div>
	  	</div>
	</div>
	<div style="float:left; margin-top: 20px; margin-left:10px;">
		<button  data-toggle="tooltip" class="btn btn-primary" onclick="buscar()"><span class="glyphicon glyphicon-search"></span> Buscar</button>
		<button  data-toggle="tooltip" title="Búsqueda avanzada" class="btn btn-primary" ><span class="glyphicon glyphicon-filter"></span>&nbsp;</button>			
	</div>
	<div style="float:right; margin-top: 20px; margin-right:50px;">
		<!--<button data-toggle="tooltip" title="Registrar" class="btn btn-success" ><span class="glyphicon glyphicon-plus"></span>&nbsp;</button>-->
		<button data-toggle="tooltip" title="Estadísticas" class="btn btn-success" ><span class="glyphicon glyphicon-stats"></span>&nbsp;</button>
		<button  data-toggle="tooltip" title="Generar reporte" class="btn btn-success"><span class="glyphicon glyphicon-save-file"></span>&nbsp;</button>
	</div>


<!-- -->
<p>&nbsp;</p>
<p>&nbsp;</p>
<hr>
<p>&nbsp;</p>
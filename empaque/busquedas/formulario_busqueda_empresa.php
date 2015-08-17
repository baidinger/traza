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
		<button  data-toggle="modal" data-target="#avanzada" data-toggle="tooltip" title="Búsqueda avanzada" class="btn btn-primary" ><span class="glyphicon glyphicon-filter"></span>&nbsp;</button>			
	</div>
	<div style="float:right; margin-top: 20px; margin-right:50px;">
		<?php if($_SESSION['nivel_socio'] == 1){ ?>
		<a href="<?php print $ruta ?>" data-toggle="tooltip" title="Registrar" class="btn btn-success" ><span class="glyphicon glyphicon-plus"></span>&nbsp;</a>
		<?php } ?>
		<button data-toggle="modal" data-target="#infoestadistica" title="Estadísticas" class="btn btn-success" ><span class="glyphicon glyphicon-stats"></span>&nbsp;</button>
		<button  data-toggle="tooltip" title="Generar reporte" class="btn btn-success"><span class="glyphicon glyphicon-save-file"></span>&nbsp;</button>
	</div>


<div style="clear: both"></div>
<hr>


<div class="modal fade"  id="infoestadistica" role="dialog" >
	  <div class="modal-dialog" style="width: 700px" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h3 class="modal-title"><div>Estadística</div></h3>
	      </div>
	      <div class="modal-body">
	      	<div id="grafica"></div>
	  		<div style="clear:both"></div>
	  		<p>&nbsp;</p>
		  </div>
		  <div class="modal-footer">
		  	<center>
			    <button style="width: 150px" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		<!--	    <button onclick="aplicar()" style="width: 150px" class="btn btn-primary" data-dismiss="modal">Aplicar</button>-->
			    <input type="hidden" id="filtro">
		    </center>
	      </div>
	    </div>
	  </div>
	</div>

<div class="contenedor-form">
	<div class="modal-header">
		<h3 class="modal-title">
			<img class="img-header" src="img/camion.png"> Registrar camión
		</h3>
	</div>
	<div style="width:80%; margin: 30px auto">
	  <form class="form-horizontal" role="form" method="post" action="registros/registro_camion_admin.php">
	  	<div class="modal-body" style="width:50%; margin: 30px auto">

	  	<div class="alert alert-info">DATOS DEL CAMIÓN</div>
		<div class="form-group">
	    	<label class="col-sm-4 control-label">Chofer: </label>
	    	<div class="col-sm-6">
	    		<input type="text" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Solo letras y sin espacios extras" class="form-control input" name="chofer" placeholder="Chofer" required>
	     	</div>
	  	</div>
		
		<div class="form-group">
	    	<label class="col-sm-4 control-label">Placas: </label>
		    <div class="col-sm-6">
		      	<input type="text" pattern="[A-Z0-9-]*" title="Sólo números y letras" class="form-control input" name="placas" required placeholder="Placas">
		    </div>
	  	</div>
		
		<div class="form-group">
	    	<label class="col-sm-4 control-label">Marca: </label>
	    	<div class="col-sm-6">
	    		<input type="text" class="form-control input" name="marca" placeholder="marca" required>
	     	</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Modelo: </label>
			<div class="col-sm-6">
				<input type="text" pattern="[0-9]*" title="Modelo" class="form-control input" name="modelo" placeholder="modelo" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Descripción: </label>
			<div class="col-sm-6">
				<textarea title="Descripción" class="form-control input" name="descripcion" placeholder="Descripción" required></textarea>
			</div>
		</div>	

		<hr>
		  	<center>
		 		<button type="submit" style="width:150px" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Registrar</button>
		 	</center>
	    </div>  	
	 </form>	
	 <div style="clear:both"></div>
	</div>
</div>
	

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
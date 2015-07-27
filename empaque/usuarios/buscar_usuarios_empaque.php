
<html>
<head>
<link rel='stylesheet' type='text/css' href='../lib/pagination/css.css'/>
<link rel="stylesheet" type="text/css" href="css/views.css">
</head>
<body>

<div class="contenedor-form">
			<?php 
			$titulo = "Búsqueda de usuarios del empaque";
			$placeholder="Buscar usuario / nombre";
			$imagen = "imagen.png";
			include("../busquedas/formulario_busqueda.php"); ?>

	  		<!--<div class="modal-header">
	    		<h3 class="modal-title">
	    			<img class="img-header" src="img/imagen.png"> Búsqueda de usuarios del empaque
	    		</h3>
	  		</div>

	  	</div>

	  	<div class="busqueda-form">
				<div class="form-group">
			    	<label for="inputBuscar" class="col-sm-2 control-label">Buscar</label>
			    	<div class="col-sm-10">
			      		<input onkeyup="if(event.keyCode == 13) buscar();" type="text" class="form-control" id="inputBuscar" placeholder="Buscar usuario">
			    	</div>
			  	</div>
		</div>

		<div style="float:left; margin-top: 20px; margin-left:10px;">
			<button type="submit" class="btn btn-primary" onclick="buscar()">Buscar</button>
		</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>-->
<div style="clear:both"></div>
<div id="data">
	
</div>
	

</body>
<script type="text/javascript">
		
			function buscar(){
				var Buscar = $('#inputBuscar').val();

					var params = {'buscar':Buscar};

					$.ajax({
						type: 'POST',
						url: 'usuarios/buscar_usuarios.php',
						data: params,

						success: function(data){
							$('#data').html(data);
							$('#inputBuscar').select();
						},
						beforeSend: function(data ) {
					    $("#data").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
					});

			}

			function editar(id_receptor, id_empaque, id_usuario){
					var params = {'id_receptor':id_receptor, 'id_empaque': id_empaque, 'id_usuario': id_usuario};
					$.ajax({
						type: 'POST',
						url: 'usuarios/editar_usuario_empaque.php',
						data: params,

						success: function(data){
							$('#data-child').html(data);
						},

						beforeSend: function(data ) {
					    $("#data-child").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
					});
			}

			function ver(id_receptor){

					var params = {'id':id_receptor};

					$.ajax({
						type: 'POST',
						url: 'usuarios/ver_receptor.php',
						data: params,

						success: function(data){
							$('#data-child1').html(data);
						},

						beforeSend: function(data ) {
					    $("#data-child1").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
					  
					});
			}

			buscar();


		</script>
</html>
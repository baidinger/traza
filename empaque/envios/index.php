<?php   @session_start(); ?>
<!DOCTYPE html>
<html>
	<head lang="ES">
		<title>Trazabilidad</title>
		<meta charset="UTF-8">
		<link rel='stylesheet' type='text/css' href='../lib/pagination/css.css'/>
		<link rel="stylesheet" type="text/css" href="css/views.css">
	</head>

	<body>
<!--

		<div class="contenedor-form">
			
	  		<div class="modal-header">
	    		<h3 class="modal-title">
	    			<img class="img-header" src="img/envios.png"> Búsqueda y registros de envíos
	    		</h3>
	  		</div>

	  	</div>
	
	  	<p>&nbsp;</p>
			<div class="form-inline" style="width:450px; margin: 0 auto">
				<label>Número de orden:</label>
				<input id="numero_orden" type="text" class="form-control">
				<button onclick="registrar()" data-toggle="modal" data-target="#myModal" class="btn btn-success">Registrar envío</button>
			</div>
		<p>&nbsp;</p>
		<hr>
		<p style="width:90%; margin: 0 auto" class="alert alert-info">En la siguiente tabla se muestran los envíos realizados en el embarque</p>
	-->
		<!-- buscar -->

		<?php 
			$titulo = "Búsqueda de envíos";
			$placeholder="Buscar distribuidor";
			$imagen = "envios.png";
			include("../busquedas/formulario_busqueda.php"); ?>
	<!--<div class="busqueda-form">
				<div class="form-group">
			    	<label for="inputBuscar" class="col-sm-2 control-label">Buscar</label>
			    	<div class="col-sm-10">
			      		<input onkeyup="if(event.keyCode == 13) buscar();" type="text" class="form-control" id="inputBuscar" placeholder="Buscar distribuidor">
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
		$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			});
		
		function buscar(){
				var Buscar = $('#inputBuscar').val();
					var params = {'buscar':Buscar};
					$.ajax({
						type: 'POST',
						url: 'envios/coincidencias_envios.php',
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

			buscar();

		function mostrarCajasTarimas(idOrden){
			var parametros = {'idOrden':idOrden};
			//alert(idOrden);

				$.ajax({
					type: 'POST',
					url: 'envios/vistaCajasTarimas.php',
					data: parametros,
					success: function(data){
						$('#id_modalCajasTarimas').html(data);
						/*$('#modalCajasTarimas').modal('show');*/
					},

					beforeSend: function(data ) {
					    $("#id_modalCajasTarimas").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
				});

		}

		function registrar(){
				var params = {id:$('#numero_orden').val()};

				$.ajax({
					type: 'POST',
					url: 'envios/registrar_envio.php',
					data: params,

					success: function(data){
						$('#data-child1').html(data);

					},

					beforeSend: function(data ) {
					    $("#data-child1").html("<center><img src=\"img/cargando.gif\"></center>");
					  }

					
				});
			}

		function cancelar(id_envio, id_orden){
				var params = {id:id_envio, orden:id_orden};
				$("#mititulo").html("Cancelar envío");
				$.ajax({
					type: 'POST',
					url: 'envios/confirmar_cancelacion.php',
					data: params,

					success: function(data){
						$('#data-child1').html(data);
					},

					beforeSend: function(data ) {
					    $("#data-child1").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
				});
			}

			function detalles( id_envio, id_orden ){
				var params = { id:id_envio , orden:id_orden};
				$("#mititulo").html("Detalles envío");
				$.ajax({
					type: 'POST',
					url: 'envios/envio_detalle.php',
					data: params,

					success: function(data){
						$('#data-child1').html(data);
					},

					beforeSend: function(data ) {
					    $("#data-child1").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
				});
			}

		$('span').tooltip();
	</script>
</html>
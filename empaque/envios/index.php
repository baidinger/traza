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

		<?php 
			$titulo = "Búsqueda de envíos";
			$placeholder="Buscar distribuidor / núm. orden / núm envío";
			$imagen = "envios.png";
			include("../busquedas/formulario_busqueda.php"); ?>


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

		function mostrarCajasTarimas(id){
			var parametros = {'idenvio':id};
			//alert(idOrden);
				$("#mititulo").html("Cajas y Palets");
				$.ajax({
					type: 'POST',
					url: 'envios/vistaCajasTarimas.php',
					data: parametros,
					success: function(data){
						$('#data-child1').html(data);
						/*$('#modalCajasTarimas').modal('show');*/
					},

					beforeSend: function(data ) {
					    $("#data-child1").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
				});

		}
/*
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
*/
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
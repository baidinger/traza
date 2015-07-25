<!DOCTYPE html>
<html>
	<head lang="ES">
		<meta charset="UTF-8">
		<link rel='stylesheet' type='text/css' href='../lib/pagination/css.css'/>
		<script type="text/javascript" src="../lib/pagination/jquery-simple-pagination-plugin.js"></script>
	</head>

	<body>
		<?php 
			$titulo = "Búsqueda de productores";
			$placeholder="Buscar productor";
			$imagen = "productor.png";
			include("formulario_busqueda.php"); ?>
		<div style="clear:both"></div>
		<div id="data">

		</div>
	</body>

		
	<script type="text/javascript">
	
		$('.editar').tooltip();
		$('.activar').tooltip();
		$('.desactivar').tooltip();


		function showModalInfo(idProductor){
	
			var params = {'id':idProductor};
					$.ajax({
						type: 'POST',
						url: 'busquedas/verProductor.php',
						data: params,

						success: function(data){
							$('#views').html(data);
						}
					});
		}

		function buscar(){
				var Buscar = $('#inputBuscar').val();
					var params = {'buscar':Buscar};
					$.ajax({
						type: 'POST',
						url: 'busquedas/coincidencias_productores.php',
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

			$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			});
	</script>
</html>
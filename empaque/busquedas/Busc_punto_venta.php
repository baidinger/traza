<!DOCTYPE html>
<html>
	<head lang="ES">
		<title>Trazabilida</title>
		<meta charset="UTF-8">
		<link rel='stylesheet' type='text/css' href='../lib/pagination/css.css'/>
		<link rel="stylesheet" type="text/css" href="css/views.css">
	</head>

	<body>
		<?php 
			$titulo = "Búsqueda de punto de venta";
			$placeholder="Buscar punto de venta";
			$imagen = "pv.png";
			$ruta = "index.php?op=reg_punto_venta";
			include("formulario_busqueda_empresa.php"); ?>
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
						url: 'busquedas/coincidencias_punto_venta.php',
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
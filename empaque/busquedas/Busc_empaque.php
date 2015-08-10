<?php session_start(); if($_SESSION['nivel_socio'] != 1) return; ?>
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
			$titulo = "Búsqueda de empaques";
			$placeholder="Nombre del empaque";
			$imagen = "empaque.png";
			$ruta = "index.php?op=reg_empaque";
			include("formulario_busqueda_empresa.php"); ?>
		
		<div style="clear:both"></div>
		<div id="data">

		</div>
	</body>
	<script type="text/javascript">
		$('.editar').tooltip();
		$('.activar').tooltip();
		$('.desactivar').tooltip();

		function buscar(){
				var Buscar = $('#inputBuscar').val();
					var params = {'buscar':Buscar};
					$.ajax({
						type: 'POST',
						url: 'busquedas/coincidencias_empaques.php',
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
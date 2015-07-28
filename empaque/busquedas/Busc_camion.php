<?php session_start(); if($_SESSION['nivel_socio'] != 1) return; ?>
<!DOCTYPE html>
<html>
	<head lang="ES">
		<meta charset="UTF-8">
		<link rel='stylesheet' type='text/css' href='../lib/pagination/css.css'/>
		<link rel="stylesheet" type="text/css" href="css/views.css">
		<script type="text/javascript" src="../lib/pagination/jquery-simple-pagination-plugin.js"></script>
	</head>

	<body>
		<?php 
			$titulo = "Búsqueda de camiones";
			$placeholder="Buscar núm camión / chofer";
			$imagen = "camion.png";
			$ruta = "index.php?op=reg_camion";
			include("formulario_busqueda_empresa.php"); ?>
		<div style="clear:both"></div>
		<div id="data">

		</div>
	</body>

		
	<script type="text/javascript">
	
		function editar(id){
			$('#myModal').modal('show');
				var params = {'id':id};
				$.ajax({
					type: 'POST',
					url: 'busquedas/editarProductor.php',
					data: params,

					success: function(data){
						$('#data-child').html(data);
					},
					beforeSend: function(data ) {
				    $("#data-child").html("<center><img src=\"img/cargando.gif\"></center>");
				  }
				});
			}

		function showModalInfo(idProductor){
	
			var params = {'id':idProductor};
					$.ajax({
						type: 'POST',
						url: 'busquedas/verProductor.php',
						data: params,

						success: function(data){
							$('#views').html(data);
						},
						beforeSend: function(data ) {
					    $("#data-child").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
					});
		}

		function buscar(){
				var Buscar = $('#inputBuscar').val();
					var params = {'buscar':Buscar};
					$.ajax({
						type: 'POST',
						url: 'busquedas/coincidencias_camiones.php',
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

	</script>
</html>
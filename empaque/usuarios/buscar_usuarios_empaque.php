
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
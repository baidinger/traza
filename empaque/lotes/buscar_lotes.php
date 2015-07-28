<html>
<head>
<link rel='stylesheet' type='text/css' href='../lib/pagination/css.css'/>
<link rel="stylesheet" type="text/css" href="css/views.css">
</head>
<body>
	<?php 
			$titulo = "Búsqueda de lotes";
			$placeholder="Buscar productor";
			$imagen = "lotes.png";
			include("../busquedas/formulario_busqueda.php"); ?>

<div id="data">
	
</div>


<!-- Modal -->
	<div class="modal fade" id="mimodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">
					<img class="img-header" src="img/informacion.png"> &nbsp;&nbsp;Información del lote
				</h3>
	      </div>
	      <div id="data-child" class="modal-body">

	        
	      </div>
	    </div>
	  </div>
	</div>

	<script type="text/javascript">
		
			function ver(id_lote){

					var params = {'id':id_lote};

					$.ajax({
						type: 'POST',
						url: 'lotes/ver_lote.php',
						data: params,

						success: function(data){
							$('#data-child').html(data);
						},
						beforeSend: function(data ) {
					    $("#data-child").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
					});
			}

			function editar(id_lote, id_productor){
					var params = {'id':id_lote, 'id_productor': id_productor};

					$.ajax({
						type: 'POST',
						url: 'lotes/editar_lote.php',
						data: params,

						success: function(data){
							$('#data-child').html(data);
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
						url: 'lotes/coincidencia_lotes.php',
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

</body>
</html>
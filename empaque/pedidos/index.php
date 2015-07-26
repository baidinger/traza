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
			$titulo = "Búsqueda de pedidos";
			$placeholder="Buscar distribuidor / número orden";
			$imagen = "detalles_orden.png";
			include("../busquedas/formulario_busqueda.php"); ?>
		<!--<div class="contenedor-form">
			
	  		<div class="modal-header">
	    		<h3 class="modal-title">
	    			<img class="img-header" src="../img/detalles_orden.png"> Búsqueda de Pedidos
	    		</h3>
	  		</div>

	  	</div>

	  	 
	<div class="busqueda-form">
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

<
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
						url: 'pedidos/coincidencias_pedidos.php',
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


		function mostrarModalOrdenes(idOrden, descripcion, total, fecha, usuario){
			$('#detallesOrden').html("");
			$('#myModalOrden').modal('show');
			var parametros = {'id_orden':idOrden, 'descripcion': descripcion,'total':total,'fecha':fecha,'usuario':usuario};

			$.ajax({
				type:'post',
				url:'pedidos/detallesOrdenes.php',
				data: parametros,
				success: function(data){
					$('#detallesOrden').html(data);
					
				},
				beforeSend: function(data ) {
			    	$("#detallesOrden").html("<center><img src=\"img/cargando.gif\"></center>");
				}

			});
		}
/*
		function modificarEstado(){
			var id 			=	$('#id').val();
			var estado 		=	$('#estado').val();
			var type		=	"changeState";
			var parametros	=	{'id':id, 'type':type, 'estado':estado};

			$.ajax({
				type:'post',
				url:'pedidos/modificarPedidos.php',
				data: parametros,
				success: function(data){
					$(location).attr('href','index.php?op=pedidos'); 
				}

			});
		}
*/
		function infoModalShow(id, estado){
			if(estado == 6){ 
				$('#info_modal').html(
					'<div class="alert alert-warning" role="alert"> <strong> ¿Seguro? </strong> Al aprobar la orden estás aceptando que se inicie el proceso de embarque. 	</div>'
				);
				$('#titulo_orden').html('¡Aprobar Orden!');
			}
			if(estado == 1){ 
				$('#info_modal').html(
					'<div class="alert alert-warning" role="alert"> <strong> ¿Seguro? </strong> <p>Al hacer esta operación reiniciarás el proceso de la orden. Ten encuenta que puedes causar inconsistencias en el proceso de la orden, te recomendamos lo siguiente</p><ul><li>Contacta al cliente y comunícale que se re-valorará la orden.</li></ul></p>	</div>'
				);
				$('#titulo_orden').html('¡Re-valorar Orden!');
			}
			if(estado == 5){ 
				$('#info_modal').html(
					'<div class="alert alert-danger" role="alert"> <strong> ¿Seguro? </strong> <p>Al cancelar la orden se está expresando que no se puede concluir el proceso de la misma.	</div><label>Motivo de cancelación:</label><textarea required class="form-control" name="motivo"></textarea>'
				);
				$('#titulo_orden').html('¡Cancelar Orden!');

			}
			if(estado == 2){ 
				$('#info_modal').html(
					'<div class="alert alert-danger" role="alert"> <strong> ¿Seguro? </strong> <p>Ten encuenta que si se rechaza una orden se reconoce que el proceso de la orden no ha sido el adecuado</p></div><label>Motivo de rechazo:</label><textarea required class="form-control" name="motivo"></textarea>'
				);
				$('#titulo_orden').html('¡Rechazar Orden!');
			}

			$('#id').val(id);
			$('#estado').val(estado);
			$('#infoModal').modal('show');
		}

	</script>
	
</html>
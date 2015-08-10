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
			$placeholder="Nombre del distribuidor / número orden";
			$imagen = "detalles_orden.png";
			include("../busquedas/formulario_busqueda.php"); ?>
		
	<div style="clear:both"></div>
	<div id="data"></div>

	<div class="modal fade" id="filtro" role="dialog" >
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h3 class="modal-title"><div>Búsqueda avanzada</div></h3>
	      </div>
	      <div class="modal-body">
	      	<div class="form-horizontal">
		   	<div class="form-group">
		    	<label class="col-sm-2 control-label">Estado: </label>
			    <div class="col-sm-9">
			      	<select id="estado" class="form-control input">
			      		<option>-- Elige una opción</option>
			      		<option value="5">Cancel. por empaque</option>
			      		<option value="8">Cancel. por distribuidor</option>
			      		<option value="6">Aprobada</option>
			      		<option value="2">Rechazad. por empaque</option>
			      		<option value="9">Rechazad. por distribuidor</option>
			      		<option value="4">Concretada</option>
			      		<option value="3">Enviada</option>
			      	</select>
			    </div>
	  		</div>
	  		<div class="form-group">
		    	<label class="col-sm-2 control-label">Costo: </label>
			    <div class="col-sm-3">
			      	<select class="form-control input">
			      		<option>---</option>
			      		<option>Menor que</option>
			      		<option>Igual que</option>
			      		<option>Mayor que</option>
			      		<option>Entre</option>
			      	</select>
			    </div>
			    <div class="col-sm-3">
			      	<input class="form-control input" type="number" min="0">
			    </div> 
			    <div class="col-sm-3">
			      	<input class="form-control input" type="number" min="0">
			    </div> 
	  		</div>
	  		<div class="form-group">
		    	<label class="col-sm-2 control-label">Fecha de pedido: </label>
			    <div class="col-sm-3">
			      	<select class="form-control input">
			      		<option>---</option>
			      		<option>Menor que</option>
			      		<option>Igual que</option>
			      		<option>Mayor que</option>
			      		<option>Entre</option>
			      	</select>
			    </div>
			    <div class="col-sm-3">
			      	<input class="form-control input" type="number" min="0">
			    </div> 
			    <div class="col-sm-3">
			      	<input class="form-control input" type="number" min="0">
			    </div> 

	  		</div>

	  		</div>
	  		<div style="clear:both"></div>
	  		<p>&nbsp;</p>
		  </div>
		  <div class="modal-footer">
		  	<center>
			    <button style="width: 150px" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			    <button onclick="aplicar()" style="width: 150px" class="btn btn-primary">Aplicar</button>
			    <input type="hidden" id="filtro">
		    </center>
	      </div>
	    </div>
	  </div>
	</div>



	
	<script type="text/javascript">

		function buscar(){
				var Buscar = $('#inputBuscar').val();
					var params = {'buscar':Buscar, 'filtro':$('#filtro').val()};
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

		function aplicar(){
			alert($("#estado").val());
			$("#filtro").val(" AND estado_orden = '" + $("#estado").val() + "'" );
		}

	</script>
	</body>	
</html>
<!DOCTYPE html>
<html>
	<head lang="ES">
		<title>Trazabilidad</title>
		<meta charset="UTF-8">
		<link rel='stylesheet' type='text/css' href='../lib/pagination/css.css'/>

		<!--<link rel="stylesheet" type="text/css" href="lib/bootstrap-3.3.5/css/bootstrap.min.css">-->
		<!--<link rel="stylesheet" type="text/css" href="css/estilos.css">-->
		
		<style type="text/css"> 
			.modal-header{
				width:100%;
			}

			.contenedor-form{
				width:100%;
			}

			body{
				background: #FFFFFF;
			}

			.fondo-modal-body{
				background: #CEF6CE;
			}

			.fondo-blanco{
				background:#FFFFFF;
			}

			.views{
				background: #FFFFFF;	
			}

			.busqueda-form{
				margin-top: 20px;
				margin-left: 50px;
				width:1000px;
				float:left;

			}

			.formato{
				font-size: 25px;
				font-weight: bold;
			}

			.active{
				font-weight: bold;
				color:#0B6121;
			}

			.desactive{
				font-weight: bold;
				color:#8A0808;
			}

			.centro{
				text-align: center;
			}

			.izquierda{
				text-align: left;
			}

</style> 
	</head>

	<body>
		<div class="contenedor-form">
			
	  		<div class="modal-header">
	    		<h3 class="modal-title">
	    			<img class="img-header" src="../img/detalles_orden.png"> Búsqueda de Pedidos
	    		</h3>
	  		</div>

	  	</div>

	  	<!-- buscar -->
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

<!-- -->
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div style="clear:both"></div>
<div id="data">

</div>
</body>

	


	<script type="text/javascript">
		$('.cancelarOrden').tooltip();
		$('.aprobarOrden').tooltip();
		$('.rechazarOrden').tooltip();

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


		function mostrarModalOrdenes(idOrden, descripcion){
			$('#detallesOrden').html("");

			var parametros = {'id_orden':idOrden, 'descripcion': descripcion};

			$.ajax({
				type:'post',
				url:'pedidos/detallesOrdenes.php',
				data: parametros,
				success: function(data){
					$('#detallesOrden').html(data);
					$('#myModalOrden').modal('show');
				}

			});
		}

		function modalCostoShow(idOrden, costo_orden){
			$('#id_orden').val(idOrden);
			$('#cantidad_costo').val(costo_orden);
			$('#tipo_edicion').val('changeCost');
			$('#myModal').modal('show');
		}

		function modificarCosto(){
			var cost 		= 	$('#cantidad_costo').val();
			var id 			= 	$('#id_orden').val();
			var type		=	$('#tipo_edicion').val();
			var parametros	= 	{'costo': cost, 'id':id, 'type':type};

			$.ajax({
				type:'post',
				url:'pedidos/modificarPedidos.php',
				data: parametros,
				success: function(data){
					$(location).attr('href','index.php?op=pedidos'); 
				}

			});
		}

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

		function infoModalShow(id, estado){
			if(estado == 6){ 
				$('#info_modal').html(
					'<div class="alert alert-warning" role="alert"> <strong> Seguro! </strong> que deseas aprobar esta orden, ya no podrás cambiar el costo.	</div>'
				);
				$('#titulo_orden').html('¡Aprobar Orden!');
			}
			if(estado == 5){ 
				$('#info_modal').html(
					'<div class="alert alert-danger" role="alert"> <strong> Seguro! </strong> que deseas cancelar esta orden, ya no podrás cambiar el estado de la orden.	</div>'
				);
				$('#titulo_orden').html('¡Cancelar Orden!');
			}
			if(estado == 2){ 
				$('#info_modal').html(
					'<div class="alert alert-danger" role="alert"> <strong> Seguro! </strong> que deseas rechazar esta orden, ya no podrás cambiar el estado de la orden.	</div>'
				);
				$('#titulo_orden').html('¡Rechazar Orden!');
			}

			$('#id').val(id);
			$('#estado').val(estado);
			$('#infoModal').modal('show');
		}

	</script>
</html>
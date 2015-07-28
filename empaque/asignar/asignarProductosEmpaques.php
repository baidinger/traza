<?php session_start(); if($_SESSION['nivel_socio'] != 1) return; ?>
<!DOCTYPE html>
<html>
	<head lang="ES">
		<title>Trazabilida</title>
		<meta charset="UTF-8">
		<link rel='stylesheet' type='text/css' href='../lib/pagination/css.css'/>
		<style type="text/css">
			.centro{
				text-align: center;
			}

			.derecha{
				text-align: right;
			}
		</style>

	</head>

	<body>
		<div style="width:100%;" class="contenedor-form">	
	  		<div class="modal-header">
	    		<h3 class="modal-title">
	    			<img class="img-header" src="img/imagen.png"> Asignación de productos a empaque
	    		</h3>
	  		</div>
	  	</div>
	  	<div>
	  		

	  		<?php 
	  				include("../../mod/conexion.php");

	  				$result = mysql_query("select id_productos_empaque, nombre_producto, variedad_producto, precio_compra, precio_venta from productos_empaques join usuario_empaque on productos_empaques.id_empaque_fk = usuario_empaque.id_empaque_fk join productos on productos.id_producto = productos_empaques.id_producto_fk where usuario_empaque.id_usuario_fk =".$_SESSION['id_usuario']);
	  				
	  		 ?>

	  		  <br>
	  			<div style="width:500px; margin:0px auto;" id="e" class="alert alert-danger centro hidden" role="alert">		<strong>Ya existe ese producto en el empaque</strong>
		   	 	</div>
						   <br> 	 	
	  		
	  		<div style="width:800px; padding:20px; background:white; margin:0px auto;">
	  			<div style="width:150px; margin:0px auto;">
	  				<button data-toggle="modal" data-target="#modalProducto" class="btn btn-primary">
	  					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar producto
	  				</button>
	  			</div>
	  			<hr>
	  			<div id="tablaDetalles">
	  				<div id="paginacion-resultados">
		  			<table class="table table-hover">
				    	<thead>
					        <tr>
					          <th class="centro">#</th>
					          <th class="centro">Nombre</th>
					          <th class="centro">Precio compra</th>
					          <th class="centro">Precio venta</th>
					          <th></th>
					          <th></th>
					        </tr>
			      		</thead>
			      		<tbody id="Columnas">
			      			<?php
			      			$i=1;
			      			if(mysql_num_rows($result) > 0){
			      				 
			      				while($row = mysql_fetch_array($result)){
			      					?><tr>
				      						<td class="centro"> <?php echo $i; ?></td>
				      						<td class="centro"><?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?></td>
				      						<td class="centro">$ <?php echo $row['precio_compra']; ?>
				      							<span class="btn-link" style="font-size:12px; cursor: hand" onClick="modalCostoShow(<?php echo $row['id_productos_empaque']; ?>, <?php echo $row['precio_compra']; ?>,1)">Cambiar</span>
				      						</td>
				      						<td class="centro">$ <?php echo $row['precio_venta']; ?>
				      							<span class="btn-link" style="font-size:12px; cursor: hand" onClick="modalCostoShow(<?php echo $row['id_productos_empaque']; ?>, <?php echo $row['precio_venta']; ?>,2)">Cambiar</span>
				      						</td>
				      						<td>
						          				
						          			</td>

				      						<td style="float:right;"> <span onclick="eliminarProducto(<?php echo $row['id_productos_empaque']; ?>)" data-toggle="tooltip" data-placement="top" title="Eliminar" style="cursor:pointer; color:#931111;" class="eliminar glyphicon glyphicon-remove" aria-hidden="true"></span></td>
			      						</tr>
			      					<?php
			      					$i++;
			      				}
		      				}else{
		      			 ?>
						    	 <br><br>
						    	 <br>
						    	 	<div style="width:500px; margin:0px auto;" class="alert alert-info centro" role="alert"> 
						    	 		<strong>No se encontraron PRODUCTOS en el empaque.</strong>
						    	 	</div>
						    	 	<br><br>
				    	<?php
				      		}	
				      	 ?>
			      		</tbody>
			      	</table>

			      	<?php if($i > 1){ ?>
					<div class="my-navigation" style="margin: 0px auto;">
					<div class="simple-pagination-page-numbers"></div>
					<br><br><br>
					</div>
					<?php } ?>

</div>


		      	</div>
	

	  		</div>
	  	</div>

	  	<div class="modal fade bs-example-modal-md" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="titulo-header" style="margin:0">
							<img class="img-header" src="img/buscar.png">
							<span id="titulo-detalles">Buscar Producto</span>
						</h3>
					</div>
					<div class="modal-body" style="background:#FFFFFF;">
						<div class="form-inline">
								<label class="col-sm-2 control-label">Buscar</label>
								<input style="width:60%" placeholder="Buscar nombre del producto" type="text" class="form-control" name="inputBuscarProducto" id="inputBuscarProducto"  onkeyup="if(event.keyCode == 13) buscarProductos();" style="width: 80%;">
								<button type="button" class="btn btn-primary" onclick="buscarProductos()"><i class="glyphicon glyphicon-search"></i> Buscar</button>

						</div>

					<div style="clear:both"></div>
					<p>&nbsp;</p>
						<div id="contenedor-productos">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</div>
		</div>

				<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h3 class="modal-title" id="myModalLabel">Cambiar precio</h3>
			      </div>
			      <div class="modal-body fondo-blanco">
			      	<div style="margin:0px auto; width:400px; height:50px;">
			        	<form class="form-inline" method="post" action="javascript:modificarCosto()">
						  <div class="form-group">
						    <label class="sr-only" for="exampleInputAmount">Cantidad (in dollars)</label>
						    <div class="input-group">
						      <div class="input-group-addon">$</div>
						      	<input type="number" step="0.01" class="form-control" min="0" id="precio_producto" name="precio_producto" placeholder="Cantidad">
						    	<input type="hidden" name="id_productos_empaque" id="id_productos_empaque">
						    	<input type="hidden" name="tipo" id="tipo">
						    </div>
						  </div>
						  <button onclick="" class="btn btn-primary">Aceptar</button>
						  <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
						</form>
					</div>
			      </div>
			    </div>
			  </div>
			</div>

		<script type="text/javascript" src="../lib/pagination/jquery-simple-pagination-plugin.js"></script>

	  	<script type="text/javascript">

	  		$('#paginacion-resultados').simplePagination();
	  		
	  		$('.eliminar').tooltip();

	  		function modalCostoShow(idOrden, costo_orden, tipo){
				$('#id_productos_empaque').val(idOrden);
				$('#tipo').val(tipo);
				$('#precio_producto').val(costo_orden);

				$('#myModal').modal('show');
				$('#precio_producto').focus();
			}

			function modificarCosto(){
				var cost 		= 	$('#precio_producto').val();
				var tipo 		= 	$('#tipo').val();
				var id 			= 	$('#id_productos_empaque').val();
				var parametros	= 	{'costo': cost, 'id':id, 'tipo':tipo};

				$.ajax({
					type:'post',
					url:'asignar/modificar_precio.php',
					data: parametros,
					success: function(data){
							$(location).attr('href','index.php?op=asig_pro_empaque'); 
					}

				});
			}


	  		function eliminarProducto(id_productos_empaque){
	  				var params = {'id':id_productos_empaque};

					$.ajax({
						type: 'POST',
						url: 'asignar/eliminar_productos.php',
						data: params,

						success: function(data){
							$(location).attr('href','index.php?op=asig_pro_empaque');
						}
					});
	  		}
			
			function buscarProductos(){
				var productoBuscar = $('#inputBuscarProducto').val();
			
					var params = {'producto':productoBuscar};

					$.ajax({
						type: 'POST',
						url: 'buscar/buscar_productos.php',
						data: params,

						success: function(data){
							$('#contenedor-productos').html(data);
							$('#inputBuscarProducto').select();
						}
					});
				
			}

			buscarProductos();

			function agregarProducto(idProducto, idEmpaque){

    			var params = {'idProducto':idProducto, 'idEmpaque':idEmpaque};
    			$.ajax({
					type: 'POST',
					url: 'asignar/agregar_producto_empaque.php',
					data: params,

					success: function(data){
						if(data == "e"){
							$('#e').removeClass('hidden');
							$('#modalProducto').modal('hide');
						}else{
							$(location).attr('href','index.php?op=asig_pro_empaque');
						}
					}
				});
			}	


	  	</script>
	</body>

</html>
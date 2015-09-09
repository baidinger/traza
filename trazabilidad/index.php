<?php 
	
	$epc="";
	if(isset($_REQUEST['epc']))
		$epc = $_REQUEST['epc'];

include("../../mod/conexion.php");
?>

<div class="modal-header">
	<?php if(isset($_REQUEST['epc'])) { ?>
		<h3 class="titulo-header"> Trazabilidad: <?php print $epc ?>
			<div style="float: right; margin-top: -8px;">
				<form action="javascript:buscar()" class="form-inline">
					<input type="text" class="form-control" id="epc" name="epc" min="24" max="24" placeholder="Buscar EPC..." style="width: 300px;">
					<input type="submit" class="btn btn-default" value="Buscar">
				</form>
			</div>
		</h3>
	<?php } else{ ?>
		<h3 class="titulo-header">
			<!-- <img class="img-header" src="../../img/logo_trazabilidad.png"> --> &nbsp; 
			<div style="float: right; margin-top: -8px;">
				<form action="javascript:buscar()" class="form-inline">
					<input type="text" class="form-control" id="epc" name="epc" min="24" max="24" placeholder="Buscar EPC..." style="width: 300px;">
					<input type="submit" class="btn btn-default" value="Buscar">
				</form>
			</div>
		</h3>
	<?php } ?>
</div>
<div style="background: #ffffff">
	<?php 
	if(isset($_REQUEST['epc'])) 
	{ 

/******************************************************************

TRAZABILIDAD DE EPC ENVIADO DEL DISTRIBUIDOR Y ENTREGADO AL PUNTO DE VENTA 

*********************************************************************************/

		$consulta = "SELECT ubicacion_huerta, hectareas, nombre_producto, variedad_producto,
			nombre_productor, apellido_productor, rfc_productor, direccion_productor,
			id_lote, id_productor, remitente_lote, epc_tarima, epc_caja.epc_caja, fecha_recibo_lote, hora_recibo_lote, id_empaque, id_distribuidor,
			nombre_empaque, rfc_empaque, id_distribuidor, pais_empaque, estado_empaque, ciudad_empaque ,
			direccion_empaque, cp_empaque, nombre_distribuidor, direccion_distribuidor, cp_distribuidor, 
			ciudad_distribuidor, estado_distribuidor, pais_distribuidor, id_punto_venta, direccion_punto_venta,
			fecha_caducidad, rfc_distribuidor, ciudad_punto_venta, estado_punto_venta, pais_punto_venta, cp_punto_venta,
			ordenes_distribuidor.id_orden as id_orden_distribuidor,
			ordenes_distribuidor.fecha_orden as fecha_orden_distribuidor,
			ordenes_distribuidor.estado_orden as estado_orden_distribuidor,
			envios_empaque.id_camion_fk as num_camion, 
			envios_empaque.id_envio as id_envio_empaque, envios_empaque.fecha_envio as fecha_envio_empaque,
			envios_empaque.estado_envio as estado_envio_empaque,
			entrada_distribuidor.fecha_entrada as fecha_entrada_distribuidor,
			entrada_distribuidor.hora_entrada as hora_entrada_distribuidor,
			nombre_punto_venta, rfc_punto_venta, ordenes_punto_venta.id_orden as id_orden_punto_venta,
			ordenes_punto_venta.fecha_orden as fecha_orden_punto_venta, 
			ordenes_punto_venta.estado_orden as estado_orden_punto_venta,
			envios_distribuidor.id_envio as id_envio_distribuidor,
			envios_distribuidor.fecha_envio as fecha_envio_distribuidor,
			envios_distribuidor.estado_envio as estado_envio_distribuidor,
			envios_distribuidor.id_camion_fk as num_camion_dist,
			fecha_entrada_punto_venta,
			hora_entrada_punto_venta
			 from empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor, entrada_distribuidor, punto_venta_cajas_envio, ordenes_punto_venta, envios_distribuidor, empresa_punto_venta, entrada_punto_venta where entrada_punto_venta.id_envio_fk = envios_distribuidor.id_envio AND empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND entrada_distribuidor.id_envio_fk = envios_empaque.id_envio AND epc_caja.epc_caja = punto_venta_cajas_envio.epc_caja AND punto_venta_cajas_envio.id_envio_fk = envios_distribuidor.id_envio AND envios_distribuidor.id_punto_venta_fk= empresa_punto_venta.id_punto_venta AND ordenes_punto_venta.id_orden = envios_distribuidor.id_orden_dist_fk AND epc_caja.epc_caja = '$epc'";
		$result = mysql_query($consulta);
		if(mysql_num_rows($result) > 0){ 
			if ($row = mysql_fetch_array($result)) { ?>
				
				<p>&nbsp; </p>
				
				<?php 
				include("trazainterna.php");
				include("trazaexterna12.php");
				include("trazaexterna22.php");				
				?>
			    
				
		<?php 
			}
		}
		else
		{

/******************************************************************

TRAZABILIDAD DE EPC ENVIADO DEL DISTRIBUIDOR AL PUNTO DE VENTA 

*********************************************************************************/

			$consulta = "SELECT ubicacion_huerta, hectareas, nombre_producto, variedad_producto,
				nombre_productor, apellido_productor, rfc_productor, direccion_productor,
				id_lote, id_productor, remitente_lote, epc_tarima, epc_caja.epc_caja, fecha_recibo_lote, hora_recibo_lote, id_empaque, id_distribuidor,
				nombre_empaque, rfc_empaque, id_distribuidor, pais_empaque, estado_empaque, ciudad_empaque ,
				direccion_empaque, cp_empaque, nombre_distribuidor, direccion_distribuidor, cp_distribuidor, 
				ciudad_distribuidor, estado_distribuidor, pais_distribuidor, id_punto_venta, direccion_punto_venta,
				fecha_caducidad, rfc_distribuidor, ciudad_punto_venta, estado_punto_venta, pais_punto_venta, cp_punto_venta,
				ordenes_distribuidor.id_orden as id_orden_distribuidor,
				ordenes_distribuidor.fecha_orden as fecha_orden_distribuidor,
				ordenes_distribuidor.estado_orden as estado_orden_distribuidor,
				envios_empaque.id_camion_fk as num_camion, 
				envios_empaque.id_envio as id_envio_empaque, envios_empaque.fecha_envio as fecha_envio_empaque,
				envios_empaque.estado_envio as estado_envio_empaque,
				entrada_distribuidor.fecha_entrada as fecha_entrada_distribuidor,
				entrada_distribuidor.hora_entrada as hora_entrada_distribuidor,
				nombre_punto_venta, rfc_punto_venta, ordenes_punto_venta.id_orden as id_orden_punto_venta,
				ordenes_punto_venta.fecha_orden as fecha_orden_punto_venta, 
				ordenes_punto_venta.estado_orden as estado_orden_punto_venta,
				envios_distribuidor.id_envio as id_envio_distribuidor,
				envios_distribuidor.fecha_envio as fecha_envio_distribuidor,
				envios_distribuidor.estado_envio as estado_envio_distribuidor,
				envios_distribuidor.id_camion_fk as num_camion_dist
				 from empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor, entrada_distribuidor, punto_venta_cajas_envio, ordenes_punto_venta, envios_distribuidor, empresa_punto_venta where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND entrada_distribuidor.id_envio_fk = envios_empaque.id_envio AND epc_caja.epc_caja = punto_venta_cajas_envio.epc_caja AND punto_venta_cajas_envio.id_envio_fk = envios_distribuidor.id_envio AND envios_distribuidor.id_punto_venta_fk= empresa_punto_venta.id_punto_venta AND ordenes_punto_venta.id_orden = envios_distribuidor.id_orden_dist_fk AND epc_caja.epc_caja = '$epc'";
			$result = mysql_query($consulta);
			if(mysql_num_rows($result) > 0){ 
				if ($row = mysql_fetch_array($result)) { 
					include("trazainterna.php");
					include("trazaexterna12.php");
					include("trazaexterna21.php");
				}
			}
			else
			{

/******************************************************************

TRAZABILIDAD DE EPC ENVIADO Y ENTREGADO AL DISTRIBUIDOR

*********************************************************************************/

				//$consulta = "SELECT * from empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor, entrada_distribuidor where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND entrada_distribuidor.id_envio_fk = envios_empaque.id_envio AND epc_caja.epc_caja = '$epc'";
				$consulta = "SELECT ubicacion_huerta, hectareas, nombre_producto, variedad_producto,
					nombre_productor, apellido_productor, rfc_productor, direccion_productor,
					id_lote, id_productor, remitente_lote, epc_tarima, epc_caja.epc_caja, fecha_recibo_lote, hora_recibo_lote, id_empaque, id_distribuidor,
					nombre_empaque, rfc_empaque, id_distribuidor, pais_empaque, estado_empaque, ciudad_empaque ,
					direccion_empaque, cp_empaque, nombre_distribuidor, direccion_distribuidor, cp_distribuidor, 
					ciudad_distribuidor, estado_distribuidor, pais_distribuidor, 
					fecha_caducidad, rfc_distribuidor,
					ordenes_distribuidor.id_orden as id_orden_distribuidor,
					ordenes_distribuidor.fecha_orden as fecha_orden_distribuidor,
					ordenes_distribuidor.estado_orden as estado_orden_distribuidor,
					envios_empaque.id_camion_fk as num_camion, 
					envios_empaque.id_envio as id_envio_empaque, envios_empaque.fecha_envio as fecha_envio_empaque,
					envios_empaque.estado_envio as estado_envio_empaque,
					entrada_distribuidor.fecha_entrada as fecha_entrada_distribuidor,
					entrada_distribuidor.hora_entrada as hora_entrada_distribuidor
					 from empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor, entrada_distribuidor where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND entrada_distribuidor.id_envio_fk = envios_empaque.id_envio AND epc_caja.epc_caja = '$epc'";
				$result = mysql_query($consulta);
				if(mysql_num_rows($result) > 0){ 
					if ($row = mysql_fetch_array($result)) { 
						include("trazainterna.php");
						include("trazaexterna12.php");
					}
				}
				else
				{
/******************************************************************

TRAZABILIDAD DE EPC ENVIADO PERO NO ENTREGADO

*********************************************************************************/
					//$consulta = "SELECT * FROM empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND epc_caja.epc_caja = '$epc'";
					$consulta = "SELECT ubicacion_huerta, hectareas, nombre_producto, variedad_producto,
					nombre_productor, apellido_productor, rfc_productor, direccion_productor,
					id_lote, id_productor, remitente_lote, epc_tarima, epc_caja.epc_caja, fecha_recibo_lote, hora_recibo_lote, id_empaque, id_distribuidor,
					nombre_empaque, rfc_empaque, id_distribuidor, pais_empaque, estado_empaque, ciudad_empaque ,
					direccion_empaque, cp_empaque, nombre_distribuidor, direccion_distribuidor, cp_distribuidor, 
					ciudad_distribuidor, estado_distribuidor, pais_distribuidor, 
					fecha_caducidad, rfc_distribuidor,
					ordenes_distribuidor.id_orden as id_orden_distribuidor,
					ordenes_distribuidor.fecha_orden as fecha_orden_distribuidor,
					ordenes_distribuidor.estado_orden as estado_orden_distribuidor,
					envios_empaque.id_camion_fk as num_camion, 
					envios_empaque.id_envio as id_envio_empaque, envios_empaque.fecha_envio as fecha_envio_empaque,
					envios_empaque.estado_envio as estado_envio_empaque
					 from empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND epc_caja.epc_caja = '$epc'";

					$result = mysql_query($consulta);
					if(mysql_num_rows($result) > 0){
						if ($row = mysql_fetch_array($result)) { 
							include("trazainterna.php");
							include("trazaexterna11.php");
						}
					} 
					else 
					{

/******************************************************************

TRAZABILIDAD EN EL EMPAQUE

*********************************************************************************/
						$consulta = "SELECT * FROM empresa_productores, empresa_empaques, productos_productores, productos, lotes, epc_caja where empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND epc_caja.epc_caja = '$epc'";
						$result = mysql_query($consulta);
						if(mysql_num_rows($result) > 0){
							if ($row = mysql_fetch_array($result)) { 
								include("trazainterna.php");
							}
						}
						else
						{ ?>
							<div class="alert alert-danger" style="width:30%; margin: 50px auto; text-align: center">
								El EPC <?php print $epc ?> no existe en la base de datos.
							</div>
			<?php		}
					}
				}	
			}
		}
		?>
		<div style="clear: both"></div>	
</div>
<?php  
	} 
?>

	<!-- Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="mititulo">EPC incorrecto</h3>
      </div>
      <div class="modal-body fondo-blanco">
      	<div id="data-child1" style="margin:0px auto; ">
        	<div style="text-align: center" class="alert alert-warning">
				<h4>El EPC solo debe contener 24 caracteres. Verifique e intente de nuevo.<h4>
			</div>
			<center>
				<button data-dismiss="modal" style="width:150px;" class="btn btn-primary">Cerrar</button>&nbsp;&nbsp;&nbsp;
			</center>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	function buscar(){
		if($('#epc').val().length < 24 || $('#epc').val().length > 24)
		{
		 	$('#myModal').modal("show");
		}
		else
		{
			$(location).attr('href',"index.php?op=trazabilidad&epc="+$('#epc').val());	
		}
}
</script>


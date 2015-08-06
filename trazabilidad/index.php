<?php 
	
	$epc="";
	if(isset($_REQUEST['epc']))
		$epc = $_REQUEST['epc'];

include("../../mod/conexion.php");
?>

<div class="modal-header">
	<?php if(isset($_REQUEST['epc'])) { ?>
		<h3 class="titulo-header">
			<!-- <img class="img-header" src="../../img/logo_trazabilidad.png"> --> Trazabilidad: <?php echo $epc; ?>
			<div style="float: right; margin-top: -8px;">
				<form action="javascript:buscar()" class="form-inline">
					<input type="text" class="form-control" id="epc" name="epc" min="24" max="24" placeholder="Buscar EPC..." style="width: 300px;">
					<input type="submit" class="btn btn-default" value="Buscar">
					<!-- <label style="color: white"><strong>EPC</strong></label>
					<input id="epc" class="input" name="epc" min="24" max="24">
					<input type="submit" class="btn btn-primary" value="Buscar"> -->
				</form>
			</div>
			<!-- <div style="float: right">
				<form action="javascript:buscar()">
					<label style="color: white"><strong>EPC</strong></label> <input id="epc" class="input" name="epc" min="24" max="24">
					<input type="submit" class="btn btn-primary" value="Buscar">
				</form>
			</div> -->
		</h3>
	<?php } else{ ?>
		<h3 class="titulo-header">
			<!-- <img class="img-header" src="../../img/logo_trazabilidad.png"> --> Trazabilidad: 
			<div style="float: right; margin-top: -8px;">
				<form action="javascript:buscar()" class="form-inline">
					<input type="text" class="form-control" id="epc" name="epc" min="24" max="24" placeholder="Buscar EPC..." style="width: 300px;">
					<input type="submit" class="btn btn-default" value="Buscar">
				</form>
			</div>
		</h3>
	<?php } ?>
</div>

	<?php if(isset($_REQUEST['epc'])) { 

/******************************************************************

TRAZABILIDAD DE EPC ENVIADO DEL DISTRIBUIDOR AL PUNTO DE VENTA

*********************************************************************************/

		$cadena = "SELECT * from empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor, entrada_distribuidor, punto_venta_cajas_envio, envios_distribuidor, empresa_punto_venta where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND entrada_distribuidor.id_envio_fk = envios_empaque.id_envio AND epc_caja.epc_caja = punto_venta_cajas_envio.epc_caja AND punto_venta_cajas_envio.id_envio_fk = envios_distribuidor.id_envio AND envios_distribuidor.id_punto_venta_fk= empresa_punto_venta.id_punto_venta AND epc_caja.epc_caja = '$epc'";

/******************************************************************

TRAZABILIDAD DE EPC ENVIADO Y ENTREGADO AL DISTRIBUIDOR

*********************************************************************************/

		$consulta = "SELECT * from empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor, entrada_distribuidor where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND entrada_distribuidor.id_envio_fk = envios_empaque.id_envio AND epc_caja.epc_caja = '$epc'";
		$result = mysql_query($consulta);
		if(mysql_num_rows($result) > 0){ 
			if ($row = mysql_fetch_array($result)) { ?>
		
		<p>&nbsp;</p>
		<div class="modal-body" style="width:32%; float: left">
      		<div class="alert alert-info">HUERTA</div>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Ubicación</strong></td>
					<td><?php print $row['ubicacion_huerta'] ?></td>
				</tr>
				<tr>
					<td><strong>No. Hectáreas</strong></td>
					<td><?php print $row['hectareas'] ?></td>
				</tr>
				<tr>
					<td><strong>Producto</strong></td>
					<td><?php print $row['nombre_producto']." ". $row['variedad_producto'] ?></td>
				</tr>
			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left;margin-left:1%">
      		<div class="alert alert-info">PRODUCTOR</div>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="100"><strong>Nombre</strong></td>
					<td><?php print $row['nombre_productor']." ".$row['apellido_productor'] ?></td>
				</tr>
				<tr>
					<td><strong>RFC</strong></td>
					<td><?php print $row['rfc_productor'] ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php print $row['direccion_productor'] ?></td>
				</tr>
			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left; margin-left:1%">
      		<div class="alert alert-info">LOTE</div>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Núm. lote</strong></td>
					<td><?php print $row['id_lote'] ?></td>
				</tr>
				<tr>
					<td><strong>Remitente</strong></td>
					<td><?php print $row['remitente_lote'] ?></td>
				</tr>
				<tr>
					<td><strong>fecha recibo</strong></td>
					<td><?php print $row['fecha_recibo_lote'] ?></td>
				</tr>
			</table>
	     </div>
	     <div style="clear:both"></div>
	     <p>&nbsp;</p>
	     <center>
	      <div class="modal-body" style="width:32%; float: left;">
      		<div class="alert alert-info">EMPAQUE</div>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Nombre</strong></td>
					<td><?php print $row['nombre_empaque'] ?></td>
				</tr>
				<tr>
					<td><strong>RFC</strong></td>
					<td><?php print $row['rfc_empaque'] ?></td>
				</tr>
			</table>
			<div class="alert alert-info">DISTRIBUIDOR</div>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Nombre</strong></td>
					<td><?php print $row['nombre_distribuidor'] ?></td>
				</tr>
				<tr>
					<td><strong>RFC</strong></td>
					<td><?php print $row['rfc_distribuidor'] ?></td>
				</tr>
			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left; margin-left:1%">
	  		<div class="alert alert-info">ORDEN DEL DISTRIBUIDOR</div>
				<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Núm. orden</strong></td>
					<td><?php print $row['id_orden'] ?></td>
				</tr>
				<tr>
					<td><strong>fecha</strong></td>
					<td><?php print $row['fecha_orden'] ?></td>
				</tr>
				<tr>
					<td><strong>estado</strong></td>
					<td><?php 
	      					 switch($row['estado_orden']){
	      					 	case 1: echo "<span class='label label-warning'>Pendiente</span>"; break;
	      					 	case 2: echo "<span class='label label-danger'>Rechazado por emp.</span>"; break;
	      					 	case 3: echo "<span class='label label-primary'>Enviado</span>"; break;
	      					 	case 4: echo "<span class='label label-success'>Concretado</span>"; break;
	      					 	case 5: echo "<span class='label label-danger'>Cancel. por emp.</span>"; break;
	      					 	case 6: echo "<span class='label label-success'>Aprobado</span>"; break;
	      					 	case 7: echo "<span class='label label-warning'>Pre-envío</span>"; break;
	      					 	case 8: echo "<span class='label label-danger'>Cancel. por dist.</span>"; break;
	      					 	case 9: echo "<span class='label label-danger'>Rechazado por dist.</span>"; break;
	      					 } ?>
	      			</td>
				</tr>
			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left; margin-left:1%">
	  		<div class="alert alert-info">ENVÍO AL DISTRIBUIDOR</div>
				<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Núm. envío</strong></td>
					<td><?php print $row['id_envio'] ?></td>
				</tr>
				<tr>
					<td><strong>Núm. camión</strong></td>
					<td><?php print $row['id_camion_fk'] ?></td>
				</tr>
				<tr>
					<td><strong>fecha</strong></td>
					<td><?php print $row['fecha_envio'] ?></td>
				</tr>
				<tr>
				<td><strong>estado</strong></td>
					<td><?php 
	      					 switch($row['estado_envio']){
	      					 	case 1: echo "<span class='label label-warning'>Pendiente</span>"; break;
	      					 	case 2: echo "<span class='label label-danger'>Rechazado por emp.</span>"; break;
	      					 	case 3: echo "<span class='label label-primary'>Enviado</span>"; break;
	      					 	case 4: echo "<span class='label label-success'>Concretado</span>"; break;
	      					 	case 5: echo "<span class='label label-danger'>Cancel. por emp.</span>"; break;
	      					 	case 6: echo "<span class='label label-success'>Aprobado</span>"; break;
	      					 	case 7: echo "<span class='label label-warning'>Pre-envío</span>"; break;
	      					 	case 8: echo "<span class='label label-danger'>Cancel. por dist.</span>"; break;
	      					 	case 9: echo "<span class='label label-danger'>Rechazado por dist.</span>"; break;
	      					 } ?>
	      			</td>
	      		</tr>
	      		<tr>
	      			<td><strong>Fecha de entrega<strong></td>
	      			<td><?php print $row['fecha_entrada']." a las ".$row['hora_entrada'] ?></td>
	      		</tr>
			</table>
	     </div>
	     </center>
		<div style="clear: both"></div>
		<p>&nbsp;</p>
		<?php }
		}else{
/******************************************************************

TRAZABILIDAD DE EPC ENVIADO PERO NO ENTREGADO

*********************************************************************************/
		$consulta = "SELECT * FROM empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND epc_caja.epc_caja = '$epc'";

		$result = mysql_query($consulta);
		if(mysql_num_rows($result) > 0){
		if ($row = mysql_fetch_array($result)) { ?>

		<p>&nbsp;</p>
		<div class="modal-body" style="width:32%; float: left">
      		<div class="alert alert-info">HUERTA</div>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Ubicación</strong></td>
					<td><?php print $row['ubicacion_huerta'] ?></td>
				</tr>
				<tr>
					<td><strong>No. Hectáreas</strong></td>
					<td><?php print $row['hectareas'] ?></td>
				</tr>
				<tr>
					<td><strong>Producto</strong></td>
					<td><?php print $row['nombre_producto']." ". $row['variedad_producto'] ?></td>
				</tr>
			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left;margin-left:1%">
      		<div class="alert alert-info">PRODUCTOR</div>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="100"><strong>Nombre</strong></td>
					<td><?php print $row['nombre_productor']." ".$row['apellido_productor'] ?></td>
				</tr>
				<tr>
					<td><strong>RFC</strong></td>
					<td><?php print $row['rfc_productor'] ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php print $row['direccion_productor'] ?></td>
				</tr>
			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left; margin-left:1%">
      		<div class="alert alert-info">LOTE</div>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Núm. lote</strong></td>
					<td><?php print $row['id_lote'] ?></td>
				</tr>
				<tr>
					<td><strong>Remitente</strong></td>
					<td><?php print $row['remitente_lote'] ?></td>
				</tr>
				<tr>
					<td><strong>fecha recibo</strong></td>
					<td><?php print $row['fecha_recibo_lote'] ?></td>
				</tr>
			</table>
	     </div>
	     <div style="clear:both"></div>
	     <p>&nbsp;</p>
	     <center>
	      <div class="modal-body" style="width:32%; float: left;">
      		<div class="alert alert-info">EMPAQUE</div>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Nombre</strong></td>
					<td><?php print $row['nombre_empaque'] ?></td>
				</tr>
				<tr>
					<td><strong>RFC</strong></td>
					<td><?php print $row['rfc_empaque'] ?></td>
				</tr>
			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left; margin-left:1%">
	  		<div class="alert alert-info">ORDEN DEL DISTRIBUIDOR</div>
				<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Núm. orden</strong></td>
					<td><?php print $row['id_orden'] ?></td>
				</tr>
				<tr>
					<td><strong>fecha</strong></td>
					<td><?php print $row['fecha_orden'] ?></td>
				</tr>
				<tr>
					<td><strong>estado</strong></td>
					<td><?php 
	      					 switch($row['estado_orden']){
	      					 	case 1: echo "<span class='label label-warning'>Pendiente</span>"; break;
	      					 	case 2: echo "<span class='label label-danger'>Rechazado por emp.</span>"; break;
	      					 	case 3: echo "<span class='label label-primary'>Enviado</span>"; break;
	      					 	case 4: echo "<span class='label label-success'>Concretado</span>"; break;
	      					 	case 5: echo "<span class='label label-danger'>Cancel. por emp.</span>"; break;
	      					 	case 6: echo "<span class='label label-success'>Aprobado</span>"; break;
	      					 	case 7: echo "<span class='label label-warning'>Pre-envío</span>"; break;
	      					 	case 8: echo "<span class='label label-danger'>Cancel. por dist.</span>"; break;
	      					 	case 9: echo "<span class='label label-danger'>Rechazado por dist.</span>"; break;
	      					 } ?>
	      			</td>
				</tr>

			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left; margin-left:1%">
	  		<div class="alert alert-info">ENVÍO AL DISTRIBUIDOR</div>
				<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Núm. envío</strong></td>
					<td><?php print $row['id_envio'] ?></td>
				</tr>
				<tr>
					<td><strong>Núm. camión</strong></td>
					<td><?php print $row['id_camion_fk'] ?></td>
				</tr>
				<tr>
					<td><strong>fecha</strong></td>
					<td><?php print $row['fecha_envio'] ?></td>
				</tr>
				<tr>
					<td><strong>estado</strong></td>
					<td><?php 
	      					 switch($row['estado_envio']){
	      					 	case 1: echo "<span class='label label-warning'>Pendiente</span>"; break;
	      					 	case 2: echo "<span class='label label-danger'>Rechazado por emp.</span>"; break;
	      					 	case 3: echo "<span class='label label-primary'>Enviado</span>"; break;
	      					 	case 4: echo "<span class='label label-success'>Concretado</span>"; break;
	      					 	case 5: echo "<span class='label label-danger'>Cancel. por emp.</span>"; break;
	      					 	case 6: echo "<span class='label label-success'>Aprobado</span>"; break;
	      					 	case 7: echo "<span class='label label-warning'>Pre-envío</span>"; break;
	      					 	case 8: echo "<span class='label label-danger'>Cancel. por dist.</span>"; break;
	      					 	case 9: echo "<span class='label label-danger'>Rechazado por dist.</span>"; break;
	      					 } ?>
	      			</td>
				</tr>
			</table>
	     </div>
	     </center>
	
			<?php }
		} else {

/******************************************************************

TRAZABILIDAD EN EL EMPAQUE

*********************************************************************************/
		$consulta = "SELECT * FROM empresa_productores, empresa_empaques, productos_productores, productos, lotes, epc_caja where empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND epc_caja.epc_caja = '$epc'";
		$result = mysql_query($consulta);
		if(mysql_num_rows($result) > 0){
		if ($row = mysql_fetch_array($result)) { ?>
		
		<p>&nbsp;</p>
		<div class="modal-body" style="width:32%; float: left">
      		<div class="alert alert-info">HUERTA</div>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Ubicación</strong></td>
					<td><?php print $row['ubicacion_huerta'] ?></td>
				</tr>
				<tr>
					<td><strong>No. Hectáreas</strong></td>
					<td><?php print $row['hectareas'] ?></td>
				</tr>
				<tr>
					<td><strong>Producto</strong></td>
					<td><?php print $row['nombre_producto']." ". $row['variedad_producto'] ?></td>
				</tr>
			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left;margin-left:1%">
      		<div class="alert alert-info">PRODUCTOR</div>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="100"><strong>Nombre</strong></td>
					<td><?php print $row['nombre_productor']." ".$row['apellido_productor'] ?></td>
				</tr>
				<tr>
					<td><strong>RFC</strong></td>
					<td><?php print $row['rfc_productor'] ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php print $row['direccion_productor'] ?></td>
				</tr>
			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left; margin-left:1%">
      		<div class="alert alert-info">LOTE</div>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Núm. lote</strong></td>
					<td><?php print $row['id_lote'] ?></td>
				</tr>
				<tr>
					<td><strong>Remitente</strong></td>
					<td><?php print $row['remitente_lote'] ?></td>
				</tr>
				<tr>
					<td><strong>fecha recibo</strong></td>
					<td><?php print $row['fecha_recibo_lote'] ?></td>
				</tr>
			</table>
	     </div>
	     <div style="clear:both"></div>
	     <p>&nbsp;</p>
	      <div class="modal-body" style="width:32%; float: left;">
      		<div class="alert alert-info">EMPAQUE</div>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Nombre</strong></td>
					<td><?php print $row['nombre_empaque'] ?></td>
				</tr>
				<tr>
					<td><strong>RFC</strong></td>
					<td><?php print $row['rfc_empaque'] ?></td>
				</tr>
			</table>
	     </div>
	
		<?php }
		}else{ ?>

			<div class="alert alert-danger" style="width:30%; margin: 50px auto; text-align: center">
				El EPC <?php print $epc ?> no existe en la base de datos.
			</div>
<?php	}
		}

		}
		//$cadena = "SELECT * FROM empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor, entrada_distribuidor where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND entrada_distribuidor.id_envio_fk = envios_empaque.id_envio AND epc_caja.epc_caja = '$epc'";
		?>
	<p><!--La trazabilidad del EPC <?php print $epc ?> es la que sigue--></p>
	<?php  } ?>

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
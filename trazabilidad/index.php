<?php 
	
	$epc="";
	if(isset($_REQUEST['epc']))
		$epc = $_REQUEST['epc'];


?>

<div class="modal-header">
	<?php if(isset($_REQUEST['epc'])) { ?><label style="float: left; color: white; font-size: 18px"><strong>Trazabilidad: <?php print $epc ?><strong></label> <?php } ?>
	<div style="float: right">
		<form action="javascript:buscar()">
			<label style="color: white"><strong>EPC</strong></label> <input id="epc" class="input" name="epc" min="24" max="24">
			<input type="submit" class="btn btn-primary" value="Buscar">
		</form>
	</div>
	<p>&nbsp;</p>
</div>

	<?php if(isset($_REQUEST['epc'])) { 

		include("../../mod/conexion.php");

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
			</table>
	     </div>
	     </center>
		
			
		<?php }
	} else {

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
	      <div class="modal-body" style="width:32%; float: left; margin-left:1%">
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
		} //fin else
		else
		{ ?>

			<div class="alert alert-danger" style="width:30%; margin: 50px auto; text-align: center">
				El EPC <?php print $epc ?> no existe en la base de datos.
			</div>
<?php	}
	}
	//fin else 
		
		$cadena = "SELECT * FROM empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor, entrada_distribuidor where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND entrada_distribuidor.id_envio_fk = envios_empaque.id_envio AND epc_caja.epc_caja = '$epc'";
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
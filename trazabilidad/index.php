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
	<?php if(isset($_REQUEST['epc'])) { 

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
			envios_distribuidor.id_camion_fk as num_camion_dist,
			fecha_entrada_punto_venta,
			hora_entrada_punto_venta
			 from empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor, entrada_distribuidor, punto_venta_cajas_envio, ordenes_punto_venta, envios_distribuidor, empresa_punto_venta, entrada_punto_venta where entrada_punto_venta.id_envio_fk = envios_distribuidor.id_envio AND empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND entrada_distribuidor.id_envio_fk = envios_empaque.id_envio AND epc_caja.epc_caja = punto_venta_cajas_envio.epc_caja AND punto_venta_cajas_envio.id_envio_fk = envios_distribuidor.id_envio AND envios_distribuidor.id_punto_venta_fk= empresa_punto_venta.id_punto_venta AND ordenes_punto_venta.id_orden = envios_distribuidor.id_orden_dist_fk AND epc_caja.epc_caja = '$epc'";
		$result = mysql_query($consulta);
		if(mysql_num_rows($result) > 0){ 
			if ($row = mysql_fetch_array($result)) { ?>
		
		<p>&nbsp; </p>
		<div style="text-align: center" class="alert alert-info">TRAZABILIDAD INTERNA :: PRODUCTOR <span class="glyphicon glyphicon-arrow-right"></span> EMPAQUE</div>
		<div class="modal-body" style="width:32%; float: left">
      		<!--<div class="alert alert-info">HUERTA Y PRODUCTOR</div>-->
      		<p class="label label-primary">Datos de la huerta</p>
  			<table class="table table-hover" style="font-size: 14px">
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
      		<p class="label label-primary">Datos del productor</p>
  			<table class="table table-hover" style="font-size: 14px">
				<tr>
					<td width="100"><strong>Nombre</strong></td>
					<td><a href="../index.php?productor=<?php print $row['id_productor'] ?>"> <?php print $row['nombre_productor']." ".$row['apellido_productor'] ?></a></td>
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
      		<!--<div class="alert alert-info">LOTE</div>-->
      		<p class="label label-primary">Datos del lote</p>
  			<table class="table table-hover" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Núm. lote</strong></td>
					<td><a href="../index.php?lote=<?php print $row['id_lote'] ?>"> <?php print str_pad($row['id_lote'],3,"0",STR_PAD_LEFT) ?> </a></td>
				</tr>
				<tr>
					<td><strong>Remitente</strong></td>
					<td><?php print $row['remitente_lote'] ?></td>
				</tr>
				<tr>
					<td><strong>Fecha recibo</strong></td>
					<td><?php print $row['fecha_recibo_lote'] ?></td>
				</tr>
				<tr>
					<td><strong>Hora de recibo</strong></td>
					<td><?php print $row['hora_recibo_lote'] ?></td>
				</tr>
				<tr>
					<td><strong>Fecha caducidad</strong></td>
					<td><?php print $row['fecha_caducidad'] ?></td>
				</tr>
			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left; margin-left:1%">
	     	<!--<div class="alert alert-info">EMPAQUE</div>-->
	     	<p class="label label-primary">Datos del empaque</p>
  			<table class="table table-hover" style="font-size: 14px">
				<tr>
					<td width="140"><strong>ID</strong></td>
					<td><a href="../index.php?empaque=<?php print  $row['id_empaque'] ?>"> <?php print str_pad($row['id_empaque'],7,"0",STR_PAD_LEFT) ?> </a></td>
				</tr>

				<tr>
					<td width="140"><strong>Nombre</strong></td>
					<td><a href="../index.php?empaque=<?php print  $row['id_empaque'] ?>"> <?php print $row['nombre_empaque'] ?> </a></td>
				</tr>
				<tr>
					<td><strong>RFC</strong></td>
					<td><?php print $row['rfc_empaque'] ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php print $row['direccion_empaque'].", ".$row['ciudad_empaque'];
					$paises = array("MEXICO","ESTADOS UNIDOS","CANADÁ","JAPÓN","AUSTRALIA");
			          	
								          	$pais_c = $row['pais_empaque'];
								          	$estado_c = $row['estado_empaque'];

								          	print ", ";

								          	$mexico = array("AGUASCALIENTES", "BAJA CALIFORNIA NORTE", "BAJA CALIFORNIA SUR","CAMPECHE","COAHUILA","CHIAPAS","CHIHUAHUA","DURANGO","ESTADO DE MEXICO","GUANAJUATO","GUERRERO","HIDALGO","JALISCO","MICHOACÁN","MORELOS","MÉXICO D.F.","NAYARIT","NUEVO LEÓN","OAXACA","PUEBLA","QUERETARO","QUINTANA ROO","SAN LUIS POTOSÍ","SINALOA","SONORA","TABASCO","TAMAULIPAS","TLAXCALA","VERACRUZ","YUCATÁN","ZACATECAS");
								          	$eua = array("ALABAMA","ALASKA","ARIZONA","ARKANSAS","CALIFORNIA","CALIFORNIA DEL NORTE","CAROLINA DEL SUR","COLORADO","CONNECTICUT","DAKOTA DEL NORTE","DAKOTA DEL SUR","DELAWARE","FLORIDA","GEORGIA","HAWÁI","IDAHO","ILLINOIS","INDIANA","IOWA","KANSAS","KENTUCHY","LUISIANA","MAINE","MARYLAND","Massachusetts","MICHIGAN","MINNESOTA","MISISIPI","MISURI","MONTANA","NEBRASKA","NEVADA","NUEVA JERSEY","NUEVA YORK","NUEVO HAMPSHIRE","NUEVO MEXICO","OHIO","OKLAHOMA","OREGÓN","PENSILVANIA","RHODE ISLAND","TENNESSEE","TEXAS","UTAH","VERMONT","VIRGINIA","VIRGINIA OCCIDENTAL","WASHINGTON","WISCONSIN","WYOMING");
								          	$canada = array("ALBERTA","COLUMBIA BRITANICA","MANITOBA","ISLA DEL PRINCIPE EDUARDO","NUNAVUT5","NUEVA ESCOCIA","NUEVO BRUNSWICK","TERRANOVA Y LABRADOR","TERRITORIOS DEL NOROESTE","SASKATCHEWAN","QUEBEC","YÚKON5");
								          	$japon = array("PREFECTURA DE HOKKAIDO","PREFECTURA DE AOMORI","PREFECTURA DE IWATE","PREFECTURA DE MIYAGI","PREFECTURA DE AKITA","PREFECTURA DE YAMAGATA","PREFECTURA DE FUKUSHIMA","PREFECTURA DE IBARAKI","PREFECTURA DE TOCHIGI","PREFECTURA DE GUNMA","PREFECTURA DE SAITAMA","PREFECTURA DE CHIBA","TOKIO","PREFECTURA DE KANAWA","PREFECTURA DE NIIGATA","PREFECTURA DE TOYAMA","PREFECTURA DE ISHIKAWA","PREFECTURA DE FUKUI","PREFECTURA DE YAMANASHI","PREFECTURA DE NAGANO","PREFECTURA DE GIFU","PREFECTURA DE SHIZUOKA","PREFECTURA DE AICHI","PREFECTURA DE MIE","PREFECTURA DE SHIGA","PREFECTURA DE KIOTO","PREFECTURA DE OSAKA","PREFECTURA DE HYOGO","PREFECTURA DE NARA","PREFECTURA DE WAKAYAMA","PREFECTURA DE TOTTORI","PREFECTURA DE SHIMANE","PREFECTURA DE OKAYAMA","PREFECTURA DE HIROSHIMA","PREFECTURA DE YAMAGUCHI","PREFECTURA DE TOKUSHIMA","PREFECTURA DE KAGAWA","PREFECTURA DE EHIME","PREFECTURA DE KOCHI","PREFECTURA DE FUKUOKA","PREFECTURA DE SAGA","PREFECTURA DE NAGASAKI","PREFECTURA DE KUMAMOTO","PREFECTURA DE OITA","PREFECTURA DE MIYASAKI","PREFECTURA DE KAGOSHIMA","PREFECTURA DE OKINAWA");
								          	$australia = array("NEW SOUTH WALES","TASMANIA","SOUTH AUSTRALIA","QUEENSLAND","WESTERN AUSTRALIA");

								          	switch ($pais_c) {
								          		case '0':
								          			print $mexico[$estado_c];
								          			break;
								          			case '1':
								          			print $eua[$estado_c];
								          			break;
								          			case '2':
								          			print $canada[$estado_c];
								          			break;
								          			case '3':
								          			print $japon[$estado_c];
								          			break;
								          			case '4':
								          			print $australia[$estado_c];
								          			break;
								          	}

								          	print ", $paises[$pais_c]";

								          	print ". CP. ".$row['cp_empaque'] ?></td>
				</tr>
			</table>
	     </div>
	     <div style="clear: both"></div>
	     <div style="text-align: center" class="alert alert-info">TRAZABILIDAD EXTERNA :: EMPAQUE <span class="glyphicon glyphicon-arrow-right"></span> DISTRIBUIDOR</div>
				<div class="modal-body" style="width:32%; float: left; margin-left:1%">
	     	<!--<div class="alert alert-info">EMPAQUE</div>-->
	     	<p class="label label-primary">Datos del empaque</p>
  			<table class="table table-hover" style="font-size: 14px">
				<tr>
					<td width="140"><strong>ID</strong></td>
					<td><a href="../index.php?empaque=<?php print  $row['id_empaque'] ?>"> <?php print str_pad($row['id_empaque'],7,"0",STR_PAD_LEFT) ?> </a></td>
				</tr>

				<tr>
					<td width="140"><strong>Nombre</strong></td>
					<td><a href="../index.php?empaque=<?php print  $row['id_empaque'] ?>"> <?php print $row['nombre_empaque'] ?> </a></td>
				</tr>
				<tr>
					<td><strong>RFC</strong></td>
					<td><?php print $row['rfc_empaque'] ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php print $row['direccion_empaque'].", ".$row['ciudad_empaque'];
					$paises = array("MEXICO","ESTADOS UNIDOS","CANADÁ","JAPÓN","AUSTRALIA");
			          	
								          	$pais_c = $row['pais_empaque'];
								          	$estado_c = $row['estado_empaque'];

								          	print ", ";

								          	$mexico = array("AGUASCALIENTES", "BAJA CALIFORNIA NORTE", "BAJA CALIFORNIA SUR","CAMPECHE","COAHUILA","CHIAPAS","CHIHUAHUA","DURANGO","ESTADO DE MEXICO","GUANAJUATO","GUERRERO","HIDALGO","JALISCO","MICHOACÁN","MORELOS","MÉXICO D.F.","NAYARIT","NUEVO LEÓN","OAXACA","PUEBLA","QUERETARO","QUINTANA ROO","SAN LUIS POTOSÍ","SINALOA","SONORA","TABASCO","TAMAULIPAS","TLAXCALA","VERACRUZ","YUCATÁN","ZACATECAS");
								          	$eua = array("ALABAMA","ALASKA","ARIZONA","ARKANSAS","CALIFORNIA","CALIFORNIA DEL NORTE","CAROLINA DEL SUR","COLORADO","CONNECTICUT","DAKOTA DEL NORTE","DAKOTA DEL SUR","DELAWARE","FLORIDA","GEORGIA","HAWÁI","IDAHO","ILLINOIS","INDIANA","IOWA","KANSAS","KENTUCHY","LUISIANA","MAINE","MARYLAND","Massachusetts","MICHIGAN","MINNESOTA","MISISIPI","MISURI","MONTANA","NEBRASKA","NEVADA","NUEVA JERSEY","NUEVA YORK","NUEVO HAMPSHIRE","NUEVO MEXICO","OHIO","OKLAHOMA","OREGÓN","PENSILVANIA","RHODE ISLAND","TENNESSEE","TEXAS","UTAH","VERMONT","VIRGINIA","VIRGINIA OCCIDENTAL","WASHINGTON","WISCONSIN","WYOMING");
								          	$canada = array("ALBERTA","COLUMBIA BRITANICA","MANITOBA","ISLA DEL PRINCIPE EDUARDO","NUNAVUT5","NUEVA ESCOCIA","NUEVO BRUNSWICK","TERRANOVA Y LABRADOR","TERRITORIOS DEL NOROESTE","SASKATCHEWAN","QUEBEC","YÚKON5");
								          	$japon = array("PREFECTURA DE HOKKAIDO","PREFECTURA DE AOMORI","PREFECTURA DE IWATE","PREFECTURA DE MIYAGI","PREFECTURA DE AKITA","PREFECTURA DE YAMAGATA","PREFECTURA DE FUKUSHIMA","PREFECTURA DE IBARAKI","PREFECTURA DE TOCHIGI","PREFECTURA DE GUNMA","PREFECTURA DE SAITAMA","PREFECTURA DE CHIBA","TOKIO","PREFECTURA DE KANAWA","PREFECTURA DE NIIGATA","PREFECTURA DE TOYAMA","PREFECTURA DE ISHIKAWA","PREFECTURA DE FUKUI","PREFECTURA DE YAMANASHI","PREFECTURA DE NAGANO","PREFECTURA DE GIFU","PREFECTURA DE SHIZUOKA","PREFECTURA DE AICHI","PREFECTURA DE MIE","PREFECTURA DE SHIGA","PREFECTURA DE KIOTO","PREFECTURA DE OSAKA","PREFECTURA DE HYOGO","PREFECTURA DE NARA","PREFECTURA DE WAKAYAMA","PREFECTURA DE TOTTORI","PREFECTURA DE SHIMANE","PREFECTURA DE OKAYAMA","PREFECTURA DE HIROSHIMA","PREFECTURA DE YAMAGUCHI","PREFECTURA DE TOKUSHIMA","PREFECTURA DE KAGAWA","PREFECTURA DE EHIME","PREFECTURA DE KOCHI","PREFECTURA DE FUKUOKA","PREFECTURA DE SAGA","PREFECTURA DE NAGASAKI","PREFECTURA DE KUMAMOTO","PREFECTURA DE OITA","PREFECTURA DE MIYASAKI","PREFECTURA DE KAGOSHIMA","PREFECTURA DE OKINAWA");
								          	$australia = array("NEW SOUTH WALES","TASMANIA","SOUTH AUSTRALIA","QUEENSLAND","WESTERN AUSTRALIA");

								          	switch ($pais_c) {
								          		case '0':
								          			print $mexico[$estado_c];
								          			break;
								          			case '1':
								          			print $eua[$estado_c];
								          			break;
								          			case '2':
								          			print $canada[$estado_c];
								          			break;
								          			case '3':
								          			print $japon[$estado_c];
								          			break;
								          			case '4':
								          			print $australia[$estado_c];
								          			break;
								          	}

								          	print ", $paises[$pais_c]";

								          	print ". CP. ".$row['cp_empaque'] ?></td>
				</tr>
			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left; margin-left:1%">
	  		<!--<div class="alert alert-info">ORDEN DEL DISTRIBUIDOR</div>-->
	  		<p class="label label-primary">Orden EMPAQUE <span class="glyphicon glyphicon-arrow-left"></span> DISTRIBUIDOR</p>
				<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Núm. orden</strong></td>
					<td><?php print str_pad($row['id_orden_distribuidor'],10,"0",STR_PAD_LEFT) ?></td>
				</tr>
				<tr>
					<td><strong>Fecha de la orden</strong></td>
					<td><?php print $row['fecha_orden_distribuidor'] ?></td>
				</tr>
				<tr>
					<td><strong>Estado de la orden</strong></td>
					<td><?php 
	      					 switch($row['estado_orden_distribuidor']){
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
	     <!--</div>
	     <div class="modal-body" style="width:32%; float: left; margin-left:1%">-->
	     	<p class="label label-primary">Envío EMPAQUE <span class="glyphicon glyphicon-arrow-right"></span> DISTRIBUIDOR</p>
	  		<!--<div class="alert alert-info">ENVÍO AL DISTRIBUIDOR</div>-->
				<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Núm. envío</strong></td>
					<td><?php print str_pad($row['id_envio_empaque'],10,"0",STR_PAD_LEFT) ?></td>
				</tr>
				<tr>
					<td><strong>Núm. camión</strong></td>
					<td><a href="../index.php?camion=<?php print $row['num_camion'] ?>"> <?php print STR_PAD($row['num_camion'],7,"0",STR_PAD_LEFT) ?></a></td>
				</tr>
				<tr>
					<td><strong>EPC palet</strong></td>
					<td> <?php print STR_PAD($row['epc_tarima'],7,"0",STR_PAD_LEFT) ?></td>
				</tr>
				<tr>
					<td><strong>EPC caja</strong></td>
					<td> <?php print STR_PAD($row['epc_caja'],7,"0",STR_PAD_LEFT) ?></td>
				</tr>
				<tr>
					<td><strong>Fecha de envío</strong></td>
					<td><?php print $row['fecha_envio_empaque'] ?></td>
				</tr>
				<tr>
				<td><strong>Estado del envío</strong></td>
					<td><?php 
	      					 switch($row['estado_envio_empaque']){
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
	      			<td><?php print $row['fecha_entrada_distribuidor']." a las ".$row['hora_entrada_distribuidor'] ?></td>
	      		</tr>
			</table>
	     </div>

	      <div class="modal-body" style="width:32%; float: left;">
      		
			<!--<div class="alert alert-info">DISTRIBUIDOR</div>-->
			<p class="label label-primary">Datos del distribuidor</p>
  			<table class="table table-hover" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Nombre</strong></td>
					<td><a href="../index.php?distribuidor=<?php print $row['id_distribuidor'] ?>"> <?php print $row['nombre_distribuidor'] ?></a></td>
				</tr>
				<tr>
					<td><strong>RFC</strong></td>
					<td><?php print $row['rfc_distribuidor'] ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php print $row['direccion_distribuidor'].", ".$row['ciudad_distribuidor'];
					$paises = array("MEXICO","ESTADOS UNIDOS","CANADÁ","JAPÓN","AUSTRALIA");
			          	
								          	$pais_c = $row['pais_distribuidor'];
								          	$estado_c = $row['estado_distribuidor'];

								          	print ", ";

								          	$mexico = array("AGUASCALIENTES", "BAJA CALIFORNIA NORTE", "BAJA CALIFORNIA SUR","CAMPECHE","COAHUILA","CHIAPAS","CHIHUAHUA","DURANGO","ESTADO DE MEXICO","GUANAJUATO","GUERRERO","HIDALGO","JALISCO","MICHOACÁN","MORELOS","MÉXICO D.F.","NAYARIT","NUEVO LEÓN","OAXACA","PUEBLA","QUERETARO","QUINTANA ROO","SAN LUIS POTOSÍ","SINALOA","SONORA","TABASCO","TAMAULIPAS","TLAXCALA","VERACRUZ","YUCATÁN","ZACATECAS");
								          	$eua = array("ALABAMA","ALASKA","ARIZONA","ARKANSAS","CALIFORNIA","CALIFORNIA DEL NORTE","CAROLINA DEL SUR","COLORADO","CONNECTICUT","DAKOTA DEL NORTE","DAKOTA DEL SUR","DELAWARE","FLORIDA","GEORGIA","HAWÁI","IDAHO","ILLINOIS","INDIANA","IOWA","KANSAS","KENTUCHY","LUISIANA","MAINE","MARYLAND","Massachusetts","MICHIGAN","MINNESOTA","MISISIPI","MISURI","MONTANA","NEBRASKA","NEVADA","NUEVA JERSEY","NUEVA YORK","NUEVO HAMPSHIRE","NUEVO MEXICO","OHIO","OKLAHOMA","OREGÓN","PENSILVANIA","RHODE ISLAND","TENNESSEE","TEXAS","UTAH","VERMONT","VIRGINIA","VIRGINIA OCCIDENTAL","WASHINGTON","WISCONSIN","WYOMING");
								          	$canada = array("ALBERTA","COLUMBIA BRITANICA","MANITOBA","ISLA DEL PRINCIPE EDUARDO","NUNAVUT5","NUEVA ESCOCIA","NUEVO BRUNSWICK","TERRANOVA Y LABRADOR","TERRITORIOS DEL NOROESTE","SASKATCHEWAN","QUEBEC","YÚKON5");
								          	$japon = array("PREFECTURA DE HOKKAIDO","PREFECTURA DE AOMORI","PREFECTURA DE IWATE","PREFECTURA DE MIYAGI","PREFECTURA DE AKITA","PREFECTURA DE YAMAGATA","PREFECTURA DE FUKUSHIMA","PREFECTURA DE IBARAKI","PREFECTURA DE TOCHIGI","PREFECTURA DE GUNMA","PREFECTURA DE SAITAMA","PREFECTURA DE CHIBA","TOKIO","PREFECTURA DE KANAWA","PREFECTURA DE NIIGATA","PREFECTURA DE TOYAMA","PREFECTURA DE ISHIKAWA","PREFECTURA DE FUKUI","PREFECTURA DE YAMANASHI","PREFECTURA DE NAGANO","PREFECTURA DE GIFU","PREFECTURA DE SHIZUOKA","PREFECTURA DE AICHI","PREFECTURA DE MIE","PREFECTURA DE SHIGA","PREFECTURA DE KIOTO","PREFECTURA DE OSAKA","PREFECTURA DE HYOGO","PREFECTURA DE NARA","PREFECTURA DE WAKAYAMA","PREFECTURA DE TOTTORI","PREFECTURA DE SHIMANE","PREFECTURA DE OKAYAMA","PREFECTURA DE HIROSHIMA","PREFECTURA DE YAMAGUCHI","PREFECTURA DE TOKUSHIMA","PREFECTURA DE KAGAWA","PREFECTURA DE EHIME","PREFECTURA DE KOCHI","PREFECTURA DE FUKUOKA","PREFECTURA DE SAGA","PREFECTURA DE NAGASAKI","PREFECTURA DE KUMAMOTO","PREFECTURA DE OITA","PREFECTURA DE MIYASAKI","PREFECTURA DE KAGOSHIMA","PREFECTURA DE OKINAWA");
								          	$australia = array("NEW SOUTH WALES","TASMANIA","SOUTH AUSTRALIA","QUEENSLAND","WESTERN AUSTRALIA");

								          	switch ($pais_c) {
								          		case '0':
								          			print $mexico[$estado_c];
								          			break;
								          			case '1':
								          			print $eua[$estado_c];
								          			break;
								          			case '2':
								          			print $canada[$estado_c];
								          			break;
								          			case '3':
								          			print $japon[$estado_c];
								          			break;
								          			case '4':
								          			print $australia[$estado_c];
								          			break;
								          	}

								          	print ", $paises[$pais_c]";

								          	print ". CP. ".$row['cp_distribuidor'] ?></td>
				</tr>
			</table>
	     </div>

		<div style="clear: both"></div>
	     <div style="text-align: center" class="alert alert-info">TRAZABILIDAD EXTERNA :: DISTRIBUIDOR <span class="glyphicon glyphicon-arrow-right"></span> PUNTO DE VENTA</div>
	     <div class="modal-body" style="width:32%; float: left;">
      		
			<!--<div class="alert alert-info">DISTRIBUIDOR</div>-->
			<p class="label label-primary">Datos del distribuidor</p>
  			<table class="table table-hover" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Nombre</strong></td>
					<td><a href="../index.php?distribuidor=<?php print $row['id_distribuidor'] ?>"> <?php print $row['nombre_distribuidor'] ?></a></td>
				</tr>
				<tr>
					<td><strong>RFC</strong></td>
					<td><?php print $row['rfc_distribuidor'] ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php print $row['direccion_distribuidor'].", ".$row['ciudad_distribuidor'];
					$paises = array("MEXICO","ESTADOS UNIDOS","CANADÁ","JAPÓN","AUSTRALIA");
			          	
								          	$pais_c = $row['pais_distribuidor'];
								          	$estado_c = $row['estado_distribuidor'];

								          	print ", ";

								          	$mexico = array("AGUASCALIENTES", "BAJA CALIFORNIA NORTE", "BAJA CALIFORNIA SUR","CAMPECHE","COAHUILA","CHIAPAS","CHIHUAHUA","DURANGO","ESTADO DE MEXICO","GUANAJUATO","GUERRERO","HIDALGO","JALISCO","MICHOACÁN","MORELOS","MÉXICO D.F.","NAYARIT","NUEVO LEÓN","OAXACA","PUEBLA","QUERETARO","QUINTANA ROO","SAN LUIS POTOSÍ","SINALOA","SONORA","TABASCO","TAMAULIPAS","TLAXCALA","VERACRUZ","YUCATÁN","ZACATECAS");
								          	$eua = array("ALABAMA","ALASKA","ARIZONA","ARKANSAS","CALIFORNIA","CALIFORNIA DEL NORTE","CAROLINA DEL SUR","COLORADO","CONNECTICUT","DAKOTA DEL NORTE","DAKOTA DEL SUR","DELAWARE","FLORIDA","GEORGIA","HAWÁI","IDAHO","ILLINOIS","INDIANA","IOWA","KANSAS","KENTUCHY","LUISIANA","MAINE","MARYLAND","Massachusetts","MICHIGAN","MINNESOTA","MISISIPI","MISURI","MONTANA","NEBRASKA","NEVADA","NUEVA JERSEY","NUEVA YORK","NUEVO HAMPSHIRE","NUEVO MEXICO","OHIO","OKLAHOMA","OREGÓN","PENSILVANIA","RHODE ISLAND","TENNESSEE","TEXAS","UTAH","VERMONT","VIRGINIA","VIRGINIA OCCIDENTAL","WASHINGTON","WISCONSIN","WYOMING");
								          	$canada = array("ALBERTA","COLUMBIA BRITANICA","MANITOBA","ISLA DEL PRINCIPE EDUARDO","NUNAVUT5","NUEVA ESCOCIA","NUEVO BRUNSWICK","TERRANOVA Y LABRADOR","TERRITORIOS DEL NOROESTE","SASKATCHEWAN","QUEBEC","YÚKON5");
								          	$japon = array("PREFECTURA DE HOKKAIDO","PREFECTURA DE AOMORI","PREFECTURA DE IWATE","PREFECTURA DE MIYAGI","PREFECTURA DE AKITA","PREFECTURA DE YAMAGATA","PREFECTURA DE FUKUSHIMA","PREFECTURA DE IBARAKI","PREFECTURA DE TOCHIGI","PREFECTURA DE GUNMA","PREFECTURA DE SAITAMA","PREFECTURA DE CHIBA","TOKIO","PREFECTURA DE KANAWA","PREFECTURA DE NIIGATA","PREFECTURA DE TOYAMA","PREFECTURA DE ISHIKAWA","PREFECTURA DE FUKUI","PREFECTURA DE YAMANASHI","PREFECTURA DE NAGANO","PREFECTURA DE GIFU","PREFECTURA DE SHIZUOKA","PREFECTURA DE AICHI","PREFECTURA DE MIE","PREFECTURA DE SHIGA","PREFECTURA DE KIOTO","PREFECTURA DE OSAKA","PREFECTURA DE HYOGO","PREFECTURA DE NARA","PREFECTURA DE WAKAYAMA","PREFECTURA DE TOTTORI","PREFECTURA DE SHIMANE","PREFECTURA DE OKAYAMA","PREFECTURA DE HIROSHIMA","PREFECTURA DE YAMAGUCHI","PREFECTURA DE TOKUSHIMA","PREFECTURA DE KAGAWA","PREFECTURA DE EHIME","PREFECTURA DE KOCHI","PREFECTURA DE FUKUOKA","PREFECTURA DE SAGA","PREFECTURA DE NAGASAKI","PREFECTURA DE KUMAMOTO","PREFECTURA DE OITA","PREFECTURA DE MIYASAKI","PREFECTURA DE KAGOSHIMA","PREFECTURA DE OKINAWA");
								          	$australia = array("NEW SOUTH WALES","TASMANIA","SOUTH AUSTRALIA","QUEENSLAND","WESTERN AUSTRALIA");

								          	switch ($pais_c) {
								          		case '0':
								          			print $mexico[$estado_c];
								          			break;
								          			case '1':
								          			print $eua[$estado_c];
								          			break;
								          			case '2':
								          			print $canada[$estado_c];
								          			break;
								          			case '3':
								          			print $japon[$estado_c];
								          			break;
								          			case '4':
								          			print $australia[$estado_c];
								          			break;
								          	}

								          	print ", $paises[$pais_c]";

								          	print ". CP. ".$row['cp_distribuidor'] ?></td>
				</tr>
			</table>
	     </div>
	      
	     <div class="modal-body" style="width:32%; float: left; margin-left:1%">
	  		<!--<div class="alert alert-info">ORDEN DEL PUNTO DE VENTA</div>-->
	  		<p class="label label-primary">Orden DISTRIBUIDOR <span class="glyphicon glyphicon-arrow-left"></span> PUNTO DE VENTA </p>
				<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Núm. orden</strong></td>
					<td><?php print STR_PAD($row['id_orden_punto_venta'],10,"0",STR_PAD_LEFT) ?></td>
				</tr>
				<tr>
					<td><strong>Fecha de la orden</strong></td>
					<td><?php print $row['fecha_orden_punto_venta'] ?></td>
				</tr>
				<tr>
					<td><strong>Estado de la orden</strong></td>
					<td><?php 
	      					 switch($row['estado_orden_punto_venta']){
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
<!--	     </div>
	     <div class="modal-body" style="width:32%; float: left; margin-left:1%">
	  		<div class="alert alert-info">ENVÍO AL PUNTO DE VENTA</div>-->
	  		<p class="label label-primary">Envío DISTRIBUIDOR <span class="glyphicon glyphicon-arrow-right"></span> PUNTO DE VENTA</p>
				<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Núm. envío</strong></td>
					<td><?php print STR_PAD($row['id_envio_distribuidor'],10,"0",STR_PAD_LEFT) ?></td>
				</tr>
				<tr>
					<td><strong>Núm. camión</strong></td>
					<td><a href="../index.php?camiondist=<?php print $row['num_camion_dist'] ?>"> <?php PRINT STR_PAD( $row['num_camion_dist'],7,"0",STR_PAD_LEFT) ?></a></td>
				</tr>
				<tr>
					<td><strong>Fecha de envío</strong></td>
					<td><?php print $row['fecha_envio_distribuidor'] ?></td>
				</tr>
				<tr>
				<td><strong>Estado del envío</strong></td>
					<td><?php 
	      					 switch($row['estado_envio_distribuidor']){
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
	      			<td><?php print $row['fecha_entrada_punto_venta']." a las ".$row['hora_entrada_punto_venta'] ?></td>
	      		</tr>
			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left;">
      		<!--<div class="alert alert-info">PUNTO DE VENTA</div>-->
      		<p class="label label-primary">Datos del punto de venta </p>
  			<table class="table" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Nombre</strong></td>
					<td><a href="../index.php?pv=<?php print $row['id_punto_venta'] ?>"> <?php print $row['nombre_punto_venta'] ?> </a></td>
				</tr>
				<tr>
					<td><strong>RFC</strong></td>
					<td><?php print $row['rfc_punto_venta'] ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php print $row['direccion_punto_venta'].", ".$row['ciudad_punto_venta'];
					$paises = array("MEXICO","ESTADOS UNIDOS","CANADÁ","JAPÓN","AUSTRALIA");
			          	
								          	$pais_c = $row['pais_punto_venta'];
								          	$estado_c = $row['estado_punto_venta'];

								          	print ", ";

								          	$mexico = array("AGUASCALIENTES", "BAJA CALIFORNIA NORTE", "BAJA CALIFORNIA SUR","CAMPECHE","COAHUILA","CHIAPAS","CHIHUAHUA","DURANGO","ESTADO DE MEXICO","GUANAJUATO","GUERRERO","HIDALGO","JALISCO","MICHOACÁN","MORELOS","MÉXICO D.F.","NAYARIT","NUEVO LEÓN","OAXACA","PUEBLA","QUERETARO","QUINTANA ROO","SAN LUIS POTOSÍ","SINALOA","SONORA","TABASCO","TAMAULIPAS","TLAXCALA","VERACRUZ","YUCATÁN","ZACATECAS");
								          	$eua = array("ALABAMA","ALASKA","ARIZONA","ARKANSAS","CALIFORNIA","CALIFORNIA DEL NORTE","CAROLINA DEL SUR","COLORADO","CONNECTICUT","DAKOTA DEL NORTE","DAKOTA DEL SUR","DELAWARE","FLORIDA","GEORGIA","HAWÁI","IDAHO","ILLINOIS","INDIANA","IOWA","KANSAS","KENTUCHY","LUISIANA","MAINE","MARYLAND","Massachusetts","MICHIGAN","MINNESOTA","MISISIPI","MISURI","MONTANA","NEBRASKA","NEVADA","NUEVA JERSEY","NUEVA YORK","NUEVO HAMPSHIRE","NUEVO MEXICO","OHIO","OKLAHOMA","OREGÓN","PENSILVANIA","RHODE ISLAND","TENNESSEE","TEXAS","UTAH","VERMONT","VIRGINIA","VIRGINIA OCCIDENTAL","WASHINGTON","WISCONSIN","WYOMING");
								          	$canada = array("ALBERTA","COLUMBIA BRITANICA","MANITOBA","ISLA DEL PRINCIPE EDUARDO","NUNAVUT5","NUEVA ESCOCIA","NUEVO BRUNSWICK","TERRANOVA Y LABRADOR","TERRITORIOS DEL NOROESTE","SASKATCHEWAN","QUEBEC","YÚKON5");
								          	$japon = array("PREFECTURA DE HOKKAIDO","PREFECTURA DE AOMORI","PREFECTURA DE IWATE","PREFECTURA DE MIYAGI","PREFECTURA DE AKITA","PREFECTURA DE YAMAGATA","PREFECTURA DE FUKUSHIMA","PREFECTURA DE IBARAKI","PREFECTURA DE TOCHIGI","PREFECTURA DE GUNMA","PREFECTURA DE SAITAMA","PREFECTURA DE CHIBA","TOKIO","PREFECTURA DE KANAWA","PREFECTURA DE NIIGATA","PREFECTURA DE TOYAMA","PREFECTURA DE ISHIKAWA","PREFECTURA DE FUKUI","PREFECTURA DE YAMANASHI","PREFECTURA DE NAGANO","PREFECTURA DE GIFU","PREFECTURA DE SHIZUOKA","PREFECTURA DE AICHI","PREFECTURA DE MIE","PREFECTURA DE SHIGA","PREFECTURA DE KIOTO","PREFECTURA DE OSAKA","PREFECTURA DE HYOGO","PREFECTURA DE NARA","PREFECTURA DE WAKAYAMA","PREFECTURA DE TOTTORI","PREFECTURA DE SHIMANE","PREFECTURA DE OKAYAMA","PREFECTURA DE HIROSHIMA","PREFECTURA DE YAMAGUCHI","PREFECTURA DE TOKUSHIMA","PREFECTURA DE KAGAWA","PREFECTURA DE EHIME","PREFECTURA DE KOCHI","PREFECTURA DE FUKUOKA","PREFECTURA DE SAGA","PREFECTURA DE NAGASAKI","PREFECTURA DE KUMAMOTO","PREFECTURA DE OITA","PREFECTURA DE MIYASAKI","PREFECTURA DE KAGOSHIMA","PREFECTURA DE OKINAWA");
								          	$australia = array("NEW SOUTH WALES","TASMANIA","SOUTH AUSTRALIA","QUEENSLAND","WESTERN AUSTRALIA");

								          	switch ($pais_c) {
								          		case '0':
								          			print $mexico[$estado_c];
								          			break;
								          			case '1':
								          			print $eua[$estado_c];
								          			break;
								          			case '2':
								          			print $canada[$estado_c];
								          			break;
								          			case '3':
								          			print $japon[$estado_c];
								          			break;
								          			case '4':
								          			print $australia[$estado_c];
								          			break;
								          	}

								          	print ", $paises[$pais_c]";

								          	print ". CP. ".$row['cp_punto_venta'] ?></td>
				</tr>
			</table>
			
	     </div>
		<?php }
		}else{
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
		
		<p>&nbsp; </p>
		<div style="text-align: center" class="alert alert-info">TRAZABILIDAD INTERNA :: PRODUCTOR <span class="glyphicon glyphicon-arrow-right"></span> EMPAQUE</div>
		<div class="modal-body" style="width:32%; float: left">
      		<!--<div class="alert alert-info">HUERTA Y PRODUCTOR</div>-->
      		<p class="label label-primary">Datos de la huerta</p>
  			<table class="table table-hover" style="font-size: 14px">
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
      		<p class="label label-primary">Datos del productor</p>
  			<table class="table table-hover" style="font-size: 14px">
				<tr>
					<td width="100"><strong>Nombre</strong></td>
					<td><a href="../index.php?productor=<?php print $row['id_productor'] ?>"> <?php print $row['nombre_productor']." ".$row['apellido_productor'] ?></a></td>
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
      		<!--<div class="alert alert-info">LOTE</div>-->
      		<p class="label label-primary">Datos del lote</p>
  			<table class="table table-hover" style="font-size: 14px">
				<tr>
					<td width="140"><strong>Núm. lote</strong></td>
					<td><a href="../index.php?lote=<?php print $row['id_lote'] ?>"> <?php print str_pad($row['id_lote'],3,"0",STR_PAD_LEFT) ?> </a></td>
				</tr>
				<tr>
					<td><strong>Remitente</strong></td>
					<td><?php print $row['remitente_lote'] ?></td>
				</tr>
				<tr>
					<td><strong>Fecha recibo</strong></td>
					<td><?php print $row['fecha_recibo_lote'] ?></td>
				</tr>
				<tr>
					<td><strong>Hora de recibo</strong></td>
					<td><?php print $row['hora_recibo_lote'] ?></td>
				</tr>
				<tr>
					<td><strong>Fecha caducidad</strong></td>
					<td><?php print $row['fecha_caducidad'] ?></td>
				</tr>
			</table>
	     </div>
	     <div class="modal-body" style="width:32%; float: left; margin-left:1%">
	     	<!--<div class="alert alert-info">EMPAQUE</div>-->
	     	<p class="label label-primary">Datos del empaque</p>
  			<table class="table table-hover" style="font-size: 14px">
				<tr>
					<td width="140"><strong>ID</strong></td>
					<td><a href="../index.php?empaque=<?php print  $row['id_empaque'] ?>"> <?php print str_pad($row['id_empaque'],7,"0",STR_PAD_LEFT) ?> </a></td>
				</tr>

				<tr>
					<td width="140"><strong>Nombre</strong></td>
					<td><a href="../index.php?empaque=<?php print  $row['id_empaque'] ?>"> <?php print $row['nombre_empaque'] ?> </a></td>
				</tr>
				<tr>
					<td><strong>RFC</strong></td>
					<td><?php print $row['rfc_empaque'] ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php print $row['direccion_empaque'].", ".$row['ciudad_empaque'];
					$paises = array("MEXICO","ESTADOS UNIDOS","CANADÁ","JAPÓN","AUSTRALIA");
			          	
								          	$pais_c = $row['pais_empaque'];
								          	$estado_c = $row['estado_empaque'];

								          	print ", ";

								          	$mexico = array("AGUASCALIENTES", "BAJA CALIFORNIA NORTE", "BAJA CALIFORNIA SUR","CAMPECHE","COAHUILA","CHIAPAS","CHIHUAHUA","DURANGO","ESTADO DE MEXICO","GUANAJUATO","GUERRERO","HIDALGO","JALISCO","MICHOACÁN","MORELOS","MÉXICO D.F.","NAYARIT","NUEVO LEÓN","OAXACA","PUEBLA","QUERETARO","QUINTANA ROO","SAN LUIS POTOSÍ","SINALOA","SONORA","TABASCO","TAMAULIPAS","TLAXCALA","VERACRUZ","YUCATÁN","ZACATECAS");
								          	$eua = array("ALABAMA","ALASKA","ARIZONA","ARKANSAS","CALIFORNIA","CALIFORNIA DEL NORTE","CAROLINA DEL SUR","COLORADO","CONNECTICUT","DAKOTA DEL NORTE","DAKOTA DEL SUR","DELAWARE","FLORIDA","GEORGIA","HAWÁI","IDAHO","ILLINOIS","INDIANA","IOWA","KANSAS","KENTUCHY","LUISIANA","MAINE","MARYLAND","Massachusetts","MICHIGAN","MINNESOTA","MISISIPI","MISURI","MONTANA","NEBRASKA","NEVADA","NUEVA JERSEY","NUEVA YORK","NUEVO HAMPSHIRE","NUEVO MEXICO","OHIO","OKLAHOMA","OREGÓN","PENSILVANIA","RHODE ISLAND","TENNESSEE","TEXAS","UTAH","VERMONT","VIRGINIA","VIRGINIA OCCIDENTAL","WASHINGTON","WISCONSIN","WYOMING");
								          	$canada = array("ALBERTA","COLUMBIA BRITANICA","MANITOBA","ISLA DEL PRINCIPE EDUARDO","NUNAVUT5","NUEVA ESCOCIA","NUEVO BRUNSWICK","TERRANOVA Y LABRADOR","TERRITORIOS DEL NOROESTE","SASKATCHEWAN","QUEBEC","YÚKON5");
								          	$japon = array("PREFECTURA DE HOKKAIDO","PREFECTURA DE AOMORI","PREFECTURA DE IWATE","PREFECTURA DE MIYAGI","PREFECTURA DE AKITA","PREFECTURA DE YAMAGATA","PREFECTURA DE FUKUSHIMA","PREFECTURA DE IBARAKI","PREFECTURA DE TOCHIGI","PREFECTURA DE GUNMA","PREFECTURA DE SAITAMA","PREFECTURA DE CHIBA","TOKIO","PREFECTURA DE KANAWA","PREFECTURA DE NIIGATA","PREFECTURA DE TOYAMA","PREFECTURA DE ISHIKAWA","PREFECTURA DE FUKUI","PREFECTURA DE YAMANASHI","PREFECTURA DE NAGANO","PREFECTURA DE GIFU","PREFECTURA DE SHIZUOKA","PREFECTURA DE AICHI","PREFECTURA DE MIE","PREFECTURA DE SHIGA","PREFECTURA DE KIOTO","PREFECTURA DE OSAKA","PREFECTURA DE HYOGO","PREFECTURA DE NARA","PREFECTURA DE WAKAYAMA","PREFECTURA DE TOTTORI","PREFECTURA DE SHIMANE","PREFECTURA DE OKAYAMA","PREFECTURA DE HIROSHIMA","PREFECTURA DE YAMAGUCHI","PREFECTURA DE TOKUSHIMA","PREFECTURA DE KAGAWA","PREFECTURA DE EHIME","PREFECTURA DE KOCHI","PREFECTURA DE FUKUOKA","PREFECTURA DE SAGA","PREFECTURA DE NAGASAKI","PREFECTURA DE KUMAMOTO","PREFECTURA DE OITA","PREFECTURA DE MIYASAKI","PREFECTURA DE KAGOSHIMA","PREFECTURA DE OKINAWA");
								          	$australia = array("NEW SOUTH WALES","TASMANIA","SOUTH AUSTRALIA","QUEENSLAND","WESTERN AUSTRALIA");

								          	switch ($pais_c) {
								          		case '0':
								          			print $mexico[$estado_c];
								          			break;
								          			case '1':
								          			print $eua[$estado_c];
								          			break;
								          			case '2':
								          			print $canada[$estado_c];
								          			break;
								          			case '3':
								          			print $japon[$estado_c];
								          			break;
								          			case '4':
								          			print $australia[$estado_c];
								          			break;
								          	}

								          	print ", $paises[$pais_c]";

								          	print ". CP. ".$row['cp_empaque'] ?></td>
				</tr>
			</table>
	     </div>
	     <div style="clear: both"></div>
	
		<?php }
		}else{ ?>

			<div class="alert alert-danger" style="width:30%; margin: 50px auto; text-align: center">
				El EPC <?php print $epc ?> no existe en la base de datos.
			</div>
<?php	}
		}

		}
	}
		//$cadena = "SELECT * FROM empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor, entrada_distribuidor where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND entrada_distribuidor.id_envio_fk = envios_empaque.id_envio AND epc_caja.epc_caja = '$epc'";
		?>
	<div style="clear: both"></div>
	<p><!--La trazabilidad del EPC <?php print $epc ?> es la que sigue--></p>
	</div>
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


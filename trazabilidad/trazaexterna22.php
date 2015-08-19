<div style="clear: both"></div>
<div style="text-align: center" class="alert alert-info">TRAZABILIDAD EXTERNA :: DISTRIBUIDOR <span class="glyphicon glyphicon-arrow-right"></span> PUNTO DE VENTA</div>
<div class="modal-body" style="width:32%; float: left">
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
			<td>
		<?php 	print $row['direccion_distribuidor'].", ".$row['ciudad_distribuidor'];
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

	          	print ". CP. ".$row['cp_distribuidor'] ?>
			 </td>
		</tr>
	</table>
</div>
<div class="modal-body" style="width:32%; float: left; margin-left:1%">
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
			<td>
				<?php print $row['direccion_punto_venta'].", ".$row['ciudad_punto_venta'];
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
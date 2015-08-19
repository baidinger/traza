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

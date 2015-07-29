<!DOCTYPE html>
<html>
	<head>
		<title>Trazabilidad</title>
		<meta charset="UTF-8">
		<style type="text/css">
			.centro{
				text-align: center;
			}

			.derecha{
				text-align: right;
			}
		</style>
	</head>

	<body style="background: #ffffff">
		<div style=" margin:0px auto;background:#ffffff">
				<div class="div-contenedor-form">
			      		<div>
			      			<?php
			      				$id_envio = $_POST['id'];
			      				$id_orden = $_POST['orden'];
			      				include('../../mod/conexion.php');
			      				$cadena = "SELECT * FROM productos, ordenes_distribuidor_detalles WHERE id_producto = id_producto_fk AND id_orden_fk = $id_orden";

								$productos = mysql_query($cadena);
								

			      				$cadena = "SELECT * FROM ordenes_distribuidor, envios_empaque, usuario_empaque, empresa_distribuidores where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND ordenes_distribuidor.id_orden = envios_empaque.id_orden_fk AND usuario_empaque.id_empaque_fk = $_SESSION[id_empaque] AND usuario_empaque.id_receptor = envios_empaque.id_receptor_fk AND envios_empaque.id_envio=$id_envio" ;
			      				$resultado = mysql_query($cadena);
			      				$row = mysql_fetch_array($resultado);
			      			?>
					      	<div>
					      		<div class="alert alert-info">En la siguiente tabla podrá visualizarse la información referente al ::envío::</div>
					      		<table class="table" style="font-size:14px">
					      			<tbody>
					      				<tr>
					      					<td><strong>Distribuidor:</strong></td>
					      					<td><?php echo $row['nombre_distribuidor'] ?></td>
					      					<td><strong>Núm. orden:</strong></td>
					      					<td><?php echo $row['id_orden']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>RFC:</strong></td>
					      					<td><?php echo $row['rfc_distribuidor']; ?></td>
					      					<td><strong>fecha de orden:</strong></td>
					      					<td>
					      						<?php echo $row['fecha_orden']; ?>
					      					</td>

					      				</tr>
					      				<tr>
					      					<td><strong>Productos:</strong></td>
					      					<td><?php 
					      					if(mysql_num_rows($productos) > 0){
												while($row1 = mysql_fetch_array($productos)) {
													print $row1['nombre_producto'] . " " . $row1['variedad_producto']."<br>";
												}
											}
											 ?> </td>
											 <td><strong>Costo de la orden:</strong></td>
					      					<td>$ <?php echo $row['costo_orden']; ?></td>
					      					
					      				</tr>
					      				<tr>
					      					<td><strong>Fecha de envío</strong></td>
					      					<td><?php echo $row['fecha_envio'] . " a las " . $row['hora_envio'] ?></td>
					      					<td><strong>Número del camión:</strong></td>
					      					<td><?php echo $row['id_camion_fk']  ?></td>
					      				</tr>
					      				<tr>
					      					
					      				</tr>
					      				<tr>
					      					<td><strong>Estado:</strong></td>
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
										 } ?></td>
										 <td><strong>(ID) Usuario que envió:</strong></td>
					      					<td><?php echo "(".$row['id_receptor'].") ".$row['nombre_receptor']." ".$row['apellido_receptor']  ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Destino:</strong></td>
					      					<td width="300"><?php echo $row['direccion_distribuidor'].", ".$row['ciudad_distribuidor'];
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
			          			print "$mexico[$estado_c]";
			          			break;
			          			case '1':
			          			print "$eua[$estado_c]";
			          			break;
			          			case '2':
			          			print "$canada[$estado_c]";
			          			break;
			          			case '3':
			          			print "$japon[$estado_c]";
			          			break;
			          			case '4':
			          			print "$australia[$estado_c]";
			          			break;
			          	}

			          	print ", $paises[$pais_c]";

						 ?></td>
						 <?php
						$consulta = "SELECT count(epc_tarima) as num FROM distribuidor_cajas_envio, envios_empaque where id_orden_fk = $id_orden AND id_envio_fk = id_envio AND id_envio = $id_envio";
						 $r = mysql_query($consulta);
						 if($r != null)
						 	if($row2 = mysql_fetch_array($r));
						 ?>
						 <td><strong>Núm. Cajas enviadas</strong></td>
						 <td><?php print $row2['num'] ?></td>
					      				</tr>
					      			</tbody>
					      		</table>
					      		<center>
					      			<a href="#" data-dismiss="modal" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Regresar</a>
					      		</center>
					      	</div>
					    </div>
					<?php
						mysql_close($conexion);
					?>
				</div>
		</div>

		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>
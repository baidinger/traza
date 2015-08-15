<div class="contenedor-form">		
	<div class="modal-header">
		<h3 class="modal-title">
			<img class="img-header" src="img/distribuidor.png"> Información de distribuidor
		</h3>
	</div>

<?php
			include('../../mod/conexion.php');
			$id = $_POST['id'];
			$consulta = "SELECT * FROM empresa_punto_venta, usuario_empaque WHERE id_receptor = id_usuario_que_registro AND id_punto_venta = ".$id;
			$resultado = mysql_query($consulta);
			if(mysql_num_rows($resultado) == 0) {  ?>
			<div class="alert alert-danger" style="width : 500px; margin: 50px auto">
				No se encontró un distribuidor con ese ID
			</div>
	<?php	return; }
			$row = mysql_fetch_array($resultado);
		?>
	<div style="width:800px; margin:50px auto;background:#ffffff; padding: 20px; border-radius: 5px">
				<div class="div-contenedor-form">
			      		<div>
			      			
					      	<div>
					      		<table class="table" style="font-size: 14px">
					      			<tbody>
					      				<tr>
					      					<td width="160"><strong>ID:</strong></td>
					      					<td><a href="index.php?pv=<?php print $row['id_punto_venta'] ?>"><?php echo str_pad($row['id_punto_venta'], 7,"0",STR_PAD_LEFT); ?></a></td>
					      					<td width="160"><strong>Nombre de punto de venta:</strong></td>
					      					<td><a href="index.php?pv=<?php print $row['id_punto_venta'] ?>"><?php echo $row['nombre_punto_venta'] ?></a></td>
					      				</tr>
					      				<tr>
					      					<td><strong>RFC:</strong></td>
					      					<td><?php echo $row['rfc_punto_venta']; ?></td>
					      					<td><strong>E-mail:</strong></td>
					      					<td><?php echo $row['email_punto_venta']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Dirección:</strong></td>
					      					<td><?php echo $row['direccion_punto_venta'].", ".$row['ciudad_punto_venta'];
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
								          	print ". CP. ".$row["cp_punto_venta"];
					      					 ?></td>
					      					<td><strong>Teléfono (s):</strong></td>
					      					<td><?php echo $row['telefono_punto_venta']  ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Fecha de registro:</strong></td>
					      					<td><?php echo $row['fecha_registro_pv']; ?></td>
					      					<td><strong>Fecha de modificación:</strong></td>
					      					<td><?php echo $row['fecha_modificacion_pv']; ?></td>
					      				</tr>
					      				<tr>
					      					<td><strong>Súper usuario:</strong></td>
					      					<td><a href="index.php?usuarioemp=<?php print $row['id_receptor'] ?>"><?php echo "(".str_pad($row['id_receptor'], 7,"0",STR_PAD_LEFT) .") ".$row['nombre_receptor']." ".$row['apellido_receptor'] . "</a> usuario registrado en el empaque: "; ?><a href="index.php?empaque=<?php print $row['id_empaque_fk'] ?>"><?php print str_pad($row['id_empaque_fk'], 7,"0",STR_PAD_LEFT) ?></a> </td>
					      					<td><strong>Estado:</strong></td>
					      						<?php if($row['estado_pv'] == 1){ ?>
									          			<td > <p class="label label-success"> Activo </p> </td>
									          	<?php }else{ ?>
									          			<td > <p class="label label-danger"> Inactivo </p> </td>
									          	<?php } ?>
					      				</tr>
					      				<tr>
					      					<?php
					      					$consulta1 = "SELECT * from usuario_punto_venta, usuarios where nivel_autorizacion_usuario = 1 AND id_punto_venta_fk = $id AND id_usuario = id_usuario_fk";
					      					$consulta = "SELECT * from usuario_punto_venta where id_punto_venta_fk = $id";
					      					$r = mysql_query($consulta);
					      					$count = mysql_num_rows($r);

					      					$r = mysql_query($consulta1);
					      					if(mysql_num_rows($r))
					      					{
					      						$row = mysql_fetch_array($r);
					      					}

					      					 ?>
					      					 <td><strong>Núm. usuarios reg.</strong></td>
					      					 <td><?php print $count ?></td>
					      					 <td><strong>Administrador</strong></td>
					      					 <td><?php print "ID: ".str_pad($row['id_usuario_pv'], 7,"0",STR_PAD_LEFT) ."<BR>Nombre: ".$row['nombre_usuario_pv']." ".$row['apellidos_usuario_pv']."<br>Usuario: ".$row['nombre_usuario'] ?></td>
					      				</tr>

					      			</tbody>
					      		</table>
					      		<center>
					      			<a href="index.php?op=bus_pv" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Regresar</a>
					      		</center>
					      	</div>
					    </div>
					<?php
						mysql_close();
					?>
				</div>
		</div>

	
</div>
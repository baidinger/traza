<?php 
	header("Content-Type: application/json");

	include("conexion.php");


	$datos = split(",", $_POST['datos']);
	$tipo  = $datos[0];
	$socio = $datos[1];
	$orden = $datos[2];
	$carro = $datos[3];

	switch($socio){
		case 1://productor
		break;
		case 2://empaque
			if($tipo==1){
				$query = "SELECT id_distribuidor, nombre_distribuidor FROM ordenes_distribuidor AS od, usuario_distribuidor AS ud, empresa_distribuidores AS ed WHERE od.id_orden = $orden AND od.id_usuario_distribuidor_fk = ud.id_usuario_distribuidor AND ud.id_distribuidor_fk = ed.id_distribuidor";
				$resultado = mysql_query($query);
				if(mysql_num_rows($resultado) > 0){
					$row = mysql_fetch_array($resultado);
					$datos_usuario = $row['id_distribuidor'].",".$row['nombre_distribuidor'];
				}
			}

			if($tipo==2){
				$id_dist = $datos[4];
				$id_usuario = $datos[5];

				$query = "INSERT INTO envios_empaque(fecha_envio, hora_envio, fecha_entrega_envio, id_camion_fk, id_receptor_fk, descripcion_envio, estado_envio, id_distribuidor_fk, id_orden_fk) VALUES ('".date("Y-m-d")."', '".date("H:i:s")."', '0000-00-00', $carro, $id_usuario, 'descripcion', 7, $id_dist, $orden)";
				$r = mysql_query($query);

				if($r){
					$datos_usuario = "Envio registrado como pendiente. \n -Proceda a leer todas las cajas y tarimas para completar el envio.";
					mysql_query("UPDATE camiones_empaque set estado = 1 where id_camion = $carro");
				}


			}

			if($tipo == 3){
				$id_usuario = $datos[4];
				$query = "SELECT id_envio, id_camion_fk, id_orden_fk FROM envios_empaque AS ee WHERE ee.id_receptor_fk = $id_usuario AND estado_envio = 7";
				$r = mysql_query($query);
				if(mysql_num_rows($r) > 0){
					$datos_usuario = "Bien*";
					while($row=mysql_fetch_array($r)){
						$datos_usuario .= $row['id_envio'].",".$row['id_camion_fk'].",".$row['id_orden_fk'].",";
					}
				}else
					$datos_usuario = "Error*Error";
			}

		break;
		case 3://distribuidor
		break;
		case 4://punto venta
		break;
	}


	mysql_close($dbhandle);
	echo $datos_usuario;

?>
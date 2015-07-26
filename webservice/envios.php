<?php 
	header("Content-Type: application/json");

	include("conexion.php");

	$datos 		= split(",", $_POST['datos']);
	$socio 		= $datos[0];
	$id_socio 	= $datos[1];
	$tipo 		= $datos[2];

	switch($socio){
		case 1:
		break;
		case 2://empaque

			if($tipo == 1){
				$query = "SELECT id_orden FROM ordenes_distribuidor WHERE id_empaque_fk = $id_socio AND estatus_orden = 6";
				$resultado = mysql_query($query);
				if($resultado){
					if(mysql_num_rows($resultado) > 0){
						while($row = mysql_fetch_array($resultado)){
							$datos_usuario .= $row['id_orden'].",";
						}
					}else
						$datos_usuario = "Sin ordenes aprobadas";
				}else
					$datos_usuario = "Error";
			}else{
				$query = "SELECT id_camion FROM camiones_empaque WHERE id_empaque_fk = $id_socio AND estado = 0";
				$resultado = mysql_query($query);
				if($resultado){
					if(mysql_num_rows($resultado) > 0){
						while($row = mysql_fetch_array($resultado)){
							$datos_usuario .= $row['id_camion'].",";
						}
					}else
						$datos_usuario = "Sin carros";
					}else
						$datos_usuario = "Error";

			}
		break;
		case 3://distribuidor
			if($tipo == 1){
				$query = "SELECT id_orden FROM ordenes_punto_venta WHERE id_distribuidor_fk = $id_socio AND estado_orden = 6";
				$resultado = mysql_query($query);
				if(mysql_num_rows($resultado) > 0){
					while($row = mysql_fetch_array($resultado)){
						$datos_usuario .= $row['id_orden'].",";
					}
				}else
					$datos_usuario = "Sin ordenes aprobadas";
			}else{
				$query = "SELECT id_camion FROM camiones_distribuidor WHERE id_distribuidor_fk = $id_socio AND estado = 0";
				$resultado = mysql_query($query);
				if(mysql_num_rows($resultado) > 0){
					while($row = mysql_fetch_array($resultado)){
						$datos_usuario .= $row['id_camion'].",";
					}
				}else
					$datos_usuario = "Sin carros";

			}
		break;
		case 4://punto de venta
		break;
	}

		mysql_close($dbhandle);
		echo $datos_usuario;

 ?>
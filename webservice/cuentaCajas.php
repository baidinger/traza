<?php 
	header("Content-Type: application/json");

	include("../mod/conexion.php");

	$datos_usuario = "";
	$datos = explode(",", $_POST['datos']);
	$socio = $datos[0];
	$envio = $datos[1];
	$palet = $datos[2];

switch($socio){
		case 1://productor
		break;
		case 2://empaque
		break;
		case 3://distribuidor
			$query = "SELECT epc_caja, enviado_dce, recibido_dce FROM distribuidor_cajas_envio WHERE epc_tarima = '$palet' AND id_envio_fk = $envio";

			$result = mysql_query($query);
			$datos_usuario .= "Bien*";
			while ( $row = mysql_fetch_array($result)) {
				$datos_usuario .= $row['epc_caja'].",".$row['enviado_dce'].",".$row['recibido_dce'].",";
			}
			
		break;
		case 4://punto venta
		break;
	}

	mysql_close();
	echo $datos_usuario;

?>
<?php 
	header("Content-Type: application/json");

	include("../mod/conexion.php");

	$datos_usuario = "";
	$datos = explode(",", $_POST['datos']);
	$socio  = $datos[0];
	$id_envio = $datos[1];

	switch($socio){
		case 1://productor
		break;
		case 2://empaque

		break;
		case 3://distribuidor
				$query = "SELECT epc_tarima FROM distribuidor_cajas_envio WHERE id_envio_fk = $id_envio AND enviado_dce = 1 GROUP BY epc_tarima";

				$result = mysql_query($query);
				if($result){
					$datos_usuario = "Bien*".mysql_num_rows($result).",";

					$query = "SELECT epc_tarima FROM distribuidor_cajas_envio WHERE id_envio_fk = $id_envio AND recibido_dce = 1 GROUP BY epc_tarima";
					$result = mysql_query($query);
					if($result){
						$datos_usuario .= mysql_num_rows($result);
					}

				}else
					$datos_usuario = "Error*Error en la lectura de pallets.";
		break;
		case 4://punto venta
		break;
	}


	mysql_close();
	echo $datos_usuario;

?>
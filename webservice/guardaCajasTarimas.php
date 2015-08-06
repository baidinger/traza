<?php 
	header("Content-Type: application/json");

	include("../mod/conexion.php");
	$datos_usuario = "";
	$datos = explode(",", $_POST['datos']);
	$socio = $datos[0];
	$carro = $datos[1];
	$orden = $datos[2];
	$cajas = $datos[3];
	$tarima = $datos[4];

	$epcCajas = explode("*", $cajas);
	switch($socio){
		case 1://productor
		break;
		case 2://empaque

			$q = "SELECT id_envio FROM envios_empaque WHERE id_orden_fk = $orden AND id_camion_fk = $carro";
			$result = mysql_query($q);
			if(mysql_num_rows($result) > 0){
				$row = mysql_fetch_array($result);
				$id_envio = $row['id_envio'];

				for($i = 0; $i < count($epcCajas); $i++){
					$query = "INSERT INTO distribuidor_cajas_envio(id_envio_fk, epc_caja, epc_tarima, enviado_dce, recibido_dce) VALUES($id_envio, '".$epcCajas[$i]."', '$tarima', 1, 0)";

					mysql_query($query);
				}
  
				$datos_usuario = "Bien*Registro Exitoso";
			}else
				$datos_usuario = "Error*Error";

			
		break;
		case 3://distribuidor

			$q = "SELECT id_envio FROM envios_distribuidor WHERE id_orden_dist_fk = $orden AND id_camion_fk = $carro";
			$result = mysql_query($q);
			if(mysql_num_rows($result) > 0){
				$row = mysql_fetch_array($result);
				$id_envio = $row['id_envio'];

				for($i = 0; $i < count($epcCajas); $i++){
					$query = "INSERT INTO punto_venta_cajas_envio(id_envio_fk, epc_caja, id_camion_distribuidor_fk, enviado_dce, recibido_dce) VALUES($id_envio, '".$epcCajas[$i]."', $carro, 1, 0)";

					mysql_query($query);
				}
  
				$datos_usuario = "Bien*Registro Exitoso";
			}else
				$datos_usuario = "Error*Error";

		break;
		case 4://punto venta
		break;
	}


	mysql_close();
	echo $datos_usuario;

?>
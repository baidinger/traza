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
		break;
		case 3://distribuidor
			$q = "SELECT id_envio FROM envios_empaque WHERE id_orden_fk = $orden AND id_camion_fk = $carro";
			$result = mysql_query($q);
			$id_envio = "";
			if(mysql_num_rows($result) > 0){
				$row = mysql_fetch_array($result);
				$id_envio = $row['id_envio'];


				$consulta = "SELECT * FROM distribuidor_cajas_envio WHERE id_envio_fk = $id_envio AND epc_tarima = $tarima";
				$r = mysql_query($consulta);

				if(mysql_num_rows($r) > 0){
					for($i = 0; $i < count($epcCajas); $i++){
						$consulta = "SELECT * FROM distribuidor_cajas_envio WHERE epc_caja = '".$epcCajas[$i]."' AND id_envio_fk = $id_envio AND epc_tarima = $tarima";
						$resultado = mysql_query($consulta);

						if(mysql_num_rows($resultado) > 0)
							$consulta = "UPDATE distribuidor_cajas_envio SET recibido_dce = 1 WHERE epc_caja = '".$epcCajas[$i]."' AND id_envio_fk = $id_envio AND epc_tarima = $tarima";
						else
							$consulta = "INSERT INTO distribuidor_cajas_envio(id_envio_fk, epc_caja, epc_tarima, enviado_dce, recibido_dce) VALUES($id_envio, '".$epcCajas[$i]."', '$tarima', 0, 1)";

						mysql_query($consulta);
					}	


					$datos_usuario = "Bien*Registro Exitoso";
				}else
					$datos_usuario = "Error*La tarima no pertenece a este envio";
			}else
				$datos_usuario = "Error*Error";

		break;
		case 4://punto venta

		break;
	}


	mysql_close();
	echo $datos_usuario;

?>
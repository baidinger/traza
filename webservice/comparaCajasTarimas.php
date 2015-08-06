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
	$id_usuario = $datos[5];

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


				$consulta = "SELECT * FROM distribuidor_cajas_envio WHERE epc_tarima = '$tarima'";
				$r = mysql_query($consulta);

				if(mysql_num_rows($r) > 0){

					$consulta = "SELECT * FROM distribuidor_cajas_envio WHERE id_envio_fk = $id_envio AND epc_tarima = '$tarima'";
					$r = mysql_query($consulta);
				

					if(mysql_num_rows($r) > 0)
					{
						for($i = 0; $i < count($epcCajas); $i++)
						{
							$consulta = "SELECT * FROM distribuidor_cajas_envio WHERE epc_caja = '".$epcCajas[$i]."' AND id_envio_fk = $id_envio AND epc_tarima = '$tarima'";
							$resultado = mysql_query($consulta);

							if(mysql_num_rows($resultado) > 0)
								$consulta = "UPDATE distribuidor_cajas_envio SET recibido_dce = 1 WHERE epc_caja = '".$epcCajas[$i]."' AND id_envio_fk = $id_envio AND epc_tarima = '$tarima'";
							else
								$consulta = "INSERT INTO distribuidor_cajas_envio(id_envio_fk, epc_caja, epc_tarima, enviado_dce, recibido_dce) VALUES($id_envio, '".$epcCajas[$i]."', '$tarima', 0, 1)";

							$q = "SELECT id_envio_fk FROM entrada_distribuidor WHERE id_envio_fk = $id_envio";
							$re = mysql_query($q);
							if(mysql_num_rows($re) == 0)
							{ 
								$consulta = "INSERT INTO entrada_distribuidor(id_envio_fk, fecha_entrada, hora_entrada, id_usuario_distribuidor_fk) VALUES($id_envio, '".date("Y-m-d")."', '".date("H:i:s")."', $id_usuario)";
								mysql_query($consulta);
							}


							mysql_query($consulta);
						}	


						$datos_usuario = "Bien*Registro Exitoso";
					}else
						$datos_usuario = "Error*La tarima no pertenece a este envio";
				}else{

					for($i = 0; $i < count($epcCajas); $i++){
						$query = "INSERT INTO distribuidor_cajas_envio(id_envio_fk, epc_caja, epc_tarima, enviado_dce, recibido_dce) VALUES($id_envio, '".$epcCajas[$i]."', '$tarima', 0, 1)";

						mysql_query($query);
					}

					$datos_usuario = "Bien*La tarima NO esta registrada como ENVIADA en ningún envio. \n -Se registró como NO ENVIADA pero SI RECIBIDA.";
				}			
			}else
					$datos_usuario = "Error*Error";

		break;
		case 4://punto venta
			$q = "SELECT id_envio FROM envios_distribuidor WHERE id_orden_dist_fk = $orden AND id_camion_fk = $carro";
			$result = mysql_query($q);
			$id_envio = "";
			if(mysql_num_rows($result) > 0){
				$row = mysql_fetch_array($result);
				$id_envio = $row['id_envio'];


				$consulta = "SELECT * FROM punto_venta_cajas_envio WHERE epc_tarima = '$tarima'";
				$r = mysql_query($consulta);

				if(mysql_num_rows($r) > 0){

					$consulta = "SELECT * FROM punto_venta_cajas_envio WHERE id_envio_fk = $id_envio AND epc_tarima = '$tarima'";
					$r = mysql_query($consulta);
				

					if(mysql_num_rows($r) > 0)
					{
						for($i = 0; $i < count($epcCajas); $i++)
						{
							$consulta = "SELECT * FROM punto_venta_cajas_envio WHERE epc_caja = '".$epcCajas[$i]."' AND id_envio_fk = $id_envio AND epc_tarima = '$tarima'";
							$resultado = mysql_query($consulta);

							if(mysql_num_rows($resultado) > 0)
								$consulta = "UPDATE punto_venta_cajas_envio SET recibido_dce = 1 WHERE epc_caja = '".$epcCajas[$i]."' AND id_envio_fk = $id_envio AND epc_tarima = '$tarima'";
							else
								$consulta = "INSERT INTO punto_venta_cajas_envio(id_envio_fk, epc_caja, epc_tarima, enviado_dce, recibido_dce) VALUES($id_envio, '".$epcCajas[$i]."', '$tarima', 0, 1)";

							$q = "SELECT id_envio_fk FROM entrada_punto_venta WHERE id_envio_fk = $id_envio";
							$re = mysql_query($q);
							if(mysql_num_rows($re) == 0)
							{ 
								$consulta = "INSERT INTO entrada_punto_venta(id_envio_fk, fecha_entrada_punto_venta, hora_entrada_punto_venta, id_usuario_punto_venta_fk) VALUES($id_envio, '".date("Y-m-d")."', '".date("H:i:s")."', $id_usuario)";
								mysql_query($consulta);
							}
							

							mysql_query($consulta);
						}	


						$datos_usuario = "Bien*Registro Exitoso";
					}else
						$datos_usuario = "Error*La tarima no pertenece a este envio";
				}else{

					for($i = 0; $i < count($epcCajas); $i++){
						$query = "INSERT INTO punto_venta_cajas_envio(id_envio_fk, epc_caja, epc_tarima, enviado_dce, recibido_dce) VALUES($id_envio, '".$epcCajas[$i]."', '$tarima', 0, 1)";

						mysql_query($query);
					}

					$datos_usuario = "Bien*La tarima NO esta registrada como ENVIADA en ningún envio. \n -Se registró como NO ENVIADA pero SI RECIBIDA.";
				}			
			}else
					$datos_usuario = "Error*Error";
		break;
	}


	mysql_close();
	echo $datos_usuario;

?>
<?php 
	header("Content-Type: application/json");

	include("../mod/conexion.php");
	$datos_usuario = "";
	$datos = explode(",", $_POST['datos']);
	$socio  = $datos[0];
	$carro  = $datos[1]; 
	$orden  = $datos[2]; 

	switch($socio){
		case 1://productor
		break;
		case 2://empaque
			$q = "SELECT id_envio FROM envios_empaque WHERE id_orden_fk = $orden AND id_camion_fk = $carro";
			$result = mysql_query($q);
			if(mysql_num_rows($result) > 0){
				$row = mysql_fetch_array($result);
				$id_envio = $row['id_envio'];

				$query = "SELECT id_distribuidor_cajas_envio FROM distribuidor_cajas_envio WHERE id_envio_fk = $id_envio";

				$r = mysql_query($query);

				if(mysql_num_rows($r) > 0){

					$query = "UPDATE envios_empaque SET estado_envio = 3 WHERE id_envio = $id_envio";
					$r = mysql_query($query);

					if($r){
						$query = "SELECT id_envio FROM envios_empaque WHERE id_orden_fk = $orden AND estado_envio = 7";
						$result = mysql_query($query);
						if(mysql_num_rows($result) == 0){
							$query = "UPDATE ordenes_distribuidor SET estado_orden = 3 WHERE id_orden = $orden";
							$r = mysql_query($query);
							if($r)
								$datos_usuario = "Bien*El Pre-Envio y la Orden han sido enviados.";
							else
								$datos_usuario = "Error*El Pre-Envio ha sido enviado y la orden no. \n -La orden debio enviarse puesto que ya no tiene envios pendientes.";
						}else
							$datos_usuario = "Bien*El Pre-Envio ha sido enviado pero la orden no.\n -Envie todos los preenvios de la orden para que la orden sea completada y enviada";
					}else
						$datos_usuario = "Error*Error al enviar el Pre-Envio";

				}else
					$datos_usuario = "Error*Aún no se leen cajas ni tarimas en el Pre-Envio.";
			}else
				$datos_usuario = "Error*Error al enviar el Pre-Envio: No se obtuvo el id del envio.";

		break;
		case 3://distribuidor

			$q = "SELECT id_envio FROM envios_distribuidor WHERE id_orden_dist_fk = $orden AND id_camion_fk = $carro";
			$result = mysql_query($q);
			if(mysql_num_rows($result) > 0){
				$row = mysql_fetch_array($result);
				$id_envio = $row['id_envio'];

				$query = "SELECT id_punto_venta_cajas_envio FROM punto_venta_cajas_envio WHERE id_envio_fk = $id_envio";

				$r = mysql_query($query);

				if(mysql_num_rows($r) > 0)
				{

					$query = "UPDATE envios_distribuidor SET estado_envio = 3 WHERE id_envio = $id_envio";
					$r = mysql_query($query);

					if($r)
					{
						$query = "SELECT id_envio FROM envios_distribuidor WHERE id_orden_dist_fk = $orden AND estado_envio = 7";
						$result = mysql_query($query);
						if(mysql_num_rows($result) == 0)
						{
							$query = "UPDATE ordenes_punto_venta SET estado_orden = 3 WHERE id_orden = $orden";
							$r = mysql_query($query);
							if($r)
								$datos_usuario = "Bien*El Pre-Envio y la Orden han sido enviados.";
							else
								$datos_usuario = "Error*El Pre-Envio ha sido enviado y la orden no. \n -La orden debio enviarse puesto que ya no tiene envios pendientes.";
						}else
							$datos_usuario = "Bien*El Pre-Envio ha sido enviado pero la orden no.\n -Envie todos los preenvios de la orden para que la orden sea completada y enviada";
					}else
						$datos_usuario = "Error*Error al enviar el Pre-Envio";

				}else
					$datos_usuario = "Error*Aún no se guardan cajas ni tarimas en el Pre-Envio.";
			}else
				$datos_usuario = "Error*Error al enviar el Pre-Envio: No se obtuvo el id del envio.";


		break;
		case 4://punto venta
		break;
	}


	mysql_close();
	echo $datos_usuario;
 ?>
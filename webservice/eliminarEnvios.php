<?php 
	header("Content-Type: application/json");

	include("../mod/conexion.php");
	$datos_usuario = "";
	$datos = explode(",", $_POST['datos']);
	$socio  = $datos[0];
	$id_envio  = $datos[1]; 
	$carro  = $datos[2]; 

	switch($socio){
		case 1://productor
		break;
		case 2://empaque

				$query = "DELETE FROM distribuidor_cajas_envio WHERE id_envio_fk = $id_envio";
				$result = mysql_query($query);
				if($result){
					$query = "DELETE FROM envios_empaque WHERE id_envio = $id_envio";
					$r = mysql_query($query);

					if($r){
						$datos_usuario = "Bien*Pre-Envio eliminado correctamente";
						mysql_query("UPDATE camiones_empaque set estado_ce = 0 where id_camion = $carro");
					}
					else
						$datos_usuario = "Error*No se pudo eliminar el envio $id_envio";
				}else	
					$datos_usuario = "Error*No es posible eliminar las cajas y tarimas del envio $id_envio";
		break;
		case 3://distribuidor

				$query = "DELETE FROM punto_venta_cajas_envio WHERE id_envio_fk = $id_envio";
				$result = mysql_query($query);
				if($result){
					$query = "DELETE FROM envios_distribuidor WHERE id_envio = $id_envio";
					$r = mysql_query($query);

					if($r){
						$datos_usuario = "Bien*Pre-Envio eliminado correctamente";
						mysql_query("UPDATE camiones_distribuidor set estado_cd = 0 where id_camion = $carro");
					}
					else
						$datos_usuario = "Error*No se pudo eliminar el envio $id_envio";
				}else	
					$datos_usuario = "Error*No es posible eliminar las cajas y tarimas del envio $id_envio";

		break;
		case 4://punto venta
		break;
	}


	mysql_close();
	echo $datos_usuario;
 ?>
<?php 
	header("Content-Type: application/json");

	include("../mod/conexion.php");

	$datos_usuario = "";
	$datos 	= explode(",", $_POST['datos']);
	$socio  = $datos[0];
	$carro  = $datos[1]; 
	$orden  = $datos[2]; 
	$envio 	= $datos[3];

	$query = "SELECT id_distribuidor_cajas_envio FROM distribuidor_cajas_envio WHERE recibido_dce = 1 AND id_envio_fk = $envio";
	$result = mysql_query($query);

	$recibido = mysql_num_rows($result);

	if($recibido == 0){
		$datos_usuario = "Error*No puede completar este envio porque aún no recibe ninguna caja.";
	}else{

		$query = "SELECT id_distribuidor_cajas_envio FROM distribuidor_cajas_envio WHERE enviado_dce = 1 AND id_envio_fk = $envio";
		$result = mysql_query($query);

		$enviado = mysql_num_rows($result);

		if($enviado == $recibido){

			$query = "UPDATE envios_empaque SET estado_envio = 4 WHERE id_envio = $envio";
			$r = mysql_query($query);

			if($r){

				$query = "SELECT id_envio FROM envios_empaque WHERE id_orden_fk = $orden AND estado_envio = 3";
				$Enviosresult = mysql_query($query);

				if(mysql_num_rows($Enviosresult) == 0){
					$query = "SELECT estado_orden FROM ordenes_distribuidor WHERE id_orden = $orden";
					$Ordenresult = mysql_query($query);

					$estadoOrden = mysql_fetch_array($Ordenresult);

					if($estadoOrden['estado_orden'] == 6)
						$datos_usuario = "Bien*El envio ha sido finalizado exitosamente. \n -La orden no se finalizó porque aún pueden llegar envios de la orden.";
					else{
						$query = "UPDATE ordenes_distribuidor SET estado_orden = 4 WHERE id_orden = $orden";
						$r = mysql_query($query);

							if($r)
								$datos_usuario = "Bien*El Envio y la Orden han sido Finalizados.";
							else
								$datos_usuario = "Error*El Envio ha sido finalizao y la orden no. \n -La orden debio finalizarse puesto que ya no tiene envios.";
					}


					/*$query = "UPDATE ordenes_distribuidor SET estado_orden = 3 WHERE id_orden = $orden";
					$r = mysql_query($query);

					if($r)
						$datos_usuario = "Bien*El Pre-Envio y la Orden han sido enviados.";
					else
						$datos_usuario = "Error*El Pre-Envio ha sido enviado y la orden no. \n -La orden debio enviarse puesto que ya no tiene envios pendientes.";*/

				}else
					$datos_usuario = "Bien*El Envio ha sido entregado exitosamente.\n -Finalice todos los envios de la orden para que la orden sea Finalizada";

			}else
				$datos_usuario = "Error*Error al finalizar el envio";




			//$datos_usuario .= "Bien*Envio finalizado y entrega exitosa.";		
		}else{
			if($enviado > $recibido){
				$datos_usuario .= "Error*No se han recibido las cajas que se enviaron.\n - Cajas enviadas: $enviado \n - Cajas recibidas: $recibido";
			}else
				$datos_usuario .= "Error*Se han recibido mas cajas de las que se enviaron.\n - Cajas enviadas: $enviado \n - Cajas recibidas: $recibido";
		}

	}


	mysql_close();
	echo $datos_usuario;

?>
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
			$datos_usuario .= "Bien*Envio finalizado y entrega exitosa.";		
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
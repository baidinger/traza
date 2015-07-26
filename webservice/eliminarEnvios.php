<?php 
	header("Content-Type: application/json");

	include("conexion.php");

	$datos = split(",", $_POST['datos']);
	$socio  = $datos[0];
	$id_envio  = $datos[1]; 

	switch($socio){
		case 1://productor
		break;
		case 2://empaque
				$query = "DELETE FROM envios_empaque WHERE id_envio = $id_envio";
				$r = mysql_query($query);

				if($r)
					$datos_usuario = "Bien*Envio eliminado correctamente";
				else
					$datos_usuario = "Error*No se pudo eliminar el envio $id_envio";	

		break;
		case 3://distribuidor
		break;
		case 4://punto venta
		break;
	}


	mysql_close($dbhandle);
	echo $datos_usuario;
 ?>
<?php 
	header("Content-Type: application/json");

	include("../mod/conexion.php");

		$datos_usuario = "";
	$datos = explode(",", $_POST['datos']);
	$socio  = $datos[0];
	$id_usuario = $datos[1];

	switch($socio){
		case 1://productor
		break;
		case 2://empaque

		break;
		case 3://distribuidor

			if($tipo == 3){//Informacion para llenar la tabla de preenvios de la handaheld
				$query = "SELECT id_envio, id_camion_fk, id_orden_fk FROM envios_empaque AS ee WHERE ee.id_distribuidor_fk = $id_usuario AND estado_envio = 3";
				$r = mysql_query($query);
				if(mysql_num_rows($r) > 0){
					$datos_usuario = "Bien*";
					while($row=mysql_fetch_array($r)){
						$datos_usuario .= $row['id_envio'].",".$row['id_camion_fk'].",".$row['id_orden_fk'].",";
					}
				}else
					$datos_usuario = "Error*Error";
			}

		break;
		case 4://punto venta
		break;
	}


	mysql_close();
	echo $datos_usuario;

?>
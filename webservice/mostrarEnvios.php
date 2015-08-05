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
			$query = "SELECT id_envio, id_camion_fk, id_orden_fk, nombre_empaque FROM envios_empaque AS ee, empresa_empaques AS em_em, ordenes_distribuidor AS od  WHERE em_em.id_empaque = od.id_empaque_fk AND od.id_orden = ee.id_orden_fk AND ee.id_distribuidor_fk = $id_usuario AND estado_envio = 3";
			$r = mysql_query($query);
			if(mysql_num_rows($r) > 0){
				$datos_usuario = "Bien*";
				while($row=mysql_fetch_array($r)){
					$datos_usuario .= $row['id_envio'].",".$row['id_camion_fk'].",".$row['id_orden_fk'].",".$row['nombre_empaque'].",";;
				}
			}else
				$datos_usuario = "Error*Error";
		break;
		case 4://punto venta
			$query = "SELECT id_envio, id_camion_fk, id_orden_dist_fk, nombre_distribuidor FROM envios_distribuidor AS ed, empresa_distribuidores AS em_dist, ordenes_punto_venta AS opv  WHERE em_dist.id_distribuidor = opv.id_distribuidor_fk AND opv.id_orden = ed.id_orden_dist_fk AND ed.id_punto_venta_fk = $id_usuario AND estado_envio = 3";
			$r = mysql_query($query);
			if(mysql_num_rows($r) > 0){
				$datos_usuario = "Bien*";
				while($row=mysql_fetch_array($r)){
					$datos_usuario .= $row['id_envio'].",".$row['id_camion_fk'].",".$row['id_orden_dist_fk'].",".$row['nombre_distribuidor'].",";;
				}
			}else
				$datos_usuario = "Error*Error";
		break;
	}


	mysql_close();
	echo $datos_usuario;

?>
<?php 
	$datos_usuario = "";
	$epc = "";
	if(isset($_REQUEST['epc']))
		$epc = $_REQUEST['epc'];

include("../../mod/conexion.php");

if(isset($_REQUEST['epc'])) { 

/******************************************************************

TRAZABILIDAD DE EPC ENVIADO DEL DISTRIBUIDOR AL PUNTO DE VENTA

*********************************************************************************/

		$consulta = "SELECT ubicacion_huerta, hectareas, nombre_producto,
			nombre_productor, rfc_productor, direccion_productor,
			id_lote, remitente_lote, fecha_recibo_lote,
			nombre_empaque, rfc_empaque, nombre_distribuidor, rfc_distribuidor,
			ordenes_distribuidor.id_orden as id_orden_distribuidor,
			ordenes_distribuidor.fecha_orden as fecha_orden_distribuidor,
			ordenes_distribuidor.estado_orden as estado_orden_distribuidor,
			envios_empaque.id_envio as id_envio_empaque, envios_empaque.fecha_envio as fecha_envio_empaque,
			envios_empaque.estado_envio as estado_envio_empaque,
			nombre_punto_venta, rfc_punto_venta, ordenes_punto_venta.id_orden as id_orden_punto_venta,
			ordenes_punto_venta.fecha_orden as fecha_orden_punto_venta, 
			ordenes_punto_venta.estado_orden as estado_orden_punto_venta,
			envios_distribuidor.id_envio as id_envio_distribuidor,
			envios_distribuidor.fecha_envio as fecha_envio_distribuidor,
			envios_distribuidor.estado_envio as estado_envio_distribuidor
			 from empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor, entrada_distribuidor, punto_venta_cajas_envio, ordenes_punto_venta, envios_distribuidor, empresa_punto_venta where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND entrada_distribuidor.id_envio_fk = envios_empaque.id_envio AND epc_caja.epc_caja = punto_venta_cajas_envio.epc_caja AND punto_venta_cajas_envio.id_envio_fk = envios_distribuidor.id_envio AND envios_distribuidor.id_punto_venta_fk= empresa_punto_venta.id_punto_venta AND ordenes_punto_venta.id_orden = envios_distribuidor.id_orden_dist_fk AND epc_caja.epc_caja = '$epc'";
		$result = mysql_query($consulta);
		if(mysql_num_rows($result) > 0){ 
			if ($row = mysql_fetch_array($result)) {

				$datos_usuario .= "1*HUERTA,".$row['ubicacion_huerta'].",".$row['hectareas'].",".$row['nombre_producto']." ". $row['variedad_producto'];

				$datos_usuario .= "*PRODUCTOR,".$row['nombre_productor']." ".$row['apellido_productor'].",".$row['rfc_productor'].",".$row['direccion_productor'];

				$datos_usuario .= "*LOTE,".$row['id_lote'].",".$row['remitente_lote'].",".$row['fecha_recibo_lote'];

				$datos_usuario .= "*EMPAQUE,".$row['nombre_empaque'].",".$row['rfc_empaque'];

				$datos_usuario .= "*DISTRIBUIDOR,".$row['nombre_distribuidor'].",".$row['rfc_distribuidor'];

				$datos_usuario .= "*ORDEN DEL DISTRIBUIDOR,".$row['id_orden_distribuidor'].",".$row['fecha_orden_distribuidor'].",";


				switch($row['estado_orden_distribuidor'])
				{
				 	case 1: $datos_usuario .= "Pendiente"; break;
				 	case 2: $datos_usuario .= "Rechazado por emp."; break;
				 	case 3: $datos_usuario .= "Enviado"; break;
				 	case 4: $datos_usuario .= "Concretado"; break;
				 	case 5: $datos_usuario .= "Cancel. por emp."; break;
				 	case 6: $datos_usuario .= "Aprobado"; break;
				 	case 7: $datos_usuario .= "Pre-envío"; break;
				 	case 8: $datos_usuario .= "Cancel. por dist."; break;
				 	case 9: $datos_usuario .= "Rechazado por dist."; break;
				}

				 $datos_usuario .= "*ENVIO AL DISTRIBUIDOR,".$row['id_envio_empaque'].",".$row['id_camion_fk'].",".$row['fecha_envio_empaque'].",";


				switch($row['estado_envio_empaque']){
				 	case 1: $datos_usuario .= "Pendiente"; break;
				 	case 2: $datos_usuario .= "Rechazado por emp."; break;
				 	case 3: $datos_usuario .= "Enviado"; break;
				 	case 4: $datos_usuario .= "Concretado"; break;
				 	case 5: $datos_usuario .= "Cancel. por emp."; break;
				 	case 6: $datos_usuario .= "Aprobado"; break;
				 	case 7: $datos_usuario .= "Pre-envío"; break;
				 	case 8: $datos_usuario .= "Cancel. por dist."; break;
				 	case 9: $datos_usuario .= "Rechazado por dist."; break;
				} 

				$datos_usuario .= ",".$row['fecha_entrada']." a las ".$row['hora_entrada'];

				$datos_usuario .= "*PUNTO DE VENTA,".$row['nombre_punto_venta'].",".$row['rfc_punto_venta'];

				$datos_usuario .= "*ORDEN DEL PUNTO DE VENTA,".$row['id_orden_punto_venta'].",".$row['fecha_orden_punto_venta'].",";

				switch($row['estado_orden_punto_venta'])
				{
				 	case 1: $datos_usuario .= "Pendiente"; break;
				 	case 2: $datos_usuario .= "Rechazado por emp."; break;
				 	case 3: $datos_usuario .= "Enviado"; break;
				 	case 4: $datos_usuario .= "Concretado"; break;
				 	case 5: $datos_usuario .= "Cancel. por emp."; break;
				 	case 6: $datos_usuario .= "Aprobado"; break;
				 	case 7: $datos_usuario .= "Pre-envío"; break;
				 	case 8: $datos_usuario .= "Cancel. por dist."; break;
				 	case 9: $datos_usuario .= "Rechazado por dist."; break;
				} 

				$datos_usuario .= "*ENVIO AL PUNTO DE VENTA,".$row['id_envio_distribuidor'].",".$row['id_camion_fk'].",".$row['fecha_envio_distribuidor'].",";


				switch($row['estado_envio_distribuidor']){
					case 1: $datos_usuario .= "Pendiente"; break;
				 	case 2: $datos_usuario .= "Rechazado por emp."; break;
				 	case 3: $datos_usuario .= "Enviado"; break;
				 	case 4: $datos_usuario .= "Concretado"; break;
				 	case 5: $datos_usuario .= "Cancel. por emp."; break;
				 	case 6: $datos_usuario .= "Aprobado"; break;
				 	case 7: $datos_usuario .= "Pre-envío"; break;
				 	case 8: $datos_usuario .= "Cancel. por dist."; break;
				 	case 9: $datos_usuario .= "Rechazado por dist."; break;
				} 
	    	}
		}else{
/******************************************************************

TRAZABILIDAD DE EPC ENVIADO Y ENTREGADO AL DISTRIBUIDOR

*********************************************************************************/

		$consulta = "SELECT * from empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor, entrada_distribuidor where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND entrada_distribuidor.id_envio_fk = envios_empaque.id_envio AND epc_caja.epc_caja = '$epc'";
		$result = mysql_query($consulta);
		if(mysql_num_rows($result) > 0){ 
			if ($row = mysql_fetch_array($result)) { 
		
				$datos_usuario .= "2*HUERTA,".$row['ubicacion_huerta'].",".$row['hectareas'].",".$row['nombre_producto']." ". $row['variedad_producto'];

				$datos_usuario .= "*PRODUCTOR,".$row['nombre_productor']." ".$row['apellido_productor'].",".$row['rfc_productor'].",".$row['direccion_productor'];

				$datos_usuario .= "*LOTE,".$row['id_lote'].",".$row['remitente_lote'].",".$row['fecha_recibo_lote'];

				$datos_usuario .= "*EMPAQUE,".$row['nombre_empaque'].",".$row['rfc_empaque'];

				$datos_usuario .= "*DISTRIBUIDOR,".$row['nombre_distribuidor'].",".$row['rfc_distribuidor'];

				$datos_usuario .= "*ORDEN DEL DISTRIBUIDOR,".$row['id_orden_distribuidor'].",".$row['fecha_orden_distribuidor'].",";


				switch($row['estado_orden_distribuidor'])
				{
				 	case 1: $datos_usuario .= "Pendiente"; break;
				 	case 2: $datos_usuario .= "Rechazado por emp."; break;
				 	case 3: $datos_usuario .= "Enviado"; break;
				 	case 4: $datos_usuario .= "Concretado"; break;
				 	case 5: $datos_usuario .= "Cancel. por emp."; break;
				 	case 6: $datos_usuario .= "Aprobado"; break;
				 	case 7: $datos_usuario .= "Pre-envío"; break;
				 	case 8: $datos_usuario .= "Cancel. por dist."; break;
				 	case 9: $datos_usuario .= "Rechazado por dist."; break;
				}
			

	  			$datos_usuario .= "*ENVIO AL DISTRIBUIDOR,".$row['id_envio_empaque'].",".$row['id_camion_fk'].",".$row['fecha_envio_empaque'].",";


				switch($row['estado_envio_empaque']){
				 	case 1: $datos_usuario .= "Pendiente"; break;
				 	case 2: $datos_usuario .= "Rechazado por emp."; break;
				 	case 3: $datos_usuario .= "Enviado"; break;
				 	case 4: $datos_usuario .= "Concretado"; break;
				 	case 5: $datos_usuario .= "Cancel. por emp."; break;
				 	case 6: $datos_usuario .= "Aprobado"; break;
				 	case 7: $datos_usuario .= "Pre-envío"; break;
				 	case 8: $datos_usuario .= "Cancel. por dist."; break;
				 	case 9: $datos_usuario .= "Rechazado por dist."; break;
				} 

				$datos_usuario .= ",".$row['fecha_entrada']." a las ".$row['hora_entrada'];
			}
		}else{
/******************************************************************

TRAZABILIDAD DE EPC ENVIADO PERO NO ENTREGADO

*********************************************************************************/
		$consulta = "SELECT * FROM empresa_productores, empresa_distribuidores, empresa_empaques, productos_productores, productos, lotes, epc_caja, distribuidor_cajas_envio, envios_empaque, ordenes_distribuidor, usuario_empaque, usuario_distribuidor where empresa_distribuidores.id_distribuidor = envios_empaque.id_distribuidor_fk AND envios_empaque.id_receptor_fk = usuario_empaque.id_receptor AND usuario_distribuidor.id_usuario_distribuidor = ordenes_distribuidor.id_usuario_distribuidor_fk AND empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND epc_caja.epc_caja = distribuidor_cajas_envio.epc_caja AND distribuidor_cajas_envio.id_envio_fk = envios_empaque.id_envio AND envios_empaque.id_orden_fk = ordenes_distribuidor.id_orden AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND epc_caja.epc_caja = '$epc'";

		$result = mysql_query($consulta);
		if(mysql_num_rows($result) > 0){
		if ($row = mysql_fetch_array($result)) { 

			$datos_usuario .= "3*HUERTA,".$row['ubicacion_huerta'].",".$row['hectareas'].",".$row['nombre_producto']." ". $row['variedad_producto'];

			$datos_usuario .= "*PRODUCTOR,".$row['nombre_productor']." ".$row['apellido_productor'].",".$row['rfc_productor'].",".$row['direccion_productor'];

		
	    	$datos_usuario .= "*LOTE,".$row['id_lote'].",".$row['remitente_lote'].",".$row['fecha_recibo_lote'];

			$datos_usuario .= "*EMPAQUE,".$row['nombre_empaque'].",".$row['rfc_empaque'];

			$datos_usuario .= "*ORDEN DEL DISTRIBUIDOR,".$row['id_orden_distribuidor'].",".$row['fecha_orden_distribuidor'].",";


			switch($row['estado_orden_distribuidor'])
			{
			 	case 1: $datos_usuario .= "Pendiente"; break;
			 	case 2: $datos_usuario .= "Rechazado por emp."; break;
			 	case 3: $datos_usuario .= "Enviado"; break;
			 	case 4: $datos_usuario .= "Concretado"; break;
			 	case 5: $datos_usuario .= "Cancel. por emp."; break;
			 	case 6: $datos_usuario .= "Aprobado"; break;
			 	case 7: $datos_usuario .= "Pre-envío"; break;
			 	case 8: $datos_usuario .= "Cancel. por dist."; break;
			 	case 9: $datos_usuario .= "Rechazado por dist."; break;
			}

			$datos_usuario .= "*ENVIO AL DISTRIBUIDOR,".$row['id_envio_empaque'].",".$row['id_camion_fk'].",".$row['fecha_envio_empaque'].",";


			switch($row['estado_envio_empaque'])
			{
			 	case 1: $datos_usuario .= "Pendiente"; break;
			 	case 2: $datos_usuario .= "Rechazado por emp."; break;
			 	case 3: $datos_usuario .= "Enviado"; break;
			 	case 4: $datos_usuario .= "Concretado"; break;
			 	case 5: $datos_usuario .= "Cancel. por emp."; break;
			 	case 6: $datos_usuario .= "Aprobado"; break;
			 	case 7: $datos_usuario .= "Pre-envío"; break;
			 	case 8: $datos_usuario .= "Cancel. por dist."; break;
			 	case 9: $datos_usuario .= "Rechazado por dist."; break;
			} 

			$datos_usuario .= ",".$row['fecha_entrada']." a las ".$row['hora_entrada'];

		?>
			<?php }
		} else {

/******************************************************************

TRAZABILIDAD EN EL EMPAQUE

*********************************************************************************/
			$consulta = "SELECT * FROM empresa_productores, empresa_empaques, productos_productores, productos, lotes, epc_caja where empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND epc_caja.epc_caja = '$epc'";
			$result = mysql_query($consulta);
			if(mysql_num_rows($result) > 0){
				if ($row = mysql_fetch_array($result)) { 

					$datos_usuario .= "4*HUERTA,".$row['ubicacion_huerta'].",".$row['hectareas'].",".$row['nombre_producto']." ". $row['variedad_producto'];

					$datos_usuario .= "*PRODUCTOR,".$row['nombre_productor']." ".$row['apellido_productor'].",".$row['rfc_productor'].",".$row['direccion_productor'];

					$datos_usuario .= "*LOTE,".$row['id_lote'].",".$row['remitente_lote'].",".$row['fecha_recibo_lote'];

					$datos_usuario .= "*EMPAQUE,".$row['nombre_empaque'].",".$row['rfc_empaque'];

			 	}
			}else{ 

				
				$datos_usuario .= "El EPC $epc no existe en la base de datos.";
				
			}
		}

		}
	}
	
 } ?>

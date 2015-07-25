<?php 
	include('../../mod/conexion.php');
	$id_productor 		=	$_POST['id_productor'];
	$id_producto 		=	$_POST['id_producto'];
	$cantidad_cajas 	= 	$_POST['cantidad_cajas'];
	$cantidad_kilos		=	$_POST['cantidad_kilos'];
	$nombre_remitente	=	strtoupper($_POST['nombre_remitente']);
	$costo_lote			=	$_POST['costo_lote'];
	/*$rango_inicial		=	$_POST['rango_inicial'];
	$rango_final		=	$_POST['rango_final'];*/

	$url			=	$_POST['url'];

	$result = mysql_query("select * from usuario_empaque where id_usuario_fk = ".$_SESSION['id_usuario']);
			if($result){
				 while($row = mysql_fetch_array($result)) {
				 	$id_empaque = $row['id_empaque_fk'];
				 }
			}

	
	 PRINT $cadena = " INSERT INTO lotes (id_productor_fk, id_producto_fk, cant_cajas_lote, cant_kilos_lote, remitente_lote, fecha_recibo_lote, hora_recibo_lote, costo_lote, id_empaque_fk, fecha_caducidad, fecha_recoleccion,  hora_recoleccion, numero_peones, rendimiento_kg, rendimiento_cajas) 
		VALUES ($id_productor,$id_producto,$cantidad_cajas,$cantidad_kilos,'".$nombre_remitente."','".date("Y-m-d")."','".date("H:i:s")."',$costo_lote,$id_empaque,'".date("Y-m-d")."','".date("Y-m-d")."','".date("H:i:s")."',0,0,0)";
	if(mysql_query($cadena)){
			mysql_close($conexion);
			header ("Location: ../index.php?op=admon_lotes");
		}else{
			mysql_close($conexion);
//			header ("Location: ../index.php?op=");
		}

 ?>
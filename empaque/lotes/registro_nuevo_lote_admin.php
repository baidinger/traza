<?php 
	include('../../mod/conexion.php');
	$id_productos_productores 		=	$_POST['id_productos_productores'];
	$cantidad_cajas 				= 	$_POST['cantidad_cajas'];
	$cantidad_kilos					=	$_POST['cantidad_kilos'];
	$nombre_remitente				=	strtoupper($_POST['nombre_remitente']);
	$costo_lote						=	$_POST['costo_lote'];
	$fecha_recoleccion				=	$_POST['fecha_recoleccion'];
	$hora_recoleccion				=	$_POST['hora_recoleccion'];
	$fecha_caducidad				=	$_POST['fecha_caducidad'];
	$numero_peones					=	$_POST['numero_peones'];

	$url			=	$_POST['url'];

	
	 $cadena = " INSERT INTO lotes (id_productos_productores_fk, cant_cajas_lote, cant_kilos_lote, remitente_lote, fecha_recibo_lote, hora_recibo_lote, costo_lote, id_empaque_fk, fecha_caducidad, fecha_recoleccion,  hora_recoleccion, numero_peones,id_receptor_fk) 
		VALUES ($id_productos_productores,$cantidad_cajas,$cantidad_kilos,'".$nombre_remitente."','".date("Y-m-d")."','".date("H:i:s")."',$costo_lote,$_SESSION[id_empaque],'".$fecha_caducidad."','".$fecha_recoleccion."','".$hora_recoleccion."',$numero_peones,$_SESSION[id_receptor])";
	if(mysql_query($cadena)){
			mysql_close($conexion);
			header ("Location: ../index.php?op=admon_lotes");
		}else{
			mysql_close($conexion);
//			header ("Location: ../index.php?op=");
		}

 ?>
<?php 
	include('../../mod/conexion.php');
	$id_lote 		=	$_POST['id_lote'];
	$id_producto 		=	$_POST['id_producto'];
	$cantidad_cajas 	= 	$_POST['cantidad_cajas'];
	$cantidad_kilos		=	$_POST['cantidad_kilos'];
	$nombre_remitente	=	strtoupper($_POST['nombre_remitente']);
	$costo_lote			=	$_POST['costo_lote'];
	/*$rango_inicial		=	$_POST['rango_inicial'];
	$rango_final		=	$_POST['rango_final'];*/

	$url			=	$_POST['url'];


     $cadena = " UPDATE lotes set id_producto_fk = $id_producto, cant_cajas_lote = $cantidad_cajas, 
		cant_kilos_lote = $cantidad_kilos, remitente_lote = '$nombre_remitente', costo_lote = $costo_lote  where id_lote = $id_lote"; 

	if(mysql_query($cadena)){
			mysql_close($conexion);
			header ("Location: ../index.php?op=admon_lotes");
		}else{
			mysql_close($conexion);
			header ("Location: ../index.php?op=admon_lotes&e");
		}

 ?>
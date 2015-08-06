<?php 
	include('../../mod/conexion.php');
	$id_lote 					=	$_POST['id_lote'];
	$id_productos_productores 	=	$_POST['id_productos_productores'];
	$cantidad_cajas 			= 	$_POST['cantidad_cajas'];
	$cantidad_kilos				=	$_POST['cantidad_kilos'];
	$rendimiento_cajas 			= 	$_POST['rendimiento_cajas'];
	$rendimiento_kilos			=	$_POST['rendimiento_kg'];
	$nombre_remitente			=	strtoupper($_POST['nombre_remitente']);
	$costo_lote					=	$_POST['costo_lote'];

	$url			=	$_POST['url'];


     $cadena = " UPDATE lotes set id_productos_productores_fk = $id_productos_productores, cant_cajas_lote = $cantidad_cajas, 
		cant_kilos_lote = $cantidad_kilos, remitente_lote = '$nombre_remitente', rendimiento_kg = $rendimiento_kilos, 
		rendimiento_cajas = $rendimiento_cajas, costo_lote = $costo_lote  where id_lote = $id_lote"; 

	if(mysql_query($cadena)){
			mysql_close($conexion);
			header ("Location: ../index.php?op=admon_lotes");
		}else{
			mysql_close($conexion);
			header ("Location: ../index.php?op=admon_lotes&e");
		}

 ?>
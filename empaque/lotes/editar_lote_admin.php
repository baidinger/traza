<?php 
	include('../../mod/conexion.php');
	$id_lote 					=	$_POST['id_lote'];
	$id_productos_productores 	=	$_POST['id_productos_productores'];
	$cantidad_cajas 			= 	$_POST['cantidad_cajas'];
	$cantidad_kilos				=	$_POST['cantidad_kilos'];
	$cajas_chicas 				= 	$_POST['cajas_chicas'];
	$cajas_medianas 			= 	$_POST['cajas_medianas'];
	$cajas_grandes				= 	$_POST['cajas_grandes'];
	$rend_kg 					= 	$_POST['rendimiento'];
	$resaga 					= 	$_POST['resaga'];
	$merma1 					= 	$_POST['merma1'];
	$merma2 					= 	$_POST['merma2'];
	$nombre_remitente			=	strtoupper($_POST['nombre_remitente']);
	$marca						=	$_POST['marca'];
	$modelo						=	$_POST['modelo'];
	$fecha_recoleccion			=	$_POST['fecha_recoleccion'];
	$hora_recoleccion			=	$_POST['hora_recoleccion'];
	$fecha_caducidad			=	$_POST['fecha_caducidad'];
	$numero_peones				=	$_POST['numero_peones'];
	$placas						=	$_POST['placas'];
	$costo_lote					=	$_POST['costo_lote'];

	$url			=	$_POST['url'];


    print $cadena = " UPDATE lotes set 
     				id_productos_productores_fk = $id_productos_productores, 
     				cant_cajas_lote = $cantidad_cajas, 
					cant_kilos_lote = $cantidad_kilos, 
					remitente_lote = '$nombre_remitente',
					marca = '$marca',  
					modelo = $modelo,  
					placas = '$placas',   
					rendimiento_kg = $rend_kg,
					cajas_chicas = $cajas_chicas, 
					cajas_medianas = $cajas_medianas,  
					cajas_grandes = $cajas_grandes,  
					resaga = $resaga,  
					merma1 = $merma1,  
					merma2 = $merma2,
					fecha_recoleccion = '$fecha_recoleccion',
					fecha_caducidad = '$fecha_caducidad',
					hora_recoleccion = '$hora_recoleccion',
					numero_peones = $numero_peones,
					costo_lote = $costo_lote 
					where id_lote = $id_lote"; 

	if(mysql_query($cadena)){
			mysql_close($conexion);
			header ("Location: ../index.php?op=admon_lotes");
		}else{
			mysql_close($conexion);
			header ("Location: ../index.php?op=admon_lotes&e");
		}

 ?>
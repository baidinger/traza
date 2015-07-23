<?php
	
	$id_orden 			=	$_POST['id_orden'];
	$id_distribuidor 	=	$_POST['id_distribuidor'];
	$descripcion 		=	$_POST['descripcion'];

	include("../../mod/conexion.php");

	

	 $cad = "INSERT INTO envios_empaque 
		(fecha_envio,fecha_entrega_envio, hora_envio, descripcion_envio, estado_envio, id_distribuidor_fk, id_orden_fk) 
		VALUES('".date("Y-m-d")."','0000-00-00','".date("H:i:s")."','$descripcion',3, $id_distribuidor,$id_orden)";

	if(mysql_query($cad)){
		mysql_query("UPDATE ordenes_distribuidor set estatus_orden=3 where id_orden = $id_orden");
	}

	header("Location: ../index.php?op=envios");
 ?>

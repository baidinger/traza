<?php 
	include("../../mod/conexion.php");

	$id_punto_venta		=	$_GET['id'];

	if(mysql_query("update empresa_punto_venta set estado = 1 where id_punto_venta = ".$id_punto_venta." ")){
		mysql_close($conexion);

		header ("Location:../index.php?op=bus_pv");	
	}else{
		mysql_close($conexion);

		header ("Location:../index.php?op=error_act_user");	
	}

	

 ?>
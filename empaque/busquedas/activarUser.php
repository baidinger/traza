<?php 
	include("../../mod/conexion.php");

	$id_productor		=	$_GET['id'];

	if(mysql_query("update empresa_productores set estado = 1 where id_productor = ".$id_productor." ")){
		mysql_close($conexion);

		header ("Location:../index.php?op=bus_productor");	
	}else{
		mysql_close($conexion);

		header ("Location:../index.php?op=error_desac_user");	
	}

	

 ?>
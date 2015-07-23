<?php 
	include("../../mod/conexion.php");

	$id_distribuidor	=	$_GET['id'];

	if(mysql_query("update empresa_distribuidores set estado = 0 where id_distribuidor = ".$id_distribuidor." ")){
		mysql_close($conexion);

		header ("Location:../index.php?op=bus_distribuidor");	
	}else{
		mysql_close($conexion);

		header ("Location:../index.php?op=error_desac_user");	
	}

	

 ?>
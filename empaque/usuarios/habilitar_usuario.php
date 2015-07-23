<?php 
	include("../../mod/conexion.php");

	$id_usuario		=	$_GET['id'];
	$status 			=	$_GET['status'];

	$query = "update usuarios set estado_usuario = ".$status." where id_usuario = ".$id_usuario;
	if(mysql_query($query)){
		mysql_close($conexion);

		header ("Location:../index.php?op=admon_users");	
	}else{
		mysql_close($conexion);

		header ("Location:../index.php?op=error_admon_users");	
	}

	

 ?>
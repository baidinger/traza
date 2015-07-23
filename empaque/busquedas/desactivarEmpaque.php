<?php 
	include("../../mod/conexion.php");

	$id_empaque		=	$_GET['id'];

	if(mysql_query("update empresa_empaques set estado = 0 where id_empaque = ".$id_empaque." ")){
		mysql_close($conexion);

		header ("Location:../index.php?op=bus_empaque");	
	}else{
		mysql_close($conexion);

		header ("Location:../index.php?op=error_desac_user");	
	}

	

 ?>
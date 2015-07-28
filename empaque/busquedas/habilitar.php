<?php session_start(); if($_SESSION['nivel_socio'] != 1) return; 
	include("../../mod/conexion.php");

	$id		=	$_GET['id'];
	$status =	$_GET['status'];
	$rol 	= 	$_GET['rol'];

	switch ($rol) {
		case 1:
			$query = "update empresa_productores set estado_p = ".$status." where id_productor = ".$id;		
			$url = "bus_productor";
		break;
		case 2:
			if($_SESSION['superusuario'] == 1){
				$query = "update empresa_empaques set estado_e = ".$status." where id_empaque = ".$id;		
			}
			$url = "bus_empaque";

		break;
		case 3:
			$query = "update empresa_distribuidores set estado_d = ".$status." where id_distribuidor = ".$id;		
			$url = "bus_distribuidor";
		break;
		case 4:
			$query = "update empresa_punto_venta set estado_pv = ".$status." where id_punto_venta = ".$id;		
			$url = "bus_pv";
		break;
	}
	
	if(mysql_query($query)){
		mysql_close($conexion);

		header ("Location:../index.php?op=".$url);	
	}else{
		mysql_close($conexion);

		header ("Location:../index.php?op=".$url."&error");	
	}

 ?>
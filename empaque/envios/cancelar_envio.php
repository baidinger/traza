<?php session_start(); if($_SESSION['nivel_socio'] != 1) return; 
	include("../../mod/conexion.php");
	$id_envio = $_GET['id'];
	$id_orden = $_GET['orden'];

	$c = "UPDATE envios_empaque set estado_envio = 5 where id_envio = $id_envio";
	mysql_query($c);

	$c = "UPDATE ordenes_distribuidor set estado_orden = 5 where id_orden = $id_orden";
	mysql_query($c);

	header("Location: ../index.php?op=envios");
?>
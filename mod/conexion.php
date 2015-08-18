<?php 
	@session_start();

	$servidor = "localhost";
	$usuarioMySQL = "root";
	$contrasenaMySQL = "simpus2124";
	$baseDatos = "trazabilidad";


	$conexion = mysql_connect($servidor, $usuarioMySQL, $contrasenaMySQL);
	mysql_select_db($baseDatos, $conexion);
	
	mysql_query("charset utf8");
?>
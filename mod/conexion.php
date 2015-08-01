<?php 
	@session_start();
	$conexion = mysql_connect("localhost", "android15", "android15");
	mysql_select_db("trazabilidad", $conexion);
	mysql_query("charset utf8");
?>
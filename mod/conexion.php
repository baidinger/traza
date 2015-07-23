<?php 
	@session_start();
	$conexion = mysql_connect("localhost","root","simpus2124");
	mysql_select_db("trazabilidad", $conexion);
	mysql_query("charset utf8");
?>
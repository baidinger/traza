<?php 
		// Datos de conexion a la base de datos
	/*
	$username = "android15";
	$password = "android15";
	$hostname = "localhost";
	*/

	$username = "root";
	$password = "simpus2124";
	$hostname = "localhost";

	// Conexion a base de datos
	$dbhandle = mysql_connect($hostname, $username, $password);

	// Comprobacion de conexion a base de datos
	if(!$dbhandle){
		echo "no se ha podido conectar al servidor ".mysql_error();
	}

	// Seleccion de base de datos
	$seleccion = mysql_select_db("trazabilidad", $dbhandle);

	// Comprobacion de conexion a base de datos seleccionada
	if(!$seleccion){
		echo "no se ha seleccionado la base de datos";
	}
	
 ?>
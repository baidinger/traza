<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$idCamion = $_POST['camion'];

	include('../../mod/conexion.php');

	$consulta = "UPDATE camiones_distribuidor SET estado_camion_distribuidor = 1 WHERE id_camion_distribuidor = $idCamion";
	mysql_query($consulta, $conexion);

	mysql_close();
?>
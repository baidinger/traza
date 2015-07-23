<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$idEnvio = $_POST['envio'];

	include('../../mod/conexion.php');

	$consulta = "UPDATE envios_distribuidor SET estado_envio = 5 WHERE id_envio = $idEnvio";
	mysql_query($consulta, $conexion);

	$consulta = "SELECT id_orden_dist_fk FROM envios_distribuidor WHERE id_envio = $idEnvio";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);
	$idOrdenDist = $row['id_orden_dist_fk'];

	$consulta = "UPDATE ordenes_punto_venta SET estado_orden = 5 WHERE id_orden = $idOrdenDist";
	mysql_query($consulta, $conexion);

	mysql_close();
?>
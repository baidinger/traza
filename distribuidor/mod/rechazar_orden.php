<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$idOrden = $_POST['inputIdOrden'];
	$motivoRechazo = $_POST['inputMotivoRechazo'];

	include('../../mod/conexion.php');

	$consulta = "UPDATE ordenes_distribuidor SET estatus_orden = 2, descripcion_rechazo = '$motivoRechazo' WHERE id_orden = $idOrden";
	mysql_query($consulta, $conexion);

	mysql_close();

	header('Location: ../entradasOrdenes/');
?>
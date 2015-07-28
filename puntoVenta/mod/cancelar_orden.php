<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$idOrden = $_POST['inputIdOrden'];
	$motivoCancelacion = $_POST['inputMotivoCancelar'];

	include('../../mod/conexion.php');

	$consulta = "UPDATE ordenes_punto_venta SET estado_orden = 5, descripcion_cancelacion = '$motivoCancelacion' WHERE id_orden = $idOrden";
	mysql_query($consulta, $conexion);

	mysql_close();

	header('Location: ../historialOrdenes/');
?>
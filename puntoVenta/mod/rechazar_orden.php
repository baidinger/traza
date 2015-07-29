<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$edoOrden = $_POST['inputEstado'];
	$idOrden = $_POST['inputIdOrden'];
	$motivoRechazo = $_POST['inputMotivoRechazo'];

	include('../../mod/conexion.php');

	$consulta = "UPDATE ordenes_punto_venta SET estado_orden = 11, descripcion_rechazo = '$motivoRechazo' WHERE id_orden = $idOrden";
	mysql_query($consulta, $conexion);

	mysql_close();
?>
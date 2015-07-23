<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$idPedido = $_POST['pedido'];
	$precioPedido = $_POST['precio'];

	include('../../mod/conexion.php');

	$consulta = "UPDATE ordenes_punto_venta SET costo_orden = $precioPedido WHERE id_orden = $idPedido";
	mysql_query($consulta, $conexion);

	mysql_close();
?>
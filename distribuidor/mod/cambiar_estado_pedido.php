<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$idPedido = $_POST['pedido'];
	$edoPedido = $_POST['estado'];
	$edoOriginal = $_POST['original'];

	include('../../mod/conexion.php');

	$consulta = "UPDATE ordenes_punto_venta SET estado_orden = $edoPedido WHERE id_orden = $idPedido";
	mysql_query($consulta, $conexion);

	if($edoOriginal == 3){
		$consulta = "UPDATE envios_distribuidor SET estado_envio = $edoPedido WHERE id_orden_dist_fk = $idPedido";
		mysql_query($consulta, $conexion);
	}

	mysql_close();
?>
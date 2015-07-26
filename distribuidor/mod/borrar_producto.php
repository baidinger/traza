<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$idProducto = $_POST['producto'];

	include('../../mod/conexion.php');

	$consulta = "DELETE FROM productos_distribuidores WHERE id_productos_distribuidor = $idProducto";
	mysql_query($consulta, $conexion);

	mysql_close();
?>
<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$idProducto = $_POST['inputIdProducto'];
	$precioProducto = $_POST['inputPrecio'];

	include('../../mod/conexion.php');

	$consulta = "UPDATE productos_distribuidores SET precio_venta = $precioProducto WHERE id_productos_distribuidor = $idProducto";
	mysql_query($consulta, $conexion);

	mysql_close();

	header('Location: ../productos/');
?>
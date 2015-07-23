<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$idUsuarioFK = $_POST['usuario_fk'];

	include('../../mod/conexion.php');

	$consulta = "UPDATE usuarios SET estado_usuario = 1 WHERE id_usuario = $idUsuarioFK";
	mysql_query($consulta, $conexion);

	mysql_close();
?>
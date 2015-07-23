<?php 
	@session_start();

	if(isset($_SESSION['id_usuario'])){
		session_unset($_SESSION['id_usuario']);
		session_unset($_SESSION['nombre_usuario']);
		session_unset($_SESSION['tipo_socio']);
		session_destroy();

		header('Location: ../');
	}
?>
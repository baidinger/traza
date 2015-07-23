<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$contrasenaActual = md5(trim($_POST['inputActual']));
	$contrasenaNueva = md5(trim($_POST['inputNueva']));

	if(!empty($contrasenaActual) && !empty($contrasenaNueva)){
		include('../../mod/conexion.php');

		$consulta = "SELECT contrasena_usuario FROM usuarios WHERE id_usuario = ".$_SESSION['id_usuario'];
		$resultado = mysql_query($consulta, $conexion);
		$row = mysql_fetch_array($resultado);
		$contrasenaBDmd5 = $row['contrasena_usuario'];

		if($contrasenaBDmd5 == $contrasenaActual){
			$consulta = "UPDATE usuarios SET contrasena_usuario = '$contrasenaNueva' WHERE id_usuario = ".$_SESSION['id_usuario'];
			mysql_query($consulta, $conexion);
			
			$mysqlError = mysql_error($conexion);

			if(!empty($mysqlError)){
				header('Location: ../contrasena/?e');
			} else {
				header('Location: ../');
			}
		}
		else{
			header('Location: ../contrasena/?e');
		}
	}
	else
		header('Location: ../contrasena/?e');
?>
<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$contrasenaActual = md5(trim($_POST['inputActual']));
	$contrasenaNueva = md5(trim($_POST['inputNueva']));
	$url = $_POST['url'];

	if(!empty($contrasenaActual) && !empty($contrasenaNueva)){
		include('conexion.php');

		$consulta = "SELECT contrasena_usuario FROM usuarios WHERE id_usuario = ".$_SESSION['id_usuario'];
		$resultado = mysql_query($consulta, $conexion);
		$row = mysql_fetch_array($resultado);
		$contrasenaBDmd5 = $row['contrasena_usuario'];

		if($contrasenaBDmd5 == $contrasenaActual){
			$consulta = "UPDATE usuarios SET contrasena_usuario = '$contrasenaNueva' WHERE id_usuario = ".$_SESSION['id_usuario'];
			mysql_query($consulta, $conexion);
			
			$mysqlError = mysql_error($conexion);

			if(!empty($mysqlError)){
				header('Location: '.$url.'&e=0');
			} else {
				header('Location: '.$url);
			}
		}
		else{
			header('Location: '.$url.'&e=0');
		}
	}
	else
		header('Location: '.$url.'&e=0');
?>
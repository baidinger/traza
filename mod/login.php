<?php 
	@session_start();

	$usuario = $_POST['inputUsuario'];
	$contrasena = $_POST['inputContrasena'];
	$contrasena_md5 = md5($contrasena);

	include('conexion.php');

	$query = "SELECT * FROM usuarios WHERE nombre_usuario = '$usuario' AND contrasena_usuario = '$contrasena_md5' AND estado_usuario = 1";
	$resultado = mysql_query($query);
	if(mysql_num_rows($resultado) > 0){
		$row = mysql_fetch_array($resultado);
		$_SESSION['id_usuario'] = $row['id_usuario'];
		$_SESSION['nombre_usuario'] = $row['nombre_usuario'];
		$_SESSION['tipo_socio'] = $row['tipo_socio_usuario'];
		$_SESSION['nivel_socio'] = $row['nivel_autorizacion_usuario'];

		switch($_SESSION['tipo_socio']) {
			case 1: header('Location: ../productor/');
					break;
			case 2: header('Location: ../empaque/');
					break;
			case 3: header('Location: ../distribuidor/');
					break;
			case 4: header('Location: ../puntoVenta/');
					break;
		}
	}
	else
		header('Location: ../?e')
?>
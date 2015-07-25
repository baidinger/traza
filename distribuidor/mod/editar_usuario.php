<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$nombreUsuario = strtoupper(trim($_POST['inputNombre'], ' '));
	$apellidosUsuario = strtoupper(trim($_POST['inputApellidos'], ' '));
	$direccionUsuario  = trim($_POST['inputDireccion']);
	$telefonoUsuario  = strtoupper(trim($_POST['inputTelefono']));
	$contrasenaUsuario = $_POST['inputContrasena'];
	$contrasenaOriginalUsuario = $_POST['inputContrasenaOriginal'];
	$privilegioEntradas = $_POST['inputEntradas'];
	$privilegioPedidos = $_POST['inputPedidos'];
	$privilegioEnvios = $_POST['inputEnvios'];
	$idUsuarioDist = $_POST['inputUsuarioDist'];
	$idUsuarioFK = $_POST['inputUsuarioFK'];

	if(!empty($nombreUsuario) && !empty($apellidosUsuario) && !empty($direccionUsuario) && !empty($telefonoUsuario)){
		include('../../mod/conexion.php');

		date_default_timezone_set("America/Mexico_City");
		$fechaModificacion = date("Y-m-d");

		if(empty($privilegioEntradas)) 	$privilegioEntradas = 0;
		if(empty($privilegioPedidos)) 	$privilegioPedidos = 0;
		if(empty($privilegioEnvios)) 	$privilegioEnvios = 0;

		$consulta = "UPDATE usuario_distribuidor SET nombre_usuario_distribuidor = '$nombreUsuario', apellido_usuario_distribuidor = '$apellidosUsuario', direccion_usuario_distribuidor = '$direccionUsuario', telefono_usuario_distribuidor = '$telefonoUsuario', entradas = $privilegioEntradas, pedidos = $privilegioPedidos, envios = $privilegioEnvios WHERE id_usuario_distribuidor = $idUsuarioDist";
		mysql_query($consulta, $conexion);

		if($contrasenaUsuario == $contrasenaOriginalUsuario)
			$consulta = "UPDATE usuarios SET fecha_modificacion_usuario = '$fechaModificacion' WHERE id_usuario = $idUsuarioFK";
		else{
			$nuevaContrasena = md5($contrasenaUsuario);
			$consulta = "UPDATE usuarios SET contrasena_usuario = '$nuevaContrasena', fecha_modificacion_usuario = '$fechaModificacion' WHERE id_usuario = $idUsuarioFK";
		}
		mysql_query($consulta, $conexion);

		$mysqlError = mysql_error($conexion);
		mysql_close();

		if(!empty($mysqlError)){
			header('Location: ../usuarios/e');
		} else {
			header('Location: ../usuarios/');
		}
	}
	else{
		header('Location: ../usuarios/?e');
	}
?>
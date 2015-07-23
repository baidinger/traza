<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$nombreUsuario = strtoupper(trim($_POST['inputNombre'], ' '));
	$apellidosUsuario = strtoupper(trim($_POST['inputApellidos'], ' '));
	$direccionUsuario  = trim($_POST['inputDireccion']);
	$telefonoUsuario  = strtoupper(trim($_POST['inputTelefono']));
	$idUsuarioDist = $_POST['inputUsuarioPV'];
	$idUsuarioFK = $_POST['inputUsuarioFK'];

	if(!empty($nombreUsuario) && !empty($apellidosUsuario) && !empty($direccionUsuario) && !empty($telefonoUsuario)){
		include('../../mod/conexion.php');

		date_default_timezone_set("America/Mexico_City");
		$fechaModificacion = date("Y-m-d");

		$consulta = "UPDATE usuario_punto_venta SET nombre_usuario_pv = '$nombreUsuario', apellidos_usuario_pv = '$apellidosUsuario', direccion_usuario_pv = '$direccionUsuario', telefono_usuario_pv = '$telefonoUsuario' WHERE id_usuario_pv = $idUsuarioDist";
		mysql_query($consulta, $conexion);

		$consulta = "UPDATE usuarios SET fecha_modificacion_usuario = '$fechaModificacion' WHERE id_usuario = $idUsuarioFK";
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

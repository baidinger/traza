<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$nombreUsuario = strtoupper(trim($_POST['inputNombre'], ' '));
	$apellidosUsuario = strtoupper(trim($_POST['inputApellidos'], ' '));
	$usuario = trim($_POST['inputUsuario'], ' ');
	$contrasenaUsuario = md5(trim($_POST['inputContrasena'], ' '));
	$direccionUsuario  = trim($_POST['inputDireccion']);
	$telefonoUsuario  = strtoupper(trim($_POST['inputTelefono']));
	$puntoVentaUsuario = $_POST['inputPuntoVenta'];

	if(!empty($nombreUsuario) && !empty($apellidosUsuario) && !empty($usuario) && !empty($contrasenaUsuario) && !empty($direccionUsuario) && !empty($telefonoUsuario)){
		include('../../mod/conexion.php');

		date_default_timezone_set("America/Mexico_City");
		$fechaRegistro = date("Y-m-d");

		$consulta = "INSERT INTO usuarios(nombre_usuario, contrasena_usuario, tipo_socio_usuario, nivel_autorizacion_usuario, fecha_creacion_usuario, fecha_modificacion_usuario, estado_usuario) VALUES('$usuario', '$contrasenaUsuario', 4, 2, '$fechaRegistro', '$fechaRegistro', 1)";
		mysql_query($consulta, $conexion);

		$consulta = "SELECT id_usuario FROM usuarios ORDER BY id_usuario DESC LIMIT 1";
		$resultado = mysql_query($consulta);
		$row = mysql_fetch_array($resultado);
		$idUsuarioFK = $row['id_usuario'];

		$consulta = "INSERT INTO usuario_punto_venta(id_usuario_punto_venta, id_usuario_fk, nombre_usuario_pv, apellidos_usuario_pv, telefono_usuario_pv, direccion_usuario_pv) VALUES($puntoVentaUsuario, $idUsuarioFK, '$nombreUsuario', '$apellidosUsuario', '$telefonoUsuario', '$direccionUsuario')";
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

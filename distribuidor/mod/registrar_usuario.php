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
	$privEntradas = $_POST['inputEntradas'];
	$privPedidos = $_POST['inputPedidos'];
	$privEnvios = $_POST['inputEnvios'];
	$distribuidorUsuario = $_POST['inputDistribuidor'];

	if(!empty($nombreUsuario) && !empty($apellidosUsuario) && !empty($usuario) && !empty($contrasenaUsuario) && !empty($direccionUsuario) && !empty($telefonoUsuario)){
		include('../../mod/conexion.php');

		date_default_timezone_set("America/Mexico_City");
		$fechaRegistro = date("Y-m-d");

		$consulta = "INSERT INTO usuarios(nombre_usuario, contrasena_usuario, tipo_socio_usuario, nivel_autorizacion_usuario, fecha_creacion_usuario, fecha_modificacion_usuario, estado_usuario) VALUES('$usuario', '$contrasenaUsuario', 3, 2, '$fechaRegistro', '$fechaRegistro', 1)";
		mysql_query($consulta, $conexion);

		$consulta = "SELECT id_usuario FROM usuarios WHERE nombre_usuario = '$usuario' ORDER BY id_usuario DESC LIMIT 1";
		$resultado = mysql_query($consulta);
		$row = mysql_fetch_array($resultado);
		$idUsuarioFK = $row['id_usuario'];

		$consulta = "INSERT INTO usuario_distribuidor(nombre_usuario_distribuidor, apellido_usuario_distribuidor, direccion_usuario_distribuidor, telefono_usuario_distribuidor, entradas, pedidos, envios, id_usuario_fk, id_distribuidor_fk) VALUES('$nombreUsuario', '$apellidosUsuario', '$direccionUsuario', '$telefonoUsuario', $privEntradas, $privPedidos, $privEnvios, $idUsuarioFK, $distribuidorUsuario)";
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

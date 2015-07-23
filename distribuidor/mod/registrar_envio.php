<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	date_default_timezone_set("America/Mexico_City");
	$fechaRegistro = date("Y-m-d");
	$horaRegistro = date("H:m:s");

	$fechaEntregaEnvio = $_POST['inputFechaEntrega'];
	$descripcionEnvio = $_POST['inputDescripcion'];
	$idPuntoVenta = $_POST['inputIdPuntoVenta'];
	$idPedido = $_POST['inputIdPedido'];

	if(!empty($fechaEntregaEnvio) && !empty($descripcionEnvio) && !empty($idPuntoVenta) && !empty($idPedido)){
		include('../../mod/conexion.php');

		$consulta = "UPDATE ordenes_punto_venta SET estado_orden = 3 WHERE id_orden = $idPedido";
		mysql_query($consulta, $conexion);

		$consulta = "INSERT INTO envios_distribuidor(fecha_envio, hora_envio, fecha_entrega_envio, descripcion_envio, estado_envio, id_punto_venta_fk, id_orden_dist_fk) VALUES('$fechaRegistro', '$horaRegistro', '$fechaEntregaEnvio', '$descripcionEnvio', 3, $idPuntoVenta, $idPedido)";
		mysql_query($consulta, $conexion);

		$mysqlError = mysql_error($conexion);
		mysql_close();

		if(!empty($mysqlError)){
			header('Location: ../enviosPedidos/e');
		} else {
			header('Location: ../enviosPedidos/');
		}
	}
	else{
		header('Location: ../enviosPedidos/?e');
	}
?>
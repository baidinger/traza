<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	date_default_timezone_set("America/Mexico_City");

	$fechaRegistro = date("Y-m-d");
	$fechaEntrega = $_POST['inputFechaEntrega'];
	$descripcionOrden = trim($_POST['inputDescripcion']);
	$idEmpaque = $_POST['inputIdEmpaque'];

	$arregloCantidades = $_POST['cantidades'];
	$arregloUnidades = $_POST['unidades'];
	$arregloCostos = $_POST['totalProductos'];
	$arregloProductos = $_POST['idProductos'];
	$costoTotalOrden = 0;

	// for($i = 0; $i < count($arregloCostos); $i++)
	// 	$costoTotalOrden += $arregloCostos[$i];

	if(!empty($fechaEntrega) && !empty($idEmpaque) && count($arregloCantidades) != 0){
		include('../../mod/conexion.php');

		$consulta = "SELECT id_usuario_pv FROM usuario_punto_venta WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
		$resultado = mysql_query($consulta);
		$row = mysql_fetch_array($resultado);
		$idUsuarioDistribuidorFK = $row['id_usuario_pv'];

		$consulta = "INSERT INTO ordenes_punto_venta(fecha_orden, fecha_entrega_orden, costo_orden, descripcion_orden, id_usuario_punto_venta_fk, id_distribuidor_fk, estado_orden) VALUES('$fechaRegistro', '$fechaEntrega', $costoTotalOrden, '$descripcionOrden', $idUsuarioDistribuidorFK, $idEmpaque, 1)";
		mysql_query($consulta, $conexion);

		$consulta = "SELECT id_orden FROM ordenes_punto_venta ORDER BY id_orden DESC LIMIT 1";
		$resultado = mysql_query($consulta);
		$row = mysql_fetch_array($resultado);
		$idOrdenFK = $row['id_orden'];

		for($i = 0; $i < count($arregloCantidades); $i++) {
			$consulta = "INSERT INTO ordenes_punto_venta_detalles(id_orden_dist_fk, id_producto_fk, cant_producto_odd, unidad_producto_odd, costo_producto_odd) VALUES($idOrdenFK, $arregloProductos[$i], $arregloCantidades[$i], '$arregloUnidades[$i]', $arregloCostos[$i])";
			mysql_query($consulta, $conexion);
		}

		$mysqlError = mysql_error($conexion);
		mysql_close();

		if(!empty($mysqlError)){
			header('Location: ../nuevaOrden/?e');
		} else {
			header('Location: ../');
		}
	}
	else{
		header('Location: ../nuevaOrden/?e');
	}
?>
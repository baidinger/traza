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
	$arregloUnitarios = $_POST['preciosUnitarios'];
	$arregloCostos = $_POST['totalProductos'];
	$arregloProductos = $_POST['idProductos'];
	$costoTotalOrden = 0;

	for($i = 0; $i < count($arregloCostos); $i++)
		$costoTotalOrden += $arregloCostos[$i];

	if(!empty($fechaEntrega) && !empty($idEmpaque) && count($arregloCantidades) != 0){
		include('../../mod/conexion.php');

		$consulta = "SELECT id_usuario_distribuidor FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
		$resultado = mysql_query($consulta);
		$row = mysql_fetch_array($resultado);
		$idUsuarioDistribuidorFK = $row['id_usuario_distribuidor'];

		$consulta = "INSERT INTO ordenes_distribuidor(fecha_orden, fecha_entrega_orden, costo_orden, descripcion_orden, id_usuario_distribuidor_fk, id_empaque_fk, estado_orden) VALUES('$fechaRegistro', '$fechaEntrega', $costoTotalOrden, '$descripcionOrden', $idUsuarioDistribuidorFK, $idEmpaque, 1)";
		mysql_query($consulta, $conexion);

		$consulta = "SELECT id_orden FROM ordenes_distribuidor ORDER BY id_orden DESC LIMIT 1";
		$resultado = mysql_query($consulta);
		$row = mysql_fetch_array($resultado);
		$idOrdenFK = $row['id_orden'];

		for($i = 0; $i < count($arregloCantidades); $i++) {
			print $consulta = "INSERT INTO ordenes_distribuidor_detalles(cantidad_producto_od, unidad_producto_od, costo_unitario_od, costo_producto_od, id_orden_fk, id_producto_fk) VALUES($arregloCantidades[$i], '$arregloUnidades[$i]', $arregloUnitarios[$i], $arregloCostos[$i], $idOrdenFK, $arregloProductos[$i])";
			mysql_query($consulta, $conexion);
		}

		$mysqlError = mysql_error($conexion);
		mysql_close();
	
		if(!empty($mysqlError)){
			header('Location: ../nuevaOrden/e');
		} else {
			header('Location: ../historialOrdenes/');
		}
	}
	else{
		header('Location: ../nuevaOrden/?e');
	}
?>
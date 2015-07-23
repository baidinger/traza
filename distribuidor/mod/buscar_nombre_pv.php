<?php 
	$idPedido = $_POST['pedido'];

	include('../../mod/conexion.php');

	$consulta = "SELECT id_usuario_punto_venta_fk FROM ordenes_punto_venta WHERE id_orden = $idPedido";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);
	$idUsuarioPV = $row['id_usuario_punto_venta_fk'];

	$consulta = "SELECT mpsavta.nombre_punto_venta, mpsavta.id_punto_venta FROM ordenes_punto_venta AS ordsvta, usuario_punto_venta AS ususvta, empresa_punto_venta AS mpsavta WHERE ordsvta.id_orden = $idPedido AND ordsvta.id_usuario_punto_venta_fk = ususvta.id_usuario_pv AND ususvta.id_usuario_pv = $idUsuarioPV AND ususvta.id_usuario_punto_venta = mpsavta.id_punto_venta";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);
	$idPV = $row['id_punto_venta'];
	$nombrePV = $row['nombre_punto_venta'];

	echo $idPV."%#%".$nombrePV;
	
	mysql_close();
?>
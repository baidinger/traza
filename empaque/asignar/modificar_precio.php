<?php 
include('../../mod/conexion.php');

		$id 		=	$_POST['id'];
		$costo		=	$_POST['costo'];
		$tipo		=	$_POST['tipo'];

		if($tipo == 1)
			$consulta = "UPDATE productos_empaques SET precio_compra = $costo WHERE id_productos_empaque = $id";
		else
			$consulta = "UPDATE productos_empaques SET precio_venta = $costo WHERE id_productos_empaque = $id";

		mysql_query($consulta, $conexion);
		mysql_close();
 ?>
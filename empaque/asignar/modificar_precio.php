<?php 

include('../../mod/conexion.php');

		$id 		=	$_POST['id'];
		$costo		=	$_POST['costo'];

		$consulta = "UPDATE productos_empaques SET precio_producto = $costo WHERE id_productos_empaque = $id";
		mysql_query($consulta, $conexion);
		mysql_close();
 ?>
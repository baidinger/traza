<?php 
		include("../../mod/conexion.php");

		$id 			=	$_POST['id'];
		$estado			=	$_POST['estado'];
		$cancelacion	=	$_POST['motivo_cancelacion'];

		PRINT $consulta = "UPDATE ordenes_distribuidor SET estatus_orden = $estado, descripcion_cancelacion = '$cancelacion' where id_orden = $id";
		mysql_query($consulta, $conexion);

		mysql_close($conexion);
		header("Location: ../index.php?op=pedidos");
 ?>
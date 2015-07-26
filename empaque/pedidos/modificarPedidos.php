<?php 
		include("../../mod/conexion.php");

		$id 			=	$_POST['id'];
		$estado			=	$_POST['estado'];
		$motivo			=	$_POST['motivo'];

		if($estado == 5)
			$consulta = "UPDATE ordenes_distribuidor SET estado_orden = $estado, descripcion_cancelacion = '$motivo' where id_orden = $id";
		else if($estado == 2)
			$consulta = "UPDATE ordenes_distribuidor SET estado_orden = $estado, descripcion_rechazo = '$motivo' where id_orden = $id";
		else
			$consulta = "UPDATE ordenes_distribuidor SET estado_orden = $estado where id_orden = $id";
		mysql_query($consulta, $conexion);

		mysql_close($conexion);
		header("Location: ../index.php?op=pedidos");
 ?>
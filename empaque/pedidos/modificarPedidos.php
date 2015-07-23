<?php 
		include("../../mod/conexion.php");

		if($_POST['type'] == "changeCost"){

			$costo 		=	$_POST['costo'];
			$id 		=	$_POST['id'];

			$consulta = "UPDATE ordenes_distribuidor SET costo_orden = $costo WHERE id_orden = $id";
			mysql_query($consulta, $conexion);
		}
		else if($_POST['type'] == "changeState"){
				$id 		=	$_POST['id'];
				$estado		=	$_POST['estado'];
				$consulta = "UPDATE ordenes_distribuidor SET estatus_orden = $estado where id_orden = $id";
				mysql_query($consulta, $conexion);
		}
		mysql_close($conexion);
 ?>
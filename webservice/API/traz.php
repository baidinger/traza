<?php
	header("Content-Type: application/json");

	// Datos de conexion a la base de datos
	$username = "android15";
	$password = "android15";
	$hostname = "localhost";

	// Conexion a base de datos
	$dbhandle = mysql_connect($hostname, $username, $password);

	// Comprobacion de conexion a base de datos
	if(!$dbhandle){
		echo "no se ha podido conectar al servidor ".mysql_error();
	}

	// Seleccion de base de datos
	$seleccion = mysql_select_db("trazabilidad", $dbhandle);

	// Comprobacion de conexion a base de datos seleccionada
	if(!$seleccion){
		echo "no se ha seleccionado la base de datos";
	}

	if($_GET["peticion"] == "registrar"){
		$arregloEPCs = split(",", $_POST["epcs"]);
		$idOrden = $arregloEPCs[0];
		$tarima = $arregloEPCs[1];

		// 1.- Registrar salida de orden del empaque al distribuidor.
		if($_GET["detalle"] == "1"){
			for($i = 2; $i < count($arregloEPCs); $i++) {
	           $epc = str_replace('"', '', $arregloEPCs[$i]);

	           $consulta = "INSERT INTO distribuidor_cajas_envio VALUES(0, $idOrden, '$epc', '$tarima', 1, 0)";
	           mysql_query($consulta);
			}

			echo "Registro exitoso";
		}

		// 2.- Registrar entrada de orden al distribuidor.
		if($_GET["detalle"] == "2"){
			for($i = 2; $i < count($arregloEPCs); $i++) {
				$epc = str_replace('"', '', $arregloEPCs[$i]);
				
				$consulta = "SELECT * FROM distribuidor_cajas_envio WHERE epc_caja = '$epc' AND id_orden_fk = $idOrden";
				$resultado = mysql_query($consulta);

				if(mysql_num_rows($resultado) > 0)
					$consulta = "UPDATE distribuidor_cajas_envio SET recibido_dce = 1 WHERE epc_caja = '$epc' AND id_orden_fk = $idOrden";
				else
					$consulta = "INSERT INTO distribuidor_cajas_envio VALUES(0, $idOrden, '$epc', '$tarima', 0, 1)";

				mysql_query($consulta) or die("no se pudo actualizar la base de datos");
			}

			$consulta = "SELECT COUNT(epc_caja) AS total_epcs_enviados FROM distribuidor_cajas_envio WHERE id_orden_fk = $idOrden AND enviado_dce = 1";
			$resultado = mysql_query($consulta);
			$row = mysql_fetch_array($resultado);
			$epcsEnviados = $row['total_epcs_enviados'];

			$consulta = "SELECT COUNT(epc_caja) AS total_epcs_recibidos FROM distribuidor_cajas_envio WHERE id_orden_fk = $idOrden AND recibido_dce = 1";
			$resultado = mysql_query($consulta);
			$row = mysql_fetch_array($resultado);
			$epcsRecibidos = $row['total_epcs_recibidos'];

			if($epcsEnviados == $epcsRecibidos){
				$consulta = "UPDATE ordenes_distribuidor SET estatus_orden = 6 WHERE id_orden = $idOrden";
				mysql_query($consulta) or die("no se pudo actualizar la base de datos");

				$consulta = "UPDATE envios_empaque SET estado_envio = 6 WHERE id_orden_fk = $idOrden";
				mysql_query($consulta) or die("no se pudo actualizar la base de datos");
			}

			echo "Registro exitoso";
		}

		// 3.- Registrar salida de orden del distribuidor al punto de venta
		if($_GET["detalle"] == "3"){
			for($i = 2; $i < count($arregloEPCs); $i++) {
	           $epc = str_replace('"', '', $arregloEPCs[$i]);

	           $consulta = "INSERT INTO punto_venta_cajas_envio VALUES(0, $idOrden, '$epc', '$tarima', 1, 0)";
	           mysql_query($consulta);
			}

			echo "Registro exitoso";
		}

		// 4.- Registrar entrada de orden al punto de venta.
		if($_GET["detalle"] == "4"){
			for($i = 2; $i < count($arregloEPCs); $i++) {
				$epc = str_replace('"', '', $arregloEPCs[$i]);
				
				$consulta = "SELECT * FROM punto_venta_cajas_envio WHERE epc_caja = '$epc' AND id_orden_fk = $idOrden";
				$resultado = mysql_query($consulta);

				if(mysql_num_rows($resultado) > 0)
					$consulta = "UPDATE punto_venta_cajas_envio SET recibido_dce = 1 WHERE epc_caja = '$epc' AND id_orden_fk = $idOrden";
				else
					$consulta = "INSERT INTO punto_venta_cajas_envio VALUES(0, $idOrden, '$epc', '$tarima', 0, 1)";

				mysql_query($consulta) or die("no se pudo actualizar la base de datos");
			}

			$consulta = "SELECT COUNT(epc_caja) AS total_epcs_enviados FROM punto_venta_cajas_envio WHERE id_orden_fk = $idOrden AND enviado_dce = 1";
			$resultado = mysql_query($consulta);
			$row = mysql_fetch_array($resultado);
			$epcsEnviados = $row['total_epcs_enviados'];

			$consulta = "SELECT COUNT(epc_caja) AS total_epcs_recibidos FROM punto_venta_cajas_envio WHERE id_orden_fk = $idOrden AND recibido_dce = 1";
			$resultado = mysql_query($consulta);
			$row = mysql_fetch_array($resultado);
			$epcsRecibidos = $row['total_epcs_recibidos'];

			if($epcsEnviados == $epcsRecibidos){
				$consulta = "UPDATE ordenes_punto_venta SET estado_orden = 6 WHERE id_orden = $idOrden";
				mysql_query($consulta) or die("no se pudo actualizar la base de datos");

				$consulta = "UPDATE envios_distribuidor SET estado_envio = 6 WHERE id_orden_dist_fk = $idOrden";
				mysql_query($consulta) or die("no se pudo actualizar la base de datos");
			}

			echo "Registro exitoso";
		}
	}

	mysql_close();
?>
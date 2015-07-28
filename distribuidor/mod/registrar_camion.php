<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$nombreChofer = strtoupper(trim($_POST['inputChofer'], ' '));
	$marcaCamion = strtoupper(trim($_POST['inputMarca'], ' '));
	$modeloCamion = strtoupper(trim($_POST['inputModelo'], ' '));
	$placasCamion  = strtoupper(trim($_POST['inputPlacas'], ' '));
	$descripcionCamion = trim($_POST['inputDescripcion'], ' ');
	$distribuidorCamion = $_POST['inputDistribuidor'];

	if(!empty($nombreChofer) && !empty($marcaCamion) && !empty($modeloCamion) && !empty($placasCamion)){
		include('../../mod/conexion.php');

		$consulta = "INSERT INTO camiones_distribuidor(placas_camion_distribuidor, nombre_chofer_camion_distribuidor, descripcion_camion_distribuidor, marca_camion_distribuidor, modelo_camion_distribuidor, id_distribuidor_fk, disponibilidad_camion_distribuidor, estado_camion_distribuidor) VALUES('$placasCamion', '$nombreChofer', '$descripcionCamion', '$marcaCamion', '$modeloCamion', '$distribuidorCamion', 0, 1)";
		mysql_query($consulta, $conexion);

		$mysqlError = mysql_error($conexion);
		mysql_close();

		if(!empty($mysqlError)){
			header('Location: ../camiones/e');
		} else {
			header('Location: ../camiones/');
		}
	}
	else{
		header('Location: ../camiones/?e');
	}
?>

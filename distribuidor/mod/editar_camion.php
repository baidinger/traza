<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$nombreChofer = strtoupper(trim($_POST['inputChofer'], ' '));
	$marcaCamion = strtoupper(trim($_POST['inputMarca'], ' '));
	$modeloCamion = strtoupper(trim($_POST['inputModelo'], ' '));
	$placasCamion  = strtoupper(trim($_POST['inputPlacas'], ' '));
	$descripcionCamion = trim($_POST['inputDescripcion'], ' ');
	$idCamion = $_POST['inputIdCamion'];

	if(!empty($nombreChofer) && !empty($marcaCamion) && !empty($modeloCamion) && !empty($placasCamion)){
		include('../../mod/conexion.php');

		$consulta = "UPDATE camiones_distribuidor SET placas_camion_distribuidor = '$placasCamion', nombre_chofer_camion_distribuidor = '$nombreChofer', descripcion_camion_distribuidor = '$descripcionCamion', marca_camion_distribuidor = '$marcaCamion', modelo_camion_distribuidor = '$modeloCamion' WHERE id_camion_distribuidor = $idCamion";
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
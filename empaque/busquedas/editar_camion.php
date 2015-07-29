<?php session_start(); if($_SESSION['nivel_socio'] != 1) return; 

	include("../../mod/conexion.php");
	
	$chofer 					= 	strtoupper($_POST['chofer']);
	$placas						=	$_POST['placas'];
	$marca						=	$_POST['marca'];
	$modelo						=	$_POST['modelo'];
	$disponibilidad				=	$_POST['disponibilidad'];
	$des						=	$_POST['descripcion'];
	$id_camion					=	$_POST['id_camion'];

	$consulta = "UPDATE camiones_empaque SET nombre_chofer = '$chofer', 
					placas = '$placas', marca = '$marca', modelo = '$modelo', 
						disponibilidad_ce = $disponibilidad, 
						descripcion_camion = '$des' WHERE id_camion = $id_camion";

	if(mysql_query($consulta)){
		mysql_close($conexion);
		?>
		<script type="text/javascript">
			 window.location="../index.php?op=bus_camion";
		</script>
	<?php		
	}
	else{
		mysql_close($conexion);
	}
 ?>
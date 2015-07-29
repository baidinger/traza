<?php session_start(); if($_SESSION['nivel_socio'] != 1) return; 

	include("../../mod/conexion.php");
	
	$chofer 					= 	strtoupper($_POST['chofer']);
	$placas						=	strtoupper($_POST['placas']);
	$marca						=	$_POST['marca'];
	$modelo						=	$_POST['modelo'];
	$des						=	$_POST['descripcion'];

	$consulta = "INSERT INTO camiones_empaque (nombre_chofer, placas, marca, modelo, descripcion_camion, disponibilidad_ce, id_empaque_fk, estado_ce) 
	VALUES ('$chofer', '$placas', '$marca', '$modelo', '$des' ,0,$_SESSION[id_empaque],1)";

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
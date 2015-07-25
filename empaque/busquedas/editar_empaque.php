
<?php 
	include("../../mod/conexion.php");
	
	$nombre 			= 	strtoupper($_POST['nombre_empaque']);
	$rfc				=	strtoupper($_POST['rfc_empaque']);
	$pais				=	strtoupper($_POST['pais']);
	$estado				=	strtoupper($_POST['estado']);
	$ciudad			 	=	strtoupper($_POST['ciudad_empaque']);
	$direccion 			=	strtoupper($_POST['direccion_empaque']);
	$cp 	 			=	$_POST['cp_empaque'];
	$email 				=	$_POST['email_empaque'];
	$tel1 				=	$_POST['telefono1_empaque'];
	$tel2				=	$_POST['telefono2_empaque'];
	$id_empaque			=	$_POST['id_empaque'];

		if(mysql_query("update empresa_empaques set nombre_empaque = '$nombre',".
			" rfc_empaque = '$rfc', pais_empaque = '$pais',".
			" estado_empaque = '$estado',ciudad_empaque = '$ciudad',".
			" direccion_empaque = '$direccion', cp_empaque = '$cp',".
			" email_empaque = '$email', telefono1_empaque = '$tel1', ".
			" fecha_modificacion_emp = '".date("Y-m-d")."', telefono2_empaque = '$tel2' where id_empaque =  $id_empaque")){
			mysql_close($conexion);
			?>
			<script type="text/javascript">
				 window.location="../index.php?op=bus_empaque";
			</script>
		<?php		
		}
		else{
			mysql_close($conexion);
			//header ("Location:../index.php?op=bus_empaque_error_update");		
		}

 ?>
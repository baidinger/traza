
<?php 
	include("../../mod/conexion.php");
	
	$nombre 					= 	strtoupper($_POST['nombre_distribuidor']);
	$rfc						=	strtoupper($_POST['rfc_distribuidor']);
	$pais						=	strtoupper($_POST['pais']);
	$estado						=	strtoupper($_POST['estado']);
	$ciudad					 	=	strtoupper($_POST['ciudad_distribuidor']);
	$direccion 					=	strtoupper($_POST['direccion_distribuidor']);
	$cp 	 					=	$_POST['cp_distribuidor'];
	$email 						=	$_POST['email_distribuidor'];
	$tel1 						=	$_POST['telefono1_distribuidor'];
	$tel2						=	$_POST['telefono2_distribuidor'];
	$id_distribuidor			=	$_POST['id_distribuidor'];

		if(mysql_query("update empresa_distribuidores set nombre_distribuidor = '$nombre',".
			" rfc_distribuidor = '$rfc', pais_distribuidor = '$pais',".
			" estado_distribuidor = '$estado', ciudad_distribuidor = '$ciudad',".
			" direccion_distribuidor = '$direccion', cp_distribuidor = '$cp',".
			" email_distribuidor = '$email', tel1_distribuidor = '$tel1', ".
			" tel2_distribuidor = '$tel2' where id_distribuidor =  $id_distribuidor")){
			mysql_close($conexion);	
		?>
			<script type="text/javascript">
				 window.location="../index.php?op=bus_distribuidor";
			</script>
		<?php	
		}
		else{
			mysql_close($conexion);
		?>
			<script type="text/javascript">
				 window.location="../index.php?op=bus_distribuidor_error_update";
			</script>
		<?php			
		}


 ?>
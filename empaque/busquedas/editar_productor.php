<?php 
	include("../../mod/conexion.php");

	$nombre 			= 	strtoupper($_POST['nombre_productor']);
	$apellido			=	strtoupper($_POST['apellido_productor']);
	$telefono			=	$_POST['telefono_productor'];
	$direccion			=	strtoupper($_POST['direccion_productor']);
	$rfc				=	strtoupper($_POST['rfc_productor']);
	$id_productor		=	$_POST['id_productor'];

		if(mysql_query("update empresa_productores set nombre_productor = '$nombre',".
			" apellido_productor = '$apellido', telefono_productor = '$telefono',".
			" direccion_productor = '$direccion', fecha_modificacion_prod = '".date("Y-m-d")."', ".
			" rfc_productor = '$rfc' where id_productor =  $id_productor")){
			mysql_close($conexion);
			//header("Location:../index.php?op=bus_productor");	
		?>
			<script type="text/javascript">
				 window.location="../index.php?op=bus_productor";
			</script>
		<?php	
		}
		else{
			mysql_close($conexion);
			//header ("Location:../index.php?op=bus_productor_error_update");		
		}


 ?>
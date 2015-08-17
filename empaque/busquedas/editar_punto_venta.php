<?php if($_SESSION['nivel_socio'] != 1) return; 

	include("../../mod/conexion.php");
	
	$nombre 					= 	strtoupper($_POST['nombre_punto_venta']);
	$rfc						=	strtoupper($_POST['rfc_punto_venta']);
	$pais						=	strtoupper($_POST['pais']);
	$estado						=	strtoupper($_POST['estado']);
	$ciudad					 	=	strtoupper($_POST['ciudad_punto_venta']);
	$direccion 					=	strtoupper($_POST['direccion_punto_venta']);
	$id_punto_venta				=	$_POST['id_punto_venta'];
	$cp							=	$_POST['cp_pv'];
	$tel						=	$_POST['telefono_pv'];
	$email						=	$_POST['email_pv'];

		if(mysql_query("update empresa_punto_venta set nombre_punto_venta = '$nombre',".
			" rfc_punto_venta = '$rfc', pais_punto_venta = '$pais',cp_punto_venta = '$cp',".
			" estado_punto_venta = '$estado', telefono_punto_venta = '$tel',email_punto_venta = '$email' ,
			fecha_modificacion_pv='".date("Y-m-d")."' ,ciudad_punto_venta = '$ciudad',".
			" direccion_punto_venta = '$direccion' where id_punto_venta =  $id_punto_venta")){
			mysql_close($conexion);
			?>
			<script type="text/javascript">
				 window.location="../index.php?op=bus_pv";
			</script>
		<?php		
		}
		else{
			mysql_close($conexion);
			//header ("Location:../index.php?op=bus_pv_error_update");		
		}


 ?>
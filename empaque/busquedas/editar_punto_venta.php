
<?php 
	include("../../mod/conexion.php");
	
	$nombre 					= 	strtoupper($_POST['nombre_punto_venta']);
	$rfc						=	strtoupper($_POST['rfc_punto_venta']);
	$pais						=	strtoupper($_POST['pais']);
	$estado						=	strtoupper($_POST['estado']);
	$ciudad					 	=	strtoupper($_POST['ciudad_punto_venta']);
	$direccion 					=	strtoupper($_POST['direccion_punto_venta']);
	$id_punto_venta				=	$_POST['id_punto_venta'];

		if(mysql_query("update empresa_punto_venta set nombre_punto_venta = '$nombre',".
			" rfc_punto_venta = '$rfc', pais_punto_venta = '$pais',".
			" estado_punto_venta = '$estado', ciudad_punto_venta = '$ciudad',".
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
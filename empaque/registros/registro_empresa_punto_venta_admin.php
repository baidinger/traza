<?php 
	include('../../mod/conexion.php');
	$usuario 			=	strtoupper($_POST['usuario_punto_venta']);
	$pass 				=	$_POST['contrasena_punto_venta'];
	$nombre 			= 	strtoupper($_POST['nombre_punto_venta']);
	$rfc				=	strtoupper($_POST['rfc_punto_venta']);
	$pais				=	strtoupper($_POST['pais']);
	$estado				=	strtoupper($_POST['estado']);
	$cp					=	$_POST['cp_pv'];
	$tel				=	$_POST['telefono_pv'];
	$email				=	$_POST['email_pv'];
	$ciudad			 	=	strtoupper($_POST['ciudad_punto_venta']);
	$direccion 			=	strtoupper($_POST['direccion_punto_venta']);

	$regreso			=	$_POST['socio'];

	if(mysql_query(" INSERT INTO usuarios (nombre_usuario,".
		" contrasena_usuario, tipo_socio_usuario, nivel_autorizacion_usuario,".
		" fecha_creacion_usuario, fecha_modificacion_usuario, estado_usuario) VALUES ".
		" ('".$usuario."','".md5($pass)."',4,1,'".date('Y-m-d')."','".date('Y-m-d')."',1)")){
		//echo "bien";

			$result_usuarios = mysql_query("select id_usuario from usuarios where nombre_usuario = '".$usuario."'");
			if($result_usuarios){
				 while($row = mysql_fetch_array($result_usuarios)) {
				 	$id_usuario = $row['id_usuario'];
				 }
			}

			$cad = " INSERT INTO empresa_punto_venta (nombre_punto_venta, rfc_punto_venta,".
				" pais_punto_venta, estado_punto_venta, ciudad_punto_venta, telefono_punto_venta, cp_punto_venta, email_punto_venta, direccion_punto_venta, id_usuario_que_registro, fecha_registro_pv, fecha_modificacion_pv) ".
				" VALUES ('".$nombre."','".$rfc."','".$pais."','".$estado."','".$ciudad."','".$tel."','".$cp."','".$email."','".$direccion."',".$_SESSION['id_usuario'].",'".date("Y-m-d")."','".date("Y-m-d")."')";

			if(mysql_query($cad))
			{
				$result_punto_venta = mysql_query("select id_punto_venta from empresa_punto_venta where rfc_punto_venta = '".$rfc."'");
				if($result_punto_venta){
					while($row = mysql_fetch_array($result_punto_venta)) {
				 		$id_punto_venta = $row['id_punto_venta'];
				 	}
				}

				if(mysql_query(" INSERT INTO usuario_punto_venta (nombre_usuario_pv,".
					" apellidos_usuario_pv, direccion_usuario_pv,".
					" telefono_usuario_pv, id_usuario_fk, id_punto_venta) VALUES ".
					"('ADMIN','ADMIN','ADMIN','0000000000',".$id_usuario.",".$id_punto_venta.")")){	
					mysql_close($conexion);
					header ("Location: ../index.php?op=".$regreso."");
				}
				else{
					mysql_close($conexion);
					header ("Location: ../index.php?op=reg_error_user");	
				}
			}
			else{
				mysql_close($conexion);
				header ("Location: ../index.php?op=reg_error_empresa");
			}
		}else{
			mysql_close($conexion);
			header ("Location: ../index.php?op=reg_error_useradmin");
		}

	mysql_close($conexion);

 ?>
<?php 
	include('../../mod/conexion.php');
	$usuario 			=	strtoupper($_POST['usuario_empaque']);
	$pass 				=	$_POST['contrasena_empaque'];
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

	$regreso			=	$_POST['socio'];

	if(mysql_query(" INSERT INTO usuarios (nombre_usuario,".
		" contrasena_usuario, tipo_socio_usuario, nivel_autorizacion_usuario,".
		" fecha_creacion_usuario, fecha_modificacion_usuario, estado_usuario) VALUES ".
		" ('".$usuario."','".md5($pass)."',2,1,'".date('Y-m-d')."','".date('Y-m-d')."',1)")){
		//echo "bien";

			$result_usuarios = mysql_query("select id_usuario from usuarios where nombre_usuario = '".$usuario."'");
			if($result_usuarios){
				 while($row = mysql_fetch_array($result_usuarios)) {
				 	$id_usuario = $row['id_usuario'];
				 }
			}

			if(mysql_query("INSERT INTO empresa_empaques (nombre_empaque, rfc_empaque,".
				" pais_empaque, estado_empaque, ciudad_empaque, direccion_empaque,".
				" cp_empaque, email_empaque, telefono1_empaque, telefono2_empaque, id_usuario_que_registro, fecha_registro_emp, fecha_modificacion_emp) VALUES ".
				"('".$nombre."','".$rfc."','".$pais."','".$estado."','".$ciudad."','".$direccion."','".$cp."','".$email."','".$tel1."','".$tel2."',".$_SESSION['id_receptor'].",'".date("Y-m-d")."','".date("Y-m-d")."')"))
			{
				$result_empaques = mysql_query("select id_empaque from empresa_empaques where rfc_empaque = '".$rfc."'");
				if($result_usuarios){
					while($row = mysql_fetch_array($result_empaques)) {
				 		$id_empaque = $row['id_empaque'];
				 	}
				}

			if(mysql_query("INSERT INTO usuario_empaque (nombre_receptor, apellido_receptor, ".
				"direccion_receptor, telefono_receptor, id_usuario_fk, id_empaque_fk, pedidos, envios, lotes) VALUES ".
				"('ADMIN','ADMIN','ADMIN','0000000000',".$id_usuario.",".$id_empaque.",1,1,1)")){	
					mysql_close($conexion);
					header ("Location: ../index.php?op=".$regreso."");
			}
			else{
					mysql_close($conexion);
					header ("Location: ../index.php?op=reg_error");	
				}
			}
			else{
				mysql_close($conexion);
				header ("Location: ../index.php?op=reg_error");
			}
		}else{
			mysql_close($conexion);
			header ("Location: ../index.php?op=reg_error");
		}
	mysql_close($conexion);

 ?>

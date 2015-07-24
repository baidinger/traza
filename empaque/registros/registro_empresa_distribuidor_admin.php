<?php 
	include('../../mod/conexion.php');
	$usuario 			=	strtoupper($_POST['usuario_distribuidor']);
	$pass 				=	$_POST['contrasena_distribuidor'];
	$nombre 			= 	strtoupper($_POST['nombre_distribuidor']);
	$rfc				=	strtoupper($_POST['rfc_distribuidor']);
	$pais				=	strtoupper($_POST['pais']);
	$estado				=	strtoupper($_POST['estado']);
	$ciudad			 	=	strtoupper($_POST['ciudad_distribuidor']);
	$direccion 			=	strtoupper($_POST['direccion_distribuidor']);
	$cp 	 			=	$_POST['cp_distribuidor'];
	$email 				=	$_POST['email_distribuidor'];
	$tel1 				=	$_POST['telefono1_distribuidor'];
	$tel2				=	$_POST['telefono2_distribuidor'];

	$regreso			=	$_POST['socio'];

	htmlspecialchars($_POST['usuario_distribuidor']);
	
	if(mysql_query(" INSERT INTO usuarios (nombre_usuario,".
		" contrasena_usuario, tipo_socio_usuario, nivel_autorizacion_usuario,".
		" fecha_creacion_usuario, fecha_modificacion_usuario, estado_usuario) VALUES ".
		" ('".$usuario."','".md5($pass)."',3,1,'".date('Y-m-d')."','".date('Y-m-d')."',1)")){
		//echo "bien";

			$result_usuarios = mysql_query("select id_usuario from usuarios where nombre_usuario = '".$usuario."'");
			if($result_usuarios){
				 while($row = mysql_fetch_array($result_usuarios)) {
				 	$id_usuario = $row['id_usuario'];
				 }
			}

			if(mysql_query(" INSERT INTO empresa_distribuidores (nombre_distribuidor, rfc_distribuidor,".
				" pais_distribuidor, estado_distribuidor, ciudad_distribuidor, cp_distribuidor,".
				" email_distribuidor, tel1_distribuidor, tel2_distribuidor, direccion_distribuidor, id_usuario_que_registro, fecha_registro_dist, fecha_modificacion_dist) ".
				" VALUES ('".$nombre."','".$rfc."','".$pais."','".$estado."','".$ciudad."','".$cp.
					"','".$email."','".$tel1."','".$tel2."','".$direccion."',".$_SESSION['id_usuario'].",'".date("Y-m-d")."','".date("Y-m-d")."')"))
			{
				$result_distribuidores = mysql_query("select id_distribuidor from empresa_distribuidores where rfc_distribuidor = '".$rfc."'");
				if($result_distribuidores){
					while($row = mysql_fetch_array($result_distribuidores)) {
				 		$id_distribuidor = $row['id_distribuidor'];
				 	}
				}

				if(mysql_query(" INSERT INTO usuario_distribuidor (nombre_usuario_distribuidor,".
					" apellido_usuario_distribuidor, direccion_usuario_distribuidor,".
					" telefono_usuario_distribuidor, id_usuario_fk, id_distribuidor_fk, entradas, pedidos, envios) VALUES ".
					"('ADMIN','ADMIN','ADMIN','0000000000',".$id_usuario.",".$id_distribuidor.",1,1,1)"))	{			
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
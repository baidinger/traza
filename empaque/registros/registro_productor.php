<?php 
	include('../../mod/conexion.php');
	$usuario 			=	strtoupper($_POST['usuario_productor']);
	$pass 				=	$_POST['contrasena_usuario'];
	$nombre 			= 	strtoupper($_POST['nombre_productor']);
	$apellido			=	strtoupper($_POST['apellido_productor']);
	$telefono			=	$_POST['telefono_productor'];
	$direccion			=	strtoupper($_POST['direccion_productor']);
	$rfc				=	strtoupper($_POST['rfc_productor']);


	$regreso			=	$_POST['socio'];

	if(mysql_query(" INSERT INTO usuarios (nombre_usuario,".
		" contrasena_usuario, tipo_socio_usuario, nivel_autorizacion_usuario,".
		" fecha_creacion_usuario, fecha_modificacion_usuario, estado_usuario) VALUES ".
		" ('".$usuario."','".md5($pass)."',1,1,'".date('Y-m-d')."','".date('Y-m-d')."',1)")){
		//echo "bien";

			$result = mysql_query("select id_usuario from usuarios where nombre_usuario = '".$usuario."'");
			$id_usuario = "";
			if($result){
				 while($row = mysql_fetch_array($result)) {
				 	$id_usuario = $row['id_usuario'];
				 }
			}

			if(mysql_query("INSERT INTO empresa_productores (nombre_productor, apellido_productor,".
				" telefono_productor, direccion_productor,".
				" rfc_productor, id_usuario_fk, id_usuario_que_registro, fecha_registro_prod, fecha_modificacion_prod) VALUES ('".$nombre."','".$apellido."',".
				" '".$telefono."','".$direccion."','".$rfc."',".$id_usuario.",".$_SESSION['id_usuario'].",'".date("Y-m-d")."','".date("Y-m-d")."')")){
				mysql_close($conexion);
				header ("Location: ../index.php?op=".$regreso."");
			}
		}else{
			mysql_close($conexion);
			header ("Location: ../index.php?op=error_reg_productor");
		}

	mysql_close($conexion);

 ?>
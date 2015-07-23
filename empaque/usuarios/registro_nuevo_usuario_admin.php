<?php 
	include('../../mod/conexion.php');
	$usuario 			=	strtoupper($_POST['usuario']);
	$pass 				=	$_POST['contrasena_usuario'];
	$nombre 			= 	strtoupper($_POST['nombre_usuario_empaque']);
	$apellido			=	strtoupper($_POST['apellido_usuario_empaque']);
	$telefono			=	$_POST['telefono_usuario_empaque'];
	$direccion			=	strtoupper($_POST['direccion_usuario_empaque']);
	$envios				=	($_POST['envios'] == '1') ? '1' : '0';
	$pedidos			=	($_POST['pedidos'] == '1') ? '1' : '0';;
	$lotes				=	($_POST['lotes'] == '1') ? '1' : '0';

	$url			=	$_POST['url'];

	$cad = " INSERT INTO usuarios (nombre_usuario,".
		" contrasena_usuario, tipo_socio_usuario, nivel_autorizacion_usuario,".
		" fecha_creacion_usuario, fecha_modificacion_usuario, estado_usuario) VALUES ".
		" ('".$usuario."','".md5($pass)."',2,2,'".date('Y-m-d')."','".date('Y-m-d')."',1)";

	if(mysql_query($cad)){
		//echo "bien";

			$result = mysql_query("select id_usuario from usuarios where nombre_usuario = '".$usuario."'");
			if($result){
				 while($row = mysql_fetch_array($result)) {
				 	$id_usuario = $row['id_usuario'];
				 }
			}

			$result = mysql_query("select id_empaque_fk from usuario_empaque where id_usuario_fk = '".$_SESSION['id_usuario']."'");
			if($result){
				 while($row = mysql_fetch_array($result)) {
				 	$id_empaque = $row['id_empaque_fk'];
				 }
			}

			$consulta = "INSERT INTO usuario_empaque (nombre_receptor, apellido_receptor,".
				" telefono_receptor, direccion_receptor,".
				"id_usuario_fk, id_empaque_fk, pedidos, lotes, envios) VALUES ('".$nombre."','".$apellido."',".
				" '".$telefono."','".$direccion."',".$id_usuario.",".$id_empaque.",$pedidos,$lotes,$envios)";
			
			if(mysql_query($consulta)){
				
				header ("Location: ".$url);
			}
			mysql_close($conexion);
		}else{
			mysql_close($conexion);
			header ("Location: ../index.php?op=error_reg_productor");
		}

	

 ?>
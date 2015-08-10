<?php 
	include("../../mod/conexion.php");

	$nombre 			= 	strtoupper($_POST['nombre_receptor']);
	$apellido			=	strtoupper($_POST['apellido_receptor']);
	$telefono			=	$_POST['telefono_receptor'];
	$direccion			=	strtoupper($_POST['direccion_receptor']);
	$nombre_usuario 	=	strtoupper($_POST['nombre_usuario']);
	$contrasena_usuario	=	$_POST['contrasena_usuario'];
	$id_receptor		=	$_POST['id_receptor'];
	$id_usuario			=	$_POST['id_usuario'];
	$contra				=	$_POST['contra'];


	$envios				=	($_POST['envios'] == '1') ? '1' : '0';
	$pedidos			=	($_POST['pedidos'] == '1') ? '1' : '0';;
	$lotes				=	($_POST['lotes'] == '1') ? '1' : '0';

if( (strcmp($_SESSION['id_usuario'],$id_usuario)==0) && $_SESSION['nivel_socio'] == 1)
	{
		$envios = 1;
		$pedidos = 1;
		$lotes = 1;
	} 

		if(mysql_query("update usuario_empaque set nombre_receptor = '$nombre',".
			" apellido_receptor = '$apellido', telefono_receptor = '$telefono',".
			" direccion_receptor = '$direccion', envios = $envios, lotes = $lotes, 
			pedidos = $pedidos where id_receptor =  $id_receptor")){
			if(strcmp($contra, $contrasena_usuario) == 0)
			{
				mysql_query("update usuarios set nombre_usuario = '$nombre_usuario', fecha_modificacion_usuario = '".date("Y-m-d")."' WHERE id_usuario = $id_usuario");
			}
			else
			{
				mysql_query("update usuarios set nombre_usuario = '$nombre_usuario', contrasena_usuario = '".md5($contrasena_usuario)."', fecha_modificacion_usuario = '".date("Y-m-d")."' WHERE id_usuario = $id_usuario");	
			}

			mysql_close($conexion);
			header ("Location:../index.php?op=admon_users");	
		}
		else{
			mysql_close($conexion);
			header ("Location:../index.php?op=admon_users&error");		
		}



	mysql_close($conexion);

 ?>
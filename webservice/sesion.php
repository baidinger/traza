<?php
	header("Content-Type: application/json");

	include("conexion.php");

	$datos = split(",", $_POST['datos']);

	$user 	= $datos[0];
	$pass 	= $datos[1];

	if(strcmp($user,"") == 0 || strcmp($pass,"") == 0 )
	{
		$datos_usuario = "Error*Error: \n - El usuario y contraseña estan incorrectos.";
	}else{

		$contrasena_md5 = md5($pass);


		$query = "SELECT * FROM usuarios WHERE nombre_usuario = '$user' AND contrasena_usuario = '$contrasena_md5' AND estado_usuario = 1";
		$resultado = mysql_query($query);
		if(mysql_num_rows($resultado) > 0){
			$row = mysql_fetch_array($resultado);

			$datos_usuario = "Bien*".$row['id_usuario'].",".$row['nombre_usuario'].",".$row['tipo_socio_usuario'].",".$row['nivel_autorizacion_usuario'];

			/*
				--------------- 	POSICIONES DEL ARREGLO	-----------------------
					0.- id_usuario
					1.- nombre del usuario
					2.- tipo_socio
					3.- nivel de autorizacion
				-------EMPAQUE-------
					4.- id_receptor
					5.-nombre del receptor
					6.- apellido del receptor
					7.- id del empaque
					8.- Nombre del empaque
					9.- empaque
					kljhkjhjk
			*/
			switch($row['tipo_socio_usuario']) {
				case 1: //productor
				$datos_usuario = "Error*Error: \n - El usuario y contraseña estan incorrectos. \n -El usuario no tiene privilegios para usar la HandHeld.";
						break;
				case 2: //empaque
						$q = "SELECT id_receptor, nombre_receptor, apellido_receptor, id_empaque, nombre_empaque  FROM usuario_empaque AS ue, empresa_empaques AS ee WHERE ue.id_usuario_fk = ".$row['id_usuario']." AND ue.envios = 1 AND ue.id_empaque_fk = ee.id_empaque";
						$r = mysql_query($q);
						if(mysql_num_rows($r) > 0){
							$rows = mysql_fetch_array($r);
							$datos_usuario .= ",".$rows['id_receptor'].",".$rows['nombre_receptor'].",".$rows['apellido_receptor'].",".$rows['id_empaque'].",".$rows['nombre_empaque'].","."Empaque";
						}else
							$datos_usuario = "Error*Error: \n - El usuario y contraseña estan incorrectos.";
						break;
				case 3: //distribuidor
						$q = "SELECT id_usuario_distribuidor, nombre_usuario_distribuidor, apellido_usuario_distribuidor, id_distribuidor, nombre_distribuidor FROM usuario_distribuidor AS ud, empresa_distribuidores AS ed WHERE ud.id_usuario_fk = ".$row['id_usuario']." AND ud.id_distribuidor_fk = ed.id_distribuidor";
						$r = mysql_query($q);
						if(mysql_num_rows($r) > 0){
							$rows = mysql_fetch_array($r);
							$datos_usuario .= ",".$rows['id_usuario_distribuidor'].",".$rows['nombre_usuario_distribuidor'].",".$rows['apellido_usuario_distribuidor'].",".$rows['id_distribuidor'].",".$rows['nombre_distribuidor'].","."Distribuidor";
						}else
							$datos_usuario = "Error*Error: \n - El usuario y contraseña estan incorrectos.";
						break;
				case 4: //punto venta
						break;
			}

		}
		else
			$datos_usuario = "Error*Error: \n - El usuario y contraseña estan incorrectos.";
	}

	mysql_close($dbhandle);
	echo $datos_usuario;
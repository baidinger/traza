<?php 
	@session_start();

	if(!isset($_SESSION['id_usuario']))
		header('Location: ../');

	$producto = $_POST['producto'];

	include('../../mod/conexion.php');

	$consulta = "SELECT id_distribuidor_fk FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);
	$id_distribuidor_fk = $row['id_distribuidor_fk'];

	$existe = 0;
	$consulta = "SELECT id_productos_distribuidor FROM productos_distribuidores WHERE id_distribuidor_fk = $id_distribuidor_fk AND id_producto_fk = $producto";
	$resultado = mysql_query($consulta);
	while($row = mysql_fetch_array($resultado)){
		$existe = 1;
	}

	if($existe == 0){
		$consulta = "INSERT INTO productos_distribuidores(id_distribuidor_fk, id_producto_fk) VALUES($id_distribuidor_fk, $producto)";
		mysql_query($consulta, $conexion);
	}
	else{
		echo "EXISTE";
	}

	mysql_close();
?>

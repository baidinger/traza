<?php 
		include('../../mod/conexion.php');

		$idProducto	=	$_POST['id'];

		mysql_query("delete from productos_empaques where id_productos_empaque = ".$idProducto);
		mysql_close();

 ?>
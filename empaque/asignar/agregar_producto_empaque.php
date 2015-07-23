<?php 
		include('../../mod/conexion.php');

		$idProducto	=	$_POST['idProducto'];
		$idEmpaque	=	$_POST['idEmpaque'];

		$result = mysql_query("select id_producto_fk from productos_empaques join usuario_empaque on productos_empaques.id_empaque_fk = usuario_empaque.id_empaque_fk join productos on productos.id_producto = productos_empaques.id_producto_fk where usuario_empaque.id_usuario_fk =".$_SESSION['id_usuario']);
		$bandera=0;
		if(mysql_num_rows($result) > 0){
			while($row = mysql_fetch_array($result)){
				if($row['id_producto_fk'] == $idProducto){
					$bandera = 1;
				}	
			}
		}

		if($bandera == 0){
			mysql_query("INSERT INTO productos_empaques(id_empaque_fk, id_producto_fk, precio_producto) VALUES ($idEmpaque, $idProducto,0)");
		}else
			echo "e";
		mysql_close();

 ?>
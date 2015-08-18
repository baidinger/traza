<?php @session_start();

				$id = $_POST['id'];

				include('../../mod/conexion.php');

			    $consulta = "SELECT precio_compra FROM productos_empaques WHERE id_producto_fk = $id and id_empaque_fk = $_SESSION[id_empaque]";
				$resultado = mysql_query($consulta);

				if(mysql_num_rows($resultado ) > 0){
					if($row = mysql_fetch_array($resultado))
					{
						print $row['precio_compra'];
					}
				}

?>
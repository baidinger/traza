<?php session_start(); if($_SESSION['nivel_socio'] != 1) return; 

include('../../mod/conexion.php');

		$idProductosProductor 		=	$_POST['idProProductor'];
		$idProductor				=	$_POST['idPro'];
		$huerta 					=	strtoupper($_POST['huerta']);
		$hectareas					=	$_POST['hectareas'];

		$consulta = "UPDATE productos_productores SET ubicacion_huerta = '$huerta', hectareas = '$hectareas' WHERE id_productos_productores = $idProductosProductor";

		mysql_query($consulta, $conexion);
		PRINT $consulta = "select id_productos_productores, nombre_producto, variedad_producto, ubicacion_huerta, hectareas from productos join productos_productores on productos_productores.id_producto_fk = productos.id_producto where productos_productores.id_productor_fk =".$idProductor;

		//echo $consulta;
		$resultado = mysql_query($consulta);
			$i=1;
			if(mysql_num_rows($resultado) > 0){ 
  					while($row = mysql_fetch_array($resultado)){
				?>
						<tr>
							<td> <?php echo $i; ?> </td>
							<td> <?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?> </td>
							<td> <?php echo $row['ubicacion_huerta'] ?></td>
							<td> <?php echo $row['hectareas'] ?></td>
							<td style="float:right;"> 
								<span style="cursor:hand; margin-right:10px" class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Modificar" class="btn btn-link" onclick="modificar(<?php echo $row['id_productos_productores']; ?>, '<?php echo $row['ubicacion_huerta']; ?>','<?php echo $row['hectareas']; ?>', <?php echo $idProductor ?>)"></span>
								<span onclick="eliminarProducto(<?php echo $row['id_productos_productores']; ?>, <?php echo $idProductor; ?>)" data-toggle="tooltip" data-placement="top" title="Eliminar" style="cursor:pointer; color:#931111;" class="eliminar glyphicon glyphicon-remove" aria-hidden="true"></span></td>
						</tr>
				<?php


  						$i++;
  					}

  						?>
  					<script type="text/javascript">
  						$('.eliminar').tooltip();
  					</script>
  				
  					<?php
  				}else{

  					echo "e";


  				}

		
		mysql_close($conexion);
 ?>
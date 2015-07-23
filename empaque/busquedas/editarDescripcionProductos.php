<?php 

include('../../mod/conexion.php');

		$idProductosProductor 		=	$_POST['idProProductor'];
		$id_productor				=	$_POST['idPro'];
		$descripcion				=	$_POST['descripcion'];

		$consulta = "UPDATE productos_productores SET descripcion_detalles_pp = '$descripcion' WHERE id_productos_productores = $idProductosProductor";

		mysql_query($consulta, $conexion);
		$consulta = "select id_productos_productores, nombre_producto, variedad_producto, descripcion_detalles_pp from productos join productos_productores on productos_productores.id_producto_fk = productos.id_producto where productos_productores.id_productor_fk =".$id_productor;

		//echo $consulta;
		$resultado = mysql_query($consulta);
			$i=1;
			if(mysql_num_rows($resultado) > 0){ 
  					while($row = mysql_fetch_array($resultado)){
				?>
						<tr>
							<td> <?php echo $i; ?> </td>
							<td> <?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?> </td>
							<td> 
								<?php 
									$descrip = $row['descripcion_detalles_pp']; 
									if(strlen($descrip) > 20){
										$descrip = substr($descrip,0,20);
										$descrip .= "...";
									}
									echo $descrip; 
								?> 
							</td>
							<td> <button class="btn btn-link" onclick="modificarDescripcion(<?php echo $row['id_productos_productores']; ?>, '<?php echo $row['descripcion_detalles_pp']; ?>', <?php echo $id_productor; ?>)"> Cambiar Descripción</button> </td>
							<td style="float:right;"> <span onclick="eliminarProducto(<?php echo $row['id_productos_productores']; ?>, <?php echo $id_productor; ?> )" data-toggle="tooltip" data-placement="top" title="Eliminar" style="cursor:pointer; color:#931111;" class="eliminar glyphicon glyphicon-remove" aria-hidden="true"></span></td>

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
<?php 
		include('../../mod/conexion.php');

		$idProductoPro	=	$_POST['idProProductor'];
		$idPro 			=	$_POST['idPro'];

		mysql_query("delete from productos_productores where id_productos_productores = ".$idProductoPro);


		$consulta = "select id_productos_productores, nombre_producto, variedad_producto, descripcion_detalles_pp from productos join productos_productores on productos_productores.id_producto_fk = productos.id_producto where productos_productores.id_productor_fk =".$idPro;

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
							<td> <button class="btn btn-link" onclick="modificarDescripcion(<?php echo $row['id_productos_productores']; ?>, '<?php echo $row['descripcion_detalles_pp']; ?>', <?php echo $idPro; ?>)"> Cambiar Descripción</button> </td>
							<td style="float:right;"> <span onclick="eliminarProducto(<?php echo $row['id_productos_productores']; ?>, <?php echo $idPro; ?> )" data-toggle="tooltip" data-placement="top" title="Eliminar" style="cursor:pointer; color:#931111;" class="eliminar glyphicon glyphicon-remove" aria-hidden="true"></span></td>

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
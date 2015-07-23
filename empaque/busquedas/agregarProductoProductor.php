<?php 
		include('../../mod/conexion.php');

		$idProducto	=	$_POST['idProducto'];
		$idProductor	=	$_POST['idProductor'];
		
		$consulta = "select id_producto_fk from productos join productos_productores on productos_productores.id_producto_fk = productos.id_producto where productos_productores.id_productor_fk =".$idProductor;
		$result = mysql_query($consulta);
		$bandera=0;
		if(mysql_num_rows($result) > 0){
			while($row = mysql_fetch_array($result)){
				if($row['id_producto_fk'] == $idProducto){
					$bandera = 1;
				}	
			}
		}

		if($bandera == 0){
			mysql_query("INSERT INTO productos_productores(id_productor_fk, id_producto_fk, descripcion_detalles_pp) VALUES ($idProductor, $idProducto,'descripcion')");

			$consulta = "select id_productos_productores, nombre_producto, variedad_producto, descripcion_detalles_pp from productos join productos_productores on productos_productores.id_producto_fk = productos.id_producto where productos_productores.id_productor_fk =".$idProductor;

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
							<td> <button class="btn btn-link" onclick="modificarDescripcion(<?php echo $row['id_productos_productores']; ?>, '<?php echo $row['descripcion_detalles_pp']; ?>', <?php echo $idProductor; ?>)"> Cambiar Descripción</button> </td>
							<td style="float:right;"> <span onclick="eliminarProducto(<?php echo $row['id_productos_productores']; ?>, <?php echo $idProductor; ?>)" data-toggle="tooltip" data-placement="top" title="Eliminar" style="cursor:pointer; color:#931111;" class="eliminar glyphicon glyphicon-remove" aria-hidden="true"></span></td>

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

  					?><tr><br>
			    	 	<div style="width:500px; margin:0px auto;" class="alert alert-danger centro" role="alert"> 
			    	 		<strong>No se encontraron Productos en el productor.</strong>
			    	 	</div>
			    	 	</tr>
			    	<?php


  				}

		}else
			echo "e";
		mysql_close();

 ?>
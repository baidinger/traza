<?php 
		include('../../mod/conexion.php');

		$idProducto	=	$_POST['idProducto'];
		$idProductor	=	$_POST['idProductor'];
/*		
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

		if($bandera == 0){*/
			mysql_query("INSERT INTO productos_productores(id_productor_fk, id_producto_fk, ubicacion_huerta, hectareas, descripcion_detalles_pp) VALUES ($idProductor, $idProducto,'ubicacion','1','descripcion')");

			$consulta = "select id_productos_productores, nombre_producto, variedad_producto, ubicacion_huerta, hectareas, descripcion_detalles_pp from productos join productos_productores on productos_productores.id_producto_fk = productos.id_producto where productos_productores.id_productor_fk =".$idProductor;

		echo "<tr></tr>";
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
								<span style="cursor:hand; margin-right:10px" class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Modificar" class="btn btn-link" onclick="modificar(<?php echo $row['id_productos_productores']; ?>, '<?php echo $row['ubicacion_huerta']; ?>','<?php echo $row['hectareas']; ?>', <?php echo $idProductor; ?>)"></span>
								<span onclick="eliminarProducto(<?php echo $row['id_productos_productores']; ?>, <?php echo $idProductor; ?>)" data-toggle="tooltip" data-placement="top" title="Eliminar" style="cursor:pointer; color:#931111;" class="eliminar glyphicon glyphicon-remove" aria-hidden="true"></span></td>
						</tr>
				<?php


  						$i++;
  					}

  				}else{

  					?><tr><br>
			    	 	<div style="width:500px; margin:0px auto;" class="alert alert-danger centro" role="alert"> 
			    	 		<strong>No se encontraron Productos en el productor.</strong>
			    	 	</div>
			    	 	</tr>
			    	<?php


  				}
 ?>
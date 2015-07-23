<?php 
	$id_orden 	=	$_POST['id_orden'];
  $des        = $_POST['descripcion'];
	include("../../mod/conexion.php");

	/*echo "select id_orden_detalles, cantidad_producto_od, ".
		"unidad_producto_od, costo_producto_od, nombre_producto, variedad_producto ".
		"from ordenes_distribuidor_detalles ".
		"join productos ON productos.id_producto = ordenes_distribuidor_detalles.id_orden_fk".
		"where id_orden_fk = $id_orden";
*/
	$result	=	mysql_query("select id_orden_detalles, cantidad_producto_od, ".
		"unidad_producto_od, costo_producto_od, nombre_producto, variedad_producto ".
		"from ordenes_distribuidor_detalles ".
		"join productos ON productos.id_producto = ordenes_distribuidor_detalles.id_producto_fk ".
		"where id_orden_fk = $id_orden");
 ?>
 <strong>Descripción de orden: </strong>
 <hr style="margin:-1px;">
<div style="width:100%; margin:5px auto;">
  <?php echo $des; ?>
</div>
<hr>
<br>
<table class="table table-hover">
	<thead>
		<tr>
          <th class="centro">#</th>
          <th class="centro">Producto</th>
          <th class="centro">Cantidad</th>
          <th class="izquierda">Unidad</th>
         <!-- <th class="centro">Costo</th>-->
          <th></th>
		</tr>
    </thead>
    <tbody>
    	<?php 
    	$i=1;
    		while($row = mysql_fetch_array($result)){ 
    	 ?>
    		<tr>
    			<td class="centro"><?php echo $i; ?> </td>
    			<td class="centro"><?php echo $row['nombre_producto']." ".$row['variedad_producto']; ?></td>
    			<td class="centro"><?php echo $row['cantidad_producto_od']; ?></td>
          <td class="izquierda"><?php echo $row['unidad_producto_od']; ?></td>
    			<!--<td class="centro"><?php echo $row['costo_producto_od']; ?> </td>-->

    		</tr>
    	<?php 
    			$i++;
    		} 
    		mysql_close($conexion);
    	?>

    </tbody>
</table>
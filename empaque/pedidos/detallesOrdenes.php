<?php 
	$id_orden 	=	$_POST['id_orden'];
  $des        = $_POST['descripcion'];
  $total        = $_POST['total'];
  $fecha        = $_POST['fecha'];
  $id_usuario_distribuidor        = $_POST['usuario'];
	include("../../mod/conexion.php");

  

	$result	=	mysql_query("select id_orden_detalles, cantidad_producto_od, ".
		"unidad_producto_od,costo_unitario_od, costo_producto_od, nombre_producto, variedad_producto ".
		"from ordenes_distribuidor_detalles ".
		"join productos ON productos.id_producto = ordenes_distribuidor_detalles.id_producto_fk ".
		"where id_orden_fk = $id_orden");
 ?>
 <div style="font-size: 14px; width: 60%; float:left">
    <div class="alert alert-info"><h4>Descripción de orden: </h4></div>
    

    <div style="width:100%; margin-botom:20px">
      <p><?php echo $des; ?></p>
    </div>
    <hr>
</div>
<div style="font-size: 14px; width: 30%; float:right">
  <div class="alert alert-info" style="width:100%; ">
      <h4>Otros datos</h4> 
  </div>
  <div style="width:100%; margin-botom:20px">
    <p><strong>Fecha de entrega deseada: </strong><?php echo $fecha; ?></p>
    <p><strong>Usuario que solicitó: </strong><?php echo $id_usuario_distribuidor; ?></p>
  </div>
  <hr>
 </div>
 <div style="clear:both"></div>
 
<br>
<table class="table table-hover" style="font-size: 14px">
	<thead>
		<tr>
          <th class="centro">#</th>
          <th class="centro">Producto</th>
          <th class="centro">Cantidad</th>
          <th class="centro">$ unitario</th>
          <th class="centro">Total</th>
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
    			<td class="centro"><?php echo $row['cantidad_producto_od'] . " " . $row['unidad_producto_od']; ?></td>
    			<td class="centro"><?php echo "$".$row['costo_unitario_od']; ?> </td>
          <td class="centro"><?php echo "$".$row['costo_producto_od']; ?> </td>

    		</tr>
    	<?php 
    			$i++;
    		} 
    		mysql_close($conexion);

    	?>
      <td></td>
      <td></td>
      <td></td>
      <td class="centro"><strong>Total</strong></td>
      <td class="centro">$<?php print $total ?></td>
    </tbody>
</table>
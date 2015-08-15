<?php 
	$id_orden 	=	$_POST['id_orden'];
	include("../../mod/conexion.php");

  

	$result	=	mysql_query("select id_orden_detalles, cantidad_producto_od, ".
		"unidad_producto_od,costo_unitario_od, costo_producto_od, nombre_producto, variedad_producto ".
		"from ordenes_distribuidor_detalles ".
		"join productos ON productos.id_producto = ordenes_distribuidor_detalles.id_producto_fk ".
		"where id_orden_fk = $id_orden");


  $consulta = "SELECT * from ordenes_distribuidor, empresa_distribuidores, usuario_distribuidor WHERE id_orden = $id_orden AND id_distribuidor = id_distribuidor_fk AND id_usuario_distribuidor = id_usuario_distribuidor_fk";
 $resultado = mysql_query($consulta);
 $row = mysql_fetch_array($resultado);
 ?>

 <table class="table" style="font-size: 14px">
  <tr>
    <td><strong>Núm. orden</strong></td>
    <td width="30%"><?php print str_pad($row['id_orden'], 10,"0",STR_PAD_LEFT); ?></td>

    <td><strong>Fecha entrega deseada</strong></td>
    <td width="30%"><?php print $row['fecha_entrega_orden'] ?></td>
  </tr>
  <tr>
    <td><strong>Fecha orden</strong></td>
    <td><?php print $row['fecha_orden'] ?></td>

    <td><strong>Descripción</strong></td>
    <td><?php print $row['descripcion_orden'] ?></td>
  </tr>
  <tr>
    <td><strong>Distribuidor</strong></td>
    <td>
      <a href="index.php?distribuidor=<?php print $row['id_distribuidor'] ?>">
      <?php print $row['nombre_distribuidor'] ?></td>
    </a>

    <td><strong>Usuario que solicitó</strong></td>
    <td><?php print "(".str_pad($row['id_usuario_distribuidor'], 10,"0",STR_PAD_LEFT).") ".$row['nombre_usuario_distribuidor']." ".$row['apellido_usuario_distribuidor'];  ?></td>
  </tr>
 </table>


  <hr>

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
    		while($row2 = mysql_fetch_array($result)){ 
    	 ?>
    		<tr>
    			<td class="centro"><?php echo $i; ?> </td>
    			<td class="centro"><?php echo $row2['nombre_producto']." ".$row2['variedad_producto']; ?></td>
    			<td class="centro"><?php echo $row2['cantidad_producto_od'] . " " . $row2['unidad_producto_od']; ?></td>
    			<td class="centro"><?php echo "$".$row2['costo_unitario_od']; ?> </td>
          <td class="centro"><?php echo "$".$row2['costo_producto_od']; ?> </td>

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
      <td class="centro">$<?php print $row['costo_orden'] ?></td>
    </tbody>
</table>
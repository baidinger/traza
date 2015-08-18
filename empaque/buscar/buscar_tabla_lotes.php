<?php @session_start();
$id = $_POST['id'];
if($id < 1) return;
include('../../mod/conexion.php');
$consulta = "SELECT * from LOTES, productos_productores WHERE id_productos_productores = id_productos_productores_fk and id_lote = $id";
$result = mysql_query($consulta);
if(mysql_num_rows($result) > 0 ){
	 if($row = mysql_fetch_array($result));
	}
 ?>

<table class="table" style="font-size: 14px">
	<tr>
		<td width="25%"><strong>Lote</strong></td>
		<td width="25%"><a href="index.php?lote=<?php print $id ?>"> <?php print str_pad($id,3,"0",STR_PAD_LEFT) ?> </a></td>
	
		<td width="25%"><strong>ID Fruta</strong></td>
		<td width="25%"><?php print str_pad($row['id_producto_fk'],5,"0",STR_PAD_LEFT) ?></td>
	</tr>
	<tr>
		<td width="25%"><strong>Cajas recibidas</strong></td>
		<td width="25%"><?PHP  print $row['cant_cajas_lote']?></td>
		<td width="25%"><strong>Kilos recibidos</strong></td>
		<td width="25%"><?PHP  print $row['cant_kilos_lote']?></td>
	</tr>
	<tr>
		<td width="25%"><strong>Fecha de recolección</strong></td>
		<td width="25%"><?PHP  print $row['fecha_recoleccion']?></td>
		<td width="25%"><strong>Fecha de caducidad</strong></td>
		<td width="25%"><?PHP  print $row['fecha_caducidad']?></td>
	</tr>
</table>
<?php 
	
	$epc="";
	if(isset($_REQUEST['epc']))
		$epc = $_REQUEST['epc'];


?>

<div class="alert alert-info">Aqui se mostrará la trazabilidad del sistema       
	<form action="javascript:buscar()">
		EPC <input id="epc" class="input" name="epc" min="24" max="24">
		<input type="submit" class="btn btn-primary" value="Buscar">
	</form>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<?php if(isset($_REQUEST['epc'])) { 
		print "select * from empresa_productores, empresa_empaques, productos_productores, productos, lotes, epc_caja where empresa_productores.id_productor = productos_productores.id_productor_fk AND productos.id_producto = productos_productores.id_producto_fk AND productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND lotes.id_lote = epc_caja.id_lote_fk AND lotes.id_empaque_fk = empresa_empaques.id_empaque AND epc_caja.epc_caja = '$epc'";
		?>
	<p>La trazabilidad del EPC <?php print $epc ?> es la que sigue</p>
	<?php  } ?>
</div>

<script type="text/javascript">
function buscar(){
		$(location).attr('href',"index.php?op=trazabilidad&epc="+$('#epc').val());

}
</script>
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
	<?php if(isset($_REQUEST['epc'])) { ?>
	<p>La trazabilidad del EPC <?php print $epc ?> es la que sigue</p>
	<?php  } ?>
</div>

<script type="text/javascript">
function buscar(){
		$(location).attr('href',"index.php?op=trazabilidad&epc="+$('#epc').val());

}
</script>
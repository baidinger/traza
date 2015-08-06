<?php
	if(!isset($_POST['lote'])) return;
	$id_lote = $_POST['lote'];

  include("../../mod/conexion.php");
  $consulta = "SELECT * FROM epc_caja WHERE id_lote_fk = $id_lote ORDER BY epc_caja ASC";
  $result = mysql_query($consulta);
  

 ?>
<div class="contenedor-form">		
	<div class="modal-header">
		<h3 class="modal-title">
			<img class="img-header" src="img/RFID.png"> EPC's generados
		</h3>
	</div>

	<div style="width:50%; margin: 30px auto">
      	<div class="modal-body" style="width:100%; float: left">
          <?php if(mysql_num_rows($result) == 0){ ?>
          <div class="alert alert-danger" style="text-align: center">No se encontraron etiquetas para este lote</div>
          <?php } else { ?>
      		<div class="alert alert-info">Electronic Product Code</div>
  			<div class="alert alert-primary">
  				<!--<p>Los epc's generados para el lote <?php print $id_lote ?></p>-->
  				<?php 

  					while ($row = mysql_fetch_array($result)) {
  						print $row['epc_caja']."<br>";
  					}
  				?>
  			</div>
        <?php } ?>
		  	<hr>
		  	<center>
	     		<a href="index.php?op=imprimir" class="btn btn-default">Regresar</a>
	     	</center>
	     </div>
    </div>	
    <div style="clear:both"></div>
    <p>&nbsp;</p>
</div>


		<?php mysql_close(); ?>
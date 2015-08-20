<div class="contenedor-form">		
	<div class="modal-header">
		<h3 class="modal-title">
			<img class="img-header" src="img/RFID.png"> EPC's generados
		</h3>
	</div>

  <?php 
    if(strcmp($numero_etiquetas, "") == 0){ ?>
      <div style="width:50%; margin: 30px auto">
        <div class="modal-body" style="width:100%; float: left">
          <div class="alert alert-info">Electronic Product Code</div>
          <div class="alert alert-warning">
            Se requiere información. Por favor, vaya al menú "ETIQUETAS" y seleccione la opción Palets para generar etiquetas para los palets.
          </div>
        </div>
      </div>
    <?php  return; } ?>
  ?>
	<div style="width:50%; margin: 30px auto">
      	<div class="modal-body" style="width:100%; float: left">
      		<div class="alert alert-info">Electronic Product Code</div>
  			<div class="alert alert-primary">
<?php 
include("../mod/conexion.php");


/*** OBTENER EL SERIAL NUMBER ****/
$consulta = "SELECT substring(epc_tarima, 13, 5) as product_type, substring(epc_tarima, 18,7) as serial_number from epc_tarima ORDER BY serial_number DESC";
$result = mysql_query($consulta);
$serial_number = "0";
$tipo = "0";
if( $row = mysql_fetch_array( $result ) ){
  $serial_number = $row['serial_number'];
  $tipo = $row['product_type'];
}

/**** GENERAR ****/
$epc = "";
$id_empaque = $_SESSION['id_empaque'];
while($numero_etiquetas-- > 0){
  $serial_number++;
  $epc = "01";
  $epc .= str_pad($id_empaque, 7,"0",STR_PAD_LEFT);
  $epc .= str_pad($tam, 3,"0", STR_PAD_LEFT);
  $epc .= str_pad($id_fruta, 3,"0", STR_PAD_LEFT);
  $epc .= str_pad($serial_number, 7,"0", STR_PAD_LEFT);
  $consulta = "INSERT INTO epc_tarima VALUES('$epc')";
  print $epc."<br>";
  mysql_query($consulta);
}
mysql_close();
//header("Location: ../index.php?op=epcgenerados&lote=".$id_lote);
?>
  			</div>
		  	<hr>
		  	<center>
	     		<a href="index.php?op=palets" class="btn btn-default">Regresar</a>
	     	</center>
	     </div>
    </div>	
    <div style="clear:both"></div>
    <p>&nbsp;</p>
</div>
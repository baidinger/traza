<div class="contenedor-form">		
	<div class="modal-header">
		<h3 class="modal-title">
			<img class="img-header" src="img/RFID.png"> EPC's generados
		</h3>
	</div>

	<div style="width:50%; margin: 30px auto">
      	<div class="modal-body" style="width:100%; float: left">
      		<div class="alert alert-info">Electronic Product Code</div>
  			<div class="alert alert-primary">
<?php 
include("../mod/conexion.php");


/*** EPC  XX XXXXXXX XXXXXX XXXXXXXXX
          HEADER EPC-MANAGER OBJECT-CLASS SERIAL-NUMBER

HEADER
00 EPC CAJA
01 EPC TARIMA

EPC-MANAGER
ID_EMPAQUE

OBJECT-CLASS
CAJA-MANGO-MANILA
CAJA-MANGO-TOMY
.
.
.

SERIAL-NUMBER 

*****/

/**** Consultar último ID de caja /**/

//print $consulta = "SELECT substring(epc_caja, 10, 6) as product_type, substring(epc_caja, 16,9) as serial_number from epc_caja, lotes, productos_productores WHERE id_lote_fk = id_lote and id_productos_productores = id_productos_productores_fk and id_producto_fk = substring(epc_caja, 10, 6) and id_empaque_fk = 14 ORDER BY serial_number DESC";

//print "<br>ID_PRODUCTO: ".$id_producto."<br>";

/*** OBTENER EL SERIAL NUMBER ****/
$consulta = "SELECT substring(epc_tarima, 10, 6) as product_type, substring(epc_tarima, 16,9) as serial_number from epc_tarima ORDER BY serial_number DESC";
$result = mysql_query($consulta);
$serial_number = "0";
$tipo = "0";
if( $row = mysql_fetch_array( $result ) ){
  $serial_number = $row['serial_number'];
  $tipo = $row['product_type'];
}

/**** GENERAR ****/
$epc = "";

while($numero_etiquetas-- > 0){
  $serial_number++;
  $epc = "01";
  $id_empaque = $_SESSION['id_empaque'];
  $epc .= str_pad($id_empaque, 7,"0",STR_PAD_LEFT);
  $epc .= str_pad($tipo, 6,"0", STR_PAD_LEFT);
  $epc .= str_pad($serial_number, 9,"0", STR_PAD_LEFT);
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
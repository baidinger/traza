<?php session_start();
$id_lote 			= 	$_POST['id_lote'];
$rend_cajas 		= 	$_POST['cantidad_cajas'];
$rend_kg 			= 	$_POST['cantidad_kilos'];
$numero_etiquetas 	= 	$_POST['numero_etiquetas'];

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

/**** AGREGAR DATOS DEL LOTE ****/
$consulta = "UPDATE lotes set rendimiento_cajas = $rend_cajas, rendimiento_kg = $rend_kg WHERE id_lote = $id_lote";
include("../../mod/conexion.php");
mysql_query($consulta);

/**** OBTENER EL TIPO DE PRODUCTO DEL LOTE ***/

print $consulta = "SELECT id_producto_fk FROM lotes, productos_productores WHERE id_productos_productores = id_productos_productores_fk AND id_lote = $id_lote";
$result = mysql_query($consulta);
$id_producto = "";
if( $row = mysql_fetch_array( $result ) ){
	$id_producto = $row['id_producto_fk'];
}else {
	print "Error: Id product not found, contact web site admin";
	return;
}

print "<br>ID_PRODUCTO: ".$id_producto."<br>";

/*** OBTENER EL SERIAL NUMBER ****/
print $consulta = "SELECT substring(epc_caja, 10, 6) as product_type, substring(epc_caja, 16,9) as serial_number from epc_caja, lotes, productos_productores WHERE id_lote_fk = id_lote and id_productos_productores = id_productos_productores_fk and id_producto_fk = $id_producto and id_empaque_fk = $_SESSION[id_empaque] ORDER BY serial_number DESC";
$result = mysql_query($consulta);
$serial_number = "0";
if( $row = mysql_fetch_array( $result ) ){
	$serial_number = $row['serial_number'];
}

print "<br>SERIAL_NUMBER: ".$serial_number."<br>";

/**** GENERAR ****/
$epc = "";
$EPCS = "";
while($numero_etiquetas-- > 0){
	$serial_number++;
	$epc = "01";
	$id_empaque = $_SESSION['id_empaque'];
	$epc .= str_pad($id_empaque, 7,"0",STR_PAD_LEFT);
	$epc .= str_pad($id_producto, 6,"0", STR_PAD_LEFT);
	$epc .= str_pad($serial_number, 9,"0", STR_PAD_LEFT);
	$EPCS .= $epc."<br>";
	print $consulta = "INSERT INTO epc_caja VALUES('$epc',$id_lote)";
	print "<br>";
	mysql_query($consulta);
}
mysql_close();
header("Location: ../index.php?op=epcgenerados=".$id_lote);
?>


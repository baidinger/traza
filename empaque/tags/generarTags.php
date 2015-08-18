<?php session_start();
$id_lote 			= 	$_POST['id_lote'];
$cajas_chicas 		= 	$_POST['cajas_chicas'];
$cajas_medianas 	= 	$_POST['cajas_medianas'];
$cajas_grandes		= 	$_POST['cajas_grandes'];
$rend_kg 			= 	$_POST['rendimiento'];
$resaga 			= 	$_POST['resaga'];
$merma1 			= 	$_POST['merma1'];
$merma2 			= 	$_POST['merma2'];

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
$consulta = "UPDATE lotes set cajas_chicas = $cajas_chicas, cajas_medianas = $cajas_medianas, cajas_grandes = $cajas_grandes,
 rendimiento_kg = $rend_kg, resaga = $resaga, merma1 = $merma1, merma2 = $merma2 WHERE id_lote = $id_lote";
include("../../mod/conexion.php");
mysql_query($consulta);

/**** OBTENER EL TIPO DE PRODUCTO DEL LOTE ***/

$consulta = "SELECT id_producto_fk FROM lotes, productos_productores WHERE id_productos_productores = id_productos_productores_fk AND id_lote = $id_lote";
$result = mysql_query($consulta);
$id_producto = "";
if( $row = mysql_fetch_array( $result ) ){
	$id_producto = $row['id_producto_fk'];
}else {
	print "Error: Id product not found, contact web site admin";
	return;
}

//print "<br>ID_PRODUCTO: ".$id_producto."<br>";

/*** OBTENER EL SERIAL NUMBER ****/
$consulta = "SELECT substring(epc_caja, 11, 5) as product_type, substring(epc_caja, 19,6) as serial_number from epc_caja, lotes, productos_productores WHERE id_lote_fk = id_lote and id_productos_productores = id_productos_productores_fk and id_producto_fk = $id_producto and id_empaque_fk = $_SESSION[id_empaque] ORDER BY serial_number DESC";
$result = mysql_query($consulta);
$serial_number = "0";
if( $row = mysql_fetch_array( $result ) ){
	$serial_number = $row['serial_number'];
}

// "<br>SERIAL_NUMBER: ".$serial_number."<br>";

/**** GENERAR ****/
$epc = "";
$EPCS = "";
//generando cajas chicas
while($cajas_chicas-- > 0){
	$serial_number++;
	$epc = "00";
	$id_empaque = $_SESSION['id_empaque'];
	$epc .= str_pad($id_empaque, 7,"0",STR_PAD_LEFT);
	$epc .= "0";
	$epc .= str_pad($id_producto, 5,"0", STR_PAD_LEFT);
	$epc .= str_pad($id_lote,3,"0",STR_PAD_LEFT);
	$epc .= str_pad($serial_number, 6,"0", STR_PAD_LEFT);
	$EPCS .= $epc."<br>";
	$consulta = "INSERT INTO epc_caja VALUES('$epc',$id_lote)";
	//print "<br>";
	mysql_query($consulta);
}
//generando cajas chicas
while($cajas_medianas-- > 0){
	$serial_number++;
	$epc = "00";
	$id_empaque = $_SESSION['id_empaque'];
	$epc .= str_pad($id_empaque, 7,"0",STR_PAD_LEFT);
	$epc .= "1";
	$epc .= str_pad($id_producto, 5,"0", STR_PAD_LEFT);
	$epc .= str_pad($id_lote,3,"0",STR_PAD_LEFT);
	$epc .= str_pad($serial_number, 6,"0", STR_PAD_LEFT);
	$EPCS .= $epc."<br>";
	$consulta = "INSERT INTO epc_caja VALUES('$epc',$id_lote)";
	//print "<br>";
	mysql_query($consulta);
}
//generando cajas chicas
while($cajas_grandes-- > 0){
	$serial_number++;
	$epc = "00";
	$id_empaque = $_SESSION['id_empaque'];
	$epc .= str_pad($id_empaque, 7,"0",STR_PAD_LEFT);
	$epc .= "2";
	$epc .= str_pad($id_producto, 5,"0", STR_PAD_LEFT);
	$epc .= str_pad($id_lote,3,"0",STR_PAD_LEFT);
	$epc .= str_pad($serial_number, 6,"0", STR_PAD_LEFT);
	$EPCS .= $epc."<br>";
	$consulta = "INSERT INTO epc_caja VALUES('$epc',$id_lote)";
	//print "<br>";
	mysql_query($consulta);
}
mysql_close();
header("Location: ../index.php?op=epcgenerados&lote=".$id_lote);
?>


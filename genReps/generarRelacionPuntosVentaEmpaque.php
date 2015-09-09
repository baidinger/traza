<?php 
	@session_start();

	if(!isset($_SESSION['tipo_socio']))
		header('Location: ../../');

	if(!isset($_POST['orden']))
		header('Location: ../../');
?>

 <?php
 	include('paises.php');
	$paises = new Paises();

	include('../mod/conexion.php');

	// DATOS DEL DISTRIBUIDOR
	$consulta = "SELECT * FROM empresa_empaques WHERE id_empaque = $_SESSION[id_empaque]";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);

	$nombreDistribuidor = $row['nombre_empaque'];
	$rfcDistribuidor = $row['rfc_empaque'];
	$paisDistribuidor = $paises->obtenerPais($row['pais_empaque']);
	$estadoDistribuidor = $paises->obtenerEstado($row['pais_empaque'], $row['estado_empaque']);
	$ciudadDistribuidor = $row['ciudad_empaque'];
	$direccionDistribuidor = $row['direccion_empaque'];
	$cpDistribuidor = $row['cp_empaque'];
	$tel1Distribuidor = $row['telefono1_empaque'];
	$tel2Distribuidor = $row['telefono2_empaque'];
	$emailDistribuidor = $row['email_empaque'];

	mysql_close();

	require('../lib/fpdf/fpdf.php');

	class PDF extends FPDF {

		function encabezado($nomDist){
			$this->SetFont('Arial', 'B', 18);
			$this->Cell(196, 10, 'RELACIÓN DE PUNTOS DE VENTA', 0, 0, 'C');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(196, 5, $nomDist, 0, 0, 'C');

			$this->Ln();
			$this->Ln();
			$this->Ln();

			date_default_timezone_set("America/Mexico_City");
			$fechaImpresion = date("d/m/Y");

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(170, 4, 'Fecha de impresión:', 0, 0, 'R');
			$this->SetFont('Arial', '', 9);
			$this->Cell(26, 4, $fechaImpresion, 0, 0, 'R');

			$this->Ln();
			$this->Ln();
			$this->Ln();
		}

		function datosEmpresa($nomDist, $rfcDist, $dirDist, $cpDist, $paisDist, $edoDist, $ciuDist, $tel1Dist, $tel2Dist, $emailDist){
			$this->SetTextColor(255, 255, 255);
			$this->SetFillColor(28, 124, 176);
			$this->SetFont('Arial', 'B', 10);

			$this->Cell(196, 6, 'DATOS DE LA EMPRESA', 1, 0, 'C', 1);

			$this->Ln();

			$this->SetTextColor(0, 0, 0);
			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'EMPRESA:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $nomDist, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'RFC:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $rfcDist, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'DIRECCIÓN:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $dirDist.' C.P. '.$cpDist, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'UBICACIÓN:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $ciuDist.', '.$edoDist.', '.$paisDist, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'TELÉFONO(S):', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $tel1Dist.' / '.$tel2Dist, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'EMAIL:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $emailDist, 1, 0, 'L');

			$this->Ln();
			$this->Ln();
		}

		function listaUsuarios($idDist){
			$this->SetFont('Arial', 'B', 8);
			$this->Cell(196, 4, 'LISTA DE PUNTOS DE VENTA', 0, 0, 'L');

			$this->Ln();
			$this->Ln();

			$this->SetTextColor(255, 255, 255);
			$this->SetFillColor(28, 124, 176);
			$this->SetFont('Arial', 'B', 9);

			$this->Cell(10, 6, 'NO.', 1, 0, 'C', 1);
			$this->Cell(20, 6, 'ID', 1, 0, 'C', 1);
			$this->Cell(30, 6, 'RFC', 1, 0, 'C', 1);
			$this->Cell(66, 6, 'NOMBRE DEL PUNTO DE VENTA', 1, 0, 'C', 1);
			$this->Cell(30, 6, 'CIUDAD', 1, 0, 'C', 1);
			$this->Cell(30, 6, 'ESTADO', 1, 0, 'C', 1);
			//$this->Cell(30, 6, 'PAIS', 1, 0, 'C', 1);
			$this->Cell(10, 6, 'EDO', 1, 0, 'C', 1);

			$this->SetTextColor(0, 0, 0);
			$this->SetFont('Arial', '', 9);
			$this->Ln();

			include('../mod/conexion.php');

			$contador = 1;

			$consulta = "select id_punto_venta, nombre_punto_venta, rfc_punto_venta, ".
				"pais_punto_venta, estado_punto_venta, ciudad_punto_venta,cp_punto_venta, 
				telefono_punto_venta, email_punto_venta, direccion_punto_venta, ".
				" estado_pv from empresa_punto_venta 
				where id_usuario_que_registro = ".$_SESSION['id_receptor']." ORDER BY nombre_punto_venta ASC";
			$resultado = mysql_query($consulta);
			while($row = mysql_fetch_array($resultado)){
				$this->SetTextColor(0, 0, 0);

				$this->Cell(10, 5, $contador, 1, 0, 'C', 0);
				$this->Cell(20, 5, str_pad($row['id_punto_venta'],7,"0",STR_PAD_LEFT), 1, 0, 'C', 0);
				$this->Cell(30, 5, $row['rfc_punto_venta'], 1, 0, 'L', 0);
				$this->Cell(66, 5, $row['nombre_punto_venta'], 1, 0, 'L', 0);
				$this->Cell(30, 5, $row['ciudad_punto_venta'], 1, 0, 'C', 0);
				

				$paises = array("MEXICO","ESTADOS UNIDOS","CANADÁ","JAPÓN","AUSTRALIA");
			          	
			          	$pais_c = $row['pais_punto_venta'];
			          	$estado_c = $row['estado_punto_venta'];

			    

			          	$mexico = array("AGUASCALIENTES", "BAJA CALIFORNIA NORTE", "BAJA CALIFORNIA SUR","CAMPECHE","COAHUILA","CHIAPAS","CHIHUAHUA","DURANGO","ESTADO DE MEXICO","GUANAJUATO","GUERRERO","HIDALGO","JALISCO","MICHOACÁN","MORELOS","MÉXICO D.F.","NAYARIT","NUEVO LEÓN","OAXACA","PUEBLA","QUERETARO","QUINTANA ROO","SAN LUIS POTOSÍ","SINALOA","SONORA","TABASCO","TAMAULIPAS","TLAXCALA","VERACRUZ","YUCATÁN","ZACATECAS");
			          	$eua = array("ALABAMA","ALASKA","ARIZONA","ARKANSAS","CALIFORNIA","CALIFORNIA DEL NORTE","CAROLINA DEL SUR","COLORADO","CONNECTICUT","DAKOTA DEL NORTE","DAKOTA DEL SUR","DELAWARE","FLORIDA","GEORGIA","HAWÁI","IDAHO","ILLINOIS","INDIANA","IOWA","KANSAS","KENTUCHY","LUISIANA","MAINE","MARYLAND","Massachusetts","MICHIGAN","MINNESOTA","MISISIPI","MISURI","MONTANA","NEBRASKA","NEVADA","NUEVA JERSEY","NUEVA YORK","NUEVO HAMPSHIRE","NUEVO MEXICO","OHIO","OKLAHOMA","OREGÓN","PENSILVANIA","RHODE ISLAND","TENNESSEE","TEXAS","UTAH","VERMONT","VIRGINIA","VIRGINIA OCCIDENTAL","WASHINGTON","WISCONSIN","WYOMING");
			          	$canada = array("ALBERTA","COLUMBIA BRITANICA","MANITOBA","ISLA DEL PRINCIPE EDUARDO","NUNAVUT5","NUEVA ESCOCIA","NUEVO BRUNSWICK","TERRANOVA Y LABRADOR","TERRITORIOS DEL NOROESTE","SASKATCHEWAN","QUEBEC","YÚKON5");
			          	$japon = array("PREFECTURA DE HOKKAIDO","PREFECTURA DE AOMORI","PREFECTURA DE IWATE","PREFECTURA DE MIYAGI","PREFECTURA DE AKITA","PREFECTURA DE YAMAGATA","PREFECTURA DE FUKUSHIMA","PREFECTURA DE IBARAKI","PREFECTURA DE TOCHIGI","PREFECTURA DE GUNMA","PREFECTURA DE SAITAMA","PREFECTURA DE CHIBA","TOKIO","PREFECTURA DE KANAWA","PREFECTURA DE NIIGATA","PREFECTURA DE TOYAMA","PREFECTURA DE ISHIKAWA","PREFECTURA DE FUKUI","PREFECTURA DE YAMANASHI","PREFECTURA DE NAGANO","PREFECTURA DE GIFU","PREFECTURA DE SHIZUOKA","PREFECTURA DE AICHI","PREFECTURA DE MIE","PREFECTURA DE SHIGA","PREFECTURA DE KIOTO","PREFECTURA DE OSAKA","PREFECTURA DE HYOGO","PREFECTURA DE NARA","PREFECTURA DE WAKAYAMA","PREFECTURA DE TOTTORI","PREFECTURA DE SHIMANE","PREFECTURA DE OKAYAMA","PREFECTURA DE HIROSHIMA","PREFECTURA DE YAMAGUCHI","PREFECTURA DE TOKUSHIMA","PREFECTURA DE KAGAWA","PREFECTURA DE EHIME","PREFECTURA DE KOCHI","PREFECTURA DE FUKUOKA","PREFECTURA DE SAGA","PREFECTURA DE NAGASAKI","PREFECTURA DE KUMAMOTO","PREFECTURA DE OITA","PREFECTURA DE MIYASAKI","PREFECTURA DE KAGOSHIMA","PREFECTURA DE OKINAWA");
			          	$australia = array("NEW SOUTH WALES","TASMANIA","SOUTH AUSTRALIA","QUEENSLAND","WESTERN AUSTRALIA");

			          	switch ($pais_c) {
			          		case '0':
			          			$this->Cell(30, 5, substr($mexico[$estado_c],0,11), 1, 0, 'C', 0);
			          			
			          			break;
			          			case '1':
			          				$this->Cell(30, 5, substr($eua[$estado_c],0,11), 1, 0, 'C', 0);
			          			break;
			          			case '2':
			          				$this->Cell(30, 5, substr($canada[$estado_c],0,11), 1, 0, 'C', 0);
			          			break;
			          			case '3':
			          				$this->Cell(30, 5, substr($japon[$estado_c],0,11), 1, 0, 'C', 0);
			          			break;
			          			case '4':
			          				$this->Cell(30, 5, substr($australia[$estado_c],0,11), 1, 0, 'C', 0);
			          			break;
			          	}


				if($row['estado_pv'] == 1){
					$this->SetTextColor(4, 180, 95);
					$this->Cell(10, 5, 'A', 1, 0, 'C');
				}
				else{
					$this->SetTextColor(166, 13, 13);
					$this->Cell(10, 5, 'B', 1, 0, 'C');
				}

				$this->Ln();
				$contador++;
			}

			mysql_close();
		}
	}

	$pdf = new PDF('P', 'mm', 'letter');

	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->encabezado($nombreDistribuidor);
	$pdf->datosEmpresa($nombreDistribuidor, $rfcDistribuidor, $direccionDistribuidor, $cpDistribuidor, $paisDistribuidor, $estadoDistribuidor, $ciudadDistribuidor, $tel1Distribuidor, $tel2Distribuidor, $emailDistribuidor);
	$pdf->listaUsuarios($idDistribuidor);

	$directorio = '../docs/';

	if(!file_exists($directorio))
	    mkdir($directorio);

	$pdf->Output($directorio.'puntosventaempaque'.$_SESSION['id_empaque'].'.pdf', "F");
 ?>
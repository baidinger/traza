<?php 
	@session_start();

	if(!isset($_SESSION['tipo_socio']))
		header('Location: ../../');

	if(!isset($_POST['orden']))
		header('Location: ../../');
?>

 <?php
 	$idDistribuidor = $_POST['dist'];

 	include('paises.php');
	$paises = new Paises();

	include('../mod/conexion.php');

	// DATOS DEL DISTRIBUIDOR
	$consulta = "SELECT * FROM empresa_distribuidores WHERE id_distribuidor = $idDistribuidor";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);

	$nombreDistribuidor = $row['nombre_distribuidor'];
	$rfcDistribuidor = $row['rfc_distribuidor'];
	$paisDistribuidor = $paises->obtenerPais($row['pais_distribuidor']);
	$estadoDistribuidor = $paises->obtenerEstado($row['pais_distribuidor'], $row['estado_distribuidor']);
	$ciudadDistribuidor = $row['ciudad_distribuidor'];
	$direccionDistribuidor = $row['direccion_distribuidor'];
	$cpDistribuidor = $row['cp_distribuidor'];
	$tel1Distribuidor = $row['tel1_distribuidor'];
	$tel2Distribuidor = $row['tel2_distribuidor'];
	$emailDistribuidor = $row['email_distribuidor'];

	mysql_close();

	require('../lib/fpdf/fpdf.php');

	class PDF extends FPDF {

		function encabezado($nomDist){
			$this->SetFont('Arial', 'B', 18);
			$this->Cell(196, 10, 'RELACIÓN DE CAMIONES', 0, 0, 'C');

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
			$this->Cell(196, 4, 'LISTA DE CAMIONES', 0, 0, 'L');

			$this->Ln();
			$this->Ln();

			$this->SetTextColor(255, 255, 255);
			$this->SetFillColor(28, 124, 176);
			$this->SetFont('Arial', 'B', 9);

			$this->Cell(10, 6, 'NO.', 1, 0, 'C', 1);
			$this->Cell(10, 6, 'ID', 1, 0, 'C', 1);
			$this->Cell(96, 6, 'NOMBRE DEL CHOFER', 1, 0, 'C', 1);
			$this->Cell(30, 6, 'PLACAS', 1, 0, 'C', 1);
			$this->Cell(40, 6, 'MARCA / MODELO', 1, 0, 'C', 1);
			$this->Cell(10, 6, 'EDO', 1, 0, 'C', 1);

			$this->SetTextColor(0, 0, 0);
			$this->SetFont('Arial', '', 9);
			$this->Ln();

			include('../mod/conexion.php');

			$contador = 1;

			$consulta = "SELECT * FROM camiones_distribuidor WHERE id_distribuidor_fk = $idDist ORDER BY nombre_chofer_camion_distribuidor ASC";
			$resultado = mysql_query($consulta);
			while($row = mysql_fetch_array($resultado)){
				$this->SetTextColor(0, 0, 0);

				$this->Cell(10, 5, $contador, 1, 0, 'C', 0);
				$this->Cell(10, 5, $row['id_camion_distribuidor'], 1, 0, 'C', 0);
				$this->Cell(96, 5, $row['nombre_chofer_camion_distribuidor'], 1, 0, 'L', 0);
				$this->Cell(30, 5, $row['placas_camion_distribuidor'], 1, 0, 'C', 0);
				$this->Cell(40, 5, $row['marca_camion_distribuidor']." / ".$row['modelo_camion_distribuidor'], 1, 0, 'C', 0);

				if($row['estado_camion_distribuidor'] == 1){
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

	$pdf->Output($directorio.'camionesdistribuidor'.$idDistribuidor.'.pdf', "F");
 ?>